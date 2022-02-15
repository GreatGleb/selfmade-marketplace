<?php

namespace App\Controllers;

use App\Exceptions\Core;
use App\Exceptions\Db;
use App\MultiException;
use App\View;

class Categories
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action)
    {
        $methodName = 'action' . $action;
        $this->beforeAction();
        return $this->$methodName();
    }

    protected function beforeAction()
    {
        $this->view->markup = \App\Models\ShopProductMarkup::findById(1)->markup;
        $markup = $this->view->markup;
        
        session_start();
        
        if($_SESSION['customer'] == NULL) {
            $customer = new \App\Models\User();
    		$customerId = $customer->findMaxId() + 1;
    		
    		$customer->id = $customerId;
    		$customer->full_name = 'anonim';
    		$randNum = random_int(0, 99999999999999);
    		$customer->email = 'anonim@' . $randNum;
    		$customer->login = 'anonim_' . $randNum;
    		$customer->password = 'anonim_' . $randNum;
    		
    		$typeofuser_id = \App\Models\TypeOfUsers::findIdTypeOfUsersByType('Customer')->id;
    		$customer->typeofuser_id = $typeofuser_id;
    		
    		if($customer->insert() == false) {
    		    $isNewCustomerNotInserted = 1;
        		while($isNewCustomerNotInserted == 1) {
            		$randNum = random_int(0, 99999999999999);
    		        $customer->email = 'anonim@' . $randNum;
            		$customer->login = 'anonim_' . $randNum;
            		$customer->password = 'anonim_' . $randNum;
            		
            		if($customer->insert()) {
            		    $isNewCustomerNotInserted = 0;
            		}
        		}
    		}
    		
    		$_SESSION['customer'] = $customer;
    		
            $buyCart = new \App\Models\BuyCart();
    		$buyCartId = $buyCart->findMaxId() + 1;
    		
    		$buyCart->id = $buyCartId;
    		$buyCart->userId = $customer->id;
    		
    		$buyCart->insert();
    		
    		$_SESSION['buyCart'] = $buyCart;
        } else {
            $sqlBoughtProducts = \App\Models\BuyCartProducts::findTablesByField('buyCartId', $_SESSION['buyCart']->id);
            
            $boughtProducts = [];
            
            foreach($sqlBoughtProducts as $sqlBoughtProduct) {
                $boughtProduct = new \App\Models\ShopProduct();
                
                $finedProduct = \App\Models\ShopProduct::findById($sqlBoughtProduct->productId);
                
                $finedProduct->brand = \App\Models\ShopProductBrand::findById($finedProduct->brandId);
    			$finedProduct->model = \App\Models\ShopProductModel::findById($finedProduct->modelId)->model;
    			
    			$boughtProduct->id = $finedProduct->id;
    			
    		    $boughtProduct->name = $finedProduct->typeProduct . ' ' . $finedProduct->brand->brand . ' ' . $finedProduct->model;
                
                $finedProductDiscont = \App\Models\ShopProductDiscont::findCurrentDisconts('productId', $finedProduct->id)[0];
		    	if($finedProductDiscont->newPrice != NULL) {
		    	    $boughtProduct->actualPrice = $finedProductDiscont->newPrice * $markup;
		    	} else {
		    	    $boughtProduct->actualPrice = $finedProduct->sellerPrice * $markup;
		    	}
		    	
		    	$boughtProduct->number = $sqlBoughtProduct->number;
		    	$boughtProduct->maxOrder = $finedProduct->quantity;
		    	$boughtProduct->minOrder = $finedProduct->minOrderQuantity;

    			$finedProduct->product_images = \App\Models\ShopProductImages::findTablesByField('productId', $finedProduct->id);
    			
    			$finedProduct->product_image = \App\Models\ShopProductImages::findRecordWithMinField('orderNumber', 'productId', $finedProduct->id);
    			$boughtProduct->image = \App\Models\Images::findById($finedProduct->product_image->imageId);
    			
    			$productAtributes = \App\Models\ShopProductAtribute::findTablesByField('productId', $finedProduct->id);
    			
    			if(sizeof($productAtributes) != 0) {
    			    $strGoodAtribute = '';
    			    
			        $atributes = \App\Models\BuyCartProductAtributes::findTablesByField('buyCartProductsId', $sqlBoughtProduct->id);
			        foreach($atributes as $atribute) {
			            $atribute = \App\Models\ShopProductAtribute::findById($atribute->atributId);
			            
			            $image = "";
        				
        				if($atribute->imageId != NULL) {
        					$image = \App\Models\Images::findById($atribute->imageId)->name;
        				}
			            
			            $strGoodAtribute .= $atribute->id . ',!,' . $atribute->type . ",!," . $atribute->value . ",!," . $image . "]";
			        }
			        
    			    $boughtProduct->strGoodAtribute = $strGoodAtribute;
    			    
    			}
    			
    			$boughtProduct->brandUrl = $finedProduct->brand->url;
    			$boughtProduct->url = $finedProduct->url;
    			
		    	$boughtProducts[] = $boughtProduct;
            }
            
            $_SESSION['buyCart']->boughtProducts = $boughtProducts;
            //var_dump($_SESSION['buyCart']);
        }
        
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
    }

    protected function actionShow()
    {
		$categoryByUrl = \App\Models\Categories::findTablesByField('url', $this->url)[0];
		$categoryById = \App\Models\Categories::findTablesByField('id', $this->url)[0];
		
		if($categoryByUrl || $categoryById) {
			if($categoryByUrl) {
				$category = $categoryByUrl;
			} else {
				$category = $categoryById;				
			}
			
			$parent_categoryId = $category->parent_categoryId;
			$parent_category = \App\Models\Categories::findById($parent_categoryId);
			
			$category->img = \App\Models\ImagesForCategory::findCurrentImageByTableId($category->id, 'categoryId');
		
			if($category->isShow == 1) {
				$this->view->category = $category;
				$this->view->parent_categoryId = $parent_category->id;
				$this->view->parent_categoryName = $parent_category->name;
				$this->view->parent_categoryUrl = $parent_category->url;
				$this->view->display(__DIR__ . '/../templates/categories.php');
			}
		} else {
			echo "Не удалось найти данную страницу. ((";
		}
    }

}