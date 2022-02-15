let buttonSaveEditingStockroom = document.querySelector('.editing_stockroom .header .save-stockroom');
buttonSaveEditingStockroom.addEventListener('click', saveEditingStockroom, false);

function saveEditingStockroom() {
	let editing = mainContent.querySelector('.editing_stockroom');
	
	let stockroomId = editing.dataset.id;
	
	let isNormal = true;
	let errorField = "";
	
	let tdData = document.querySelector('.table_stockrooms tbody tr td:first-child[data-id="' + stockroomId + '"]');
	
	let addrId = tdData.dataset.addrId;
	let addrIndex = editing.querySelector('.address-list #stockroom_AddrIndex').value;
	let addrCountry = editing.querySelector('.address-list #stockroom_AddrCountry option:checked').innerText;
	let addrRegion = editing.querySelector('.address-list #stockroom_AddrRegion').value;
	if(addrIndex == '') {
		isNormal = false;
		errorField += "<p>Введите почтовый индекс для адреса склада.</p>";
	}
	if(addrRegion == '') {
		isNormal = false;
		errorField += "<p>Введите регион для адреса склада.</p>";
	}
	
	let addrCity = editing.querySelector('.address-list #stockroom_AddrCity').value;
	if(addrCity == '') {
		isNormal = false;
		errorField += "<p>Введите город для адреса склада.</p>";
	}
	
	let addrStreet = editing.querySelector('.address-list #stockroom_AddrStreet').value;
	if(addrStreet == '') {
		isNormal = false;
		errorField += "<p>Введите улицу для адреса склада.</p>";
	}
	
	let addrHome = editing.querySelector('.address-list #stockroom_AddrHome').value;
	if(addrHome == '') {
		isNormal = false;
		errorField += "<p>Введите дом для адреса склада.</p>";
	}
	
	let isTypePickupFromPoint;
	let typePickup = document.querySelector('input[name="type_of_picking_goods_for_delivery"]:checked');
	if(typePickup != null) {
	    if(typePickup.value == 'point') {
	        isTypePickupFromPoint = 1;
	    } else if (typePickup.value == 'courier') {
	        isTypePickupFromPoint = 0;
	    }
	} else {
		isNormal = false;
		errorField += "<p>Выберите способ приёма товаров для доставки.</p>";
	}
	
	let listOfPVZ = [];
	
	if(isTypePickupFromPoint == 1) {
	    let ul_pvz = document.querySelector('ul.pvz_list');
	    let li_pvz = ul_pvz.querySelectorAll('li');
	    if(li_pvz.length == 0) {
	        isNormal = false;
		    errorField += "<p>Обновите список пунктов приёма заказов и выбирете в каждой службе доставки пукнт приёма заказов.</p>";
	    } else {
	        let i = 0;
	        let isFilledListPVZ = true;
	        for(let li of li_pvz) {
	            let liSpan = li.querySelector('.custom-select__trigger span');
	            
                let deliveryId = liSpan.dataset.deliveryId;
                let pvzId = liSpan.dataset.pvzId;
	            if(liSpan == null || deliveryId == undefined) {
	                isFilledListPVZ = false;
	            } else {
	                listOfPVZ[i] = {};
	                listOfPVZ[i]['deliveryId'] = deliveryId;
	                listOfPVZ[i]['pvzId'] = pvzId;
	            }
	            i++;
	        }
	        if(!isFilledListPVZ) {
                isNormal = false;
	            errorField += "<p>Выбирете в каждой службе доставки пукнт приёма заказов.</p>";
	        }
	    }
	}
	
	let strListOfPVZ = '';
	
	for(let elem of listOfPVZ) {
	    strListOfPVZ += elem['deliveryId'] + ',|,' + elem['pvzId'] + ']]]';
	}

    listOfPVZ = JSON.stringify(listOfPVZ);
    console.log(listOfPVZ);
	        
	let addrOffice = editing.querySelector('.address-list #stockroom_AddrOffice').value;
	
	let phone = editing.querySelector('.editContact #stockroom_contact').value;
	if(phone == '+') {
		isNormal = false;
		errorField += "<p>Введите контактный телефон для склада.</p>";
	}
	
	if(!isNormal) {
		let errorMessage = document.querySelector('.modalBlock.error .modalBody');
		errorMessage.innerHTML = errorField;
		toggleModalBlock(1, 1);
	} else {
		tdData.dataset.phone = phone;
		tdData.dataset.addrPostIndex = addrIndex;
		tdData.dataset.addrOffice = addrOffice;
		tdData.dataset.isDeliveryFromPoint = isTypePickupFromPoint;
		tdData.dataset.listOfPvz = strListOfPVZ;
		
		saveEditingStockroomPOST(stockroomId, addrCountry, addrIndex, addrRegion,
								addrCity, addrStreet, addrHome, addrOffice, phone, isTypePickupFromPoint, listOfPVZ);
	}
}

function saveEditingStockroomPOST(stockroomId, addrCountry, addrIndex, addrRegion,
								addrCity, addrStreet, addrHome, addrOffice, phone, isTypePickupFromPoint, listOfPVZ) {							
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/saveEditingStockroom.php');

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
			let tr = document.querySelector('.table_stockrooms tbody tr td:first-child[data-id="' + stockroomId + '"]').parentNode;
			
			tr.querySelector('td.addressCountry').innerText = addrCountry;
			tr.querySelector('td.addressRegion').innerText = addrRegion;
			tr.querySelector('td.addressCity').innerText = addrCity;
			tr.querySelector('td.addressStreet').innerText = addrStreet;
			tr.querySelector('td.addressHome').innerText = addrHome;
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('К сожалению, не удалось сохранить изменения для данного склада.');
		}
	});
	
	var fd = new FormData;
	fd.append("stockroomId", stockroomId);
	fd.append("addrCountry", addrCountry);
	fd.append("addrIndex", addrIndex);
	fd.append("addrRegion", addrRegion);
	fd.append("addrCity", addrCity);
	fd.append("addrStreet", addrStreet);
	fd.append("addrHome", addrHome);
	fd.append("addrOffice", addrOffice);
	fd.append("phone", phone);
	fd.append("isTypePickupFromPoint", isTypePickupFromPoint);
	fd.append("listOfPVZ", listOfPVZ);
	xhr.send(fd);
}