let editCategory = document.querySelectorAll('.table_categories tbody .editCategory');

for(let category of editCategory) {
	category.addEventListener('click', actionCategory, false);
}

let deleteCategory = document.querySelectorAll('.table_categories tbody .deleteCategory');

let clickDeletingCategory = 0;
let trDeletingCategory;

for(let category of deleteCategory) {
	category.addEventListener('click', deletingCategory, false);
}

function actionCategory() {
	if(event.path[0].className == "editCategory") {
		editingCategory(event.path[0]);
	} else if(event.path[0].className == "saveCategory") {
		savingCategory(event.path[0]);
	}
}

function editingCategory(td) {
	td.className = "saveCategory";
	td.innerHTML = "<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"iconEdit toggleModal0\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 -256 1792 1792\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
		<g transform=\"matrix(1,0,0,-1,129.08475,1270.2373)\"><path d=\"m 384,0 h 768 V 384 H 384 V 0 z m 896,0 h 128 v 896 q 0,14 -10,38.5 -10,24.5 -20,34.5 l -281,281 q -10,10 -34,20 -24,10 -39,10 V 864 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 v 416 H 128 V 0 h 128 v 416 q 0,40 28,68 28,28 68,28 h 832 q 40,0 68,-28 28,-28 28,-68 V 0 z M 896,928 v 320 q 0,13 -9.5,22.5 -9.5,9.5 -22.5,9.5 H 672 q -13,0 -22.5,-9.5 Q 640,1261 640,1248 V 928 q 0,-13 9.5,-22.5 Q 659,896 672,896 h 192 q 13,0 22.5,9.5 9.5,9.5 9.5,22.5 z m 640,-32 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 96 q -40,0 -68,28 -28,28 -28,68 v 1344 q 0,40 28,68 28,28 68,28 h 928 q 40,0 88,-20 48,-20 76,-48 l 280,-280 q 28,-28 48,-76 20,-48 20,-88 z\"></path></g>\
		</svg><br>Сохранить";
		
	let allTd = td.parentNode.querySelectorAll('td');
	let id = td.parentNode.dataset.id;
	
	for(let i = 0; i < allTd.length; i++) {
		if(i < 2 || (i > 3 && i < 7)) {			
			let td = allTd[i];
			let text = td.innerHTML;
			let tdWidth = td.clientWidth - 32;
			let tdHeight;
			if(i == 0) {
				tdHeight = td.clientHeight - 10;
			} else {
				tdHeight = td.clientHeight - 27;
			}
			td.innerHTML = "<textarea style=\"width:" + tdWidth + "px; height:" + tdHeight + "px;\">" + text + "</textarea>";
		} else if(i == 2) {		
			let td = allTd[i];
			let parentCategory = allTd[2].innerHTML;
			let options = "";
			options += "<option value=\"\"></option>";
			for(let i = 0; i < categoriesNames.length; i++) {
				let option = categoriesNames[i];
				let categId = option[1];
				
				if(id != ++i) {
					options += "<option value=\"" + categId + "\"";
					
					if(parentCategory == option[0]) {
						options += " selected";
					}
					
					options += ">" + option[0] + "</option>";
				}
				i--;
			}
			td.innerHTML = "<select>" + options + "</select>";
			
		} else if(i == 3) {
			let td = allTd[i];
			td.className = "imageCategoryEdit toggleModal0";
			td.innerHTML += "<svg width=\"20px\" height=\"20px\" class=\"toggleModal0\" title=\"change\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
								<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>\
							</svg>";
			td.addEventListener('click', openImageModal, false);
		} else if(i == 7) {
			let td = allTd[i];
			if(td.innerText == "Выключено") {
				td.innerHTML += "<label class=\"switch\">\
								  <input type=\"checkbox\">\
								  <span class=\"slider round\"></span>\
								</label>";
			} else {
				td.innerHTML += "<label class=\"switch\">\
								  <input type=\"checkbox\" checked>\
								  <span class=\"slider round\"></span>\
								</label>";
			}
			td.querySelector('label.switch').addEventListener('change', function() {
				if(event.path[0].checked) {
					td.querySelector('.isShow').innerText = "Включено";
				}else {
					td.querySelector('.isShow').innerText = "Выключено";
				}
			}, false);
		}
	}
}

function openImageModal() {
	let len = event.path.length;
	let td = event.path[len-9].querySelector('td.imageCategoryEdit');
	
	let id = td.parentNode.dataset.id;
	
	let allTdForEditingImages = document.querySelectorAll('td.imageCategoryEdit');
	
	if(allTdForEditingImages !== null) {
		for(let elem of allTdForEditingImages) {
			elem.dataset.showPopUp = "false";
		}
	}
	
	td.dataset.showPopUp = "true";
	
	let allImages = document.querySelectorAll('.windowAllImages .rowImages .imageCart');
	for (let elem of allImages) {
	  if(elem.querySelector('.select')!= null) {
			elem.querySelector('.select').className = "hoverForSelect notSelect";			
		}
	}
	
	let img = td.querySelector('img');
	if(img !== null) {
		let src = img.dataset.src;
		let ind = src.indexOf('App/templates');		
		let newSrc = src.slice(ind);
		
		let modalImg = document.querySelector('.modalBlock img[src="' + newSrc + '"]');
		console.log('.modalBlock img[src="' + newSrc + '"]');
		if(modalImg !== null) {
			modalImg.parentNode.classList.remove('notSelect');
			modalImg.parentNode.classList.add('select');
		}
	} else {
		let modalImg = document.querySelector('.modalBlock .hoverForSelect.select');
		if(modalImg !== null) {
			modalImg.classList.remove('select');
			modalImg.classList.add('notSelect');
		}				
	}
	
	currentTableId = id;
	
	loadingImagesInPopUp(0, 'categories/', editingDOMnotSelectToSelect, editingDOMyesSelectToNotSelect, 'ImagesForCategory', 'categoryId', id);
	toggleModalBlock(0, 1);
}

function savingCategory(td) {
	
	td.className = "editCategory";
	td.innerHTML = "<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"iconEdit toggleModal0\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
						<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>\
					</svg>Редактировать";
					
	let allTd = td.parentNode.querySelectorAll('td');
	
	let id = td.parentNode.dataset.id;
	
	for(let i = 0; i < allTd.length; i++) {
		if(i < 2 || (i > 3 && i < 7)) {			
			let td = allTd[i];
			let text = td.querySelector('textarea').value;
			let tdWidth = td.clientWidth - 32;
			let tdHeight;
			if(i == 0) {
				tdHeight = td.clientHeight - 10;
			} else {
				tdHeight = td.clientHeight - 27;
			}
			td.innerHTML = text;
		} else if(i == 2) {
			let td = allTd[i];
			let parentCategory;
			let parentCategorySelect = allTd[2].querySelector('select');
			
			parentCategory = parentCategorySelect.options[parentCategorySelect.selectedIndex].innerText;
			parentCategoryId = parentCategorySelect.options[parentCategorySelect.selectedIndex].value;
			
			td.innerHTML = parentCategory;
		} else if(i == 3) {
			let td = allTd[i];
			td.removeEventListener('click', openImageModal);
			td.className = "";
			td.querySelector('svg').remove();
		} else if(i == 7) {
			let td = allTd[i];
			td.querySelector('label').remove();
		}
	}
	
	editCategoryPOST(id, allTd[0].innerHTML, allTd[1].innerHTML, parentCategoryId, allTd[4].innerHTML, allTd[5].innerHTML, allTd[6].innerHTML, allTd[7].innerText);
}

function editCategoryPOST(idCategory, name, description, parentCategoryId, htmlTitle, metaKeywords, url, statusOfCategory) {
	
	console.log(statusOfCategory);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/editCategory.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось изменить категорию.');
		}
	});

	xhr.send('["' + idCategory + '", "' + name + '", "' + description + '", "' + parentCategoryId + '", "' + htmlTitle + '", "' + metaKeywords + '", "' + url + '", "' + statusOfCategory + '"]');
}

function deletingCategory() {
	let len = event.path.length;
	trDeletingCategory = event.path[len-9];
	
	let nameCategory = trDeletingCategory.querySelector('td').innerText;
	
	let errorMessage = document.querySelector('.modalBlock.error.warning .modalBody > div:not([class])');
	errorMessage.innerHTML = "<p>Вы действительно хотите удалить категорию " + nameCategory +"?</p>";
	errorMessage.innerHTML += "<p>При удалении категории её нельзя будет восстановить, она пропадёт с платформы Saterno, а поле категории для товаров, закреплённых за этой категорией будут сброшенны.</p>";
	toggleModalBlock(3, 1);
}

function beforeDeletingCategoryPOST() {
	if(clickDeletingCategory == 0) {
		clickDeletingCategory = 1;		
		console.log("kjh");
		deletingCategoryPOST(trDeletingCategory);
	}
}

let buttonForDeleteSeller = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');
buttonForDeleteSeller.addEventListener('click', beforeDeletingCategoryPOST, false);

function deletingCategoryPOST(tr) {
	let id = tr.dataset.id;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/deletingCategory.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
			tr.remove();
			toggleModalBlock(3, 1);
			clickDeletingCategory = 0;
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось изменить категорию.');
		}
	});

	xhr.send('"' + id + '"');
}

changeLeftMenuHeight();