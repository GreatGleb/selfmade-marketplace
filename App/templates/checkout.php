<?php 
	if($boughtProducts == NULL) {
		header('Location: home');
	}
?>
<!DOCTYPE html>
<!-- saved from url=(0032)https://saterno.ru/checkout/ -->
<html lang="ru">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Оформление заказа</title>
      <meta name="description" content="">
      <meta name="keywords" content="Мягкие кресла">
      <meta name="robots" content="index,follow">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <link rel="icon" type="image/x-icon" href="App/templates/index_files/saternologomini.jpg">
      <style type="text/css">
         html, body, div, span, applet, object, iframe,
         h1, h2, h3, h4, h5, h6, p, blockquote, pre,
         a, abbr, acronym, address, big, cite, code,
         del, dfn, em, img, ins, kbd, q, s, samp,
         small, strike, strong, sub, sup, tt, var,
         b, u, i, center,
         dl, dt, dd, ol, ul, li,
         fieldset, form, label, legend,
         table, caption, tbody, tfoot, thead, tr, th, td,
         article, aside, canvas, details, embed,
         figure, figcaption, footer, header, hgroup,
         menu, nav, output, ruby, section, summary,
         time, mark, audio, video {
         margin: 0;
         padding: 0;
         border: 0;
         font-size: 100%;
         font: inherit;
         vertical-align: baseline;
         }
         /* HTML5 display-role reset for older browsers */
         article, aside, details, figcaption, figure,
         footer, header, hgroup, menu, nav, section {
         display: block;
         }
         body {
         line-height: 1;
         }
         ol, ul {
         list-style: none;
         }
         body {
         font: 62.5%/1.4 BlinkMacSystemFont, -apple-system, Arial, "Segoe UI", Roboto, Helvetica, sans-serif;
         -webkit-font-smoothing: antialiased;
         -webkit-tap-highlight-color: transparent;
         text-size-adjust: 100%;
         -webkit-text-size-adjust: 100%;
         color: #333;
         }
      </style>
      <link rel="stylesheet" href="App/templates/checkout-assets/css/common.min.css">
      <link rel="stylesheet" href="App/templates/checkout-assets/css/styles.a338358e36b5e74052db.css">
	  <link rel="stylesheet" href="App/templates/checkout-assets/css/popUp.css">
	  <link rel="stylesheet" href="App/templates/files/css/buyCart.css">
	  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,300,700,900" rel="stylesheet" type="text/css">
	  <style>.checkout-wrapper{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;min-height:100vh}.checkout-wrapper__bottom{margin-top:auto}.checkout-layout{width:100%;max-width:1100px;margin:0 auto;padding-left:16px;padding-right:16px;-webkit-box-sizing:border-box;box-sizing:border-box}.checkout-heading{margin-bottom:16px;font-size:24px}@media (min-width:1024px){.checkout-heading{margin-bottom:40px;font-size:36px}}.checkout-block{margin-bottom:24px;border-bottom:1px solid #e9e9e9}@media (min-width:768px){.checkout-layout{padding-left:24px;padding-right:24px}.checkout-block{padding-left:40px}}.checkout-block--filled .checkout-block__title-informer{background-color:#ffa800;color:#fff}.checkout-block_no_border{border:none}.checkout-block__title{position:relative;margin-bottom:24px;padding-left:40px;font-size:16px}legend.checkout-block__title.seller{font-size: 18px;}.checkout-block__title-informer{position:absolute;left:0;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;width:24px;height:24px;border-radius:50%;margin-right:16px;background-color:#e9e9e9;font-size:14px;line-height:24px}@media (min-width:768px){.checkout-block__title{padding-left:0}.checkout-block__title-informer{left:-40px}}.checkout-block__title-button{margin-right:16px;font-size:16px;text-align:left}</style>
      <style>.checkout-form{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start}.checkout-form__content{width:100%}.checkout-form__sidebar{width:100%}@media (min-width:1024px){.checkout-form{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}.checkout-form__content{padding-right:48px;-webkit-box-sizing:border-box;box-sizing:border-box}.checkout-form__sidebar{position:-webkit-sticky;position:sticky;top:20px;width:284px;-ms-flex-negative:0;flex-shrink:0}}</style>
      <style>.checkout-form[_ngcontent-c86]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start}.checkout-form__content[_ngcontent-c86]{width:100%}.checkout-form__sidebar[_ngcontent-c86]{width:100%}@media (min-width:1024px){.checkout-form[_ngcontent-c86]{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}.checkout-form__content[_ngcontent-c86]{padding-right:48px;-webkit-box-sizing:border-box;box-sizing:border-box}.checkout-form__sidebar[_ngcontent-c86]{position:-webkit-sticky;position:sticky;top:20px;width:284px;-ms-flex-negative:0;flex-shrink:0}}</style>
      <style>.checkout-header{margin-bottom:24px}.checkout-header__inner{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;padding-top:8px;padding-bottom:8px;border-bottom:1px solid #e9e9e9;-webkit-box-sizing:border-box;box-sizing:border-box;font-size:12px}@media (min-width:1024px){.checkout-header__inner{padding-top:16px;padding-bottom:16px}}.checkout-header__logo{height:45px}.checkout-header__info{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.checkout-header__phone{display:none;color:#797878}@media (min-width:768px){.checkout-header__phone{display:block}}.checkout-header__phone a{color:#221f1f}.checkout-header__button{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;width:48px;height:48px;padding:0;font-size:100%}@media (min-width:1024px){.checkout-header__button{width:auto;height:auto;margin-left:16px}}.checkout-header__button:hover{text-decoration:none}.checkout-header__button-text{display:none}@media (min-width:1280px){.checkout-header__button-text{color: #667; display:block}.checkout-header__button-text:hover{color: #f4a137;}.checkout-header__button .button-info{display:none}}.checkout-header__modal-phone{display:inline-block;margin-bottom:24px;font-size:16px}.checkout-header__modal-schedule{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-bottom:8px;font-size:14px}.checkout-header__modal-day,.checkout-header__modal-time{width:50%;margin-bottom:8px}.checkout-header__modal-attention{font-size:14px;color:#f84147}</style>
      
	  <style>[_nghost-c91]{display:block;margin-top:auto}.checkout-footer[_ngcontent-c91]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:center;-ms-flex-align:center;align-items:center;padding-top:24px;padding-bottom:24px;font-size:12px}.checkout-footer__copyright[_ngcontent-c91]{margin-right:16px}</style>
      <style>.checkout-order{margin-top:48px}.checkout-order__header{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:end;-ms-flex-align:end;align-items:flex-end;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;border-bottom:1px solid #e9e9e9;margin-top:16px;margin-bottom:16px;padding-bottom:16px}.checkout-order__heading{font-size:22px}@media (min-width:768px){.checkout-order__heading{font-size:28px}}.checkout-order__total{font-size:16px}.checkout-order .preloader_type_element:before{z-index:99}.checkout-product{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:center;-ms-flex-align:center;align-items:center;padding-bottom:16px}@media (min-width:768px){.checkout-product{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start}}.checkout-product+.checkout-product{border-top:1px solid #e9e9e9;padding-top:16px}.checkout-product__header{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;margin-bottom:16px}.checkout-product__header:not(:first-child) { padding-top: 16px; border-top: 1px solid #e9e9e9; } .container_delivery {padding-left: 40px;}.checkout-product__header .checkout-block__title{margin-bottom:0}.checkout-product__edit-button{font-size:14px}.checkout-product__title{width:100%;margin-bottom:16px;font-size:12px;line-height:17px}@media (min-width:768px){.checkout-product__title{width:60%;margin-bottom:0}}.checkout-product__figure,.checkout-product__picture{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.checkout-product__picture{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-ms-flex-negative:0;flex-shrink:0;width:56px;height:56px;margin-right:16px}.checkout-product__picture img{width:auto;max-width:100%;height:auto;max-height:100%}.checkout-product__options{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;width:100%}@media (min-width:768px){.checkout-product__options{width:40%}}.checkout-product__option{width:33.33333%;text-align:center}.checkout-product__label{display:block;margin-bottom:4px;color:#797878}.checkout-product__digit{font-size:14px}.checkout-product__price_color_red{color:#f84147}.checkout-product__price_type_old{display:block;margin-top:2px;font-size:10px;color:#797878;text-decoration:line-through}.checkout-variant{margin-bottom:16px}.checkout-variant__inner{padding-left:16px;padding-right:16px;border:1px solid transparent;border-radius:4px}.checkout-variant__inner--selected{padding-top:16px;padding-bottom:16px;border:1px solid #f4a137}.checkout-variant__radio .checkout-variant__radio{margin-left:32px}.checkout-variant__label{width:100%;-webkit-box-sizing:border-box;box-sizing:border-box}.checkout-variant__body{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between}.checkout-variant__title{margin-bottom:4px;font-size:14px}.checkout-variant__option{display:block;width:100%;margin-top:4px;font-size:12px;color:#797878}@media (min-width:768px){.checkout-variant__body{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}.checkout-variant__title{margin-bottom:0}.checkout-variant__option{margin-top:0}}.checkout-variant__price{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;font-size:14px}.checkout-variant__price_color_green{color:#00a046}.checkout-variant__price_color_gray{margin-left:16px;color:#797878;text-decoration:line-through;display:block;text-align:right}@media (min-width:768px){.checkout-variant__price{display:block}.checkout-variant__price_color_gray{margin-left:0}}.checkout-variant__content{padding-top:16px;padding-left:40px}.checkout-variant__content--hidden,.checkout-variant__content:empty{display:none}</style>
      <style>[_nghost-c96]{width:100%}.checkout-product[_ngcontent-c96]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:center;-ms-flex-align:center;align-items:center;padding-bottom:16px}@media (min-width:768px){.checkout-product[_ngcontent-c96]{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start}}.checkout-product[_ngcontent-c96] + .checkout-product[_ngcontent-c96]{border-top:1px solid #e9e9e9;padding-top:16px}.checkout-product__header[_ngcontent-c96]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;margin-bottom:16px}.checkout-product__header[_ngcontent-c96]   .checkout-block__title[_ngcontent-c96]{margin-bottom:0}.checkout-product__edit-button[_ngcontent-c96]{font-size:14px;line-height:1.2}.checkout-product__edit-button[_ngcontent-c96]:hover{text-decoration:none}.checkout-product__edit-button[_ngcontent-c96]   .link-dashed[_ngcontent-c96]{width:0;height:0;overflow:hidden}.checkout-product__edit-button[_ngcontent-c96]   svg[_ngcontent-c96]{margin-left:12px}.checkout-product__title[_ngcontent-c96]{width:100%;margin-bottom:16px;font-size:12px;line-height:17px}@media (min-width:768px){.checkout-product__edit-button[_ngcontent-c96]   .link-dashed[_ngcontent-c96]{width:auto;height:auto;overflow:visible}.checkout-product__edit-button[_ngcontent-c96]   svg[_ngcontent-c96]{margin-left:0}.checkout-product__title[_ngcontent-c96]{width:60%;margin-bottom:0}}@media (hover:hover){.checkout-product__title[_ngcontent-c96]:hover{text-decoration:none}.checkout-product__title[_ngcontent-c96]:hover   .checkout-product__title-product[_ngcontent-c96]{text-decoration:underline}}.checkout-product__figure[_ngcontent-c96], .checkout-product__picture[_ngcontent-c96]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.checkout-product__picture[_ngcontent-c96]{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-ms-flex-negative:0;flex-shrink:0;width:56px;height:56px;margin-right:16px}.checkout-product__picture[_ngcontent-c96]   img[_ngcontent-c96]{width:auto;max-width:100%;height:auto;max-height:100%}.checkout-product__message[_ngcontent-c96]{margin-top:4px}.checkout-product__message_color_red[_ngcontent-c96]{color:#f84147}.checkout-product__options[_ngcontent-c96]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;width:100%}@media (min-width:768px){.checkout-product__options[_ngcontent-c96]{width:40%}}.checkout-product__option[_ngcontent-c96]{width:33.33333%;text-align:center}.checkout-product__label[_ngcontent-c96]{display:block;margin-bottom:4px;color:#797878}.checkout-product__digit[_ngcontent-c96]{font-size:14px}.checkout-product__price_color_red[_ngcontent-c96]{color:#f84147}.checkout-product__price_type_old[_ngcontent-c96]{display:block;margin-top:2px;font-size:10px;color:#797878;text-decoration:line-through}</style>
      
      <style>.recipient[_ngcontent-c100]{padding-bottom:24px}.recipient__title[_ngcontent-c100]{margin-bottom:8px;font-family:BlinkMacSystemFont,-apple-system,Arial,Segoe UI,Roboto,Helvetica,sans-serif;font-size:16px}</style>
      <style>.checkout-sidebar{margin-top:32px}@media (min-width:1024px){.checkout-sidebar{margin-top:0}}.checkout-total{padding:16px;background-color:#f5f5f5;border-radius:4px;border:1px solid #e9e9e9}.checkout-total__hading{font-size:28px;margin-bottom:16px}.checkout-total__row{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;width:100%}.checkout-total__row+.checkout-total__row{margin-top:12px}.checkout-total__row_type_bordered{border-top:1px solid #e9e9e9;border-bottom:1px solid #e9e9e9;padding-top:16px;padding-bottom:16px}.checkout-total__row_type_column{-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.checkout-total__row_type_column .checkout-total__label,.checkout-total__row_type_column .checkout-total__value{width:100%}.checkout-total__row_type_column>.checkout-total__label{margin-bottom:4px}.checkout-total__row_type_column>.checkout-total__value{text-align:left}.checkout-total__label{font-size:14px;color:#797878}.checkout-total__value{text-align:right;font-size:14px}.checkout-total__value p+p{margin-top:4px}.checkout-total__value_size_large{font-size:24px}.checkout-total__buttons{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;margin-top:16px;margin-bottom:16px}@media (min-width:768px){.checkout-total__buttons{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center}}@media (min-width:1024px){.checkout-total__buttons{-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start}}.checkout-total__call{-webkit-box-flex:1;-ms-flex:1;flex:1;width:100%;margin-bottom:16px;-webkit-box-sizing:border-box;box-sizing:border-box;font-size:14px}.checkout-total__submit{width:100%;padding-left:12px;padding-right:12px}@media (min-width:768px){.checkout-total__call{margin-bottom:0}.checkout-total__submit{-webkit-box-flex:1;-ms-flex:1;flex:1}}@media (min-width:1024px){.checkout-total__call{margin-bottom:16px}.checkout-total__submit{-webkit-box-flex:1;-ms-flex:auto;flex:auto}}.checkout-total__caption{margin-top:16px;font-size:12px;color:#797878}.checkout-total__caption button{font-size:100%}.checkout-legacy{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;padding-top:16px;padding-bottom:16px}.checkout-legacy__message{margin-bottom:16px;font-size:12px;color:#797878}@media (min-width:420px){.checkout-legacy{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}.checkout-legacy__message{margin-right:16px;margin-bottom:0}}@media (min-width:1024px){.checkout-legacy{-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.checkout-legacy__message{margin-right:0;margin-bottom:16px}.checkout-legacy__button{width:100%}}.checkout-legacy__button{-ms-flex-negative:0;flex-shrink:0}</style>
      <style>
      .container {
  margin: 20px;
  max-width: 440px;
}

.custom-select-wrapper {
  position: relative;
  user-select: none;
  width: 100%;
}

.custom-dropdown-select {
  display: flex;
  flex-direction: column;
  border-width: 0 2px 0 2px;
  border-style: solid;
  border-color: #000;
    border-radius: 6px 6px 6px 6px;
}

.custom-dropdown-select.open {
    border-radius: 6px 6px 0 0;
}

.custom-select__trigger {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 5px 0 15px;
    font-size: 15px;
    font-weight: 300;
    color: #3b3b3b;
    height: 25px;
    line-height: 25px;
    background: #ffffff;
    cursor: pointer;
    border-width: 2px 0 2px 0;
    border-style: solid;
    border-color: #000;
    border-radius: 6px 6px 6px 6px;
}
.custom-dropdown-select.open .custom-select__trigger {
    border-radius: 6px 6px 0 0;
}

.custom-options {
  position: absolute;
  display: block;
  top: 100%;
  left: 0;
  right: 0;
  border: 2px solid #000;
  border-top: 0;
    border-radius: 0px 0px 6px 6px;
  background: #fff;
  transition: all 0.5s;
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  z-index: 2;
    max-height: 317px;
    overflow-y: auto;
    width: 100%;
}

.custom-dropdown-select.open .custom-options {
  opacity: 1;
  visibility: visible;
  pointer-events: all;
}

.custom-option {
    position: relative;
    display: block;
    padding: 5px 10px 3px 22px;
    font-size: 15px;
    font-weight: 300;
    color: #3b3b3b;
    line-height: 20px;
    cursor: pointer;
    transition: all 0.5s;
}

.custom-option:hover {
  cursor: pointer;
  background-color: #ffca58;
}

.custom-option.selected {
  color: #ffffff;
    background-color: #f7c75f;
}

.arrow {
  position: relative;
  height: 10px;
  width: 10px;
}

.arrow::before,
.arrow::after {
  content: "";
  position: absolute;
  bottom: 0px;
  width: 2px;
  height: 100%;
  transition: all 0.5s;
}

.arrow::before {
  left: -1px;
  transform: rotate(45deg);
  background-color: #000;
}

.arrow::after {
  left: 5px;
  transform: rotate(-45deg);
  background-color: #000;
}

.open .arrow::before {
  left: -1px;
  transform: rotate(-45deg);
}

.open .arrow::after {
  left: 5px;
  transform: rotate(45deg);
}</style>
   </head>
   <body class="" style="">
      <app-root ng-version="7.2.10">
         <div class="wrapper central-wrapper js-wrapper wrapper_no_padding" style="padding-top: 0px;">
            <section class="js-bottom-text" style="order: 2">
               <!---->
            </section>
            <div style="order:1">
			   <div class="app-rz-common">
                  <iframe style="display: none" src="App/templates/checkout-assets/html/iframe_recent_goods.html"></iframe>
                  <overlay>
                     <div aria-hidden="true" class="page-overlay"></div>
                  </overlay>
               </div>
               <rz-checkout-main>
                  <div class="preloader" hidden=""></div>
                  <section class="checkout-layout">
                     <router-outlet></router-outlet>
                     <rz-checkout-orders>
                        <rz-checkout-orders-content _nghost-c86="">
                           <div _ngcontent-c86="" class="central-wrapper">
                              <rz-checkout-header _ngcontent-c86="">
                                 <header class="checkout-header">
                                    <div class="checkout-header__inner">
                                       <a href="/"">
											<img class="checkout-header__logo js-logo" src="App/templates/index_files/saternologomain.png" alt="Интернет магазин Saterno - №1">
									   </a>
                                       <div class="checkout-header__info">
                                          <button class="button button_color_white button_type_link checkout-header__button">
                                             <span class="checkout-header__button-text js-schedule toggleModal0">Контактные телефоны </span>
											 <span class="button-info toggleModal0">
												<svg aria-hidden="true" height="9" width="2">
													<svg viewBox="0 0 2 9" fill="none" id="icon-info">
														<path fill-rule="evenodd" clip-rule="evenodd" d="M1.5 3V9H0.5V3H1.5Z" fill="#797878"></path>
														<path d="M2 1C2 1.55228 1.55228 2 1 2C0.447715 2 0 1.55228 0 1C0 0.447715 0.447715 0 1 0C1.55228 0 2 0.447715 2 1Z" fill="#797878"></path>
													</svg>
												</svg>
											</span>
                                          </button>
                                       </div>
                                    </div>
                                 </header>
                              </rz-checkout-header>
                              <!----><!----><!---->
                              <h1 class="checkout-heading"> Оформление заказа </h1>
                              <form _ngcontent-c86="" novalidate="" class="ng-untouched ng-dirty ng-invalid">
                                 <div _ngcontent-c86="" class="checkout-form">
                                    <main _ngcontent-c86="" class="checkout-form__content">
                                       <!---->
                                       <rz-checkout-contact-info _ngcontent-c86="">
                                          <fieldset class="checkout-block checkout-block_no_border first_block">
                                             <legend class="checkout-block__title"><span aria-hidden="true" class="checkout-block__title-informer"> ! </span> Ваши контактные данные </legend>
                                             <!---->
                                             <?php if($surname == NULL) { ?>
                                                 <div>
                                                    <div class="chips">
                                                       <ul class="chips__list">
                                                          <li class="chips__item"><button class="chips__button chips__button_state_active new_customer" type="button"> Я новый покупатель </button></li>
                                                          <li class="chips__item"><button class="chips__button old_customer" type="button"> Я постоянный клиент </button></li>
                                                       </ul>
                                                    </div>
                                                 </div>
                                             <?php } ?>
                                             <!---->
                                             <div class="ng-untouched ng-invalid ng-dirty fio_and_phone_block">
                                                <!----><!---->
                                                <div class="form__row form__row_type_flex">
                                                   <div class="form__row js-surname">
                                                      <label class="form__label" for="new_customer_surname"> Фамилия </label>
													  <input id="new_customer_surname" _size_medium="" formcontrolname="surname" type="text" class="ng-untouched ng-pristine ng-invalid" <?php if($surname != NULL) { echo 'value="' . $surname . '"'; } ?>>
                                                      <form-error class="validation-message">
                                                      </form-error>
                                                   </div>
                                                   <div class="form__row js-name">
                                                      <label class="form__label" for="new_customer_name"> Имя </label>
													  <input id="new_customer_name" _size_medium="" formcontrolname="name" type="text" class="ng-untouched ng-pristine ng-invalid" <?php if($name != NULL) { echo 'value="' . $name . '"'; } ?>>
													  <form-error class="validation-message">
                                                      </form-error>
												   </div>
                                                </div>
                                                <div class="form__row form__row_type_flex">
                                                   <div class="form__row js-name">
                                                      <label class="form__label" for="new_customer_patronomic"> Отчество </label>
													  <input id="new_customer_patronomic" _size_medium="" formcontrolname="name" type="text" class="ng-untouched ng-pristine ng-invalid" <?php if($patronomic != NULL) { echo 'value="' . $patronomic . '"'; } ?>>
													  <form-error class="validation-message">
                                                      </form-error>
												   </div>
                                                   <div class="form__row js-phone">
                                                      <label class="form__label" for="new_customer_phone"> Мобильный телефон </label>
													  <input id="new_customer_phone" _size_medium="" formcontrolname="phone" type="tel" class="ng-untouched ng-invalid ng-dirty" <?php if($number != NULL) { echo 'value="' . $number . '"'; } ?>>
                                                      <form-error class="validation-message">
                                                      </form-error>
                                                   </div>
                                                </div>
                                                  <div _ngcontent-c100="" class="form__row form__row_type_flex">
                                                       <div class="form__row js-email">
                                                          <label class="form__label" for="new_customer_email"> Эл. почта </label>
        												  <input id="new_customer_email" _size_medium="" formcontrolname="email" type="email" class="ng-untouched ng-invalid ng-dirty" <?php if($email != NULL) { echo 'value="' . $email . '"'; } ?>>
                                                          <form-error class="validation-message">
                                                          </form-error>
                                                       </div>
                                                       <div _ngcontent-c100="" class="form__row">
                                                       </div>
                                                  </div>
                                             </div>
											 <div class="ng-untouched ng-invalid ng-dirty sign_up_block" style="display: none;">
											   <div class="form__row form__row_type_flex">
												  <div class="form__row js-surname">
													 <label class="form__label"> Эл. почта  </label>
													 <input _size_medium="" id="email-for-sign-up" formcontrolname="surname" type="text" class="ng-untouched ng-pristine ng-invalid">											  
													 <form-error class="validation-message"></form-error>
												  </div>
												  <div class="form__row js-name"></div>
											   </div>
											   <div class="form__row form__row_type_flex">
												  <div class="form__row js-name">
													 <label class="form__label"> Пароль </label>
													 <input _size_medium="" id="password-for-sign-up" formcontrolname="name" type="password" class="ng-untouched ng-pristine ng-invalid">											  
													 <form-error class="validation-message">
													    <p class="validation-message" style="color: tomato; display: none" id="error-sign-up">Введены неверно эл. почта или пароль</p>
													 </form-error>
												  </div>
												  <div class="form__row js-phone"></div>
											   </div>
											   <div class="form__row form__row_type_flex">
											    <div class="form__row js-name">
													<div class="button button--yellow button--large checkout-total__submit sign_up" tabindex="29"> Войти </div>
												</div>
												<div class="form__row js-phone"></div>
											   </div>
											 </div>
                                          </fieldset>
                                       </rz-checkout-contact-info>
                                       
										 <div class="checkout-order__header">
											<h2 class="checkout-order__heading">Доставка</h2>
										 </div>
									   <rz-checkout-order-deliveries _nghost-c97="">
									   <fieldset class="checkout-block">
										   <div class="checkout-block__title wa-required-text"><span class="wa-required"></span>Для расчёта стоимости и срока доставки заполните поля со звездочкой</div>
										   
										   <div>
											  <h3 style=" font-size: 22px; ">Типы доставки <span class="wa-required"></span></h3>
											  <div class="form__row">
												 <div class="checkout-variant__radio">
													<input type="radio" id="self_recipient_9055_89" name="types_delivery" value="courier">
													<label class="checkout-variant__label" for="self_recipient_9055_89">Курьер</label>
												 </div>
												 <div class="checkout-variant__radio">
													<input type="radio" id="another_recipient_9055_91" name="types_delivery" value="pickup">
													<label class="checkout-variant__label" for="another_recipient_9055_91">Самовывоз из пункта приёма заказов</label>
												 </div>
												 <div class="checkout-variant__radio">
													<input type="radio" id="another_recipient_9055_99" name="types_delivery" value="pickup-from-stock">
													<label class="checkout-variant__label" for="another_recipient_9055_99">Самовывоз из склада</label>
												 </div>
											  </div>
											</div>
											<div class="ng-untouched ng-invalid ng-dirty" style=" padding-top: 15px; padding-bottom: 15px; ">
                                                <!----><!---->
                                                <div class="form__row form__row_type_flex">
                                                   <div class="form__row js-surname">
                                                      <label class="form__label"> Страна <span class="wa-required"></span></label>
													  <select class="wa-select js-country-field" name="country" required="" data-carts-checked="true">
														<option value="" disabled="">Выберите вариант доставки</option>
														<option value="01">Российская Федерация</option>
													  </select>
                                                   </div>
                                                   <div class="form__row js-name">
                                                      <label class="form__label"> Регион</label>
													  <select class="wa-select js-region-field" name="region" required="" data-carts-checked="true">
													  <option value="" hidden="">Выберите регион</option><option value="01">Адыгея республика</option><option value="04">Алтай республика</option><option value="22">Алтайский край</option><option value="28">Амурская область</option><option value="29">Архангельская область</option><option value="30">Астраханская область</option><option value="02">Башкортостан республика</option><option value="31">Белгородская область</option><option value="32">Брянская область</option><option value="03">Бурятия республика</option><option value="33">Владимирская область</option><option value="34">Волгоградская область</option><option value="35">Вологодская область</option><option value="36">Воронежская область</option><option value="05">Дагестан республика</option><option value="79">Еврейская автономная область</option><option value="75">Забайкальский край</option><option value="37">Ивановская область</option><option value="06">Ингушетия республика</option><option value="38">Иркутская область</option><option value="07">Кабардино-Балкарская республика</option><option value="39">Калининградская область</option><option value="08">Калмыкия республика</option><option value="40">Калужская область</option><option value="41">Камчатский край</option><option value="09">Карачаево-Черкесская республика</option><option value="10">Карелия республика</option><option value="42">Кемеровская область</option><option value="43">Кировская область</option><option value="11">Коми республика</option><option value="44">Костромская область</option><option value="23">Краснодарский край</option><option value="24">Красноярский край</option><option value="91">Крым республика</option><option value="45">Курганская область</option><option value="46">Курская область</option><option value="47">Ленинградская область</option><option value="48">Липецкая область</option><option value="49">Магаданская область</option><option value="12">Марий Эл республика</option><option value="13">Мордовия республика</option><option value="77">Москва</option><option value="50">Московская область</option><option value="51">Мурманская область</option><option value="83">Ненецкий автономный округ</option><option value="52">Нижегородская область</option><option value="53">Новгородская область</option><option value="54">Новосибирская область</option><option value="55">Омская область</option><option value="56">Оренбургская область</option><option value="57">Орловская область</option><option value="58">Пензенская область</option><option value="59">Пермский край</option><option value="25">Приморский край</option><option value="60">Псковская область</option><option value="61">Ростовская область</option><option value="62">Рязанская область</option><option value="63">Самарская область</option><option value="78">Санкт-Петербург</option><option value="64">Саратовская область</option><option value="14">Саха (Якутия) республика</option><option value="65">Сахалинская область</option><option value="66">Свердловская область</option><option value="92">Севастополь</option><option value="15">Северная Осетия-Алания</option><option value="67">Смоленская область</option><option value="26">Ставропольский край</option><option value="68">Тамбовская область</option><option value="16">Татарстан республика</option><option value="69">Тверская область</option><option value="70">Томская область</option><option value="71">Тульская область</option><option value="17">Тыва республика</option><option value="72">Тюменская область</option><option value="18">Удмуртская республика</option><option value="73">Ульяновская область</option><option value="27">Хабаровский край</option><option value="19">Хакасия республика</option><option value="86">Ханты-Мансийский-Югра автономный округ</option><option value="74">Челябинская область</option><option value="20">Чеченская республика</option><option value="21">Чувашская республика</option><option value="87">Чукотский автономный округ</option><option value="89">Ямало-Ненецкий автономный округ</option><option value="76">Ярославская область</option>
													  </select>
                                                   </div>
                                                </div>
                                                <div class="form__row form__row_type_flex">
                                                   <div class="form__row js-city">
                                                      <label class="form__label"> Город <span class="wa-required"></span></label>
                                                      <div>
                                                            <div _ngcontent-c93="" class="autocomplete">
                                                               <input _ngcontent-c93="" _size_small="" autocomplete="off" class="autocomplete__input ng-untouched ng-pristine ng-valid search-city" name="search" type="text" placeholder="Выберите свой город">
                                                            </div>
                                                         <input formcontrolname="cityId" type="hidden" value="32" class="ng-untouched ng-pristine ng-valid">
                                                      </div>
													  <div class="container-city-help-inputs">
													  </div>
                                                   </div>
                                                   <div class="form__row js-name">
                                                      <label class="form__label"> Улица <span class="wa-required" style="display: none;"></span></label>
                                                      <div>
                                                            <div _ngcontent-c93="" class="autocomplete">
                                                               <input _ngcontent-c93="" _size_small="" autocomplete="off" class="autocomplete__input ng-untouched ng-pristine ng-valid" name="street" type="text" placeholder="Введите свою улицу. Пример: ул. Новокузнецкая">
                                                            </div>
                                                         <input formcontrolname="cityId" type="hidden" value="32" class="ng-untouched ng-pristine ng-valid">
                                                      </div>
													  <div class="container-city-help-inputs">
													  </div>													  
                                                   </div>
                                                </div>
                                                <div class="form__row form__row_type_flex">
                                                   <div class="form__row js-city">
                                                      <label class="form__label"> Номер дома <span class="wa-required" style="display: none;"></span></label>
                                                      <div>
                                                            <div _ngcontent-c93="" class="autocomplete">
                                                               <input _ngcontent-c93="" _size_small="" autocomplete="off" class="autocomplete__input ng-untouched ng-pristine ng-valid" name="numberHome" type="text" placeholder="Введите номер своего дома. Пример: 8">
                                                            </div>
                                                         <input formcontrolname="cityId" type="hidden" value="32" class="ng-untouched ng-pristine ng-valid">
                                                      </div>
													  <div class="container-city-help-inputs">
													  </div>
                                                   </div>
                                                   <div class="form__row js-name">
                                                      <label class="form__label"> Номер квартиры <span class="wa-required" style="display: none;"></span></label>
                                                      <div>
                                                            <div _ngcontent-c93="" class="autocomplete">
                                                               <input _ngcontent-c93="" _size_small="" autocomplete="off" class="autocomplete__input ng-untouched ng-pristine ng-valid" name="number_flat" type="text" placeholder="Введите номер своей квартиры. Пример: 14">
                                                            </div>
                                                         <input formcontrolname="cityId" type="hidden" value="32" class="ng-untouched ng-pristine ng-valid">
                                                      </div>
													  <div class="container-city-help-inputs">
													  </div>													  
                                                   </div>
                                                </div>
                                             </div>
                                          </fieldset>
										</rz-checkout-order-deliveries>
									   
                                       <!----><!----><!---->
                                       <rz-checkout-order _ngcontent-c86="">
                                          <!---->
                                          <div>
                                             <div class="checkout-order__header">
                                                <h2 class="checkout-order__heading"> Заказ</h2>
												  <a class="button button_with_icon button_type_link checkout-product__edit-button toggleModal2" name="edit" opencart="">
													 <svg class="catalog-empty__icon" height="16" width="16">
													   <svg viewBox="0 0 24 24" id="icon-edit">
															<g>
																<path d="m20.2071 5.20711 1.5-1.5c.3905-.39053.3905-1.02369 0-1.41422-.3905-.39052-1.0237-.39052-1.4142 0l-1.5 1.5z"></path>
																<path d="m2 4c0-1.10457.89543-2 2-2h8.4895c.5523 0 1 .44772 1 1s-.4477 1-1 1h-8.4895v16h16v-8.4895c0-.5523.4477-1 1-1s1 .4477 1 1v8.4895c0 1.1046-.8954 2-2 2h-16c-1.10457 0-2-.8954-2-2z"></path>
																<path d="m8.29289 14.2929 9.50001-9.50001 1.4142 1.41422-9.49999 9.49999c-.39053.3905-1.02369.3905-1.41422 0-.39052-.3905-.39052-1.0237 0-1.4142z"></path>
															</g>
													   </svg>
													 </svg>
													 Редактировать 
												  </a>
                                             </div>
                                             <!---->
                                             <div class="check-order">
                                                <fieldset class="checkout-block">
												
												<?php
													$counterOfProducts = 1;
													foreach ($boughtProducts as $boughtProduct) {
												?>
												
                                                   <div class="checkout-product__header" data-seller-fullname="<?php echo $boughtProduct->fullname ?>" data-seller-phone="<?php echo $boughtProduct->phone ?>" data-seller-company="<?php echo $boughtProduct->jurName ?>" data-pay-ucode="<?php echo $boughtProduct->payUcode ?>" data-city-name="<?php echo $boughtProduct->address->city ?>" data-city-postcode="<?php echo $boughtProduct->address->postIndex ?>" data-stock-is-delivery-from-point="<?php echo $boughtProduct->stock->isDeliveryFromPoint ?>" data-stock-street="<?php echo $boughtProduct->address->street ?>" data-stock-home="<?php echo $boughtProduct->address->home ?>" data-stock-flat="<?php echo $boughtProduct->address->office ?>" data-delivery-services="<?php 
                                                        if($boughtProduct->deliveryServices != NULL) {
                                                            foreach($boughtProduct->deliveryServices as $delivery) {
                                                                echo $delivery->deliveryId . '=' . $delivery->pvzId . ']]]';
                                                            }
                                                        }
                                                   ?>">
                                                      <legend class="checkout-block__title seller">Товары из магазина <?php echo $boughtProduct->shopName ?>. <span style="font-size:14px;">Склад по адресу: <?php echo $boughtProduct->address->country . ', ' . $boughtProduct->address->region . ', г. ' . $boughtProduct->address->city . ', ' . $boughtProduct->address->street . ', д.' . $boughtProduct->address->home; if($boughtProduct->address->office != NULL) { echo ', ' . $boughtProduct->address->office; } ?></span></legend>
                                                   </div>
                                                   <!---->
                                                   <ul style="font-family: Roboto, sans-serif;">
                                                      <?php
														  foreach ($boughtProduct->products as $product) {
													  ?>
													  <script>
														var atributesStr = '<?php echo $product->strGoodAtribute ?>';
														var atributesId = [];
														var strAtributes = '';
														
														if(atributesStr != '') {
															let allAtributes = atributesStr.split(']');
															
															for(let j = 0; j < allAtributes.length; j++) {
																if(allAtributes[j] != '') {
																	let atributes = allAtributes[j].split(',!,');
																	let spanAtribute = document.createElement('span');
																	atributesId.push(atributes[0]);
																	
																	strAtributes += ', ' + atributes[1] + ': ' + atributes[2];
																	
																	if(atributes[3] != '') {
																		let imgAtribute = document.createElement('img');
																		let imgUrlAtr = atributes[3];
																		let posImgLastSleshAtr = imgUrlAtr.lastIndexOf('.');
																		strAtributes += '<img style="width: 20px; border-radius: 2px;" src="admin/App/templates/files/img/product-attributes/' + imgUrlAtr.substring(0, posImgLastSleshAtr) + '_150x150' + imgUrlAtr.substring(posImgLastSleshAtr) + '">';
																	}
																}
															}
															
															atributesId = atributesId.join(',');
														}
													  </script>
													  
                                                      <li class="js-index-0">
                                                         <!----><!---->
                                                         <rz-checkout-merchandise _nghost-c96="">
                                                            <div _ngcontent-c96="" class="checkout-product" data-product-id="<?php echo $product->id ?>" data-product-length="<?php echo $product->length ?>" data-product-width="<?php echo $product->width ?>" data-product-height="<?php echo $product->height ?>" data-product-weight="<?php echo $product->weight ?>" data-product-base-cost="<?php echo $product->actualPrice ?>" data-product-cost="<?php echo floatval($product->number) * floatval($product->actualPrice) ?>" data-product-seller-cost="<?php echo $product->sellerPrice ?>" data-product-number="<?php echo $product->number ?>">
                                                               <a _ngcontent-c96="" class="checkout-product__title js-product-title" target="_blank" href="<?php echo $product->brandUrl . '/' . $product->url ?>">
                                                                  <!---->
                                                                  <figure _ngcontent-c96="" class="checkout-product__figure">
																	 <span aria-hidden="true" class="checkout-block__title-informer" style="position: inherit;"> <?php echo $counterOfProducts ?> </span>
                                                                     <span _ngcontent-c96="" class="checkout-product__picture">
                                                                        <!----><img _ngcontent-c96="" src="<?php echo 'admin/' . $product->image->url;
																			/*
																			$pos_ext = strripos($product->image->name, '.');			
																			$minuspos = strlen($product->image->name)-$pos_ext-1;								
																			$file_ext = strtolower(substr($product->image->name, $pos_ext+1, $minuspos));			
																			$file_name = substr($product->image->name, 0, $pos_ext);								
																			$file_name = $file_name . '_150x150.' . $file_ext;*/

																			$dataFileName = $product->image->name;
																			  
																			echo $dataFileName  . '" data-filename="' . $dataFileName; ?>" alt="<?php echo $product->name ?>">
                                                                     </span>
                                                                     <figcaption _ngcontent-c96="">
                                                                        <div _ngcontent-c96="" class="checkout-product__title-product" <?php if ($product->strGoodAtribute !== NULL) { echo 'data-atributes-id="yetNotLoaded"'; } ?>> <?php echo $product->name ?></div>
                                                                        <!----><!---->
                                                                     </figcaption>
                                                                     <?php if ($product->strGoodAtribute !== NULL) { ?>
    																	 <script>
    																		var productName = document.querySelector('.checkout-product__title-product[data-atributes-id="yetNotLoaded"]');
    																		productName.dataset.atributesId = atributesId;
    																		productName.innerHTML += strAtributes;
    																		console.log(strAtributes)
    																	 </script>
																	 <?php } ?>
                                                                  </figure>
                                                               </a>
                                                               <div _ngcontent-c96="" class="checkout-product__options">
                                                                  <dl _ngcontent-c96="" class="checkout-product__option js-product-price">
                                                                     <dt _ngcontent-c96="" class="checkout-product__label"> Цена </dt>
                                                                     <dd _ngcontent-c96="" class="checkout-product__digit">
                                                                        <span _ngcontent-c96="" class="checkout-product__price"> <?php echo $product->actualPrice ?>&nbsp;&#8381; </span><!---->
                                                                     </dd>
                                                                  </dl>
                                                                  <dl _ngcontent-c96="" class="checkout-product__option js-product-quantity">
                                                                     <dt _ngcontent-c96="" class="checkout-product__label"> Количество </dt>
                                                                     <!---->
                                                                     <dd _ngcontent-c96="" class="checkout-product__digit"> <?php echo $product->number ?> </dd>
                                                                     <!---->
                                                                  </dl>
                                                                  <dl _ngcontent-c96="" class="checkout-product__option js-product-amount">
                                                                     <dt _ngcontent-c96="" class="checkout-product__label"> Сумма </dt>
                                                                     <dd _ngcontent-c96="" class="checkout-product__digit"> <?php echo ($product->number*$product->actualPrice) ?>&nbsp;&#8381; </dd>
                                                                  </dl>
                                                               </div>
                                                            </div>
                                                         </rz-checkout-merchandise>
                                                      </li>
													<?php	$counterOfProducts++;
														}
													?>
                                                   </ul>
													
													<div class="container_delivery">
														<h4 _ngcontent-c100="" class="recipient__title">Службы доставки</h4>
													   <div class="container deliveryServices">
															<div class="custom-select-wrapper">
																<div class="custom-dropdown-select">
																	<div class="custom-select__trigger">
																		<span>Выберите службу доставки</span>
																		<div class="arrow"></div>
																	</div>
																	<div class="custom-options">
																	</div>
																</div>
															</div>
														</div>
													   <div class="container deliveryPVZ second" style="display: none;">
															<div class="custom-select-wrapper">
																<div class="custom-dropdown-select">
																	<div class="custom-select__trigger">
																		<span>Выберите пункт самовывоза</span>
																		<div class="arrow"></div>
																	</div>
																	<div class="custom-options">
																	</div>
																</div>
															</div>
													   </div>
													</div>
												<?php	
													}
												?>
												</fieldset>
	
                                                <!----><!----><!---->
                                                <!----><!---->
                                                <fieldset class="checkout-block">
													<h3 class="checkout-order__heading" style=" font-size: 22px; "> Оплата</h3>
                                                   <!---->
                                                   <rz-checkout-order-payments _nghost-c98="">
                                                      <!---->
                                                      <ul _ngcontent-c98="">
                                                         <!---->
                                                         <li _ngcontent-c98="" class="checkout-variant">
                                                            <!----><!----><!----><!---->
                                                            <rz-checkout-order-payment _ngcontent-c98="" _nghost-c106="">
                                                               <div _ngcontent-c106="" class="checkout-variant__inner">
                                                                  <div _ngcontent-c106="" class="checkout-variant__radio">
                                                                     <input _ngcontent-c106="" type="radio" id="9055_40_payments_1" name="order_9055_40_payments" value="1" checked>
                                                                     <label _ngcontent-c106="" class="checkout-variant__label" for="9055_40_payments_1">
                                                                        <span _ngcontent-c106="" class="checkout-variant__body">
                                                                           <span _ngcontent-c106="" class="checkout-variant__title">
                                                                              <!----><!----><!----> Оплата банковской картой онлайн <!----><!----><!---->
                                                                           </span>
                                                                        </span>
                                                                     </label>
                                                                     <!---->
                                                                  </div>
                                                               </div>
                                                            </rz-checkout-order-payment>
                                                            <!---->
                                                         </li>
                                                      </ul>
                                                   </rz-checkout-order-payments>
                                                </fieldset>
                                                   <!---->
                                                   <fieldset _ngcontent-c100="" class="checkout-block recipient ng-untouched ng-pristine ng-invalid">
                                                      <legend _ngcontent-c100="" class="checkout-block__title">
														<h3 class="checkout-order__heading" style=" font-size: 22px; "> Контактные данные получателя заказа</h3>
													  </legend>
                                                      <!---->
                                                      <div _ngcontent-c100="" class="form__row">
                                                         <h4 _ngcontent-c100="" class="recipient__title"> Кто получатель? </h4>
                                                         <div _ngcontent-c100="" class="checkout-variant__radio"><input _ngcontent-c100="" formcontrolname="changed" type="radio" id="self_recipient_9055_40" class="ng-untouched ng-pristine ng-valid" name="recipient" checked><label _ngcontent-c100="" class="checkout-variant__label" for="self_recipient_9055_40"> Я </label></div>
                                                         <div _ngcontent-c100="" class="checkout-variant__radio"><input _ngcontent-c100="" formcontrolname="changed" type="radio" id="another_recipient_9055_41" class="ng-untouched ng-pristine ng-valid" name="recipient"><label _ngcontent-c100="" class="checkout-variant__label" for="another_recipient_9055_41"> Другой человек </label></div>
                                                      </div>
                                                      <div _ngcontent-c100="" class="form__row form__row_type_flex">
                                                         <div _ngcontent-c100="" class="form__row">
                                                            <label _ngcontent-c100="" class="form__label" for="recipientSurname"> Фамилия </label>
															<input _ngcontent-c100="" _size_medium="" formcontrolname="surname" id="recipientSurname" type="text" class="ng-untouched ng-pristine ng-invalid" disabled>
                                                            <form-error class="validation-message">
															</form-error>
                                                         </div>
                                                         <div _ngcontent-c100="" class="form__row">
                                                            <label _ngcontent-c100="" class="form__label" for="recipientName"> Имя </label>
															<input _ngcontent-c100="" _size_medium="" formcontrolname="name" id="recipientName" type="text" class="ng-untouched ng-pristine ng-invalid" disabled>
                                                            <form-error class="validation-message">
															</form-error>
                                                         </div>
                                                      </div>
                                                      <div _ngcontent-c100="" class="form__row form__row_type_flex">
                                                         <div _ngcontent-c100="" class="form__row">
                                                            <label _ngcontent-c100="" class="form__label" for="recipientPatronymic"> Отчество </label>
															<input _ngcontent-c100="" _size_medium="" formcontrolname="patronymic" id="recipientPatronymic" type="text" class="ng-untouched ng-pristine ng-valid" disabled>
															<form-error class="validation-message">
															</form-error>
														 </div>
                                                         <div _ngcontent-c100="" class="form__row">
                                                            <label _ngcontent-c100="" class="form__label" for="recipientTel"> Мобильный телефон </label>
															<input _ngcontent-c100="" _size_medium="" formcontrolname="phone" id="recipientTel" type="tel" class="ng-untouched ng-pristine ng-invalid" disabled>
                                                            <form-error class="validation-message">
															</form-error>
                                                         </div>
                                                      </div>
                                                      <div _ngcontent-c100="" class="form__row form__row_type_flex">
                                                         <div _ngcontent-c100="" class="form__row">
                                                            <label _ngcontent-c100="" class="form__label" for="recipientEmail"> Эл. почта </label>
															<input _ngcontent-c100="" _size_medium="" formcontrolname="email" id="recipientEmail" type="text" class="ng-untouched ng-pristine ng-invalid" disabled>
                                                            <form-error class="validation-message">
															</form-error>
                                                         </div>
                                                         <div _ngcontent-c100="" class="form__row">
                                                         </div>
                                                      </div>
                                                      <!---->
                                                   </fieldset>
												   
												   <fieldset class="checkout-block">
													<legend class="checkout-block__title">
														<h3 style=" font-size: 18px; ">Тип документа для подтверждения личности при получении товара</h3>
													</legend>
													<div class="form__row">
														<div class="checkout-variant__radio">
															<input type="radio" id="self_recipient_98979" name="typeDocument" value="pasport">
															<label class="checkout-variant__label" for="self_recipient_98979">Гражданский паспорт</label>
														</div>
														<div class="checkout-variant__radio">
															<input type="radio" id="self_recipient_9866" name="typeDocument" value="zagran">
															<label class="checkout-variant__label" for="self_recipient_9866">Загранпаспорт</label>
														</div>
														<div class="checkout-variant__radio">
															<input type="radio" id="self_recipient_9867" name="typeDocument" value="voditelskoe">
															<label class="checkout-variant__label" for="self_recipient_9867">Водительское удостоверение</label>
														</div>
													</div>
													<div class="form__row form__row_type_flex">
													 <div class="form__row">
														<label class="form__label" for="numberOfDocument"> Номер документа </label>
														<input _size_medium="" formcontrolname="surname" id="numberOfDocument" type="text" class="ng-untouched ng-pristine ng-invalid">
														<form-error class="validation-message">
														</form-error>
													 </div>
													 <div class="form__row">
														<label class="form__label" for="seriaOfDocument"> Серия документа </label>
														<input _size_medium="" formcontrolname="name" id="seriaOfDocument" type="text" class="ng-untouched ng-pristine ng-invalid">
														<form-error class="validation-message">
														</form-error>
													 </div>
													</div>
													<div class="form__row form__row_type_flex">
													 <div class="form__row">
														<label class="form__label" for="dateOfDocument"> Дата выдачи документа </label>
														<input _size_medium="" placeholder='Пример: "2019-01-01"' formcontrolname="patronymic" id="dateOfDocument" type="text" class="ng-untouched ng-pristine ng-valid">
														<form-error class="validation-message">
														</form-error>
													 </div>
													 <div class="form__row">
													 </div>
													</div>
													<div style="display: flex;margin-top: 10px;">
													   <div class="button-show comment">Комментарий к заказу
														   <svg style=" height: 11px; width: 15px; padding-left: 5px; ">
															   <svg class="arrow-bottom" viewBox="0 0 8 5">
																	<g><path fill="currentColor" d="M4,3.806,7.368,0,8,.714,4.208,5,4,4.765,3.792,5,0,.714.632,0Z"></path></g>
															   </svg>
															</svg>
													   </div>
													   <div class="button-show question">Опрос - откуда вы узнали о Saterno?
														   <svg style=" height: 11px; width: 15px; ">
															   <svg class="arrow-bottom" viewBox="0 0 8 5">
																	<g><path fill="currentColor" d="M4,3.806,7.368,0,8,.714,4.208,5,4,4.765,3.792,5,0,.714.632,0Z"></path></g>
															   </svg>
															</svg>
														</div>
													   <div class="button-show wishes">Оставить пожелания
														   <svg style=" height: 11px; width: 15px; padding-left: 5px; ">
															   <svg class="arrow-bottom" viewBox="0 0 8 5">
																	<g><path fill="currentColor" d="M4,3.806,7.368,0,8,.714,4.208,5,4,4.765,3.792,5,0,.714.632,0Z"></path></g>
															   </svg>
															</svg>
														</div>
													</div>													
													<div class="showing-blocks" style=" margin-top: 5px; ">
													   <div class="block-show comment" style="transform:scale(1, 0); height: 0; transition: .5s"><textarea></textarea></div>
													   <div class="block-show question" style="transform:scale(1, 0); height: 0; transition: .5s"><textarea></textarea></div>
													   <div class="block-show wishes" style="transform:scale(1, 0); height: 0; transition: .5s"><textarea></textarea></div>
													</div>
													   <div class="" style="margin: 10px;">
															  <!--<div _ngcontent-c100="" class="form__row form__row_type_flex">
																 <div _ngcontent-c100="" class="form__row">
																	<label _ngcontent-c100="" class="form__label" for="eMailRecipient"> Эл. почта </label>
																	<input _ngcontent-c100="" _size_medium="" formcontrolname="surname" id="eMailRecipient" type="text" class="ng-untouched ng-pristine ng-invalid">
																	<form-error class="validation-message">
																	</form-error>
																 </div>
																 <div _ngcontent-c100="" class="form__row">
																 </div>
															  </div>-->
															<input type="checkbox" id="subscribing" value="subscribeYes">
															<label for="subscribing" style="font-size: 13px;">Подписаться на почтовую рассылку</label>
														</div>
												   </fieldset>
                                                <!----><!---->
                                             </div>
                                          </div>
                                       </rz-checkout-order>
									</main>
                                    <!---->
                                    <aside _ngcontent-c86="" class="checkout-form__sidebar">
                                       <!---->
                                       <rz-checkout-orders-total>
                                          <!---->
                                          <div class="checkout-sidebar">
                                             <rz-checkout-orders-pl-bonuses>
                                                <!---->
                                             </rz-checkout-orders-pl-bonuses>
                                             <div class="checkout-total" style="font-family: Roboto, sans-serif;">
                                                <h4 class="checkout-total__hading"> Итого </h4>
                                                <dl class="checkout-total__row js-goods-info">
                                                   <dt class="checkout-total__label"> Товаров: <span class="product_number">1</span>, на сумму </dt>
                                                   <dd class="checkout-total__value"> <span class="product_cost_small">5344</span>&nbsp;&#8381; </dd>
                                                </dl>
                                                <dl class="checkout-total__row js-delivery-info">
                                                   <dt class="checkout-total__label"> Стоимость доставки </dt>
                                                   <dd class="checkout-total__value">
                                                      <span class="text_delivery">Рассчитывается после выбора служб доставки</span> <span class="money_symbol_delivery" style="display: none;">&#8381;</span>
                                                   </dd>
                                                </dl>
                                                <dl class="checkout-total__row checkout-total__row_type_bordered js-total">
                                                   <dt class="checkout-total__label"> К оплате </dt>
                                                   <dd class="checkout-total__value checkout-total__value_size_large"> <span class="product_cost">5344</span>&nbsp;&#8381; </dd>
                                                </dl>
                                                <div class="checkout-total__buttons">
													<div class="button button--yellow button--large checkout-total__submit finalizing_button"> Заказ подтверждаю </div>
												</div>
                                                <!---->
                                                <p class="checkout-total__caption js-user-agreement"> Подтверждая заказ, я даю <a href="privacy"> согласие на обработку персональных данных </a></p>
                                             </div>
                                          </div>
                                       </rz-checkout-orders-total>
                                       <!---->
                                    </aside>
                                 </div>
                              </form>
                              <rz-checkout-footer _ngcontent-c86="" _nghost-c91="">
                                 <footer _ngcontent-c91="" class="checkout-footer">
                                    <p _ngcontent-c91="" class="checkout-footer__copyright"> © 2018–<script>
																										let currentYear = new Date().getFullYear()
																										document.write(currentYear)
																									</script> Интернет-магазин «Saterno» — Самый крутой магазин в России </p>
                                 </footer>
                              </rz-checkout-footer>
                           </div>
                        </rz-checkout-orders-content>
                     </rz-checkout-orders>
                  </section>
               </rz-checkout-main>
            </div>
		</div>
		
		<div id="cover"></div>
		
		<div class="modalBlock toggleModal0" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block ">
			<div class="modalHeader">
				<div class="title">Контактные телефоны</div>
				<button class="modal__close toggleModal0" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/checkout-assets/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<br><p>Звонки операторами в офисе Сатерно принимаются: <br>с 09-00 до 18-00 по Московскому времени.</p>
				<p>Тел. общий: 8 (862) 231-68-77, +7-918-608-69-29, <br>WhatsApp: +79882316877, <br>офис в Сочи: 8 (862) 231-68-77, <br>тел. для Дальнего Востока: +7-984-133-23-25.</p>
				<p>E/mail: info@saterno.ru, shopsaterno@yandex.ru, boss@saterno.ru. <br>ICQ: 264155380 <br>Skype: Zhigaylov-Andrey</p>
				<p>Так же у каждого магазина Сатерно  имеются собственные телефоны службы доставки.</p><br>
			</div>
			
		  </div>
		</div>
		
		<div class="modalBlock error toggleModal1" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription">
		  <div class="modal__block ">
			<div class="modalHeader">
				<div class="title">Предупреждение</div>
				<button class="modal__close toggleModal1" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<?php include __DIR__ . "/checkout-assets/icons/close.svg" ?>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<br><p>Для подтверждения заказа и перехода к оплате, заполните следующие поля: </p><br>
				<div></div>
				<br>
			</div>
			
		  </div>
		</div>
		
		<?php 
			$isCartEmpty = 1;
			if($_SESSION['buyCart']->boughtProducts != NULL) {
				if(sizeof($_SESSION['buyCart']->boughtProducts) > 0) {
					$isCartEmpty = 0;
					?>
		<script>
			let boughtProducts = [];
			
		<?php

		foreach($_SESSION['buyCart']->boughtProducts as $boughtProduct) {
			echo 'if(1) {';
			echo 'let boughtProduct = [];';
			echo 'boughtProduct.push("' . $boughtProduct->id . '");';
			echo 'boughtProduct.push("' . $boughtProduct->name . '");';
			echo 'boughtProduct.push("' . $boughtProduct->actualPrice . '");';
			echo 'boughtProduct.push("' . $boughtProduct->number . '");';
			echo 'boughtProduct.push("' . $boughtProduct->image->url . $boughtProduct->image->name . '");';
			echo 'boughtProduct.push("' . $boughtProduct->strGoodAtribute . '");';
			echo 'boughtProduct.push("' . $boughtProduct->brandUrl . '");';
			echo 'boughtProduct.push("' . $boughtProduct->url . '");';
			echo 'boughtProduct.push("' . $boughtProduct->minOrder . '");';
			echo 'boughtProduct.push("' . $boughtProduct->maxOrder . '");';
			echo 'boughtProducts.push(boughtProduct);';
			echo '}';
		}

		?>
		console.log(boughtProducts);
		</script>
		<?php
				}
			}
		?>
				
		<div class="modalBlock toggleModal2 buyCartModal" data-toggle="true" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription" data-state="close" style="overflow: auto;">
		  <div class="modal__block">
			<div class="modalHeader">
				<div class="title">Корзина</div>
				<button class="modal__close toggleModal1" data-toggle="true">
					<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z" fill-rule="evenodd"></path>
					</svg>
				</button>
			</div>			
			<div class="modalBody">
				<?php if($isCartEmpty == 1) { ?>
					<div>
						<p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" style="width: 100%; max-width: 240px; margin-bottom: 30px;">
							<path d="m9.30006 136.5c-.6 12.8 8.70004 27.2 20.70004 31.7 18.1 6.8 30.3-10.2 41-21.9 8.2-9 18.5-17.2 30.4999-18.8 7-1 14 .3 21 1.3 17.7 2.6 35.8 4.2 53.2.3s34.2-13.5 43.4-28.8c2.3-3.9 4.1-8.1 4.8-12.5 1.8-9.7-1.3-19.7-6-28.2-6.6-12.1-16.5-22.4-28.5-29.4-11.1-6.4-24.3-10.1-37-7.6-18 3.6-31.3 18.6-42.9 33-11.3999 14.3-23.9999 29.6-41.7999 34.5-5.5 1.5-11.3 1.8-16.7 3.3-16.5 4.2-31.9 17-38.9 32.6-1.7 3.7-2.50004 7.2-2.80004 10.5z" fill="#f5f5f5"/>
							<path d="m218.9 99.1c-2.8-13.7-6.5-27.2-7.3-30 0-.7-.2-1.3-.6-1.9-1-1.5-3-4.8-39.4-12.9-18.5-4.2-38.7-7.9-46-8.8-1.5-.2-3.3-.3-5.4-.4l-2.5-1.8c-4.9-6.8-13-10.8-21.4-10.3l-35.9 2c-4.5.2-8.3 2.8-10.3 6.9-1.9 4.1-1.5 8.7 1.2 12.3l5.4 7.4c1.3 9.2 6.6 26.6 14.6 51.5 1.3 4.1 2.4 7.4 2.9 9.1.4 1.5 1.7 2.8 3.8 3.9 2.2 9.2 12.5 52.6 17.6 61.1.6 1.1 1.7 2.1 3.1 3-2 1.3-3.3 3.8-3.3 6.6 0 4.2 3 7.7 6.8 7.7 3.7 0 6.8-3.4 6.8-7.7 0-1-.2-1.9-.5-2.8 9.3 2.5 23.1 4.3 40.2 6.3 9.7 1.1 18 2.1 22.5 3.2 1.3.3 2.7.5 4.1.7-.7 1.2-1.1 2.6-1.1 4.1 0 4.2 3 7.7 6.8 7.7 3.7 0 6.8-3.4 6.8-7.7 0-1.6-.4-3.1-1.2-4.4 5.6-.8 11-2.4 15.4-4.6-.3.8-.4 1.8-.4 2.7 0 4.2 3 7.7 6.8 7.7 3.7 0 6.8-3.4 6.8-7.7 0-3.9-2.5-7-5.8-7.6 1.4-1.4 2.5-2.8 3-4.2.5-1.2.3-2.4-.3-3.5-2.6-4.4-16.1-6.7-52.8-11-12.7-1.5-25.8-3-28.3-4.2-3.3-1.4-7.5-18.5-9.4-38 5.5.5 11.5 1 18.1 1.5 10.6.8 19.8 1.5 23.8 2.3 5.5 1 13.9 1.5 22.7 1.5 13.3 0 27.3-1.2 32.7-3.6 4-1.8 5.7-8.7 0-36.1zm-48.7 33.3-1.5-7c2.6 0 6.4-.3 10.7-.6l1.1 8.2c-3.7-.1-7.2-.3-10.3-.6zm-61.6-5.9-1.7-8.9c4.9.7 10.1 1.4 15.3 2.1l1.6 8.3c-5.2-.5-10.3-1-15.2-1.5zm-28.8-6.1c-.4-1.4-1.2-3.8-2.1-6.8 2.4.3 6.3.9 11.1 1.5l1.6 8.7c-8.4-1.6-10.2-3-10.6-3.4zm12.1 3.7-1.7-8.8c4.5.6 9.7 1.3 15.2 2.1l1.7 8.9c-2-.2-3.9-.5-5.8-.7-3.8-.5-6.9-1-9.4-1.5zm-25.6-47.4c3.4.6 8.9 1.6 15.7 2.8l3.1 16.5c-6-.8-10.8-1.5-13.6-1.9-1.8-5.7-3.6-11.8-5.2-17.4zm140.9-1.7c1 3.7 1.9 7.3 2.8 10.8-2.4.2-6.9.6-12.4 1.1l-1.6-11.5c4.9-.2 8.8-.3 11.2-.4zm-90 10.4c6.1 1 12.2 1.9 17.8 2.6l2.8 14.8c-5.8-.7-11.8-1.4-17.8-2.2zm1.4 15c-5.2-.7-10.3-1.3-15.3-2l-3-15.8c5 .8 10.2 1.7 15.3 2.5zm18-12.2c7.1.9 13.5 1.7 18.5 2l3.2 14.9c-5.5-.6-12-1.3-18.9-2.1zm24.5 2.3c3.7 0 8.5-.2 13.7-.5l2.1 16c-4 .1-8.2 0-12.5-.3zm15.1-.6c6.7-.4 13.9-1 20-1.5l2.1 15.8c-5.8.8-12.6 1.5-20 1.7zm21.5-1.6c5.7-.5 10.3-.9 12.6-1.1 1.2 5.1 2.3 9.9 3.2 14.3-2.8.7-7.6 1.7-13.7 2.6zm-3.2-12.9 1.5 11.6c-6.2.5-13.4 1.1-20 1.5l-1.6-12.4c7.1-.2 14.2-.5 20.1-.7zm-21.6.8 1.6 12.4c-5.3.3-10.1.5-13.8.5l-2.7-12.3c4.8-.3 9.9-.4 14.9-.6zm-21 .7h.3l2.6 11.9c-5-.4-11.4-1.1-18.4-2.1l-2.1-11.2c7 .9 13.2 1.4 17.6 1.4zm-19.2-1.6 2.1 11.2c-5.7-.8-11.7-1.7-17.8-2.6l-2.1-11.3c6.1 1 12.2 2 17.8 2.7zm-19.4-2.9 2.1 11.3c-5.2-.8-10.4-1.7-15.3-2.5l-2.2-11.4c5.1.8 10.3 1.7 15.4 2.6zm-16.9-3 2.2 11.5c-5.5-.9-10.7-1.8-15.3-2.6l-2.3-11.8c4.8 1 10 1.9 15.4 2.9zm-16.9-3.2 2.2 11.8c-7-1.2-12.6-2.3-15.8-2.9-1.3-4.7-2.4-8.9-3-12.2 3.8.8 9.7 2 16.6 3.3zm4 13.6c4.7.8 9.9 1.7 15.3 2.6l3 15.8c-5.5-.7-10.7-1.4-15.2-2.1zm18.6 19.9 3 16.2c-5.6-.8-10.8-1.5-15.2-2.1l-3-16.1c4.6.6 9.7 1.3 15.2 2zm4.6 16.4-3-16.2c4.9.7 10.1 1.3 15.3 2l3.1 16.2c-5.3-.6-10.5-1.3-15.4-2zm13.7-14c6 .8 12 1.5 17.8 2.2l3.1 16.4c-5.6-.7-11.6-1.6-17.8-2.4zm19.2 2.4c7 .8 13.5 1.6 19 2.1l3.7 16.9c-4.2-.5-11.2-1.4-19.5-2.5zm28.7 19.4-3.6-16.8c3.3.2 6.6.3 9.8.3h2.5l2.1 16c-4.4.3-8.2.5-10.8.5zm10.2-16.5c7.4-.2 14.2-.9 20-1.7l2.1 15.9c-6.5.6-13.8 1.2-20 1.7zm21.4-1.9c6.1-.9 10.9-1.9 13.8-2.6 1.4 6.9 2.2 12.7 2.7 17.2-3 .3-8.3.8-14.3 1.4zm4.2-36.2c-10.3.3-34.1 1.1-50.8 1.8-17 .7-75.6-11.1-90.6-14.2 5-3.3 35.6-6.9 55.6-6.1.7.3 1.4.3 2 .1 1.6.1 3.2.2 4.6.4 15 1.8 67.3 12.6 79.2 18zm-148.6-25c1-2.1 3-3.4 5.3-3.6l35.9-2c5.6-.3 11.1 2 14.9 6.2-7.5.1-16.3.5-24.4 1.2-8.2.8-24.2 2.3-29.2 7.2l-1.9-2.6c-1.4-1.9-1.6-4.3-.6-6.4zm16.4 51.3c3 .4 7.7 1.1 13.4 1.9l3 16.1c-5-.7-9-1.2-11.3-1.5-.1-.3-.2-.5-.3-.8-.9-3.6-2.8-9.3-4.8-15.7zm46.2 56.2c3.6 19.8 7.4 23.9 10.4 25.2.2.1.4.2.7.3-2 1.3-3.3 3.8-3.3 6.6 0 4.2 3 7.7 6.8 7.7 3.7 0 6.8-3.4 6.8-7.7 0-1.8-.6-3.5-1.5-4.8 5 .7 11.8 1.6 20.5 2.6 14.8 1.7 41.6 4.9 47.6 7.8-3.9 5-20.6 11.6-33.6 8.5-4.9-1.1-13.4-2.2-23.2-3.3-16-1.9-45.9-5.5-48.7-10.3-3.8-6.2-12-38.7-16-55.7 6.7 1.8 16.8 3.2 31 4.5.3 3.3 1.1 10.8 2.5 18.6zm7.2-23.7-1.5-8.2c6.2.8 12.2 1.6 17.8 2.4l1.4 7.3c-.9-.1-1.9-.1-2.8-.2-4.9-.5-9.9-.9-14.9-1.3zm19 1.5-1.3-7.2c8.5 1.1 15.6 2 19.6 2.5l1.4 6.6c-3.9-.6-10.8-1.2-19.7-1.9zm37.6 3.4-1.1-8.3c6.3-.5 13.5-1.1 20-1.7l1.2 9.4c-6.1.5-13.3.7-20.1.6zm34.2-2.9c-2.4 1-7 1.7-12.6 2.2l-1.2-9.4c6-.6 11.2-1.1 14.3-1.4.3 4.6.1 7.5-.5 8.6z" fill="#c3822f"/>
							<path d="m62.7 182.7c-.6-17.1 6.4-22.5 12.5-22.5 5.5-.1 12.2.6 18.6-3.7.6-.4.6-1.3 0-1.7-4.3-2.3-9.8-4.4-14.6-3.8-5.9.8-10.5 5-13.2 7.7-.7.8-1.9-.1-1.4-1.1 2-4.7 5.3-6.4 8.2-9.1 3.5-3.2 9.2-5.2 13-8 5.8-4.5 9.4-10.8 12.8-17.4.4-.6-.1-1.4-.9-1.4-6.3.4-10.3 1.9-15.5 6.5-4.4 4-11.7 15.6-15.4 19.5-.7.7-1.9.1-1.5-.8 2.2-8 10.7-18.3 14.4-27.1 4.9-11.4 3.7-20.4.2-28.9-.3-.7-1.5-.8-1.7 0-2.4 11.1-10.8 13.3-13.7 40.5-.2 1.9-.6 6.4-1.2 6.9-.9.8-1.2 0-1.7-1.1-2.9-7.6-.6-47.2-22.1-60.2-.8-.4-1.7.2-1.4 1 6.4 23.1-9.2 26 21.6 67.8.1.2.4.6.5.8.8 2.1-.6 2.5-1.3 2.4-3.9-.5-18.9-27.6-48.90004-24.1-.8 0-1.1 1-.6 1.6 7.30004 8 15.00004 15.7 24.80004 19.8 6 2.6 14 3.1 19.6 6.6 5 3.1 7.7 9.6 6.1 15.2-.3.8-1.3 1.1-1.6.3-2.8-4.8-9.5-8.6-14.7-10.2-5.6-1.7-10.2-1.5-15.8-1.6-.8 0-1.2.9-.8 1.5 11.7 16.7 28.6 3.5 31 23.3 0 .3.3.7.6.8 3.3.9 6.5 1.8 6.4-1.7z" fill="#4ad029"/>
							<path d="m76.8 180.1-33.1-1.1c-1.5-.1-1.4 1.2-1.2 2.6l6 30.5c.2 1.1 1.3 2 2.4 1.9l16.2.4c1-.1 1.7-.8 2-1.7l8.4-31.3c.3-.6-.1-1.2-.7-1.3z" fill="#1c398e"/>
						</svg></p>
					   
					   <h3 style="text-align: center;">Корзина пуста</h3>
						
						<p style="padding-bottom: 20px">Но это никогда не поздно исправить :) </p>
					</div>
				<?php } ?>
			</div>
			
		  </div>
		</div>
<div style="
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background-color: #fff;
    display: none;
" class="coverForLoadingBankingPage"></div>

<div class="forLoadingBankingPage" style="
    padding: 60px;
    position: absolute;
    top: 0;
    display: none;
"><img class="checkout-header__logo js-logo" src="App/templates/index_files/saternologomain.png" alt="Интернет магазин Saterno - №1"><div style="
    font-size: 20px;
    padding: 50px;
">Перенаправление на страницу банка для оплаты заказа...</div></div>

	<script>
		for (const dropdown of document.querySelectorAll(".custom-select-wrapper")) {
			dropdown.addEventListener('click', function () {
				this.querySelector('.custom-dropdown-select').classList.toggle('open');
			})
		}
		
		window.addEventListener('click', function (e) {
			for (const select of document.querySelectorAll('.custom-dropdown-select')) {
				if (!select.contains(e.target)) {
					select.classList.remove('open');
				}
			}
		});
	</script>
	<script>
		let newOrderIdFromBD = <?php echo $newOrderId ?>;
	</script>
	<script src="App/templates/checkout-assets/js/popUp.js"></script>
	<script src="App/templates/checkout-assets/js/buyCartModule.js"></script>
	<script src="App/templates/checkout-assets/js/buttonsAndInputs.js"></script>
	<script src="App/templates/checkout-assets/js/delivery.js"></script>
   </body>
</html>
