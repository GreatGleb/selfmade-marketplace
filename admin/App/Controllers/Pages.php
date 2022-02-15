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
    }

    protected function actionIndex()
    {
        $this->view->title = 'Мой крутой сайт!';
		$this->signin();
    }
	
	protected function signin()
    {
		session_start();
		
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		
		$error_fields = [];

		if ($login === '') {
			$error_fields[] = 'login';
		} 
		if ($password === '') {
			$error_fields[] = 'password';
		}
		
		if (!empty($error_fields)) {
			$_SESSION['errors'] = [
				'message' => "Проверьте правильность полей",
				'fields' => $error_fields
			];
			
			$_SESSION['dataOfSign'] = [
				'login' => $login,
				'password' => $password
			];
			
			$this->view->display(__DIR__ . '/../templates/signin.php');
		}
		else {
			$check_user = $this->view->signin = \App\Models\Signin::findByLoginAndPassword($login, $password);
			
			if ($check_user > 0) {
				$typeofuser = \App\Models\TypeOfUsers::findTypeOfUsers($check_user->id)->type;
				
				if($typeofuser == 'Admin' || $typeofuser == 'Seller') {
					$avatar = $this->view->avatar = \App\Models\ImagesForAdmin::findCurrentImageByTableId($check_user->id, 'UserId');
					
					$_SESSION['user'] = [
						"id" => $check_user->id,
						"login" => $login,
						"password" => $password,
						"full_name" => $check_user->full_name,
						"email" => $check_user->email,
						"avatar_name" => $avatar->name,
						"avatar_url" => $avatar->url,
						"typeofuser_id" => $check_user->typeofuser_id,
						"isfounder" => $check_user->isfounder,
						"date_added" => $check_user->date_added
					];
					
					$_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
					
					$this->view->user = [
						"id" => $check_user->id,
						"login" => $login,
						"password" => $password,
						"full_name" => $check_user->full_name,
						"email" => $check_user->email,
						"avatar_name" => $avatar->name,
						"avatar_url" => $avatar->url
					];
					
					if($avatar == null) {
						$_SESSION['user']["avatar_name"] = "user.png";
						$_SESSION['user']["avatar_url"] = "App/templates/files/img/accounts/";
						$this->view->user["avatar_name"] = "user.png";
						$this->view->user["avatar_url"] = "App/templates/files/img/accounts/";
					}
					
					$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
					$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
					
					if ($_SESSION['url'] !== NULL) {
						header('Location: ' . $_SESSION['url']);					
					} else {
						header('Location: profile');
					}
				} else {
					if($_POST['login'] !== NULL) {
						$_SESSION['message'] = 'Не верный логин или пароль';
						
						$_SESSION['dataOfSign'] = [
							'login' => $login,
							'password' => $password
						];
					}
					
					$this->view->display(__DIR__ . '/../templates/signin.php');
				}
			} else {
				if($_POST['login'] !== NULL) {
					$_SESSION['message'] = 'Не верный логин или пароль';
					
					$_SESSION['dataOfSign'] = [
						'login' => $login,
						'password' => $password
					];
				}
				
				$this->view->display(__DIR__ . '/../templates/signin.php');
			}
		}
    }

    protected function actionUsers()
    {
		session_start();
		
		$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
		$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;			
		
		$this->view->users = \App\Models\User::findAll();
		
		foreach ($this->view->users as $user) {
			$user->typeofuser = \App\Models\TypeOfUsers::findTypeOfUsers($user->id)->type;
		}
		
		$AllTypesOfUsers = \App\Models\TypeOfUsers::findAll();
		$typesOfUsers = array();
		
		foreach ($AllTypesOfUsers as $typeOfUsers) {
			$typesOfUsers[] = $typeOfUsers->type;
		}
		
		$this->view->typesOfUsers = $typesOfUsers;
        $this->view->title = 'Мой крутой сайт!';
		
		$this->view->display(__DIR__ . '/../templates/users.php');
		//var_dump($_SESSION['user']);
    }
	
    protected function actionCategories()
    {
		session_start();
		$this->view->categories = \App\Models\Categories::findAll();
				
		foreach ($this->view->categories as $category) {
			$category->parent_category = \App\Models\Categories::findById($category->parent_categoryId)->name;
			
			$image = \App\Models\ImagesForCategory::findCurrentImageByTableId($category->id, 'categoryId');
			
			$category->imageName = $image->name;
			$category->imageUrl = $image->url;
			
			if($category->isShow == "0") {
				$category->isShow = "Выключено";
			} else  {
				$category->isShow = "Включено";
			}
			
			$arr = array(
				0  => $category->name,
				1  => $category->id,
			);
			$categoriesNameAndId[] = $arr;
		}
		
		$this->view->categoriesNameAndId = $categoriesNameAndId;
		
		$this->view->categoriesImages = $this->getImages('ImagesForCategory');
				
		$this->view->display(__DIR__ . '/../templates/categories.php');
    }
	
    protected function actionSellers()
    {
		session_start();
		
		$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
		$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

		$this->view->sellers = \App\Models\Seller::findAll();
		
		foreach($this->view->sellers as $seller) {
			
			if($seller->jurTypeId !==NULL) {
				$seller->jurSelectedType = \App\Models\Seller::findTableByFk('seller_juridicalentitytypes', 'jurTypeId', $seller->id)[0]->type;
			}
			
			$seller->jurAddress = \App\Models\SellerRequisites::findTableByFk('addresses', 'juridicalAddressId', $seller->requisitesId)[0];
			$seller->factAddress = \App\Models\SellerRequisites::findTableByFk('addresses', 'facticalAddressId', $seller->requisitesId)[0];
			
			$dataSellers = \App\Models\User::findById($seller->userId);
			
			$seller->full_name = $dataSellers->full_name;
			$seller->email = $dataSellers->email;
			$seller->date_added = $dataSellers->date_added;
			
			$seller->img = \App\Models\ImagesForAdmin::findCurrentImageByTableId($seller->userId, 'UserId');
			
			if($seller->img !== NULL) {
				$seller->img->name = $seller->img->name;
				$seller->img->url = $seller->img->url;
			}
			
			$requisitesSellers = \App\Models\SellerRequisites::findById($seller->requisitesId);
			
			foreach ($requisitesSellers as $prop => $value) {
				if($prop !== "id") {
					$seller->$prop = $value;
				}
			}
			
			//$shopId = \App\Models\Shop::findTablesByField('sellerId', $seller->id)[0]->id;
			//$phones = \App\Models\ShopContact::findTableByForegnKeyFromOtherTable("contacts", "contactId", "shopId", $shopId, 'typeId', 'contacts_type', 'type', 'phone');
			
			$phones = \App\Models\UserContacts::findTableByForegnKeyFromOtherTable("contacts", "contactId", "userId", $seller->userId, 'typeId', 'contacts_type', 'type', 'phone');
			$seller->phones = $phones;
		}
		
		$this->view->entitytypes = \App\Models\SellerJuridicEntityType::findAll();
		
		$this->view->images = $this->getImages('ImagesForAdmin');
		//var_dump($this->view->images);
				
		$this->view->display(__DIR__ . '/../templates/sellers.php');
    }
	
    protected function actionShops()
    {
		session_start();
		
		$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
		$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
		
		if($_SESSION['user']["typeofuser"] == 'Seller') {
			$seller = \App\Models\Seller::findTablesByField('userId', $_SESSION['user']['id'])[0];
			$sellerId = $seller->id;
			$this->view->jurName = $seller->jurName;
			$this->view->shops = \App\Models\Shop::findTablesByField('sellerId', $sellerId);
			$shopsImages = [];
			
			foreach($this->view->shops as $shop) {
			    $imagesForShop = \App\Models\ImagesForShop::findTablesByField('shopId', $shop->id);
			    
			    foreach($imagesForShop as $imageForShop) {
			        $shopsImages[] = \App\Models\Images::findById($imageForShop->imageId);
			    }
			}
			
			$imagesArray = [];

    		foreach ($shopsImages as $object) {
    			$valuesArray = [];
    			foreach ($object as $prop => $value) {
    				$valuesArray[$prop] = $value;
    			}
    			$imagesArray[] = $valuesArray;
            }
			
			$this->view->images = $imagesArray;
		} else {
			$this->view->shops = \App\Models\Shop::findAll();
			$this->view->images = $this->getImages('ImagesForShop');
		}
		
		foreach($this->view->shops as $shop) {
			$shop->seller = \App\Models\Seller::findById($shop->sellerId);
			$shop->user = \App\Models\User::findById($shop->seller->userId);
			$shop->img = \App\Models\ImagesForShop::findCurrentImageByTableId($shop->id, 'shopId');
			
			$shop->phones = \App\Models\ShopContact::findTableByForegnKeyFromOtherTable("contacts", "contactId", "shopId", $shop->id, 'typeId', 'contacts_type', 'type', 'phone');
			
			if($shop->seller->jurTypeId !==NULL) {
				$shop->seller->jurSelectedType = \App\Models\Seller::findTableByFk('seller_juridicalentitytypes', 'jurTypeId', $shop->seller->id)[0]->type;
			}
		}
		
		//$this->view->images = $this->getImages('ImagesForShop');
		
		//var_dump($this->view->images);
				
		$this->view->display(__DIR__ . '/../templates/shops.php');
    }
	
    protected function actionStockrooms()
    {
		session_start();
		
		$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
		$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;

		if($_SESSION['user']["typeofuser"] == 'Seller') {
			$seller = \App\Models\Seller::findTablesByField('userId', $_SESSION['user']['id'])[0];
			$sellerId = $seller->id;
			$this->view->stockrooms = \App\Models\ShopStockRoom::findTablesByField('sellerId', $sellerId);
			$this->view->jurName = $seller->jurName;
		} else {
			$this->view->stockrooms = \App\Models\ShopStockRoom::findAll();
		}
		
		foreach($this->view->stockrooms as $stockroom) {
			$stockroom->seller = \App\Models\Seller::findById($stockroom->sellerId);
			if($stockroom->seller->jurTypeId !==NULL) {
				$stockroom->seller->jurSelectedType = \App\Models\Seller::findTableByFk('seller_juridicalentitytypes', 'jurTypeId', $stockroom->seller->id)[0]->type;
			}
			$stockroom->user = \App\Models\User::findById($stockroom->seller->userId);
			$stockroom->address = \App\Models\Address::findById($stockroom->addressId);
			
			$stockroom->phone = \App\Models\Contact::findById($stockroom->contactId)->contact;
			
			$listOfPvz = \App\Models\ShopPoinsAcceptaceOrders::findTablesByField('stockroomId', $stockroom->id);
			$strPVZ = "";
			
			if(is_array($listOfPvz)) {
    			foreach($listOfPvz as $pvz) {
    			    $strPVZ .= $pvz->deliveryId . ",|," . $pvz->pvzId . "]]]";
    			}
			}
			
			$stockroom->listOfPVZ = $strPVZ;
		}
				
		$this->view->display(__DIR__ . '/../templates/stockrooms.php');
    }
	
    protected function actionGoods()
    {
		session_start();
		//var_dump($_SESSION);
		$_SESSION['user']["typeofuser"] = \App\Models\TypeOfUsers::findTypeOfUsers($_SESSION['user']['id'])->type;
		$_SESSION['user']["isblocked"] = \App\Models\User::findIsBlockedOfUser($_SESSION['user']['id'])->isblocked;
        
        if($_SESSION['user']["isblocked"] == '1') {
            return;
        }
        
        $this->view->numberOfProducts = 0;
        
		if($_SESSION['user']["typeofuser"] == 'Seller') {
			$products = [];
			
			$sellerId = \App\Models\Seller::findTablesByField('userId', $_SESSION['user']['id'])[0]->id;
			$shops = \App\Models\Shop::findTablesByField('sellerId', $sellerId);
			
			$strShops = "";
			
			for($j = 0; $j < sizeof($shops); $j++) {
			    $shop = $shops[$j];
			    //var_dump($shop);
				$shopProducts = \App\Models\ShopProduct::findTablesByField('shopId', $shop->id);
				
				$this->view->numberOfProducts += sizeof($shopProducts);
				
				for($i = 0; sizeof($products) < 10; $i++) { //$shopProducts
				    if($shopProducts[$i] == NULL) {
        		        break;
        		    }
				    $product = $shopProducts[$i];
				    if($product != NULL) {
					    $products[] = $product;
				    }
				}
				
				$strShops .= $shop->id . ",|," . $shop->name;			
				$strShops .= "]]]";
			}
			
			$this->view->products = $products;
			//var_dump(sizeof($this->view->products));
			$this->view->listShops = $strShops;
		} else {
		    $products = [];
		    
			$allProducts = \App\Models\ShopProduct::findAll();
		    
		    for($i = 0; sizeof($products) < 10; $i++) { //$shopProducts
			    $product = $allProducts[$i];
			    if($product != NULL) {
				    $products[] = $product;
			    }
			}
				
			$this->view->numberOfProducts += sizeof($allProducts);
			$this->view->products = $products;
		}
		
		//var_dump($_SESSION['user']["id"]);
		//var_dump($_SESSION['user']["typeofuser"]);
		//var_dump(sizeof($this->view->products));
		
		$markup = \App\Models\ShopProductMarkup::findById(1)->markup;
		
		foreach($this->view->products as $product) {
			
			$product->brand = \App\Models\ShopProductBrand::findById($product->brandId);
			$product->model = \App\Models\ShopProductModel::findById($product->modelId)->model;
			
			$product->shop = \App\Models\Shop::findById($product->shopId);
			
			$product->seller = \App\Models\Seller::findById($product->shop->sellerId);
			if($product->seller->jurTypeId !==NULL) {
				$product->seller->jurSelectedType = \App\Models\Seller::findTableByFk('seller_juridicalentitytypes', 'jurTypeId', $product->seller->id)[0]->type;
			}
			$product->seller->fio = \App\Models\User::findById($product->seller->userId)->full_name;
			
			$product->systemPrice = $product->sellerPrice * $markup;
			
			$product->product_images = \App\Models\ShopProductImages::findTablesByField('productId', $product->id);
			
			$product->product_image = \App\Models\ShopProductImages::findRecordWithMinField('orderNumber', 'productId', $product->id);
			$product->image = \App\Models\Images::findById($product->product_image->imageId);
			
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
			//var_dump($product->category);
			
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
					$target_dir = $target_dir . "//";
					
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
				
				$product->atributes[$typeIndex] .= ",!," . $atribut->value . ",!," . $image;
			}
			
			$productDisconts = \App\Models\ShopProductDiscont::findTablesByField('productId', $product->id);
			
			foreach($productDisconts as $discont) {			
				$product->disconts .= $discont->newPrice . ",|," . $discont->dateStart . ",|," . $discont->dateFinish . "]]]";
			}
			
			//var_dump($product->atributes);
		}
		
		$allCategories = \App\Models\Categories::findAll();
		
		$arrAllCategories = [];
		
		foreach($allCategories as $category) {				
			if($category->parent_categoryId != NULL) {
				$parent_categoryId = $category->parent_categoryId;
				while(1) {
					$parentCategory = \App\Models\Categories::findById($parent_categoryId);
					$category->name = $parentCategory->name . ">" . $category->name;
					
					if($parentCategory->parent_categoryId != NULL) { 
						$parent_categoryId = $parentCategory->parent_categoryId;
					} else {
						break;
					}
				}
			}
			
			$arrAllCategories[] = $category;
		}
		
		$this->view->allCategories = $arrAllCategories;
		
		$this->view->lastPage = ceil($this->view->numberOfProducts/10);
		
		//var_dump(sizeof($this->view->products));
		//var_dump($this->view->products);	
		$this->view->display(__DIR__ . '/../templates/goods.php');
    }
	
    protected function getImages($table)
    {
		$model = 'App\Models\\' . $table;
		$images = $model::findAllImagesFromTable();
		
		$imagesArray = [];

		foreach ($images as $object) {
			$valuesArray = [];
			foreach ($object as $prop => $value) {
				$valuesArray[$prop] = $value;
			}
			$imagesArray[] = $valuesArray;
        }
		
		return $imagesArray;
    }
	
	
	protected function actionLogout()
    {
        require __DIR__ . '/logout.php';
    }
	
	protected function actionError404()
    {
        echo "Не удалось найти данную страницу. ((";
    }
}

function deleting($img, $target_dir)
{
	$pos_ext = strripos($img, '.');			
	$minuspos = strlen($img)-$pos_ext-1;
	$file_ext = strtolower(substr($img, $pos_ext+1, $minuspos));			
	$file_nameWithoutExt = substr($img, 0, $pos_ext);
	$short_file_name = $file_nameWithoutExt . '_150x150.' . $file_ext;
	
	$short_file_name = $target_dir . $short_file_name;
	$img = $target_dir . $img;
	
	if(file_exists($img)) unlink($img);
	if(file_exists($short_file_name)) unlink($short_file_name);
	if(file_exists($img) == FALSE && file_exists($short_file_name) == FALSE) {}
	//echo $img." файл удален";  
}
