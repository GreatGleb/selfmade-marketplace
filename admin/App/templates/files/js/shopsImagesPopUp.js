function editingDOMnotSelectToSelect(notSelect) {
	let editing = mainContent.querySelector('.editing_shop');
	let id = editing.dataset.id;
	
	let tdData = document.querySelector('.table_shops tbody tr td:first-child[data-id="' + id + '"]');
	
	let img = notSelect.querySelector('img');
	
	let editImg = document.querySelector('.editing_shop .editPhoto img');
	
	if(editImg !== null) {
		let indOfSlesh = img.src.lastIndexOf('/');
		let imgName = img.dataset.filename;
		
		tdData.dataset.imgUrl = "App/templates/files/img/shops/";
		tdData.dataset.imgName = imgName;
		editImg.src = img.src;
	} else {
		let newImg = document.createElement('img');
		newImg.src = img.src;
		document.querySelector('.editing_shop .editPhoto .input').prepend(newImg);
		newImg.style.width = "50px";
		newImg.style.height = "50px";
		newImg.dataset.src = img.src;
		
		let indOfSlesh = img.src.lastIndexOf('/');
		let imgName = img.dataset.filename;
		tdData.dataset.imgUrl = "App/templates/files/img/shops/";
		tdData.dataset.imgName = imgName;

		let fieldPhoto = editing.querySelector('.editPhoto');
		let editPhoto = fieldPhoto.querySelector('.input');
		
		let styleFieldPhoto = getComputedStyle(fieldPhoto);
		let fieldPhotoPaddingTop = parseInt(styleFieldPhoto.paddingTop);
		let fieldPhotoPaddingBottom = parseInt(styleFieldPhoto.paddingBottom);
		let fieldPhotoHeight = fieldPhoto.clientHeight - fieldPhotoPaddingTop - fieldPhotoPaddingBottom;
		let diffPhoto = editPhoto.clientHeight - fieldPhotoHeight;
		let newPhotoPaddingBottom = fieldPhotoPaddingBottom + diffPhoto;
		fieldPhoto.style.paddingBottom = newPhotoPaddingBottom + "px";
	}
}

function editingDOMyesSelectToNotSelect() {
	let editing = mainContent.querySelector('.editing_shop');
	let id = editing.dataset.id;
	
	let tdData = document.querySelector('.table_shops tbody tr td:first-child[data-id="' + id + '"]');
	
	document.querySelector('.editing_shop .editPhoto .input img').remove();
	tdData.removeAttribute("data-img-name");
	tdData.removeAttribute("data-img-url");
	
	let fieldPhoto = editing.querySelector('.editPhoto');
	let editPhoto = fieldPhoto.querySelector('.input');
	
	let styleFieldPhoto = getComputedStyle(fieldPhoto);
	let fieldPhotoPaddingTop = parseInt(styleFieldPhoto.paddingTop);
	let fieldPhotoPaddingBottom = parseInt(styleFieldPhoto.paddingBottom);
	let fieldPhotoHeight = fieldPhoto.clientHeight - fieldPhotoPaddingTop - fieldPhotoPaddingBottom;
	let diffPhoto = editPhoto.clientHeight - fieldPhotoHeight;
	let newPhotoPaddingBottom = fieldPhotoHeight + diffPhoto;
	fieldPhoto.style.paddingBottom = newPhotoPaddingBottom + "px";
}

let clickEditSellerAvatar = 0;

function launchImagesPopUp() {
	let editing = mainContent.querySelector('.editing_shop');
	let id = editing.dataset.id;
	
	let tdData = document.querySelector('.table_shops tbody tr td:first-child[data-id="' + id + '"]');
	shopId = tdData.dataset.id;
	currentTableId = shopId;
	
	onlyOne = undefined;
	
	if(clickEditSellerAvatar == 0) {
		loadingImagesInPopUp(1, 'shops/', editingDOMnotSelectToSelect, editingDOMyesSelectToNotSelect, 'ImagesForShop', 'shopId', shopId);
		clickEditSellerAvatar = 1;
	}
}

function launchImagesForNewShopPopUp() {
	onlyOne = 1;
	addingEmptyShopEndGetShopIdPOST();
}

function deleteTitleError() {
	let modalError = document.querySelector('.modalBlock.error.level3');
	modalError.style.display = "none";
}

function addingShopDOMnotSelectToSelect(notSelect) {
	let modalImg = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div img');
	let img = notSelect.querySelector('img');
	
	modalImg.src = img.src;
}

function addingShopDOMyesSelectToNotSelect() {
	let modalImg = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div img');
	modalImg.src = "App/templates/files/img/shops/default.png";
}

function addingEmptyShopEndGetShopIdPOST() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/addingEmptyShopEndGetShopId.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );
	
	let modalError = document.querySelector('.modalBlock.error.level3');
			
	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
			
			let shopId = e.target.response;
			
			currentTableId = shopId;
			loadingImagesInPopUp(3, 'shops/', addingShopDOMnotSelectToSelect, addingShopDOMyesSelectToNotSelect, 'ImagesForShop', 'shopId', shopId);
		} else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			modalError.style.display = "block";
			modalError.innerText = 'К сожалению, не удалось загрузить окно измений фотографий.';
			setTimeout(deleteTitleError, 5000);
			console.log('К сожалению, не удалось загрузить окно измений фотографий.');
		}
	});

	xhr.send('');
}