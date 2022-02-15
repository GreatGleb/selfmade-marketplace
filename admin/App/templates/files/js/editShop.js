let editShop = document.querySelectorAll('.table_shops tbody .editShop');

let mainContent = document.querySelector('.mainHtmlContent');

let isLaunchSaving = 0;
let isCheckedShopName = 1;
let isCheckedShopURL = 1;

let isFirstLaunchEditingShop = true;
for(let seller of editShop) {
	seller.addEventListener('click', actionShop, false);
}

let deleteShop = document.querySelectorAll('.table_shops tbody .deleteShop');

for(let seller of deleteShop) {
	seller.addEventListener('click', actionShop, false);
}

let deletingShopId;
let deletingShopTd;
let clickDeletingShop = 0;

function actionShop() {
	let td = event.path[0];
	if(event.path[0].className == "editShop") {
		editingShop(td);
		
		let buttonReplyEditingShop = mainContent.querySelector('.editing_shop .header .reply-shop');
		buttonReplyEditingShop.addEventListener('click', function() {
			editingShop(td);
		}, false);
	} else if(event.path[0].className == "deleteShop") {
		let shopName = event.path[1].querySelector('.name').innerText;
		deletingShopId = event.path[1].querySelector('td.none').dataset.id;
		deletingShopTd = event.path[1];
		
		let errorMessage = document.querySelector('.modalBlock.error.warning .modalBody > div:not([class])');
		errorMessage.innerHTML = "<p>Вы действительно хотите удалить магазин " + shopName +"?</p>";
		errorMessage.innerHTML += "<p>При удалении магазина также удаляться все товары, которые закреплены за этим магазином.</p>";
		toggleModalBlock(6, 1);
	}
}

function editingShop(td) {
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
	
	let editing = mainContent.querySelector('.editing_shop');
	
	editing.dataset.id = tdData.dataset.id;
	editing.dataset.userid = tdData.dataset.userid;
	
	if(typeof(sellerJuridicName) == "undefined") {
		let editFio = editing.querySelector('.editFio .input');
		let fio = tr.querySelector('td.full_name').innerText;
		editFio.innerText = fio;
	}
	
	let editShopName = editing.querySelector('.input #shop_name');
	let shopName = tr.querySelector('td.name').innerText;
	editShopName.value = shopName;
	let labelShopName = editing.querySelector('label[for="shop_name"]');
	labelShopName.classList.remove('error');
	labelShopName.classList.remove('needMore');
	labelShopName.classList.remove('notAvailble');
	
	let editShopDesc = editing.querySelector('#shop_description');
	let shopDesc = tdData.dataset.shopDescription;
	editShopDesc.value = shopDesc;
	
	let editShopURL = editing.querySelector('.input #shop_url');
	let shopURL = tdData.dataset.shopUrl;
	editShopURL.value = shopURL;
	let labelShopUrl = editing.querySelector('label[for="shop_url"]');
	labelShopUrl.classList.remove('error');
	labelShopUrl.classList.remove('notAvailble');
	labelShopUrl.classList.remove('needMore');
	labelShopUrl.classList.remove('falseSimbols');
	
	if(isFirstLaunchEditingShop) {
		editShopName.addEventListener('blur', checkIsAvailableShopName, false);
		editShopName.addEventListener('input', inputShopName, false);
	
		editShopURL.addEventListener('input', inputURL, false);
		editShopURL.addEventListener('blur', checkIsAvailableURL, false);
	}
	
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
	
	if(typeof(sellerJuridicName) == "undefined") {
		let jurName = tdData.dataset.jurName;
		
		let editJurName = editing.querySelector('.editJurName .input');
		
		if(jurSelectedType !== "") {
			editJurName.innerHTML = jurSelectedType + " «" + jurName + "»";
		} else {
			editJurName.innerHTML = jurType + " «" + jurName + "»";
		}
		
    	let editShopIsTrading = editing.querySelector('.editShopIsTrading .input');
    	let titleShopIsTrading = editShopIsTrading.querySelector('.isShow');
    	
    	let shopIsTrading = tdData.dataset.shopistrading;
    	if(shopIsTrading == '0') {
    		titleShopIsTrading.innerText = "Выключено";
    		if(editShopIsTrading.querySelector('label') == undefined) {
    			editShopIsTrading.innerHTML += "<label class=\"switch\">\
    										  <input type=\"checkbox\">\
    										  <span class=\"slider round\"></span>\
    										</label>";
    		} else {
    			editShopIsTrading.querySelector('label').innerHTML = '<input type=\"checkbox\"><span class=\"slider round\"></span>';
    		}
    	} else {
    		titleShopIsTrading.innerText = "Включено";
    		if(editShopIsTrading.querySelector('label') == undefined) {
    			editShopIsTrading.innerHTML += "<label class=\"switch\">\
    										  <input type=\"checkbox\" checked>\
    										  <span class=\"slider round\"></span>\
    										</label>";
    		} else {
    			editShopIsTrading.querySelector('label').innerHTML = '<input type=\"checkbox\" checked><span class=\"slider round\"></span>';
    		}
    	}
    	editShopIsTrading.querySelector('label.switch').addEventListener('change', function() {
    		titleShopIsTrading = event.path[2].querySelector('.isShow');
    		if(event.path[0].checked) {
    			titleShopIsTrading.innerText = "Включено";
    		}else {
    			titleShopIsTrading.innerText = "Выключено";
    		}
    	}, false);
    	
    	let statusOfShopTrading = tdData.dataset.shopStatusOfTrading;
    	let inputShopStatusOfTrading = editing.querySelector('input#shop_statusOfTrading');
    	inputShopStatusOfTrading.value = statusOfShopTrading;
    	
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
	}
	
	let editShopIsIncluded = editing.querySelector('.editShopIsIncluded .input');
	let titleShopIsIncluded = editShopIsIncluded.querySelector('.isShow');
	
	let shopIsIncluded = tdData.dataset.shopIsIncluded;
	if(shopIsIncluded == '0') {
		titleShopIsIncluded.innerText = "Выключено";
		if(editShopIsIncluded.querySelector('label') == undefined) {
			editShopIsIncluded.innerHTML += "<label class=\"switch\">\
										  <input type=\"checkbox\">\
										  <span class=\"slider round\"></span>\
										</label>";
		} else {
			editShopIsIncluded.querySelector('label').innerHTML = '<input type=\"checkbox\"><span class=\"slider round\"></span>';
		}
	} else {
		titleShopIsIncluded.innerText = "Включено";
		if(editShopIsIncluded.querySelector('label') == undefined) {
			editShopIsIncluded.innerHTML += "<label class=\"switch\">\
										  <input type=\"checkbox\" checked>\
										  <span class=\"slider round\"></span>\
										</label>";
		} else {
			editShopIsIncluded.querySelector('label').innerHTML = '<input type=\"checkbox\" checked><span class=\"slider round\"></span>';
		}
	}

	editShopIsIncluded.querySelector('label.switch').addEventListener('change', function() {
		titleShopIsIncluded = event.path[2].querySelector('.isShow');
		if(event.path[0].checked) {
			titleShopIsIncluded.innerText = "Включено";
		}else {
			titleShopIsIncluded.innerText = "Выключено";
		}
	}, false);
	
	let table = mainContent.querySelector('.table_shops');
	table.classList.add('none');
	editing.classList.remove('none');
	changeLeftMenuHeight();
	
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

function inputShopName() {
	let div = this.parentNode.parentNode;
	let label = div.querySelector('label');
	
	console.log(label);
	
	label.classList.remove('error');
	label.classList.remove('needMore');
	label.classList.remove('notAvailble');
	isCheckedShopName = 0;
}

function checkIsAvailableShopName() {
	let div = this.parentNode.parentNode;
	let label = div.querySelector('label');
	
	let shopId = div.parentNode.dataset.id;
	
	let tr = document.querySelector('.table_shops tbody tr td.none[data-id=\"' + shopId + '\"]').parentNode;
	let shopName = tr.querySelector('td.name').innerText;
	
	console.log(shopName);
	
	if(this.value.length > 0) {
		if(this.value.length < 4) {
			label.classList.remove('notAvailble');
			label.classList.add('error');
			label.classList.add('needMore');
			isCheckedShopName = 1;
		} else {
			label.classList.remove('error');
			label.classList.remove('needMore');
			
			let input = this.value;
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'App/Controllers/checkIsAvailableShopName.php');
			xhr.setRequestHeader( "Content-Type", "application/json" );

			xhr.addEventListener('readystatechange', function(e) {
				console.log(e.target.response);
				if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
					if(e.target.response == '1' || input == shopName) {
						label.classList.remove('error');
						label.classList.remove('notAvailble');
						console.log("норм");
					} else {							
						label.classList.add('error');
						label.classList.add('notAvailble');
						console.log(input);
						console.log("Ау нак");
					}
					isCheckedShopName = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveEditingShop();
					}
				}
				else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
					console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
					isCheckedShopName = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveEditingShop();
					}
				}
			});
			xhr.send('"' + this.value + '"');
		}
	} else {
		label.classList.remove('error');
		label.classList.remove('notAvailble');
		label.classList.remove('needMore');
		isCheckedShopName = 1;
	}
}

function checkIsAvailableURL() {
	let div = this.parentNode.parentNode;
	let label = div.querySelector('label');
	
	let shopId = div.parentNode.dataset.id;
	
	let tr = document.querySelector('.table_shops tbody tr td.none[data-id=\"' + shopId + '\"]').parentNode;
	let shopUrl = tr.querySelector('td.none').dataset.shopUrl;
	
	console.log(shopUrl);
	
	if(this.value.length > 0) {
		if(this.value.length < 4) {
			label.classList.remove('falseSimbols');
			label.classList.remove('notAvailble');
			label.classList.add('error');
			label.classList.add('needMore');
			isCheckedShopURL = 1;
		} else {
			label.classList.remove('error');
			label.classList.remove('needMore');
			label.classList.remove('notAvailble');
			label.classList.remove('falseSimbols');
			
			let input = this.value;
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'App/Controllers/checkIsAvailableURL.php');
			xhr.setRequestHeader( "Content-Type", "application/json" );

			xhr.addEventListener('readystatechange', function(e) {
				console.log(e.target.response);
				if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
					if(e.target.response == '1' || input == shopUrl) {
						
					} else {							
						label.classList.add('error');
						label.classList.add('notAvailble');
					}
					isCheckedShopURL = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveEditingShop();
					}
				}
				else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
					console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
					isCheckedShopURL = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveEditingShop();
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
		isCheckedShopURL = 1;
	}
}

function inputURL() {
	let div = this.parentNode.parentNode;
	let label = div.querySelector('label');
	
	console.log(label);
	
	label.classList.remove('error');
	label.classList.remove('needMore');
	label.classList.remove('notAvailble');
	
	if(this.value.match(/\W/g) != null) {			
		label.classList.add('error');
		label.classList.add('falseSimbols');
		this.value = this.value.replace(/\W/g, '');
	} else {
		label.classList.remove('error');
		label.classList.remove('falseSimbols');
	}
	isCheckedShopURL = 0;
}

let buttonForDeleteSeller = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');
buttonForDeleteSeller.addEventListener('click', beforeDeleteShopPOST, false);


function beforeDeleteShopPOST() {
	if(clickDeletingShop == 0) {
		clickDeletingShop = 1;
		deleteShopPOST();
	}
}

function deleteShopPOST() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/deleteShop.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			deletingShopTd.remove();
			toggleModalBlock(6, 1);
			clickDeletingShop = 0;
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось удалить продавца.');
		}
	});
	xhr.send('"' + deletingShopId + '"');
}
