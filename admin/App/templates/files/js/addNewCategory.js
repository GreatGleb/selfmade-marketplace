let labelIsShowForAddNewCategory = document.querySelector('.modalBlock .modalBody div label.switch');
labelIsShowForAddNewCategory.addEventListener('change', function() {
	if(event.path[0].checked) {
		labelIsShowForAddNewCategory.parentNode.querySelector('.isShow').innerText = "Включено";
	}else {
		labelIsShowForAddNewCategory.parentNode.querySelector('.isShow').innerText = "Выключено";
	}
}, false);

let buttonSaveCategory = document.querySelector('.save-new-table');

buttonSaveCategory.addEventListener('click', function() {
	let name = document.getElementById('add_new_category_name').value;
	let desc = document.getElementById('add_new_category_desc').value;
	let sel = document.getElementById('add_new_parent_category');
	let parentCategory = sel.options[sel.selectedIndex].value;
	let html_title = document.getElementById('add_new_category_html_title').value;
	let keywords = document.getElementById('add_new_category_keyword').value;
	let url = document.getElementById('add_new_category_url').value;
	let stat = document.getElementById('add_new_category_status').innerText;
	
	if(stat == 'Выключено') {
		stat = 0;
	} else {
		stat = 1;
	}
	
	if(name.length > 3 && desc.length > 5) {
		addNewCategoryPOST(name, desc, parentCategory, html_title, keywords, url, stat);
	} else {
		popUpError();
	}
}, false);

function addNewCategoryPOST(name, description, parentCategoryId, htmlTitle, metaKeywords, url, statusOfCategory) {
	
	console.log(parentCategoryId);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/addNewCategory.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			successAddingNewCategory(e.target.response);
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось добавить категорию.');
			popUpError();
		}
	});

	xhr.send('["' + name + '", "' + description + '", "' + parentCategoryId + '", "' + htmlTitle + '", "' + metaKeywords + '", "' + url + '", "' + statusOfCategory + '"]');
}

function successAddingNewCategory(id) {
	toggleModalBlock(1, 1);

	let newTr = document.createElement('tr');
	newTr.dataset.id = id;
	
	let name = document.getElementById('add_new_category_name').value;
	let desc = document.getElementById('add_new_category_desc').value;
	let sel = document.getElementById('add_new_parent_category');
	let parentCategory = sel.options[sel.selectedIndex].innerText;
	let html_title = document.getElementById('add_new_category_html_title').value;
	let keywords = document.getElementById('add_new_category_keyword').value;
	let url = document.getElementById('add_new_category_url').value;
	let stat = document.getElementById('add_new_category_status').innerText;
	
	let tdName = document.createElement('td');
	tdName.innerText = name;
	let tdDesc = document.createElement('td');
	tdDesc.innerText = desc;
	let tdParnt = document.createElement('td');
	tdParnt.innerText = parentCategory;
	let tdImg = document.createElement('td');
	let tdTitle = document.createElement('td');
	tdTitle.innerText = html_title;
	let tdKeywords = document.createElement('td');
	tdKeywords.innerText = keywords;
	let tdURL = document.createElement('td');
	tdURL.innerText = url;
	let tdStat = document.createElement('td');
	tdStat.innerText = stat;
	let tdEdit = document.createElement('td');
	tdEdit.className = "editCategory";
	tdEdit.innerHTML = "<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"iconEdit toggleModal0\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
						<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>\
					</svg>Редактировать";
	let tdDelete = document.createElement('td');
	tdDelete.className = "deleteCategory";
	tdDelete.innerHTML = "<td class=\"deleteCategory\">\
							<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"version=&quot;1.1&quot;\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
								<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\"><path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"></path><path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path></g>\
							</svg><br>Удалить\
						  </td>";
	
	newTr.append(tdName);
	newTr.append(tdDesc);
	newTr.append(tdParnt);
	newTr.append(tdImg);
	newTr.append(tdTitle);
	newTr.append(tdKeywords);
	newTr.append(tdURL);
	newTr.append(tdStat);
	newTr.append(tdEdit);
	newTr.append(tdDelete);
	
	tdEdit.addEventListener('click', actionCategory, false);
	tdDelete.addEventListener('click', deletingCategory, false);
	
	document.querySelector('table tbody').append(newTr);
	changeLeftMenuHeight();
}

function popUpError() {
	let modalError = document.querySelector('.modalBlock.error');
	modalError.querySelector('.modalBody').innerHTML = '<p style="text-align: center;">Поля с названием категории и её описанием должны быть обязательно заполнены.<br>В поле URL ссылка должна быть уникальной.</p>';
	toggleModalBlock(2, 2);
}