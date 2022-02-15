let editGood = document.querySelectorAll('.table_goods tbody .editGood');

let mainContent = document.querySelector('.mainHtmlContent');
let editing = mainContent.querySelector('.editing_good');

let divEditCategories = editing.querySelector('.editCategories');
let editCategoriesPaddingBottom = Number(window.getComputedStyle(divEditCategories).getPropertyValue("padding-bottom").replace('px', ''));
let toggleClickEditCategories;
let isFirstLaunching = true;

let divEditAtributes = editing.querySelector('.editAtributes');	
let editAtributes = divEditAtributes.querySelector('.input');	
let atributesHtml = editAtributes.innerHTML;

let divEditDisconts = editing.querySelector('.editDisconts');	
let editDisconts = divEditDisconts.querySelector('.input');	
let discontsHtml = editDisconts.innerHTML;

let isLaunchSaving = 0;
let isCheckedGoodURL = 1;

let isFirstLaunchEditingGood = true;

let clickDeletingGood = 0;
let deletingGoodId;
let deletingGoodTd;

for(let good of editGood) {
	good.addEventListener('click', actionGood, false);
}

let deleteGood = document.querySelectorAll('.table_goods tbody .deleteGood');

for(let good of deleteGood) {
	good.addEventListener('click', actionGood, false);
}

let deletingStockId;
let deletingStockTd;
let clickDeletingStock = 0;

function actionGood() {
	let td = event.path[0];
	if(event.path[0].className == "editGood") {
		editingGood(td);
		
		let buttonReplyEditingStockroom = mainContent.querySelector('.editing_good .header .reply-good');
		buttonReplyEditingStockroom.addEventListener('click', function() {
			editingGood(td);
		}, false);
	} else if(event.path[0].className == "deleteGood") {
		let goodName = event.path[2].querySelector('.name').innerText;
		deletingGoodId = event.path[2].querySelector('td.none').dataset.id;
		deletingGoodTd = event.path[2];
		
		let errorMessage = document.querySelector('.modalBlock.error.warning .modalBody > div:not([class])');
		errorMessage.innerHTML = "<p>Вы действительно хотите удалить товар " + goodName +"?</p>";
		errorMessage.innerHTML += "<p>При удалении магазина также удаляться все товары, которые закреплены за этим магазином.</p>";
		buttonForDeleteGood.addEventListener('click', beforeDeleteGoodPOST, false);
		
		toggleModalBlock(6, 1);
	}
}

function editingGood(div) {
	let headerMenu = document.querySelector('div.admin-block-top');
	headerMenu.scrollIntoView();
	
	let td = div.parentNode;
	
	let tr = td.parentNode;

	let tdData = tr.querySelector('td.none');
		
	editing.dataset.id = tdData.dataset.id;
	
	if(typeof(sellerJuridicName) == "undefined") {
		let editFio = editing.querySelector('.editFio .input');
		let fio = tdData.dataset.sellerFio;
		editFio.innerText = fio;
	}
	
	let table = mainContent.querySelector('.table_goods');
	table.classList.add('none');
	editing.classList.remove('none');
	
	let paginations = document.querySelectorAll('.pagination');
	for(let pag of paginations) {
	    pag.classList.add('none');
	}
	
	if(typeof(sellerJuridicName) == "undefined") {
		let jurName = tr.querySelector('td.jur .jurName').innerText;	
		let editJurName = editing.querySelector('.editJurName .input');	
		editJurName.innerText = jurName;
	}
	
	let editGoodShop = editing.querySelector('.editShop .input');
	let goodShop = tdData.dataset.shopName;
	editGoodShop.innerText = goodShop;
	
	let editDateAdd = editing.querySelector('.editDateAdd .input');
	let goodDateAdd = tr.querySelector('td.date').innerText;
	editDateAdd.innerText = goodDateAdd;
	
	let goodType = tdData.dataset.goodType;
	let editGoodType = editing.querySelector('.editGoodType .input #good_type');	
	editGoodType.value = goodType;
	
	function goodTypeInputing() {
		let goodType = editing.querySelector('.editGoodName .input span.goodType');
		goodType.innerText = this.value;
	}
	
	editGoodType.addEventListener('input', goodTypeInputing, false);
	
	let goodBrand = tdData.dataset.goodBrand;
	let editGoodBrand = editing.querySelector('.editGoodBrand .input #good_brand');	
	editGoodBrand.value = goodBrand;
	
	function goodBrandInputing() {
		let goodBrand = editing.querySelector('.editGoodName .input span.goodBrand');
		goodBrand.innerText = this.value;
	}
	
	editGoodBrand.addEventListener('input', goodBrandInputing, false);
	
	let goodModel = tdData.dataset.goodModel;
	let editGoodModel = editing.querySelector('.editGoodModel .input #good_model');	
	editGoodModel.value = goodModel;
	
	
	function goodModelInputing() {
		let goodModel = editing.querySelector('.editGoodName .input span.goodModel');
		goodModel.innerText = this.value;
	}
	
	editGoodModel.addEventListener('input', goodModelInputing, false);
	
	let goodName = "<span class = \"goodType\">" + goodType + "</span> <span class = \"goodBrand\">" + goodBrand + "</span> <span class = \"goodModel\">" + goodModel + "</span>";
	let editGoodName = editing.querySelector('.editGoodName .input');	
	editGoodName.innerHTML = goodName;
	
	let goodPage = document.querySelector('.good_page');
	goodPage.innerHTML = goodType + goodBrand + goodModel;
	goodPage.setAttribute('href', 'https://saterno.ru/' + tdData.dataset.goodBrandUrl + '/' + tdData.dataset.goodUrl);
	
	let photos = tdData.dataset.goodPhotos.split(',');
	let photosSrc = [];
	let photosSrcWithEmpty = [];
	
	let editPhoto = document.querySelector(' .editing_good .editPhoto .input');
	
	editPhoto.innerHTML = "";
	
	for(let img of photos) {
		if(img.length > 0) {
			let srcAndOrder = img.split('|');
			photosSrcWithEmpty[srcAndOrder[1]-1] = srcAndOrder[0];
		}
	}
	
	for(let i = 0; i < photosSrcWithEmpty.length; i++) {
		if(photosSrcWithEmpty[i] !== undefined) {
			photosSrc.push(photosSrcWithEmpty[i]);
		}
	}
	
	for(let src of photosSrc) {
		let newImg = document.createElement('img');
		newImg.src = src;
		newImg.style.width = "50px";
		newImg.style.height = "50px";
		
		let buttonDeleteImg = document.createElement('div');
		buttonDeleteImg.className = "buttonDeleteImg";
		
		let newDiv = document.createElement('div');
		newDiv.append(newImg);
		newDiv.append(buttonDeleteImg);
		editPhoto.append(newDiv);
	}
	
	let editPhotoPhotos = editPhoto.querySelectorAll('img');
	
	for(let i = editPhotoPhotos.length-1; i >= 0; i--) {
		editPhotoPhotos[i].style.position = 'absolute';
		editPhotoPhotos[i].style.zIndex = 92;
		let left = i*55; //window.getComputedStyle(editPhotoPhotos[i]).getPropertyValue("left");
		editPhotoPhotos[i].style.left = left + "px";
		
		let buttonForDeleteImg = editPhotoPhotos[i].parentNode.querySelector('.buttonDeleteImg');
		let buttonForDeleteImgLeft = left + 34;		
		buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
		
		buttonForDeleteImg.addEventListener('click', deleteGoodImg, false);
		
		editPhotoPhotos[i].addEventListener('mousedown', editPhotoMouseDown, false);
		editPhotoPhotos[i].addEventListener('touchmove', editPhotoMouseDown, false);
		editPhotoPhotos[i].addEventListener('dragstart', editPhotoDragStart, false);
	}
	
	/// SVG Open Editor Photos
	let xmlns = "http://www.w3.org/2000/svg";
	
	let buttonEditImages = document.createElementNS(xmlns, "svg");	
	buttonEditImages.setAttribute("width", "20px");
	buttonEditImages.setAttribute("height", "20px");
	buttonEditImages.setAttribute("title", "change");
	buttonEditImages.className = "version=\"1.1\"";
	buttonEditImages.setAttribute("xmlns:xlink", "http://www.w3.org/1999/xlink");	
	buttonEditImages.setAttribute("x", "0px");
	buttonEditImages.setAttribute("y", "0px");
	buttonEditImages.setAttribute("viewBox", "0 0 1000 1000");
	buttonEditImages.setAttribute("enable-background", "new 0 0 1000 1000");
	buttonEditImages.setAttribute("xml:space", "preserve");
	
	let g = document.createElementNS(xmlns, "g");
    buttonEditImages.appendChild(g);
	
	let coords = "M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z";
	
	let path = document.createElementNS(xmlns, "path");
	path.setAttributeNS(null, 'd', coords);
	g.appendChild(path);
	
	editPhoto.append(buttonEditImages);
	
	let buttonEditImagesLeft;
	
	if(editPhotoPhotos.length > 0) {	
		buttonEditImagesLeft = 55 + Number(window.getComputedStyle(editPhotoPhotos[editPhotoPhotos.length - 1]).getPropertyValue("left").replace('px', ''));
	} else {
		buttonEditImagesLeft = 0;
	}

	buttonEditImages.style.left = buttonEditImagesLeft + "px";
	buttonEditImages.addEventListener('click', openEditorImages, false);
	
	function openEditorImages() {
		event.stopImmediatePropagation();
		
		let modalPhotos = document.querySelector('.toggleModal1');
		let modalPhotosRow = modalPhotos.querySelector('.modal__block .modalBody .rowImages');
		modalPhotosRow.innerHTML = "";
		
		let editPhotoPhotos = editPhoto.querySelectorAll('img');
		
		for(let photo of editPhotoPhotos) {
			let divCart = document.createElement('div');
			divCart.className = 'imageCart';
			
			let hoverForSelect = document.createElement('div');
			hoverForSelect.className = 'hoverForSelect notSelect';
			
			let selectImages = document.createElement('div');
			selectImages.className = 'selectImages';
			selectImages.innerHTML = '<div class="item"><div class="galka"></div></div>';
			
			let src = photo.src;
			
			let img = document.createElement('img');
			img.src = src;
			img.className = "avatarImages";
			img.dataset.filename = src.substring(src.lastIndexOf('/')+1).replace(/_150x150(?!.*_150x150)/,'');
			
			hoverForSelect.append(selectImages);
			hoverForSelect.append(img);
			divCart.append(hoverForSelect);
			
			modalPhotosRow.append(divCart);
		}
		
		launchImagesPopUp();
		toggleModalBlock(1, 1);
	}

	let paragraphWithWarning = document.createElement('p');
	paragraphWithWarning.style.position = 'absolute';
	paragraphWithWarning.style.width = '550px';
	paragraphWithWarning.style.top = '60px';
	paragraphWithWarning.innerHTML = "Все изменения с фотографиями<br>(их удаление, изменение порядка, загрузка новых изображений)<br>сохраняются сразу же и отменить их нельзя!";
	
	editPhoto.append(paragraphWithWarning);
	let divEditPhoto = document.querySelector(' .editing_good .editPhoto');
	divEditPhoto.style.paddingBottom = '80px';
	
	let editGoodDesc = editing.querySelector('#good_description');
	let goodDesc = tdData.dataset.goodDescription;
	editGoodDesc.value = goodDesc;
	
	let editGoodURL = editing.querySelector('.input #good_url');
	let goodURL = tdData.dataset.goodUrl;
	editGoodURL.value = goodURL;
	let labelGoodUrl = editing.querySelector('label[for="good_url"]');
	labelGoodUrl.classList.remove('error');
	labelGoodUrl.classList.remove('notAvailble');
	labelGoodUrl.classList.remove('needMore');
	labelGoodUrl.classList.remove('falseSimbols');
	
	let isFirstInputUrl = true;
		
	if(isFirstLaunchEditingGood) {
		//editShopName.addEventListener('blur', checkIsAvailableShopName, false);
		//editShopName.addEventListener('input', inputShopName, false);
	
		editGoodURL.addEventListener('input', inputURL, false);
		editGoodURL.addEventListener('blur', checkIsAvailableURL, false);
	} else {		
		editGoodURL.removeEventListener('input', inputURL, false);
		editGoodURL.removeEventListener('blur', checkIsAvailableURL, false);
		
		editGoodURL.addEventListener('input', inputURL, false);
		editGoodURL.addEventListener('blur', checkIsAvailableURL, false);
	}
	
	function beforeInputUrl() {
		isFirstInputUrl = false;
		
		let buttonForInputUrl = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');
		buttonForInputUrl.removeEventListener('click', beforeInputUrl);
	}
	
	function inputURL() {
		if(isFirstInputUrl) {
			this.value = goodURL;
			
			let errorMessage = document.querySelector('.modalBlock.error.warning .modalBody > div:not([class])');
			errorMessage.innerHTML = "<p>Вы действительно хотите изменить ссылку на этот товар?";
			
			let buttonForInputUrl = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');
			buttonForInputUrl.addEventListener('click', beforeInputUrl, false);
			
			toggleModalBlock(6, 1);
		} else {
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
			isCheckedGoodURL = 0;
		}
	}

	let editGoodPrice = editing.querySelector('.editPrice .input .good_system_price');
	let goodPrice = tdData.dataset.goodSystemPrice;
	editGoodPrice.innerHTML = goodPrice;
	
	let editGoodSellerPrice = editing.querySelector('.input #good_seller_price');
	let goodSellerPrice = tdData.dataset.goodSellerPrice;
	editGoodSellerPrice.value = goodSellerPrice;
	
	function changeSystemPrice() {
		if(this.value.match(/[^ ,.0-9]/g)) {
			let pos = this.value.indexOf(this.value.match(/[^ ,0-9]/g));
			
			if(pos > 0) {
				this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
			} else if(pos == 0) {
				this.value = this.value.substring(1);
			}
		}
		if(this.value.split(",").length - 1 > 0) {
			if(this.value.split(",").length - 1 > 1) {
				let pos = this.value.indexOf(",");
				if(pos > 0) {
					this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
				} else if(pos == 0) {
					this.value = this.value.substring(1);
				}
			}
			let pos = this.value.indexOf(".");
			if(pos > 0) {
				this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
			} else if(pos == 0) {
				this.value = this.value.substring(1);
			}
			pos = this.value.indexOf(",");
			if(pos == 0) {
				this.value = this.value.substring(1);
			}
		} else if(this.value.split(".").length - 1 > 0) {
			if(this.value.split(".").length - 1 > 1) {
				let pos = this.value.indexOf(".");
				if(pos > 0) {
					this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
				} else if(pos == 0) {
					this.value = this.value.substring(1);
				}
			}
			let pos = this.value.indexOf(",");
			if(pos > 0) {
				this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
			} else if(pos == 0) {
				this.value = this.value.substring(1);
			}
			pos = this.value.indexOf(".");
			if(pos == 0) {
				this.value = this.value.substring(1);
			}
		}
		
		let number = this.value;
		
		number = number * 12;
		number = Math.ceil(number / 10);
		
		editGoodPrice.innerHTML = number;
	}
	
	editGoodSellerPrice.addEventListener('input', changeSystemPrice, false);
	
	let editGoodQuentity = editing.querySelector('.editQuentity .input #good_all_quentity');
	let goodQuantity = tdData.dataset.goodQuantity;
	editGoodQuentity.value = goodQuantity;
	
	let editGoodSoldQuentity = editing.querySelector('.editQuentity .input #good_sold_quentity');
	let goodSoldQuentity = tdData.dataset.goodOrderquantity;
	editGoodSoldQuentity.value = goodSoldQuentity;
	
	let editGoodInStock = editing.querySelector('.editInStock .input');
	let titleGoodInStock = editGoodInStock.querySelector('.isShow');
	
	let goodInStock = tdData.dataset.goodInstock;
	if(goodInStock == '0') {
		titleGoodInStock.innerText = "Нет в наличии";
		if(editGoodInStock.querySelector('label') == undefined) {
			editGoodInStock.innerHTML += "<label class=\"switch\">\
										  <input type=\"checkbox\">\
										  <span class=\"slider round\"></span>\
										</label>";
		} else {
			editGoodInStock.querySelector('label').innerHTML = '<input type=\"checkbox\"><span class=\"slider round\"></span>';
		}
	} else {
		titleGoodInStock.innerText = "Есть в наличии";
		if(editGoodInStock.querySelector('label') == undefined) {
			editGoodInStock.innerHTML += "<label class=\"switch\">\
										  <input type=\"checkbox\" checked>\
										  <span class=\"slider round\"></span>\
										</label>";
		} else {
			editGoodInStock.querySelector('label').innerHTML = '<input type=\"checkbox\" checked><span class=\"slider round\"></span>';
		}
	}
	
	editGoodInStock.querySelector('label.switch').addEventListener('change', function() {
		titleGoodInStock = event.path[2].querySelector('.isShow');
		if(event.path[0].checked) {
			titleGoodInStock.innerText = "Есть в наличии";
		}else {
			titleGoodInStock.innerText = "Нет в наличии";
		}
	}, false);
	
	let editGoodLength = editing.querySelector('.editSize .input #good_length');
	let goodLength = tdData.dataset.goodLength;
	editGoodLength.value = goodLength;
	
	let editGoodWidth = editing.querySelector('.editSize .input #good_width');
	let goodWidth = tdData.dataset.goodWidth;
	editGoodWidth.value = goodWidth;
	
	let editGoodHeight = editing.querySelector('.editSize .input #good_height');
	let goodHeight = tdData.dataset.goodHeight;
	editGoodHeight.value = goodHeight;
	
	let editGoodWeight = editing.querySelector('.editGoodWeight .input #good_weight');
	let goodWeight = tdData.dataset.goodWeight;
	editGoodWeight.value = goodWeight;
	
	let strStockrooms = tdData.dataset.stockrooms;
	
	let arrStockrooms = [];
	let arrStockroomsWithEmpty = strStockrooms.split("|");
	
	for(let stock of arrStockroomsWithEmpty) {
		if(stock != "") {
			arrStockrooms.push(stock);
		}
	}
	
	let editStock = editing.querySelector('.editStock .input #good_stock');
	editStock.innerHTML = '<option value="" disabled="">Выберите склад</option>';
	let stockId	= tdData.dataset.goodStockroom;
	
	for(let stock of arrStockrooms) {
		let stockOption = document.createElement('option');
		
		let thisStockId = stock.split(',')[0];
		stockOption.setAttribute('value', thisStockId);
		stockOption.innerText = stock.substring(stock.indexOf(',')+1);
		if(thisStockId == stockId) {
			stockOption.setAttribute('selected', 'selected');
		}
		
		editStock.append(stockOption);
	}
	
	let strAllCategories = tdData.parentNode.parentNode.dataset.allCategories;
	let arrAllCategoriesWithEmpty = strAllCategories.split('|');
	
	let mainCategoryId = tdData.dataset.goodCategoryid;
	
	let editCategory = editing.querySelector('.editCategories .input .main_category');
	let goodCategory = document.createElement('span');
	goodCategory.innerHTML = tdData.dataset.goodCategory;
	goodCategory.setAttribute('value', mainCategoryId);
	
	editCategory.innerHTML = '<svg width="15px" height="15px" title="change" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve"><g><path d="M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z"></path></g></svg>';
	let newSvgEditCategory = editCategory.querySelector('svg');
	
	editCategory.prepend(goodCategory);
	
	let toggleClickEditCategory = true;
	newSvgEditCategory.addEventListener('click', editMainCategory, false);
	
	function editMainCategory() {
		if(toggleClickEditCategory) {
			editCategory.innerHTML = '<svg width=\"15px\" height=\"15px\" fill=\"#000\" title=\"change\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" viewBox=\"0 -256 1792 1792\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
											<g transform=\"matrix(1,0,0,-1,129.08475,1270.2373)\">\
												<path d=\"m 384,0 h 768 V 384 H 384 V 0 z m 896,0 h 128 v 896 q 0,14 -10,38.5 -10,24.5 -20,34.5 l -281,281 q -10,10 -34,20 -24,10 -39,10 V 864 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 v 416 H 128 V 0 h 128 v 416 q 0,40 28,68 28,28 68,28 h 832 q 40,0 68,-28 28,-28 28,-68 V 0 z M 896,928 v 320 q 0,13 -9.5,22.5 -9.5,9.5 -22.5,9.5 H 672 q -13,0 -22.5,-9.5 Q 640,1261 640,1248 V 928 q 0,-13 9.5,-22.5 Q 659,896 672,896 h 192 q 13,0 22.5,9.5 9.5,9.5 9.5,22.5 z m 640,-32 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 96 q -40,0 -68,28 -28,28 -28,68 v 1344 q 0,40 28,68 28,28 68,28 h 928 q 40,0 88,-20 48,-20 76,-48 l 280,-280 q 28,-28 48,-76 20,-48 20,-88 z\"></path>\
											</g>\
										</svg>';
			if(editCategories.querySelector('li') != undefined) {
				let leftNewSvgEditCategory = 45 + Number(window.getComputedStyle(editCategories.querySelector('li')).getPropertyValue("width").replace('px', ''));
				editCategory.querySelector('svg').style.left = leftNewSvgEditCategory + "px";
				console.log(leftNewSvgEditCategory);
			} else {
				let leftNewSvgEditCategory = 31 + Number(window.getComputedStyle(editCategory).getPropertyValue("width").replace('px', ''));
				editCategory.querySelector('svg').style.left = leftNewSvgEditCategory + "px";
			}
			
			editCategory.querySelector('svg').addEventListener('click', editMainCategory, false);
			
			let selectAllCategories = document.createElement('select')
			
			for(let category of arrAllCategoriesWithEmpty) {
				if(category != "") {
					let optionCategory = document.createElement('option');
		
					let thisCategoryId = category.split(',')[0];
					optionCategory.setAttribute('value', thisCategoryId);
					optionCategory.innerText = category.substring(category.indexOf(',')+1);
					if(thisCategoryId == mainCategoryId) {
						optionCategory.setAttribute('selected', 'selected');
						selectAllCategories.prepend(optionCategory);
					} else {
						selectAllCategories.append(optionCategory);
					}
				}
			}
			
			editCategory.prepend(selectAllCategories);
			
			toggleClickEditCategory = false;
		} else {
			let selectedOption = editCategory.querySelector('option:checked');
			
			mainCategoryId = selectedOption.getAttribute('value');
			
			let goodCategory = document.createElement('span');
			goodCategory.innerHTML = selectedOption.innerText;
			goodCategory.setAttribute('value', mainCategoryId);
			
			editCategory.innerHTML = '<svg width="15px" height="15px" title="change" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve"><g><path d="M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z"></path></g></svg>';
			let newSvgEditCategory = editCategory.querySelector('svg');
			
			editCategory.prepend(goodCategory);
			
			
			
			if(editCategories.querySelector('li') != undefined) {
				let leftNewSvgEditCategory = 45 + Number(window.getComputedStyle(editCategories.querySelector('li')).getPropertyValue("width").replace('px', ''));
				newSvgEditCategory.style.left = leftNewSvgEditCategory + "px";
			} else {
				let leftNewSvgEditCategory = 31 + Number(window.getComputedStyle(editCategory).getPropertyValue("width").replace('px', ''));
				newSvgEditCategory.style.left = leftNewSvgEditCategory + "px";
			}
			
			newSvgEditCategory.addEventListener('click', editMainCategory, false);
			
			toggleClickEditCategory = true;
		}
	}
	
	let editCategories = editing.querySelector('.editCategories .input ul');
	let strGoodCategories = tdData.dataset.goodCategories;
	let arrGoodCategoriesWithEmpty = strGoodCategories.split('|');
	editCategories.innerHTML = "";
	
	let valueCategories = [];
	
	for(let i = 0; i < arrGoodCategoriesWithEmpty.length; i++) {
		let category = arrGoodCategoriesWithEmpty[i];
		if(category != "") {		
			let newCategory = document.createElement('span');			
			let thisCategoryId = category.split(',')[0];
			newCategory.setAttribute('value', thisCategoryId);
			newCategory.innerText = category.substring(category.indexOf(',')+1);
			
			let newLi = document.createElement('li');
			newLi.setAttribute('value', i);
			newLi.append(newCategory);
			
			editCategories.append(newLi);
		}
	}
	
	let liGoodCategories = editCategories.querySelectorAll('li');
	
	toggleClickEditCategories = [];
	
	for(let i = 0; i < liGoodCategories.length; i++) {
		let li = liGoodCategories[i];
		
		li.innerHTML += "<svg width=\"15px\" height=\"15px\" title=\"change\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\"><g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g></svg>";
		let svg = li.querySelector('svg');
		
		let left = 45 + Number(window.getComputedStyle(li).getPropertyValue("width").replace('px', ''));
		svg.style.left = left + "px";
	}
	
	for(let i = 0; i < liGoodCategories.length; i++) {
		let svg = editCategories.querySelectorAll('li')[i].querySelector('svg');
		
		toggleClickEditCategories.push(true);		
		svg.addEventListener('click', {handleEvent: editMainCategories, i: i}, false);
	}
	
	
	let buttonAddNewCategory = editing.querySelector('.editCategories .input > svg');	
	buttonAddNewCategory.addEventListener('click', addNewCategory, false);
	
	let leftNewSvgEditCategories;
	
	if(liGoodCategories[0] != undefined) {
		leftNewSvgEditCategories = 30 + Number(window.getComputedStyle(liGoodCategories[0]).getPropertyValue("width").replace('px', ''));
		newSvgEditCategory.style.left = 15 + leftNewSvgEditCategories + "px";
		
		buttonAddNewCategory.style.left = 15 + leftNewSvgEditCategories + "px";
	}
		
	let mainCategoriesId;
	
	function editMainCategories() {
		let i = this.i;
		
		console.log(toggleClickEditCategories);
		console.log(toggleClickEditCategories[i] + " " + i);
		
		let editCategory = editing.querySelector('.editCategories .input ul li[value="' + i + '"]');
		
		if(typeof(leftNewSvgEditCategories) == "undefined") {
			leftNewSvgEditCategories = Number(window.getComputedStyle(editCategories).getPropertyValue("width").replace('px', ''));
			console.log(leftNewSvgEditCategories);
		}
		
		if(toggleClickEditCategories[i]) {
			let spanCategory = editCategory.querySelector('span');
			mainCategoriesId = spanCategory.getAttribute('value');
			
			editCategory.innerHTML = '<svg width=\"15px\" height=\"15px\" fill=\"#000\" title=\"change\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" viewBox=\"0 -256 1792 1792\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
											<g transform=\"matrix(1,0,0,-1,129.08475,1270.2373)\">\
												<path d=\"m 384,0 h 768 V 384 H 384 V 0 z m 896,0 h 128 v 896 q 0,14 -10,38.5 -10,24.5 -20,34.5 l -281,281 q -10,10 -34,20 -24,10 -39,10 V 864 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 v 416 H 128 V 0 h 128 v 416 q 0,40 28,68 28,28 68,28 h 832 q 40,0 68,-28 28,-28 28,-68 V 0 z M 896,928 v 320 q 0,13 -9.5,22.5 -9.5,9.5 -22.5,9.5 H 672 q -13,0 -22.5,-9.5 Q 640,1261 640,1248 V 928 q 0,-13 9.5,-22.5 Q 659,896 672,896 h 192 q 13,0 22.5,9.5 9.5,9.5 9.5,22.5 z m 640,-32 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 96 q -40,0 -68,28 -28,28 -28,68 v 1344 q 0,40 28,68 28,28 68,28 h 928 q 40,0 88,-20 48,-20 76,-48 l 280,-280 q 28,-28 48,-76 20,-48 20,-88 z\"></path>\
											</g>\
										</svg>';
			
			editCategory.innerHTML += '<svg width=\"15px\" height=\"15px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\"><g transform="translate(0.000000,225.000000) scale(0.100000,-0.100000)" stroke="none"><path d="M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z"></path><path d="M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z"></path><path d="M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z"></path><path d="M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z"></path></g></svg>';
			
			let svgSave = editCategory.querySelectorAll('svg')[0];
			svgSave.addEventListener('click', {handleEvent: editMainCategories, i: i}, false);
			svgSave.style.left = 15 + leftNewSvgEditCategories + "px";
			
			
			let newSvgDeleteCategory = editCategory.querySelectorAll('svg')[1];
			newSvgDeleteCategory.style.left = 35 + leftNewSvgEditCategories + "px";
			newSvgDeleteCategory.addEventListener('click', {handleEvent: dropCategories, i: i}, false);			
			
			let selectAllCategories = document.createElement('select');
			
			for(let category of arrAllCategoriesWithEmpty) {
				if(category != "") {
					let optionCategory = document.createElement('option');
		
					let thisCategoryId = category.split(',')[0];
					optionCategory.setAttribute('value', thisCategoryId);
					optionCategory.innerText = category.substring(category.indexOf(',')+1);
					if(thisCategoryId == mainCategoriesId) {
						optionCategory.setAttribute('selected', 'selected');
						selectAllCategories.prepend(optionCategory);
					} else {
						selectAllCategories.append(optionCategory);
					}
				}
			}
			
			editCategory.prepend(selectAllCategories);
			
			toggleClickEditCategories[i] = false;
		} else {
			let selectedOption = editCategory.querySelector('option:checked');
			
			mainCategoriesId = selectedOption.getAttribute('value');
			
			let goodCategory = document.createElement('span');
			
			goodCategory.innerHTML = selectedOption.innerText;
			goodCategory.setAttribute('value', mainCategoriesId);
			
			editCategory.innerHTML = '<svg width="15px" height="15px" title="change" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve"><g><path d="M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z"></path></g></svg>';
			let newSvgEditCategory = editCategory.querySelector('svg');
			
			editCategory.prepend(goodCategory);
			
			let leftNewSvgEditCategory = 15 + leftNewSvgEditCategories;
			newSvgEditCategory.style.left = leftNewSvgEditCategory + "px";
			
			newSvgEditCategory.addEventListener('click', {handleEvent: editMainCategories, i: i}, false);
			
			toggleClickEditCategories[i] = true;
		}
	}
	
	function dropCategories() {
		let i = this.i;
		
		let li = editing.querySelector('.editCategories .input ul li[value="' + i + '"]');
		li.remove();
		
		divEditCategories.style.paddingBottom = -21 +  Number(window.getComputedStyle(divEditCategories).getPropertyValue("padding-bottom").replace('px', '')) + "px";
	}
	
	function addNewCategory() {
		event.stopImmediatePropagation();
		
		let lastLi = editing.querySelector('.editCategories .input ul li:last-child');
		
		let i;
		
		if(lastLi !== null) {
			i = Number(lastLi.getAttribute('value'))+1;
		} else {
			i = 0;
		}		
		
		let newLi = document.createElement('li');
		newLi.setAttribute('value', i);
		
		newLi.innerHTML = '<svg width=\"15px\" height=\"15px\" fill=\"#000\" title=\"change\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" viewBox=\"0 -256 1792 1792\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
										<g transform=\"matrix(1,0,0,-1,129.08475,1270.2373)\">\
											<path d=\"m 384,0 h 768 V 384 H 384 V 0 z m 896,0 h 128 v 896 q 0,14 -10,38.5 -10,24.5 -20,34.5 l -281,281 q -10,10 -34,20 -24,10 -39,10 V 864 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 v 416 H 128 V 0 h 128 v 416 q 0,40 28,68 28,28 68,28 h 832 q 40,0 68,-28 28,-28 28,-68 V 0 z M 896,928 v 320 q 0,13 -9.5,22.5 -9.5,9.5 -22.5,9.5 H 672 q -13,0 -22.5,-9.5 Q 640,1261 640,1248 V 928 q 0,-13 9.5,-22.5 Q 659,896 672,896 h 192 q 13,0 22.5,9.5 9.5,9.5 9.5,22.5 z m 640,-32 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 96 q -40,0 -68,28 -28,28 -28,68 v 1344 q 0,40 28,68 28,28 68,28 h 928 q 40,0 88,-20 48,-20 76,-48 l 280,-280 q 28,-28 48,-76 20,-48 20,-88 z\"></path>\
										</g>\
									</svg>'
		
		newLi.innerHTML += '<svg width=\"15px\" height=\"15px\" title=\"change\" class=version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\"><g transform="translate(0.000000,225.000000) scale(0.100000,-0.100000)" stroke="none"><path d="M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z"></path><path d="M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z"></path><path d="M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z"></path><path d="M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z"></path></g></svg>';
				
		let selectAllCategories = document.createElement('select');
				
		for(let category of arrAllCategoriesWithEmpty) {
			if(category != "") {
				let optionCategory = document.createElement('option');
	
				let thisCategoryId = category.split(',')[0];
				optionCategory.setAttribute('value', thisCategoryId);
				optionCategory.innerText = category.substring(category.indexOf(',')+1);
				selectAllCategories.append(optionCategory);
			}
		}
		
		newLi.prepend(selectAllCategories);
		editCategories.append(newLi);
		
		let svgSave = newLi.querySelectorAll('svg')[0];
		svgSave.addEventListener('click', {handleEvent: editMainCategories, i: i}, false);
		
		let newSvgDeleteCategory = newLi.querySelectorAll('svg')[1];
		newSvgDeleteCategory.addEventListener('click', {handleEvent: dropCategories, i: i}, false);
		
		if(typeof(leftNewSvgEditCategories) != "undefined") {
			newSvgDeleteCategory.style.left = 35 + leftNewSvgEditCategories + "px";
			svgSave.style.left = 15 + leftNewSvgEditCategories + "px";
			
			console.log(leftNewSvgEditCategories);
		} else {
			let leftNewSvgEditCategories = Number(window.getComputedStyle(editCategories).getPropertyValue("width").replace('px', ''));
			
			newSvgDeleteCategory.style.left = 35 + leftNewSvgEditCategories + "px";
			svgSave.style.left = 15 + leftNewSvgEditCategories + "px";
			
			console.log(leftNewSvgEditCategories);
		}
		
		divEditCategories.style.paddingBottom = 21 +  Number(window.getComputedStyle(divEditCategories).getPropertyValue("padding-bottom").replace('px', '')) + "px";
	}
	
	let newEditCategoriesPaddingBottom = 10 + editCategoriesPaddingBottom + ((arrGoodCategoriesWithEmpty.length - 1) * 18);	
	divEditCategories.style.paddingBottom = newEditCategoriesPaddingBottom + "px";
	
	editAtributes.innerHTML = atributesHtml;
	divEditAtributes.style.paddingBottom = "35px";
	
	let buttonAddNewAttribute = divEditAtributes.querySelector('svg.addNewAtribute');	
	buttonAddNewAttribute.addEventListener('click', addNewAtribute, false);
	
	let buttonDeleteAttribute = editAtributes.querySelector('.atribut svg.deleteAtribute');
	buttonDeleteAttribute.addEventListener('click', deleteFirstAtribute, false);
	
	let buttonAddAttributeValue = editAtributes.querySelector('.atribut .values + svg');
	buttonAddAttributeValue.addEventListener('click', addAtributeValue, false);
	
	function addAtributeValue() {		
		event.stopImmediatePropagation();
		
		let divValues = this.parentNode.querySelector('.values');
		
		let newDiv = document.createElement('div');
		let newInputValue = document.createElement('input');
		newInputValue.setAttribute('type', 'text');
		newInputValue.setAttribute('placeholder', 'Введите значение...');
		
		let newButtonLeft = 40 + Number(window.getComputedStyle(divEditAtributes).getPropertyValue("padding-bottom").replace('px', ''));
		divEditAtributes.style.paddingBottom = newButtonLeft + "px";
		
		newDiv.append(newInputValue);
		newDiv.innerHTML += "<div class=\"add-icon\">Добавить иконку</div>\
							<svg class=\"deleteAtribute\" fill=\"000\" width=\"14\" height=\"14\" viewBox=\"0 0 14 14\" xmlns=\"http://www.w3.org/2000/svg\">\
								<path d=\"M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z\" fill-rule=\"evenodd\"></path>\
							</svg>";
		
		divValues.append(newDiv);
		
		let n = this.parentNode.querySelectorAll('.values > div').length;
				
		let buttonDeleteAttributeValue = this.parentNode.querySelectorAll('.values > div')[n-1].querySelector('svg');		
		buttonDeleteAttributeValue.addEventListener('click', deletetAtributeValue, false);
		
		let buttonAddIconToAttribute = this.parentNode.querySelectorAll('.values > div')[n-1].querySelector('.add-icon');
		buttonAddIconToAttribute.addEventListener('click', addIconToAttribute, false);
	}
	
	function deletetAtributeValue() {
		event.stopImmediatePropagation();
		
		let newButtonLeft = -40 + Number(window.getComputedStyle(divEditAtributes).getPropertyValue("padding-bottom").replace('px', ''));
		divEditAtributes.style.paddingBottom = newButtonLeft + "px";
		
		this.parentNode.remove();
	}	
	
	function deleteFirstAtribute() {
		event.stopImmediatePropagation();
		
		let inputes = this.parentNode.querySelectorAll('input');
		inputes[0].value="";
		inputes[1].value="";
		
		let valueDivs = this.parentNode.querySelectorAll('.values > div');
		
		for(let i = 1; i < valueDivs.length; i++) {
			if(valueDivs[i] != undefined) {				
				let newButtonLeft = -40 + Number(window.getComputedStyle(divEditAtributes).getPropertyValue("padding-bottom").replace('px', ''));
				divEditAtributes.style.paddingBottom = newButtonLeft + "px";
				
				valueDivs[i].remove();
			}
		}
		
		let divIcon = this.parentNode.querySelector('.add-icon').parentNode;
		
		let newDiv = document.createElement('div');
		newDiv.className = "add-icon";
		newDiv.innerText = "Добавить иконку";
		
		if(divIcon.className == 'container') {
			divIcon.after(newDiv);
			divIcon.remove();
		
			newDiv.addEventListener('click', addIconToAttribute, false);
		}
		
		console.log(divIcon);
	}
	
	function deleteAtribute() {
		event.stopImmediatePropagation();
		
		let n = divEditAtributes.querySelectorAll('.atribut').length;
		if(n == 1) {
			let inputes = this.parentNode.querySelectorAll('input');
			inputes[0].value="";
			inputes[1].value="";
			
			let valueDivs = this.parentNode.querySelectorAll('.values > div');
			
			for(let i = 0; i < valueDivs.length; i++) {
				if(valueDivs[i] != undefined) {				
					let newButtonLeft = -40 + Number(window.getComputedStyle(divEditAtributes).getPropertyValue("padding-bottom").replace('px', ''));
					divEditAtributes.style.paddingBottom = newButtonLeft + "px";
					
					valueDivs[i].remove();
				}
			}
			
			let divIcon = this.parentNode.querySelector('.add-icon').parentNode;
			
			let newDiv = document.createElement('div');
			newDiv.className = "add-icon";
			newDiv.innerText = "Добавить иконку";
			
			if(divIcon.className == 'container') {
				divIcon.after(newDiv);
				divIcon.remove();
			
				newDiv.addEventListener('click', addIconToAttribute, false);
			}
		} else {
			let newButtonLeft = -41.5 + Number(window.getComputedStyle(divEditAtributes).getPropertyValue("padding-bottom").replace('px', ''));
			divEditAtributes.style.paddingBottom = newButtonLeft + "px";
			
			let valueDivs = this.parentNode.querySelectorAll('.values > div');

			for(let i = 0; i < valueDivs.length; i++) {
				if(valueDivs[i] != undefined) {				
					let newButtonLeft = -40 + Number(window.getComputedStyle(divEditAtributes).getPropertyValue("padding-bottom").replace('px', ''));
					divEditAtributes.style.paddingBottom = newButtonLeft + "px";
					
					valueDivs[i].remove();
				}
			}
			
			this.parentNode.remove();
		}		
	}
		
	function addNewAtribute() {
		event.stopImmediatePropagation();
		
		let newDiv = document.createElement('div');
		newDiv.className = "atribut";
		
		newDiv.innerHTML = "<input type=\"text\" placeholder=\"Введите название...\">\
							<div class=\"values\">\
								<input type=\"text\" placeholder=\"Введите значение...\">\
							</div>\
							<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" width=\"20\" height=\"20\" viewBox=\"0 0 510 510\" enable-background=\"new 0 0 510 510\" xml:space=\"preserve\">\
								<g><g id=\"unknown-3\"><path d=\"M280.5,153h-51v76.5H153v51h76.5V357h51v-76.5H357v-51h-76.5V153z M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255 s255-114.75,255-255S395.25,0,255,0z M255,459c-112.2,0-204-91.8-204-204S142.8,51,255,51s204,91.8,204,204S367.2,459,255,459z\"></path></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>\
							</svg>\
							<div class=\"add-icon\">Добавить иконку</div>\
							<svg class=\"deleteAtribute\" fill=\"000\" width=\"14\" height=\"14\" viewBox=\"0 0 14 14\" xmlns=\"http://www.w3.org/2000/svg\">\
								<path d=\"M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z\" fill-rule=\"evenodd\"></path>\
							</svg>";
		
		editAtributes.append(newDiv);
		
		let n = editAtributes.querySelectorAll('.atribut').length;
		
		let buttonDeleteAttribute = editAtributes.querySelectorAll('.atribut')[n-1].querySelector('svg.deleteAtribute');
		buttonDeleteAttribute.addEventListener('click', deleteAtribute, false);
		
		let buttonAddAttributeValue = editAtributes.querySelectorAll('.atribut')[n-1].querySelector('.values + svg');
		buttonAddAttributeValue.addEventListener('click', addAtributeValue, false);
		
		let buttonAddIconToAttribute = editAtributes.querySelectorAll('.atribut')[n-1].querySelector('.add-icon');
		buttonAddIconToAttribute.addEventListener('click', addIconToAttribute, false);
		
		let newButtonLeft = 41.5 + Number(window.getComputedStyle(divEditAtributes).getPropertyValue("padding-bottom").replace('px', ''));
		divEditAtributes.style.paddingBottom = newButtonLeft + "px";
	}
	
	let buttonAddIconToAttribute = editAtributes.querySelector('.atribut .add-icon');
	buttonAddIconToAttribute.addEventListener('click', addIconToAttribute, false);
	
	function addIconToAttribute() {
		event.stopImmediatePropagation();
		
		let modalPhotos = document.querySelector('.toggleModal2');
		let modalPhotosRow = modalPhotos.querySelector('.modal__block .modalBody .rowImages');
		modalPhotosRow.innerHTML = "";
		
		if(isFirstLaunching) {
			changeDivIcon(this);
			
			launchIconsPopUp();
			
			isFirstLaunching = false;
		} else {
			changeDivIcon(this);
		}
		
		
		toggleModalBlock(2, 1);
	}
	
	function addImg(divIcon, src) {
		src = src.substring(0, src.lastIndexOf('.')) + '_150x150' + src.substring(src.lastIndexOf('.'));
		src = "App/templates/files/img/product-attributes/" + src;
				
		let newImg = document.createElement('img');
		newImg.src = src;
		newImg.style.width = "25px";
		newImg.style.height = "25px";
		newImg.style.borderRadius = "4px";
		
		let newDiv = document.createElement('div');
		newDiv.className = "add-icon notAddingIcon";
		newDiv.style.padding = "3px";
		newDiv.style.height = "35px";
		newDiv.style.width = "35px";
		newDiv.style.borderRadius = "8px";
		newDiv.style.position = "absolute";
		newDiv.style.bottom = "-12px";
		
		newDiv.append(newImg);
		
		let svgEdit = document.createElement('svg');
		svgEdit.innerHTML = "<svg width=\"15px\" height=\"15px\" class=\"editIconAtribute\" title=\"change\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\"><g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g></svg>";
		
		let newContainer = document.createElement('div');
		newContainer.style.display = "inline-block";
		newContainer.style.width = "35px";
		newContainer.style.height = "10px";
		newContainer.style.marginTop = "-10px";
		newContainer.style.position = "relative";
		
		newContainer.append(newDiv);
		
		//let left = window.getComputedStyle(divIcon).getPropertyValue("left");
		
		if(divIcon.parentNode.className == 'atribut') {
			newContainer.className = "container";
			newContainer.style.width = "56px";
			
			let svg = svgEdit.querySelector('svg.editIconAtribute');
			
			svg.style.position = "absolute";
			svg.style.left = "40px";
			svg.style.bottom = "-7px";
			
			newContainer.append(svgEdit);
			
			divIcon.after(newContainer);
		} else {
			divIcon.after(newDiv);
			divIcon.after(svgEdit);
		}		
	
		svgEdit.addEventListener('click', function() {
			changeDivEditIcon(this);
			
			let src = this.parentNode.querySelector('.notAddingIcon img').getAttribute('src');
			let filename = src.replace(/_150x150(?!.*_150x150)/,'');
						
			let modalPhotos = document.querySelector('.toggleModal2');
			let modalPhotosRow = modalPhotos.querySelector('.modal__block .modalBody .rowImages');
			modalPhotosRow.innerHTML = '<div class="imageCart">\
											<div class="hoverForSelect notSelect">\
												<div class="shadow"></div>\
												<div class="before1"></div>\
												<div class="before2"></div>\
												<div class="after1"></div>\
												<div class="after2"></div>\
												<div class="selectImages">\
													<div class="item">\
														<div class="galka"></div>\
													</div>\
												</div>\
												<img class="avatarImages" src="' + src + '" data-filename="' + filename + '">\
											</div>\
										</div>';
			let modalBlock = document.querySelector('.modalBlock.toggleModal' + 2);
			let modalHeader = modalBlock.querySelector('.modalHeader');
			
			let allSelectImages = modalBlock.querySelectorAll('.windowAllImages .rowImages .imageCart .selectImages');
		
			for (let elem of allSelectImages) {
				elem.addEventListener('click', selectingImages, false);
			}
			
			let deleteBin = modalHeader.querySelector('.delete-bin');
			
			function selectingImages(e) {
				event.stopImmediatePropagation();
				console.log('suka blad naxuy');
				
				
				if(!e.path[2].querySelector('.item').classList.contains('active')) {
					e.path[2].querySelector('.item').className = "item active";
					console.log(e.path[2].querySelector('.item').className);
				} else {
					e.path[2].querySelector('.item').className = "item";
				}
				
				let allActiveImages = modalBlock.querySelectorAll('.item.active').length;
				if(allActiveImages > 0 && deleteBin.classList == 'delete-bin') {
					deleteBin.className = 'delete-bin active';
				} else if (allActiveImages == 0) {
					deleteBin.className = 'delete-bin';
				}
			}
			
			if(isFirstLaunching) {				
				launchIconsPopUp();
				
				isFirstLaunching = false;
			}
			
			toggleModalBlock(2, 1);
		}, false);
		
		divIcon.remove();
	}
	
	console.log(tdData.dataset.atributes);
	
	let strAtributes = tdData.dataset.atributes;
	
	let arrAtributes = strAtributes.split(']]]');
	let arrClearAtributes = [];
	
	for(let elem of arrAtributes) {
		if(elem.length > 0) {
			arrClearAtributes.push(elem);
		}
	}
	
	let atributeTypes = [];
	let atributeValues = [];
	let atributeImages = [];
	
	for(let elem of arrClearAtributes) {
		let atribut = elem.split(',!,');
		console.log(elem);
		console.log(atribut);
		atributeTypes.push(atribut[0]);
		
		let values = [];
		let imagesa = [];
		for(let i = 1; i < atribut.length; i++) {
			if(i % 2 == 1) {
				values.push(atribut[i]);
			} else {
				imagesa.push(atribut[i]);
			}
		}
		
		atributeValues.push(values);
		atributeImages.push(imagesa);
	}
	
	console.log(atributeImages);
	
	if(atributeTypes.length > 0) {
		divEditAtributes.style.paddingBottom = 14 + "px";
		
		document.querySelector('.editAtributes .atribut').remove();
	}
	
	for(let i = 0; i < atributeTypes.length; i++) {
		addNewAtribute();
		
		let atributDOM = document.querySelector('.editAtributes .atribut:last-child');
		let firstInput = atributDOM.querySelector('input');
		firstInput.value = atributeTypes[i];
		let firstValue = atributDOM.querySelector('.values input:nth-child(1)');
		firstValue.value = atributeValues[i][0];
		
		let buttonAddImg = document.querySelector('.editAtributes .atribut:last-child > .add-icon');
		
		if(atributeImages[i][0].length > 0) {
			addImg(buttonAddImg, atributeImages[i][0]);
		}
		
		for(let j = 1; j < atributeValues[i].length; j++) {
			let click = new Event("click");			
			document.querySelector('.editAtributes .atribut:last-child .values + svg').dispatchEvent(click);
			
			let atributDOM = document.querySelector('.editAtributes .atribut:last-child');
			let nValue = atributDOM.querySelector('.values div:nth-child(' + Number(j+1) + ') input');
			nValue.value = atributeValues[i][j];
			
			let buttonAddImg = document.querySelector('.editAtributes .atribut:last-child .values div:nth-child(' + Number(j+1) + ') .add-icon');
			
			if(atributeImages[i][j].length > 0) {
				addImg(buttonAddImg, atributeImages[i][j]);
			}
		}
	}
	
	editDisconts.innerHTML = discontsHtml;
	divEditDisconts.style.paddingBottom = "55px";
	
	let inputPriceForDiscont = divEditDisconts.querySelector('input');
	
	function inputingPriceForDiscont() {
		//this.value = this.value.replace(/\D/g, '');
		
		console.log(this.value);
		console.log(this.value.match(/[^ ,0-9]/g));
		if(this.value.match(/[^ ,.0-9]/g)) {
			let pos = this.value.indexOf(this.value.match(/[^ ,0-9]/g));
			
			if(pos > 0) {
				this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
			} else if(pos == 0) {
				this.value = this.value.substring(1);
			}
		}
		if(this.value.split(",").length - 1 > 0) {
			if(this.value.split(",").length - 1 > 1) {
				let pos = this.value.indexOf(",");
				if(pos > 0) {
					this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
				} else if(pos == 0) {
					this.value = this.value.substring(1);
				}
			}
			let pos = this.value.indexOf(".");
			if(pos > 0) {
				this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
			} else if(pos == 0) {
				this.value = this.value.substring(1);
			}
			pos = this.value.indexOf(",");
			if(pos == 0) {
				this.value = this.value.substring(1);
			}
		} else if(this.value.split(".").length - 1 > 0) {
			if(this.value.split(".").length - 1 > 1) {
				let pos = this.value.indexOf(".");
				if(pos > 0) {
					this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
				} else if(pos == 0) {
					this.value = this.value.substring(1);
				}
			}
			let pos = this.value.indexOf(",");
			if(pos > 0) {
				this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
			} else if(pos == 0) {
				this.value = this.value.substring(1);
			}
			pos = this.value.indexOf(".");
			if(pos == 0) {
				this.value = this.value.substring(1);
			}
		}
		
		let maxPrice = -1 + Number(editing.querySelector('.input #good_seller_price').value);
		if(this.value > maxPrice) {
			this.value = maxPrice;
		}
	}
	
	inputPriceForDiscont.addEventListener('input', inputingPriceForDiscont, false);
	
	let isNotFirstClick;
	let currentCalendar;
	
	function clickBody() {
		event.stopImmediatePropagation();
			
		let isOnNotCalendar = true;
		for(let elem of event.path) {
			if(elem.className == "calendar open") {
				isOnNotCalendar = false;
			}
		}
		
		if(isOnNotCalendar) {
			
			console.log(currentCalendar);
			document.removeEventListener('click', clickBody);
			currentCalendar.className = "calendar";
			
			let svg = currentCalendar.parentNode.querySelector('svg');
			svg.style.fill = "#000";
		}
	}
	
	function openCalendar() {
		event.stopImmediatePropagation();
		
		let calendars = divEditDisconts.querySelectorAll('.calendar.open');
		
		for(let elem of calendars) {
			elem.className = "calendar";
			
			let svg = elem.parentNode.querySelector('svg');
			svg.style.fill = "#000";
		}
		
		let calendar = this.parentNode.querySelector('.calendar');
		
		let svg = calendar.parentNode.querySelector('svg');
		svg.style.fill = "#A83242";
		
		if(!calendar.classList.contains('open')) {
			calendar.classList.add('open');
			
			isNotFirstClick = false;
			currentCalendar = calendar;
			
			document.addEventListener('click',  clickBody, false);
		} else {
			calendar.className = "calendar";
		}
		
		currentYear = new Date().getFullYear();
		currentMonth = new Date().getMonth();
		
		let focusYear = currentCalendar.querySelector('.monthes').dataset.year;
				
		if(focusYear != undefined) {
			let focusMonth = currentCalendar.querySelector('.monthes').dataset.month;
			
			currentYear = Number(focusYear);
			currentMonth = months.indexOf(focusMonth);
		}
	
		renderMonthCalendar(currentMonth, currentYear, currentCalendar);
	}
	
	let buttonsCalendar = divEditDisconts.querySelector('.input .discont').querySelectorAll('.date svg');
	
	for(let elem of buttonsCalendar) {
		elem.addEventListener('click', openCalendar, false);
	}
	
	function deleteFirstDiscont() {
		let divDiscont = this.parentNode;
		
		let input = divDiscont.querySelector('input');
		input.value = "";
		
		let calendars = divDiscont.querySelectorAll('.calendar');
				
		let dateFirst = divDiscont.querySelector('.date.first span.text');
		dateFirst.innerText = "";
		
		let dateSecond = divDiscont.querySelector('.date.second span.text');
		dateSecond.innerText = "";
			
		let divMonthes = divDiscont.querySelectorAll('.monthes');
		for(let elem of divMonthes) {
			elem.removeAttribute("data-year");
			elem.removeAttribute("data-month");
			elem.removeAttribute("data-day");
		}
	}
	
	function deleteDiscont() {
		let divDiscont = this.parentNode;	
		let n = editDisconts.querySelectorAll('.discont').length;
		
		if(n == 1) {
			let input = divDiscont.querySelector('input');
			input.value = "";
			
			let calendars = divDiscont.querySelectorAll('.calendar');
					
			let dateFirst = divDiscont.querySelector('.date.first span.text');
			dateFirst.innerText = "";
			
			let dateSecond = divDiscont.querySelector('.date.second span.text');
			dateSecond.innerText = "";
			
			let divMonthes = divDiscont.querySelectorAll('.monthes');
			for(let elem of divMonthes) {
				elem.removeAttribute("data-year");
				elem.removeAttribute("data-month");
				elem.removeAttribute("data-day");
			}
		} else {	
			divDiscont.remove();		
			
			let newPaddingBottom = -42 + Number(window.getComputedStyle(divEditDisconts).getPropertyValue("padding-bottom").replace('px', ''));
			divEditDisconts.style.paddingBottom = newPaddingBottom + "px";					
		}
	}
	
	let calendars = editDisconts.querySelectorAll('.calendar');
	
	for(let calendar of calendars) {
		calendar.querySelector('.prev').addEventListener("click", calendarPrev);
		calendar.querySelector('.next').addEventListener("click", calendarNext);
	}
	
	let buttonDeleteDiscont = divEditDisconts.querySelector('.input .discont .deleteDiscont');
	buttonDeleteDiscont.addEventListener('click', deleteFirstDiscont, false);	
		
	function selectDate() {
		if(event.path[0].tagName.toLowerCase() == "button" || event.path[1].tagName.toLowerCase() == "button") {
			let buttonDate;
			if(event.path[0].tagName.toLowerCase() == "button") {
				buttonDate = event.path[0];
			} else {
				buttonDate = event.path[1];
			}
						
			let focusedDates = buttonDate.parentNode.querySelectorAll('.focus');
			
			for(let elem of focusedDates) {
				elem.classList.remove('focus');
			}
			
			buttonDate.classList.add("focus");
						
			let divMonthes = buttonDate.parentNode.parentNode;
			divMonthes.dataset.year = divMonthes.parentNode.querySelector('.month-switcher div .year').innerText;
			divMonthes.dataset.month = divMonthes.parentNode.querySelector('.month-switcher div .month').innerText;
			divMonthes.dataset.day = buttonDate.querySelector('time').innerText;
			
			let month = divMonthes.dataset.month.toLowerCase();
			if(month[month.length - 1] == 'ь' || month[month.length - 1] == 'й') {
				month = month.substring(0, [month.length - 1]) + 'я';
			} else if(month[month.length - 1] == 'т') {
				month = month + 'а';
			}
			
			divMonthes.parentNode.parentNode.querySelector('span.text').innerText = divMonthes.dataset.day + " " + month + " " + divMonthes.dataset.year;
			console.log(buttonDate);
		}
	}
	
	let divMonthes = divEditDisconts.querySelector('.input .discont').querySelectorAll('.date .calendar .monthes');
	
	for(let elem of divMonthes) {
		elem.addEventListener('click', selectDate, false);
	}
	
	function addDiscont() {
		event.stopImmediatePropagation();
		
		let newDivDiscont = document.createElement('div');
		newDivDiscont.className = 'discont';
		
		newDivDiscont.innerHTML = "\
						<input type=\"text\" placeholder=\"Введите новую цену\">\
						<div class=\"date first\"><span class=\"text\"></span>\
							<svg version=\"1.0\"  width=\"30px\" height=\"30px\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"#000000\" viewBox=\"0 0 800.000000 800.000000\" preserveAspectRatio=\"xMidYMid meet\">\
								<g transform=\"translate(0.000000,800.000000) scale(0.100000,-0.100000)\" stroke=\"none\"> <path d=\"M1792 7227 c-49 -15 -122 -85 -148 -142 l-24 -50 0 -515 c0 -324 4 -529 10 -552 16 -56 68 -117 129 -152 46 -25 65 -30 120 -29 38 0 82 7 104 17 54 24 112 79 136 131 21 44 21 57 21 578 l0 533 -27 53 c-27 55 -84 105 -146 128 -39 14 -131 15 -175 0z\"/> <path d=\"M4825 7216 c-60 -28 -111 -77 -136 -131 -17 -37 -19 -75 -19 -570 l0 -530 24 -50 c43 -94 128 -147 236 -148 107 -1 195 56 241 157 17 38 19 77 19 562 0 580 0 580 -67 649 -80 83 -200 107 -298 61z\"/> <path d=\"M1385 6595 c-251 -56 -440 -226 -523 -470 l-27 -80 0 -1795 0 -1795 27 -80 c84 -246 278 -417 530 -469 68 -14 234 -16 1434 -16 l1357 0 -7 46 c-3 26 -6 105 -6 175 l0 129 -1332 0 c-1073 0 -1344 3 -1389 14 -110 25 -189 90 -238 196 l-26 55 -3 1388 -2 1387 2245 -2 2245 -3 3 -757 2 -758 178 -2 178 -3 -3 1135 -3 1135 -25 80 c-38 121 -92 209 -184 301 -66 66 -98 90 -176 128 -99 48 -208 76 -301 76 l-49 0 0 -297 c0 -321 -5 -365 -53 -446 -35 -58 -92 -111 -157 -144 -48 -24 -67 -27 -145 -28 -78 0 -98 4 -150 28 -78 36 -146 104 -182 181 l-28 61 -3 323 -3 322 -1164 0 -1164 0 -3 -322 -3 -323 -29 -63 c-41 -88 -123 -163 -212 -192 -178 -60 -376 34 -446 210 -21 52 -23 73 -25 370 l-3 315 -38 2 c-20 1 -64 -4 -97 -12z\"/> <path d=\"M3142 4508 l3 -253 258 -3 257 -2 0 255 0 255 -260 0 -260 0 2 -252z\"/> <path d=\"M3970 4505 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M4772 4508 l3 -253 255 0 255 0 3 253 2 252 -260 0 -260 0 2 -252z\"/> <path d=\"M1560 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M2370 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M3153 3688 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z\"/> <path d=\"M3980 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M4790 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M5706 3439 c-343 -30 -664 -194 -890 -454 -521 -601 -414 -1513 233 -1975 151 -108 312 -179 502 -222 87 -19 132 -23 274 -23 187 0 270 13 431 66 552 181 935 733 911 1314 -15 361 -142 652 -391 901 -61 61 -146 134 -188 162 -262 177 -576 259 -882 231z m369 -414 c341 -97 586 -347 683 -697 13 -48 17 -102 17 -228 0 -142 -3 -176 -23 -245 -120 -420 -491 -705 -917 -706 -230 0 -401 56 -587 193 -216 159 -359 427 -375 704 -16 280 87 547 288 740 147 141 304 222 502 260 111 21 300 12 412 -21z\"/> <path d=\"M5739 2851 l-39 -39 0 -373 c0 -357 1 -375 20 -407 36 -59 55 -62 404 -62 365 0 379 2 416 74 28 53 22 103 -20 149 l-28 32 -266 3 -265 3 -3 287 c-3 262 -5 289 -22 315 -25 37 -66 57 -117 57 -35 0 -48 -6 -80 -39z\"/> <path d=\"M1560 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M2370 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M3153 2858 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z\"/> <path d=\"M3980 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> </g>\
							</svg>\
							<div class=\"calendar\">\
								<div class=\"month-switcher\">\
									<button class=\"prev\"></button>\
									<div>\
										  <span class=\"month\"></span>\
										  <span class=\"year\"> 2020</span>\
									</div>\
									<button class=\"next\"></button>\
								</div>\
								<div class=\"days\">\
									<span>ПН</span>\
									<span>ВТ</span>\
									<span>СР</span>\
									<span>ЧТ</span>\
									<span>ПТ</span>\
									<span>СБ</span>\
									<span>НД</span>\
								</div>\
							  <div class=\"monthes\"></div>\
							</div>\
						</div>\
						<div class=\"date second\"><span class=\"text\"></span>\
							<svg version=\"1.0\"  width=\"30px\" height=\"30px\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"#000000\" viewBox=\"0 0 800.000000 800.000000\" preserveAspectRatio=\"xMidYMid meet\">\
								<g transform=\"translate(0.000000,800.000000) scale(0.100000,-0.100000)\" stroke=\"none\"> <path d=\"M1792 7227 c-49 -15 -122 -85 -148 -142 l-24 -50 0 -515 c0 -324 4 -529 10 -552 16 -56 68 -117 129 -152 46 -25 65 -30 120 -29 38 0 82 7 104 17 54 24 112 79 136 131 21 44 21 57 21 578 l0 533 -27 53 c-27 55 -84 105 -146 128 -39 14 -131 15 -175 0z\"/> <path d=\"M4825 7216 c-60 -28 -111 -77 -136 -131 -17 -37 -19 -75 -19 -570 l0 -530 24 -50 c43 -94 128 -147 236 -148 107 -1 195 56 241 157 17 38 19 77 19 562 0 580 0 580 -67 649 -80 83 -200 107 -298 61z\"/> <path d=\"M1385 6595 c-251 -56 -440 -226 -523 -470 l-27 -80 0 -1795 0 -1795 27 -80 c84 -246 278 -417 530 -469 68 -14 234 -16 1434 -16 l1357 0 -7 46 c-3 26 -6 105 -6 175 l0 129 -1332 0 c-1073 0 -1344 3 -1389 14 -110 25 -189 90 -238 196 l-26 55 -3 1388 -2 1387 2245 -2 2245 -3 3 -757 2 -758 178 -2 178 -3 -3 1135 -3 1135 -25 80 c-38 121 -92 209 -184 301 -66 66 -98 90 -176 128 -99 48 -208 76 -301 76 l-49 0 0 -297 c0 -321 -5 -365 -53 -446 -35 -58 -92 -111 -157 -144 -48 -24 -67 -27 -145 -28 -78 0 -98 4 -150 28 -78 36 -146 104 -182 181 l-28 61 -3 323 -3 322 -1164 0 -1164 0 -3 -322 -3 -323 -29 -63 c-41 -88 -123 -163 -212 -192 -178 -60 -376 34 -446 210 -21 52 -23 73 -25 370 l-3 315 -38 2 c-20 1 -64 -4 -97 -12z\"/> <path d=\"M3142 4508 l3 -253 258 -3 257 -2 0 255 0 255 -260 0 -260 0 2 -252z\"/> <path d=\"M3970 4505 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M4772 4508 l3 -253 255 0 255 0 3 253 2 252 -260 0 -260 0 2 -252z\"/> <path d=\"M1560 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M2370 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M3153 3688 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z\"/> <path d=\"M3980 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M4790 3685 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M5706 3439 c-343 -30 -664 -194 -890 -454 -521 -601 -414 -1513 233 -1975 151 -108 312 -179 502 -222 87 -19 132 -23 274 -23 187 0 270 13 431 66 552 181 935 733 911 1314 -15 361 -142 652 -391 901 -61 61 -146 134 -188 162 -262 177 -576 259 -882 231z m369 -414 c341 -97 586 -347 683 -697 13 -48 17 -102 17 -228 0 -142 -3 -176 -23 -245 -120 -420 -491 -705 -917 -706 -230 0 -401 56 -587 193 -216 159 -359 427 -375 704 -16 280 87 547 288 740 147 141 304 222 502 260 111 21 300 12 412 -21z\"/> <path d=\"M5739 2851 l-39 -39 0 -373 c0 -357 1 -375 20 -407 36 -59 55 -62 404 -62 365 0 379 2 416 74 28 53 22 103 -20 149 l-28 32 -266 3 -265 3 -3 287 c-3 262 -5 289 -22 315 -25 37 -66 57 -117 57 -35 0 -48 -6 -80 -39z\"/> <path d=\"M1560 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M2370 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> <path d=\"M3153 2858 l2 -253 258 -3 257 -2 0 255 0 255 -259 0 -260 0 2 -252z\"/> <path d=\"M3980 2855 l0 -255 255 0 255 0 0 255 0 255 -255 0 -255 0 0 -255z\"/> </g>\
							</svg>\
							<div class=\"calendar\">\
								<div class=\"month-switcher\">\
									<button class=\"prev\"></button>\
									<div>\
										  <span class=\"month\"></span>\
										  <span class=\"year\"> 2020</span>\
									</div>\
									<button class=\"next\"></button>\
								</div>\
								<div class=\"days\">\
									<span>ПН</span>\
									<span>ВТ</span>\
									<span>СР</span>\
									<span>ЧТ</span>\
									<span>ПТ</span>\
									<span>СБ</span>\
									<span>НД</span>\
								</div>\
							  <div class=\"monthes\"></div>\
							</div>\
						</div>\
						<svg class=\"deleteDiscont\" fill=\"000\" width=\"14\" height=\"14\" viewBox=\"0 0 14 14\" xmlns=\"http://www.w3.org/2000/svg\">\
							<path d=\"M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z\" fill-rule=\"evenodd\"></path>\
						</svg>";
		
		divEditDisconts.querySelector('.input').append(newDivDiscont);
		
		newDivDiscont.querySelector('input').addEventListener('input', inputingPriceForDiscont, false);
		
		let buttonsCalendar = newDivDiscont.querySelectorAll('.date svg');	
		for(let elem of buttonsCalendar) {
			elem.addEventListener('click', openCalendar, false);
		}
		
		let calendars = newDivDiscont.querySelectorAll('.calendar');
		
		for(let calendar of calendars) {
			calendar.querySelector('.prev').addEventListener("click", calendarPrev);
			calendar.querySelector('.next').addEventListener("click", calendarNext);
		}
		
		let buttonDeleteDiscont = newDivDiscont.querySelector('.deleteDiscont');
		buttonDeleteDiscont.addEventListener('click', deleteDiscont, false);
		
		let divMonthes = divEditDisconts.querySelectorAll('.date .calendar .monthes');
		
		for(let elem of divMonthes) {
			elem.addEventListener('click', selectDate, false);
		}
		
		let newPaddingBottom = 42 + Number(window.getComputedStyle(divEditDisconts).getPropertyValue("padding-bottom").replace('px', ''));
		divEditDisconts.style.paddingBottom = newPaddingBottom + "px";
	}
	
	let buttonAddDiscont = divEditDisconts.querySelector('.addNewDiscont');
	buttonAddDiscont.addEventListener('click', addDiscont, false);	
	
	let strDisconts = tdData.dataset.disconts;
	
	let arrDisconts = strDisconts.split(']]]');
	let arrClearDisconts = [];
	
	for(let elem of arrDisconts) {
		if(elem.length > 0) {
			arrClearDisconts.push(elem);
		}
	}
	
	let disconts = [];
	
	for(let elem of arrClearDisconts) {
		let discont = elem.split(',|,');
		disconts.push(discont);
	}
	
	if(disconts.length > 0) {
		editDisconts.querySelector('.discont').remove();
	}
	
	const monthsFallDown = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
	
	for(let i = 0; i < disconts.length; i++) {
		addDiscont();
		
		let input = editDisconts.querySelector('.discont:last-child input');
		input.value = disconts[i][0];
		
		let firstDate = disconts[i][1].split('-');
		let firstYear = firstDate[0];
		let firstMonth = monthsFallDown[Number(firstDate[1])-1];
		let firstDay = Number(firstDate[2]);
		
		let dateFirstText = editDisconts.querySelector('.discont:last-child .date.first .text');
		dateFirstText.innerText = firstDay + " " + firstMonth + " " + firstYear;
		
		let dateFirstCalendarMonthes = editDisconts.querySelector('.discont:last-child .date.first .calendar .monthes');
		console.log(Number(firstDate[1])-1);
		let firstCellMonth = months[Number(firstDate[1])-1];
		
		dateFirstCalendarMonthes.dataset.year = firstYear;
		dateFirstCalendarMonthes.dataset.month = firstCellMonth;
		dateFirstCalendarMonthes.dataset.day = firstDay;
		
		let secondDate = disconts[i][2].split('-');
		let secondYear = secondDate[0];
		let secondMonth = monthsFallDown[Number(secondDate[1])-1];
		let secondDay = Number(secondDate[2]);
		
		let dateSecondText = editDisconts.querySelector('.discont:last-child .date.second .text');
		dateSecondText.innerText = secondDay + " " + secondMonth + " " + secondYear;
		
		let dateSecondCalendarMonthes = editDisconts.querySelector('.discont:last-child .date.second .calendar .monthes');
		let secondCellMonth = months[Number(secondDate[1])-1];
		
		dateSecondCalendarMonthes.dataset.year = secondYear;
		dateSecondCalendarMonthes.dataset.month = secondCellMonth;
		dateSecondCalendarMonthes.dataset.day = secondDay;		
	}
	
	let editGoodArticul = editing.querySelector('.editGoodArticul .input #good_articul');
	let goodArticul = tdData.dataset.goodArticul;
	editGoodArticul.value = goodArticul;
	
	if(typeof(sellerJuridicName) == "undefined") {
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
		
		let statusOfTrading = tdData.dataset.statusOfTrading;
		let inputStatusOfTrading = editing.querySelector('input#seller_statusOfTrading');
		inputStatusOfTrading.value = statusOfTrading;
	}
	
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
	
	isFirstLaunchEditingGood = false;
	changeLeftMenuHeight();
}

function checkIsAvailableURL() {
	let div = this.parentNode.parentNode;
	let label = div.querySelector('label');
	
	let goodId = div.parentNode.dataset.id;
	
	let tr = document.querySelector('.table_goods tbody tr td.none[data-id=\"' + goodId + '\"]').parentNode;
	let goodUrl = tr.querySelector('td.none').dataset.goodUrl;
	
	console.log(goodUrl);
	
	if(this.value.length > 0) {
		if(this.value.length < 4) {
			label.classList.remove('falseSimbols');
			label.classList.remove('notAvailble');
			label.classList.add('error');
			label.classList.add('needMore');
			isCheckedGoodURL = 1;
		} else {
			label.classList.remove('error');
			label.classList.remove('needMore');
			label.classList.remove('notAvailble');
			label.classList.remove('falseSimbols');
			
			let input = this.value;
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'App/Controllers/checkIsAvailableProductURL.php');
			xhr.setRequestHeader( "Content-Type", "application/json" );

			xhr.addEventListener('readystatechange', function(e) {
				console.log(e.target.response);
				if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
					if(e.target.response == '1' || input == goodUrl) {
						
					} else {							
						label.classList.add('error');
						label.classList.add('notAvailble');
					}
					isCheckedGoodURL = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveEditingGood();
					}
				}
				else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
					console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
					isCheckedGoodURL = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveEditingGood();
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
		isCheckedGoodURL = 1;
	}
}

function deleteGoodImg() {	
	let imageNameSrc = event.path[0].parentNode.querySelector('img').src;
	let imageName = imageNameSrc.substring(imageNameSrc.lastIndexOf('/')+1).replace(/_150x150(?!.*_150x150)/,'');
	
	console.log(event.path[0].parentNode)
	
	deletingImageProductPOST(imageName, event.path[0].parentNode);
}

function changingDOMafterDeletingPhotoOnEditingProduct(imgCart) {	
	
	let editPhoto = document.querySelector(' .editing_good .editPhoto .input');
	let buttonEditImages = editPhoto.querySelector('svg');
	
	imgCart.remove();
	
	let editPhotoPhotos = editing.querySelectorAll('.editPhoto .input img');
	
	for(let i = 0; i < editPhotoPhotos.length; i++) {
		let left = i*55;
		editPhotoPhotos[i].style.left = left + "px";
		
		let buttonForDeleteImg = editPhotoPhotos[i].parentNode.querySelector('.buttonDeleteImg');
		let buttonForDeleteImgLeft = left + 34;
		buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
	}
	
	let newButtonLeft = Number(window.getComputedStyle(buttonEditImages).getPropertyValue("left").replace('px', '')) - 55;
	buttonEditImages.style.left = newButtonLeft + "px";
}

function deletingImageProductPOST(filename, imgCart) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/deletingImage.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );
	
	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
			console.log('Фотка удалена');
			changingDOMafterDeletingPhotoOnEditingProduct(imgCart);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == "")) {
			titleError.style.display = "block";
			titleError.innerText = 'К сожалению, не удалось удалить фотографию.';
			setTimeout(deleteTitleError, 5000);
		}
	});
	
	xhr.send('["' + filename + '", "ShopProductImages", "productId", "' + editing.dataset.id + '", "products/"]');
}

function changingPhotoOrder() {
	let editPhotoPhotos = editing.querySelectorAll('.editPhoto .input img');
	
	let strImages = "";
	let strDatasetImages = "";
	let arrUrl = [];
	let arrName = [];
	let arrShortName = [];
	
	for(let img of editPhotoPhotos) {
		let src = img.getAttribute('src');
		let url = src.substring(0, src.lastIndexOf('/')+1)
		let name = src.substring(src.lastIndexOf('/')+1).replace(/_150x150(?!.*_150x150)/,'');
		let shortName = src.substring(src.lastIndexOf('/')+1);
		
		arrUrl.push(url);
		arrName.push(name);
		
		arrShortName.push(shortName);
	}
	
	for(let i = 0; i < arrName.length; i++) {
		let url = arrUrl[i];
		let name = arrName[i];
		let shortName = arrShortName[i];
		
		if(i < arrName.length - 1) {
			strImages += url + "," + name + "," + Number(i + 1) + ",";
		} else {
			strImages += url + "," + name + "," + Number(i + 1);
		}
		
		strDatasetImages += url + shortName + "|" + Number(i + 1) + ",";
	}
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/changingProductPhotosOrder.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );
	
	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
			console.log('Порядок фоток изменено');
			
			let src = editPhotoPhotos[0].getAttribute('src');
			let name = src.substring(src.lastIndexOf('/')+1).replace(/_150x150(?!.*_150x150)/,'');
		
			let tdNone = mainContent.querySelector('.table_goods tbody tr td.none[data-id="' + editing.dataset.id + '"]');
			tdNone.dataset.goodPhotos = strDatasetImages;
			
			let tr = tdNone.parentNode;
			let img = tr.querySelector('td.image img');
			img.src = src;
			img.dataset.filename = name;			
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == "")) {
			titleError.style.display = "block";
			titleError.innerText = 'К сожалению, не удалось удалить фотографию.';
			setTimeout(deleteTitleError, 5000);
		}
	});
	
	xhr.send('"' + strImages + '"');
}

let canMoveRightFromLeft = [];
let canMoveLeftFromLeft = [];

let canMoveLeftFromRight = [];
let canMoveRightFromRight = [];

function editPhotoMouseDown() {
	let editPhoto = editing.querySelector(' .editing_good .editPhoto .input');
	let editPhotoPhotos = editing.querySelectorAll('.editPhoto .input img');
	
	let img = event.path[0];
	img.style.zIndex = 94;
	img.style.cursor = "grabbing";
	
	let buttonForDeleteImg = img.parentNode.querySelector('.buttonDeleteImg');
	buttonForDeleteImg.style.zIndex = 95;
	
	let left = Number.parseInt(window.getComputedStyle(img).getPropertyValue("left").replace('px', ''));
	
	let clientX;
		
	if(event.touches != undefined) {
		clientX = event.touches[0].clientX;
	} else {
		clientX = event.clientX;
	}
	
	function moveAt(pageX) {
		let x = pageX - clientX + left + 10;
		if(x >= 0 && x < 700) {
			img.style.left = x + 'px';
			
			let buttonForDeleteImg = img.parentNode.querySelector('.buttonDeleteImg');
			let buttonForDeleteImgLeft = x + 34;		
			buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
			
			onRightPlaces(img);
		} else if(x < 0) {
			img.style.left = 0 + 'px';
			
			let buttonForDeleteImg = img.parentNode.querySelector('.buttonDeleteImg');
			let buttonForDeleteImgLeft = 34;		
			buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
			
			onRightPlaces(img);
		}
		//img.style.top = pageY - shiftY + 'px';			
	}
	
	let origLeftes = [];
	
	for(let i = 0; i < editPhotoPhotos.length; i++) {
		origLeftes.push(i*55);
	}
	
	function onRightPlaces(img) {
		let left = Number.parseInt(window.getComputedStyle(img).getPropertyValue("left").replace('px', ''));
		
		leftes = [];
		let item;
		
		for(let photo of editPhotoPhotos) {
			leftes.push(Number.parseInt(window.getComputedStyle(photo).getPropertyValue("left").replace('px', '')));
		}
		
		for(let i = 0; i < leftes.length; i++) {
			if(left == leftes[i]) {
				item = i;
			}
		}
		
		let canToRight = false;
		//console.log(leftes);
		
		for(let i = 0; i < editPhotoPhotos.length; i++) {
			if(i < item) {
				if(leftes[i] != undefined) {
					if(leftes[item] < origLeftes[i] + 27.5) {
						if(canMoveRightFromLeft[i] == undefined || canMoveRightFromLeft[i] == true) {
							let toRight = origLeftes[i] + 55;
							editPhotoPhotos[i].style.left = toRight + "px";
							
							let buttonForDeleteImg = editPhotoPhotos[i].parentNode.querySelector('.buttonDeleteImg');
							let buttonForDeleteImgLeft = toRight + 34;		
							buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
							
							canMoveRightFromLeft[i] = false;
							canMoveLeftFromLeft[i] = true;
							//console.log("r " + leftes[item] + " < l " + Number(origLeftes[i] + 27.5));
						}
					} else if(leftes[item] > origLeftes[i] + 27.5) {
						if(canMoveLeftFromLeft[i] == true) {
							//console.log("jjj");
							//console.log(origLeftes[i]);
							let toLeft = origLeftes[i];
							editPhotoPhotos[i].style.left = toLeft + "px";
							
							let buttonForDeleteImg = editPhotoPhotos[i].parentNode.querySelector('.buttonDeleteImg');
							let buttonForDeleteImgLeft = toLeft + 34;		
							buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
							
							canMoveLeftFromLeft[i] = false;
							canMoveRightFromLeft[i] = true;
						}
					}
				}
			} else if(i > item) {
				if(leftes[i] != undefined) {
					if(leftes[item] > origLeftes[i] - 27.5) {
						if(canMoveLeftFromRight[i] == undefined || canMoveLeftFromRight[i] == true) {
							let toRight = origLeftes[i] - 55;
							editPhotoPhotos[i].style.left = toRight + "px";
							
							let buttonForDeleteImg = editPhotoPhotos[i].parentNode.querySelector('.buttonDeleteImg');
							let buttonForDeleteImgLeft = toRight + 34;		
							buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
							
							canMoveLeftFromRight[i] = false;
							canMoveRightFromRight[i] = true;
							//console.log("hhj");
						}
					} else if(leftes[item] < origLeftes[i] + 27.5) {
						if(canMoveRightFromRight[i] == true) {
							let toLeft = origLeftes[i];
							editPhotoPhotos[i].style.left = toLeft + "px";
							
							let buttonForDeleteImg = editPhotoPhotos[i].parentNode.querySelector('.buttonDeleteImg');
							let buttonForDeleteImgLeft = toLeft + 34;		
							buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
							
							canMoveLeftFromRight[i] = true;
							canMoveRightFromRight[i] = false;
						}
					}
				}
			}
			//console.log(canToRight);
		}
	}

	function onMouseMove(event) {
		let x;
		
		if(event.touches != undefined) {
			x = event.touches[0].pageX;
		} else {
			x = event.pageX;
		}
		
		moveAt(x);
	}

	document.addEventListener('mousemove', onMouseMove);
	document.addEventListener('touchmove', onMouseMove);
	
	let isFirstMouseUp = true;
	
	function onMouseUp() {
		if(isFirstMouseUp) {
			document.removeEventListener('mousemove', onMouseMove);
			document.removeEventListener('touchmove', onMouseMove);
			img.onmouseup = null;
			img.style.zIndex = 92;
			img.style.cursor = "grab";
			
			let buttonForDeleteImg = img.parentNode.querySelector('.buttonDeleteImg');
			buttonForDeleteImg.style.zIndex = 93;
			
			let left = Number.parseInt(window.getComputedStyle(img).getPropertyValue("left").replace('px', ''));			
			let trueLeft;
			
			let imgLeftes = [];
							
			for(let photo of editPhotoPhotos) {
				imgLeftes.push(Number.parseInt(window.getComputedStyle(photo).getPropertyValue("left").replace('px', '')));
			}
						
			let maxLeft = imgLeftes[0];
			let currMaxInd = 0;
			for(let i = 0; i < imgLeftes.length; i++) {
				if(imgLeftes[i] > maxLeft) {
					currMaxInd = i;
					maxLeft = imgLeftes[i];
				}
			}
			
			if(left == maxLeft) {
				console.log(origLeftes[origLeftes.length - 1]);
				trueLeft = origLeftes[origLeftes.length - 1];
			} else {
				trueLeft = Math.round(left/55)*55;
			}
			img.style.left = trueLeft + "px";

			let buttonForDeleteImgLeft = trueLeft + 34;		
			buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
			
			for(let i = 0; i < imgLeftes.length; i++) {
				let currMinInd = 0;
				let currLeft = imgLeftes[0];
				
				for(let i = 0; i < imgLeftes.length; i++) {
					if(imgLeftes[i] < currLeft) {
						currMinInd = i;
						currLeft = imgLeftes[i];
					}
				}
				imgLeftes[currMinInd] = 9999;
				
				editPhoto.append(editPhotoPhotos[currMinInd].parentNode);
			}
			
			changingPhotoOrder();
			
			isFirstMouseUp = false;			
		}
	}
	
	img.addEventListener('mouseup', onMouseUp);
	document.addEventListener('mouseup', onMouseUp);
	document.addEventListener('touchend', onMouseUp);
};

function editPhotoDragStart() {
	event.stopPropagation();
	event.preventDefault();
};

/// Deleting Good

let buttonForDeleteGood = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');

function beforeDeleteGoodPOST() {
	if(clickDeletingGood == 0) {
		clickDeletingGood = 1;
		deleteShopPOST();
	}
	buttonForDeleteGood.removeEventListener('click', beforeDeleteGoodPOST);
}

function deleteShopPOST() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/deleteGood.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			deletingGoodTd.remove();
			clickDeletingGood = 0;
			changeLeftMenuHeight();
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось удалить продавца.');
		}
	});
	xhr.send('"' + deletingGoodId + '"');
}
