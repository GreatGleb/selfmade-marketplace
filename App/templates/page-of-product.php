<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $good->name; ?></title>

	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="description" content="О Saterno">
	<meta name="keywords" content="О интернет магазине Сатерно">

	<link rel="stylesheet" href="../App/templates/files/bootstrap.min.css">
	<link rel="stylesheet" href="../App/templates/files/font-awesome.min.css">
	<link rel="stylesheet" href="../App/templates/files/lib.css">
	<link rel="stylesheet" href="../App/templates/files/ie9-and-up.css">
	<link rel="stylesheet" href="../App/templates/files/style.css">
	<link rel="stylesheet" href="../App/templates/files/style(1).css">
	<link rel="stylesheet" href="../App/templates/files/so_sociallogin.css">
	<link rel="stylesheet" href="../App/templates/files/so_searchpro.css">
	<link rel="stylesheet" href="../App/templates/files/so_megamenu.css">
	<link rel="stylesheet" href="../App/templates/files/wide-grid.css">
	<link rel="stylesheet" href="../App/templates/files/products.css">
	<link rel="stylesheet" href="../App/templates/files/custom.css">
	<link rel="stylesheet" href="../App/templates/files/owl.carousel.css">
	<link rel="stylesheet" href="../App/templates/files/orange.css">
	<link rel="stylesheet" href="../App/templates/files/header1.css">
	<link rel="stylesheet" href="../App/templates/files/footer1.css">
	<link rel="stylesheet" href="../App/templates/files/responsive.css">
	<link rel="stylesheet" href="../App/templates/files/css/popUp.css">
	<link rel="stylesheet" href="../App/templates/files/css/buyCart.css">
	<link rel="stylesheet" href="../App/templates/files/css/inputsAndTextareasDefault.css">
	<link rel="stylesheet" href="../App/templates/files/css/lightslider.css">
	<link rel="stylesheet" href="../App/templates/files/css/products_style.css">
	<script async="" src="../App/templates/files/js/tag.js"></script>
	<script src="../App/templates/files/js/jquery-2.1.1.min.js"></script>
	<script src="../App/templates/files/js/bootstrap.min.js"></script>
	<script src="../App/templates/files/js/libs.js"></script>
	<script src="../App/templates/files/js/so.system.js"></script>
	<script src="../App/templates/files/js/so.custom.js"></script>
	<script src="../App/templates/files/js/common.js"></script>
	<script src="../App/templates/files/js/jquery.unveil.js"></script>
	<script src="../App/templates/files/js/owl.carousel.js"></script>
	<script src="../App/templates/files/js/script.js"></script>
	<script src="../App/templates/files/js/so_megamenu.js"></script>

	<link href="../App/templates/index_files/saternologomini.jpg" rel="icon">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,700,900' rel='stylesheet' type='text/css'> 	
	<link rel="stylesheet" href="../App/templates/files/css/styleForAll.css">
</head>

<body class="information-information-4 ltr res layout-1   loaded">

<?php require(__DIR__ . "/files/html/modal_sign_to_account.html");?>

<div id="wrapper" class="wrapper-full banners-effect-7">   
	
		<div class="loader-content">
		<div id="loader">
						<div class="cssload-thecube"><div class="cssload-cube cssload-c1"></div><div class="cssload-cube cssload-c2"></div><div class="cssload-cube cssload-c4"></div><div class="cssload-cube cssload-c3"></div></div>
				</div>
	</div>

<?php require(__DIR__ . "/files/html/header.html");?>
	
	<div id="socialLogin"></div>

	
<div class="container ">
	<ul class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i></a></li>
        <li><a href="<?php echo $good->url; ?>"><?php echo $good->name; ?></php></a></li>
      </ul>
</div>

<div class="container product-detail product-full">
  <div class="row">

    <div id="content" class="col-sm-12">
      <div class="row product-view product-info">
        <div class="content-product-left   col-md-6 col-sm-12 col-xs-12 ">
          <div id="thumb-slider" class="thumb-vertical-outer">
            <span class="btn-more prev-thumb nt"><i class="fa fa-chevron-up"></i></span>
            <span class="btn-more next-thumb nt"><i class="fa fa-chevron-down"></i></span>
            <ul class="thumb-vertical">
                <?php 
                $i = 0;
                foreach($good->images as $image) { ?>
                  <li class="owl2-item">
                    <a data-index="<?php echo $i ?>" class="img thumbnail" data-image="<?php echo '/admin/' . $image->url . $image->name ?>" title="<?php echo $good->name; ?>">
                      <img src="<?php echo '/admin/' . $image->url . $image->name ?>" title="<?php echo $good->name; ?>" alt="<?php echo $good->name; ?>" />
                    </a>
                  </li>
                <?php $i++; } ?>
            </ul>
          </div>

          <div class="large-image   vertical  ">
            <img itemprop="image" class="product-image-zoom" src="<?php echo 'https://saterno.ru/admin/' . $good->images[0]->url . $good->images[0]->name ?>" data-zoom-image="<?php echo 'https://saterno.ru/admin/' . $good->images[0]->url . $good->images[0]->name ?>" title="<?php echo $good->name; ?>" alt="<?php echo $good->name; ?>" />
            <div class="box-label">
              <!--New Label-->

              <!--Sale Label-->
            </div>
          </div>

        </div>

        <div class="content-product-right  col-md-6 col-sm-12 col-xs-12">
          <div class="title-product">
            <h1><?php echo $good->name; ?></h1>
          </div>
          <!-- Review ---->
          <!-- <div class="box-review">
            <div class="ratings">
              <div class="rating-box">
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
              </div>
            </div>

            <a class="reviews_button" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 отзывов</a> | <a class="write_review_button" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Написать отзыв</a>
          </div> -->

          <div class="product-label">
            <div class="product_page_price price" style=" position: relative; ">
              <!--<span class="price-new"><span itemprop="price" id="price-old">241.99 р.</span></span>-->
              <?php if($good->newPrice == NULL) { ?>
    			<p class="price" style="margin: 0 0 10px 0; line-height: 24px; color: #000; font-size: 18px; font-weight: 600;">
    				<span><?php echo $good->price ?></span>&#8381;
    			</p>
    			<?php } else { ?>
    			    <span class="old-price" style="position: absolute; bottom: 28px; left: 0; text-decoration: line-through;"><?php echo $good->price ?>&#8381;</span>
    			    <p class="price" style="margin: 0 0 10px 0; line-height: 24px; color: #e74c3c; font-size: 18px; font-weight: 600;">
    			    	<span><?php echo $good->newPrice ?></span>&#8381;
    			    </p>
    			<?php } ?>
              <!-- <div class="price-tax"><span>Без НДС:</span> 199.99 р.</div> -->

            </div>
          </div>
      
    		<?php if ($good->seller->isTrading == '0' || $good->isInStock == '0') { ?>
    		    <div class="stock-info stock-info--cat stock-info--not" style="line-height: 1;">
                	<span class="stock-icon">
                		<svg class="icon" width="7" height="8">
                			<svg viewBox="0 0 137 156" id="icon-in-stock" xmlns="http://www.w3.org/2000/svg" style="fill: #676767;">
                				<path d="M134.8 4.4v37.1H3.5V4.4h131.3zM3.2 154.6v-37.1h131.5v37.1H3.2zm131.7-93.5v36.7H3.4V61.1h131.5z" class="cest0"></path>
                			</svg>
                		</svg>
                	</span>
                	<span class="stock-text" style="color: #ff3a3a;">Ожидается поступление</span></span>
                </div>
            <?php } ?>
          
          <!-- <div class="product-box-desc">
            <div class="inner-box-desc">
              <div class="model"><span>Код товара:</span> SAM1</div>
              <div class="reward"><span>Бонусные баллы:</span> 1000</div>
              <div class="stock"><span> Склад </span> <i class="fa fa-check-square-o"></i> Предзаказ</div>
            </div>
          </div> -->

          <div class="short_description form-group">
            <h3>Обзор</h3> <span style="overflow: hidden; text-overflow: ellipsis; display: -moz-box; -moz-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; line-clamp: 3; box-orient: vertical;"><?php echo $good->description ?></span> </div>

          <!--Countdown box-->

          <!--End countdown box-->

          <div id="product"  data-atributes="<?php if(is_array($good->atributes)) {
                        		foreach($good->atributes as $atribute) {
                        			echo $atribute . "]]]";
                        		}
                        	} ?>" data-product-id="<?php echo $good->id ?>" data-bought-atributes="<?php echo $good->strGoodsAtributes ?>" <?php 
		    echo "data-product-min-order=";
		    if($good->minOrderQuantity != NULL) {
		        echo "\"" . $good->minOrderQuantity . "\"";
		    }
		    
	        echo " data-product-max-order=";
		    if($good->quantity != NULL) {
		        echo "\"" . $good->quantity . "\"";
		    }
		    
		    echo " data-brand-url=";
		    if($good->brand->url != NULL) {
		        echo "\"" . $good->brand->url . "\"";
		    }
		    
		    echo " data-product-url=";
		    if($good->url != NULL) {
		        echo "\"" . $good->url . "\"";
		    }
	    ?>>

            <div class="cart clearfix">

              <!-- QUALYTY -->
              <div class="form-group box-info-product">
                <!-- <div class="option quantity">
                  <div class="input-group quantity-control">
                    <label>Кол-во</label>
                    <input class="form-control" type="text" name="quantity" value="1" />
                    <input type="hidden" name="product_id" value="49" />
                    <span class="input-group-addon product_quantity_down fa fa-caret-down"></span>
                    <span class="input-group-addon product_quantity_up fa fa-caret-up"></span>
                  </div>
                </div> -->
                <!-- CART -->
                
                <div class="svg buttonBuy <?php if($good->isAdedToCart == 1) { echo  "none"; } ?>" style="
                    height: 30px;
                    position: relative;
                    margin-left: 10px;
                    width: 105px;
                    background-color: #f4a137;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: all .5s;
                ">
                <div style="
                    position: absolute;
                    bottom: 4px;
                    left: 41px;
                    font-size: 16px;
                    color: #fff;
                ">Купить</div><svg height="24" width="24" style="fill: #fff;position: absolute;bottom: 3px;left: 9px;">
            			    <svg viewBox="0 0 24 24" id="icon-basket">
                            	<g>
                            		<path fill-rule="evenodd" clip-rule="evenodd" d="M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4H2.68121C3.08124 4 3.44277 4.2384 3.60035 4.60608L8.44161 15.9023C9.00044 17.2063 10.3963 17.9405 11.7874 17.6623L19.058 16.2082C20.1137 15.9971 20.9753 15.2365 21.3157 14.2151L23.0712 8.94868C23.7187 7.00609 22.2728 5 20.2251 5H5.94511L5.43864 3.81824C4.96591 2.71519 3.88129 2 2.68121 2H1ZM10.2799 15.1145L6.80225 7H20.2251C20.9077 7 21.3897 7.6687 21.1738 8.31623L19.4183 13.5827C19.3049 13.9231 19.0177 14.1767 18.6658 14.247L11.3952 15.7012C10.9315 15.7939 10.4662 15.5492 10.2799 15.1145Z"></path>
                            		<path d="M11 22C11 23.1046 10.1046 24 9 24C7.89543 24 7 23.1046 7 22C7 20.8954 7.89543 20 9 20C10.1046 20 11 20.8954 11 22Z"></path>
                            		<path d="M21 22C21 23.1046 20.1046 24 19 24C17.8954 24 17 23.1046 17 22C17 20.8954 17.8954 20 19 20C20.1046 20 21 20.8954 21 22Z"></path>
                            	</g>
                            </svg>
            			</svg>
        			</div>
                
                <div class="svg buttonBuyed toggleModal1 <?php if($good->isAdedToCart !== 1) { echo  "none"; } ?>" style="
                    height: 30px;
                    position: relative;
                    margin-left: 10px;
                    width: 210px;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: all .5s;
                ">
                            			<div style="
                    position: absolute;
                    bottom: 4px;
                    left: 41px;
                    font-size: 16px;
                    border-bottom: 1px dashed rgba(1,1,1,0);
                ">Товар уже в корзине</div><svg height="24" width="24" style="fill: rgb(244, 161, 55);position: absolute;bottom: 4px;left: 9px;cursor: pointer;"><svg viewBox="0 0 24 24"><g fill="#f4a137">	<path fill-rule="evenodd" clip-rule="evenodd" d="M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4H2.68121C3.08124 4 3.44277 4.2384 3.60035 4.60608L8.44161 15.9023C9.00044 17.2063 10.3963 17.9405 11.7874 17.6623L19.058 16.2082C20.1137 15.9971 20.9753 15.2365 21.3157 14.2151L23.0712 8.94868C23.7187 7.00609 22.2728 5 20.2251 5H5.94511L5.43864 3.81824C4.96591 2.71519 3.88129 2 2.68121 2H1ZM10.2799 15.1145L6.80225 7H20.2251C20.9077 7 21.3897 7.6687 21.1738 8.31623L19.4183 13.5827C19.3049 13.9231 19.0177 14.1767 18.6658 14.247L11.3952 15.7012C10.9315 15.7939 10.4662 15.5492 10.2799 15.1145Z"></path>	<path d="M11 22C11 23.1046 10.1046 24 9 24C7.89543 24 7 23.1046 7 22C7 20.8954 7.89543 20 9 20C10.1046 20 11 20.8954 11 22Z"></path>	<path d="M21 22C21 23.1046 20.1046 24 19 24C17.8954 24 17 23.1046 17 22C17 20.8954 17.8954 20 19 20C20.1046 20 21 20.8954 21 22Z"></path></g><g id="icon-basket-filled__fill">	<path d="M20 15L21 6H6L10 16L20 15Z" fill="#f4a137"></path>	<circle cx="17" cy="7" r="7" fill="white"></circle>	<path fill-rule="evenodd" clip-rule="evenodd" d="M17 13C20.3137 13 23 10.3137 23 7C23 3.68629 20.3137 1 17 1C13.6863 1 11 3.68629 11 7C11 10.3137 13.6863 13 17 13ZM20.7071 5.70711C21.0976 5.31658 21.0976 4.68342 20.7071 4.29289C20.3166 3.90237 19.6834 3.90237 19.2929 4.29289L16 7.58579L14.7071 6.29289C14.3166 5.90237 13.6834 5.90237 13.2929 6.29289C12.9024 6.68342 12.9024 7.31658 13.2929 7.70711L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711L20.7071 5.70711Z" fill="#f4a137"></path></g></svg></svg>
        			</div>
                
                <!-- <div class="add-to-links wish_comp">
                  <ul class="blank">
                    <li class="wishlist">
                      <a class="icon" data-toggle="tooltip" title="В закладки" onclick="wishlist.add('49');"><i class="fa fa-heart"></i></a>
                    </li>
                    <li class="compare">
                      <a class="icon" data-toggle="tooltip" title="В сравнение" onclick="compare.add('49');"><i class="fa fa-exchange"></i></a>
                    </li>
                  </ul>
                </div> -->

              </div>

            </div>
            
            <div class="seller-of-product" style="
                font-size: 16px;
                padding: 9px 15px 9px 9px;
                border: 1px solid #000;
                border-radius: 10px;
                display: flex;
                justify-content: space-between;
            ">
                <div style="line-height: 40px;">Магазин: <a href="/<?php echo $good->shop->url ?>" style="font-weight: 700;"><?php echo $good->shop->name ?></a></div>
                <?php if($good->shop->img != NULL) { ?> <div><img src="/admin/<?php echo $good->shop->img->url . $good->shop->img->name ?>" style="height: 40px;"></div> <?php } ?>
            </div>
            <div class="seller-of-product" style="
                font-size: 12px;
                padding: 9px 15px 9px 9px;
                border: 1px solid #000;
                border-radius: 10px;
                margin-top: 10px;
            ">
              <div style="height: 40px;display: flex;justify-content: space-between;"><span style="font-size: 16px;">Доставка:</span>
                <div style="line-height: 1.7; margin-left: 5px;"> транспортной компанией, которую можно будет выбрать на странице оформления заказа, либо самовывозом со склада.</div>
              </div>
              <div style="line-height: 2;"><span style="font-size: 15px;">Адрес склада - </span><?php echo $good->stock->country . ', ' . $good->stock->region . ', г. ' . $good->stock->city . ', ' . $good->stock->street . ', д.' . $good->stock->home; if($good->stock->office != NULL) { echo ', ' . $good->stock->office; } ?></div>
            </div>
          </div>
          <!-- end box info product -->

        </div>

      </div>

      <div class="row product-bottom">

        <div class="col-xs-12">
          <div class="producttab ">
            <div class="tabsslider   col-xs-12">
              <ul class="nav nav-tabs font-sn">
                <li class="active"><a data-toggle="tab" href="#tab-1">Описание</a></li>

                <!-- <li class="item_nonactive"><a data-toggle="tab" href="#tab-review">Отзывы (0)</a></li> -->

              </ul>

              <div class="tab-content  col-xs-12">
                <div id="tab-1" class="tab-pane fade active in">
                    <?php echo $good->description ?>
                </div>

                <div id="tab-review" class="tab-pane fade">
                  <form>
                    <div id="review"></div>
                    <h2 id="review-title">Написать отзыв</h2>
                    <div class="contacts-form">
                      <div class="form-group">
                        <span class="icon icon-user"></span>
                        <input type="text" name="name" class="form-control" value="Ваше имя:" onblur="if (this.value == '') {this.value = 'Ваше имя:';}" onfocus="if(this.value == 'Ваше имя:') {this.value = '';}">
                      </div>
                      <div class="form-group">
                        <span class="icon icon-bubbles-2"></span>
                        <textarea class="form-control" name="text" onblur="if (this.value == '') {this.value = 'Ваш отзыв';}" onfocus="if(this.value == 'Ваш отзыв') {this.value = '';}">Ваш отзыв</textarea>
                      </div>
                      <div class="form-group">
                        <span style="font-size: 11px;"><span class="text-danger">Внимание:</span> HTML не поддерживается! Используйте обычный текст!</span>
                        <br />
                        <br />
                        <b>Рейтинг</b> <span>Плохо</span>&nbsp;
                        <input type="radio" name="rating" value="1" /> &nbsp;
                        <input type="radio" name="rating" value="2" /> &nbsp;
                        <input type="radio" name="rating" value="3" /> &nbsp;
                        <input type="radio" name="rating" value="4" /> &nbsp;
                        <input type="radio" name="rating" value="5" /> &nbsp;
                        <span>Хорошо</span>
                        <br />
                      </div>
                      <div class="buttons clearfix"><a id="button-review" class="btn btn-info">Продолжить</a></div>

                    </div>
                  </form>

                </div>

              </div>
            </div>
          </div>

          <!-- <div class="module up-sell-product up-sell">
            <h3 class="modtitle"><span>Рекомендуем</span></h3>
            <div class="so-basic-product" id="so_basic_products_189_5218038191610362291">
              <div class="item-wrap row cf products-list grid">
                <div class="item-element product-layout ">
                  <div class="item-inner product-item-container">
                    <div class="left-block">
                      <div class="product-image-container ">

                        <div class="image">
                          <a href="https://dev.saterno.ru/test" target="_self" title="Apple Cinema 30&quot;">
                            <img src="https://dev.saterno.ru/image/cache/catalog/demo/apple_cinema_30-270x270.jpg" alt="Apple Cinema 30&quot;">
                          </a>
                        </div>

                        <!--Sale Label-->
                <!--
                        <span class="label label-sale">Скидка</span>

                      </div>
                    </div>
                    <div class="button-group">
                      <button type="button" class="addToCart" data-toggle="tooltip" title="Добавить в корзину" onclick="cart.add('42');"><i class="fa fa-shopping-cart"></i> </button>
                      <button type="button" class="wishlist" data-toggle="tooltip" title="В закладки" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                      <button type="button" class="compare" data-toggle="tooltip" title="В сравнение" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>

                    </div>
                    <div class="right-block">
                      <div class="caption">
                        <h4><a href="https://dev.saterno.ru/test" target="_self">Apple Cinema 30"</a></h4>

                        <div class="ratings">
                          <div class="rating-box">
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                          </div>
                        </div>

                        <p class="price">
                          <span class="price-new">110.00 р.</span> <span class="price-old">122.00 р.</span>
                          <span class="price-tax hidden">Без налога: 90.00 р.</span>
                        </p>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="item-element product-layout ">
                  <div class="item-inner product-item-container">
                    <div class="left-block">
                      <div class="product-image-container ">

                        <div class="image">
                          <a href="https://dev.saterno.ru/canon-eos-5d" target="_self" title="Canon EOS 5D">
                            <img src="https://dev.saterno.ru/image/cache/catalog/demo/canon_eos_5d_1-270x270.jpg" alt="Canon EOS 5D">
                          </a>
                        </div>

                        <!--Sale Label-->
                    <!--
                        <span class="label label-sale">Скидка</span>

                      </div>
                    </div>
                    <div class="button-group">
                      <button type="button" class="addToCart" data-toggle="tooltip" title="Добавить в корзину" onclick="cart.add('30');"><i class="fa fa-shopping-cart"></i> </button>
                      <button type="button" class="wishlist" data-toggle="tooltip" title="В закладки" onclick="wishlist.add('30');"><i class="fa fa-heart"></i></button>
                      <button type="button" class="compare" data-toggle="tooltip" title="В сравнение" onclick="compare.add('30');"><i class="fa fa-exchange"></i></button>

                    </div>
                    <div class="right-block">
                      <div class="caption">
                        <h4><a href="https://dev.saterno.ru/canon-eos-5d" target="_self">Canon EOS 5D</a></h4>

                        <div class="ratings">
                          <div class="rating-box">
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                          </div>
                        </div>

                        <p class="price">
                          <span class="price-new">98.00 р.</span> <span class="price-old">122.00 р.</span>
                          <span class="price-tax hidden">Без налога: 80.00 р.</span>
                        </p>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="item-element product-layout ">
                  <div class="item-inner product-item-container">
                    <div class="left-block">
                      <div class="product-image-container ">

                        <div class="image">
                          <a href="https://dev.saterno.ru/hp-lp3065" target="_self" title="HP LP3065">
                            <img src="https://dev.saterno.ru/image/cache/catalog/demo/hp_1-270x270.jpg" alt="HP LP3065">
                          </a>
                        </div>

                        <!--Sale Label-->
                <!--
                      </div>
                    </div>
                    <div class="button-group">
                      <button type="button" class="addToCart" data-toggle="tooltip" title="Добавить в корзину" onclick="cart.add('47');"><i class="fa fa-shopping-cart"></i> </button>
                      <button type="button" class="wishlist" data-toggle="tooltip" title="В закладки" onclick="wishlist.add('47');"><i class="fa fa-heart"></i></button>
                      <button type="button" class="compare" data-toggle="tooltip" title="В сравнение" onclick="compare.add('47');"><i class="fa fa-exchange"></i></button>

                    </div>
                    <div class="right-block">
                      <div class="caption">
                        <h4><a href="https://dev.saterno.ru/hp-lp3065" target="_self">HP LP3065</a></h4>

                        <div class="ratings">
                          <div class="rating-box">
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                          </div>
                        </div>

                        <p class="price">
                          <span class="price-new">	122.00 р.</span>
                          <span class="price-tax hidden">Без налога: 100.00 р.</span>
                        </p>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="item-element product-layout ">
                  <div class="item-inner product-item-container">
                    <div class="left-block">
                      <div class="product-image-container ">

                        <div class="image">
                          <a href="https://dev.saterno.ru/htc-touch-hd" target="_self" title="HTC Touch HD">
                            <img src="https://dev.saterno.ru/image/cache/catalog/demo/htc_touch_hd_1-270x270.jpg" alt="HTC Touch HD">
                          </a>
                        </div>

                        <!--Sale Label-->
                    <!--
                      </div>
                    </div>
                    <div class="button-group">
                      <button type="button" class="addToCart" data-toggle="tooltip" title="Добавить в корзину" onclick="cart.add('28');"><i class="fa fa-shopping-cart"></i> </button>
                      <button type="button" class="wishlist" data-toggle="tooltip" title="В закладки" onclick="wishlist.add('28');"><i class="fa fa-heart"></i></button>
                      <button type="button" class="compare" data-toggle="tooltip" title="В сравнение" onclick="compare.add('28');"><i class="fa fa-exchange"></i></button>

                    </div>
                    <div class="right-block">
                      <div class="caption">
                        <h4><a href="https://dev.saterno.ru/htc-touch-hd" target="_self">HTC Touch HD</a></h4>

                        <div class="ratings">
                          <div class="rating-box">
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                          </div>
                        </div>

                        <p class="price">
                          <span class="price-new">	122.00 р.</span>
                          <span class="price-tax hidden">Без налога: 100.00 р.</span>
                        </p>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="item-element product-layout ">
                  <div class="item-inner product-item-container">
                    <div class="left-block">
                      <div class="product-image-container ">

                        <div class="image">
                          <a href="https://dev.saterno.ru/macbook-pro" target="_self" title="MacBook Pro">
                            <img src="https://dev.saterno.ru/image/cache/catalog/demo/macbook_pro_1-270x270.jpg" alt="MacBook Pro">
                          </a>
                        </div>

                        <!--Sale Label-->
                <!--
                      </div>
                    </div>
                    <div class="button-group">
                      <button type="button" class="addToCart" data-toggle="tooltip" title="Добавить в корзину" onclick="cart.add('45');"><i class="fa fa-shopping-cart"></i> </button>
                      <button type="button" class="wishlist" data-toggle="tooltip" title="В закладки" onclick="wishlist.add('45');"><i class="fa fa-heart"></i></button>
                      <button type="button" class="compare" data-toggle="tooltip" title="В сравнение" onclick="compare.add('45');"><i class="fa fa-exchange"></i></button>

                    </div>
                    <div class="right-block">
                      <div class="caption">
                        <h4><a href="https://dev.saterno.ru/macbook-pro" target="_self">MacBook Pro</a></h4>

                        <div class="ratings">
                          <div class="rating-box">
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                          </div>
                        </div>

                        <p class="price">
                          <span class="price-new">	2 000.00 р.</span>
                          <span class="price-tax hidden">Без налога: 2 000.00 р.</span>
                        </p>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="item-element product-layout ">
                  <div class="item-inner product-item-container">
                    <div class="left-block">
                      <div class="product-image-container ">

                        <div class="image">
                          <a href="https://dev.saterno.ru/nikon-d300" target="_self" title="Nikon D300">
                            <img src="https://dev.saterno.ru/image/cache/catalog/demo/nikon_d300_1-270x270.jpg" alt="Nikon D300">
                          </a>
                        </div>

                        <!--Sale Label-->
                    <!--
                      </div>
                    </div>
                    <div class="button-group">
                      <button type="button" class="addToCart" data-toggle="tooltip" title="Добавить в корзину" onclick="cart.add('31');"><i class="fa fa-shopping-cart"></i> </button>
                      <button type="button" class="wishlist" data-toggle="tooltip" title="В закладки" onclick="wishlist.add('31');"><i class="fa fa-heart"></i></button>
                      <button type="button" class="compare" data-toggle="tooltip" title="В сравнение" onclick="compare.add('31');"><i class="fa fa-exchange"></i></button>

                    </div>
                    <div class="right-block">
                      <div class="caption">
                        <h4><a href="https://dev.saterno.ru/nikon-d300" target="_self">Nikon D300</a></h4>

                        <div class="ratings">
                          <div class="rating-box">
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                          </div>
                        </div>

                        <p class="price">
                          <span class="price-new">	98.00 р.</span>
                          <span class="price-tax hidden">Без налога: 80.00 р.</span>
                        </p>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="item-element product-layout ">
                  <div class="item-inner product-item-container">
                    <div class="left-block">
                      <div class="product-image-container ">

                        <div class="image">
                          <a href="https://dev.saterno.ru/palm-treo-pro" target="_self" title="Palm Treo Pro">
                            <img src="https://dev.saterno.ru/image/cache/catalog/demo/palm_treo_pro_1-270x270.jpg" alt="Palm Treo Pro">
                          </a>
                        </div>

                        <!--Sale Label-->
                    <!--
                      </div>
                    </div>
                    <div class="button-group">
                      <button type="button" class="addToCart" data-toggle="tooltip" title="Добавить в корзину" onclick="cart.add('29');"><i class="fa fa-shopping-cart"></i> </button>
                      <button type="button" class="wishlist" data-toggle="tooltip" title="В закладки" onclick="wishlist.add('29');"><i class="fa fa-heart"></i></button>
                      <button type="button" class="compare" data-toggle="tooltip" title="В сравнение" onclick="compare.add('29');"><i class="fa fa-exchange"></i></button>

                    </div>
                    <div class="right-block">
                      <div class="caption">
                        <h4><a href="https://dev.saterno.ru/palm-treo-pro" target="_self">Palm Treo Pro</a></h4>

                        <div class="ratings">
                          <div class="rating-box">
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                          </div>
                        </div>

                        <p class="price">
                          <span class="price-new">	337.99 р.</span>
                          <span class="price-tax hidden">Без налога: 279.99 р.</span>
                        </p>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="item-element product-layout ">
                  <div class="item-inner product-item-container">
                    <div class="left-block">
                      <div class="product-image-container ">

                        <div class="image">
                          <a href="https://dev.saterno.ru/samsung-galaxy-tab-10-1" target="_self" title="Samsung Galaxy Tab 10.1">
                            <img src="https://dev.saterno.ru/image/cache/catalog/demo/samsung_tab_1-270x270.jpg" alt="Samsung Galaxy Tab 10.1">
                          </a>
                        </div>

                      </div>
                    </div>
                    <div class="button-group">
                      <button type="button" class="addToCart" data-toggle="tooltip" title="Добавить в корзину" onclick="cart.add('49');"><i class="fa fa-shopping-cart"></i> </button>
                      <button type="button" class="wishlist" data-toggle="tooltip" title="В закладки" onclick="wishlist.add('49');"><i class="fa fa-heart"></i></button>
                      <button type="button" class="compare" data-toggle="tooltip" title="В сравнение" onclick="compare.add('49');"><i class="fa fa-exchange"></i></button>

                    </div>
                    <div class="right-block">
                      <div class="caption">
                        <h4><a href="https://dev.saterno.ru/samsung-galaxy-tab-10-1" target="_self">Samsung Galaxy Tab 10.1</a></h4>

                        <div class="ratings">
                          <div class="rating-box">
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                          </div>
                        </div>

                        <p class="price">
                          <span class="price-new">	241.99 р.</span>
                          <span class="price-tax hidden">Без налога: 199.99 р.</span>
                        </p>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div> -->

          <script>
            // <![CDATA[
            jQuery(document).ready(function($) {
              $('.item-wrap').owlCarousel2({
                pagination: false,
                center: false,
                nav: true,
                dots: false,
                loop: true,
                margin: 0,
                navText: ['prev', 'next'],
                slideBy: 4,
                autoplay: false,
                autoplayTimeout: 2500,
                autoplayHoverPause: true,
                autoplaySpeed: 800,
                startPosition: 0,
                responsive: {
                  0: {
                    items: 1
                  },
                  480: {
                    items: 2
                  },
                  768: {
                    items: 3
                  },
                  992: {
                    items: 4
                  },
                  1200: {
                    items: 4
                  }
                }
              });
            });
            // ]]>
          </script>

        </div>

        <script src="../App/templates/files/js/jquery.elevateZoom-3.0.8.min.js"></script>

        <script src="../App/templates/files/js/lightslider.js"></script>
        
        <script type="text/javascript">
          $(document).ready(function() {
            var zoomCollection = '.large-image img';
            $(zoomCollection).elevateZoom({
              zoomType: "inner",
              lensSize: "250",
              easing: true,
              gallery: 'thumb-slider',
              cursor: 'pointer',
              galleryActiveClass: "active"
            });
            $('.large-image img').magnificPopup({
              items: [<?php
                foreach($good->images as $image) {
                    echo "{
                src: 'https://saterno.ru/admin/" . $image->url . $image->name . "'
                    }, ";
                 } ?> ],
              gallery: {
                enabled: true,
                preload: [0, 2]
              },
              type: 'image',
              mainClass: 'mfp-fade',
              callbacks: {
                open: function() {
                  var activeIndex = parseInt($('#thumb-slider .img.active').attr('data-index'));
                  var magnificPopup = $.magnificPopup.instance;
                  magnificPopup.goTo(activeIndex);
                }
              }
            });
          });
          
	$(document).ready(function() {
		
		$('.product-options li.radio').click(function(){
			$(this).addClass(function() {
				if($(this).hasClass("active")) return "";
				return "active";
			});
			
			$(this).siblings("li").removeClass("active");
			$(this).parent().find('.selected-option').html('<span class="label label-success">'+ $(this).find('img').data('original-title') +'</span>');
		})
		
		// CUSTOM BUTTON
		$(".thumb-vertical-outer .next-thumb").click(function () {
			$( ".thumb-vertical-outer .lSNext" ).trigger( "click" );
		});
		
		$(".thumb-vertical-outer .prev-thumb").click(function () {
			$( ".thumb-vertical-outer .lSPrev" ).trigger( "click" );
		});

		$(".thumb-vertical-outer .thumb-vertical").lightSlider({
			item: 4,
			autoWidth: false,
			vertical:true,
			slideMargin: 10,
			verticalHeight:420,
            pager: false,
			controls: true,
            prevHtml: '<i class="fa fa-angle-up"></i>',
            nextHtml: '<i class="fa fa-angle-down"></i>',
			responsive: [
				{
					breakpoint: 1199,
					settings: {
						verticalHeight: 320,
						item: 3,
					}
				},{
					breakpoint: 1024,
					settings: {
						verticalHeight: 235,
						item: 2,
						slideMargin: 5,
					}
				},{
					breakpoint: 768,
					settings: {
						verticalHeight: 360,
						item: 3,
					}
				},{
					breakpoint: 480,
					settings: {
						verticalHeight: 110,
						item: 1,
					}
				}
				
			]
							
        });
		
		
		$("#thumb-slider .owl2-item").each(function() {
			$(this).find("[data-index='0']").addClass('active');
		});
		
	});
        </script>
      </div>
    </div>
  </div>
</div>


<div class="modalBlock toggleModal0" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription" data-state="close" style="overflow: auto;">
  <div class="modal__block">
	<div class="modalHeader">
		<div class="title">Выбор модели</div>
		<button class="modal__close toggleModal0" data-toggle="true">
			<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z" fill-rule="evenodd"></path>
			</svg>
		</button>
	</div>			
	<div class="modalBody">
		<div>
		    <p>Добавление товара «<span class="product-title"></span>» в корзину</p>
		    <div class="price" style="">
		        <p class="price-title" style="margin: 0; line-height: 0.8; font-size: 13px; font-weight: 400; color: #3b3b3b">Цена</p>
		        <p class="price-value" style=" font-size: 21px; font-weight: 900; "></p>
		    </div>
		    <div class="atributes">
		        
		    </div>
		    <p class="pButtonBuy" style="margin: 0; padding: 10px;">
    		    <span class="svg buttonBuy">
        			<svg height="24" width="24" style="fill: #000;cursor: pointer;">
        			    <svg viewBox="0 0 24 24" id="icon-basket">
                        	<g>
                        		<path fill-rule="evenodd" clip-rule="evenodd" d="M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4H2.68121C3.08124 4 3.44277 4.2384 3.60035 4.60608L8.44161 15.9023C9.00044 17.2063 10.3963 17.9405 11.7874 17.6623L19.058 16.2082C20.1137 15.9971 20.9753 15.2365 21.3157 14.2151L23.0712 8.94868C23.7187 7.00609 22.2728 5 20.2251 5H5.94511L5.43864 3.81824C4.96591 2.71519 3.88129 2 2.68121 2H1ZM10.2799 15.1145L6.80225 7H20.2251C20.9077 7 21.3897 7.6687 21.1738 8.31623L19.4183 13.5827C19.3049 13.9231 19.0177 14.1767 18.6658 14.247L11.3952 15.7012C10.9315 15.7939 10.4662 15.5492 10.2799 15.1145Z"></path>
                        		<path d="M11 22C11 23.1046 10.1046 24 9 24C7.89543 24 7 23.1046 7 22C7 20.8954 7.89543 20 9 20C10.1046 20 11 20.8954 11 22Z"></path>
                        		<path d="M21 22C21 23.1046 20.1046 24 19 24C17.8954 24 17 23.1046 17 22C17 20.8954 17.8954 20 19 20C20.1046 20 21 20.8954 21 22Z"></path>
                        	</g>
                        </svg>
        			</svg>
    			</span>
			</p>
		</div>
	</div>
	
  </div>
</div>

<script>
    let divShortDescription = document.querySelector('.short_description span');
    divShortDescription.innerHTML = divShortDescription.innerText;
    
    let divMainDescription = document.querySelector('#tab-1');
    divMainDescription.innerHTML = divMainDescription.innerText;
</script>

<?php require(__DIR__ . "/files/html/buy-cart-module.html"); ?>

<?php require(__DIR__ . "/files/html/right_menu.html"); ?>

<div id="cover"></div>
<div id="cover2"></div>
<div id="cover3"></div>

<script src="/App/templates/files/js/popUp.js"></script>
<script src="/App/templates/files/js/buyCartModuleForProductPage.js"></script>
<script src="/App/templates/files/js/activationOfProductPage.js"></script>

<?php require(__DIR__ . "/files/html/footer.html");?>		
	
    </div>

<script src="../App/templates/files/js/link_for_version2.js"></script>
</body></html>