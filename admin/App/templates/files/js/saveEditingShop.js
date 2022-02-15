let buttonSaveEditingShop = document.querySelector('.editing_shop .header .save-shop');
buttonSaveEditingShop.addEventListener('click', saveEditingShop, false);

function saveEditingShop() {
	let editing = mainContent.querySelector('.editing_shop');
	
	if(isCheckedShopURL == 0) {
		let inputShopUrl = editing.querySelector('.input #shop_url');
	
		isLaunchSaving = 1;
		
		let eventBlur = new Event("blur");
		inputShopUrl.dispatchEvent(eventBlur);
		
		return false;
	}
	
	if(isCheckedShopName == 0) {
		let inputShopName = editing.querySelector('.input #shop_name');	
	
		isLaunchSaving = 1;
		
		let eventBlur = new Event("blur");
		inputShopName.dispatchEvent(eventBlur);
		
		return false;
	}
	
	let shopId = editing.dataset.id;
	
	let isNormal = true;
	let errorField = "";
	
	let tdData = document.querySelector('.table_shops tbody tr td:first-child[data-id="' + shopId + '"]');
	
	let shopName = editing.querySelector('.input #shop_name').value;
	let labelShopName = editing.querySelector('label[for="shop_name"]');
	
	if(shopName == '') {
		isNormal = false;
		errorField += "<p>Введите название магазина.</p>";
	} else if(shopName.length < 4) {
		isNormal = false;
		errorField += "<p>Название магазина должно быть не меньше 4-х символов.</p>";
	} else if(labelShopName.classList.contains('notAvailble')) {
		isNormal = false;
		errorField += "<p>Измените название магазина на доступный.</p>";
	}
	
	let editShopDesc = editing.querySelector('#shop_description').value;
	if(editShopDesc == '') {
		isNormal = false;
		errorField += "<p>Введите описание магазина.</p>";
	}
	
	let editShopURL = editing.querySelector('.input #shop_url').value;
	let labelShopURL = editing.querySelector('label[for="shop_url"]');
	
	if(editShopURL.length > 0 && editShopURL.length < 4) {
		isNormal = false;
		errorField += "<p>Адрес(URL) магазина  должен быть не меньше 4-х символов.</p>";
	} else if(labelShopURL.classList.contains('notAvailble')) {
		isNormal = false;
		errorField += "<p>Измените URL магазина на доступный.</p>";
	}
	
	
	let img = document.querySelector('.editing_shop .editPhoto img');
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
		
		isNormal = false;
		errorField += "<p>Выберите фотографию(логотип) для магазина.</p>";
	}
	
	let shopIsTrading;
	let isShopIncluded;
	let isTrading;
	let statusOfTrading;
	let isIncluded;
	let statusOfShopTrading;
	
	if(typeof(sellerJuridicName) == "undefined") {
		shopIsTrading = editing.querySelector('.editShopIsTrading .input .isShow').innerText;
		if(shopIsTrading == 'Включено') {
			shopIsTrading = 1;
		} else {
			shopIsTrading = 0;
		}
		
		statusOfShopTrading = editing.querySelector('#shop_statusOfTrading').value;
				
		isTrading = editing.querySelector('.editIsTrading .input .isShow').innerText;
		if(isTrading == 'Включено') {
			isTrading = 1;
		} else {
			isTrading = 0;
		}
		
		statusOfTrading = editing.querySelector('#seller_statusOfTrading').value;
		
		isIncluded = editing.querySelector('.editIsIncluded .input .isShow').innerText;
		if(isIncluded == 'Включено') {
			isIncluded = 1;
		} else {
			isIncluded = 0;
		}
	}
	
	isShopIncluded = editing.querySelector('.editShopIsIncluded .input .isShow').innerText;
	if(isShopIncluded == 'Включено') {
		isShopIncluded = 1;
	} else {
		isShopIncluded = 0;
	}
	
	if(!isNormal) {
		let errorMessage = document.querySelector('.modalBlock.error .modalBody');
		errorMessage.innerHTML = errorField;
		toggleModalBlock(2, 1);
	} else {
		if(typeof(sellerJuridicName) == "undefined") {
			tdData.dataset.shopistrading = shopIsTrading;
			tdData.dataset.shopStatusOfTrading = statusOfShopTrading;
			tdData.dataset.istrading = isTrading;
			tdData.dataset.statusOfTrading = statusOfTrading;
			tdData.dataset.isIncluded = isIncluded;
		}
		
		tdData.dataset.shopIsIncluded = isShopIncluded;
		tdData.dataset.shopDescription = editShopDesc;
		tdData.dataset.shopUrl = editShopURL;
		
		saveEditingSellerPOST(shopId, shopName, editShopDesc, editShopURL, 
								shopIsTrading, statusOfShopTrading, isShopIncluded, isTrading, statusOfTrading, isIncluded);
	}
}

function saveEditingSellerPOST(shopId, shopName, shopDescription, shopUrl, 
								shopIsTrading, statusOfShopTrading, isShopIncluded, isTrading, statusOfTrading, isIncluded) {							
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/saveEditingShop.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось изменить категорию.');
		}
	});
	
	xhr.send('["' + shopId + '", "' +shopName + '", "' + shopDescription + '", "' + shopUrl + 
	'", "' + shopIsTrading + '", "' + statusOfShopTrading + '", "' + isShopIncluded + 
	'", "' + isTrading + '", "' + statusOfTrading + '", "' + isIncluded + '"]');
}