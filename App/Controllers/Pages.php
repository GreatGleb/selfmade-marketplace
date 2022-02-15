<?php

namespace App\Controllers;

use App\Exceptions\Core;
use App\Exceptions\Db;
use App\MultiException;
use App\View;

class Pages
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
    			
    		    //$boughtProduct->name = $finedProduct->typeProduct . ' ' . $finedProduct->brand->brand . ' ' . $finedProduct->model;

    		    if($finedProduct->brand->id == '1') {
    			    $boughtProduct->name = $finedProduct->typeProduct . ' ' . $finedProduct->model;
    		    } else {
    		        $boughtProduct->name = $finedProduct->typeProduct . ' ' . $finedProduct->brand->brand . ' ' . $finedProduct->model;
    		    }
                
                $finedProductDiscont = \App\Models\ShopProductDiscont::findCurrentDisconts('productId', $finedProduct->id)[0];
		    	if($finedProductDiscont->newPrice != NULL) {
		    	    $boughtProduct->actualPrice = ceil($finedProductDiscont->newPrice * $markup);
		    	} else {
		    	    $boughtProduct->actualPrice = ceil($finedProduct->sellerPrice * $markup);
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

    protected function actionIndex()
    {
        $markup = $this->view->markup;
        
		$products = array();
		
		$allProducts = []; //\App\Models\ShopProduct::findAll();
		
		$productsCategoryZOG = \App\Models\ShopProductShowInCategories::findTablesByField('categoryId', 2);
		
		for($i = 0, $counter = 6; $i < $counter; $i++) {
		    $product = \App\Models\ShopProduct::findById($productsCategoryZOG[$i]->productId);
		    $product->categoryName = 'zog';
		    
		    $product->shop = \App\Models\Shop::findById($product->shopId);
			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
			
			if($product->seller->isIncluded != 0 && $product->shop->isTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->isTrading !== '0') {
			     $allProducts[] = $product;
			} else {
			    $counter++;
			}
		}
		
		for($i = $counter, $counter2 = $counter + 6; $i < $counter2; $i++) {
		    $product = \App\Models\ShopProduct::findById($productsCategoryZOG[$i]->productId);
		    $product->categoryName = 'beauty';
		    
		    $product->shop = \App\Models\Shop::findById($product->shopId);
			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
			
			if($product->seller->isIncluded != 0 && $product->shop->isTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->isTrading !== '0') {
			     $allProducts[] = $product;
			} else {
			    $counter2++;
			}
		}
		
		$productsCategoryGifts = \App\Models\ShopProductShowInCategories::findTablesByField('categoryId', 22);
		
		for($i = 0, $counter = 6; $i < $counter; $i++) {
		    $product = \App\Models\ShopProduct::findById($productsCategoryGifts[$i]->productId);
		    if($product != NULL) {
		        $product->categoryName = 'gifts';
    		    $product->shop = \App\Models\Shop::findById($product->shopId);
    			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
    			
    			if($product->seller->isIncluded != 0 && $product->shop->IsTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->IsTrading !== '0') {
    			     $allProducts[] = $product;
    			} else {
    			    $counter++;
		    	}
		    }
		    
		}
		
		$productsCategoryChildWorld = \App\Models\ShopProductShowInCategories::findTablesByField('categoryId', 23);
		
		for($i = 0, $counter = 6; $i < $counter; $i++) {
		    $product = \App\Models\ShopProduct::findById($productsCategoryChildWorld[$i]->productId);
		    if($product != NULL) {
		        $product->categoryName = 'childworld';
    		    $product->shop = \App\Models\Shop::findById($product->shopId);
    			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
    			
    			if($product->seller->isIncluded != 0 && $product->shop->isTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->isTrading !== '0') {
    			     $allProducts[] = $product;
    			} else {
    			    $counter++;
		    	}
		    }
		}
		
		$productsCategoryComputerTech = \App\Models\ShopProductShowInCategories::findTablesByField('categoryId', 117);
		
		for($i = 0, $counter = 6; $i < $counter; $i++) {
		    $product = \App\Models\ShopProduct::findById($productsCategoryComputerTech[$i]->productId);
		    if($product != NULL) {
		        $product->categoryName = 'tech';
    		    $product->shop = \App\Models\Shop::findById($product->shopId);
    			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
    			
    			if($product->seller->isIncluded != 0 && $product->shop->isTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->isTrading !== '0') {
    			     $allProducts[] = $product;
    			} else {
    			    $counter++;
		    	}
		    }
		}
		
		$productsCategoryClose = \App\Models\ShopProductShowInCategories::findTablesByField('categoryId', 34);
		
		for($i = 0, $counter = 6; $i < $counter; $i++) {
		    $product = \App\Models\ShopProduct::findById($productsCategoryClose[$i]->productId);
		    if($product != NULL) {
		        $product->categoryName = 'close';
    		    $product->shop = \App\Models\Shop::findById($product->shopId);
    			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
    			
    			if($product->seller->isIncluded != 0 && $product->shop->isTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->isTrading !== '0') {
    			     $allProducts[] = $product;
    			} else {
    			    $counter++;
		    	}
		    }
		}
		
		$productsCategorySlipes = \App\Models\ShopProductShowInCategories::findTablesByField('categoryId', 38);
		
		for($i = 0, $counter = 6; $i < $counter; $i++) {
		    $product = \App\Models\ShopProduct::findById($productsCategorySlipes[$i]->productId);
		    if($product != NULL) {
		        $product->categoryName = 'slipes';
    		    $product->shop = \App\Models\Shop::findById($product->shopId);
    			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
    			
    			if($product->seller->isIncluded != 0 && $product->shop->isTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->isTrading !== '0') {
    			     $allProducts[] = $product;
    			} else {
    			    $counter++;
		    	}
		    }
		}
		
		$productsCategoryFurniture = \App\Models\ShopProductShowInCategories::findTablesByField('categoryId', 42);
		
		for($i = 0, $counter = 6; $i < $counter; $i++) {
		    $product = \App\Models\ShopProduct::findById($productsCategoryFurniture[$i]->productId);
		    if($product != NULL) {
		        $product->categoryName = 'furniture';
    		    $product->shop = \App\Models\Shop::findById($product->shopId);
    			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
    			
    			if($product->seller->isIncluded != 0 && $product->shop->isTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->isTrading !== '0') {
    			     $allProducts[] = $product;
    			} else {
    			    $counter++;
		    	}
		    }
		}
		
		
		for($i = 0, $counter = 10; $i < $counter; $i++) {
		    $product = \App\Models\ShopProduct::findByOrderDesc('date_added')[$i];
		    if($product != NULL) {
		        $product->categoryName = 'news';
    		    $product->shop = \App\Models\Shop::findById($product->shopId);
    			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
    			
    			if($product->seller->isIncluded != 0 && $product->shop->isTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->isTrading !== '0') {
    			     $allProducts[] = $product;
    			} else {
    			    $counter++;
		    	}
		    }
		}
		
		
		//var_dump($productsCategorySlipes);
		//var_dump($allProducts);
		foreach($allProducts as $product) {
		    
			$product->brand = \App\Models\ShopProductBrand::findById($product->brandId);
			$product->model = \App\Models\ShopProductModel::findById($product->modelId)->model;
			
		    //$product->name = $product->typeProduct . ' ' . $product->brand->brand . ' ' . $product->model;
		    if($product->brand->id == '1') {
			    $product->name = $product->typeProduct . ' ' . $product->model;
		    } else {
		        $product->name = $product->typeProduct . ' ' . $product->brand->brand . ' ' . $product->model;
		    }
			
			$product->shop = \App\Models\Shop::findById($product->shopId);
			
			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
			if($product->seller->jurTypeId !==NULL) {
				$product->seller->jurSelectedType = \App\Models\Seller::findTableByFk('seller_juridicalentitytypes', 'jurTypeId', $product->seller->id)[0]->type;
			}
			$product->seller->fio = \App\Models\User::findById($product->seller->userId)->full_name;
			
			$product->price = ceil($product->sellerPrice * $markup);
			
			$product->product_images = \App\Models\ShopProductImages::findTablesByField('productId', $product->id);
			
			$product->product_image = \App\Models\ShopProductImages::findRecordWithMinField('orderNumber', 'productId', $product->id);
			$product->image = \App\Models\Images::findById($product->product_image->imageId);
			
			if($product->image == NULL) {
			    break;
			}
			
			$img_pos_slesh = stripos($product->image->url, '/');
			$img_dir_name = substr($product->image->url, 0, $img_pos_slesh);
			
			$img_pos_ext = strripos($product->image->name, '.');			
			$img_minuspos = strlen($product->image->name)-$img_pos_ext-1;								
			$img_file_ext = strtolower(substr($product->image->name, $img_pos_ext+1, $img_minuspos));			
			$img_file_name = substr($product->image->name, 0, $img_pos_ext);								
			$img_file_name = $img_file_name . '_150x150.' . $img_file_ext;

			$img_dataFileName = $product->image->name;
			
			$product->shortImg = 'admin/' . $product->image->url . $product->image->name;
			
			foreach($product->product_images as $product_image) {
				$img = \App\Models\Images::findById($product_image->imageId);
				$img->orderNumber = $product_image->orderNumber;
				$product->images[] = $img;
			}
			
			$product->stockrooms = \App\Models\ShopStockRoom::findTablesByField('sellerId', $product->shop->sellerId);
			
			foreach($product->stockrooms as $stockroom) {
				$stockroom->address = \App\Models\Address::findById($stockroom->addressId);
			}
			
			$product->category = \App\Models\Categories::findById($product->mainCategoryId);
			
			$categories = \App\Models\ShopProductShowInCategories::findTablesByField('productId', $product->id);
			
			foreach($categories as $category) {
				$finedCategory = \App\Models\Categories::findById($category->categoryId);
				
				if($finedCategory->parent_categoryId != NULL) {
					$parent_categoryId = $finedCategory->parent_categoryId;
					while(1) {
						$parentCategory = \App\Models\Categories::findById($parent_categoryId);
						$finedCategory->name = $parentCategory->name . ">" . $finedCategory->name;
						
						if($parentCategory->parent_categoryId != NULL) { 
							$parent_categoryId = $parentCategory->parent_categoryId;
						} else {
							break;
						}
					}
				}
				
				$product->categories[] = $finedCategory;
			}
			
			$productEmptyAtributes = \App\Models\ShopProductAtribute::findTablesByFieldNULL('type');
			
			foreach ($productEmptyAtributes as $atribut) {
				$image = \App\Models\Images::findById($atribut->imageId);
			
				if($atribut->delete()) {				
					$imgName = $image->name;
					
					$target_dir = realpath(__DIR__ . "/../templates/files/img/product-attributes");
					$target_dir = $target_dir . "\\";
					
					if($image !== NULL) {
						$image->delete();
					}
					deleting($imgName, $target_dir);
				}
			}
			
			$productAtributes = \App\Models\ShopProductAtribute::findTablesByField('productId', $product->id);
			
			$productTypesOfAtributes = [];
			$product->atributes = [];
			
			foreach($productAtributes as $atribut) {
				$isItNewAtribut = true;
				
				foreach($productTypesOfAtributes as $type) {
					if($atribut->type == $type) {
						$isItNewAtribut = false;
					}
				}		

				if($isItNewAtribut) {
					$productTypesOfAtributes[] = $atribut->type;
					$product->atributes[] = $atribut->type;
				}
			}
			
			foreach($productAtributes as $atribut) {
				$typeIndex = array_search($atribut->type, $productTypesOfAtributes);
				
				$image = "";
				
				if($atribut->imageId != NULL) {
					$image = \App\Models\Images::findById($atribut->imageId)->name;
				}
				
				$product->atributes[$typeIndex] .= ",!," . $atribut->value . ",!," . $image . ",!," . $atribut->id;
			}
			
			$productDiscont = \App\Models\ShopProductDiscont::findCurrentDisconts('productId', $product->id)[0];
			$product->newPrice = ceil($productDiscont->newPrice * $markup);
			if(sizeof($product->atributes) == 0) {
			    $isAdedToCart = \App\Models\BuyCartProducts::findTablesByTwoFields('buyCartId', $_SESSION['buyCart']->id, 'productId', $product->id)[0];
			    
			    if($isAdedToCart !== NULL) {
			        $product->isAdedToCart = 1;
			    }
			} else {
			    $goodsAddedToCart = \App\Models\BuyCartProducts::findTablesByTwoFields('buyCartId', $_SESSION['buyCart']->id, 'productId', $product->id);
			    $strGoodsAtributes = '';
			    
			    foreach($goodsAddedToCart as $good) {
			        $atributes = \App\Models\BuyCartProductAtributes::findTablesByField('buyCartProductsId', $good->id);
			        
			        foreach($atributes as $atribut) {
			            $strGoodsAtributes .= $atribut->atributId . ',';
			        }
			        $strGoodsAtributes .= ']';
			    }
			    $product->strGoodsAtributes = $strGoodsAtributes;
			}
			
			if($product->seller->isIncluded != 0 && $product->shop->IsTrading !== '0' && $product->shop->isIncluded !== '0' && $product->isIncluded !== '0' && $product->IsTrading !== '0') {
			    $products[] = $product;
			}
		}
		
		$this->view->products = $products;
		
		$this->view->shops = \App\Models\Shop::findAll();
	    
	    foreach($this->view->shops as $shop) {
    	    if($shop->url == NULL || $shop->url == "" || $shop->url == " ") {
    	        $shop->url = "shop" . $shop->id;
    	    }
    	    $shopImg = \App\Models\ImagesForShop::findTablesByTwoFields('shopId', $shop->id, 'isCurrent', 1)[0];
		    if($shopImg != NULL) {
		        $shop->img = \App\Models\Images::findById($shopImg->imageId);
		    }
	    }
        //var_dump($this->view->products);
		$this->view->display(__DIR__ . '/../templates/index.php');
    }

    protected function actionCheckout()
    {
        $markup = $this->view->markup;
        
        $sqlBoughtProducts = \App\Models\BuyCartProducts::findTablesByField('buyCartId', $_SESSION['buyCart']->id);
        
        $boughtProducts = [];
        
        foreach($sqlBoughtProducts as $sqlBoughtProduct) {
            $boughtProduct = new \App\Models\ShopProduct();
            
            $finedProduct = \App\Models\ShopProduct::findById($sqlBoughtProduct->productId);
            
            $finedProduct->brand = \App\Models\ShopProductBrand::findById($finedProduct->brandId);
        	$finedProduct->model = \App\Models\ShopProductModel::findById($finedProduct->modelId)->model;
        	
        	$shop = \App\Models\Shop::findById($finedProduct->shopId);
        	$seller = \App\Models\Seller::findById($shop->sellerId);
        	if($seller->jurTypeId !==NULL) {
        		$seller->jurType = \App\Models\Seller::findTableByFk('seller_juridicalentitytypes', 'jurTypeId', $seller->id)[0]->type;
        	}
        	
        	$user = \App\Models\User::findById($seller->userId);
        	
        	$jurName = $seller->jurType . ' ' . $seller->jurName;
        	$payUcode = $seller->bankCode;
        	
        	$stock = \App\Models\ShopStockRoom::findById($finedProduct->stockroomId);
        	$deliveryServices = \App\Models\ShopPointsAcceptaceOrders::findTablesByField('stockroomId', $stock->id);
        	$contact = \App\Models\Contact::findById($stock->contactId)->contact;
        	$address = \App\Models\Address::findById($stock->addressId);
        	
        	if($boughtProducts[$stock->id] == NULL) {
        	    $boughtProducts[$stock->id] = (object)array();
        	    $boughtProducts[$stock->id]->fullname = $user->full_name;
        	    $boughtProducts[$stock->id]->phone = $contact;
        	    $boughtProducts[$stock->id]->jurName = $jurName;
        	    $boughtProducts[$stock->id]->payUcode = $payUcode;
        	    $boughtProducts[$stock->id]->shopName = $shop->name;
        	    $boughtProducts[$stock->id]->stock = $stock;
        	    $boughtProducts[$stock->id]->deliveryServices = $deliveryServices;
        	    $boughtProducts[$stock->id]->address = $address;
        	    $boughtProducts[$stock->id]->products = [];
        	}
        	
        	$newProduct = new \App\Models\ShopProduct();
        	$newProduct->id = $finedProduct->id;
        	//$newProduct->name = $finedProduct->typeProduct . ' ' . $finedProduct->brand->brand . ' ' . $finedProduct->model;
        	if($finedProduct->brand->id == '1') {
			    $newProduct->name = $finedProduct->typeProduct . ' ' . $finedProduct->model;
		    } else {
		        $newProduct->name = $finedProduct->typeProduct . ' ' . $finedProduct->brand->brand . ' ' . $finedProduct->model;
		    }
		    
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
		        
			    $newProduct->strGoodAtribute = $strGoodAtribute;
			}
			
			$finedProduct->product_images = \App\Models\ShopProductImages::findTablesByField('productId', $finedProduct->id);
			$finedProduct->product_image = \App\Models\ShopProductImages::findRecordWithMinField('orderNumber', 'productId', $finedProduct->id);
			$newProduct->image = \App\Models\Images::findById($finedProduct->product_image->imageId);
			$newProduct->number = $sqlBoughtProduct->number;
			
            $finedProductDiscont = \App\Models\ShopProductDiscont::findCurrentDisconts('productId', $finedProduct->id)[0];
	    	if($finedProductDiscont->newPrice != NULL) {
	    	    $newProduct->sellerPrice = $finedProductDiscont->newPrice;
	    	    $newProduct->actualPrice = ceil($finedProductDiscont->newPrice * $markup);
	    	} else {
	    	    $newProduct->sellerPrice = $finedProduct->sellerPrice;
	    	    $newProduct->actualPrice = ceil($finedProduct->sellerPrice * $markup);
	    	}
	    	$newProduct->width = $finedProduct->width;
	    	$newProduct->height = $finedProduct->height;
	    	$newProduct->length = $finedProduct->length;
	    	$newProduct->weight = $finedProduct->weight;
        	$newProduct->brandUrl = $finedProduct->brand->url;
        	$newProduct->url = $finedProduct->url;
        	$boughtProducts[$stock->id]->products[] = $newProduct;
        	
        	//var_dump($finedProduct);
        }
        
        //var_dump($boughtProducts);
        //var_dump($_SESSION['buyCart']);
        
        $newOrderId  = \App\Models\PaidOrder::findMaxId() + 1;
        
        $this->view->newOrderId = $newOrderId;
        $this->view->boughtProducts = $boughtProducts;
        
        $fio = explode(" ", $_SESSION['customer']->full_name);
        
        if(sizeof($fio) > 1) {
		    $this->view->surname = $fio[0];
		    $this->view->name = $fio[1];
		    $this->view->patronomic = $fio[2];
		    $this->view->number = $_SESSION['customer']->number;
		}
		
		//var_dump($_SESSION);
		//var_dump($_SESSION['customer']);
		$this->view->display(__DIR__ . '/../templates/checkout.php');
    }

    protected function actionSuccessefulOrder()
    {
        //var_dump($_SESSION);
        //var_dump($_SESSION['deliveryOrders']);
        
        $ordersId = [];
        $ordersJSON = [];
        
        if(is_array($_SESSION['deliveryOrders'])) {
            $this->view->orderId = $_SESSION['deliveryOrders'][sizeof($_SESSION['deliveryOrders'])-1]['tariffId'];
        }
        if($this->view->orderId !== NULL) {
            foreach($_SESSION['deliveryOrders'] as $order) {
                if($order["deliveryType"] == '1') {
                    $ordersId[] = $order["tariffId"] . ',true';
                } else {
                    $ordersId[] = $order["tariffId"] . ',false';
                }
                
                $ordersJSON[] = $order["orderJSON"];
                
                $newOrder = new \App\Models\PaidOrder();
                $newOrder->id  = $newOrder->findMaxId() + 1;
                $newOrder->userId  = $_SESSION['customer']->id;
                $newOrder->deliveryType = (int)$order["deliveryType"];
                $newOrder->tariffId = $order["tariffId"];
                $newOrder->tariffCost = (float)$order["tariffCost"];
                $newOrder->tariffCostWithUp = (float)$order["tariffCostWithUp"];
                $newOrder->courierCallCost = (int)$order["courierCallCost"];
                $newOrder->deliveryPointId = $order["deliveryPointId"];
                $newOrder->products = $order["products"];
                $newOrder->recepientFullName = $order["recepientFullName"];
                $newOrder->recepientPhone = $order["recepientPhone"];
                $newOrder->recepientCity = $order["recepientCity"];
                $newOrder->recepientStreet = $order["recepientStreet"];
                $newOrder->recepientHome = $order["recepientHome"];
                $newOrder->recepientOffice = $order["recepientOffice"];
                $newOrder->recipientCityGuid = $order["recipientCityGuid"];
                $newOrder->recepientDocumentType = $order["recepientDocumentType"];
                $newOrder->recepientDocumentNumber = $order["recepientDocumentNumber"];
                $newOrder->recepientDocumentSeries = $order["recepientDocumentSeries"];
                $newOrder->recepientDocumentDate = $order["recepientDocumentDate"];
                $newOrder->recepientComment = $order["recepientComment"];
                $newOrder->recepientWishes = $order["recepientWishes"];
                $newOrder->recepientQuestion = $order["recepientQuestion"];
                $newOrder->recepientEmail = $order["recepientEmail"];
                $newOrder->isSubscribed = $order["isSubscribed"];
                
                //var_dump($newOrder);
                
                $newOrder->insert();
            }
            
            $this->view->ordersId = $ordersId;
            $this->view->ordersJSON = $ordersJSON;
            
		    $this->view->display(__DIR__ . '/../templates/successefulOrder.php');
        } else {
            header('Location: home');
        }
    }
    
    protected function actionRegistration()
    {
		$this->view->display(__DIR__ . '/../templates/registration.php');
    }
    
    protected function actionAbout()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/about.php');
    }

    protected function actionDelivery()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/delivery.php');
    }

    protected function actionTypesOfDelivery()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/types-of-delivery.php');
    }


    protected function actionCooperation()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/cooperation.php');
    }

    protected function actionContacts()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/contacts.php');
    }
	
    protected function actionRequisites()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/requisites.php');
    }
	
    protected function actionForeignSuppliers()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/foreign-suppliers.php');
    }
	
    protected function actionFAQ()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/faq.php');
    }
	
    protected function actionPayment()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/payment.php');
    }
	
    protected function actionOnlinePaymentGuarantee()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/оnline-payment-guarantee.php');
    }
	
    protected function actionGarantiya()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/garantiya.php');
    }
	
    protected function actionTerms()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/terms.php');
    }
	
    protected function actionPrivacy()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/privacy.php');
    }
	
    protected function actionSitemap()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/sitemap.php');
    }
	
    protected function actionContactWithUs()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/contact-with-us.php');
    }
	
    protected function actionRefund()
    {
		$this->view->categories = \App\Models\Categories::findTablesByFieldNULL('parent_categoryId');
		
		foreach($this->view->categories as $category) {
			$category->categories = \App\Models\Categories::findTablesByField('parent_categoryId', $category->id);
		}
		
		$this->view->display(__DIR__ . '/../templates/refund.php');
    }

	protected function actionLogout()
    {
        require __DIR__ . '/logout.php';
    }
	
	protected function actionElse()
    {
        /*var_dump($this->cellUrl);
        var_dump($this->beforeSlashUrl);
        var_dump($this->afterSlashUrl);
        */
    	$brands = \App\Models\ShopProductBrand::findAll();
    	//var_dump($brands);
        $isBrand = 0;
        $isGood = 0;
        foreach($brands as $brand) {
        	if($this->cellUrl == $brand->url || $this->cellUrl == $brand->url . '/') {
        	    $isBrand = 1;
        	    $this->brand = $brand->url;
        		break;
        	}
        	
        	if($this->beforeSlashUrl == $brand->url && $this->afterSlashUrl !== '') {
        	    $isGood = 1;
        	    $this->brand = $brand->url;
        		break;
        	}
        }
        
        if($isBrand) {
            $this->actionBrand();
        } else if($isGood) {
            $this->actionGood();
        }/* else if($this->cellUrl == 'dumpbd764764335') {
            $this->actionDump();
        } else if($this->cellUrl == 'toFillProductsUrl') {
            $this->actionToFillProductsUrl();
        }*/  else if($this->cellUrl == 'sendMessageToSellersOpaPa782') {
            $this->sendMessageToSellers();
        } else {
            $this->actionError404();
        }
    }
    
	protected function actionBrand()
    {
        var_dump($this->brand);
    }
    
	protected function actionGood()
    {
        $markup = $this->view->markup;
        $goods = \App\Models\ShopProduct::findAll();
        
        foreach($goods as $good) {
           if($this->afterSlashUrl == $good->url) {
                $good->brand = \App\Models\ShopProductBrand::findById($good->brandId);
                $good->model = \App\Models\ShopProductModel::findById($good->modelId)->model;
                //$good->name = $good->typeProduct . ' ' . $good->brand->brand . ' ' . $good->model;
                if($good->brand->id == '1') {
    			    $good->name = $good->typeProduct . ' ' . $good->model;
    		    } else {
    		        $good->name = $good->typeProduct . ' ' . $good->brand->brand . ' ' . $good->model;
    		    }
                
			    $good->shop = \App\Models\Shop::findById($good->shopId);
			    
			    if($good->shop->url == NULL || $good->shop->url == "" || $good->shop->url == " ") {
			        $good->shop->url = "shop" . $good->shop->id;
			    }
			    
			    $shopImg = \App\Models\ImagesForShop::findTablesByTwoFields('shopId', $good->shopId, 'isCurrent', 1)[0];
			    if($shopImg != NULL) {
			        $good->shop->img = \App\Models\Images::findById($shopImg->imageId);
			    }
    			
    			$good->seller = \App\Models\Seller::findById($good->shop->sellerId);
    			if($good->seller->jurTypeId !==NULL) {
    				$good->seller->jurSelectedType = \App\Models\Seller::findTableByFk('seller_juridicalentitytypes', 'jurTypeId', $good->seller->id)[0]->type;
    			}
    			$good->seller->fio = \App\Models\User::findById($good->seller->userId)->full_name;
    			
    			$good->price = ceil($good->sellerPrice * $markup);
    			
                $goodDiscont = \App\Models\ShopProductDiscont::findCurrentDisconts('productId', $good->id)[0];
			    $good->newPrice = ceil($goodDiscont->newPrice * $markup);
		    	
		    	$good->maxOrder = $good->quantity;
		    	$good->minOrder = $good->minOrderQuantity;

    			$product_images = \App\Models\ShopProductImages::findTablesByField('productId', $good->id);
    			$good->images = [];
    			foreach($product_images as $img) {
    			    $finedImg = \App\Models\Images::findById($img->imageId);
    			    $finedImg->orderNumber = (int) $img->orderNumber;
    			    $finedImg = (array) $finedImg;
    			    $good->images[] = $finedImg;
    			}
    			
    			//var_dump($good->images);
    			
    			sortArrayByKey($good->images,"orderNumber");
    			
    			for($i = 0; $i < sizeof($good->images); $i++) {
    			    $img = $good->images[$i];
    			    $object = new \App\Models\Images();
                    foreach ($img as $key => $value)
                    {
                        $object->$key = $value;
                    }
                    
    			    $good->images[$i] = $object;
    			}
    			//var_dump($good->images);
    			
    			$stock = \App\Models\ShopStockRoom::findById($good->stockroomId);
    			$good->stock = \App\Models\Address::findById($stock->addressId);
    			
    			$productAtributes = \App\Models\ShopProductAtribute::findTablesByField('productId', $good->id);
    			
    			$productTypesOfAtributes = [];
    			$good->atributes = [];
    			
    			foreach($productAtributes as $atribut) {
    				$isItNewAtribut = true;
    				
    				foreach($productTypesOfAtributes as $type) {
    					if($atribut->type == $type) {
    						$isItNewAtribut = false;
    					}
    				}		
    
    				if($isItNewAtribut) {
    					$productTypesOfAtributes[] = $atribut->type;
    					$good->atributes[] = $atribut->type;
    				}
    			}
    			
    			foreach($productAtributes as $atribut) {
    				$typeIndex = array_search($atribut->type, $productTypesOfAtributes);
    				
    				$image = "";
    				
    				if($atribut->imageId != NULL) {
    					$image = \App\Models\Images::findById($atribut->imageId)->name;
    				}
    				
    				$good->atributes[$typeIndex] .= ",!," . $atribut->value . ",!," . $image . ",!," . $atribut->id;
    			}
        		
        		if(sizeof($good->atributes) == 0) {
    			    $isAdedToCart = \App\Models\BuyCartProducts::findTablesByTwoFields('buyCartId', $_SESSION['buyCart']->id, 'productId', $good->id)[0];
    			    
    			    if($isAdedToCart !== NULL) {
    			        $good->isAdedToCart = 1;
    			    }
    			} else {
    			    $goodsAddedToCart = \App\Models\BuyCartProducts::findTablesByTwoFields('buyCartId', $_SESSION['buyCart']->id, 'productId', $good->id);
    			    $strGoodsAtributes = '';
    			    
    			    foreach($goodsAddedToCart as $product) {
    			        $atributes = \App\Models\BuyCartProductAtributes::findTablesByField('buyCartProductsId', $product->id);
    			        
    			        foreach($atributes as $atribut) {
    			            $strGoodsAtributes .= $atribut->atributId . ',';
    			        }
    			        $strGoodsAtributes .= ']';
    			    }
    			    $good->strGoodsAtributes = $strGoodsAtributes;
    			}
    			
    		    $good->deliveryServices = \App\Models\ShopPointsAcceptaceOrders::findTablesByField('stockroomId', $stock->id);
        		
                $this->view->good = $good;
                break;
           }
        }
        
        if($this->view->good != NULL) {
            //var_dump($this->view->good);
            $this->view->display(__DIR__ . '/../templates/page-of-product.php');
        } else {
            $this->actionError404();
        }
    }
    
	protected function actionDump()
    {
        $isBad = 0;
        
    	$categories = [17 => 58, 18 => 242, 20 => 208, 24 => 117, 25 => 34, 33 => 197, 34 => 2, 57 => 141, 59 => 172, 60 => 38,
    	    61 => 23, 62 => 227, 63 => 42, 64 => 99, 65 => 89, 66 => 211, 67 => 154, 68 => 73, 69 => 235, 70 => 209,
    	    72 => 210, 75 => 243, 76 => 244, 77 => 245, 78 => 246, 79 => 247, 80 => 37, 90 => 218, 96 => 143, 97 => 144,
    	    98 => 145, 99 => 146, 100 => 147, 101 => 148, 102 => 149, 103 => 150, 104 => 151, 105 => 152, 106 => 153,
    	    114 => 235, 115 => 29, 119 => 180, 122 => 30, 123 => 31, 125 => 32, 126 => 33, 132 => 41, 134 => 40, 137 => 39,
    	    142 => 64, 143 => 60, 144 => 62, 145 => 63, 146 => 65, 147 => 67, 148 => 68, 149 => 69, 150 => 70, 151 => 71,
    	    152 => 118, 153 => 119, 154 => 120, 155 => 121, 156 => 122, 157 => 123, 158 => 124, 159 => 125, 160 => 126,
    	    161 => 127, 162 => 128, 163 => 129, 164 => 130, 165 => 131, 167 => 132, 168 => 133, 169 => 134, 170 => 198,
    	    171 => 199, 172 => 200, 173 => 201, 174 => 202, 175 => 203, 176 => 204, 177 => 205, 178 => 206, 179 => 4, 180 => 5,
    	    181 => 6, 182 => 7, 183 => 6, 184 => 7, 185 => 8, 186 => 9, 187 => 10, 188 => 11, 189 => 12, 190 => 15, 191 => 16,
    	    192 => 17, 193 => 174, 194 => 175, 195 => 176, 196 => 177, 197 => 178, 198 => 179, 199 => 180, 200 => 181, 201 => 182,
    	    202 => 183, 203 => 184, 204 => 185, 205 => 186, 206 => 187, 207 => 188, 208 => 189, 209 => 190, 210 => 191, 211 => 192,
    	    212 => 193, 213 => 194, 214 => 195, 923 => 3, 932 => 19, 924 => 22, 768 => 24, 767 => 25, 329 => 26, 762 => 27,
    	    897 => 28, 333 => 35, 891 => 43, 223 => 44, 225 => 45, 224 => 46, 229 => 47, 893 => 48, 892 => 49, 226 => 50, 227 => 51,
    	    894 => 53, 228 => 54, 231 => 55, 230 => 56, 303 => 247, 304 => 247, 305 => 247, 307 => 247, 308 => 247, 309 => 247,
    	    310 => 247, 311 => 247, 313 => 247, 314 => 247, 790 => 247, 905 => 59, 925 => 61, 928 => 66, 295 => 74, 293 => 75,
    	    282 => 76, 283 => 77, 284 => 78, 285 => 79, 286 => 80, 288 => 81, 287 => 82, 289 => 83, 290 => 84, 291 => 85,
    	    292 => 86, 294 => 87, 246 => 90, 247 => 91, 248 => 92, 250 => 94, 915 => 95, 251 => 96, 910 => 97, 233 => 100,
    	    234 => 101, 235 => 102, 236 => 103, 237 => 104, 238 => 105, 239 => 106, 240 => 107, 241 => 108, 242 => 109,
    	    243 => 110, 244 => 111, 245 => 112, 317 => 115, 904 => 116, 901 => 136, 906 => 137, 907 => 138, 909 => 139,
    	    908 => 140, 545 => 142, 533 => 155, 534 => 156, 532 => 157, 535 => 158, 536 => 159, 537 => 160, 538 => 161,
    	    540 => 162, 539 => 163, 542 => 164, 541 => 165, 543 => 166, 499 => 168, 930 => 169, 929 => 170, 273 => 171,
    	    931 => 173, 252 => 213, 253 => 244, 254 => 215, 255 => 216, 911 => 217, 257 => 219, 258 => 220, 259 => 221,
    	    260 => 222, 261 => 223, 262 => 224, 263 => 225, 312 => 226, 756 => 228, 215 => 229, 216 => 230, 217 => 231,
    	    218 => 232, 219 => 233, 407 => 236, 409 => 237, 804 => 238, 404 => 239, 403 => 240, 315 => 241];
    	
   //     session_start();
        
    	//OC
   // 	$customers = \App\Models\db2\User::findTablesByField('user_group_id', 17);
    	//$_SESSION['counter'] = 0;
    //	$i = $_SESSION['counter'];
   /* 	
    	foreach($customers as $customer) {
    //	for($i; $i < $i+10; $i++) {
    //	    $customer = $customers[19];
    		$customer->ocCustomer = \App\Models\db2\Customer::findTablesByField('email', $customer->email)[0];
    		
            if($customer->ocCustomer != NULL) {
    		    $customer->company = \App\Models\db2\Address::findTablesByField('customer_id', $customer->customer_id)[0]->company;
            } else {
                $ocFinedManufacturer = \App\Models\db2\Multivendor::findTablesByField('user_id', $customer->user_id);
                if(sizeof($ocFinedManufacturer) > 0) {
                    $ocManufacturerId = $ocFinedManufacturer[0]->manufacturer_id;
                    $customer->company = \App\Models\db2\Shop::findTablesByField('manufacturer_id', $ocManufacturerId)[0]->name;
                }
            }
            
            /*
        	$oc_categories = \App\Models\db2\Categories::findAll();
        	
        	$_SESSION['categories'] = \App\Models\Categories::findAll();
        	
        	foreach($_SESSION['categories'] as $category) {
        	    if(array_search($category->id, $categories) == false) {
        	        foreach($oc_categories as $oc_category) {
        	            if($oc_category->name == $category->name) {
        	                $categories[$oc_category->category_id] = intval($category->id);
        	            }
        	        }
        	    }
        	}
        	*/
    /*    	
    		$customer->ocManufacturers = \App\Models\db2\Multivendor::findTablesByField('user_id', $customer->user_id);
    		if(sizeof($customer->ocManufacturers) > 0) {
    		    foreach($customer->ocManufacturers as $ocManufact) {
    		        $ocManufacturerId = $ocManufact->manufacturer_id;
    		        
    		        $ocManufacturer = \App\Models\db2\Shop::findTablesByField('manufacturer_id', $ocManufacturerId)[0];
        	    	if($ocManufacturer != NULL) {
                		$ocManufacturer->ocManufacturerDesc = \App\Models\db2\ShopDescription::findTablesByField('manufacturer_id', $ocManufacturerId)[0];
                		
                		$ocManufacturer->urlShop = \App\Models\db2\Url::findTablesByField('query', 'manufacturer_id=' . $ocManufacturerId)[0]->keyword;
                		
                		if($ocManufacturer->urlShop == NULL) {
                		    $ocManufacturer->urlShop = \App\Models\db2\UrlCopy::findTablesByField('query', 'manufacturer_id=' . $ocManufacturerId)[0]->keyword;
                		    
                	    	if($ocManufacturer->urlShop == NULL) {
                	    	    $ocManufacturer->urlShop = \App\Models\db2\UrlSeo::findTablesByField('query', 'manufacturer_id=' . $ocManufacturerId)[0]->keyword;
                	    	}
                		}
                		
                        $ocManufacturer->oc_products = \App\Models\db2\Product::findTablesByField('manufacturer_id', $ocManufacturerId);
                		
                		foreach($ocManufacturer->oc_products as $oc_product) {
                		    $product_desc = \App\Models\db2\ProductDescription::findTablesByField('product_id', $oc_product->product_id)[0];
                		    $oc_product->description = $product_desc->description;
                		    $oc_product->name = $product_desc->name;
                		    $product_url = \App\Models\db2\Url::findTablesByField('query', 'product_id=' . $oc_product->product_id)[0]->keyword;
                		
                    		if($product_url == NULL) {
                    		    $product_url = \App\Models\db2\UrlCopy::findTablesByField('query', 'product_id=' . $oc_product->product_id)[0]->keyword;
                    		    
                    	    	if($product_url == NULL) {
                    	    	    $product_url = \App\Models\db2\UrlSeo::findTablesByField('query', 'product_id=' . $oc_product->product_id)[0]->keyword;
                    	    	}
                    		}
                    		
                    		$oc_product->url = $product_url;
                    		
                    		$productMainCategory = \App\Models\db2\ProductToCategory::findTablesByField('product_id', $oc_product->product_id)[0]->main_category;
                		    $oc_product->mainCategory = $categories[$productMainCategory];
                		    
                    		$oc_product->productCategories = \App\Models\db2\ProductToCategory::findTablesByField('product_id', $oc_product->product_id);
                    		
                    		$oc_product->productAttributes = \App\Models\db2\ProductAttribute::findTablesByField('product_id', $oc_product->product_id);
                    		
                    		if(sizeof($oc_product->productAttributes) > 0) {
                    		    foreach($oc_product->productAttributes as $atr) {
                    		        $atr->value = $atr->text;
                    	            $atr->type = \App\Models\db2\ProductAttributeDescription::findTablesByField('attribute_id', $atr->attribute_id)[0]->name;
                    		    }
                    		}
                    		
                    		$oc_product->oc_productImages = \App\Models\db2\ProductImages::findTablesByField('product_id', $oc_product->product_id);
                		}
                	    
        	    	}
                    $ocManufact->ocManufacturer = $ocManufacturer;
    		    }
    		}
                        
   // 	    $_SESSION['customers'][$i] = $customer;
    	}
    	
    	
    */
        $filename = 'sellers.txt';

        // Запись.
/*        $data = serialize($customers);      // PHP формат сохраняемого значения.
        file_put_contents($filename, $data);
   */  
        $data = file_get_contents($filename);
        $customers = unserialize($data);
 //       var_dump($bookshelf[18]);
        
   //     $_SESSION['counter'] = $i;
  //      $_SESSION['customers'] = $customers;
        //*/
    	
    	
    	//BD
    	
    //    $customers = $_SESSION['customers'];
        
        foreach($customers as $customer) {
            $newUser = new \App\Models\User();
            
    		$newId = $newUser->findMaxId() + 1;
    		$newUser->id = $newId;
    		$newUser->full_name = $customer->lastname . ' ' . $customer->firstname;
    		$newUser->login = $customer->email;
    		$newUser->email = $customer->email;
    		$newUser->password = $customer->password;
    		$newUser->typeofuser_id = 3;
    		if($newUser->insert() == false) {
    		    var_dump('user false');
    		    var_dump($newUser);
    		    //return;
    		}
            
    		if($customer->ocCustomer != NULL) {
                $newContact = new \App\Models\Contact();
        		$newId = $newContact->findMaxId() + 1;
        		$newContact->id = $newId;
        		$newContact->typeId = 1;
        		$newContact->contact = $customer->ocCustomer->telephone;
        		$newContact->insert();
        		
        		$userContact = new \App\Models\UserContacts();
        		$newId = $userContact->findMaxId() + 1;
        		$userContact->id = $newId;
        		$userContact->userId = $newUser->id;
        		$userContact->contactId = $newContact->id;
        		$userContact->insert();
    		}
    		
    		$newSeller = new \App\Models\Seller();
    		$newId = $newSeller->findMaxId() + 1;
    		$newSeller->id = $newId;
    		$newSeller->userId = $newUser->id;
    		$newSeller->jurName = $customer->company;
    		if($newSeller->jurName == NULL) {
    		    $newSeller->jurName = ' ';
    		}
    		
    		$newAddress1 = new \App\Models\Address();
    		$newId = $newAddress1->findMaxId() + 1;
    		$newAddress1->id = $newId;
    		$newAddress1->country = ' ';
    		$newAddress1->region = ' ';
    		$newAddress1->city = ' ';
    		$newAddress1->street = ' ';
    		$newAddress1->home = ' ';
    		$newAddress1->insert();
    		
    		$newAddress2= new \App\Models\Address();
    		$newId = $newAddress2->findMaxId() + 1;
    		$newAddress2->id = $newId;
    		$newAddress2->country = ' ';
    		$newAddress2->region = ' ';
    		$newAddress2->city = ' ';
    		$newAddress2->street = ' ';
    		$newAddress2->home = ' ';
    		$newAddress2->insert();
    		
    		$newSellerRequsites = new \App\Models\SellerRequisites();
    		$newId = $newSellerRequsites->findMaxId() + 1;
    		$newSellerRequsites->id = $newId;
    		$newSellerRequsites->bank = ' ';
    		$newSellerRequsites->currentAccountNumber = ' ';
    		$newSellerRequsites->correspondentAccountNumber = ' ';
    		$newSellerRequsites->BIK = ' ';
    		$newSellerRequsites->INN = ' ';
    		$newSellerRequsites->juridicalAddressId = $newAddress1->id;
    		$newSellerRequsites->facticalAddressId = $newAddress2->id;
    		$newSellerRequsites->insert();
    		
    		$newSeller->requisitesId = $newSellerRequsites->id;
    		
    		if($customer->ocCustomer != NULL) {
    		$newSeller->isSubscribed = $customer->ocCustomer->newsletter;
    		}
    		$newSeller->isIncluded = $customer->status;
    		$newSeller->isTrading = $customer->perm_to_sell;
    		$newSeller->statusOfTrading = $customer->perm_to_sell_er_text;
    		$newSeller->bankCode = $customer->payu_merchant_id;
    		if($newSeller->insert() == false) {
    		    var_dump('seller false');
                var_dump($newSeller);
    		}
    		
    		$newShop = new \App\Models\Shop();
    		
    		if(sizeof($customer->ocManufacturers) > 0) {
    		    foreach($customer->ocManufacturers as $ocManufact) {
    		        $ocManufacturer = $ocManufact->ocManufacturer;
        	    	if($ocManufacturer != NULL) {
                		
                		$newId = $newShop->findMaxId() + 1;
                		$newShop->id = $newId;
                		$newShop->name = $ocManufacturer->name;
                		$newShop->description = $ocManufacturer->ocManufacturerDesc->meta_description;
                		
                		$newShop->url = $ocManufacturer->urlShop;
                		$newShop->sellerId = $newSeller->id;
                		$newShop->isIncluded = $ocManufacturer->status;
                		if($newShop->insert() == false) {
                		    var_dump('shop false');
                		    var_dump($newShop);
                		}
                		
                		$oc_manufacturerImage = $ocManufacturer->image;
                		
                		if($oc_manufacturerImage != NULL) {
                		    $pos = strrpos($oc_manufacturerImage, '/');
                            $imgPath = mb_substr($oc_manufacturerImage, 0, $pos+1, 'UTF-8');
                            $imgName = mb_substr($oc_manufacturerImage, $pos+1, NULL, 'UTF-8');
                		    
                    		$newShopImage = new \App\Models\Images();
                    		$newId = $newShopImage->findMaxId() + 1;
                    		$newShopImage->id = $newId;
                    		$newShopImage->name = $imgName;
                    		$newShopImage->url = $imgPath;
                    		$newShopImage->insert();
                    		
                    		$newImageToShop = new \App\Models\ImagesForShop();
                    		$newId = $newImageToShop->findMaxId() + 1;
                    		$newImageToShop->id = $newId;
                    		$newImageToShop->shopId = $newShop->id;
                    		$newImageToShop->imageId = $newShopImage->id;
                    		$newImageToShop->isCurrent = 1;
                    		$newImageToShop->insert();
                		}
                		
                		$newAddress3= new \App\Models\Address();
                		$newId = $newAddress3->findMaxId() + 1;
                		$newAddress3->id = $newId;
                		$newAddress3->country = ' ';
                		$newAddress3->region = ' ';
                		$newAddress3->city = ' ';
                		$newAddress3->street = ' ';
                		$newAddress3->home = ' ';
                    	$newAddress3->insert();
                		
                        $newContact2 = new \App\Models\Contact();
                		$newId = $newContact2->findMaxId() + 1;
                		$newContact2->id = $newId;
                		$newContact2->typeId = 1;
                		$newContact2->contact = ' ';
                    	$newContact2->insert();
                		
                		$shopStock = new \App\Models\ShopStockRoom();
                		$newId = $shopStock->findMaxId() + 1;
                		$shopStock->id = $newId;
                		$shopStock->sellerId = $newSeller->id;
                		$shopStock->addressId = $newAddress3->id;
                		$shopStock->contactId = $newContact2->id;
                    	$shopStock->insert();
                        
                		foreach($ocManufacturer->oc_products as $oc_product) {
                    		$newProduct = new \App\Models\ShopProduct();
                    		$newId = $newProduct->findMaxId() + 1;
                    		$newProduct->id = $newId;
                    		$newProduct->description = $oc_product->description;
                    		$newProduct->url = $oc_product->url;
                    		$newProduct->typeProduct = $oc_product->name;
                    		$newProduct->brandId = 1;
                    		
                    		$newProductModel = new \App\Models\ShopProductModel();
                    		$newId = $newProductModel->findMaxId() + 1;
                    		$newProductModel->id = $newId;
                    		$newProductModel->brandId = 1;
                    		$newProductModel->model = ' ';
                        	$newProductModel->insert();
                    		
                    		$newProduct->modelId = $newProductModel->id;
                    		$newProduct->stockCode = $oc_product->sku;
                    		$newProduct->sellerPrice = $oc_product->price;
                    		$newProduct->quantity = $oc_product->quantity;
                    		$newProduct->minOrderQuantity = $oc_product->minimum;
                    		
                    		$isInStock = 1;
                    		if($oc_product->stock_status_id == 5) {
                    		    $isInStock = 0;
                    		}
                    		
                    		$newProduct->isInStock = $isInStock;
                    		$newProduct->length = $oc_product->length;
                    		$newProduct->width = $oc_product->width;
                    		$newProduct->height = $oc_product->height;
                    		
                    		$weight = $oc_product->weight;
                    		if($oc_product->weight_class_id == 1) {
                    		    $weight = $weight*1000;
                    		} else if($oc_product->weight_class_id == 5) {
                    		     $weight = 1000*($weight/2.2);
                    		} else if($oc_product->weight_class_id == 6) {
                    		     $weight = 1000*($weight/35.27);
                    		}
                    		
                    		$newProduct->weight = $weight;
                    		
                    		$newProduct->isIncluded = $oc_product->status;
                    		$newProduct->mainCategoryId = $oc_product->mainCategory;
                    		$newProduct->stockroomId = $shopStock->id;
                    		$newProduct->shopId = $newShop->id;
                        	if($newProduct->insert() == false) {
                        	    var_dump('product false');
                        	    var_dump($newProduct);
                        	}
                        	
                    		foreach($oc_product->productCategories as $pCategory) {
                    		    $finedCategoryId = $categories[$pCategory->category_id];
                    		    if($finedCategoryId != NULL) {
                            		$newShowProductInCategory = new \App\Models\ShopProductShowInCategories();
                            		$newId = $newShowProductInCategory->findMaxId() + 1;
                            		$newShowProductInCategory->id = $newId;
                            		$newShowProductInCategory->productId = $newProduct->id;
                                	$newShowProductInCategory->categoryId = $finedCategoryId;
                                	$newShowProductInCategory->insert();
                    		    }
                    		}
                    		
                    		if(sizeof($oc_product->productAttributes) > 0) {
                    		    foreach($oc_product->productAttributes as $atr) {
                            		$newProductAttr = new \App\Models\ShopProductAtribute();
                            		$newId = $newProductAttr->findMaxId() + 1;
                            		$newProductAttr->id = $newId;
                            		$newProductAttr->type = $atr->type;
                            		$newProductAttr->value = $atr->value;
                                	$newProductAttr->insert();
                    		    }
                    		}
                    		
                    		$oc_productImage = $oc_product->image;
                		
                    		if($oc_productImage != NULL) {
                    		    $pos = strrpos($oc_productImage, '/');
                                $imgPath = mb_substr($oc_productImage, 0, $pos+1, 'UTF-8');
                                $imgName = mb_substr($oc_productImage, $pos+1, NULL, 'UTF-8');
                    		
                        		$newProductImage = new \App\Models\Images();
                        		$newId = $newProductImage->findMaxId() + 1;
                        		$newProductImage->id = $newId;
                        		$newProductImage->name = $imgName;
                        		$newProductImage->url = $imgPath;
                                $newProductImage->insert();
                        		
                        		$newImageToProduct = new \App\Models\ShopProductImages();
                        		$newId = $newImageToProduct->findMaxId() + 1;
                        		$newImageToProduct->id = $newId;
                        		$newImageToProduct->productId = $newProduct->id;
                        		$newImageToProduct->imageId = $newProductImage->id;
                        		$newImageToProduct->orderNumber = 1;
                                $newImageToProduct->insert();
                    		}
                    		
                    		if($oc_product->oc_productImages != NULL) {
                    		    foreach($oc_product->oc_productImages as $pImage) {
                    		        $image = $pImage->image;
                        		    $pos = strrpos($image, '/');
                                    $imgPath = mb_substr($image, 0, $pos+1, 'UTF-8');
                                    $imgName = mb_substr($image, $pos+1, NULL, 'UTF-8');
                                    
                            		$newProductImage = new \App\Models\Images();
                            		$newId = $newProductImage->findMaxId() + 1;
                            		$newProductImage->id = $newId;
                            		$newProductImage->name = $imgName;
                            		$newProductImage->url = $imgPath;
                                    $newProductImage->insert();
                            		
                            		$newImageToProduct = new \App\Models\ShopProductImages();
                            		$newId = $newImageToProduct->findMaxId() + 1;
                            		$newImageToProduct->id = $newId;
                            		$newImageToProduct->productId = $newProduct->id;
                            		$newImageToProduct->imageId = $newProductImage->id;
                            		$newImageToProduct->orderNumber = 1;
                                    $newImageToProduct->insert();
                    		    }
                    		}
                		}
                	}
                    $ocManufact->ocManufacturer = $ocManufacturer;
    		    }
    		}
        }
        
        //var_dump($categories);
        //var_dump($_SESSION['categories']);
        
        
 //       var_dump($_SESSION['customers']);
        echo "Не Uhjbc";
    }
    
    protected function actionToFillProductsUrl()
    {
        $emptyUrls = \App\Models\ShopProduct::findTablesByFieldNULL('url');
        
        for($i = 0; $i < sizeof($emptyUrls); $i++) {
            $id = $emptyUrls[$i]->id;
            $url = transliterate($emptyUrls[$i]->typeProduct);
            
            \App\Models\ShopProduct::setValueToTable($id, 'url', $url);
        }
    }
    
	protected function sendMessageToSellers()
    {
        $sellers = \App\Models\User::findTablesByField('typeofuser_id', 3);
        //var_dump($sellers);
        $i = 0;
        foreach($sellers as $seller) {
            echo $seller->email . ",";
            if($i % 30 == 0) {
                echo "\n";
            }
            $i++;
            /*
            $seller = $sellers[0];
            $seller->email = "gwelbts@gmail.com";
            var_dump($seller);
            $to  = "<" . $seller->email . ">";

            $subject = "Saterno. Письмо с данными для входа в админку."; 
            
            $message = "Добрый день, " . $seller->full_name . "!<br><br>";
            $message .= "Это автоматическое письмо, всем зарегистрированным поставщикам маркетплейса Сатерно www.saterno.ru<br>
            Наш интернет-магазин завершает стадию редизайна и изменения условий доставки товара. <br><br>
            Мы выходим на новый уровень работы, и в ближайшее время начинаем активные рекламные компании:<br>
            как по поставщикам и по товарам в отдельности, так и по интернет-магазину в целом!<br><br>
            С 1 января поменялись и условия продажи товаров в России через интернет, поэтому для того, чтоб мы начали рекламную компанию по Вашему магазину или товару, Вы должны проверить правильность размещения Вашего товара и конкретно магазина (склада, откуда будет осуществляться доставка).<br><br>
            Все те магазины, которые приведут в соответствие с новым законом свои магазины будут поставлены в очередь на рекламные кампании, за счет Сатерно!<br><br>
            И так: если Вы решите всё-таки довериться Сатерно, остаться с нами и попробовать работать с новыми силами, Вам нужно:<br>
            Указать в личном кабинете Ваш склад товара (т. е. место, откуда можно забирать Ваш товар). Наша система теперь сможет принимать оплату доставки в момент покупки товара. Но для этого системе нужно знать, где расположен Ваш товар. Вы указываете свой склад (адрес товара) и привязываете к нему весь или частично товар  (для этого там есть специальная кнопка, при нажатии на которую весь ваш товар будет привязан к одному складу). Можно создать не один склад и к разным складам привязать разный Ваш товар. Тогда покупатель, добавив Ваш товар в корзину сразу сможет оплатить и товар, и его доставку. К Вам на склад или курьер приедет и заберет товар, или Вы отвезете товар до ближайшего для вас пункта приема товара.<br>
            После указания адреса склада также рекомендуем указать пункт приёма товаров и выбрать доставку от пункта приёма. Особенно это касается продавцов с товарами с небольшой ценой. В этом случае вам придётся самим доставлять товар до пункта приёма, но тогда цена за доставку будет намного меньше и это хорошо скажется на продажах. <br>
            Проверить наличие всего товара, есть ли у товара фотографии, привязан ли к нему склад, его размеры, вес, количество, и цену. Без этого товар не сможет быть продан.<br>
            Проверить наличие логотипа у ваших магазинов, их описание.<br><br>
            
            	Если у Вас большой ассортимент мы можем обсудить выставление рекламы  	Вашего товара, рубрики или магазина на главной странице Сатерно 	www.saterno.ru<br><br>
            Ваши данные для входа в личный кабинет админки Сатерно:<br>
            Логин : " . $seller->login . "<br>
            Пароль: " . $seller->password . "<br>
            Перейти в личный кабинет админки Сатерно можно по ссылке https://saterno.ru/admin <br>
            Пароль можно будет поменять в личном кабинете <br><br>
            
            Как только Вы приведёте свои магазины в должный вид, оформите адреса складов (расположения товара), выберите ближайшие к ним пункты приёма заказов, привяжете к ним ваши товары, проверите наличие всего товара, есть ли у товара фотографии, привязан ли к нему склад, его размеры, вес, количество, и цену, команда Сатерно подключает ваши магазины в рекламные кампании и начинаем продвигать все ваши товары, работая в полную силу.<br><br>
            
            Все справки по:<br>
            техническому оформлению магазина, <br>
            заведению склада, <br>
            выкладке товара, <br>
            а также по удалению Вас с Сатерно навсегда, <br>
            Вы можете получить по электронной почте: gleb@saterno.ru <br>
            Вопросы по сотрудничеству: shopsaterno@yandex.ru +7-918-608-69-29";
                        
            $headers  = "Content-type: text/html; charset=utf-8 \r<br>"; 
            $headers .= "From: От кого письмо <admin@saterno.ru>\r<br>"; 
            $headers .= "Reply-To: ". $seller->email . "\r<br>"; 
            
            if(mail($to, $subject, $message, $headers)) {
            	echo 1;
            } else {
                echo 0;
            }*/
        }
    }
    
	protected function actionError404()
    {
        echo "Не удалось найти данную страницу. ((";
    }

}

function transliterate($string) {
    $roman = array("Sch","sch",'Yo','Zh','Kh','Ts','Ch','Sh','Yu','ya','yo','zh','kh','ts','ch','sh','yu','ya','A','B','V','G','D','E','Z','I','Y','K','L','M','N','O','P','R','S','T','U','F','','Y','','E','a','b','v','g','d','e','z','i','y','k','l','m','n','o','p','r','s','t','u','f','','y','','e', '', '_');
    $cyrillic = array("Щ","щ",'Ё','Ж','Х','Ц','Ч','Ш','Ю','я','ё','ж','х','ц','ч','ш','ю','я','А','Б','В','Г','Д','Е','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Ь','Ы','Ъ','Э','а','б','в','г','д','е','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','ь','ы','ъ','э', '&quot;', ' ');
    return str_replace($cyrillic, $roman, $string);
}

function sortArrayByKey(&$array,$key,$string = false,$asc = true){
    if($string){
        usort($array,function ($a, $b) use(&$key,&$asc)
        {
            if($asc)    return strcmp(strtolower($a{$key}), strtolower($b{$key}));
            else        return strcmp(strtolower($b{$key}), strtolower($a{$key}));
        });
    }else{
        usort($array,function ($a, $b) use(&$key,&$asc)
        {
            if($a[$key] == $b{$key}){return 0;}
            if($asc) return ($a{$key} < $b{$key}) ? -1 : 1;
            else     return ($a{$key} > $b{$key}) ? -1 : 1;

        });
    }
}