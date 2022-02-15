function addNewSellerAddEntityTypes() {
	let editEntity = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_entity .input');
	let entityTypeInput = editEntity.querySelector('.inputing input[type="text"]');
	let editJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name .input');
	let fioInput = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_fio');
	
	let isLaunchSaving = 0;
	let isFirstSaving = 1;
	
	let isCheckedEmail = 1;
	let isCheckedShopURL = 1;
	let isCheckedShopName = 1;
	
	fioInput.addEventListener('keyup', function() {
		let checkedEntityType = editEntity.querySelector('option:checked');
		if(checkedEntityType !== null) {
			if(checkedEntityType.innerText == "ИП") {
				editJurName.innerHTML = this.value;
			}
		}
	}, false);
	
	function checkIsAvailableEmailOrLogin() {
		let divEmail = this.parentNode;
		let label = divEmail.querySelector('label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.' + divEmail.classList[0] + ' + div');
		
		if(this.value.length > 0) {
			if(this.value.length < 5) {
				label.classList.remove('notAvailble');
				label.classList.add('error');
				label.classList.add('notCorrectEmail');
				title.style.paddingTop = "17px";
				isCheckedEmail = 1;
			} else {
				label.classList.remove('error');
				label.classList.remove('notCorrectEmail');
				
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'App/Controllers/checkIsAvailableEmailOrLogin.php');
				xhr.setRequestHeader( "Content-Type", "application/json" );

				xhr.addEventListener('readystatechange', function(e) {
					console.log(e.target.response);
					if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
						if(e.target.response == '1') {
							label.classList.remove('error');
							label.classList.remove('notAvailble');
							title.style.paddingTop = "5px";
						} else {							
							label.classList.add('error');
							label.classList.add('notAvailble');
							title.style.paddingTop = "17px";
							isNormal = false;
						}
						isCheckedEmail = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
						}
					}
					else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
						console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
						isCheckedEmail = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
						}
					}
				});
				xhr.send('"' + this.value + '"');
			}
		} else {
			label.classList.remove('error');
			label.classList.remove('notAvailble');
			label.classList.remove('notCorrectEmail');
			title.style.paddingTop = "5px";
			isCheckedEmail = 1;
		}
	}
	
	function inputEmail() {
		let divEmail = this.parentNode;
		let label = divEmail.querySelector('label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.' + divEmail.classList[0] + ' + div');
		
		if(this.value.match(/\s/g) != null) {
			this.value = this.value.replace(/\s/g, '');
		}
		
		label.classList.remove('error');
		label.classList.remove('notCorrectEmail');
		label.classList.remove('notAvailble');
		title.style.paddingTop = "5px";
		isCheckedEmail = 0;
	}
	
	let emailLikeLogin = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_email');
	emailLikeLogin.addEventListener('blur', checkIsAvailableEmailOrLogin, false);
	emailLikeLogin.addEventListener('input', inputEmail, false);
	
	function checkIsAvailableShopName() {
		let div = this.parentNode;
		let label = div.querySelector('label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.' + div.classList[0] + ' + div');
		
		if(this.value.length > 0) {
			if(this.value.length < 4) {
				label.classList.remove('notAvailble');
				label.classList.add('error');
				label.classList.add('needMore');
				title.style.paddingTop = "17px";
				isCheckedShopName = 1;
			} else {
				label.classList.remove('error');
				label.classList.remove('needMore');
				
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'App/Controllers/checkIsAvailableShopName.php');
				xhr.setRequestHeader( "Content-Type", "application/json" );

				xhr.addEventListener('readystatechange', function(e) {
					console.log(e.target.response);
					if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
						if(e.target.response == '1') {
							label.classList.remove('error');
							label.classList.remove('notAvailble');
							title.style.paddingTop = "5px";
						} else {							
							label.classList.add('error');
							label.classList.add('notAvailble');
							title.style.paddingTop = "17px";
							isNormal = false;
						}
						isCheckedShopName = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
						}
					}
					else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
						console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
						isCheckedShopName = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
						}
					}
				});
				xhr.send('"' + this.value + '"');
			}
		} else {
			label.classList.remove('error');
			label.classList.remove('notAvailble');
			label.classList.remove('needMore');
			title.style.paddingTop = "5px";
			isCheckedShopName = 1;
		}
	}
	
	function inputShopName() {
		let div = this.parentNode;
		let label = div.querySelector('label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.' + div.classList[0] + ' + div');
		
		label.classList.remove('error');
		label.classList.remove('needMore');
		label.classList.remove('notAvailble');
		title.style.paddingTop = "5px";
		isCheckedShopName = 0;
	}
	
	let shopName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_nameOfShop');	
	shopName.addEventListener('blur', checkIsAvailableShopName, false);
	shopName.addEventListener('input', inputShopName, false);
	
	let newSelect = document.createElement('select');
	newSelect.id = 'addNewSeller_entityTypesSelect';
	
	let newOpinion = document.createElement('option');
	newOpinion.value = "";
	newOpinion.innerText = "";
	newSelect.append(newOpinion);
	
	for(let type of entityTypes) {
		let newOpinion = document.createElement('option');
		newOpinion.value = type[0];
		newOpinion.innerText = type[1];
		newSelect.append(newOpinion);
	}
	let devList = editEntity.querySelector('#addNewSeller_entityTypesList').parentNode;
	devList.append(newSelect);

	newSelect.addEventListener('change', function() {
		if(this.value == "") {
			editEntity.querySelector('#addNewSeller_entityTypesList').checked = false;
		} else {
			editEntity.querySelector('#addNewSeller_entityTypesList').checked = true;
		}
		if(this.value == 1) {
			editJurName.innerHTML = fioInput.value;
		} else {
			if(editJurName.querySelector('input') == undefined) {
				editJurName.innerHTML = "<input type=\"text\" id=\"addNewSeller_jurName\">";
			}
		}
	}, false);
	
	entityTypeInput.addEventListener('keyup', function() {
		if(this.value == "") {
			editEntity.querySelector('#addNewSeller_entityTypesInput').checked = false;
		} else {
			editEntity.querySelector('#addNewSeller_entityTypesInput').checked = true;
		}
		
		if(editJurName.querySelector('input') == undefined) {
			editJurName.innerHTML = "<input type=\"text\" id=\"addNewSeller_jurName\">";
		}
	}, false);
	
	let typesOfInputEntity = editEntity.querySelectorAll('input[type="radio"]');
	
	for(let elem of typesOfInputEntity) {
		elem.addEventListener('change', function() {
			if(this.value == "list") {
				let type = this.parentNode.querySelector('select option:checked').innerText;
				if(type == "ИП") {
					editJurName.innerHTML = fioInput.value;
				}
			} else if(this.value == "input") {
				if(editJurName.querySelector('input') == undefined) {
					editJurName.innerHTML = "<input type=\"text\" id=\"seller_jurName\">";
				}
			}
		});
	}
	
	let newPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.add_new_user_phone > div');
	let editPhone =  newPhone.querySelector('.input');
	
	let inputPhoneCode = editPhone.querySelector('.code input');
	let inputPhoneNumber = editPhone.querySelector('.number input');
	
	inputPhoneCode.addEventListener('input', inputingPhoneCode, false);
	
	function inputingPhoneCode() {
		let input = this.value.replace(/\D/g, '');
		let indexPlus = this.value.indexOf("+");
		
		if(indexPlus) {
			this.value = "+" + input.substring(indexPlus) + input.substring(0, indexPlus);
		} else {
			this.value = "+" + input;
		}
		
		if(this.value.length > 8) {
			this.value = this.value.substring(0, 8);
		}
			
		if(this.value !== "+") {
			this.parentNode.querySelector('.code label').classList.add('active');
			this.classList.add('active');
			addingNewPhone(this);
		} else {
			this.classList.remove('active');
			this.parentNode.querySelector('.code label').classList.remove('active');
		}
	}
	
	inputPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
	
	function inputingPhoneNumber() {
		this.value = this.value.replace(/\D/g, '');
		
		if(this.value.length > 15) {
			this.value = this.value.substring(0, 15);
		}
		
		if(this.value !== "") {
			this.parentNode.querySelector('.number label').classList.add('active');
			this.classList.add('active');
			addingNewPhone(this);
		} else {
			this.classList.remove('active');
			this.parentNode.querySelector('.number label').classList.remove('active');
		}
	}
	
	function addingNewPhone(input) {
		let phoneParentNode = input.parentNode.parentNode.parentNode.parentNode;
		
		if(phoneParentNode.classList.contains('add_new_user_phone')
			|| phoneParentNode.classList.contains('addNewSeller_phone')) {
			
			let nameClass;
			
			if(phoneParentNode.classList.contains('add_new_user_phone')) {
				nameClass = 'add_new_user_phone';
			} else if(phoneParentNode.classList.contains('addNewSeller_phone')) {
				nameClass = 'addNewSeller_phone';
			}
			
			let newPhone = phoneParentNode.querySelector('div');
			let editPhone =  newPhone.querySelectorAll('.input');
			
			let numberOfNewPhone = editPhone.length + 1;
			let newEditPhone = editPhone[editPhone.length-1];
		
			let inputNewPhoneCode = newEditPhone.querySelector('.code input');
			let inputNewPhoneNumber = newEditPhone.querySelector('.number input');
			
			if(input.parentNode.parentNode.querySelector('.code input').value !== "+" && input.value !== "") {
				if(inputNewPhoneCode.value !== "+" && inputNewPhoneNumber.value !== "") {
					let addNewPhone = document.createElement("div");
					addNewPhone.className = "input";
					addNewPhone.innerHTML = "<div class=\"code\">\
												<input type=\"text\" id=\"" + nameClass + "Code" + numberOfNewPhone + "\" value=\"+\">\
												<label for=\"" + nameClass + "Code" + numberOfNewPhone + "\">Код страны</label>\
											</div>\
											<div class=\"number\">\
												<input type=\"text\" id=\"" + nameClass + "" + numberOfNewPhone + "\">\
												<label for=\"" + nameClass + "" + numberOfNewPhone + "\">Номер телефона</label>\
											</div>";
					
					newPhone.append(addNewPhone);
					
					inputNewPhoneCode = addNewPhone.querySelector('.code input');
					inputNewPhoneNumber = addNewPhone.querySelector('.number input');
					
					inputNewPhoneCode.addEventListener('input', inputingPhoneCode, false);
					inputNewPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
				}
			}
		}
	}
	
	let shopPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_phone > div .input');
	
	let inputShopPhoneCode = shopPhone.querySelector('.code input');
	let inputShopPhoneNumber = shopPhone.querySelector('.number input');
	
	inputShopPhoneCode.addEventListener('input', inputingPhoneCode, false);
	inputShopPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
	
	let stockPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_stockroom .stockRoomList ul.address-list li.phones > div .input');
	
	let inputStockPhoneCode = stockPhone.querySelector('.code input');
	let inputStockPhoneNumber = stockPhone.querySelector('.number input');
	
	inputStockPhoneCode.addEventListener('input', inputingPhoneCode, false);
	inputStockPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
	
	function checkIsAvailableURL() {
		let divURLShop = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop');
		let label = divURLShop.querySelector('label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop + div');
		
		if(this.value.length > 0) {
			if(this.value.length < 4) {
				label.classList.remove('falseSimbols');
				label.classList.remove('notAvailble');
				label.classList.add('error');
				label.classList.add('needMore');
				title.style.paddingTop = "17px";
				isCheckedShopURL = 1;
			} else {
				label.classList.remove('error');
				label.classList.remove('needMore');
				label.classList.remove('notAvailble');
				label.classList.remove('falseSimbols');
				
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'App/Controllers/checkIsAvailableURL.php');
				xhr.setRequestHeader( "Content-Type", "application/json" );

				xhr.addEventListener('readystatechange', function(e) {
					console.log(e.target.response);
					if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
						if(e.target.response == '1') {
							title.style.paddingTop = "5px";
						} else {							
							label.classList.add('error');
							label.classList.add('notAvailble');
							title.style.paddingTop = "17px";
							isNormal = false;
						}
						isCheckedShopURL = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
						}
					}
					else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
						console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
						isCheckedShopURL = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
						}
					}
				});
				xhr.send('"' + this.value + '"');
			}
		} else {
			label.classList.remove('error');
			label.classList.remove('needMore');
			label.classList.remove('falseSimbols');
			label.classList.remove('notAvailble');
			title.style.paddingTop = "5px";
			isCheckedShopURL = 1;
		}
	}
	
	function inputURL() {
		let label = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop + div');
		
		if(this.value.match(/\W/g) != null) {			
			label.classList.add('error');
			label.classList.add('falseSimbols');
			title.style.paddingTop = "57px";
			this.value = this.value.replace(/\W/g, '');
		} else {
			label.classList.remove('error');
			label.classList.remove('falseSimbols');
			title.style.paddingTop = "5px";
		}
		isCheckedShopURL = 0;
	}
	
	let devShopUrl = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_URLShop');
	devShopUrl.addEventListener('input', inputURL, false);
	devShopUrl.addEventListener('blur', checkIsAvailableURL, false);
	
	let addNewSeller_logoOfShop = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_logoOfShop');
	let clickAddNewSeller_logoOfShop = 0;
	addNewSeller_logoOfShop.querySelector('svg').addEventListener('click', clickingAddNewSeller_logoOfShop);
	
	function clickingAddNewSeller_logoOfShop() {
		onlyOne = 1;
		if(clickAddNewSeller_logoOfShop == 0) {
			launchImagesForNewSellerPopUp();
			clickAddNewSeller_logoOfShop = 1;
		}
	}
	/*
	let inputsTypeNumber = document.querySelectorAll('input[type="number"]');
	
	inputsTypeNumber.addEventListener('input', inputAddressHomeOrOffice);
	
	for(let elem of inputsTypeNumber) {
		elem.addEventListener('input', inputAddressHomeOrOffice);
	}
	*/
	let addNewSeller_stockroom = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_stockroom .addNewStockroom');
	addNewSeller_stockroom.addEventListener('click', addNewStockRoom);
	
	
	let numberHome = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_stockroom .stockRoomList input#addNewSeller_stockAddrHome1');
	let numberOffice = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_stockroom .stockRoomList input#addNewSeller_stockAddrOffice1');
	/*
	numberHome.addEventListener('input', inputAddressHomeOrOffice, false);
	numberOffice.addEventListener('input', inputAddressHomeOrOffice, false);
	let jurAddrList = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_address ul.address-list');
	let jurHome = jurAddrList.querySelector('input#addNewSeller_jurAddrHome');
	let jurOffice = jurAddrList.querySelector('input#addNewSeller_jurAddrOffice');
	
	jurHome.addEventListener('input', inputAddressHomeOrOffice, false);
	jurOffice.addEventListener('input', inputAddressHomeOrOffice, false);
	
	let factAddrList = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.fact_address ul.address-list');
	let factHome = factAddrList.querySelector('input#addNewSeller_factAddrHome');
	let factOffice = factAddrList.querySelector('input#addNewSeller_factAddrOffice');
	
	factHome.addEventListener('input', inputAddressHomeOrOffice, false);
	factOffice.addEventListener('input', inputAddressHomeOrOffice, false);
	*/
	
	function addNewStockRoom() {
		let divStockRoom = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_stockroom .stockRoomList');
		
		let numberStockRoom = divStockRoom.querySelectorAll('.address-list').length + 1;
		
		let newStockRoomList = document.createElement('ul');
		newStockRoomList.className = "address-list";
		newStockRoomList.innerHTML = "\
						<span class=\"numberStock\">Склад " + numberStockRoom + "</span>\
						<li>\
							<label for=\"addNewSeller_stockAddrIndex" + numberStockRoom + "\">Индекс:</label>\
							<input type=\"text\" id=\"addNewSeller_stockAddrIndex" + numberStockRoom + "\">\
						</li>\
						<li>\
							<label for=\"addNewSeller_stockAddrCountry" + numberStockRoom + "\">Страна:</label>\
							<select id=\"addNewSeller_stockAddrCountry" + numberStockRoom + "\">\
									<option value=\"\" disabled=\"\">Выберите страну</option>\
									<option value=\"rus\">Российская Федерация</option>\
									<option value=\"\" disabled=\"\"></option>\
									<option value=\"aus\">Австралия</option>\
									<option value=\"aut\">Австрия</option>\
									<option value=\"aze\">Азербайджан</option>\
									<option value=\"ala\">Аландские Острова</option>\
									<option value=\"alb\">Албания</option>\
									<option value=\"dza\">Алжир</option>\
									<option value=\"aia\">Ангилья</option>\
									<option value=\"ago\">Ангола</option>\
									<option value=\"and\">Андорра</option>\
									<option value=\"atg\">Антигуа и Барбуда</option>\
									<option value=\"ant\">Антильские Острова (Нидерландские)</option>\
									<option value=\"mac\">Аомынь (Макао)</option>\
									<option value=\"arg\">Аргентина</option>\
									<option value=\"arm\">Армения</option>\
									<option value=\"abw\">Аруба</option>\
									<option value=\"afg\">Афганистан</option>\
									<option value=\"bhs\">Багамские Острова</option>\
									<option value=\"bgd\">Бангладеш</option>\
									<option value=\"brb\">Барбадос</option>\
									<option value=\"bhr\">Бахрейн</option>\
									<option value=\"blr\">Беларусь</option>\
									<option value=\"blz\">Белиз</option>\
									<option value=\"bel\">Бельгия</option>\
									<option value=\"ben\">Бенин</option>\
									<option value=\"bmu\">Бермудские Острова</option>\
									<option value=\"bgr\">Болгария</option>\
									<option value=\"bol\">Боливия</option>\
									<option value=\"bes\">Бонайре, Саба и Синт-Эстатиус</option>\
									<option value=\"bih\">Босния и Герцеговина</option>\
									<option value=\"bwa\">Ботсвана</option>\
									<option value=\"bra\">Бразилия</option>\
									<option value=\"iot\">Британская территория в Индийском океане</option>\
									<option value=\"brn\">Бруней</option>\
									<option value=\"bvt\">Буве, остров</option>\
									<option value=\"bfa\">Буркина Фасо</option>\
									<option value=\"bdi\">Бурунди</option>\
									<option value=\"btn\">Бутан</option>\
									<option value=\"vut\">Вануату</option>\
									<option value=\"vat\">Ватикан</option>\
									<option value=\"gbr\">Великобритания</option>\
									<option value=\"hun\">Венгрия</option>\
									<option value=\"ven\">Венесуэла</option>\
									<option value=\"vgb\">Виргинские Острова (Британские)</option>\
									<option value=\"vir\">Виргинские Острова (США)</option>\
									<option value=\"asm\">Восточное Самоа</option>\
									<option value=\"tls\">Восточный Тимор</option>\
									<option value=\"vnm\">Вьетнам</option>\
									<option value=\"gab\">Габон</option>\
									<option value=\"hti\">Гаити</option>\
									<option value=\"guy\">Гайана</option>\
									<option value=\"gmb\">Гамбия</option>\
									<option value=\"gha\">Гана</option>\
									<option value=\"glp\">Гваделупа</option>\
									<option value=\"gtm\">Гватемала</option>\
									<option value=\"guf\">Гвиана Французская</option>\
									<option value=\"gin\">Гвинея</option>\
									<option value=\"gnb\">Гвинея-Бисау</option>\
									<option value=\"deu\">Германия</option>\
									<option value=\"ggy\">Гернси</option>\
									<option value=\"gib\">Гибралтар</option>\
									<option value=\"hnd\">Гондурас</option>\
									<option value=\"hkg\">Гонконг</option>\
									<option value=\"grd\">Гренада</option>\
									<option value=\"grl\">Гренландия</option>\
									<option value=\"grc\">Греция</option>\
									<option value=\"geo\">Грузия</option>\
									<option value=\"gum\">Гуам</option>\
									<option value=\"dnk\">Дания</option>\
									<option value=\"jey\">Джерси</option>\
									<option value=\"dji\">Джибути</option>\
									<option value=\"dma\">Доминика</option>\
									<option value=\"dom\">Доминиканская Республика</option>\
									<option value=\"egy\">Египет</option>\
									<option value=\"zmb\">Замбия</option>\
									<option value=\"esh\">Западная Сахара</option>\
									<option value=\"wsm\">Западное Самоа</option>\
									<option value=\"zwe\">Зимбабве</option>\
									<option value=\"isr\">Израиль</option>\
									<option value=\"ind\">Индия</option>\
									<option value=\"idn\">Индонезия</option>\
									<option value=\"jor\">Иордания</option>\
									<option value=\"irq\">Ирак</option>\
									<option value=\"irn\">Иран</option>\
									<option value=\"irl\">Ирландия</option>\
									<option value=\"isl\">Исландия</option>\
									<option value=\"esp\">Испания</option>\
									<option value=\"ita\">Италия</option>\
									<option value=\"yem\">Йемен</option>\
									<option value=\"cpv\">Кабо-Верде</option>\
									<option value=\"kaz\">Казахстан</option>\
									<option value=\"cym\">Каймановы острова</option>\
									<option value=\"khm\">Камбоджа</option>\
									<option value=\"cmr\">Камерун</option>\
									<option value=\"can\">Канада</option>\
									<option value=\"qat\">Катар</option>\
									<option value=\"ken\">Кения</option>\
									<option value=\"cyp\">Кипр</option>\
									<option value=\"kgz\">Киргизия (Кыргызстан)</option>\
									<option value=\"kir\">Кирибати</option>\
									<option value=\"chn\">Китай</option>\
									<option value=\"cck\">Кокосовые (Килинг) острова</option>\
									<option value=\"col\">Колумбия</option>\
									<option value=\"com\">Коморские Острова</option>\
									<option value=\"cog\">Конго</option>\
									<option value=\"cod\">Конго, Демократическая Республика</option>\
									<option value=\"prk\">Корейская Народно-Демократическая Республика</option>\
									<option value=\"kor\">Корея, Республика</option>\
									<option value=\"cri\">Коста-Рика</option>\
									<option value=\"civ\">Кот-д'Ивуар</option>\
									<option value=\"cub\">Куба</option>\
									<option value=\"kwt\">Кувейт</option>\
									<option value=\"cok\">Кука, Острова</option>\
									<option value=\"cuw\">Кюрасао</option>\
									<option value=\"lao\">Лаос</option>\
									<option value=\"lva\">Латвия</option>\
									<option value=\"lso\">Лесото</option>\
									<option value=\"lbr\">Либерия</option>\
									<option value=\"lbn\">Ливан</option>\
									<option value=\"lby\">Ливия</option>\
									<option value=\"ltu\">Литва</option>\
									<option value=\"lie\">Лихтенштейн</option>\
									<option value=\"lux\">Люксембург</option>\
									<option value=\"mus\">Маврикий</option>\
									<option value=\"mrt\">Мавритания</option>\
									<option value=\"mdg\">Мадагаскар</option>\
									<option value=\"mkd\">Македония</option>\
									<option value=\"mwi\">Малави</option>\
									<option value=\"mys\">Малайзия</option>\
									<option value=\"mli\">Мали</option>\
									<option value=\"mdv\">Мальдивы</option>\
									<option value=\"mlt\">Мальта</option>\
									<option value=\"myt\">Маоре (Майотта)</option>\
									<option value=\"mar\">Марокко</option>\
									<option value=\"mtq\">Мартиника</option>\
									<option value=\"mhl\">Маршалловы Острова</option>\
									<option value=\"mex\">Мексика</option>\
									<option value=\"umi\">Мелкие отдаленные острова США</option>\
									<option value=\"fsm\">Микронезия (Федеративные Штаты Микронезии)</option>\
									<option value=\"moz\">Мозамбик</option>\
									<option value=\"mda\">Молдова</option>\
									<option value=\"mco\">Монако</option>\
									<option value=\"mng\">Монголия</option>\
									<option value=\"msr\">Монтсеррат</option>\
									<option value=\"mmr\">Мьянма (Бирма)</option>\
									<option value=\"imn\">Мэн, Остров</option>\
									<option value=\"nam\">Намибия</option>\
									<option value=\"nru\">Науру</option>\
									<option value=\"npl\">Непал</option>\
									<option value=\"ner\">Нигер</option>\
									<option value=\"nga\">Нигерия</option>\
									<option value=\"nld\">Нидерланды</option>\
									<option value=\"nic\">Никарагуа</option>\
									<option value=\"niu\">Ниуэ</option>\
									<option value=\"nzl\">Новая Зеландия</option>\
									<option value=\"ncl\">Новая Каледония</option>\
									<option value=\"nor\">Норвегия</option>\
									<option value=\"nfk\">Норфолк</option>\
									<option value=\"are\">Объединенные Арабские Эмираты</option>\
									<option value=\"omn\">Оман</option>\
									<option value=\"pak\">Пакистан</option>\
									<option value=\"plw\">Палау</option>\
									<option value=\"pse\">Палестина</option>\
									<option value=\"pan\">Панама</option>\
									<option value=\"png\">Папуа — Новая Гвинея</option>\
									<option value=\"pry\">Парагвай</option>\
									<option value=\"per\">Перу</option>\
									<option value=\"pcn\">Питкэрн</option>\
									<option value=\"pol\">Польша</option>\
									<option value=\"prt\">Португалия</option>\
									<option value=\"pri\">Пуэрто-Рико</option>\
									<option value=\"abh\">Республика Абхазия</option>\
									<option value=\"ost\">Республика Южная Осетия</option>\
									<option value=\"reu\">Реюньон</option>\
									<option value=\"cxr\">Рождества (Кристмас), Остров</option>\
									<option value=\"rus\">Российская Федерация</option>\
									<option value=\"rwa\">Руанда</option>\
									<option value=\"rou\">Румыния</option>\
									<option value=\"slv\">Сальвадор</option>\
									<option value=\"smr\">Сан-Марино</option>\
									<option value=\"stp\">Сан-Томе и Принсипи</option>\
									<option value=\"sau\">Саудовская Аравия</option>\
									<option value=\"swz\">Свазиленд</option>\
									<option value=\"sjm\">Свальбард (Шпицберген) и Ян-Майен</option>\
									<option value=\"shn\">Святой Елены, Остров</option>\
									<option value=\"mnp\">Северные Марианские Острова</option>\
									<option value=\"syc\">Сейшельские Острова</option>\
									<option value=\"maf\">Сен-Мартен</option>\
									<option value=\"spm\">Сен-Пьер и Микелон</option>\
									<option value=\"sen\">Сенегал</option>\
									<option value=\"blm\">Сент-Бартельми</option>\
									<option value=\"vct\">Сент-Винсент и Гренадины</option>\
									<option value=\"kna\">Сент-Китс и Невис</option>\
									<option value=\"lca\">Сент-Люсия</option>\
									<option value=\"srb\">Сербия</option>\
									<option value=\"sgp\">Сингапур</option>\
									<option value=\"sxm\">Синт-Мартен</option>\
									<option value=\"syr\">Сирия</option>\
									<option value=\"svk\">Словакия</option>\
									<option value=\"svn\">Словения</option>\
									<option value=\"usa\">Соединенные Штаты Америки (США)</option>\
									<option value=\"slb\">Соломоновы Острова</option>\
									<option value=\"som\">Сомали</option>\
									<option value=\"sdn\">Судан</option>\
									<option value=\"sur\">Суринам</option>\
									<option value=\"sle\">Сьерра-Леоне</option>\
									<option value=\"tjk\">Таджикистан</option>\
									<option value=\"tha\">Таиланд</option>\
									<option value=\"twn\">Тайвань (провинция Китая)</option>\
									<option value=\"tza\">Танзания</option>\
									<option value=\"tca\">Теркс и Кайкос</option>\
									<option value=\"tgo\">Того</option>\
									<option value=\"tkl\">Токелау</option>\
									<option value=\"ton\">Тонга</option>\
									<option value=\"tto\">Тринидад и Тобаго</option>\
									<option value=\"tuv\">Тувалу</option>\
									<option value=\"tun\">Тунис</option>\
									<option value=\"tkm\">Туркменистан</option>\
									<option value=\"tur\">Турция</option>\
									<option value=\"uga\">Уганда</option>\
									<option value=\"uzb\">Узбекистан</option>\
									<option value=\"ukr\">Украина</option>\
									<option value=\"wlf\">Уоллис и Футуна</option>\
									<option value=\"ury\">Уругвай</option>\
									<option value=\"fro\">Фарерские острова</option>\
									<option value=\"fji\">Фиджи</option>\
									<option value=\"phl\">Филиппины</option>\
									<option value=\"fin\">Финляндия</option>\
									<option value=\"flk\">Фолклендские (Мальвинские) Острова</option>\
									<option value=\"fra\">Франция</option>\
									<option value=\"pyf\">Французская Полинезия</option>\
									<option value=\"atf\">Французские Южные территории</option>\
									<option value=\"hmd\">Херд и Макдональд, острова</option>\
									<option value=\"hrv\">Хорватия</option>\
									<option value=\"caf\">Центральноафриканская Республика</option>\
									<option value=\"tcd\">Чад</option>\
									<option value=\"mne\">Черногория</option>\
									<option value=\"cze\">Чешская Республика</option>\
									<option value=\"chl\">Чили</option>\
									<option value=\"che\">Швейцария</option>\
									<option value=\"swe\">Швеция</option>\
									<option value=\"lka\">Шри-Ланка</option>\
									<option value=\"ecu\">Эквадор</option>\
									<option value=\"gnq\">Экваториальная Гвинея</option>\
									<option value=\"eri\">Эритрея</option>\
									<option value=\"est\">Эстония</option>\
									<option value=\"eth\">Эфиопия</option>\
									<option value=\"sgs\">Южная Георгия и Южные Сандвичевы острова</option>\
									<option value=\"zaf\">Южно-Африканская Республика</option>\
									<option value=\"ssd\">Южный Судан</option>\
									<option value=\"jam\">Ямайка</option>\
									<option value=\"jpn\">Япония</option>\
							<select>\
							</li>\
						<li>\
							<label for=\"addNewSeller_stockAddrRegion" + numberStockRoom + "\">Регион /край /область /другое:</label>\
							<input type=\"text\" id=\"addNewSeller_stockAddrRegion" + numberStockRoom + "\">\
						</li>\
						<li>\
							<label for=\"addNewSeller_stockAddrCity" + numberStockRoom + "\">Город:</label>\
							<input type=\"text\" id=\"addNewSeller_stockAddrCity" + numberStockRoom + "\">\
						</li>\
						<li>\
							<label for=\"addNewSeller_stockAddrStreet" + numberStockRoom + "\">Улица/ проспект/ проулок /другое:</label>\
							<input type=\"text\" id=\"addNewSeller_stockAddrStreet" + numberStockRoom + "\">\
						</li>\
						<li>\
							<label for=\"addNewSeller_stockAddrHome" + numberStockRoom + "\">Номер дома:</label>\
							<input type=\"text\" id=\"addNewSeller_stockAddrHome" + numberStockRoom + "\">\
						</li>\
						<li>\
							<label for=\"addNewSeller_stockAddrOffice" + numberStockRoom + "\">Номер квартиры/ офисы/ склады /другого:</label>\
							<input type=\"text\" id=\"addNewSeller_stockAddrOffice" + numberStockRoom + "\">\
						</li>\
						<li class=\"phones\">\
							<label for=\"addNewSeller_stockAddrPhoneCode" + numberStockRoom + "\">Контактный телефон:</label>\
							<div>\
								<div class=\"input\">\
									<div class=\"code\">\
										<input type=\"text\" id=\"addNewSeller_stockAddrPhoneCode" + numberStockRoom + "\" value=\"+\">\
										<label for=\"addNewSeller_stockAddrPhoneCode" + numberStockRoom + "\">Код страны</label>\
									</div>\
									<div class=\"number\">\
										<input type=\"text\" id=\"addNewSeller_stockAddrPhone" + numberStockRoom + "\">\
										<label for=\"addNewSeller_stockAddrPhone" + numberStockRoom + "\">Номер телефона</label>\
									</div>\
								</div>\
							</div>\
						</li>";
		
		divStockRoom.prepend(newStockRoomList);
		
		let inputNewPhoneCode = newStockRoomList.querySelector('li.phones .code input');
		let inputNewPhoneNumber = newStockRoomList.querySelector('li.phones .number input');
		
		inputNewPhoneCode.addEventListener('input', inputingPhoneCode, false);
		inputNewPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
		/*
		let numberHome = newStockRoomList.querySelector('input#addNewSeller_stockAddrHome' + numberStockRoom);
		let numberOffice = newStockRoomList.querySelector('input#addNewSeller_stockAddrOffice' + numberStockRoom);
		
		numberHome.addEventListener('input', inputAddressHomeOrOffice, false);
		numberOffice.addEventListener('input', inputAddressHomeOrOffice, false);*/
	}
	
	function clearTableForAddSeller() {
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_fio').value = '';		
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_email').value = '';
		
		let formPhonesHTML = "<div class=\"input\">\
									<div class=\"code\">\
										<input type=\"text\" id=\"add_new_user_phoneCode\" value=\"+\">\
										<label for=\"add_new_user_phoneCode\">Код страны</label>\
									</div>\
									<div class=\"number\">\
										<input type=\"number\" id=\"add_new_user_phone\">\
										<label for=\"add_new_user_phone\">Номер телефона</label>\
									</div>\
							</div>";
							
		let formShopPhonesHTML = "<div class=\"input\">\
									<div class=\"code\">\
										<input type=\"text\" id=\"addNewSeller_phoneCode\" value=\"+\">\
										<label for=\"addNewSeller_phoneCode\">Код страны</label>\
									</div>\
									<div class=\"number\">\
										<input type=\"number\" id=\"addNewSeller_phone\">\
										<label for=\"addNewSeller_phone\">Номер телефона</label>\
									</div>\
							</div>";
		
		let divPhones = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.add_new_user_phone > div');
		divPhones.innerHTML = formPhonesHTML;
		
		let editPhone =  divPhones.querySelector('.input');
		let inputPhoneCode = editPhone.querySelector('.code input');
		let inputPhoneNumber = editPhone.querySelector('.number input');
		
		inputPhoneCode.addEventListener('input', inputingPhoneCode, false);
		inputPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
		
		let divShopPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_phone > div');
		divShopPhone.innerHTML = formShopPhonesHTML;
		
		let editShopPhone =  divShopPhone.querySelector('.input');
		let inputShopPhoneCode = editShopPhone.querySelector('.code input');
		let inputShopPhoneNumber = editShopPhone.querySelector('.number input');
		
		inputShopPhoneCode.addEventListener('input', inputingPhoneCode, false);
		inputShopPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
		
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_password').value = '';
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_nameOfShop').value = '';
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_URLShop').value = '';
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_descriptionOfShop').value = '';
		
		let addNewSeller_logoOfShop = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_logoOfShop img');
		addNewSeller_logoOfShop.src = 'App/templates/files/img/shops/default.png';
		
		clickAddNewSeller_logoOfShop = 0;
		
		let oldBlockImages = document.querySelector('.loadNewLogoOfShop.toggleModal3');
		oldBlockImages.remove();
		
		newBlockImages = document.createElement('div');
		newBlockImages.className = "modalBlock loadNewLogoOfShop toggleModal3 level2";
		newBlockImages.dataset.state = "closed";
		newBlockImages.innerHTML = "<div class=\"modal__block\">\
			<div class=\"modalHeader\">\
				<div class=\"title\">Изменение фотографии</div>\
				<div class=\"select-all\">\
					<svg width=\"19\" height=\"19\" viewBox=\"0 0 512.000000 512.000000\" preserveAspectRatio=\"xMidYMid meet\" xmlns=\"http://www.w3.org/2000/svg\">\
						<g transform=\"translate(0.000000,512.000000) scale(0.100000,-0.100000)\" stroke=\"none\">\
						<path d=\"M203 4958 c-174 -172 -196 -198 -191 -231 3 -19 32 5 192 163 103 102 192 193 197 203 8 14 5 17 -17 17 -21 0 -60 -33 -181 -152z\"/>\
						<path d=\"M303 4858 c-140 -139 -264 -265 -275 -281 -10 -15 -18 -37 -16 -50 3 -18 49 23 292 263 158 157 292 293 297 303 8 14 5 17 -17 17 -22 0 -75 -47 -281 -252z\"/>\
						<path d=\"M402 4758 c-194 -194 -362 -365 -373 -381 -11 -15 -19 -37 -17 -50 4 -18 67 40 392 363 213 212 392 393 397 403 8 14 5 17 -18 17 -22 0 -89 -62 -381 -352z\"/>\
						<path d=\"M502 4658 c-249 -249 -462 -465 -473 -481 -11 -15 -19 -37 -17 -50 4 -18 84 57 492 463 268 267 492 493 497 503 8 14 5 17 -18 17 -22 0 -104 -76 -481 -452z\"/>\
						<path d=\"M602 4558 c-304 -304 -562 -565 -573 -581 -11 -15 -19 -37 -17 -50 4 -18 101 75 592 563 323 322 592 593 597 603 8 14 5 17 -18 17 -23 0 -118 -91 -581 -552z\"/>\
						<path d=\"M702 4458 c-359 -359 -662 -665 -673 -681 -11 -15 -19 -37 -17 -50 4 -18 118 92 692 663 378 377 692 693 697 703 8 14 5 17 -18 17 -23 0 -133 -106 -681 -652z\"/>\
						<path d=\"M802 4358 c-414 -414 -762 -765 -773 -781 -11 -15 -19 -37 -17 -50 4 -18 57 30 335 307 330 327 331 328 312 275 -10 -30 -18 -67 -19 -84 0 -25 -45 -75 -315 -345 -257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 145 138 314 306 l307 307 15 -49 14 -49 -329 -331 c-267 -269 -328 -335 -328 -357 0 -15 3 -27 7 -27 4 0 156 149 338 331 l332 330 25 -38 26 -38 -364 -366 c-298 -299 -364 -370 -364 -392 0 -15 3 -27 7 -27 4 0 175 168 380 372 l373 373 32 -33 33 -32 -413 -413 c-339 -340 -412 -418 -412 -440 0 -15 3 -27 7 -27 4 0 199 191 433 425 l426 426 42 -23 41 -23 -474 -475 c-395 -396 -475 -480 -475 -503 0 -23 3 -26 18 -18 9 5 234 227 500 494 l483 483 55 -10 55 -10 -555 -556 c-461 -461 -556 -560 -556 -583 0 -15 3 -27 7 -27 4 0 313 305 685 677 l678 678 0 -65 0 -65 -651 -650 c-357 -358 -655 -658 -660 -668 -8 -14 -5 -17 18 -17 23 0 130 102 660 632 l633 633 0 -65 0 -65 -551 -550 c-302 -303 -555 -558 -560 -567 -8 -15 -5 -18 18 -18 23 0 116 88 564 536 l537 537 15 -49 14 -49 -478 -480 c-264 -264 -479 -484 -479 -488 0 -4 12 -7 27 -7 22 0 108 81 490 462 254 254 464 460 466 457 2 -2 13 -20 25 -39 l21 -36 -405 -404 c-223 -223 -410 -413 -415 -422 -8 -15 -5 -18 18 -18 22 0 96 69 429 401 l402 401 37 -27 36 -28 -365 -366 c-201 -202 -366 -370 -366 -374 0 -4 12 -7 27 -7 22 0 92 65 384 357 l358 356 41 -18 c22 -10 40 -21 40 -24 0 -3 -142 -148 -316 -321 -173 -173 -320 -323 -325 -332 -8 -15 -5 -18 18 -18 22 0 85 58 353 325 l326 326 58 -7 58 -7 -311 -311 c-171 -172 -311 -315 -311 -319 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 347 319 l321 319 70 6 69 6 -317 -318 c-174 -175 -317 -321 -317 -325 0 -4 12 -7 27 -7 21 0 97 70 402 370 458 451 410 403 861 861 300 305 370 381 370 402 0 15 -3 27 -7 27 -4 0 -150 -143 -325 -317 l-318 -317 6 69 6 70 319 321 c260 261 319 325 319 347 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c263 264 320 326 320 349 0 22 -3 25 -17 17 -10 -5 -155 -147 -323 -315 l-304 -305 -18 47 -18 47 340 340 c280 281 340 346 340 368 0 23 -3 26 -17 18 -10 -5 -166 -159 -348 -340 -181 -182 -333 -331 -337 -331 -3 0 -16 16 -29 36 l-22 36 377 377 c308 309 376 382 376 404 0 15 -3 27 -7 27 -4 0 -182 -174 -394 -387 l-388 -386 -34 29 -35 29 429 430 c353 355 429 436 429 458 0 15 -3 27 -7 27 -4 0 -206 -199 -449 -441 l-442 -441 -47 17 -46 18 495 497 c410 410 496 501 496 523 0 15 -3 27 -7 27 -4 0 -239 -231 -523 -513 l-515 -513 -59 4 -59 4 582 582 c486 487 581 586 581 609 0 23 -3 26 -17 18 -10 -5 -288 -280 -618 -610 l-600 -601 -65 0 -65 0 628 628 c345 345 627 631 627 635 0 4 -12 7 -27 7 -23 0 -134 -107 -663 -635 l-635 -635 -65 0 -65 0 628 628 c345 345 627 631 627 635 0 4 -12 7 -27 7 -23 0 -116 -89 -543 -515 l-515 -515 -17 48 -17 47 459 460 c253 253 460 464 460 468 0 4 -12 7 -27 7 -22 0 -105 -78 -473 -444 l-445 -444 -26 37 -27 38 390 389 c214 214 394 397 399 407 8 14 5 17 -18 17 -22 0 -94 -67 -414 -386 -415 -414 -395 -398 -441 -347 -17 18 -4 32 323 358 187 187 345 348 350 358 8 14 5 17 -18 17 -22 0 -88 -61 -373 -346 l-347 -345 -39 18 c-21 9 -41 19 -43 21 -3 1 138 146 312 320 174 175 317 321 317 325 0 4 -12 7 -27 7 -22 0 -87 -59 -347 -318 l-321 -317 -58 5 -57 5 295 295 c163 162 301 303 306 313 8 14 5 17 -17 17 -23 0 -84 -56 -344 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 -270 -270 -320 -315 -345 -315 -17 -1 -54 -9 -84 -19 -53 -19 -52 -17 273 308 179 180 326 330 326 334 0 4 -12 7 -27 7 -23 0 -152 -125 -781 -752z m738 -663 c-210 -210 -356 -349 -358 -341 -2 8 2 41 7 73 l11 58 273 272 272 273 55 9 c30 5 64 9 75 10 13 1 -106 -125 -335 -354z m450 250 c-88 -88 -110 -105 -136 -105 -17 0 -53 -7 -79 -15 l-49 -14 119 119 120 120 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m-2150 -150 c-107 -107 -196 -195 -198 -195 -1 0 9 21 22 48 36 70 110 166 170 216 45 39 181 126 196 126 3 0 -83 -88 -190 -195z m-48 -386 l-15 -77 -98 -98 -99 -99 0 65 0 65 112 112 c62 62 113 111 114 110 1 -1 -5 -36 -14 -78z m-111 -373 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m0 -200 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m1847 -553 l-588 -588 -32 32 -32 33 44 46 c141 145 1067 1032 1093 1047 18 9 48 17 67 17 34 0 15 -20 -552 -587z m-1847 353 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m2531 160 c9 -16 -64 -93 -572 -601 -568 -568 -584 -583 -611 -573 -71 25 -94 -2 541 633 571 571 595 594 613 577 10 -9 23 -25 29 -36z m3 -123 c-9 -21 -39 -61 -68 -89 -128 -125 -917 -882 -957 -918 -25 -22 198 203 495 502 297 298 541 542 543 542 1 0 -5 -17 -13 -37z m-2534 -237 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m0 -200 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m973 186 c7 -11 -188 -205 -197 -196 -4 4 -7 30 -7 57 0 46 3 53 49 98 45 46 52 49 99 49 28 0 53 -4 56 -8z m9 -204 l-107 -108 -33 32 -33 32 107 108 107 108 33 -32 33 -32 -107 -108z m172 32 l29 -31 -107 -107 -107 -107 -32 33 -33 32 105 105 c58 58 107 105 110 105 4 0 19 -14 35 -30z m-1154 -214 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m1172 -28 c-59 -59 -110 -104 -113 -100 -3 4 -16 20 -30 35 l-24 28 104 104 104 105 33 -32 33 -32 -107 -108z m172 36 l28 -36 -104 -104 -103 -104 -33 32 -33 32 107 108 c59 59 108 108 109 108 1 0 14 -16 29 -36z m-1344 -208 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m0 -200 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m0 -200 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z\"/>\
						<path d=\"M4396 750 c-394 -393 -722 -723 -727 -732 -8 -15 -5 -18 18 -18 23 0 137 110 711 683 376 375 692 694 703 710 11 15 19 37 17 50 -4 18 -124 -97 -722 -693z\"/>\
						<path d=\"M4496 650 c-339 -338 -622 -623 -627 -632 -8 -15 -5 -18 18 -18 23 0 123 95 611 583 321 320 592 594 603 610 11 15 19 37 17 50 -4 18 -106 -80 -622 -593z\"/>\
						<path d=\"M4596 550 c-284 -283 -522 -523 -527 -533 -8 -14 -5 -17 18 -17 23 0 108 81 511 483 266 265 492 494 503 510 11 15 19 37 17 50 -4 18 -89 -62 -522 -493z\"/>\
						<path d=\"M4696 450 c-229 -228 -422 -423 -427 -432 -8 -15 -5 -18 18 -18 22 0 93 66 411 383 211 210 392 394 403 410 11 15 19 37 17 50 -4 18 -72 -45 -422 -393z\"/> \
						<path d=\"M4796 350 c-174 -173 -322 -323 -327 -332 -8 -15 -5 -18 17 -18 23 0 80 52 312 282 156 156 293 295 303 311 11 15 19 37 17 50 -4 18 -54 -28 -322 -293z\"/>\
						<path d=\"M4896 250 c-119 -118 -222 -223 -227 -232 -8 -15 -5 -18 17 -18 21 0 65 37 211 183 205 202 226 227 221 260 -3 19 -37 -11 -222 -193z\"/>\
						<path d=\"M4996 150 c-136 -133 -149 -150 -111 -150 18 0 49 23 111 82 102 98 127 130 122 161 -3 19 -19 7 -122 -93z\"/> </g>\
					</svg>\
				</div>\
				<div class=\"delete-bin\">\
					<svg width=\"17\" height=\"17\"  viewBox=\"0 0 225.000000 225.000000\" preserveAspectRatio=\"xMidYMid meet\" xmlns=\"http://www.w3.org/2000/svg\">\
						<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\">\
							<path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3-595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"/>\
							<path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/>\
							<path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/>\
							<path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/>\
						</g>\
					</svg>\
				</div>\
				<button class=\"modal__close toggleModal3 level2\" data-toggle=\"true\">\
					<svg width=\"14\" height=\"14\" viewBox=\"0 0 14 14\" xmlns=\"http://www.w3.org/2000/svg\">\
						<path d=\"M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z\" fill-rule=\"evenodd\"/>\
					</svg>\
				</button>\
			</div>\
			<div id=\"drop-area\">\
				<div class=\"areaBackground\">\
						<input type=\"file\" accept=\"image/*\" name=\"fileToUpload3\" id=\"fileToUpload3\" class=\"none\">\
						<div class=\"camera\">\
							<svg width=\"45\" height=\"45\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
								<g><path d=\"M500,359.2c-98.3,0-178.1,79.7-178.1,178.1c0,98.3,79.7,178.1,178.1,178.1c98.4,0,178.1-79.7,178.1-178.1C678.1,439,598.4,359.2,500,359.2z M203.1,136.4H99.4v44.9h103.7V136.4z M926.8,225.7h-194c-14.7-10.6-32.2-29.3-48.3-62.5c-19.5-40.2-89.7-41.5-89.7-41.5H368.6c0,0-23.1-5.7-50.3,41c-18.4,31.7-35.1,51.3-50.8,62.9H73.2c-34.9,0-63.2,30-63.2,67v518.8c0,37,28.3,67,63.2,67h853.5c34.9,0,63.2-30,63.2-67V292.6C990,255.7,961.7,225.7,926.8,225.7L926.8,225.7z M499.9,760.2c-122.9,0-222.6-99.7-222.6-222.6S377,314.9,499.9,314.9c122.9,0,222.6,99.7,222.6,222.6S622.8,760.2,499.9,760.2z M819,359.3c-20.5,0-37-16.6-37-37.2c0-20.5,16.6-37.2,37-37.2c20.5,0,37.1,16.6,37.1,37.2C856.1,342.7,839.5,359.3,819,359.3L819,359.3z\"/></g>\
							</svg>\
						</div>\
						<div class=\"title\">\
							Отпустите, чтобы начать загрузку\
						</div>\
				</div>\
			</div>\
			<label class=\"modalLoadNewPhoto\" for=\"fileToUpload3\">\
				<div class=\"title\">\
					<svg class=\"iconPlus\" width=\"14\" height=\"14\" viewBox=\"0 0 14 14\" xmlns=\"http://www.w3.org/2000/svg\">\
						<path d=\"M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z\" fill-rule=\"evenodd\"/>\
					</svg>\
					<span>Загрузить новую фотографию</span>\
				</div>\
			</label>\
			<div class=\"modalBody\">\
				<div class=\"fileUploadError\"></div>\
				<div class=\"fileLoading\"></div>\
				<div class=\"windowAllImages\">\
					<div class=\"rowImages\">\
					</div>\
				</div>\
			</div>\
		  </div>";
		
		let content = document.querySelector('.mainHtmlContent');
		content.append(newBlockImages);
		
		let togglesB = document.getElementsByClassName('toggleModal3');

		togglesB[2].addEventListener('click', function() {
				toggleModalBlock(3, 2);
		});
		
		togglesB[1].addEventListener('click', function() {
				toggleModalBlock(3, 2);
		});
		
		let modalwindowB = document.querySelector('.modalBlock.loadNewLogoOfShop .modal__block');
		modalwindowB.addEventListener('click', function() {
			event.stopPropagation();
		});
		
		let rowImages = document.querySelector('.modalBlock.loadNewLogoOfShop .modal__block .modalBody .rowImages');
		rowImages.innerHTML = "";
		
		let divStockRoom = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_stockroom .stockRoomList');
		let stockRoomLists = divStockRoom.querySelectorAll('ul.address-list');
		let numberOfstockRooms = stockRoomLists.length;
		
		if(stockRoomLists.length > 1) {
			for(let i = 0; i <  numberOfstockRooms -  1; i++) {
				stockRoomLists[i].remove();
			}
		}
		
		let stockRoomList = divStockRoom.querySelector('ul.address-list');
		
		stockRoomList.querySelector('input#addNewSeller_stockAddrIndex' + 1).value = '';
		stockRoomList.querySelector('select#addNewSeller_stockAddrCountry' + 1 + ' option[value="rus"]').selected = true;
		stockRoomList.querySelector('input#addNewSeller_stockAddrRegion' + 1).value = '';
		stockRoomList.querySelector('input#addNewSeller_stockAddrCity' + 1).value = '';
		stockRoomList.querySelector('input#addNewSeller_stockAddrStreet' + 1).value = '';
		stockRoomList.querySelector('input#addNewSeller_stockAddrHome' + 1).value = '';
		stockRoomList.querySelector('input#addNewSeller_stockAddrOffice' + 1).value = '';
		
		let formStockPhonesHTML = "<div class=\"input\">\
										<div class=\"code\">\
											<input type=\"text\" id=\"addNewSeller_stockAddrPhoneCode1\" value=\"+\">\
											<label for=\"addNewSeller_stockAddrPhoneCode1\">Код страны</label>\
										</div>\
										<div class=\"number\">\
											<input type=\"number\" id=\"addNewSeller_stockAddrPhone1\">\
											<label for=\"addNewSeller_stockAddrPhone1\">Номер телефона</label>\
										</div>\
									</div>"
		
		let divStockPhone = stockRoomList.querySelector('li.phones > div');
		divStockPhone.innerHTML = formStockPhonesHTML;
		
		let stockPhone = divStockPhone.querySelector('.input');
	
		let inputStockPhoneCode = stockPhone.querySelector('.code input');
		let inputStockPhoneNumber = stockPhone.querySelector('.number input');
		
		inputStockPhoneCode.addEventListener('input', inputingPhoneCode, false);
		inputStockPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
		
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_entity select option').selected = true;
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_entity .input .selecting input[type="radio"]').checked = false;
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_entity .input .inputing input[type="radio"]').checked = false;
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_entity .input .inputing input[type="text"]').value = '';
		
		
		let jurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name .input');
		jurName.innerHTML = "<input type=\"text\" id=\"addNewSeller_jurName\">";
			
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_bank').value = '';
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_accNum').value = '';
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_corNum').value = '';
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_BIK').value = '';
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_INN').value = '';
		
		let jurAddrList = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_address ul.address-list');
		jurAddrList.querySelector('input#addNewSeller_jurAddrIndex').value = '';
		jurAddrList.querySelector('select#addNewSeller_jurAddrCountry option[value="rus"]').selected = true;
		jurAddrList.querySelector('input#addNewSeller_jurAddrRegion').value = '';
		jurAddrList.querySelector('input#addNewSeller_jurAddrCity').value = '';
		jurAddrList.querySelector('input#addNewSeller_jurAddrStreet').value = '';
		jurAddrList.querySelector('input#addNewSeller_jurAddrHome').value = '';
		jurAddrList.querySelector('input#addNewSeller_jurAddrOffice').value = '';
		
		let factAddrList = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.fact_address ul.address-list');
		factAddrList.querySelector('input#addNewSeller_factAddrIndex').value = '';
		factAddrList.querySelector('select#addNewSeller_factAddrCountry option[value="rus"]').selected = true;
		factAddrList.querySelector('input#addNewSeller_factAddrRegion').value = '';
		factAddrList.querySelector('input#addNewSeller_factAddrCity').value = '';
		factAddrList.querySelector('input#addNewSeller_factAddrStreet').value = '';
		factAddrList.querySelector('input#addNewSeller_factAddrHome').value = '';
		factAddrList.querySelector('input#addNewSeller_factAddrOffice').value = '';		
	}
	
	function addNewSellerToDOM(dataOfNewUser) {
		let data = dataOfNewUser.split(',');
		
		let userId = data[0];
		let dataAdd = data[1];
		let sellerId = data[2];
		
		let jurAddId =  data[3];
		let factAddId =  data[4];
		
		let fio = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_fio').value;
		
		let inputEmail = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_email');
		let email = inputEmail.value;
		
		let divPhones = document.querySelectorAll('.modalBlock.addNewTable .modal__block .modalBody > div.add_new_user_phone > div .input');
		let phones = "['";
		for(let elem of divPhones) {
			let code = elem.querySelector('.code input').value;
			let number = elem.querySelector('.number input').value;
			let phone = code + number;
			if(code != "+" && number != "") {
				phones += phone;
				phones += "', '";
			}
		}
		phones += "]";
		
		let checkedEntityType = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_entity input:checked');
		let jurType = "", jurSelectedType = "";
		let inputEntityType = checkedEntityType.parentNode;
		let checkedSelectedEntityType = inputEntityType.querySelector('select option:checked');
		let checkedInputEntityType = inputEntityType.querySelector('#addNewSeller_seller_entityType');
		
		if(checkedSelectedEntityType !== null) {
			if(checkedEntityType.parentNode.querySelector('option:checked').innerText != "") {
				jurSelectedType = checkedSelectedEntityType.innerText;
				jurType = "";
			}
		} else if(checkedInputEntityType !== null) {
			if(checkedInputEntityType.value.length > 0) {
				jurType = checkedInputEntityType.value;
			} else {
				jurType = "";
			}
			jurSelectedType = "";
		}
		
		let divJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name');
		let jurNameInputed = divJurName.querySelector('.input #addNewSeller_jurName');
		let jurNameSelected = divJurName.querySelector('.input');
		let jurName;
		if(jurNameInputed != null) {
			jurName = jurNameInputed.value;
		} else {
			jurName = jurNameSelected.innerText;
		}
		
		let bank = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_bank').value;
		let currAccNum = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_accNum').value;		
		let corAccNum = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_corNum').value;
		let bik = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_BIK').value;
		let inn = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_INN').value;
		
		let jurAddrList = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_address ul.address-list');
		let jurIndex = jurAddrList.querySelector('input#addNewSeller_jurAddrIndex').value;
		let jurCountry = jurAddrList.querySelector('select#addNewSeller_jurAddrCountry option:checked').innerText;
		let jurRegion = jurAddrList.querySelector('input#addNewSeller_jurAddrRegion').value;
		let jurCity = jurAddrList.querySelector('input#addNewSeller_jurAddrCity').value;
		let jurStreet = jurAddrList.querySelector('input#addNewSeller_jurAddrStreet').value;
		let jurHome = jurAddrList.querySelector('input#addNewSeller_jurAddrHome').value;
		let jurOffice = jurAddrList.querySelector('input#addNewSeller_jurAddrOffice').value;
		
		let jurAddress = "['id' = '" + jurAddId + "', 'country' = '" + jurCountry + "', 'region' = '" + jurRegion + ", 'city' = '" + jurCity + "', 'street' = '" + jurStreet + "', 'home' = '" + jurHome + "', 'office' = '" + jurOffice + "', 'postIndex' = '" + jurIndex + "', ']";
		
		let factAddrList = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.fact_address ul.address-list');
		let factIndex = factAddrList.querySelector('input#addNewSeller_factAddrIndex').value;
		let factCountry = factAddrList.querySelector('select#addNewSeller_factAddrCountry option:checked').innerText;
		let factRegion = factAddrList.querySelector('input#addNewSeller_factAddrRegion').value;
		let factCity = factAddrList.querySelector('input#addNewSeller_factAddrCity').value;
		let factStreet = factAddrList.querySelector('input#addNewSeller_factAddrStreet').value;
		let factHome = factAddrList.querySelector('input#addNewSeller_factAddrHome').value;
		let factOffice = factAddrList.querySelector('input#addNewSeller_factAddrOffice').value;
		
		let factAddress = "['id' = '" + factAddId + "', 'country' = '" + factCountry + "', 'region' = '" + factRegion + ", 'city' = '" + factCity + "', 'street' = '" + factStreet + "', 'home' = '" + factHome + "', 'office' = '" + factOffice + "', 'postIndex' = '" + factIndex + "', ']";
		
		let newTr = document.createElement('tr');
		newTr.innerHTML = "<td class=\"none\" data-id=\"" + sellerId + "\" data-userid=\"" + userId + "\"\
		data-phones=\"" + phones + "\" data-jur-selected-type=\"" + jurSelectedType + "\" data-jur-type=\"" + jurType + "\"\
		data-jur-name=\"" + jurName + "\" data-bank=\"" + bank + "\" data-curr-acc-num=\"" + currAccNum + "\" data-cor-acc-num=\"" + corAccNum + "\"\
		data-bik=\"" + bik + "\" data-inn=\"" + inn + "\" data-istrading=\"0\" data-status-of-trading=\"\" data-is-included=\"1\"\
		data-bank-code=\"\" data-jur-add=\"" + jurAddress + "\" data-fact-add=\"" + factAddress + "\"></td>\
		<td class=\"full_name\">" + fio + "</td>\
		<td class=\"email\">" + email + "</td>\
		<td>" + dataAdd + "</td>\
		<td>Неодобрен</td>\
		<td></td><td>Включён</td>\
		<td class=\"editSeller\">\
			<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"version=&quot;1.1&quot;\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
				<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>\
			</svg><br>Редактировать\
		</td>\
		<td class=\"deleteSeller\">\
			<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"version=&quot;1.1&quot;\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
				<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\"><path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"></path><path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path></g>\
			</svg><br>Удалить\
		</td>";
		
		let tableSellersTbody = document.querySelector('.table_sellers tbody');
		tableSellersTbody.append(newTr);
		
		newTr.querySelector('.editSeller').addEventListener('click', actionSeller, false);
		newTr.querySelector('.deleteSeller').addEventListener('click', actionSeller, false);
		
		changeLeftMenuHeight();
	}
	
	function afterSavingNewSeller(dataOfNewUser) {
		addNewSellerToDOM(dataOfNewUser);
		clearTableForAddSeller();		
		toggleModalBlock(0, 1);
	}
	
	function saveNewSellerPOST(arrayForNewSeller) {
		console.log(arrayForNewSeller);
		
		isFirstSaving = 0;
		
		let fio = arrayForNewSeller[0];
		let email = arrayForNewSeller[1];
		let phones = arrayForNewSeller[2];
		let shopPhones = arrayForNewSeller[3];
		let accPassword = arrayForNewSeller[4]; 
		let shopName = arrayForNewSeller[5]; 
		let shopUrl = arrayForNewSeller[6]; 
		let shopDescription = arrayForNewSeller[7]; 
		let shopLogoUrl = arrayForNewSeller[8]; 
		let stockRooms = arrayForNewSeller[9];
		stockRooms = stockRooms.join('_');
		let jurSelectedType = arrayForNewSeller[10]; 
		let jurType = arrayForNewSeller[11]; 
		let jurName = arrayForNewSeller[12]; 
		let bank = arrayForNewSeller[13]; 
		let currAccNum = arrayForNewSeller[14]; 
		let corAccNum = arrayForNewSeller[15]; 
		let bik = arrayForNewSeller[16]; 
		let inn = arrayForNewSeller[17];
		let jurAddr = arrayForNewSeller[18];//.replace(/,/g, '');
		let factAddr = arrayForNewSeller[19];//.replace(/,/g, '');
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'App/Controllers/registerNewSeller.php');

		xhr.addEventListener('readystatechange', function(e) {
			
			if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
				afterSavingNewSeller(e.target.response);
				isFirstSaving = 1;
				console.log(e.target.response);
			}
			else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
				let errorMessage = document.querySelector('.modalBlock.error.level2 .modalBody');
				errorMessage.innerHTML = "<p>Не удалось добавить нового продавца.</p>";
				toggleModalBlock(4, 2);
				isFirstSaving = 1;
				console.log('Не удалось добавить нового продавца.');
			}
		});
				
				
        var fd = new FormData;
		fd.append("fio", fio);
		fd.append("email", email);
		fd.append("phones", phones);
		fd.append("accPassword", accPassword);
		fd.append("shopName", shopName);
		fd.append("shopUrl", shopUrl);
		fd.append("shopDescription", shopDescription);
		fd.append("shopLogoUrl", shopLogoUrl);
		fd.append("shopPhones", shopPhones);
		fd.append("stockRooms", stockRooms);
		fd.append("jurSelectedType", jurSelectedType);
		fd.append("jurType", jurType);
		fd.append("jurName", jurName);
		fd.append("bank", bank);
		fd.append("currAccNum", currAccNum);
		fd.append("corAccNum", corAccNum);
		fd.append("bik", bik);
		fd.append("inn", inn);
		fd.append("jurAddr", jurAddr);
		fd.append("factAddr", factAddr);
		xhr.send(fd);
	}
	
	function saveNewSeller() {
		if(isFirstSaving == 0) {
			return false;
		}
		
		if(isCheckedEmail == 0) {
			let inputEmail = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_email');
			
			isLaunchSaving = 1;
			
			let eventBlur = new Event("blur");
			inputEmail.dispatchEvent(eventBlur);
			
			return false;
		}
		
		if(isCheckedShopURL == 0) {
			let inputShopUrl = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_URLShop');
		
			isLaunchSaving = 1;
			
			let eventBlur = new Event("blur");
			inputShopUrl.dispatchEvent(eventBlur);
			
			return false;
		}
		
		if(isCheckedShopName == 0) {
			let inputShopName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_nameOfShop');	
		
			isLaunchSaving = 1;
			
			let eventBlur = new Event("blur");
			inputShopName.dispatchEvent(eventBlur);
			
			return false;
		}
		
		let isNormal = true;
		let errorField = "";
		
		let fio = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_fio').value;
		if(fio == '') {
			isNormal = false;
			errorField += "<p>Введите фамилию, имя, отчество продавца (ФИО).</p>";
		}
		
		let inputEmail = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_email');
		let email = inputEmail.value;
		
		let labelEmail = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_email label');
		
		if(email.length == 0) {
			isNormal = false;
			errorField += "<p>Введите адрес электронной почты продавца (email).</p>";
		} else if(email.length < 5) {
			errorField += "<p>Введите корректный адрес электронной почты продавца (email).</p>";
		} else if(labelEmail.classList.contains('notAvailble')) {
			isNormal = false;
			errorField += "<p>Измените email продавца на доступный.</p>";
		}
		
		let divPhones = document.querySelectorAll('.modalBlock.addNewTable .modal__block .modalBody > div.add_new_user_phone > div .input');
		let phones = [];
		for(let elem of divPhones) {
			let code = elem.querySelector('.code input').value;
			let number = elem.querySelector('.number input').value;
			let phone = code + number;
			if(code != "+" && number != "") {				
				phones.push(phone);
			}
		}
		if(phones.length == 0) {
			isNormal = false;
			errorField += "<p>Введите номер контактного телефона.</p>";
		}
		let accPassword = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_password').value;
		if(accPassword.length < 6) {
			isNormal = false;
			errorField += "<p>Пароль должен быть не меньше 6 символов.</p>";
		}
		
		let shopName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_nameOfShop').value;
		let labelShopName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_shopName label');
		
		if(shopName.length == 0) {
			isNormal = false;
			errorField += "<p>Введите название магазина продавца.</p>";
		} else if(shopName.length < 4) {
			isNormal = false;
			errorField += "<p>Название магазина должно быть не меньше 4-х символов.</p>";
		} else if(labelShopName.classList.contains('notAvailble')) {
			isNormal = false;
			errorField += "<p>Измените название магазина на доступный.</p>";
		}
		
		let inputShopUrl = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_URLShop');
		let shopUrl = inputShopUrl.value;
				
		let labelShopURL = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop label');
		
		if(shopUrl.length > 0 && shopUrl.length < 4) {
			isNormal = false;
			errorField += "<p>Адрес(URL) магазина  должен быть не меньше 4-х символов.</p>";
		} else if(labelShopURL.classList.contains('notAvailble')) {
			isNormal = false;
			errorField += "<p>Измените URL магазина на доступный.</p>";
		}
		
		let shopDescription = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_descriptionOfShop').value;
		if(shopDescription == '') {
			isNormal = false;
			errorField += "<p>Введите описание магазина продавца.</p>";
		}
		let shopLogo = document.querySelector('.modalBlock.loadNewLogoOfShop .modal__block .modalBody .imageCart .select img');
		let shopLogoUrl = "App/templates/files/img/shops/default.png";
		if(shopLogo != null) {
			shopLogoUrl = "App/templates/files/img/shops/" + shopLogo.dataset.filename;
		} else {
			isNormal = false;
			errorField += "<p>Загрузите и выбирете логотип для магазина продавца.</p>";
		}
		
		let divShopPhones = document.querySelectorAll('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_phone > div .input');
		let shopPhones = [];
		for(let elem of divShopPhones) {
			let code = elem.querySelector('.code input').value;
			let number = elem.querySelector('.number input').value;
			let phone = code + number;
			if(code != "+" && number != "") {				
				shopPhones.push(phone);
			}
		}
		if(shopPhones.length == 0) {
			isNormal = false;
			errorField += "<p>Введите номер телефона для отслеживания покупок.</p>";
		}
		
		let divStockRoom = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_stockroom .stockRoomList');
		let stockRoomLists = divStockRoom.querySelectorAll('ul.address-list');
		let stockRooms = [];
		
		for(let i = stockRoomLists.length - 1; i >= 0; i--) {
			number = stockRoomLists.length - i;
			
			let stockIndex = stockRoomLists[i].querySelector('input#addNewSeller_stockAddrIndex' + number).value;
			let stockCountry = stockRoomLists[i].querySelector('select#addNewSeller_stockAddrCountry' + number + ' option:checked').innerText;
			let stockRegion = stockRoomLists[i].querySelector('input#addNewSeller_stockAddrRegion' + number).value;
			let stockCity = stockRoomLists[i].querySelector('input#addNewSeller_stockAddrCity' + number).value;
			let stockStreet = stockRoomLists[i].querySelector('input#addNewSeller_stockAddrStreet' + number).value;
			let stockHome = stockRoomLists[i].querySelector('input#addNewSeller_stockAddrHome' + number).value;
			let stockOffice = stockRoomLists[i].querySelector('input#addNewSeller_stockAddrOffice' + number).value;
			
			let divPhone = stockRoomLists[i].querySelector('.input');
			let phone = "";
			let phoneCode = divPhone.querySelector('.code input').value;
			let phoneNumber = divPhone.querySelector('.number input').value;
			
			if(phoneCode != "+" && phoneNumber != "") {				
				phone = phoneCode + phoneNumber;
			}
			
			if(stockIndex.length > 0 && stockRegion.length > 0 && stockCity.length > 0 &&  stockStreet.length > 0 &&  stockHome.length > 0 && phone.length > 0) {
				stockAddr = stockIndex.replace(/,/g, '') + "," + stockCountry.replace(/,/g, '') + "," + stockRegion.replace(/,/g, '') + "," + stockCity.replace(/,/g, '') + "," + stockStreet.replace(/,/g, '') + "," + stockHome.replace(/,/g, '') + "," + stockOffice.replace(/,/g, '') + "," + phone;				
				stockRooms.push(stockAddr.replace(/_/g, ''));
			}
		}
		
		if(stockRooms.length == 0) {
			isNormal = false;
			errorField += "<p>Введите адрес склада продавца. Все поля, кроме номера офиса, должны быть обязательно заполнены.</p>";
		}
		
		let checkedEntityType = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_entity input:checked');
		let jurType = "NULL", jurSelectedType = "NULL";
		if(checkedEntityType != null) {
			let inputEntityType = checkedEntityType.parentNode;
			let checkedSelectedEntityType = inputEntityType.querySelector('select option:checked');
			let checkedInputEntityType = inputEntityType.querySelector('#addNewSeller_seller_entityType');
			
			if(checkedSelectedEntityType !== null) {
				if(checkedEntityType.parentNode.querySelector('option:checked').innerText == "") {
					isNormal = false;
					errorField += "<p>Выберите форму собственности продавца.</p>";
				} else {
					jurSelectedType = checkedSelectedEntityType.innerText;
					jurType = "NULL";
				}
			} else if(checkedInputEntityType !== null) {
				if(checkedInputEntityType.value.length > 0) {
					jurType = checkedInputEntityType.value;
				} else {
					jurType = "NULL";
				}
				jurSelectedType = "NULL";
			}
			
			if(jurType == "NULL" && jurSelectedType == "NULL") {
				isNormal = false;
				errorField += "<p>Выберите форму собственности продавца.</p>";
			}
		} else {
			isNormal = false;
			errorField += "<p>Выберите форму собственности продавца.</p>";
		}
		
		let divJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name');
		let jurNameInputed = divJurName.querySelector('.input #addNewSeller_jurName');
		let jurNameSelected = divJurName.querySelector('.input');
		let jurName;
		if(jurNameInputed != null) {
			jurName = jurNameInputed.value;
			if(jurName == '') {
				isNormal = false;
				errorField += "<p>Введите юридическое название компании продавца.</p>";
			}
		} else {
			jurName = jurNameSelected.innerText;
			if(jurName == '') {
				isNormal = false;
			}
		}
		
		let bank = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_bank').value;
		if(bank.length == 0) {
			isNormal = false;
			errorField += "<p>Введите юридическое название банка в котором открыт счёт.</p>";
		}
		
		let currAccNum = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_accNum').value;
		if(currAccNum.length == 0) {
			isNormal = false;
			errorField += "<p>Введите номер расчётного счёта.</p>";
		}
		
		let corAccNum = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_corNum').value;
		if(corAccNum.length == 0) {
			isNormal = false;
			errorField += "<p>Введите корреспондентского счёта.</p>";
		}
		
		let bik = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#add_new_user_BIK').value;
		if(bik.length == 0) {
			isNormal = false;
			errorField += "<p>Введите БИК.</p>";
		}
		
		let inn = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_INN').value;
		if(inn.length == 0) {
			isNormal = false;
			errorField += "<p>Введите ИНН.</p>";
		}
		
		let jurAddrList = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_address ul.address-list');
		let jurIndex = jurAddrList.querySelector('input#addNewSeller_jurAddrIndex').value;
		let jurCountry = jurAddrList.querySelector('select#addNewSeller_jurAddrCountry option:checked').innerText;
		let jurRegion = jurAddrList.querySelector('input#addNewSeller_jurAddrRegion').value;
		let jurCity = jurAddrList.querySelector('input#addNewSeller_jurAddrCity').value;
		let jurStreet = jurAddrList.querySelector('input#addNewSeller_jurAddrStreet').value;
		let jurHome = jurAddrList.querySelector('input#addNewSeller_jurAddrHome').value;
		let jurOffice = jurAddrList.querySelector('input#addNewSeller_jurAddrOffice').value;
		if(jurRegion == '') {
			isNormal = false;
			errorField += "<p>Введите регион юридического адреса продавца.</p>";
		} else if(jurCity == '') {
			isNormal = false;
			errorField += "<p>Введите город юридического адреса продавца.</p>";
		} else if(jurStreet == '') {
			isNormal = false;
			errorField += "<p>Введите улицу юридического адреса продавца.</p>";
		} else if(jurHome == '') {
			isNormal = false;
			errorField += "<p>Введите номер дома юридического адреса продавца.</p>";
		}
		
		let factAddrList = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.fact_address ul.address-list');
		let factIndex = factAddrList.querySelector('input#addNewSeller_factAddrIndex').value;
		let factCountry = factAddrList.querySelector('select#addNewSeller_factAddrCountry option:checked').innerText;
		let factRegion = factAddrList.querySelector('input#addNewSeller_factAddrRegion').value;
		let factCity = factAddrList.querySelector('input#addNewSeller_factAddrCity').value;
		let factStreet = factAddrList.querySelector('input#addNewSeller_factAddrStreet').value;
		let factHome = factAddrList.querySelector('input#addNewSeller_factAddrHome').value;
		let factOffice = factAddrList.querySelector('input#addNewSeller_factAddrOffice').value;
		if(factRegion == '') {
			isNormal = false;
			errorField += "<p>Введите регион фактического адреса продавца.</p>";
		} else if(factCity == '') {
			isNormal = false;
			errorField += "<p>Введите город фактического адреса продавца.</p>";
		} else if(factStreet == '') {
			isNormal = false;
			errorField += "<p>Введите улицу фактического адреса продавца.</p>";
		} else if(factHome == '') {
			isNormal = false;
			errorField += "<p>Введите номер дома фактического адреса продавца.</p>";
		}
		
		if(!isNormal) {
			let errorMessage = document.querySelector('.modalBlock.error.level2 .modalBody');
			errorMessage.innerHTML = errorField;
			toggleModalBlock(4, 2);
		} else {
			saveNewSellerPOST([fio, email, phones, shopPhones, accPassword, shopName, shopUrl, shopDescription, shopLogoUrl, stockRooms, 
								jurSelectedType, jurType, jurName, bank, currAccNum, corAccNum, bik, inn,
								[jurIndex, jurCountry, jurRegion, jurCity, jurStreet, jurHome, jurOffice],
								[factIndex, factCountry, factRegion, factCity, factStreet, factHome, factOffice]]);
		}
	}
	
	let buttonSaveAddingSeller = document.querySelector('.modalBlock.addNewTable .modalHeader .save-new-table');
	buttonSaveAddingSeller.addEventListener('click', saveNewSeller, false);
}

addNewSellerAddEntityTypes();
