let buttonSaveEditingGood = document.querySelector('.editing_good .header .save-good');
buttonSaveEditingGood.addEventListener('click', saveEditingGood, false);

let isFirstLaunchSaveGood = false;
let isCheckWarning = false;

function saveEditingGood() {
	let editing = mainContent.querySelector('.editing_good');
	
	if(isCheckedGoodURL == 0) {
		let inputGoodUrl = editing.querySelector('.input #good_url');
	
		isLaunchSaving = 1;
		
		let eventBlur = new Event("blur");
		inputGoodUrl.dispatchEvent(eventBlur);
		
		return false;
	}
	
	let goodId = editing.dataset.id;
	
	let isNormal = true;
	let errorField = "";
	
	let isFullCell = true;
	let warningField = "";
	
	let tdData = document.querySelector('.table_goods tbody tr td:first-child[data-id="' + goodId + '"]');
	
	let fieldAtributes = editing.querySelectorAll('.editAtributes .input .atribut');
	
	let atributesType = [];
	let atributesValue = [];
	let atributesImg = [];
	
	let atributesClearType = [];
	let atributesClearValue = [];
	let atributesClearImg = [];
	
	for(let i = 0; i < fieldAtributes.length; i++) {
		let values = [];
		let valuesImg = [];
		
		let atributType = fieldAtributes[i].querySelector('input').value;
		let atributFirstValue = fieldAtributes[i].querySelector('.values input').value;
		let atributFirstImage = fieldAtributes[i].querySelector('div.container .notAddingIcon img');
		
		atributesType.push(atributType);
		values.push(atributFirstValue);
		if(atributFirstImage == null) {
			atributFirstImage = '';
		} else {
			atributFirstImage = atributFirstImage.getAttribute('src').replace(/_150x150(?!.*_150x150)/,'');
			//console.log(0);
			//console.log(atributFirstImage);
		}
		valuesImg.push(atributFirstImage);
		
		let divValues =  fieldAtributes[i].querySelectorAll('.values > div');
		
		let checkInput = fieldAtributes[i].querySelectorAll('.values > input');
				
		for(let j = 0; j < divValues.length; j++) {
			let valuesType = divValues[j].querySelector('input').value;
			values.push(valuesType);
			
			let img = divValues[j].querySelector('.notAddingIcon img');
			if(img != undefined) {
				let src = img.getAttribute('src').replace(/_150x150(?!.*_150x150)/,'');
				
				valuesImg.push(src);
				//console.log(j);
				//console.log(src);
			} else {
				valuesImg.push('');
			}
		}
		console.log(valuesImg);
		atributesValue.push(values);
		atributesImg.push(valuesImg);
	}
	
	for(let i = 0; i < atributesValue.length; i++) {
		let arrayAtributValue = atributesValue[i];
		let arrayAtributImg = atributesImg[i];
		
		let newAtributeType;
		let newArrayAtributValue = [];
		let newAtributImg = [];
		
		if(atributesType[i].length > 0) {
			for(let j = 0; j < arrayAtributValue.length; j++) {
				if(arrayAtributValue[j].length > 0) {
					newArrayAtributValue.push(arrayAtributValue[j]);
					
					if(arrayAtributImg[j].length > 0) {
						newAtributImg.push(arrayAtributImg[j]);
						//console.log(j);
						//console.log(arrayAtributImg);
					} else {
						newAtributImg.push('');
					}
				} else if(arrayAtributImg[j].length > 0) {
					newArrayAtributValue.push('');
					newAtributImg.push(arrayAtributImg[j]);
					//console.log(j);
					//console.log(arrayAtributImg);
				}
			}
			
			newAtributeType = atributesType[i];
			
			atributesClearType.push(newAtributeType.replace(/[,][|][,]/g, ''));
			atributesClearValue.push(newArrayAtributValue);
			atributesClearImg.push(newAtributImg);
		}
	}
	
	for(let i = 0; i < atributesClearValue.length; i++) {
		let arrayAtributValue = atributesClearValue[i];
		let arrayAtributImg = atributesClearImg[i];
		
		let isThereValues = false;
		
		for(let elem of arrayAtributValue) {
			if (elem.length > 0) {
				isThereValues = true;
			}				
		}
		
		let isThereImg = false;
		
		for(let elem of arrayAtributImg) {
			if (elem.length > 0) {
				isThereImg = true;
			}				
		}
		
		if(isThereValues) {
			for(let elem of arrayAtributValue) {
				if (elem.length < 1) {
					isNormal = false;
					errorField += "<p>В полях атрибута товара в случаях, когда одно из значений какого-то атрибута заполнено, должны быть также заполнеными все остальные значения этого атрибута.</p>";
				}
			}
		}
		if(isThereImg) {
			for(let elem of arrayAtributImg) {
				if (elem.length < 1) {
					isNormal = false;
					errorField += "<p>В полях атрибута товара в случаях, когда в одном из значений какого-то атрибута загружена иконка, должны быть также с загруженой иконкой все остальные значения этого атрибута.</p>";
				}
			}
		}
	}
	
	let strAtributesData = "";
	
	for(let i = 0; i < atributesClearType.length; i++) {
		strAtributesData += atributesClearType[i];
		
		for(let j = 0; j < atributesClearValue[i].length; j++) {
			let img = atributesClearImg[i][j];
			if(img !== undefined && img.length > 0) {
				img = img.substring(43);
			} else {
				img = "";
			}
			
			let value = atributesClearValue[i][j];
			if(value == undefined) {
				value = "";
			}
			
			strAtributesData += ",!," + value + ",!," + img;
		}
		strAtributesData += "]]]";
	}
	
	let strAtributesClearType = "";
	let strAtributesClearValue = "";
	let strAtributesClearImg = "";
	
	strAtributesClearType = atributesClearType.join(',|,');
	
	strAtributesClearType = strAtributesClearType.replace(/"/g, '&#34;');
	
	for(let elem of atributesClearValue) {
		let str = '';
		for(let el of elem ) {
			str += el.replace(/[,][|][,]/g, '') + ',|,';
		}
		
		strAtributesClearValue += '[[[';
		strAtributesClearValue += str.replace(/\[\[\[/g, '');
		strAtributesClearValue += ']]]';
	}
	
	for(let elem of atributesClearImg) {
		let str = '';
		for(let el of elem ) {
			str += el.replace(/[,][|][,]/g, '') + ',|,';
		}
		
		strAtributesClearImg += '[[[';
		strAtributesClearImg += str.replace(/\[\[\[/g, '');;
		strAtributesClearImg += ']]]';
	}
	
	let allDisconts = document.querySelectorAll('.editDisconts .input .discont');
	let strDiscont = "";
	
	const months = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
	
	let dateNow = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
	//console.log(dateNow);
	
	for(let el of allDisconts) {
		let newPrice = el.querySelector('input').value;		
		let dateFirst = el.querySelector('.date.first span.text').innerText
		
		if(newPrice.length > 0 && dateFirst.length > 0) {
			dateFirst = dateFirst.split(' ');
			let dateFirstDay = dateFirst[0];
			let dateFirstMonth = months.indexOf(dateFirst[1]);
			let dateFirstYear = dateFirst[2];
			
			dateFirst = new Date(dateFirstYear, dateFirstMonth, dateFirstDay);
		
			//console.log(dateFirst);
		
			let dateSecond = el.querySelector('.date.second span.text').innerText;
		
			if(dateSecond.length > 0) {
				dateSecond = dateSecond.split(' ');
				
				let dateSecondDay = dateSecond[0];
				let dateSecondMonth = months.indexOf(dateSecond[1]);
				let dateSecondYear = dateSecond[2];
				
				dateSecond = new Date(dateSecondYear, dateSecondMonth, dateSecondDay);
				
				dateFirstMonth = Number(dateFirstMonth) + 1;
				dateSecondMonth = Number(dateSecondMonth) + 1;
				
				strDiscont += newPrice + ',|,' + dateFirstYear + '-' + dateFirstMonth + '-' + dateFirstDay;
				strDiscont += ',|,' + dateSecondYear + '-' + dateSecondMonth + '-' + dateSecondDay;
				strDiscont += ']]]';
				
				if(dateFirst < dateNow) {
					isNormal = false;
					errorField += "<p>Дата начала акции не должна быть раньше сегодняшнего дня.</p>";
				}
				if(dateFirst > dateSecond) {
					isNormal = false;
					errorField += "<p>Дата начала акции не должна быть позже даты конца акции.</p>";
				}
			}
		}
	}
	
	let editGoodName = editing.querySelector('.input #good_type').value;
	
	if(editGoodName.length < 1) {
		isNormal = false;
		errorField += "<p>Введите наименование товара.</p>";
	}
	
	let editGoodBrand = editing.querySelector('.input #good_brand').value;
	
	if(editGoodBrand.length < 1) {
		isNormal = false;
		errorField += "<p>Введите бренд товара.</p>";
	}
	
	let editGoodModel = editing.querySelector('.input #good_model').value;
	
	if(editGoodModel.length < 1) {
		isNormal = false;
		errorField += "<p>Введите модель товара.</p>";
	}
	
	let editGoodDescription = editing.querySelector('.input #good_description').value;
	
	if(editGoodDescription.length < 4) {
		isNormal = false;
		errorField += "<p>Описание товара должно быть не меньше 4-х символов.</p>";
	}
	
	let editGoodURL = editing.querySelector('.input #good_url');
	
	let editGoodURLvalue = editGoodURL.value;
	let labelGoodURL = editing.querySelector('label[for="good_url"]');
	
	if(labelGoodURL.classList.contains('notAvailble')) {
		isNormal = false;
		errorField += "<p>Измените URL товара на доступный.</p>";
	}
	
	let editSellerPrice = editing.querySelector('.input #good_seller_price').value;
	let editSystemPrice = editing.querySelector('.editPrice .input .good_system_price').innerText;
	
	if(editSellerPrice.length < 1) {
		isNormal = false;
		errorField += "<p>Введите цену товара.</p>";
	}	
	
	let editGoodLength = editing.querySelector('.input #good_length').value;
	
	if(editGoodLength.length < 1) {
		if(!isCheckWarning) {
			isFullCell = false;
			warningField += "<p>Не заполнено поле с длиной товара.</p>";
		}
	}
	
	let editGoodWidth = editing.querySelector('.input #good_width').value;
	
	if(editGoodWidth.length < 1) {
		if(!isCheckWarning) {
			isFullCell = false;
			warningField += "<p>Не заполнено поле с шириной товара.</p>";
		}
	}
	
	let editGoodHeight = editing.querySelector('.input #good_height').value;
	
	if(editGoodHeight.length < 1) {
		if(!isCheckWarning) {
			isFullCell = false;
			warningField += "<p>Не заполнено поле с высотой товара.</p>";
		}
	}
	
	let editGoodWeight = editing.querySelector('.input #good_weight').value;
	
	if(editGoodWeight.length < 1) {
		console.log(isCheckWarning);
		if(!isCheckWarning) {
			isFullCell = false;
			warningField += "<p>Не заполнено поле с весом товара.</p>";
		}
	}
	
	let editQuantityGood = editing.querySelector('.input #good_all_quentity').value;
	
	if(editQuantityGood.length < 1) {
		isNormal = false;
		errorField += "<p>Введите количество всего товара.</p>";
	}	
	
	let editTradeQuantityGood = editing.querySelector('.input #good_sold_quentity').value;
	
	if(editTradeQuantityGood.length < 1) {
		isNormal = false;
		errorField += "<p>Введите минимальное количество товара для продажи.</p>";
	}
	
	let isInStock = editing.querySelector('.editInStock .input .isShow').innerText;
	if(isInStock == 'Есть в наличии' && isCheckWarning !== true) {
		isInStock = 1;
	} else {
		isInStock = 0;
	}
	
	let stock = '';
	let stockId = '';
	let optionStock = editing.querySelector('.editStock select option:checked');
	
	if(optionStock == null) {		
		if(!isCheckWarning) {
			isFullCell = false;
			warningField += "<p>Добавьте для продавца склад, а затем отредактируйте и сохраните  товар с выбраным складом.</p>";
		}
	} else {
		stock = optionStock.innerText;
		stockId = optionStock.value;
	}
	
	let editArticulGood = editing.querySelector('.input #good_articul').value;
	
	let divMainCategory = editing.querySelector('.editCategories .input .main_category');
	let spanCategory = divMainCategory.querySelector('span');
	let mainCategoryId;
	let mainCategory;
	
	if(spanCategory != null) {
		mainCategory = spanCategory.innerText;
		mainCategoryId = spanCategory.getAttribute('value');
	} else {
		mainCategory = divMainCategory.querySelector('select option:checked').innerText;
		mainCategoryId = divMainCategory.querySelector('select option:checked').getAttribute('value');
	}
	
	let liCategories = editing.querySelectorAll('.editCategories .input ul li');
	let categoriesId = [];
	let strFullCategories = "";
	
	for(let elem of liCategories) {
		let spanCategory = elem.querySelector('span');
		if(spanCategory != null) {
			categoriesId.push(spanCategory.getAttribute('value'));
			strFullCategories += spanCategory.value + ',' + spanCategory.innerText + '|';
		} else {
			let selectedOption = elem.querySelector('select option:checked');
			categoriesId.push(selectedOption.getAttribute('value'));
			strFullCategories += selectedOption.value + ',' + selectedOption.innerText + '|';
		}
	}
	
	let strCategories = categoriesId.join('|');
	
	let isTrading;
	let statusOfTrading;
	let isIncluded;
	
	if(typeof(sellerJuridicName) == "undefined") {
		isTrading = editing.querySelector('.editIsTrading .input .isShow').innerText;
		if(isTrading == 'Включено') {
			isTrading = 1;
		} else {
			isTrading = 0;
		}
		
		statusOfTrading = editing.querySelector('#seller_statusOfTrading').value;
	}
	
	isIncluded = editing.querySelector('.editIsIncluded .input .isShow').innerText;
	if(isIncluded == 'Включено') {
		isIncluded = 1;
	} else {
		isIncluded = 0;
	}

	if(!isNormal) {
		let errorMessage = document.querySelector('.modalBlock.error .modalBody');
		errorMessage.innerHTML = errorField;
		toggleModalBlock(3, 1);
	} else if(!isFullCell) {		
		warningField += "<p>При сохранении с данным незаполненым полем, поле \"Наличие\" будет зафиксированно как \"Нет в наличии\".\
							Для изменении поля \"Наличие\" сначала заполните необходимые поля для возможности доставки товара.</p>\
							<p>Сохранить товар?</p>";
							
		let errorMessage = document.querySelector('.modalBlock.error.warning .modalBody > div:not([class])');		
		errorMessage.innerHTML = warningField;
					
		function beforeSaveGood() {
			isCheckWarning = true;
			saveEditingGood();
			
			let buttonForInputUrl = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');
			buttonForInputUrl.removeEventListener('click', beforeSaveGood);
		}
			
		let buttonForInputUrl = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');
		buttonForInputUrl.addEventListener('click', beforeSaveGood, false);
			
		toggleModalBlock(6, 1);
	} else {
		tdData.dataset.goodType = editGoodName;
		tdData.dataset.goodModel = editGoodModel;
		tdData.dataset.goodBrand = editGoodBrand;
		
		tdData.dataset.goodUrl = editGoodURLvalue;
		tdData.dataset.goodSellerPrice = editSellerPrice;
		tdData.dataset.goodSystemPrice = editSystemPrice;
		
		tdData.dataset.goodQuantity = editQuantityGood;
		tdData.dataset.goodOrderquantity = editTradeQuantityGood;
		tdData.dataset.goodInstock = isInStock;
		
		tdData.dataset.goodLength = editGoodLength;
		tdData.dataset.goodWidth = editGoodWidth;
		tdData.dataset.goodHeight = editGoodHeight;
		tdData.dataset.goodWeight = editGoodWeight;
		
		tdData.dataset.goodStockroom = stockId;
		
		tdData.dataset.isIncluded = isIncluded;
		
		if(typeof(sellerJuridicName) == "undefined") {
			tdData.dataset.istrading = isTrading;
			tdData.dataset.statusOfTrading = statusOfTrading;
		}
		
		tdData.dataset.goodArticul = editArticulGood;		
		
		tdData.dataset.goodCategoryid = mainCategoryId;
		tdData.dataset.goodCategory = mainCategory;
		tdData.dataset.goodCategories = strFullCategories;
		
		tdData.dataset.atributes = strAtributesData;
		tdData.dataset.disconts = strDiscont;
		
		String.prototype.translit = String.prototype.translit || function () {
		var Chars = {
			'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh', 'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'shch', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya', 'ґ': 'g', 'є': 'ye', 'і': 'i', 'ї': 'yi', ' ': '', 'i': 'i', 'ў': 'y'
		    },
			t = this;
			for (var i in Chars) { t = t.replace(new RegExp(i, 'g'), Chars[i]); }
			return t;
		};
		
		let brandUrl = editGoodBrand.toLowerCase().translit().replace(/\W/g, '');		
		
		saveEditingGoodPOST(goodId, editGoodName, editGoodBrand, brandUrl, editGoodModel,
			editGoodDescription, editGoodURLvalue, editSellerPrice, editGoodLength, editGoodWidth, editGoodHeight, editGoodWeight,
			editQuantityGood, editTradeQuantityGood, isInStock, stockId, editArticulGood, mainCategoryId,
			strCategories, isTrading, statusOfTrading, isIncluded, strAtributesClearType, strAtributesClearValue, strAtributesClearImg, strDiscont);
	}
}

function saveEditingGoodPOST(goodId, editGoodName, editGoodBrand, brandUrl, editGoodModel,
			editGoodDescription, editGoodURLvalue, editSellerPrice, editGoodLength, editGoodWidth, editGoodHeight, editGoodWeight,
			editQuantityGood, editTradeQuantityGood, isInStock, stockId, editArticulGood, mainCategoryId, strCategories,
			isTrading, statusOfTrading, isIncluded, strAtributesClearType, strAtributesClearValue, strAtributesClearImg, strDiscont) {
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/saveEditingGood.php');

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
			let tr = document.querySelector('.table_goods tbody tr td:first-child[data-id="' + goodId + '"]').parentNode;
			
			tr.querySelector('td.name').innerText = editGoodName + " " + editGoodBrand + " " + editGoodModel;
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось изменить категорию.');
		}
	});
	
	var fd = new FormData;
	fd.append("goodId", goodId);
	fd.append("goodName", editGoodName);
	fd.append("goodBrand", editGoodBrand);
	fd.append("goodBrandUrl", brandUrl);
	fd.append("goodModel", editGoodModel);
	fd.append("goodDescription", editGoodDescription);
	fd.append("goodURL", editGoodURLvalue);
	fd.append("sellerPrice", editSellerPrice);
	fd.append("goodLength", editGoodLength);
	fd.append("goodWidth", editGoodWidth);
	fd.append("goodHeight", editGoodHeight);
	fd.append("goodWeight", editGoodWeight);
	fd.append("quantityGood", editQuantityGood);
	fd.append("tradeQuantityGood", editTradeQuantityGood);
	fd.append("isInStock", isInStock);
	fd.append("stockId", stockId);
	fd.append("articulGood", editArticulGood);
	fd.append("mainCategoryId", mainCategoryId);
	fd.append("strCategories", strCategories);
	fd.append("isTrading", isTrading);
	fd.append("statusOfTrading", statusOfTrading);
	fd.append("isIncluded", isIncluded);
	fd.append("typeAtribut", strAtributesClearType);
	fd.append("valuesAtribut", strAtributesClearValue);
	fd.append("imagesAtribut", strAtributesClearImg);
	fd.append("disconts", strDiscont);
	xhr.send(fd);
}