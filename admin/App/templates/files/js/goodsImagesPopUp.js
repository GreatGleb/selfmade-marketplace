function editingDOMnotSelectToSelect(notSelect) {
	
}

function editingDOMyesSelectToNotSelect() {
	
}

function changingDOMafterUploadPhoto(src) {
	if(clickEditGoodIcons) {
		src = src.substring(0, src.lastIndexOf('.')) + '_150x150' + src.substring(src.lastIndexOf('.'));
		src = "App/templates/files/img/products/" + src;
		
		console.log(src);
		
		let newImg = document.createElement('img');
		newImg.src = src;
		newImg.style.width = "50px";
		newImg.style.height = "50px";
		
		let buttonDeleteImg = document.createElement('div');
		buttonDeleteImg.className = "buttonDeleteImg";
		
		let newDiv = document.createElement('div');
		newDiv.append(newImg);
		newDiv.append(buttonDeleteImg);
		
		let editPhoto = document.querySelector(' .editing_good .editPhoto .input');
		
		editPhoto.append(newDiv);
		
		let editPhotoPhotos = editPhoto.querySelectorAll('img');

		newImg.style.position = 'absolute';
		newImg.style.zIndex = 92;
		let left = (editPhotoPhotos.length - 1) * 55; //window.getComputedStyle(editPhotoPhotos[i]).getPropertyValue("left");
		newImg.style.left = left + "px";
		
		let buttonForDeleteImgLeft = left + 34;		
		buttonDeleteImg.style.left = buttonForDeleteImgLeft + "px";
		
		buttonDeleteImg.addEventListener('click', deleteGoodImg, false);
		
		newImg.addEventListener('mousedown', editPhotoMouseDown, false);
		newImg.addEventListener('touchmove', editPhotoMouseDown, false);
		newImg.addEventListener('dragstart', editPhotoDragStart, false);
		
		let buttonEditImages = editPhoto.querySelector('svg');
		
		let newButtonLeft = Number(window.getComputedStyle(buttonEditImages).getPropertyValue("left").replace('px', '')) + 55;
		buttonEditImages.style.left = newButtonLeft + "px";
	} else {
		src = src.substring(0, src.lastIndexOf('.')) + '_150x150' + src.substring(src.lastIndexOf('.'));
		src = "App/templates/files/img/product-attributes/" + src;
		
		console.log(src);
		
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
			
			console.log(this.parentNode);
			
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
				e.path[2].querySelector('.item').classList.toggle('active');
				
				let allActiveImages = modalBlock.querySelectorAll('.item.active').length;
				if(allActiveImages > 0 && deleteBin.classList == 'delete-bin') {
					deleteBin.className = 'delete-bin active';
				} else if (allActiveImages == 0) {
					deleteBin.className = 'delete-bin';
				}
			}
			
			toggleModalBlock(2, 1);
		}, false);
		
		divIcon.remove();
	}
}

function changingDOMafterDeletingPhoto(src) {
	if(clickEditGoodIcons) {
		src = src.substring(0, src.lastIndexOf('.')) + '_150x150' + src.substring(src.lastIndexOf('.'));
		src = "App/templates/files/img/products/" + src;
		
		let editPhoto = document.querySelector(' .editing_good .editPhoto .input');
		let buttonEditImages = editPhoto.querySelector('svg');
		
		let imageDiv = editPhoto.querySelector('img[src="' + src + '"]').parentNode;
		
		console.log(src);
		imageDiv.remove();
		
		let editPhotoPhotos = document.querySelectorAll('.editing_good .editPhoto .input img');
		
		for(let i = 0; i < editPhotoPhotos.length; i++) {
			let left = i*55;
			editPhotoPhotos[i].style.left = left + "px";
			
			let buttonForDeleteImg = editPhotoPhotos[i].parentNode.querySelector('.buttonDeleteImg');
			let buttonForDeleteImgLeft = left + 34;
			buttonForDeleteImg.style.left = buttonForDeleteImgLeft + "px";
		}
		
		let newButtonLeft = Number(window.getComputedStyle(buttonEditImages).getPropertyValue("left").replace('px', '')) - 55;
		buttonEditImages.style.left = newButtonLeft + "px";
		
		console.log(src + " удалён");
	} else {
		let newDiv = document.createElement('div');
		newDiv.className = "add-icon";
		newDiv.innerText = "Добавить иконку";
		
		console.log(divEditIcon);
		console.log(divEditIcon.parentNode);
		
		if(divEditIcon.parentNode.parentNode.className == 'atribut') {
			divEditIcon.parentNode.after(newDiv);
			divEditIcon.parentNode.remove();
		} else {
			let svgEdit = divEditIcon.parentNode.querySelector('svg.editIconAtribute').parentNode;
			let divWithIcon = divEditIcon.parentNode.querySelector('.notAddingIcon');
			
			divWithIcon.after(newDiv);
			
			svgEdit.remove();
			divWithIcon.remove();
		}
		
		newDiv.addEventListener('click', function() {
			let modalPhotos = document.querySelector('.toggleModal2');
			let modalPhotosRow = modalPhotos.querySelector('.modal__block .modalBody .rowImages');
			modalPhotosRow.innerHTML = "";
			
			changeDivIcon(this);
			
			toggleModalBlock(2, 1);
		}, false);
	}
}

let clickEditGoodPhotos = 0;

let tableForManyPhotos = "product";

function launchImagesPopUp() {
	let editing = mainContent.querySelector('.editing_good');
	let goodId = editing.dataset.id;
	
	currentTableId = goodId;
	
	onlyOne = 10;
	
	if(clickEditGoodPhotos == 0) {
		loadingImagesInPopUp(1, 'products/', editingDOMnotSelectToSelect, editingDOMyesSelectToNotSelect, 'ShopProductImages', 'productId', goodId);
		clickEditGoodPhotos = 1;
	} else {
		let modalBlock = document.querySelector('.modalBlock.toggleModal' + 1);
		let modalHeader = modalBlock.querySelector('.modalHeader');
		
		let allSelectImages = modalBlock.querySelectorAll('.windowAllImages .rowImages .imageCart .selectImages');
	
		for (let elem of allSelectImages) {
			elem.addEventListener('click', selectingImages, false);
		}
		
		let deleteBin = modalHeader.querySelector('.delete-bin');
		
		function selectingImages(e) {
			e.path[2].querySelector('.item').classList.toggle('active');
			
			let allActiveImages = modalBlock.querySelectorAll('.item.active').length;
			if(allActiveImages > 0 && deleteBin.classList == 'delete-bin') {
				deleteBin.className = 'delete-bin active';
			} else if (allActiveImages == 0) {
				deleteBin.className = 'delete-bin';
			}
		}
	}
}

let clickEditGoodIcons = true;
let divIcon;

function changeDivIcon(div) {
	divIcon = div;
}

let divEditIcon;

function changeDivEditIcon(div) {
	divEditIcon = div;
}

function launchIconsPopUp() {
	let editing = mainContent.querySelector('.editing_good');
	let goodId = editing.dataset.id;
	
	currentTableId = goodId;
	
	onlyOne = 1;
	
	loadingImagesInPopUp(2, 'product-attributes/', editingDOMnotSelectToSelect, editingDOMyesSelectToNotSelect, 'ShopProductAtribute', 'productId', goodId);
	clickEditGoodIcons = false;
}

function deleteTitleError() {
	modalError.style.display = "none";
}
