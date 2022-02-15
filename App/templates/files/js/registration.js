let isSeller = document.querySelector('#isSeller');

isSeller.addEventListener('change', changeTypeOfUser);

function changeTypeOfUser() {
    let customer = document.querySelector('.customer_block');
    let seller = document.querySelector('.seller_block');
    
    if(isSeller.checked == true) {
        customer.style.display = 'none';
        seller.style.display = 'block';
    } else {
        customer.style.display = 'block';
        seller.style.display = 'none';
    }
}

function checkIsAvailableEmailOrLogin() {
	let divEmail = this.parentNode;
	let title = divEmail.querySelector('form-error');
	
	if(this.value.length > 0) {
		if(this.value.length < 5) {
			divEmail.classList.add('validation_type_error');
			title.innerHTML = 'Введите эл. почту';
			isCheckedEmail = 1;
		} else {
			divEmail.classList.remove('validation_type_error');
			title.innerHTML = '';
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'App/Controllers/checkIsAvailableEmailOrLogin.php');
			xhr.setRequestHeader( "Content-Type", "application/json" );

			xhr.addEventListener('readystatechange', function(e) {
				console.log(e.target.response);
				if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
					if(e.target.response !== '1') {						
            			divEmail.classList.add('validation_type_error');
            			title.innerHTML = 'Такая эл. почта уже занята';
						isNormal = false;
					}
					/*isCheckedEmail = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveNewSeller();
					}*/
				}
				else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
					console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
					/*isCheckedEmail = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveNewSeller();
					}*/
				}
			});
			xhr.send('"' + this.value + '"');
		}
	} else {
		divEmail.classList.remove('validation_type_error');
		title.innerHTML = '';
		//isCheckedEmail = 1;
	}
}

function inputEmail() {
	let divEmail = this.parentNode;
	let title = divEmail.querySelector('form-error');
	
	if(this.value.match(/\s/g) != null) {
		this.value = this.value.replace(/\s/g, '');
	}
	
	divEmail.classList.remove('validation_type_error');
	title.innerHTML = '';
	
	//isCheckedEmail = 0;
}

let emailForSeller = document.querySelector('#new_seller_email');
let emailForCustomer = document.querySelector('#new_customer_email');

emailForSeller.addEventListener('blur', checkIsAvailableEmailOrLogin, false);
emailForSeller.addEventListener('input', inputEmail, false);

emailForCustomer.addEventListener('blur', checkIsAvailableEmailOrLogin, false);
emailForCustomer.addEventListener('input', inputEmail, false);


function checkIsAvailableShopName() {
	let div = this.parentNode;
	let title = div.querySelector('form-error');
	
	if(this.value.length > 0) {
		div.classList.remove('validation_type_error');
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'App/Controllers/checkIsAvailableShopName.php');
		xhr.setRequestHeader( "Content-Type", "application/json" );

		xhr.addEventListener('readystatechange', function(e) {
			console.log(e.target.response);
			if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
				if(e.target.response == '1') {
					div.classList.remove('validation_type_error');
                    title.innerHTML = '';
				} else {							
					div.classList.add('validation_type_error');
                    title.innerHTML = 'Такое название занято.';
					isNormal = false;
				}
				/*isCheckedShopName = 1;
				if(isLaunchSaving) {
					isLaunchSaving = 0;
					saveNewSeller();
				}*/
			}
			else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
				console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
				/*isCheckedShopName = 1;
				if(isLaunchSaving) {
					isLaunchSaving = 0;
					saveNewSeller();
				}*/
			}
		});
		xhr.send('"' + this.value + '"');
	} else {
		div.classList.remove('validation_type_error');
	    title.innerHTML = '';
		//isCheckedShopName = 1;
	}
}

function inputShopName() {
	let div = this.parentNode;
	let title = div.querySelector('form-error');
	
	div.classList.remove('validation_type_error');
	title.innerHTML = '';
	//isCheckedShopName = 0;
}

let shopName = document.querySelector('#new_seller_shopname');	
shopName.addEventListener('blur', checkIsAvailableShopName, false);
shopName.addEventListener('input', inputShopName, false);


function checkIsAvailableURL() {
	let div = this.parentNode;
	let title = div.querySelector('form-error');
	
	if(this.value.length > 0) {
		if(this.value.length < 4) {
    		div.classList.add('validation_type_error');
            title.innerHTML = 'Не меньше 4-х символов';
		//	isCheckedShopURL = 1;
		} else {
    		div.classList.remove('validation_type_error');
            title.innerHTML = '';
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'App/Controllers/checkIsAvailableURL.php');
			xhr.setRequestHeader( "Content-Type", "application/json" );

			xhr.addEventListener('readystatechange', function(e) {
				console.log(e.target.response);
				if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
					if(e.target.response != '1') {					
						div.classList.add('validation_type_error');
                        title.innerHTML = 'Такой адрес уже занят';
						//isNormal = false;
					}
				/*	isCheckedShopURL = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveNewSeller();
					}*/
				}
				else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
					console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
					/*isCheckedShopURL = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveNewSeller();
					}*/
				}
			});
			xhr.send('"' + this.value + '"');
		}
	} else {
		div.classList.remove('validation_type_error');
        title.innerHTML = '';
	//	isCheckedShopURL = 1;
	}
}

function inputURL() {
	let div = this.parentNode;
	let title = div.querySelector('form-error');
	
	if(this.value.match(/\W/g) != null) {
		div.classList.add('validation_type_error');
        title.innerHTML = 'Доступны только буквы латинского алфавита, цифры и знак подчёркивания _';
		this.value = this.value.replace(/\W/g, '');
	} else {
		div.classList.remove('validation_type_error');
        title.innerHTML = '';
	}
	//isCheckedShopURL = 0;
}

let devShopUrl = document.querySelector('#new_seller_shopurl');
devShopUrl.addEventListener('input', inputURL, false);
devShopUrl.addEventListener('blur', checkIsAvailableURL, false);

function addingSellerDOMnotSelectToSelect(notSelect) {
	let modalImg = document.querySelector('.js-shoplogo img');
	let img = notSelect.querySelector('img');
	
	modalImg.src = img.src;
}

function addingSellerDOMyesSelectToNotSelect() {
	let modalImg = document.querySelector('.js-shoplogo img');
	modalImg.src = "/admin/App/templates/files/img/shops/default.png";
}

function deleteTitleError() {
	modalError.style.display = "none";
}

function launchImagesForNewSellerPopUp() {
	addingEmptyShopEndGetShopIdPOST();
}

function addingEmptyShopEndGetShopIdPOST() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '/App/Controllers/addingEmptyShopEndGetShopId.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );
	
	let modalError = document.querySelector('.modalBlock.error');
			
	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
			
			let shopId = e.target.response;
			
			currentTableId = shopId;
			loadingImagesInPopUp(2, 'shops/', addingSellerDOMnotSelectToSelect, addingSellerDOMyesSelectToNotSelect, 'ImagesForShop', 'shopId', shopId);
		} else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			modalError.style.display = "block";
			modalError.innerText = 'К сожалению, не удалось загрузить окно измений фотографий.';
			setTimeout(deleteTitleError, 5000);
			console.log('К сожалению, не удалось загрузить окно измений фотографий.');
		}
	});

	xhr.send('');
}

let addNewSeller_logoOfShop = document.querySelector('svg.addNewSeller_logoOfShop');
let clickAddNewSeller_logoOfShop = 0;
addNewSeller_logoOfShop.addEventListener('click', clickingAddNewSeller_logoOfShop);

onlyOne = 1;

function clickingAddNewSeller_logoOfShop() {
	if(clickAddNewSeller_logoOfShop == 0) {
		launchImagesForNewSellerPopUp();
		clickAddNewSeller_logoOfShop = 1;
	}
}

function addingOtherContactPhone() {
    let contactsPhone = document.querySelectorAll('.contactPhone .js-phone input');
    let contactPhone = contactsPhone[contactsPhone.length - 1];
    
    let newContactPhone = document.createElement('input');
    newContactPhone.className = "ng-untouched ng-invalid ng-dirty";
    newContactPhone.setAttribute('_size_medium', '');
    newContactPhone.setAttribute('formcontrolname', 'phone');
    newContactPhone.setAttribute('type', 'tel');
    newContactPhone.style.marginTop = '9px';
    
    contactPhone.after(newContactPhone);
}

let buttonAddPhone = document.querySelector('.addOtherPhone');
buttonAddPhone.addEventListener('click', addingOtherContactPhone);

function addingOtherShopPhone() {
    let contactsPhone = document.querySelectorAll('.js-shopphone input');
    let contactPhone = contactsPhone[contactsPhone.length - 1];
    
    let newContactPhone = document.createElement('input');
    newContactPhone.className = "ng-untouched ng-invalid ng-dirty";
    newContactPhone.setAttribute('_size_medium', '');
    newContactPhone.setAttribute('formcontrolname', 'shopphone');
    newContactPhone.setAttribute('type', 'tel');
    newContactPhone.style.marginTop = '9px';
    
    contactPhone.after(newContactPhone);
}

let buttonAddShopPhone = document.querySelector('.addOtherShopPhone');
buttonAddShopPhone.addEventListener('click', addingOtherShopPhone);

function addingOtherStock() {
    let stock = document.querySelectorAll('.stock');
    let numb = stock.length + 1;
    
    let newStock = document.createElement('div');
    newStock.className = "stock";
    newStock.setAttribute('style', 'margin-left: 15px; margin-top: 15px; padding-top: 15px; border-top: 1px solid #717171;');
    newStock.innerHTML = '<div class="form__row form__row_type_flex">\
                           <div class="form__row js-stockpostindex' + numb + '">\
                              <label class="form__label" for="new_seller_stockpostindex' + numb + '"><span class="wa-required"></span>Почтовый индекс:</label>\
    						  <input id="new_seller_stockpostindex' + numb + '" _size_medium="" formcontrolname="stockpostindex' + numb + '" type="text" class="ng-untouched ng-pristine ng-invalid">\
    						  <form-error class="validation-message">\
                              </form-error>\
    					   </div>\
                           <div class="form__row js-phone">\
                           </div>\
                        </div>\
                        <div class="title_for_input">\
        					Индекс должен обязательно соответствовать городу, в котором находится склад. Именно по почтовому индексу будет определятся город для создания заказов в системе доставки.\
        				</div>\
    				    <div class="form__row form__row_type_flex">\
                           <div class="form__row js-stockcountry' + numb + '">\
                              <label class="form__label" for="new_seller_stockcountry' + numb + '"><span class="wa-required"></span>Страна:</label>\
    						  <select>\
									<option value="" disabled="">Выберите страну</option>\
									<option value="rus">Российская Федерация</option>\
									<option value="" disabled=""></option>\
									<option value="aus">Австралия</option>\
									<option value="aut">Австрия</option>\
									<option value="aze">Азербайджан</option>\
									<option value="ala">Аландские Острова</option>\
									<option value="alb">Албания</option>\
									<option value="dza">Алжир</option>\
									<option value="aia">Ангилья</option>\
									<option value="ago">Ангола</option>\
									<option value="and">Андорра</option>\
									<option value="atg">Антигуа и Барбуда</option>\
									<option value="ant">Антильские Острова (Нидерландские)</option>\
									<option value="mac">Аомынь (Макао)</option>\
									<option value="arg">Аргентина</option>\
									<option value="arm">Армения</option>\
									<option value="abw">Аруба</option>\
									<option value="afg">Афганистан</option>\
									<option value="bhs">Багамские Острова</option>\
									<option value="bgd">Бангладеш</option>\
									<option value="brb">Барбадос</option>\
									<option value="bhr">Бахрейн</option>\
									<option value="blr">Беларусь</option>\
									<option value="blz">Белиз</option>\
									<option value="bel">Бельгия</option>\
									<option value="ben">Бенин</option>\
									<option value="bmu">Бермудские Острова</option>\
									<option value="bgr">Болгария</option>\
									<option value="bol">Боливия</option>\
									<option value="bes">Бонайре, Саба и Синт-Эстатиус</option>\
									<option value="bih">Босния и Герцеговина</option>\
									<option value="bwa">Ботсвана</option>\
									<option value="bra">Бразилия</option>\
									<option value="iot">Британская территория в Индийском океане</option>\
									<option value="brn">Бруней</option>\
									<option value="bvt">Буве, остров</option>\
									<option value="bfa">Буркина Фасо</option>\
									<option value="bdi">Бурунди</option>\
									<option value="btn">Бутан</option>\
									<option value="vut">Вануату</option>\
									<option value="vat">Ватикан</option>\
									<option value="gbr">Великобритания</option>\
									<option value="hun">Венгрия</option>\
									<option value="ven">Венесуэла</option>\
									<option value="vgb">Виргинские Острова (Британские)</option>\
									<option value="vir">Виргинские Острова (США)</option>\
									<option value="asm">Восточное Самоа</option>\
									<option value="tls">Восточный Тимор</option>\
									<option value="vnm">Вьетнам</option>\
									<option value="gab">Габон</option>\
									<option value="hti">Гаити</option>\
									<option value="guy">Гайана</option>\
									<option value="gmb">Гамбия</option>\
									<option value="gha">Гана</option>\
									<option value="glp">Гваделупа</option>\
									<option value="gtm">Гватемала</option>\
									<option value="guf">Гвиана Французская</option>\
									<option value="gin">Гвинея</option>\
									<option value="gnb">Гвинея-Бисау</option>\
									<option value="deu">Германия</option>\
									<option value="ggy">Гернси</option>\
									<option value="gib">Гибралтар</option>\
									<option value="hnd">Гондурас</option>\
									<option value="hkg">Гонконг</option>\
									<option value="grd">Гренада</option>\
									<option value="grl">Гренландия</option>\
									<option value="grc">Греция</option>\
									<option value="geo">Грузия</option>\
									<option value="gum">Гуам</option>\
									<option value="dnk">Дания</option>\
									<option value="jey">Джерси</option>\
									<option value="dji">Джибути</option>\
									<option value="dma">Доминика</option>\
									<option value="dom">Доминиканская Республика</option>\
									<option value="egy">Египет</option>\
									<option value="zmb">Замбия</option>\
									<option value="esh">Западная Сахара</option>\
									<option value="wsm">Западное Самоа</option>\
									<option value="zwe">Зимбабве</option>\
									<option value="isr">Израиль</option>\
									<option value="ind">Индия</option>\
									<option value="idn">Индонезия</option>\
									<option value="jor">Иордания</option>\
									<option value="irq">Ирак</option>\
									<option value="irn">Иран</option>\
									<option value="irl">Ирландия</option>\
									<option value="isl">Исландия</option>\
									<option value="esp">Испания</option>\
									<option value="ita">Италия</option>\
									<option value="yem">Йемен</option>\
									<option value="cpv">Кабо-Верде</option>\
									<option value="kaz">Казахстан</option>\
									<option value="cym">Каймановы острова</option>\
									<option value="khm">Камбоджа</option>\
									<option value="cmr">Камерун</option>\
									<option value="can">Канада</option>\
									<option value="qat">Катар</option>\
									<option value="ken">Кения</option>\
									<option value="cyp">Кипр</option>\
									<option value="kgz">Киргизия (Кыргызстан)</option>\
									<option value="kir">Кирибати</option>\
									<option value="chn">Китай</option>\
									<option value="cck">Кокосовые (Килинг) острова</option>\
									<option value="col">Колумбия</option>\
									<option value="com">Коморские Острова</option>\
									<option value="cog">Конго</option>\
									<option value="cod">Конго, Демократическая Республика</option>\
									<option value="prk">Корейская Народно-Демократическая Республика</option>\
									<option value="kor">Корея, Республика</option>\
									<option value="cri">Коста-Рика</option>\
									<option value="civ">Кот-д\'Ивуар</option>\
									<option value="cub">Куба</option>\
									<option value="kwt">Кувейт</option>\
									<option value="cok">Кука, Острова</option>\
									<option value="cuw">Кюрасао</option>\
									<option value="lao">Лаос</option>\
									<option value="lva">Латвия</option>\
									<option value="lso">Лесото</option>\
									<option value="lbr">Либерия</option>\
									<option value="lbn">Ливан</option>\
									<option value="lby">Ливия</option>\
									<option value="ltu">Литва</option>\
									<option value="lie">Лихтенштейн</option>\
									<option value="lux">Люксембург</option>\
									<option value="mus">Маврикий</option>\
									<option value="mrt">Мавритания</option>\
									<option value="mdg">Мадагаскар</option>\
									<option value="mkd">Македония</option>\
									<option value="mwi">Малави</option>\
									<option value="mys">Малайзия</option>\
									<option value="mli">Мали</option>\
									<option value="mdv">Мальдивы</option>\
									<option value="mlt">Мальта</option>\
									<option value="myt">Маоре (Майотта)</option>\
									<option value="mar">Марокко</option>\
									<option value="mtq">Мартиника</option>\
									<option value="mhl">Маршалловы Острова</option>\
									<option value="mex">Мексика</option>\
									<option value="umi">Мелкие отдаленные острова США</option>\
									<option value="fsm">Микронезия (Федеративные Штаты Микронезии)</option>\
									<option value="moz">Мозамбик</option>\
									<option value="mda">Молдова</option>\
									<option value="mco">Монако</option>\
									<option value="mng">Монголия</option>\
									<option value="msr">Монтсеррат</option>\
									<option value="mmr">Мьянма (Бирма)</option>\
									<option value="imn">Мэн, Остров</option>\
									<option value="nam">Намибия</option>\
									<option value="nru">Науру</option>\
									<option value="npl">Непал</option>\
									<option value="ner">Нигер</option>\
									<option value="nga">Нигерия</option>\
									<option value="nld">Нидерланды</option>\
									<option value="nic">Никарагуа</option>\
									<option value="niu">Ниуэ</option>\
									<option value="nzl">Новая Зеландия</option>\
									<option value="ncl">Новая Каледония</option>\
									<option value="nor">Норвегия</option>\
									<option value="nfk">Норфолк</option>\
									<option value="are">Объединенные Арабские Эмираты</option>\
									<option value="omn">Оман</option>\
									<option value="pak">Пакистан</option>\
									<option value="plw">Палау</option>\
									<option value="pse">Палестина</option>\
									<option value="pan">Панама</option>\
									<option value="png">Папуа — Новая Гвинея</option>\
									<option value="pry">Парагвай</option>\
									<option value="per">Перу</option>\
									<option value="pcn">Питкэрн</option>\
									<option value="pol">Польша</option>\
									<option value="prt">Португалия</option>\
									<option value="pri">Пуэрто-Рико</option>\
									<option value="abh">Республика Абхазия</option>\
									<option value="ost">Республика Южная Осетия</option>\
									<option value="reu">Реюньон</option>\
									<option value="cxr">Рождества (Кристмас), Остров</option>\
									<option value="rus">Российская Федерация</option>\
									<option value="rwa">Руанда</option>\
									<option value="rou">Румыния</option>\
									<option value="slv">Сальвадор</option>\
									<option value="smr">Сан-Марино</option>\
									<option value="stp">Сан-Томе и Принсипи</option>\
									<option value="sau">Саудовская Аравия</option>\
									<option value="swz">Свазиленд</option>\
									<option value="sjm">Свальбард (Шпицберген) и Ян-Майен</option>\
									<option value="shn">Святой Елены, Остров</option>\
									<option value="mnp">Северные Марианские Острова</option>\
									<option value="syc">Сейшельские Острова</option>\
									<option value="maf">Сен-Мартен</option>\
									<option value="spm">Сен-Пьер и Микелон</option>\
									<option value="sen">Сенегал</option>\
									<option value="blm">Сент-Бартельми</option>\
									<option value="vct">Сент-Винсент и Гренадины</option>\
									<option value="kna">Сент-Китс и Невис</option>\
									<option value="lca">Сент-Люсия</option>\
									<option value="srb">Сербия</option>\
									<option value="sgp">Сингапур</option>\
									<option value="sxm">Синт-Мартен</option>\
									<option value="syr">Сирия</option>\
									<option value="svk">Словакия</option>\
									<option value="svn">Словения</option>\
									<option value="usa">Соединенные Штаты Америки (США)</option>\
									<option value="slb">Соломоновы Острова</option>\
									<option value="som">Сомали</option>\
									<option value="sdn">Судан</option>\
									<option value="sur">Суринам</option>\
									<option value="sle">Сьерра-Леоне</option>\
									<option value="tjk">Таджикистан</option>\
									<option value="tha">Таиланд</option>\
									<option value="twn">Тайвань (провинция Китая)</option>\
									<option value="tza">Танзания</option>\
									<option value="tca">Теркс и Кайкос</option>\
									<option value="tgo">Того</option>\
									<option value="tkl">Токелау</option>\
									<option value="ton">Тонга</option>\
									<option value="tto">Тринидад и Тобаго</option>\
									<option value="tuv">Тувалу</option>\
									<option value="tun">Тунис</option>\
									<option value="tkm">Туркменистан</option>\
									<option value="tur">Турция</option>\
									<option value="uga">Уганда</option>\
									<option value="uzb">Узбекистан</option>\
									<option value="ukr">Украина</option>\
									<option value="wlf">Уоллис и Футуна</option>\
									<option value="ury">Уругвай</option>\
									<option value="fro">Фарерские острова</option>\
									<option value="fji">Фиджи</option>\
									<option value="phl">Филиппины</option>\
									<option value="fin">Финляндия</option>\
									<option value="flk">Фолклендские (Мальвинские) Острова</option>\
									<option value="fra">Франция</option>\
									<option value="pyf">Французская Полинезия</option>\
									<option value="atf">Французские Южные территории</option>\
									<option value="hmd">Херд и Макдональд, острова</option>\
									<option value="hrv">Хорватия</option>\
									<option value="caf">Центральноафриканская Республика</option>\
									<option value="tcd">Чад</option>\
									<option value="mne">Черногория</option>\
									<option value="cze">Чешская Республика</option>\
									<option value="chl">Чили</option>\
									<option value="che">Швейцария</option>\
									<option value="swe">Швеция</option>\
									<option value="lka">Шри-Ланка</option>\
									<option value="ecu">Эквадор</option>\
									<option value="gnq">Экваториальная Гвинея</option>\
									<option value="eri">Эритрея</option>\
									<option value="est">Эстония</option>\
									<option value="eth">Эфиопия</option>\
									<option value="sgs">Южная Георгия и Южные Сандвичевы острова</option>\
									<option value="zaf">Южно-Африканская Республика</option>\
									<option value="ssd">Южный Судан</option>\
									<option value="jam">Ямайка</option>\
									<option value="jpn">Япония</option>\
								</select>\
    						  <form-error class="validation-message">\
                              </form-error>\
    					   </div>\
                           <div class="form__row js-phone">\
                           </div>\
                        </div>\
    				    <div class="form__row form__row_type_flex">\
                           <div class="form__row js-stockregion' + numb + '">\
                              <label class="form__label" for="new_seller_stockregion' + numb + '"><span class="wa-required"></span>Регион /край /область /другое:</label>\
    						  <input id="new_seller_stockregion' + numb + '" _size_medium="" formcontrolname="stockregion' + numb + '" type="text" class="ng-untouched ng-pristine ng-invalid">\
    						  <form-error class="validation-message">\
                              </form-error>\
    					   </div>\
                           <div class="form__row js-phone">\
                           </div>\
                        </div>\
    				    <div class="form__row form__row_type_flex">\
                           <div class="form__row js-stockcity' + numb + '">\
                              <label class="form__label" for="new_seller_stockcity' + numb + '"><span class="wa-required"></span>Город:</label>\
    						  <input id="new_seller_stockcity' + numb + '" _size_medium="" formcontrolname="stockcity' + numb + '" type="text" class="ng-untouched ng-pristine ng-invalid">\
    						  <form-error class="validation-message">\
                              </form-error>\
    					   </div>\
                           <div class="form__row js-phone">\
                           </div>\
                        </div>\
    				    <div class="form__row form__row_type_flex">\
                           <div class="form__row js-stockstreet' + numb + '">\
                              <label class="form__label" for="new_seller_stockstreet' + numb + '"><span class="wa-required"></span>Улица/ проспект/ проулок /другое:</label>\
    						  <input id="new_seller_stockstreet' + numb + '" _size_medium="" formcontrolname="stockstreet' + numb + '" type="text" class="ng-untouched ng-pristine ng-invalid">\
    						  <form-error class="validation-message">\
                              </form-error>\
    					   </div>\
                           <div class="form__row js-phone">\
                           </div>\
                        </div>\
    				    <div class="form__row form__row_type_flex">\
                           <div class="form__row js-stockhome' + numb + '">\
                              <label class="form__label" for="new_seller_stockhome' + numb + '"><span class="wa-required"></span>Номер дома:</label>\
    						  <input id="new_seller_stockhome' + numb + '" _size_medium="" formcontrolname="stockhome' + numb + '" type="text" class="ng-untouched ng-pristine ng-invalid">\
    						  <form-error class="validation-message">\
                              </form-error>\
    					   </div>\
                           <div class="form__row js-phone">\
                           </div>\
                        </div>\
    				    <div class="form__row form__row_type_flex">\
                           <div class="form__row js-stockoffice' + numb + '">\
                              <label class="form__label" for="new_seller_stockoffice' + numb + '">Номер квартиры/ офисы/ склады /другого:</label>\
    						  <input id="new_seller_stockoffice' + numb + '" _size_medium="" formcontrolname="stockoffice' + numb + '" type="text" class="ng-untouched ng-pristine ng-invalid">\
    						  <form-error class="validation-message">\
                              </form-error>\
    					   </div>\
                           <div class="form__row js-phone">\
                           </div>\
                        </div>\
    				    <div class="form__row form__row_type_flex">\
                           <div class="form__row js-stockphone' + numb + '">\
                              <label class="form__label" for="new_seller_stockphone' + numb + '"><span class="wa-required"></span>Контактный телефон:</label>\
    						  <input id="new_seller_stockphone' + numb + '" _size_medium="" formcontrolname="stockphone' + numb + '" type="text" class="ng-untouched ng-pristine ng-invalid">\
    						  <form-error class="validation-message">\
                              </form-error>\
    					   </div>\
                           <div class="form__row js-phone">\
                           </div>\
                        </div>';
    this.before(newStock);
}

let buttonAddStock = document.querySelector('.addOtherStock');
buttonAddStock.addEventListener('click', addingOtherStock);
