function addNewGood() {
	let isLaunchSaving = 0;
	let isFirstSaving = 1;
	
	let isCheckedShopJurName = 1;
	
	function checkIsAvailableShopJurName() {
		let div = this.parentNode.parentNode;
		let label = div.querySelector('label');
		
		console.log(label);
		
		if(this.value.length > 0) {
			label.classList.remove('error');
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'App/Controllers/checkIsShopJurNameAndReturnStocks.php');
			xhr.setRequestHeader( "Content-Type", "application/json" );

			xhr.addEventListener('readystatechange', function(e) {
				console.log(e.target.response);
				if (xhr.readyState == 4 && xhr.status == 200) {
					if(e.target.response.length > 0) {
						label.classList.remove('error');
						label.classList.remove('notAvailble');
						arrShops = e.target.response.split(']]]');
						
						let selectShops =  document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.shopName select');
						selectShops.innerHTML = '<option value="" disabled="">Выберите магазин</option>';
								
						for(let elem of arrShops) {
							if(elem.length > 0) {
								arrElems = elem.split(',|,');
								
								let newOption = document.createElement('option');
								newOption.setAttribute('value', arrElems[0]);
								newOption.innerText = arrElems[1];
								
								selectShops.append(newOption);
							}
						}
					} else {
						label.classList.add('error');
						label.classList.add('notAvailble');
						
						let selectShops =  document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.shopName select');
						selectShops.innerHTML = '<option value="" disabled="">Выберите магазин</option>';
						
						isNormal = false;
					}
					isCheckedShopJurName = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveNewStockroom();
					}
				}
				else if (xhr.readyState == 4 && (xhr.status != 200)) {
					console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
					isCheckedShopJurName = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveNewStockroom();
					}
				}
			});
			xhr.send('"' + this.value + '"');
		} else {
			label.classList.remove('error');
			label.classList.remove('notAvailble');
			isCheckedShopJurName = 1;
		}
	}
	
	function inputShopJurName() {
		let div = this.parentNode.parentNode;
		let label = div.querySelector('label');
		
		label.classList.remove('error');
		label.classList.remove('needMore');
		label.classList.remove('notAvailble');
		isCheckedShopJurName = 0;
	}
	
	if(typeof(sellerJuridicName) == "undefined") {
		let shopJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_jurName');	
		shopJurName.addEventListener('blur', checkIsAvailableShopJurName, false);
		shopJurName.addEventListener('input', inputShopJurName, false);
	} else {
		let arrShops = listShops.split(']]]');

		let selectShops =  document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.shopName select');
		selectShops.innerHTML = '<option value="" disabled="">Выберите магазин</option>';
		
		for(let elem of arrShops) {
			if(elem.length > 0) {
				arrElems = elem.split(',|,');
				
				let newOption = document.createElement('option');
				newOption.setAttribute('value', arrElems[0]);
				newOption.innerText = arrElems[1];
				
				selectShops.append(newOption);
			}
		}
	}
	
	function inputGoodName() {		
		let goodType = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#newGood_type').value;
		let goodBrand = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#newGood_brand').value;		
		let goodModel = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#newGood_model').value;
		
		let goodNameSpan = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.goodName .input');
		goodNameSpan.innerText = goodType + " " + goodBrand + " " + goodModel;
	}
	
	let goodType = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#newGood_type');
	let goodBrand = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#newGood_brand');	
	let goodModel = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#newGood_model');
	
	goodType.addEventListener('input', inputGoodName, false);
	goodBrand.addEventListener('input', inputGoodName, false);
	goodModel.addEventListener('input', inputGoodName, false);
	
	function clearTableForAddStockroom() {		
		let divGoodName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.goodName .input');
		divGoodName.innerHTML = '';
		
		let goodType = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody #newGood_type');
		goodType.value = '';
		
		let goodBrand = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody #newGood_brand');
		goodBrand.value = '';
		
		let goodModel = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody #newGood_model');
		goodModel.value = '';
	}
	
	function addNewGoodToDOM(id, url, goodType, goodBrand, goodModel) {		
		let newTr = document.createElement('tr');
		newTrStrHTML = "<td class=\"none\" data-id=\"" + id + "\" data-seller-fio data-shop-name data-is-included=\"0\" data-istrading=\"0\" data-status-of-trading \
							data-good-type=\"" + goodType + "\" data-good-brand=\"" + goodBrand + "\" data-good-model=\"" + goodModel + "\" data-good-photos data-good-description \
							data-good-url=\"" + url + "\" data-good-seller-price data-good-system-price data-good-quantity data-good-orderquantity data-good-instock data-good-length data-good-width data-good-height data-good-weight data-good-stockroom data-stockrooms data-good-articul data-good-categoryid data-good-category data-good-categories data-all-categories data-atributes data-disconts></td>\
							  <td class=\"image\"></td>\
							  <td class=\"name\">" + goodType + " " + goodBrand + " " + goodModel + "</td>\
							  <td>Статус включения:<br>выключён<br><br>Разрешение на продажу:<br>неодобрен</td>\
							  <td class=\"quantity\">\
							<span class=\"all_quantity\">Всего: шт.<span><br><br>\
							<span class=\"trade_quantity\">Продажа: от шт.<span>\
							</span></span></span></span></td>\
							<td class=\"price\">Цена продавца:<br><br>Цена Saterno:</td>";
		
		if(typeof(sellerJuridicName) == "undefined") {
			newTrStrHTML += "<td class=\"jur\"> Магазин:<br><br>Юр. лицо:<br><span class=\"jurName\"></span></td>";
		}
		
		newTrStrHTML += "<td class=\"categories\"></td>\
							<td class=\"date\"></td>\
							<td>\
								<div class=\"editGood\">\
									<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"version=&quot;1.1&quot;\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
										<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>\
									</svg><br>Редактировать\
								</div><div class=\"deleteGood\">\
									<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"version=&quot;1.1&quot;\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
										<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\"><path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"></path><path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path></g>\
									</svg><br>Удалить\
								<div>\
									</div></div></td>";
		
		newTr.innerHTML = newTrStrHTML;
		
		let tableStockroomsTbody = document.querySelector('.table_goods tbody');
		tableStockroomsTbody.append(newTr);
		
		newTr.querySelector('.editGood').addEventListener('click', actionGood, false);
		newTr.querySelector('.deleteGood').addEventListener('click', actionGood, false);
	}
	
	function afterSavingNewGood(id, url, goodType, goodBrand, goodModel) {
		addNewGoodToDOM(id, url, goodType, goodBrand, goodModel);
		clearTableForAddStockroom();		
		toggleModalBlock(0, 1);
	}
	
	function saveNewGoodPOST(arrayForNewStockroom) {
		console.log(arrayForNewStockroom);
		
		isFirstSaving = 0;
		
		let jurName = arrayForNewStockroom[0];		
		let shopId = arrayForNewStockroom[1];
		let goodType = arrayForNewStockroom[2];
		let goodBrand = arrayForNewStockroom[3];		
		
		String.prototype.translit = String.prototype.translit || function () {
		var Chars = {
			'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh', 'З': 'Z', 'И': 'I', 'Й': 'Y', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O', 'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C', 'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Shch', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu', 'Я': 'Ya', 'Ґ': 'G', 'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'I': 'I', 'Ў': 'Y', 'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh', 'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'shch', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya', 'ґ': 'g', 'є': 'ye', 'і': 'i', 'ї': 'yi', ' ': '_', 'i': 'i', 'ў': 'y'
		    },
			t = this;
			for (var i in Chars) { t = t.replace(new RegExp(i, 'g'), Chars[i]); }
			return t;
		};
		
		let brandUrl = goodBrand.translit().replace(/\W/g, '');
		let goodModel = arrayForNewStockroom[4];
		let goodUrl = (goodType.toLowerCase() + ' ' + goodBrand + ' ' + goodModel).replace(/\s+/g, ' ').trim().translit().replace(/\W/g, '');
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'App/Controllers/registerNewGood.php');

		xhr.addEventListener('readystatechange', function(e) {
			
			if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
				let responseArr = e.target.response.split('|');
				afterSavingNewGood(responseArr[0], responseArr[1], goodType, goodBrand, goodModel);
				isFirstSaving = 1;
				console.log(e.target.response);
			}
			else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
				let errorMessage = document.querySelector('.modalBlock.error.level2 .modalBody');
				errorMessage.innerHTML = "<p>Не удалось добавить новый товар.</p>";
				toggleModalBlock(4, 2);
				isFirstSaving = 1;
				console.log('Не удалось добавить нового продавца.');
				console.log(e.target.response);
			}
		});
		
        var fd = new FormData;
		fd.append("jurName", jurName);
		fd.append("shopId", shopId);
		fd.append("goodType", goodType);
		fd.append("goodBrand", goodBrand);
		fd.append("goodBrandUrl", brandUrl);
		fd.append("goodModel", goodModel);
		fd.append("goodUrl", goodUrl);
		xhr.send(fd);
	}
	
	function saveNewGood() {
		if(isFirstSaving == 0) {
			return false;
		}
		if(typeof(sellerJuridicName) == "undefined") {
			if(isCheckedShopJurName == 0) {
				let inputShopJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_jurName');
			
				isLaunchSaving = 1;
				
				let eventBlur = new Event("blur");
				inputShopJurName.dispatchEvent(eventBlur);
				
				return false;
			}
		}
		
		let isNormal = true;
		let errorField = "";
		
		let divJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name');
		let labelShopJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name label');
		
		let jurName;
		if(typeof(sellerJuridicName) == "undefined") {
			let jurNameInputed = divJurName.querySelector('.input #addNewSeller_jurName');
			
			if(jurNameInputed != null) {
				jurName = jurNameInputed.value;
				if(jurName == '') {
					isNormal = false;
					errorField += "<p>Введите юридическое название компании продавца.</p>";
				} else if(labelShopJurName.classList.contains('notAvailble')) {
					isNormal = false;
					errorField += "<p>Измените юридическое название компании продавца на доступное.</p>";
				}
			}
		} else {
			jurName = sellerJuridicName;
		}
		
		let shopId;
		let divShop = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div select#shopName option:checked');
		if(divShop == null) {
			isNormal = false;
			errorField += "<p>Введите юр. название продавца и выберите магазин.</p>";
		} else {
			shopId = divShop.getAttribute('value');
		}
		
		let goodType = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#newGood_type').value;
		if(goodType == '') {
			isNormal = false;
			errorField += "<p>Введите наименование товара.</p>";
		}
		
		let goodBrand = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#newGood_brand').value;
		if(goodBrand == '') {
			isNormal = false;
			errorField += "<p>Введите бренд товара.</p>";
		}
		
		let goodModel = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#newGood_model').value;
		if(goodModel == '') {
			isNormal = false;
			errorField += "<p>Введите модель товара.</p>";
		}
		
		if(!isNormal) {
			let errorMessage = document.querySelector('.modalBlock.error.level2 .modalBody');
			errorMessage.innerHTML = errorField;
			toggleModalBlock(4, 2);
		} else {
			saveNewGoodPOST([jurName, shopId, goodType, goodBrand, goodModel]);
		}
	}
	
	let buttonSaveAddingStockroom = document.querySelector('.modalBlock.addNewTable .modalHeader .save-new-table');
	buttonSaveAddingStockroom.addEventListener('click', saveNewGood, false);
}

addNewGood();
changeLeftMenuHeight();