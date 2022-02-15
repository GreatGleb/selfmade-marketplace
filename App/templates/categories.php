<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $category->name; ?></title>

	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="description" content="<?php echo $category->description; ?>">
	<meta name="keywords" content="<?php echo $category->keywords; ?>">

	<link rel="stylesheet" href="/App/templates/files/bootstrap.min.css">
	<link rel="stylesheet" href="/App/templates/files/font-awesome.min.css">
	<link rel="stylesheet" href="/App/templates/files/lib.css">
	<link rel="stylesheet" href="/App/templates/files/ie9-and-up.css">
	<link rel="stylesheet" href="/App/templates/files/style.css">
	<link rel="stylesheet" href="/App/templates/files/style(1).css">
	<link rel="stylesheet" href="/App/templates/files/so_sociallogin.css">
	<link rel="stylesheet" href="/App/templates/files/so_searchpro.css">
	<link rel="stylesheet" href="/App/templates/files/so_megamenu.css">
	<link rel="stylesheet" href="/App/templates/files/wide-grid.css">
	<link rel="stylesheet" href="/App/templates/files/custom.css">
	<link rel="stylesheet" href="/App/templates/files/owl.carousel.css">
	<link rel="stylesheet" href="/App/templates/files/orange.css">
	<link rel="stylesheet" href="/App/templates/files/header1.css">
	<link rel="stylesheet" href="/App/templates/files/footer1.css">
	<link rel="stylesheet" href="/App/templates/files/responsive.css">
	<link rel="stylesheet" href="/App/templates/files/filter_goods_style.css">
	<link rel="stylesheet" href="/App/templates/files/filter_goods_style_nouislider.css">
	<link rel="stylesheet" href="App/templates/files/css/popUp.css">
	<link rel="stylesheet" href="App/templates/files/css/buyCart.css">
	<link rel="stylesheet" href="App/templates/files/css/inputsAndTextareasDefault.css">
	<script async="" src="/App/templates/files/js/tag.js"></script>
	<script src="/App/templates/files/js/filter_goods_nouislider.js"></script>
	<script src="/App/templates/files/js/jquery-2.1.1.min.js"></script>
	<script src="/App/templates/files/js/bootstrap.min.js"></script>
	<script src="/App/templates/files/js/libs.js"></script>
	<script src="/App/templates/files/js/so.system.js"></script>
	<script src="/App/templates/files/js/so.custom.js"></script>
	<script src="/App/templates/files/js/common.js"></script>
	<script src="/App/templates/files/js/jquery.unveil.js"></script>
	<script src="/App/templates/files/js/owl.carousel.js"></script>
	<script src="/App/templates/files/js/script.js"></script>
	<script src="/App/templates/files/js/so_megamenu.js"></script>

	<link href="/App/templates/index_files/saternologomini.jpg" rel="icon">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,700,900' rel='stylesheet' type='text/css'> 	
	<link rel="stylesheet" href="App/templates/files/css/styleForAll.css">
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

	
<div class="container">
   <!-- BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="/home"><i class="fa fa-home"></i></a></li>
		<?php if($parent_categoryId !== NULL) {?>
			<li><a href="/categories/
			<?php if($parent_categoryUrl !== NULL) { echo $parent_categoryUrl; } else { echo $parent_categoryId; } ?>"><?php echo $parent_categoryName; ?>
			</a>
			</li>
		<?php } ?>
			<li><a href="/categories/
			<?php if($category->url !== NULL) { echo $category->url; } else { echo $category->id; } ?>"><?php echo $category->name; ?>
			</a>
			</li>
	</ul>
</div>

<div class="container page-category">
	 <!-- BREADCRUMB -->
	<div class="row">
	<aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column">
	<span id="remove-sidebar" class="fa fa-times"></span>
			<div class="module so_filter_wrap block-shopby">
			<h3 class="modtitle">Товары</h3>
	
	<div class="modcontent">
		<ul data-product_id="42,30,47,28,45,31,29,33,49,51,50">
			<li class="so-filter-options" data-option="search">
	<div class="so-filter-heading">
		<div class="so-filter-heading-text">
			<span>Поиск</span>
		</div>
		<i class="fa fa-chevron-down"></i>
	</div>
	<div class="so-filter-content-opts">
		<div class="so-filter-content-opts-container">
			<div class="so-filter-option" data-type="search">
				<div class="so-option-container">
					<div class="input-group">
						<input type="text" class="form-control" name="text_search" id="text_search" value="">
						<div class="input-group-btn">
							<button class="btn btn-default" type="button" id="submit_text_search"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</li>
<li class="so-filter-options" data-option="Manufacturer">
	<div class="so-filter-heading">
		<div class="so-filter-heading-text">
			<span>Производитель</span>
		</div>
		<i class="fa fa-chevron-down"></i>
	</div>

	<div class="so-filter-content-opts">
		<div class="so-filter-content-opts-container">
									<div class="so-filter-option opt-select  opt_enable" data-type="manufacturer" data-manufacturer_value="5" data-count_product="1" data-list_product="28">
						<div class="so-option-container">
							<div class="option-input">
								<span class="fa fa-square-o">
							</span></div>
							<label><img src="https://dev.saterno.ru/image/cache/no_image-20x20.png"> HTC </label>
							<div class="option-count ">
								<span>1</span>
								<i class="fa fa-times"></i>
							</div>
						</div>
					</div>
									<div class="so-filter-option opt-select  opt_enable" data-type="manufacturer" data-manufacturer_value="6" data-count_product="1" data-list_product="29">
						<div class="so-option-container">
							<div class="option-input">
								<span class="fa fa-square-o">
							</span></div>
							<label><img src="https://dev.saterno.ru/image/cache/catalog/demo/palm_logo-20x20.jpg"> Palm </label>
							<div class="option-count ">
								<span>1</span>
								<i class="fa fa-times"></i>
							</div>
						</div>
					</div>
									<div class="so-filter-option opt-select  opt_enable" data-type="manufacturer" data-manufacturer_value="7" data-count_product="1" data-list_product="47">
						<div class="so-option-container">
							<div class="option-input">
								<span class="fa fa-square-o">
							</span></div>
							<label><img src="https://dev.saterno.ru/image/cache/no_image-20x20.png"> Hewlett-Packard </label>
							<div class="option-count ">
								<span>1</span>
								<i class="fa fa-times"></i>
							</div>
						</div>
					</div>
									<div class="so-filter-option opt-select  opt_enable" data-type="manufacturer" data-manufacturer_value="8" data-count_product="2" data-list_product="42,45">
						<div class="so-option-container">
							<div class="option-input">
								<span class="fa fa-square-o">
							</span></div>
							<label><img src="https://dev.saterno.ru/image/cache/catalog/demo/apple_logo-20x20.jpg"> Apple </label>
							<div class="option-count ">
								<span>2</span>
								<i class="fa fa-times"></i>
							</div>
						</div>
					</div>
									<div class="so-filter-option opt-select  opt_enable" data-type="manufacturer" data-manufacturer_value="9" data-count_product="1" data-list_product="30">
						<div class="so-option-container">
							<div class="option-input">
								<span class="fa fa-square-o">
							</span></div>
							<label><img src="https://dev.saterno.ru/image/cache/catalog/demo/canon_logo-20x20.jpg"> Canon </label>
							<div class="option-count ">
								<span>1</span>
								<i class="fa fa-times"></i>
							</div>
						</div>
					</div>
				
		</div>

	</div>
</li>
<li class="so-filter-options" data-option="Price">
	<div class="so-filter-heading">
		<div class="so-filter-heading-text">
			<span>Цены</span>
		</div>
		<i class="fa fa-chevron-down"></i>
	</div>

	<div class="so-filter-content-opts">
		<div class="so-filter-content-opts-container">
			<div class="so-filter-content-wrapper so-filter-iscroll">
				<div class="so-filter-options">
					<div class="so-filter-option so-filter-price">
						<div class="content_min_max">
							 р. <input type="number" class="input_min form-control" value="98" min="98" max="2000">
							-  р. <input type="number" class="input_max form-control" value="2000" min="98" max="2000">
						</div>
						<div class="content_scroll">
							<div id="slider-range" class="noUi-target noUi-ltr noUi-horizontal noUi-background"><div class="noUi-base"><div class="noUi-origin noUi-connect" style="left: 0%;"><div class="noUi-handle noUi-handle-lower"></div></div><div class="noUi-origin noUi-background" style="left: 100%;"><div class="noUi-handle noUi-handle-upper"></div></div></div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</li>
		</ul>
						<a href="javascript:;" class="btn-block" id="btn_resetAll">
					<span class="fa fa-times" aria-hidden="true"></span> Обновить				</a>
		
	</div>
</div>
<script type="text/javascript">
//<![CDATA[
jQuery(window).load(function($){
	$ = typeof($ !== 'funtion') ? jQuery : $;
		var obj_class 			= $('#content .row').find('.product-layout').parent(),
		product_arr_all 	= $(".so_filter_wrap .modcontent ul").attr("data-product_id"),
		opt_value_id		= "",
		att_value_id		= "",
		manu_value_id		= "",
		subcate_value_id	= "",
		$minPrice			= 98,
		$maxPrice 			= 2000,
		$minPrice_new 		= 98,
		$maxPrice_new 		= 2000,
		url 				= 'https://dev.saterno.ru/index.php?route=product/category&path=322';
		text_search			= "";
		obj_class.addClass('so-filter-gird');
	$load_gif = $('.so-filter-gird');
	$(".so-filter-heading").on("click",function(){
		if($(this).find(".fa").hasClass("fa-chevron-down")){
			$(this).find(".fa-chevron-down").addClass('fa-chevron-right','slow').removeClass('fa-chevron-down','slow');
		}else{
			$(this).find(".fa-chevron-right").addClass('fa-chevron-down','slow').removeClass('fa-chevron-right','slow');
		}
		$(this).parent().children(".so-filter-content-opts").slideToggle("slow");
	});

	clickOption();
	if( opt_value_id != "" || att_value_id != "" || manu_value_id != "" || $minPrice != $minPrice_new || $maxPrice != $maxPrice_new || text_search != "" || subcate_value_id != "")	{
		requestAjax();
	}else{
		obj_class.find(".product-layout").fadeIn("show");
	}

		function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}

		function updateURL() {
		if (history.pushState) {
			window.history.pushState({},'',url);
		}
	}

		function clickOption(){
		$(".so-filter-content-opts-container .opt-select.opt_enable").on("click",function(){
			if (!$(this).hasClass('opt_disable')){
				var type_li = $(this).attr("data-type");
				var att_value = "";
				var opt_value = "";
				var manu_value = "";
				$load_gif.addClass('loading-gif');
				switch(type_li)	{
					case "option":
						opt_value = $(this).attr("data-option_value");
						if(!$(this).hasClass("opt_active"))	{
							$(this).addClass("opt_active");
							$(this).find('.fa-square-o').removeClass('fa-square-o').addClass('fa-check-square-o');
							$(this).find(".option-count").addClass("opt_close");
							if(opt_value_id == ""){
								opt_value_id = opt_value;
							}else{
								opt_value_id += "," + opt_value;
							}
						}else{
							$(this).removeClass("opt_active");
							$(this).find('.fa-check-square-o').removeClass('fa-check-square-o').addClass('fa-square-o');
							$(this).find(".option-count").removeClass("opt_close");
							opt_value_id = opt_value_id.replace(","+opt_value,"");
							opt_value_id = opt_value_id.replace(opt_value+",","");
							opt_value_id = opt_value_id.replace(opt_value,"");
						}

						if(url.indexOf("opt_id") != -1)	{
							if(opt_value_id != ""){
								url = url.replace(/(&opt_id=)[^\&]+/,'&opt_id='+opt_value_id);
							}else{
								url = url.replace(/(&opt_id=)[^\&]+/,'');
								location.href= url;
							}

						}else{
							url = url+'&opt_id='+opt_value_id;
						}

					break;
					case "attribute":
						att_value = $(this).attr("data-attribute_value");
						if(!$(this).hasClass("opt_active"))	{
							$(this).addClass("opt_active");
							$(this).find('.fa-square-o').removeClass('fa-square-o').addClass('fa-check-square-o');
							$(this).find(".option-count").addClass("opt_close");
							if(att_value_id == ""){
								att_value_id = att_value;
							}else{
								att_value_id = att_value_id.replace(","+att_value,"");
								att_value_id = att_value_id.replace(att_value+",","");
								att_value_id = att_value_id.replace(att_value,"");
								att_value_id += "," + att_value;
							}
						}else{
							$(this).removeClass("opt_active");
							$(this).find('.fa-check-square-o').removeClass('fa-check-square-o').addClass('fa-square-o');
							$(this).find(".option-count").removeClass("opt_close");
							att_value_id = att_value_id.replace(","+att_value,"");
							att_value_id = att_value_id.replace(att_value+",","");
							att_value_id = att_value_id.replace(att_value,"");
						}
						if(url.indexOf("att_id") != -1){
							if(att_value_id != ""){
								url = url.replace(/(&att_id=)[^\&]+/,'&att_id='+att_value_id);
							}else{
								url = url.replace(/(&att_id=)[^\&]+/,'');
								location.href= url;
							}
						}else{
							url = url+'&att_id='+att_value_id;
						}
					break;
					case "manufacturer":
						manu_value = $(this).attr("data-manufacturer_value");
						if(!$(this).hasClass("opt_active"))	{
							$(this).addClass("opt_active");
							$(this).find('.fa-square-o').removeClass('fa-square-o').addClass('fa-check-square-o');
							$(this).find(".option-count").addClass("opt_close");
							if(manu_value_id == "")	{
								manu_value_id = manu_value;
							}else{
								manu_value_id = manu_value_id.replace(","+manu_value,"");
								manu_value_id = manu_value_id.replace(manu_value+",","");
								manu_value_id = manu_value_id.replace(manu_value,"");
								manu_value_id += "," + manu_value;
							}
						}else{
							$(this).removeClass("opt_active");
							$(this).find('.fa-check-square-o').removeClass('fa-check-square-o').addClass('fa-square-o');
							$(this).find(".option-count").removeClass("opt_close");
							manu_value_id = manu_value_id.replace(","+manu_value,"");
							manu_value_id = manu_value_id.replace(manu_value+",","");
							manu_value_id = manu_value_id.replace(manu_value,"");
						}
						if(url.indexOf("manu_id") != -1){
							if(manu_value_id != "")	{
								url = url.replace(/(&manu_id=)[^\&]+/,'&manu_id='+manu_value_id);
							}else{
								url = url.replace(/(&manu_id=)[^\&]+/,'');
								location.href= url;
							}
						}else{
							url = url+'&manu_id='+manu_value_id;
						}
					break;
					case "subcategory":
						subcate_value = $(this).attr("data-subcategory_value");
						if(!$(this).hasClass("opt_active"))	{
							$(this).addClass("opt_active");
							$(this).find('.fa-square-o').removeClass('fa-square-o').addClass('fa-check-square-o');
							$(this).find(".option-count").addClass("opt_close");
							if(subcate_value_id == ""){
								subcate_value_id = subcate_value;
							}else{
								subcate_value_id = subcate_value_id.replace(","+subcate_value,"");
								subcate_value_id = subcate_value_id.replace(subcate_value+",","");
								subcate_value_id = subcate_value_id.replace(subcate_value,"");
								subcate_value_id += "," + subcate_value;
							}
						}else{
							$(this).removeClass("opt_active");
							$(this).find('.fa-check-square-o').removeClass('fa-check-square-o').addClass('fa-square-o');
							$(this).find(".option-count").removeClass("opt_close");
							subcate_value_id = subcate_value_id.replace(","+subcate_value,"");
							subcate_value_id = subcate_value_id.replace(subcate_value+",","");
							subcate_value_id = subcate_value_id.replace(subcate_value,"");
						}
						if(url.indexOf("subcate_id") != -1)	{
							if(subcate_value_id != ""){
								url = url.replace(/(&subcate_id=)[^\&]+/,'&subcate_id='+subcate_value_id);
							}else{
								url = url.replace(/(&subcate_id=)[^\&]+/,'');
								location.href= url;
							}
						}else{
							url = url+'&subcate_id='+subcate_value_id;
						}
						product_arr_all = $(this).attr("data-list_product");
						location.href= url;
					break;
				}
				obj_class.find(".product-layout").css("display","none");

				updateURL();
				requestAjax();
			}
			return false;
		});
	}

		
	$.arrayIntersect = function(a, b)
	{
		return $.grep(a, function(i)
		{
			return $.inArray(i, b) > -1;
		});
	};
	function getCountProduct(){
		var product_tmp = $(".so_filter_wrap .modcontent ul").attr("data-product_id");
		
		product_arr = product_tmp.split(',');
		if(product_arr == ''){
			$('.so-filter-option').each(function(){
				$(this).find('.option-count span').html(0);
			});
		}else{
			$('.so-filter-option.opt-select').each(function(){
				var product = $(this).attr('data-list_product');
				if(product != ''){
					var product_array = product.split(',');
					var length = product_array.length;
					var dem = 0 , a =[];
					var _general = $.arrayIntersect(product_arr, product_array);
					var count = _general.length;
					// for (var i = 0; i < length;i++){
						// if(product_arr.indexOf(product_array[i]) > -1){
							// count = count + 1;
							// dem = product_array.length - product_arr.split(',').length;
						// }
					// }
					if(count == 0){
						$(this).removeClass("opt_enable").addClass("opt_disable");
						$(this).attr("disabled", "disabled");

					}else{
						$(this).removeClass("opt_enable").removeClass("opt_disable").addClass("opt_enable");
						$(this).removeAttr("disabled");
					}
					var type = $(this).attr("data-type");
					if(count > 0 && ((att_value_id != "" && type == "attribute") || (opt_value_id != "" && type == "option"))){
						$(this).find('.option-count span').html(count);
					}else{
						$(this).find('.option-count span').html(count);
					}
				}
			});
		}
	}

			var range = document.getElementById('slider-range');
	noUiSlider.create(range, {
		start: [$minPrice_new, $maxPrice_new],
		step: 1,
		connect: true,
		range: {
			'min': $minPrice,
			'max': $maxPrice
		},
		slide: function(event, ui) {
            if ($minPrice == $maxPrice) {
                return false;
            }
        }
	});
	var valueMin = $('.content_min_max .input_min'),
		valueMax = $('.content_min_max .input_max');
		range.noUiSlider.on('change', function( values, handle ) {
			if ( handle ) {
				valueMax.val(values[handle]);
				$maxPrice_new = values[handle];
				if(url.indexOf("maxPrice") != -1){
					if($maxPrice_new != "2000"){
						url = url.replace(/(&maxPrice=)[^\&]+/,'&maxPrice='+$maxPrice_new);
					}else{
						url = url.replace(/(&maxPrice=)[^\&]+/,'');
						location.href= url;
					}
				}else{
					url = url+'&maxPrice='+$maxPrice_new;
				}
			} else {
				valueMin.val(values[handle]);
				$minPrice_new = values[handle];
				if(url.indexOf("minPrice") != -1){
					if($minPrice_new != "98"){
						url = url.replace(/(&minPrice=)[^\&]+/,'&minPrice='+$minPrice_new);
					}else{
						url = url.replace(/(&minPrice=)[^\&]+/,'');
						location.href= url;
					}
				}else{
					url = url+'&minPrice='+$minPrice_new;
				}
			}
			obj_class.find(".product-layout").css('display','none');
			updateURL();
			requestAjax();
		});
		
		range.noUiSlider.on('end', function( values, handle ) {
			if ( handle ) {
				$maxPrice_new = values[handle];
				if(url.indexOf("maxPrice") != -1){
					if($maxPrice_new != "2000"){
						url = url.replace(/(&maxPrice=)[^\&]+/,'&maxPrice='+$maxPrice_new);
					}else{
						url = url.replace(/(&maxPrice=)[^\&]+/,'');
						location.href= url;
					}
				}else{
					url = url+'&maxPrice='+$maxPrice_new;
				}

			} else {
				$minPrice_new = values[handle];
				if(url.indexOf("minPrice") != -1){
					if($minPrice_new != "98"){
						url = url.replace(/(&minPrice=)[^\&]+/,'&minPrice='+$minPrice_new);
					}else{
						url = url.replace(/(&minPrice=)[^\&]+/,'');
						location.href= url;
					}
				}else{
					url = url+'&minPrice='+$minPrice_new;
				}
			}
			obj_class.find(".product-layout").css('display','none');
			updateURL();
			requestAjax();
		});
		$('.content_min_max .input_min').change(function(){
		var valueMin = $(this).val();
		var maxPrice__ = getUrlVars()["maxPrice"];
		if(typeof maxPrice__ === 'undefined'){
			$maxPrice_new = 2000;
		}else{
			$maxPrice_new = maxPrice__;
		}
		if(valueMin < 98){
			valueMin = 98;
			$(this).val(valueMin);
		}
		if(valueMin > 2000){
			valueMin = 2000;
			$(this).val(valueMin);
		}
		range.noUiSlider.set([valueMin,null]);
		if(url.indexOf("minPrice") != -1){
			if(valueMin != "98"){
				url = url.replace(/(&minPrice=)[^\&]+/,'&minPrice='+valueMin);
			}else{
				url = url.replace(/(&minPrice=)[^\&]+/,'');
				location.href= url;
			}
		}else{
			url = url+'&minPrice='+valueMin;
		}
		obj_class.find(".product-layout").css('display','none');
		updateURL();
		$minPrice_new = valueMin;
		requestAjax();
	});
	$('.content_min_max .input_max').change(function(){
		var valueMax = $(this).val();
		var minPrice__ = getUrlVars()["minPrice"];
		if(typeof minPrice__ === 'undefined'){
			$minPrice_new = 98;
		}else{
			$minPrice_new = minPrice__;
		}
		if(valueMax > 2000){
			valueMax = 2000;
			$(this).val(valueMax);
		}
		if(valueMax < 98){
			valueMax = 2000;
			$(this).val(valueMax);
		}
		range.noUiSlider.set([null, valueMax]);
		if(url.indexOf("maxPrice") != -1){
			if(valueMax != "2000"){
				url = url.replace(/(&maxPrice=)[^\&]+/,'&maxPrice='+valueMax);
			}else{
				url = url.replace(/(&maxPrice=)[^\&]+/,'');
				location.href= url;
			}
		}else{
			url = url+'&maxPrice='+valueMax;
		}
		obj_class.find(".product-layout").css('display','none');
		updateURL();
		$maxPrice_new = valueMax;
		requestAjax();
	});
				$('#text_search').keyup(function(){
		var character = 3;
		text_search = $("#text_search").val();
		if(text_search.length >= character){
			if(url.indexOf("search") != -1){
				if(text_search != ""){
					url = url.replace(/(&search=)[^\&]+/,'&search='+text_search);
				}else{
					url = url.replace(/(&search=)[^\&]+/,'');
					location.href= url;
				}
			}else{
				url = url+'&search='+text_search;
			}
			obj_class.find(".product-layout").css('display','none');
			updateURL();
			requestAjax();
		}
	});
	$('#submit_text_search').on("click",function(){
		text_search = $("#text_search").val();
		if(url.indexOf("search") != -1){
			if(text_search != ""){
				url = url.replace(/(&search=)[^\&]+/,'&search='+text_search);
			}else{
				url = url.replace(/(&search=)[^\&]+/,'');
				location.href= url;
			}
		}else{
			url = url+'&search='+text_search;
		}
		obj_class.find(".product-layout").css('display','none');
		updateURL();
		requestAjax();
	});
				$('#btn_resetAll').on("click",function(){
		opt_value_id 		= "";
		att_value_id 		= "";
		manu_value_id 		= "";
		$minPrice_new		= "",
		$maxPrice_new 		= "",
		text_search 		= "";
		subcate_value_id	= "";
		url = url.replace(/(&opt_id=)[^\&]+/,'');
		url = url.replace(/(&att_id=)[^\&]+/,'');
		url = url.replace(/(&manu_id=)[^\&]+/,'');
		url = url.replace(/(&minPrice=)[^\&]+/,'');
		url = url.replace(/(&maxPrice=)[^\&]+/,'');
		url = url.replace(/(&search=)[^\&]+/,'');
		url = url.replace(/(&subcate_id=)[^\&]+/,'');
		obj_class.find(".product-layout").css('display','none');
		updateURL();
		$('.content_min_max .input_min').val($minPrice);
		$('.content_min_max .input_max').val($maxPrice);
		if(($minPrice != 0 || $maxPrice != 0) && ($minPrice != $maxPrice)){
			range.noUiSlider.set([$minPrice, $maxPrice]);
		}
		
		$(".so-filter-option").removeClass("opt_active");
		$(".so-filter-option").find('.fa-check-square-o').removeClass('fa-check-square-o').addClass('fa-square-o');
		$(".so-filter-option").find(".option-count").removeClass("opt_close");

		$(".so-filter-option-sub").removeClass("opt_active");
		$(".so-filter-option-sub").find('.fa-check-square-o').removeClass('fa-check-square-o').addClass('fa-square-o');
		$(".so-filter-option-sub").find(".option-count").removeClass("opt_close");

		$("#text_search").val('');
		location.href= url;
	});
			function requestAjax(){
		var page = (getUrlVars()["page"] === "undefined" ? "1" : getUrlVars()["page"]);
		$.ajax({
			type: 'POST',
			url: 'https://dev.saterno.ru//index.php?route=extension/module/so_filter_shop_by/filter_data',
			data: {
				isFilterShopBy		: 1,
				opt_value_id		: opt_value_id,
				att_value_id		: att_value_id,
				manu_value_id		: manu_value_id,
				subcate_value_id	: subcate_value_id,
				minPrice 			: $minPrice_new,
				maxPrice 			: $maxPrice_new,
				text_search 		: text_search,
				category_id_path	: '322',
				page				: page,
				product_id_in        : $('.so_filter_wrap .modcontent > ul').attr('data-product_id'),
				product_arr_all 	: product_arr_all
			},
			success: function (data) {
				obj_class.html(data['html']);
				var text_right = obj_class.find(".product-layout").parent().next().find('.text-right').html();
				var text_left = obj_class.find(".product-layout").parent().next().find('.text-left').html();
				var text_center = obj_class.find(".product-layout").parent().next().find('.short-by-show.text-center').html();
				obj_class.next().find('.text-right').html(text_right);
				obj_class.next().find('.text-left').html('');
				obj_class.next().find('.short-by-show.text-center').html(text_center);
				obj_class.next().find('.box-pagination.text-right').html('');
				if(obj_class.find(".product-layout").length > 0){
					var html = obj_class.find(".product-layout").eq(0).parent().html();
					obj_class.html(html);

				}else{
					obj_class.html('<div class="col-xs-12">Not product</div>');
					obj_class.next().find('.text-right').css('display','none');
					obj_class.next().find('.short-by-show.text-center').css('display','none');
				}
				obj_class.find(".product-layout").fadeIn("show");
				$(".so_filter_wrap .modcontent ul").attr("data-product_id",data['product_arr']);
				$('#grid-view').click();
				getCountProduct();
				$load_gif.removeClass('loading-gif');
			},
			dataType: 'json'
		});
	}

});
//]]>
</script>			<div class="module banner-left hidden-xs">
    <div class="static-image-home-left"><a title="Доставка Saterno" href="/delivery"><img src="/App/templates/files/banner-delivery.png" alt="Доставка Saterno"></a></div></div>	</aside>
            	
    <div id="content" class="col-sm-12 col-md-9 col-xs-12">
    			<a href="javascript:void(0)" class="open-leftsidebar hidden-lg hidden-md"><i class="fa fa-align-left"></i> Sidebar</a>
		<div class="sidebar-overlay left "></div>
				        <div class="products-category">
			<!--// Begin  Today Deals-->
						
				<div class="form-group clearfix">
					<h3 class="title-category"><?php echo $category->name; ?></h3> 
					<div class="category-info row">
						<div class="img-cate container">
							<img src="/<?php echo $category->img->url . $category->img->name ?>" alt="ЗОЖ" title="ЗОЖ" class=" media-object" style="max-height: 298px;">
						</div>
										
						<div class="form-group col-sm-9 col-xs-12">
							<p><?php echo $category->description; ?></p>										
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

<?php require(__DIR__ . "/files/html/buy-cart-module.html"); ?>

<?php require(__DIR__ . "/files/html/right_menu.html"); ?>

<div id="cover"></div>
<div id="cover2"></div>
<div id="cover3"></div>

<script src="App/templates/files/js/popUp.js"></script>
<script src="App/templates/files/js/buyCartModule.js"></script>
	
			<!--// Begin Select Category Simple -->
				<!-- Filters -->
	<div class="product-filter filters-panel">
	  <div class="row">
		<div class="box-list col-md-2 hidden-sm hidden-xs">
			<div class="view-mode">
				<div class="list-view">
					<button class="btn btn-default grid active" data-toggle="tooltip" title="" data-original-title="Сетка"><i class="fa fa-th-large"></i></button>
					<button class="btn btn-default list " data-toggle="tooltip" title="" data-original-title="Список"><i class="fa fa-bars"></i></button>
				</div>
			</div>
		</div>
		<div class="short-by-show form-inline text-right col-md-10 col-sm-12">
			<div class="form-group short-by">
				<label class="control-label" for="input-sort">Сортировать:</label>
				<select id="input-sort" class="form-control" onchange="location = this.value;">
				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;sort=p.sort_order&amp;order=ASC" selected="selected">По умолчанию</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;sort=pd.name&amp;order=ASC">По имени (A - Я)</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;sort=pd.name&amp;order=DESC">По имени (Я - A)</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;sort=p.price&amp;order=ASC">По цене (возрастанию)</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;sort=p.price&amp;order=DESC">По цене (убыванию)</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;sort=rating&amp;order=DESC">По рейтингу (убыванию)</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;sort=rating&amp;order=ASC">По рейтингу (возрастанию)</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;sort=p.model&amp;order=ASC">По модели (A - Я)</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;sort=p.model&amp;order=DESC">По модели (Я - A)</option>
				  				  				</select>
			</div>

			<div class="form-group">
				<label class="control-label" for="input-limit">Показывать:</label>
				<select id="input-limit" class="form-control" onchange="location = this.value;">
				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;limit=8" selected="selected">8</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;limit=25">25</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;limit=50">50</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;limit=75">75</option>
				  				  				  				  <option value="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;limit=100">100</option>
				  				  				</select>
			</div>
			
			<div class="product-compare form-group" style="margin: 0 10px"><a href="https://dev.saterno.ru/index.php?route=product/compare" id="compare-total" class="btn btn-default"><i class="fa fa-refresh"></i> Сравнить</a></div>
			
		</div>
		
	  </div>
	</div>
	<!-- //end Filters -->
	
	<!--Changed Listings-->
	<div class="products-list row grid so-filter-gird">
		
		<div class="product-layout col-lg-3 col-md-4 col-sm-6 col-xs-12 " style="display: block;">
		<div class="product-item-container">
			<div class="left-block">
				<div class="product-image-container lazy second_img  lazy-loaded">
					<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/apple_cinema_30-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/apple_cinema_30-270x270.jpg" title="Apple Cinema 30&quot;" class="img-1 img-responsive">
										<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/canon_eos_5d_2-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/canon_eos_5d_2-270x270.jpg" alt="Apple Cinema 30&quot;" title="Apple Cinema 30&quot;" class="img-2 img-responsive">
									</div>
				<!--COUNTDOWN BOX-->
				

	
			</div>
			<div class="box-label">
				<!--New Label-->
															
				<!--Sale Label-->
													<span class="label-product label-sale">
						Скидка						-10% 
					</span>
											</div>  
			<!-- BOX BUTTON -->
			<div class="button-group">
				<!-- WISHLIST -->
				<button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('42');" data-original-title="В закладки"><i class="fa fa-heart"></i></button>
				<!-- CART -->
				<button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('42', '2');" data-original-title="В корзину"><span>В корзину</span></button>
				<!-- COMPARE -->
				<button class="compare btn-button" type="button" data-toggle="tooltip" title="" onclick="compare.add('42');" data-original-title="В сравнение"><i class="fa fa-refresh"></i></button>
				<!-- QUICK VIEW -->
									<a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="https://dev.saterno.ru/index.php?route=extension/soconfig/quickview&amp;product_id=42" data-original-title="Быстрый просмотр"> <i class="fa fa-search"></i> </a>
							</div>
			
			<div class="right-block">
				<div class="caption">
					<h4><a href="https://dev.saterno.ru/test">Apple Cinema 30"</a></h4>		
										<div class="ratings">
						<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		</div>
					</div>
										
										<div class="price">
													<span class="price-new">110.00 р.</span> <span class="price-old">122.00 р.</span>
										</div>
										
					<div class="description  hidden ">
						<p>
	The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel resolution. Designed specifically for the creative professional, this display provides more space for easier access to all ..</p>
					</div>
				</div>
			</div>
			<!-- right block -->
			
			

		</div>
	</div>
	<div class="clearfix visible-xs-block"></div>	
		
	
		<div class="product-layout col-lg-3 col-md-4 col-sm-6 col-xs-12 " style="display: block;">
		<div class="product-item-container">
			<div class="left-block">
				<div class="product-image-container lazy second_img  lazy-loaded">
					<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/canon_eos_5d_1-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/canon_eos_5d_1-270x270.jpg" title="Canon EOS 5D" class="img-1 img-responsive">
										<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/canon_eos_5d_2-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/canon_eos_5d_2-270x270.jpg" alt="Canon EOS 5D" title="Canon EOS 5D" class="img-2 img-responsive">
									</div>
				<!--COUNTDOWN BOX-->
				

	
			</div>
			<div class="box-label">
				<!--New Label-->
															
				<!--Sale Label-->
													<span class="label-product label-sale">
						Скидка						-20% 
					</span>
											</div>  
			<!-- BOX BUTTON -->
			<div class="button-group">
				<!-- WISHLIST -->
				<button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('30');" data-original-title="В закладки"><i class="fa fa-heart"></i></button>
				<!-- CART -->
				<button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('30', '1');" data-original-title="В корзину"><span>В корзину</span></button>
				<!-- COMPARE -->
				<button class="compare btn-button" type="button" data-toggle="tooltip" title="" onclick="compare.add('30');" data-original-title="В сравнение"><i class="fa fa-refresh"></i></button>
				<!-- QUICK VIEW -->
									<a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="https://dev.saterno.ru/index.php?route=extension/soconfig/quickview&amp;product_id=30" data-original-title="Быстрый просмотр"> <i class="fa fa-search"></i> </a>
							</div>
			
			<div class="right-block">
				<div class="caption">
					<h4><a href="https://dev.saterno.ru/canon-eos-5d">Canon EOS 5D</a></h4>		
										<div class="ratings">
						<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		</div>
					</div>
										
										<div class="price">
													<span class="price-new">98.00 р.</span> <span class="price-old">122.00 р.</span>
										</div>
										
					<div class="description  hidden ">
						<p>
	Canon's press material for the EOS 5D states that it 'defines (a) new D-SLR category', while we're not typically too concerned with marketing talk this particular statement is clearly pretty accura..</p>
					</div>
				</div>
			</div>
			<!-- right block -->
			
			

		</div>
	</div>
	<div class="clearfix visible-sm-block"></div><div class="clearfix visible-xs-block"></div>	
		
	
		<div class="product-layout col-lg-3 col-md-4 col-sm-6 col-xs-12 " style="display: block;">
		<div class="product-item-container">
			<div class="left-block">
				<div class="product-image-container lazy second_img  lazy-loaded">
					<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/hp_1-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/hp_1-270x270.jpg" title="HP LP3065" class="img-1 img-responsive">
										<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/hp_2-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/hp_2-270x270.jpg" alt="HP LP3065" title="HP LP3065" class="img-2 img-responsive">
									</div>
				<!--COUNTDOWN BOX-->
				

	
			</div>
			<div class="box-label">
				<!--New Label-->
															
				<!--Sale Label-->
															</div>  
			<!-- BOX BUTTON -->
			<div class="button-group">
				<!-- WISHLIST -->
				<button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('47');" data-original-title="В закладки"><i class="fa fa-heart"></i></button>
				<!-- CART -->
				<button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('47', '1');" data-original-title="В корзину"><span>В корзину</span></button>
				<!-- COMPARE -->
				<button class="compare btn-button" type="button" data-toggle="tooltip" title="" onclick="compare.add('47');" data-original-title="В сравнение"><i class="fa fa-refresh"></i></button>
				<!-- QUICK VIEW -->
									<a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="https://dev.saterno.ru/index.php?route=extension/soconfig/quickview&amp;product_id=47" data-original-title="Быстрый просмотр"> <i class="fa fa-search"></i> </a>
							</div>
			
			<div class="right-block">
				<div class="caption">
					<h4><a href="https://dev.saterno.ru/hp-lp3065">HP LP3065</a></h4>		
										<div class="ratings">
						<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		</div>
					</div>
										
										<div class="price">
													<span class="price-new">122.00 р.</span>
											</div>
										
					<div class="description  hidden ">
						<p>
	Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel Monitor. This flagship monitor features best-in-class performance and presentation features on a hug..</p>
					</div>
				</div>
			</div>
			<!-- right block -->
			
			

		</div>
	</div>
	<div class="clearfix visible-md-block"></div><div class="clearfix visible-xs-block"></div>	
		
	
		<div class="product-layout col-lg-3 col-md-4 col-sm-6 col-xs-12 " style="display: block;">
		<div class="product-item-container">
			<div class="left-block">
				<div class="product-image-container lazy second_img  lazy-loaded">
					<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/htc_touch_hd_1-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/htc_touch_hd_1-270x270.jpg" title="HTC Touch HD" class="img-1 img-responsive">
										<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/htc_touch_hd_3-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/htc_touch_hd_3-270x270.jpg" alt="HTC Touch HD" title="HTC Touch HD" class="img-2 img-responsive">
									</div>
				<!--COUNTDOWN BOX-->
				

	
			</div>
			<div class="box-label">
				<!--New Label-->
															
				<!--Sale Label-->
															</div>  
			<!-- BOX BUTTON -->
			<div class="button-group">
				<!-- WISHLIST -->
				<button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('28');" data-original-title="В закладки"><i class="fa fa-heart"></i></button>
				<!-- CART -->
				<button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('28', '1');" data-original-title="В корзину"><span>В корзину</span></button>
				<!-- COMPARE -->
				<button class="compare btn-button" type="button" data-toggle="tooltip" title="" onclick="compare.add('28');" data-original-title="В сравнение"><i class="fa fa-refresh"></i></button>
				<!-- QUICK VIEW -->
									<a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="https://dev.saterno.ru/index.php?route=extension/soconfig/quickview&amp;product_id=28" data-original-title="Быстрый просмотр"> <i class="fa fa-search"></i> </a>
							</div>
			
			<div class="right-block">
				<div class="caption">
					<h4><a href="https://dev.saterno.ru/htc-touch-hd">HTC Touch HD</a></h4>		
										<div class="ratings">
						<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		</div>
					</div>
										
										<div class="price">
													<span class="price-new">122.00 р.</span>
											</div>
										
					<div class="description  hidden ">
						<p>
	HTC Touch - in High Definition. Watch music videos and streaming content in awe-inspiring high definition clarity for a mobile experience you never thought possible. Seductively sleek, the HTC Touc..</p>
					</div>
				</div>
			</div>
			<!-- right block -->
			
			

		</div>
	</div>
	<div class="clearfix visible-lg-block"></div><div class="clearfix visible-sm-block"></div><div class="clearfix visible-xs-block"></div>	
		
	
		<div class="product-layout col-lg-3 col-md-4 col-sm-6 col-xs-12 " style="display: block;">
		<div class="product-item-container">
			<div class="left-block">
				<div class="product-image-container lazy second_img  lazy-loaded">
					<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/macbook_pro_1-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/macbook_pro_1-270x270.jpg" title="MacBook Pro" class="img-1 img-responsive">
										<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/macbook_pro_4-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/macbook_pro_4-270x270.jpg" alt="MacBook Pro" title="MacBook Pro" class="img-2 img-responsive">
									</div>
				<!--COUNTDOWN BOX-->
				

	
			</div>
			<div class="box-label">
				<!--New Label-->
															
				<!--Sale Label-->
															</div>  
			<!-- BOX BUTTON -->
			<div class="button-group">
				<!-- WISHLIST -->
				<button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('45');" data-original-title="В закладки"><i class="fa fa-heart"></i></button>
				<!-- CART -->
				<button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('45', '1');" data-original-title="В корзину"><span>В корзину</span></button>
				<!-- COMPARE -->
				<button class="compare btn-button" type="button" data-toggle="tooltip" title="" onclick="compare.add('45');" data-original-title="В сравнение"><i class="fa fa-refresh"></i></button>
				<!-- QUICK VIEW -->
									<a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="https://dev.saterno.ru/index.php?route=extension/soconfig/quickview&amp;product_id=45" data-original-title="Быстрый просмотр"> <i class="fa fa-search"></i> </a>
							</div>
			
			<div class="right-block">
				<div class="caption">
					<h4><a href="https://dev.saterno.ru/macbook-pro">MacBook Pro</a></h4>		
										<div class="ratings">
						<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		</div>
					</div>
										
										<div class="price">
													<span class="price-new">2 000.00 р.</span>
											</div>
										
					<div class="description  hidden ">
						<p>
	
		
			Latest Intel mobile architecture
		
			Powered by the most advanced mobile processors from Intel, the new Core 2 Duo MacBook Pro is over 50% faster than the original Core Duo MacBook Pro..</p>
					</div>
				</div>
			</div>
			<!-- right block -->
			
			

		</div>
	</div>
	<div class="clearfix visible-xs-block"></div>	
		
	
		<div class="product-layout col-lg-3 col-md-4 col-sm-6 col-xs-12 " style="display: block;">
		<div class="product-item-container">
			<div class="left-block">
				<div class="product-image-container lazy second_img  lazy-loaded">
					<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/nikon_d300_1-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/nikon_d300_1-270x270.jpg" title="Nikon D300" class="img-1 img-responsive">
										<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/nikon_d300_5-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/nikon_d300_5-270x270.jpg" alt="Nikon D300" title="Nikon D300" class="img-2 img-responsive">
									</div>
				<!--COUNTDOWN BOX-->
				

	
			</div>
			<div class="box-label">
				<!--New Label-->
															
				<!--Sale Label-->
															</div>  
			<!-- BOX BUTTON -->
			<div class="button-group">
				<!-- WISHLIST -->
				<button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('31');" data-original-title="В закладки"><i class="fa fa-heart"></i></button>
				<!-- CART -->
				<button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('31', '1');" data-original-title="В корзину"><span>В корзину</span></button>
				<!-- COMPARE -->
				<button class="compare btn-button" type="button" data-toggle="tooltip" title="" onclick="compare.add('31');" data-original-title="В сравнение"><i class="fa fa-refresh"></i></button>
				<!-- QUICK VIEW -->
									<a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="https://dev.saterno.ru/index.php?route=extension/soconfig/quickview&amp;product_id=31" data-original-title="Быстрый просмотр"> <i class="fa fa-search"></i> </a>
							</div>
			
			<div class="right-block">
				<div class="caption">
					<h4><a href="https://dev.saterno.ru/nikon-d300">Nikon D300</a></h4>		
										<div class="ratings">
						<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		</div>
					</div>
										
										<div class="price">
													<span class="price-new">98.00 р.</span>
											</div>
										
					<div class="description  hidden ">
						<p>
	
		Engineered with pro-level features and performance, the 12.3-effective-megapixel D300 combines brand new technologies with advanced features inherited from Nikon's newly announced D3 profes..</p>
					</div>
				</div>
			</div>
			<!-- right block -->
			
			

		</div>
	</div>
	<div class="clearfix visible-md-block"></div><div class="clearfix visible-sm-block"></div><div class="clearfix visible-xs-block"></div>	
		
	
		<div class="product-layout col-lg-3 col-md-4 col-sm-6 col-xs-12 " style="display: block;">
		<div class="product-item-container">
			<div class="left-block">
				<div class="product-image-container lazy second_img  lazy-loaded">
					<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/palm_treo_pro_1-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/palm_treo_pro_1-270x270.jpg" title="Palm Treo Pro" class="img-1 img-responsive">
										<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/palm_treo_pro_3-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/palm_treo_pro_3-270x270.jpg" alt="Palm Treo Pro" title="Palm Treo Pro" class="img-2 img-responsive">
									</div>
				<!--COUNTDOWN BOX-->
				

	
			</div>
			<div class="box-label">
				<!--New Label-->
															
				<!--Sale Label-->
															</div>  
			<!-- BOX BUTTON -->
			<div class="button-group">
				<!-- WISHLIST -->
				<button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('29');" data-original-title="В закладки"><i class="fa fa-heart"></i></button>
				<!-- CART -->
				<button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('29', '1');" data-original-title="В корзину"><span>В корзину</span></button>
				<!-- COMPARE -->
				<button class="compare btn-button" type="button" data-toggle="tooltip" title="" onclick="compare.add('29');" data-original-title="В сравнение"><i class="fa fa-refresh"></i></button>
				<!-- QUICK VIEW -->
									<a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="https://dev.saterno.ru/index.php?route=extension/soconfig/quickview&amp;product_id=29" data-original-title="Быстрый просмотр"> <i class="fa fa-search"></i> </a>
							</div>
			
			<div class="right-block">
				<div class="caption">
					<h4><a href="https://dev.saterno.ru/palm-treo-pro">Palm Treo Pro</a></h4>		
										<div class="ratings">
						<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		</div>
					</div>
										
										<div class="price">
													<span class="price-new">337.99 р.</span>
											</div>
										
					<div class="description  hidden ">
						<p>
	Redefine your workday with the Palm Treo Pro smartphone. Perfectly balanced, you can respond to business and personal email, stay on top of appointments and contacts, and use Wi-Fi or GPS when you&amp;..</p>
					</div>
				</div>
			</div>
			<!-- right block -->
			
			

		</div>
	</div>
	<div class="clearfix visible-xs-block"></div>	
		
	
		<div class="product-layout col-lg-3 col-md-4 col-sm-6 col-xs-12 " style="display: block;">
		<div class="product-item-container">
			<div class="left-block">
				<div class="product-image-container lazy second_img  lazy-loaded">
					<img data-src="https://dev.saterno.ru/image/cache/catalog/demo/samsung_syncmaster_941bw-270x270.jpg" src="https://dev.saterno.ru/image/cache/catalog/demo/samsung_syncmaster_941bw-270x270.jpg" title="Samsung SyncMaster 941BW" class="img-1 img-responsive">
										<img data-src="https://dev.saterno.ru/image/cache/no_image-270x270.png" src="https://dev.saterno.ru/image/cache/no_image-270x270.png" alt="Samsung SyncMaster 941BW" title="Samsung SyncMaster 941BW" class="img-2 img-responsive">
									</div>
				<!--COUNTDOWN BOX-->
				

	
			</div>
			<div class="box-label">
				<!--New Label-->
															
				<!--Sale Label-->
															</div>  
			<!-- BOX BUTTON -->
			<div class="button-group">
				<!-- WISHLIST -->
				<button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('33');" data-original-title="В закладки"><i class="fa fa-heart"></i></button>
				<!-- CART -->
				<button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('33', '1');" data-original-title="В корзину"><span>В корзину</span></button>
				<!-- COMPARE -->
				<button class="compare btn-button" type="button" data-toggle="tooltip" title="" onclick="compare.add('33');" data-original-title="В сравнение"><i class="fa fa-refresh"></i></button>
				<!-- QUICK VIEW -->
									<a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="https://dev.saterno.ru/index.php?route=extension/soconfig/quickview&amp;product_id=33" data-original-title="Быстрый просмотр"> <i class="fa fa-search"></i> </a>
							</div>
			
			<div class="right-block">
				<div class="caption">
					<h4><a href="https://dev.saterno.ru/samsung-syncmaster-941bw">Samsung SyncMaster 941BW</a></h4>		
										<div class="ratings">
						<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																								<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		</div>
					</div>
										
										<div class="price">
													<span class="price-new">242.00 р.</span>
											</div>
										
					<div class="description  hidden ">
						<p>
	Imagine the advantages of going big without slowing down. The big 19" 941BW monitor combines wide aspect ratio with fast pixel response time, for bigger images, more room to work and crisp mot..</p>
					</div>
				</div>
			</div>
			<!-- right block -->
			
			

		</div>
	</div>
	<div class="clearfix visible-lg-block"></div><div class="clearfix visible-sm-block"></div><div class="clearfix visible-xs-block"></div>	
		
</div>	<!--// End Changed listings-->
	
	<!-- Filters -->
	<div class="product-filter product-filter-bottom filters-panel">
	  <div class="row">
		<div class="box-list col-md-2 hidden-sm hidden-xs">
			<div class="view-mode">
				<div class="list-view">
					<button class="btn btn-default grid active" data-toggle="tooltip" title="" data-original-title="Сетка"><i class="fa fa-th-large"></i></button>
					<button class="btn btn-default list " data-toggle="tooltip" title="" data-original-title="Список"><i class="fa fa-bars"></i></button>
				</div>
			</div>
		</div>
	   <div class="short-by-show text-center col-md-6 col-sm-8 col-xs-12">
			<div class="form-group" style="margin:0px">Показано с 1 по 8 из 11 (всего 2 страниц)</div>
		</div>
					<div class="box-pagination col-md-4 col-sm-4 text-right"><ul class="pagination"><li class="active"><span>1</span></li><li><a href="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;page=2">2</a></li><li><a href="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;page=2">&gt;</a></li><li><a href="https://dev.saterno.ru/index.php?route=product/category&amp;path=322&amp;page=2">&gt;|</a></li></ul></div>
				
	  </div>
	</div>
	<!-- //end Filters -->

					
						<!--End content-->
		
		<script type="text/javascript"><!--
		 $('.view-mode .list-view button').bind("click", function() {
			if ($(this).is(".active")) {return false;}
			$.cookie('listingType', $(this).is(".grid") ? 'grid' : 'list', { path: '/' });
			location.reload();
		});
		//--></script> 
		
				</div>
    </div>
	  
    </div>
<?php require(__DIR__ . "/files/html/footer.html");?>		
	
    </div>

<script src="/App/templates/files/js/link_for_version2.js"></script>
</body></html>