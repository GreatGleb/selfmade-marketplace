let editStockroom = document.querySelectorAll('.table_stockrooms tbody .editStockroom');

let mainContent = document.querySelector('.mainHtmlContent');

let isLaunchSaving = 0;

let isFirstLaunchEditingStockroom = true;
for(let stockroom of editStockroom) {
	stockroom.addEventListener('click', actionStockroom, false);
}

let deleteStockroom = document.querySelectorAll('.table_stockrooms tbody .deleteStockroom');

for(let stockroom of deleteStockroom) {
	stockroom.addEventListener('click', actionStockroom, false);
}

let deletingStockId;
let deletingStockTd;
let clickDeletingStock = 0;

function actionStockroom() {
	let td = event.path[0];
	if(event.path[0].className == "editStockroom") {
		editingStockroom(td);
		
		let buttonReplyEditingStockroom = mainContent.querySelector('.editing_stockroom .header .reply-stockroom');
		buttonReplyEditingStockroom.addEventListener('click', function() {
			editingStockroom(td);
		}, false);
	} else if(event.path[0].className == "deleteStockroom") {
		let country = event.path[1].querySelector('.addressCountry').innerText;
		let region = event.path[1].querySelector('.addressRegion').innerText;
		let city = event.path[1].querySelector('.addressCity').innerText;
		let street = event.path[1].querySelector('.addressStreet').innerText;
		let home = event.path[1].querySelector('.addressHome').innerText;
		
		deletingStockId = event.path[1].querySelector('td.none').dataset.id;
		deletingStockTd = event.path[1];
		
		let errorMessage = document.querySelector('.modalBlock.error.warning .modalBody > div:not([class])');
		errorMessage.innerHTML = "<p>Вы действительно хотите удалить склад с адресом<br>("
									+ country + ", " + region + ", " + city + ", " + street + ", " + home + ", " + ")?</p>";
		errorMessage.innerHTML += "<p>При удалении склада у всех товаров, которые закреплены за этим складом, будет сброшено поле склад.</p>";
		toggleModalBlock(4, 1);
	}
}

function editingStockroom(td) {
	let headerMenu = document.querySelector('div.admin-block-top');
	headerMenu.scrollIntoView();
	
	let tr = td.parentNode;

	let tdData = tr.querySelector('td.none');
	
	let phone = tdData.dataset.phone;
	
	let jurSelectedType = tdData.dataset.jurSelectedType;
	let jurType = tdData.dataset.jurType;
	
	let editing = mainContent.querySelector('.editing_stockroom');
	
	editing.dataset.id = tdData.dataset.id;
	
	if(typeof(sellerJuridicName) == "undefined") {
		let editFio = editing.querySelector('.editFio .input');
		let fio = tr.querySelector('td.full_name').innerText;
		editFio.innerText = fio;
	}
	
	let table = mainContent.querySelector('.table_stockrooms');
	table.classList.add('none');
	editing.classList.remove('none');
	
	let editPhone = editing.querySelector('.editContact');
	let editPhoneInput = editPhone.querySelector('input');
	editPhoneInput.value = phone;
	
	function inputingPhone() {
		let input = this.value.replace(/\D/g, '');
		let indexPlus = this.value.indexOf("+");
		
		if(indexPlus) {
			this.value = "+" + input.substring(indexPlus) + input.substring(0, indexPlus);
		} else {
			this.value = "+" + input;
		}
		
		if(this.value.length > 15) {
			this.value = this.value.substring(0, 15);
		}
	}
	
	editPhoneInput.addEventListener('input', inputingPhone, false);
	
	let jurName = tdData.dataset.jurName;
	
	if(typeof(sellerJuridicName) == "undefined") {
		let editJurName = editing.querySelector('.editJurName .input');
		
		if(jurSelectedType !== "") {
			editJurName.innerHTML = jurSelectedType + " «" + jurName + "»";
		} else {
			editJurName.innerHTML = jurType + " «" + jurName + "»";
		}
	}
	
	let addressCountry = tr.querySelector('td.addressCountry').innerText;
	let countries = editing.querySelectorAll('.address-list #stockroom_AddrCountry option');
	
	for(let country of countries) {
		if(addressCountry == country.innerText) {
			country.selected = "selected";
		}
	}
	
	let addressIndex = tdData.dataset.addrPostIndex;
	
	let editIndex = editing.querySelector('.address-list #stockroom_AddrIndex');
	editIndex.value = addressIndex;
	
	let addressRegion = tr.querySelector('td.addressRegion').innerText;
	
	let editRegion = editing.querySelector('.address-list #stockroom_AddrRegion');
	editRegion.value = addressRegion;
	
	let addressCity = tr.querySelector('td.addressCity').innerText;
	
	let editCity = editing.querySelector('.address-list #stockroom_AddrCity');
	editCity.value = addressCity;
	
	let addressStreet = tr.querySelector('td.addressStreet').innerText;
	
	let editStreet = editing.querySelector('.address-list #stockroom_AddrStreet');
	editStreet.value = addressStreet;
	
	let addressHome = tr.querySelector('td.addressHome').innerText;
	
	let editHome = editing.querySelector('.address-list #stockroom_AddrHome');
	editHome.value = addressHome;
	
	let addressOffice = tdData.dataset.addrOffice;
	
	let editOffice = editing.querySelector('.address-list #stockroom_AddrOffice');
	editOffice.value = addressOffice;

	let listOfPVZWithEmpty = tdData.dataset.listOfPvz.split(']]]');
	
	listOfPVZ = [];
	for(let elem of listOfPVZWithEmpty) {
	    if(elem != '') {
	        elem = elem.split(',|,');
	        listOfPVZ.push(elem);
	    }
	}
	
	updatePVZlist(listOfPVZ);
	
	let typePickUp = tdData.dataset.isDeliveryFromPoint;
    
    if(typePickUp == '1') {
        let inputPickupPoint = document.querySelector('#point_type_of_picking');
        inputPickupPoint.checked = true;
    } else if (typePickUp == '0') {
        let inputPickupPoint = document.querySelector('#courier_type_of_picking');
        inputPickupPoint.checked = true;
    }
    
	changeLeftMenuHeight();
}

let buttonForDeleteStock = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');
buttonForDeleteStock.addEventListener('click', beforeDeleteStockPOST, false);

function beforeDeleteStockPOST() {
	if(clickDeletingStock == 0) {
		clickDeletingStock = 1;
		deleteStockPOST();
	}
}

function deleteStockPOST() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/deleteStock.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response == "1") {
			deletingStockTd.remove();
			changeLeftMenuHeight();
			toggleModalBlock(4, 1);
			clickDeletingStock = 0;
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось удалить продавца.');
		}
	});
	xhr.send('"' + deletingStockId + '"');
}

function allDropDownListsToActive() {
	for (const dropdown of document.querySelectorAll(".custom-select-wrapper")) {
		dropdown.addEventListener('click', function () {
			this.querySelector('.custom-dropdown-select').classList.toggle('open');
		})
	}
	
	window.addEventListener('click', function (e) {
		for (const select of document.querySelectorAll('.custom-dropdown-select')) {
			if (!select.contains(e.target)) {
				select.classList.remove('open');
			}
		}
	});
	
	for (const option of document.querySelectorAll(".custom-option")) {
		option.addEventListener('click', function () {
			if (!this.classList.contains('selected')) {
				let selected = this.parentNode.querySelector('.custom-option.selected');
				if(selected != undefined) {
					selected.classList.remove('selected');
				}
				this.classList.add('selected');
				
				let header = this.parentNode.parentNode.querySelector('.custom-select__trigger');
				header.style.height = 'auto';
				let spanHeader = header.querySelector('span');
				spanHeader.dataset.deliveryId = option.dataset.deliveryId;
				spanHeader.dataset.pvzId = option.dataset.pvzId;
				spanHeader.style.padding = '5px 0px 3px 0px';
				spanHeader.innerHTML = this.innerHTML;
			}
		});
	}
}

let getJSON = function(url, successHandler, errorHandler) {
	let xhr = typeof XMLHttpRequest != 'undefined'
		? new XMLHttpRequest()
		: new ActiveXObject('Microsoft.XMLHTTP');
	xhr.open('get', url, true);
	xhr.responseType = 'json';
	xhr.onreadystatechange = function() {
		let status;
		let data;
		
		if (xhr.readyState == 4) { // `DONE`
			status = xhr.status;
			if (status == 200) {
				successHandler && successHandler(xhr.response);
			} else {
				errorHandler && errorHandler(status);
			}
		}
	};
	xhr.send();
};

let services = new Object();

let getDeliveries = function() {
	getJSON('https://api.dostav.im/DeliveryService/dslist?mainService=true', function(data) {
		for(let el of data) {
			services[el.key] = new Object();
			services[el.key]['name'] = el.name;
			services[el.key]['logo'] = el.logo;
		}
		
		console.log(services);
		
	}, function(status) {
		console.log('Something went wrong.');
	});
}

getDeliveries();

function updatePVZlist() {
    let postcode = document.querySelector('#stockroom_AddrIndex').value;
    if(postcode == '' || postcode == undefined) {
        let errorMessage = document.querySelector('.modalBlock.error .modalBody');
		errorMessage.innerHTML = '<p>Для обновления списка пунктов приёма заказов нужно заполнить поле с почтовым индексом города, где находиться данный склад.</p>';
		toggleModalBlock(1, 1);
		return;
    }
    
    let isFromButton = true;
    let arrListPvz;
    if(Array.isArray(arguments[0])) {
        isFromButton = false;
        arrListPvz = arguments[0];
    }
    
    console.log(arguments);
    		    
    getJSON('https://api.dostav.im/Address/CityByPostcode/?postcode=' + postcode + '&fillRegion=true&fillLowerPostcodes=true', function(data) {

    	getJSON('https://api.dostav.im/DeliveryService/Hubs?addressGuid=' + data.guid + '&mainService=true&hubType=1', function(data) {
    		
    		console.log(data);
    		let ul = document.querySelector('ul.pvz_list');
    		ul.innerHTML = "";
    		if(isFromButton) {
        		for(let el of data) {
    	        	console.log(el);
    	        	
    	        	let serviceImg;
    	        	let serviceName;
    	        	
    	        	if(services[el['DsKey']] == undefined) {
    	        	    serviceImg = el['DsKey'];
    	        	    serviceName = el['DsKey'];
    	        	} else {
    	        	    serviceImg = services[el['DsKey']]['logo'];
    	        	    serviceName = services[el['DsKey']]['name'];
    	        	}
    	        	
        			let li = document.createElement('li');
        			
        			li.innerHTML = '<img src="https://dostav.im/img/' + serviceImg + '.png" height="30px" style=" padding-right: 5px; ">' + serviceName;
        			li.innerHTML += '<div class="container deliveryServices">\
        					<div class="custom-select-wrapper">\
        						<div class="custom-dropdown-select">\
        							<div class="custom-select__trigger" style="height: auto;"><span>Выберите службу доставки</span><div class="arrow"></div></div>\
        							<div class="custom-options">\
        							</div>\
        						</div>\
        					</div>\
        				</div>';
        			ul.append(li);
        			
        			for(let pvz of el['Filials']) {
        				let span = document.createElement('span');
        				span.innerHTML = pvz['address'];
        				span.className = 'custom-option';
        				span.dataset.deliveryId = el['DsKey'];
        				span.dataset.pvzId = pvz['id'];
        				li.querySelector('.custom-options').append(span);
        			}
        		}
    		} else {
    		    if(arrListPvz.length > 0) {
    		        for(let el of data) {
    		            let serviceImg;
        	        	let serviceName;
        	        	
        	        	if(services[el['DsKey']] == undefined) {
        	        	    serviceImg = el['DsKey'];
        	        	    serviceName = el['DsKey'];
        	        	} else {
        	        	    serviceImg = services[el['DsKey']]['logo'];
        	        	    serviceName = services[el['DsKey']]['name'];
        	        	}
    		            
            			let li = document.createElement('li');
            			
            			li.innerHTML = '<img src="https://dostav.im/img/' + serviceImg + '.png" height="30px" style=" padding-right: 5px; ">' + serviceName;
            			li.innerHTML += '<div class="container deliveryServices">\
            					<div class="custom-select-wrapper">\
            						<div class="custom-dropdown-select">\
            							<div class="custom-select__trigger" style="height: auto;"><span>Выберите службу доставки</span><div class="arrow"></div></div>\
            							<div class="custom-options">\
            							</div>\
            						</div>\
            					</div>\
            				</div>';
            			ul.append(li);
            			
            			for(let pvz of el['Filials']) {
            			    let span = document.createElement('span');
            				span.innerHTML = pvz['address'];
            				span.className = 'custom-option';
            				span.dataset.deliveryId = el['DsKey'];
            				span.dataset.pvzId = pvz['id'];
            				li.querySelector('.custom-options').append(span);
            				
            				for(let stockPvz of arrListPvz) {
            			        if(stockPvz[0] === el['DsKey'] && stockPvz[1] === pvz['id']) {
            			            span.classList.add('selected');
            			            
            			            let header = li.querySelector('.custom-select__trigger');
                    				let spanHeader = header.querySelector('span');
                    				spanHeader.dataset.deliveryId = el['DsKey'];
                    				spanHeader.dataset.pvzId = pvz['id'];
                    				spanHeader.style.padding = '5px 0px 3px 0px';
                    				spanHeader.innerHTML = pvz['address'];
            			            
            			            break;
            			        }
            			    }
            			}
            		}
    		    }
    		}
    		
    		allDropDownListsToActive();
    		
	        changeLeftMenuHeight();
	        
    		console.log(data);
    	}, function(status) {
    		console.log('Something went wrong.');
    	});
    }, function(status) {
		console.log('Something went wrong.');
	});
}

let buttonUpdatePVZ = document.querySelector('.button-update');
buttonUpdatePVZ.addEventListener('click', updatePVZlist);

function allGoodsToOneStockPOST() {
    let editing = mainContent.querySelector('.editing_stockroom');
	let stockId = editing.dataset.id;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/allGoodsToOneStock.php');

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось присвоить всем товарам данный склад.');
		}
	});
	
	var fd = new FormData;
	fd.append("stockId", stockId);
	xhr.send(fd);
}

let buttonAllGoodsToOneStock = document.querySelector('.all-goods-to-one-stock');
buttonAllGoodsToOneStock.addEventListener('click', allGoodsToOneStockPOST);

changeLeftMenuHeight();