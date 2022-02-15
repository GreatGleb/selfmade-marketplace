function addNewStockroom() {
	let isLaunchSaving = 0;
	let isFirstSaving = 1;
	
	let isCheckedShopJurName = 1;
	
	let editPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.phones > div .input');
	
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
		} else {
			this.classList.remove('active');
			this.parentNode.querySelector('.number label').classList.remove('active');
		}
	}
		
	function checkIsAvailableShopJurName() {
		let div = this.parentNode.parentNode;
		let label = div.querySelector('label');
		
		console.log(label);
		
		if(this.value.length > 0) {
			label.classList.remove('error');
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'App/Controllers/checkIsAvailableShopJurName.php');
			xhr.setRequestHeader( "Content-Type", "application/json" );

			xhr.addEventListener('readystatechange', function(e) {
				console.log(e.target.response);
				if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
					if(e.target.response == '1') {
						label.classList.remove('error');
						label.classList.remove('notAvailble');
					} else {							
						label.classList.add('error');
						label.classList.add('notAvailble');
						isNormal = false;
					}
					isCheckedShopJurName = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveNewStockroom();
					}
				}
				else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
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
	}
		
	function clearTableForAddStockroom() {
		let divPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.phones > div .input');
		
		divPhone.querySelector('.code input').value = '';
		divPhone.querySelector('.number input').value = '';
		
		if(typeof(sellerJuridicName) == "undefined") {
			let divJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name .input #addNewSeller_jurName');
			divJurName.value = '';
		}
		
		let divAddrPostIndex = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrIndex1');
		divAddrPostIndex.value = '';
		
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrCountry1 option[value="rus"]').selected = true;
		
		let divAddrRegion = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrRegion1');
		divAddrRegion.value = '';
		
		let divAddrCity = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrCity1');
		divAddrCity.value = '';
		
		let divAddrStreet = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrStreet1');
		divAddrStreet.value = '';
		
		let divAddrHome = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrHome1');
		divAddrHome.value = '';
		
		let divAddrOffice = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrOffice1');
		divAddrOffice.value = '';
	}
	
	function addNewStockroomToDOM(dataOfNewStock) {
		let data = dataOfNewStock.split(',');
		
		let sellerId = data[0];
		let fio = data[1];
		let stockId = data[2];
		
		let jurSelectedType =  data[3];
		let jurType =  data[4];
		
		let divPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.phones > div .input');
		let phone = "";
		let code = divPhone.querySelector('.code input').value;
		let number = divPhone.querySelector('.number input').value;
		
		if(code != "+" && number != "") {
			phone = code + number;
		}
		
		let jurName;
		if(typeof(sellerJuridicName) == "undefined") {
			let divJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name .input #addNewSeller_jurName');
			let jurName = divJurName.value;
		}
		
		let divAddrPostIndex = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrIndex1');
		let addrPostIndex = divAddrPostIndex.value;
		
		let divAddrCountry = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrCountry1 option:checked');
		let addrCountry = divAddrCountry.innerText;
		
		let divAddrRegion = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrRegion1');
		let addrRegion = divAddrRegion.value;
		
		let divAddrCity = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrCity1');
		let addrCity = divAddrCity.value;
		
		let divAddrStreet = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrStreet1');
		let addrStreet = divAddrStreet.value;
		
		let divAddrHome = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrHome1');
		let addrHome = divAddrHome.value;
		
		let divAddrOffice = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_stockAddrOffice1');
		let addrOffice = divAddrOffice.value;
		
		let newTr = document.createElement('tr');
		strHtmlNewTr = "<td class=\"none\" data-id=\"" + stockId + "\" data-phone=\"" + phone + "\"\
			data-seller-id=\"" + sellerId + "\" data-jur-selected-type=\"" + jurSelectedType + "\" data-jur-type=\"" + jurType + "\" data-jur-name=\"" + jurName + "\"\
			data-addr-office=\"" + addrOffice + "\" data-addr-post-index=\"" + addrPostIndex + "\"></td>";
		
		if(typeof(sellerJuridicName) == "undefined") {
			strHtmlNewTr += "<td class=\"full_name\">" + fio + "</td>";
		}
		
		strHtmlNewTr += "<td class=\"addressCountry\">" + addrCountry + "</td>\
			<td class=\"addressRegion\">" + addrRegion + "</td>\
			<td class=\"addressCity\">" + addrCity + "</td>\
			<td class=\"addressStreet\">" + addrStreet + "</td>\
			<td class=\"addressHome\">" + addrHome + "</td>\
			<td class=\"editStockroom\">\
			<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"version=&quot;1.1&quot;\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
				<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>\
			</svg><br>Редактировать</td>\
			<td class=\"deleteStockroom\">\
			<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"version=&quot;1.1&quot;\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
				<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\"><path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"></path><path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path></g>\
			</svg><br>Удалить</td>";
		
		newTr.innerHTML = strHtmlNewTr;
		
		let tableStockroomsTbody = document.querySelector('.table_stockrooms tbody');
		tableStockroomsTbody.append(newTr);
		
		newTr.querySelector('.editStockroom').addEventListener('click', actionStockroom, false);
		newTr.querySelector('.deleteStockroom').addEventListener('click', actionStockroom, false);
		changeLeftMenuHeight();
	}
	
	function afterSavingNewStockroom(dataOfNewStock) {
		addNewStockroomToDOM(dataOfNewStock);
		clearTableForAddStockroom();		
		toggleModalBlock(0, 1);
	}
	
	function saveNewStockroomPOST(arrayForNewStockroom) {
		console.log(arrayForNewStockroom);
		
		isFirstSaving = 0;
		
		let jurName = arrayForNewStockroom[0];		
		let stockIndex = arrayForNewStockroom[1];
		let stockCountry = arrayForNewStockroom[2];
		let stockRegion = arrayForNewStockroom[3];
		let stockCity = arrayForNewStockroom[4];
		let stockStreet = arrayForNewStockroom[5];
		let stockHome = arrayForNewStockroom[6];
		let stockOffice = arrayForNewStockroom[7];
		let phones = arrayForNewStockroom[8];
		
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'App/Controllers/registerNewStockroom.php');

		xhr.addEventListener('readystatechange', function(e) {
			
			if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
				afterSavingNewStockroom(e.target.response);
				isFirstSaving = 1;
				console.log(e.target.response);
			}
			else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
				let errorMessage = document.querySelector('.modalBlock.error.level2 .modalBody');
				errorMessage.innerHTML = "<p>Не удалось добавить нового продавца.</p>";
				toggleModalBlock(4, 2);
				isFirstSaving = 1;
				console.log('Не удалось добавить новый склад.');
			}
		});
		
        var fd = new FormData;
		fd.append("jurName", jurName);
		fd.append("stockIndex", stockIndex);
		fd.append("stockCountry", stockCountry);
		fd.append("stockRegion", stockRegion);
		fd.append("stockCity", stockCity);
		fd.append("stockStreet", stockStreet);
		fd.append("stockHome", stockHome);
		fd.append("stockOffice", stockOffice);
		fd.append("phones", phones);
		xhr.send(fd);
	}
	
	function saveNewStockroom() {
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
		
		let jurName;
		if(typeof(sellerJuridicName) == "undefined") {
			let divJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name');
			let labelShopJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name label');
			
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
		
		let stockIndex =  document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_stockAddrIndex1').value;
		let stockCountry = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div select#addNewSeller_stockAddrCountry1 option:checked').innerText;
		let stockRegion = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_stockAddrRegion1').value;
		if(stockIndex == '') {
			isNormal = false;
			errorField += "<p>Введите почтовый индекс для адреса нового склада.</p>";
		}
		if(stockRegion == '') {
			isNormal = false;
			errorField += "<p>Введите регион для адреса нового склада.</p>";
		}
		let stockCity = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_stockAddrCity1').value;
		if(stockCity == '') {
			isNormal = false;
			errorField += "<p>Введите город для адреса нового склада.</p>";
		}
		let stockStreet = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_stockAddrStreet1').value;
		if(stockStreet == '') {
			isNormal = false;
			errorField += "<p>Введите улицу для адреса нового склада.</p>";
		}
		let stockHome = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_stockAddrHome1').value;
		if(stockHome == '') {
			isNormal = false;
			errorField += "<p>Введите номер дома для адреса нового склада.</p>";
		}
		let stockOffice = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_stockAddrOffice1').value;
		
		let divPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.phones > div .input');
				
		let phones = "";
		let code = divPhone.querySelector('.code input').value;
		let number = divPhone.querySelector('.number input').value;
		let phone = code + number;
		if(code != "+" && number != "") {				
			phones = phone;
		}
		
		if(phones.length == 0) {
			isNormal = false;
			errorField += "<p>Введите номер контактного телефона.</p>";
		}
		
		if(!isNormal) {
			let errorMessage = document.querySelector('.modalBlock.error.level2 .modalBody');
			errorMessage.innerHTML = errorField;
			toggleModalBlock(2, 2);
		} else {
			saveNewStockroomPOST([jurName, stockIndex, stockCountry, stockRegion, stockCity, stockStreet, stockHome, stockOffice, phones]);
		}
	}
	
	let buttonSaveAddingStockroom = document.querySelector('.modalBlock.addNewTable .modalHeader .save-new-table');
	buttonSaveAddingStockroom.addEventListener('click', saveNewStockroom, false);
}

addNewStockroom();