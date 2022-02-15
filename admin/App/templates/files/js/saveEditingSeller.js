let buttonSaveEditingSeller = document.querySelector('.editing_seller .header .save-seller');
buttonSaveEditingSeller.addEventListener('click', saveEditingSeller, false);

function saveEditingSeller() {
	let editing = mainContent.querySelector('.editing_seller');
	let id = editing.dataset.id;
	let userId = editing.dataset.userid;
	let isNormal = true;
	let errorField = "";
	
	let tdData = document.querySelector('.table_sellers tbody tr td:first-child[data-id="' + id + '"]');
	
	let img = document.querySelector('.editing_seller .editPhoto img');
	let imgUrlPath;
	let imgName
	let imgUrl;
	
	if(img !== undefined && img !== null) {
		imgUrl = img.getAttribute("src");
		let indOfSlesh = imgUrl.lastIndexOf('/');
		
		imgUrlPath = imgUrl.slice(0, indOfSlesh+1);
		imgName = imgUrl.slice(indOfSlesh+1);
		
		tdData.dataset.imgUrl = imgUrlPath;
		tdData.dataset.imgName = imgName;
	} else {
		imgUrlPath = "NULL";
		imgName = "NULL";
	}
	
	let checkedEntityType = editing.querySelector('.editEntity input:checked');
	if(checkedEntityType != null) {
		let inputEntityType = checkedEntityType.parentNode;
		let checkedSelectedEntityType = inputEntityType.querySelector('select option:checked');
		let checkedInputEntityType = inputEntityType.querySelector('#seller_entityType');
		
		if(checkedSelectedEntityType !== null) {
			if(checkedEntityType.parentNode.querySelector('option:checked').innerText == "") {
				isNormal = false;
				errorField = "<p>Выберите форму собственности.</p>";
			} else {
				tdData.dataset.jurSelectedType = checkedSelectedEntityType.innerText;
				tdData.dataset.jurType = "";
			}
		} else if(checkedInputEntityType !== null) {
			tdData.dataset.jurType = checkedInputEntityType.value;
			tdData.dataset.jurSelectedType = "";
		}
	} else {
		isNormal = false;
		errorField = "<p>Выберите форму собственности.</p>";
	}
	
	let jurType = tdData.dataset.jurType, 
	jurSelectedType = tdData.dataset.jurSelectedType;
	
	if(tdData.dataset.jurType == "") {
		jurType = "NULL";
	}
	if(tdData.dataset.jurSelectedType == "") {
		jurSelectedType = "NULL";
	}
	
	let jurNameInputed = editing.querySelector('.editJurName .input #seller_jurName');
	let jurNameSelected = editing.querySelector('.editJurName .input');
	let jurName;
	if(jurNameInputed != null) {
		jurName = jurNameInputed.value;
	} else {
		jurName = jurNameSelected.innerText;
	}
	
	if(jurName == '') {
		isNormal = false;
		errorField += "<p>Введите юридическое название компании продавца.</p>";
	} else {
		tdData.dataset.jurName = jurName;
	}
	
	let bank = editing.querySelector('.editBank .input #seller_bank').value;
	tdData.dataset.bank = bank;
	
	let currAccNum = editing.querySelector('.editCurAccNum .input #seller_currentAccountNumber').value;
	tdData.dataset.currAccNum = currAccNum;
	
	let corAccNum = editing.querySelector('.editCorAccNum .input #seller_cortAccountNumber').value;
	tdData.dataset.corAccNum = corAccNum;
	
	let bik = editing.querySelector('.editBIK .input #seller_BIK').value;
	tdData.dataset.bik = bik;
	
	let inn = editing.querySelector('.editINN .input #seller_INN').value;
	tdData.dataset.inn = inn;
	
	let arrJurAddr = tdData.dataset.jurAdd;
	
	arrJurAddr = arrJurAddr.replace(", ']", "");
	arrJurAddr = arrJurAddr.replace(/'/g, "");
	arrJurAddr = arrJurAddr.replace("[", "");
	arrJurAddr = arrJurAddr.split(', ');
	
	let mapArrJurAddr = new Map();
	
	for(let addr of arrJurAddr) {
		let propVal = addr.split(' = ');
		mapArrJurAddr.set(propVal[0], propVal[1]);   
	}
	
	let jurCountry = editing.querySelector('select#seller_jurAddrCountry option:checked').innerText;
	let jurRegion = editing.querySelector('.address-list #seller_jurAddrRegion').value;
	let jurCity = editing.querySelector('.address-list #seller_jurAddrCity').value;
	let jurStreet = editing.querySelector('.address-list #seller_jurAddrStreet').value;
	let jurHome = editing.querySelector('.address-list #seller_jurAddrHome').value;
	let jurOffice = editing.querySelector('.address-list #seller_jurAddrOffice').value;
	let jurIndex = editing.querySelector('.address-list #seller_jurAddrIndex').value;
	
	let jurAddr = "['id' = '" + mapArrJurAddr.get('id') + "', 'country' = '" + jurCountry + "', region' = '" + jurRegion + "', 'city' = '" + jurCity;
	jurAddr += "', 'street' = '" + jurStreet + "', 'home' = '" + jurHome + "', 'office = '" + jurOffice;
	jurAddr += "', 'postIndex' = '" + jurIndex + "', ']";
	
	if(jurRegion == '') {
		isNormal = false;
		errorField += "<p>Введите регион юридического адреса.</p>";
	} else if(jurCity == '') {
		isNormal = false;
		errorField += "<p>Введите город юридического адреса.</p>";
	} else if(jurStreet == '') {
		isNormal = false;
		errorField += "<p>Введите улицу юридического адреса.</p>";
	} else if(jurHome == '') {
		isNormal = false;
		errorField += "<p>Введите номер дома юридического адреса.</p>";
	} else {
		tdData.dataset.jurAdd = jurAddr;
	}
	
	let arrFactAddr = tdData.dataset.factAdd;
	
	arrFactAddr = arrFactAddr.replace(", ']", "");
	arrFactAddr = arrFactAddr.replace(/'/g, "");
	arrFactAddr = arrFactAddr.replace("[", "");
	arrFactAddr = arrFactAddr.split(', ');
	
	let mapArrFactAddr = new Map();
	
	for(let addr of arrFactAddr) {
		let propVal = addr.split(' = ');
		mapArrFactAddr.set(propVal[0], propVal[1]);   
	}
	
	let factCountry = editing.querySelector('select#seller_factAddrCountry option:checked').innerText;
	let factRegion = editing.querySelector('.address-list #seller_factAddrRegion').value;
	let factCity = editing.querySelector('.address-list #seller_factAddrCity').value;
	let factStreet = editing.querySelector('.address-list #seller_factAddrStreet').value;
	let factHome = editing.querySelector('.address-list #seller_factAddrHome').value;
	let factOffice = editing.querySelector('.address-list #seller_factAddrOffice').value;
	let factIndex = editing.querySelector('.address-list #seller_factAddrIndex').value;
	
	let factAddr = "['id' = '" + mapArrFactAddr.get('id') + "', 'country' = '" + factCountry + "', region' = '" + factRegion + "', 'city' = '" + factCity;
	factAddr += "', 'street' = '" + factStreet + "', 'home' = '" + factHome + "', 'office' = '" + factOffice;
	factAddr += "', 'postIndex' = '" + factIndex + "', ']";
	
	if(factRegion == '') {
		isNormal = false;
		errorField += "<p>Введите регион фактического адреса.</p>";
	} else if(factCity == '') {
		isNormal = false;
		errorField += "<p>Введите город фактического адреса.</p>";
	} else if(factStreet == '') {
		isNormal = false;
		errorField += "<p>Введите улицу фактического адреса.</p>";
	} else if(factHome == '') {
		isNormal = false;
		errorField += "<p>Введите номер дома фактического адреса.</p>";
	} else {
		tdData.dataset.factAdd = factAddr;
	}
	
	let isTrading = editing.querySelector('.editIsTrading .input .isShow').innerText;
	if(isTrading == 'Включено') {
		isTrading = 1;
	} else {
		isTrading = 0;
	}	
	tdData.dataset.istrading = isTrading;
	
	let statusOfTrading = editing.querySelector('#seller_statusOfTrading').value;
	tdData.dataset.statusOfTrading = statusOfTrading;
	
	let isIncluded = editing.querySelector('.editIsIncluded .input .isShow').innerText;
	if(isIncluded == 'Включено') {
		isIncluded = 1;
	} else {
		isIncluded = 0;
	}	
	tdData.dataset.isIncluded = isIncluded;
	
	let bankCode = editing.querySelector('#seller_bankCode').value;
	tdData.dataset.bankCode = bankCode;
	
	if(!isNormal) {
		let errorMessage = document.querySelector('.modalBlock.error .modalBody');
		errorMessage.innerHTML = errorField;
		toggleModalBlock(2, 1);
	} else {
		saveEditingSellerPOST(id, userId, imgUrlPath, imgName, jurSelectedType, jurType, jurName,
								bank, currAccNum, corAccNum, bik, inn, 
								jurIndex, jurCountry, jurRegion, jurCity, jurStreet, jurHome, jurOffice,
								factIndex, factCountry, factRegion, factCity, factStreet, factHome, factOffice,
								isTrading, statusOfTrading, isIncluded, bankCode);
	}
}

function saveEditingSellerPOST(sellerId, userId, imgUrl, imgName, jurSelectedType, jurInputType, jurName,
								bank, currAccNum, corAccNum, bik, inn,
								jurAddrIndex, jurAddrCountry, jurAddrRegion, jurAddrCity, jurAddrStreet, jurAddrHome, jurAddrOffice,
								factAddrIndex, factAddrCountry, factAddrRegion, factAddrCity, factAddrStreet, factAddrHome, factAddrOffice,
								isTrading, statusOfTrading, isIncluded, bankCode) {							
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/saveEditingSeller.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось изменить категорию.');
		}
	});
	bank = bank.replace(/"/g, '\\"');
	
	xhr.send('["' + sellerId + '", "' +userId + '", "' +imgUrl + '", "' + imgName + '", "' + jurSelectedType + 
	'", "' + jurInputType + '", "' + jurName + '", "' + bank + '", "' + currAccNum + '", "' + corAccNum + '", "' + bik + '", "' + inn + 
	'", "' + jurAddrIndex + '", "' + jurAddrCountry + '", "' + jurAddrRegion + '", "' + jurAddrCity + '", "' + jurAddrStreet + '", "' + jurAddrHome + '", "' + jurAddrOffice +
	'", "' + factAddrIndex + '", "' + factAddrCountry + '", "' + factAddrRegion + '", "' + factAddrCity + '", "' + factAddrStreet + '", "' + factAddrHome + '", "' + factAddrOffice +
	'", "' + isTrading+ '", "' + statusOfTrading + '", "' + isIncluded + '", "' + bankCode + '"]');
}