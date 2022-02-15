let editSeller = document.querySelectorAll('.table_sellers tbody .editSeller');

let mainContent = document.querySelector('.mainHtmlContent');

for(let seller of editSeller) {
	seller.addEventListener('click', actionSeller, false);
}

let deleteSeller = document.querySelectorAll('.table_sellers tbody .deleteSeller');

for(let seller of deleteSeller) {
	seller.addEventListener('click', actionSeller, false);
}

let deletingSellerId;
let deletingSellerTd;
let clickDeletingSeller = 0;

function actionSeller() {
	let td = event.path[0];
	if(event.path[0].className == "editSeller") {
		editingSeller(td);
		
		let buttonReplyEditingSeller = mainContent.querySelector('.editing_seller .header .reply-seller');
		buttonReplyEditingSeller.addEventListener('click', function() {
			editingSeller(td);
		}, false);
	} else if(event.path[0].className == "deleteSeller") {
		let fio = event.path[1].querySelector('.full_name').innerText;
		deletingSellerId = event.path[1].querySelector('td.none').dataset.id;
		deletingSellerTd = event.path[1];
		
		let errorMessage = document.querySelector('.modalBlock.error.warning .modalBody > div:not([class])');
		errorMessage.innerHTML = "<p>Вы действительно хотите удалить учётную запись продавца " + fio +"?</p>";
		errorMessage.innerHTML += "<p>При удалении учётной записи продавца также удаляться все магазины и товары, которые закреплены за этой учётной записью.</p>";
		toggleModalBlock(6, 1);
	}
}

function editingSeller(td) {
	let headerMenu = document.querySelector('div.admin-block-top');
	headerMenu.scrollIntoView();
	
	let tr = td.parentNode;

	let tdData = tr.querySelector('td.none');
	
	let phones = tdData.dataset.phones.replace(", ']", "");
	phones = phones.replace("[", "");
	phones = phones.replace(/'/g, "");
	phones = phones.split(', ');
	
	let jurSelectedType = tdData.dataset.jurSelectedType;
	let jurType = tdData.dataset.jurType;
	
	let editing = mainContent.querySelector('.editing_seller');
	
	editing.dataset.id = tdData.dataset.id;
	editing.dataset.userid = tdData.dataset.userid;
	
	let editFio = editing.querySelector('.editFio .input');
	let fio = tr.querySelector('td.full_name').innerText;
	editFio.innerText = fio;
	
	let editEmail = editing.querySelector('.editMail .input');
	let email = tr.querySelector('td.email').innerText;
	editEmail.innerText = email;	
	
	let imgUrl = tdData.dataset.imgUrl;
	let imgName = tdData.dataset.imgName;
		
	let fieldPhoto = editing.querySelector('.editPhoto');
	let editPhoto = fieldPhoto.querySelector('.input');
	let editPhotoImg = editPhoto.querySelector('img');
	
	if(imgName !== undefined) {
			
		let img = document.createElement('img');
		img.src = imgUrl + imgName;
		img.style.width = "50px";
		img.style.height = "50px";
		if(editPhotoImg == undefined) {
			editPhoto.innerHTML = "";
			editPhoto.append(img);
			editPhoto.innerHTML += "<svg class=\"toggleModal1\" width=\"20px\" height=\"20px\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
									<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>\
								  </svg>";
		}
	} else {
		editPhoto.innerHTML = "<svg class=\"toggleModal1\" width=\"20px\" height=\"20px\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
									<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>\
								  </svg>";
	}
	
	editPhoto.querySelector('svg').addEventListener('click', openImagesPopUp);
	
	function openImagesPopUp() {
		event.stopImmediatePropagation();
		let imgUrl = tdData.dataset.imgUrl;
		let imgName = tdData.dataset.imgName;
		console.log(imgUrl)
		console.log(imgName)
		if(imgName !== undefined) {
			imgName = imgName.replace(/_150x150(?!.*_150x150)/,'');
			let imgPopUp = document.querySelector('.modalBlock .windowAllImages .imageCart .hoverForSelect img[data-filename=\'' + imgName + '\']');
			if(imgPopUp !== null) {
				imgPopUp.parentNode.classList.remove('notSelect');
				imgPopUp.parentNode.classList.add('select');
				let imageCart = imgPopUp.parentNode.parentNode;
				imageCart.parentNode.prepend(imageCart);
			}
		}
		launchImagesPopUp();
		toggleModalBlock(1, 1);
	}
	
	let fieldPhone = editing.querySelector('.editPhone');
	let editPhone = fieldPhone.querySelector('.input');
	
	let newPhoneDiv = editPhone.querySelector('div');
	editPhone.innerHTML = "";
	
	for(let phone of phones) {
		let newPhone = document.createElement('div');
		newPhone.className = 'phones';
		newPhone.innerText = phone;
		editPhone.append(newPhone);
	}
	
	let jurName = tdData.dataset.jurName;
	
	let editJurName = editing.querySelector('.editJurName .input');
	if(jurSelectedType == 'ИП') {
		editJurName.innerHTML = jurName;
	} else {
		editJurName.innerHTML = "<input type=\"text\" id=\"seller_jurName\" value=\"" + jurName + "\">";
	}
	
	let fieldEntity = editing.querySelector('.editEntity');
	let editEntity = editing.querySelector('.editEntity .input');
	let entityTypeInput = editEntity.querySelector('#seller_entityType');
	let newEntitySelect = fieldEntity.querySelector('select');
	
	if(newEntitySelect == undefined) {
		let newSelect = document.createElement('select');
		newSelect.id = 'entityTypesSelect';
		
		let newOpinion = document.createElement('option');
		newOpinion.value = "";
		newOpinion.innerText = "";
		newSelect.append(newOpinion);
		
		for(let type of entityTypes) {
			let newOpinion = document.createElement('option');
			newOpinion.value = type[0];
			newOpinion.innerText = type[1];
			if(type[1] == jurSelectedType) {
				newOpinion.setAttribute('selected', 'selected');
			}
			newSelect.append(newOpinion);
		}
		let devList = editEntity.querySelector('#entityTypesList').parentNode;
		devList.append(newSelect);
	
		newSelect.addEventListener('change', function() {
			if(this.value == "") {
				editEntity.querySelector('#entityTypesList').checked = false;
			} else {
				editEntity.querySelector('#entityTypesList').checked = true;
			}
			if(this.value == 1) {
				editJurName.innerHTML = jurName;
			} else {
				if(editJurName.querySelector('input') == undefined) {
					editJurName.innerHTML = "<input type=\"text\" id=\"seller_jurName\" value=\"" + jurName + "\">";
				}
			}
		}, false);
		
		entityTypeInput.addEventListener('keyup', function() {
			if(this.value == "") {
				editEntity.querySelector('#entityTypesInput').checked = false;
			} else {
				editEntity.querySelector('#entityTypesInput').checked = true;
			}
			
			if(editJurName.querySelector('input') == undefined) {
				editJurName.innerHTML = "<input type=\"text\" id=\"seller_jurName\" value=\"" + jurName + "\">";
			}
		}, false);
	} else {
		let entinitySelectOptions = newEntitySelect.querySelectorAll('option');
		for(let i = 0; i < entityTypes.length; i++) {
			if(entityTypes[i][1] == jurSelectedType) {
				entinitySelectOptions[i+1].setAttribute('selected', 'selected');
			}
		}
	}
	
	let typesOfInputEntity = editEntity.querySelectorAll('input[type="radio"]');
	
	for(let elem of typesOfInputEntity) {
		elem.addEventListener('change', function() {
			if(this.value == "list") {
				let type = this.parentNode.querySelector('select option:checked').innerText;
				console.log(type);
				if(type == "ИП") {
					editJurName.innerHTML = jurName;
				}
			} else if(this.value == "input") {
				if(editJurName.querySelector('input') == undefined) {
					editJurName.innerHTML = "<input type=\"text\" id=\"seller_jurName\" value=\"" + jurName + "\">";
				}
			}
		});
	}
	
	if(jurSelectedType !== "") {
		editEntity.querySelector('#entityTypesList').checked = true;
	} else if(jurType !== "") {
		editEntity.querySelector('#entityTypesInput').checked = true;
		entityTypeInput.value = jurType;
	}
	
	let bank = tdData.dataset.bank;
	
	let editBank = editing.querySelector('.editBank .input');
	let inputBank = editBank.querySelector('input#seller_bank');
	inputBank.value = bank;
	
	let currAccNum = tdData.dataset.currAccNum;
	
	let editCurAccNum = editing.querySelector('.editCurAccNum .input');
	let inputCurAccNum = editCurAccNum.querySelector('input#seller_currentAccountNumber');
	inputCurAccNum.value = currAccNum;
	
	let corAccNum = tdData.dataset.corAccNum;
	
	let editCorAccNum = editing.querySelector('.editCorAccNum .input');
	let inputCorAccNum = editCorAccNum.querySelector('input#seller_cortAccountNumber');
	inputCorAccNum.value = corAccNum;
	
	let bik = tdData.dataset.bik;
	
	let editBIK = editing.querySelector('.editBIK .input');
	let inputBIK = editBIK.querySelector('input#seller_BIK');
	inputBIK.value = bik;
	
	let inn = tdData.dataset.inn;
	
	let editINN = editing.querySelector('.editINN .input');
	let inputINN = editINN.querySelector('input#seller_INN');
	inputINN.value = inn;
	
	let jurAddr = tdData.dataset.jurAdd;
	
	jurAddr = jurAddr.replace(", ']", "");
	jurAddr = jurAddr.replace(/'/g, "");
	jurAddr = jurAddr.replace("[", "");
	jurAddr = jurAddr.split(', ');
	
	let mapJurAddr = new Map();
	
	for(let addr of jurAddr) {
		let propVal = addr.split(' = ');
		mapJurAddr.set(propVal[0], propVal[1]);   
	}
	
	let selectJurAddrCountry = editing.querySelector('select#seller_jurAddrCountry');
	let selectedJurCountry = mapJurAddr.get('country');
	let jurCountries = selectJurAddrCountry.querySelectorAll('option');
	
	for(let country of jurCountries) {
		if(country.innerText == selectedJurCountry) {
			country.selected = true;
			break;
		}
	}
	
	let inputJurAddrIndex = editing.querySelector('input#seller_jurAddrIndex');
	inputJurAddrIndex.value = mapJurAddr.get('postIndex');
	
	let inputJurAddrRegion = editing.querySelector('input#seller_jurAddrRegion');
	inputJurAddrRegion.value = mapJurAddr.get('region');
	
	let inputJurAddrCity = editing.querySelector('input#seller_jurAddrCity');
	inputJurAddrCity.value = mapJurAddr.get('city');
	
	let inputJurAddrStreet = editing.querySelector('input#seller_jurAddrStreet');
	inputJurAddrStreet.value = mapJurAddr.get('street');
	
	let inputJurAddrHome = editing.querySelector('input#seller_jurAddrHome');
	inputJurAddrHome.value = mapJurAddr.get('home');
	
	let inputJurAddrOffice = editing.querySelector('input#seller_jurAddrOffice');
	inputJurAddrOffice.value = mapJurAddr.get('office');
	
	let factAddr = tdData.dataset.factAdd;
	
	factAddr = factAddr.replace(", ']", "");
	factAddr = factAddr.replace(/'/g, "");
	factAddr = factAddr.replace("[", "");
	factAddr = factAddr.split(', ');
	
	let mapfactAddr = new Map();
	
	for(let addr of factAddr) {
		let propVal = addr.split(' = ');
		mapfactAddr.set(propVal[0], propVal[1]);   
	}
	
	let selectFactAddrCountry = editing.querySelector('select#seller_factAddrCountry');
	let selectedFactCountry = mapfactAddr.get('country');
	let factCountries = selectFactAddrCountry.querySelectorAll('option');
	
	for(let country of factCountries) {
		if(country.innerText == selectedFactCountry) {
			country.selected = true;
			break;
		}
	}
	
	let inputfactAddrIndex = editing.querySelector('input#seller_factAddrIndex');
	inputfactAddrIndex.value = mapfactAddr.get('postIndex');
	
	let inputfactAddrRegion = editing.querySelector('input#seller_factAddrRegion');
	inputfactAddrRegion.value = mapfactAddr.get('region');
	
	let inputfactAddrCity = editing.querySelector('input#seller_factAddrCity');
	inputfactAddrCity.value = mapfactAddr.get('city');
	
	let inputfactAddrStreet = editing.querySelector('input#seller_factAddrStreet');
	inputfactAddrStreet.value = mapfactAddr.get('street');
	
	let inputfactAddrHome = editing.querySelector('input#seller_factAddrHome');
	inputfactAddrHome.value = mapfactAddr.get('home');
	
	let inputfactAddrOffice = editing.querySelector('input#seller_factAddrOffice');
	inputfactAddrOffice.value = mapfactAddr.get('office');
	
	let editIsTrading = editing.querySelector('.editIsTrading .input');
	let titleIsTrading = editIsTrading.querySelector('.isShow');
	
	let isTrading = tdData.dataset.istrading;
	if(isTrading == '0') {
		titleIsTrading.innerText = "Выключено";
		if(editIsTrading.querySelector('label') == undefined) {
			editIsTrading.innerHTML += "<label class=\"switch\">\
										  <input type=\"checkbox\">\
										  <span class=\"slider round\"></span>\
										</label>";
		} else {
			editIsTrading.querySelector('label').innerHTML = '<input type=\"checkbox\"><span class=\"slider round\"></span>';
		}
	} else {
		titleIsTrading.innerText = "Включено";
		if(editIsTrading.querySelector('label') == undefined) {
			editIsTrading.innerHTML += "<label class=\"switch\">\
										  <input type=\"checkbox\" checked>\
										  <span class=\"slider round\"></span>\
										</label>";
		} else {
			editIsTrading.querySelector('label').innerHTML = '<input type=\"checkbox\" checked><span class=\"slider round\"></span>';
		}
	}
	editIsTrading.querySelector('label.switch').addEventListener('change', function() {
		titleIsTrading = event.path[2].querySelector('.isShow');
		if(event.path[0].checked) {
			titleIsTrading.innerText = "Включено";
		}else {
			titleIsTrading.innerText = "Выключено";
		}
	}, false);
	
	let editIsIncluded = editing.querySelector('.editIsIncluded .input');
	let titleIsIncluded = editIsIncluded.querySelector('.isShow');
	
	let isIncluded = tdData.dataset.isIncluded;
	if(isIncluded == '0') {
		titleIsIncluded.innerText = "Выключено";
		if(editIsIncluded.querySelector('label') == undefined) {
			editIsIncluded.innerHTML += "<label class=\"switch\">\
										  <input type=\"checkbox\">\
										  <span class=\"slider round\"></span>\
										</label>";
		} else {
			editIsIncluded.querySelector('label').innerHTML = '<input type=\"checkbox\"><span class=\"slider round\"></span>';
		}
	} else {
		titleIsIncluded.innerText = "Включено";
		if(editIsIncluded.querySelector('label') == undefined) {
			editIsIncluded.innerHTML += "<label class=\"switch\">\
										  <input type=\"checkbox\" checked>\
										  <span class=\"slider round\"></span>\
										</label>";
		} else {
			editIsIncluded.querySelector('label').innerHTML = '<input type=\"checkbox\" checked><span class=\"slider round\"></span>';
		}
	}

	editIsIncluded.querySelector('label.switch').addEventListener('change', function() {
		titleIsIncluded = event.path[2].querySelector('.isShow');
		if(event.path[0].checked) {
			titleIsIncluded.innerText = "Включено";
		}else {
			titleIsIncluded.innerText = "Выключено";
		}
	}, false);
	
	let statusOfTrading = tdData.dataset.statusOfTrading;
	let inputStatusOfTrading = editing.querySelector('input#seller_statusOfTrading');
	inputStatusOfTrading.value = statusOfTrading;
	
	let bankCode = tdData.dataset.bankCode;
	let inputBankCode = editing.querySelector('input#seller_bankCode');
	inputBankCode.value = bankCode;
	
	let table = mainContent.querySelector('.table_sellers');
	table.classList.add('none');
	editing.classList.remove('none');
	changeLeftMenuHeight();

	if(newEntitySelect == undefined) {
		let stylefieldEntity = getComputedStyle(fieldEntity);
		let fieldEntityPaddingTop = parseInt(stylefieldEntity.paddingTop);
		let fieldEntityPaddingBottom = parseInt(stylefieldEntity.paddingBottom);
		let fieldEntityHeight = fieldEntity.clientHeight - fieldEntityPaddingTop - fieldEntityPaddingBottom;
		let diffEntity = editEntity.clientHeight - fieldEntityHeight;
		let newEntityPaddingBottom = fieldEntityPaddingBottom + diffEntity;
		fieldEntity.style.paddingBottom = newEntityPaddingBottom + "px";
	}
	
	let styleFieldPhone = getComputedStyle(fieldPhone);
	let fieldPhonePaddingTop = parseInt(styleFieldPhone.paddingTop);
	let fieldPhonePaddingBottom = parseInt(styleFieldPhone.paddingBottom);
	let fieldPhoneHeight = fieldPhone.clientHeight - fieldPhonePaddingTop - fieldPhonePaddingBottom;
	let diff = editPhone.clientHeight - fieldPhoneHeight;
	let newPaddingBottom = fieldPhonePaddingBottom + diff;
	fieldPhone.style.paddingBottom = newPaddingBottom + "px";
	
	
	let photoPaddingBottomPx = fieldPhoto.style.paddingBottom.replace('px', '');
	
	if(editPhotoImg == null && photoPaddingBottomPx < 56) {
		let styleFieldPhoto = getComputedStyle(fieldPhoto);
		let fieldPhotoPaddingTop = parseInt(styleFieldPhoto.paddingTop);
		let fieldPhotoPaddingBottom = parseInt(styleFieldPhoto.paddingBottom);
		let fieldPhotoHeight = fieldPhoto.clientHeight - fieldPhotoPaddingTop - fieldPhotoPaddingBottom;
		let diffPhoto = editPhoto.clientHeight - fieldPhotoHeight;
		let newPhotoPaddingBottom = fieldPhotoPaddingBottom + diffPhoto;
		fieldPhoto.style.paddingBottom = newPhotoPaddingBottom + "px";
	}
}

let buttonForDeleteSeller = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');
buttonForDeleteSeller.addEventListener('click', beforeDeleteSellerPOST, false);


function beforeDeleteSellerPOST() {
	if(clickDeletingSeller == 0) {
		clickDeletingSeller = 1;
		deleteSellerPOST();
	}
}

function deleteSellerPOST() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/deleteSeller.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			deletingSellerTd.remove();
			toggleModalBlock(6, 1);
			clickDeletingSeller = 0;
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось удалить продавца.');
		}
	});
	xhr.send('"' + deletingSellerId + '"');
}

/*
function inputAddressHomeOrOffice() {
	if(this.value.length == 1) {
		this.value = this.value.replace(/\D/g, '');
	} else if(this.value.length > 1) {
		while(this.value[0].match(/[0-9]/g) == null) {
			this.value = this.value.substring(1);
		}
		
		let spaceSimbols = this.value.match(/ /g);
		let comaSimbols = this.value.match(/,/g);
		let otherSimbols = this.value.match(/[^ ,0-9]/g);
		
		if(otherSimbols !== null) {
			if(otherSimbols.length > 1) {
				this.value = this.value.substring(0, this.value.indexOf(otherSimbols[1])) + this.value.substring(this.value.indexOf(otherSimbols[1]) + 1);
			}
		}
	}
}

let edSJAHomeInput = document.querySelector('.editing_seller .field .address-list li input#seller_jurAddrHome');
let edSJAOfficeInput = document.querySelector('.editing_seller .field .address-list li input#seller_jurAddrOffice');
let edSFAHomeInput = document.querySelector('.editing_seller .field .address-list li input#seller_factAddrHome');
let edSFAOfficeInput = document.querySelector('.editing_seller .field .address-list li input#seller_factAddrOffice');

edSJAHomeInput.addEventListener('input', inputAddressHomeOrOffice, false);
edSJAOfficeInput.addEventListener('input', inputAddressHomeOrOffice, false);
edSFAHomeInput.addEventListener('input', inputAddressHomeOrOffice, false);
edSFAOfficeInput.addEventListener('input', inputAddressHomeOrOffice, false);
*/
