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

let sendAndGetJSON = function(data, url, successHandler, errorHandler) {
	let xhr = typeof XMLHttpRequest != 'undefined'
		? new XMLHttpRequest()
		: new ActiveXObject('Microsoft.XMLHTTP');
	
	let json = JSON.stringify(data);
	
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
	xhr.send(json);
};

let postJSON = function(data, url, successHandler, errorHandler) {
	console.log('post');
	let xhr = new XMLHttpRequest();

	let json = JSON.stringify(data);

	xhr.open("POST", url);
	//xhr.responseType = 'json';
	xhr.setRequestHeader('Authorization', '42b33d37-8701-417c-8418-7c8577c678fa');

	xhr.setRequestHeader('Content-type', 'application/json');
	//xhr.setRequestHeader('Api-Version', '2');
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

	xhr.send(json);
}

let postSTR = function(url, successHandler, errorHandler) {
	console.log('post');
	let xhr = new XMLHttpRequest();
	
	xhr.open("get", url, true);
	xhr.responseType = 'json';
	//xhr.setRequestHeader('Authorization', '42b33d37-8701-417c-8418-7c8577c678fa');

	//xhr.setRequestHeader('Content-type', 'application/json');
	//xhr.setRequestHeader('Api-Version', '2');
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
}

/*
getJSON('https://api.dostav.im/Calculator?addressFrom=0c5b2444-70a0-4932-980c-b4dc0d3f02b5&addressTo=ea2a1270-1e19-4224-b1a0-4228b9de3c7a&weight=1000&width=10&length=10&height=10&mainService=true&full=true', function(data) {
	console.log('Your is: ');
    console.log(data);
}, function(status) {
	console.log('Something went wrong.');
});
	*/
/*
*/
let orderCreate = {
	"OrderId": 0,
    "Parts": [
        {
            "Id": 1,
            "LengthCm": 10,
            "WidthCm": 10,
            "HeightCm": 10,
            "WeightGm": 1000,
            "Items": [
                {
                    "Name": "Name 1-1",
                    "AssessedCost": 100,
                    "Quantity": 1,
                    "WeightGm": 1000
                }
            ]
        }
    ],
    "ClientOrderNumber": "12345",
    "SenderAddress": "ул. Тверская д.1",
    "SenderRegion": "Москва",
    "SenderCity": "Москва",
    "SenderStreet": "ул. Тверская",
    "SenderHome": "2",
    "SenderIndex": "10100",
    "SenderComment": "",
    "SenderFullName": "Петр Иванович Белов",
    "SenderPhone": "89035291401",
    "SenderCompany": "",
    "RecepientAddress": "г.Санкт-Петербург",
    "RecepientRegion": "г. Санкт-Петербург",
    "RecepientCity": "г. Санкт-Петербург",
    "RecepientStreet": "",
    "RecepientHome": "",
    "RecepientIndex": "",
    "RecepientAddressHidden": "",
    "RecepientComment": "",
    "RecepientFullName": "Василий Петрович Черновиков",
    "RecepientPhone": "89031111111",
    "RecepientCompany": "",
    "DispatchDate": "2019-10-30T18:25:43.511Z",
    "ParcelType": 2,
    "AssessedCost": 400,
    "Description": "Описание",
    "TariffId": "IND",
    "TariffProviderId": "dpd",
    "PickupType": 1,
    "DeliveryType": 2,
    "DeliveryPointId": "005Q",
    "TariffCost": "1258",
    "CourierCallCost": 0,
    "SenderAdvanceAddress": {
        "CityGuid": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
        "Street": "ул. Тверская",
		"StreetCode": "77000000000287700",
        "Home": "2",
        "Building": "",
        "Structure": "",
        "Flat": "100"
    },
    "RecepientAdvanceAddress": {
        "CityGuid": "c2deb16a-0330-4f05-821f-1d09c93331e6",
        "Street": "",
        "Home": ""
    },
    "DelLin": {
        "RecepientType": 1,
        "RecepientPhisical": {
            "DocumentType": 0,
            "DocumentNumber": "292929",
            "DocumentSeries": "0707",
            "DocumentDate": "2019-01-01"
        }
    }
}
/*
postJSON(orderCreate, 'https://api.dostav.im/Order/Create?isDraft=true&callCourier=false', function(data) { //?isDraft=false&callCourier=false
	
	console.log(data);
	
}, function(status) {
	console.log('Something went wrong.');
});
*/
/*
getJSON('https://api.dostav.im/Address/GetStreets/?name=Тверская&guid=0c5b2444-70a0-4932-980c-b4dc0d3f02b5', function(data) {
	console.log('Your is: ');
    console.log(data);
}, function(status) {
	console.log('Something went wrong.');
});
*/
//0ecde158-a58f-43af-9707-aa6dd3484b56

let getCities = function (city) {
	
	getJSON('https://apidemo.dostav.im/Address/City/?partName=' + city + ' &fillRegion=true&fillLowerPostcodes=true', function(data) {
		cities = data;
	}, function(status) {
		cities = false;
	});
	
	return cities;
}

let inputCityValueToHelp = function() {
	let parentContainer = this.parentNode.parentNode;
	
	let inputCity = parentContainer.querySelector('.autocomplete__input[name="search"]');
	inputCity.value = this.getAttribute('value');
	inputCity.setAttribute('guid', this.getAttribute('guid'));
	inputCity.dataset.regionName = this.dataset.regionName;
	
	this.parentNode.innerHTML = '';
	//console.log(this);
	findDeliveryServices();
}

let servicesLogo = new Object();

let getDeliveries = function() {
	getJSON('https://apidemo.dostav.im/DeliveryService/dslist?mainService=true', function(data) {
		for(let el of data) {
			servicesLogo[el.key] = el.logo;
		}
		
		console.log(servicesLogo);
		
	}, function(status) {
		console.log('Something went wrong.');
	});
}

getDeliveries();

let pvzList;

let appendDeliveryServices = function(arrServices, pickupType, i) {
	console.log('jgj');
	let city = document.querySelector('.js-city .autocomplete__input[name="search"]');
	
	let deliveryBlocks = document.querySelectorAll('.container_delivery');
	
	getJSON('https://api.dostav.im/DeliveryService/Hubs?addressGuid=' + city.getAttribute('guid') + '&mainService=true', function(data) {
		pvzList = data;
		
		let container = deliveryBlocks[i];
		
		console.log(container);
		
		let headerDeliveryServices = container.querySelector('.container.deliveryServices .custom-select__trigger');
		headerDeliveryServices.innerHTML = '<span>Выберите службу доставки</span><div class="arrow"></div>';
		
		let selectDeliveryServices = container.querySelector('.container.deliveryServices .custom-options');
		selectDeliveryServices.innerHTML = '';
		for(let service of arrServices) {			
			let deliveryCost = service[1];
			let deliveryCostWithUp = Math.ceil(Number(service[1])*1.1);
			let deliveryDate = service[2].substring(0, service[2].indexOf('T'));
			let deliveryPickupDate = service[4];
			let tariffId = service[3];
			let courierCost = service[5];
			
			let span = document.createElement('span');
			span.dataset.deliveryId = service[0][0];
			span.dataset.deliveryCost = service[1];
			span.dataset.deliveryCostWithUp = deliveryCostWithUp;
			span.dataset.deliveryDate = deliveryDate;
			span.dataset.deliveryPickupDate = deliveryPickupDate;
			span.dataset.deliveryTarifId = tariffId;
			span.dataset.courierCost = courierCost;
			
			span.innerHTML = '<img src="https://dostav.im/img/' + service[0][0] + '.png" height="30px" style=" padding-right: 5px; ">';
			span.innerHTML += service[0][1] + ', доставка - ' + deliveryDate + ', ' + deliveryCostWithUp + ' руб';		
			span.className = "custom-option first";
			selectDeliveryServices.append(span);
		}
		
		let containerPVZ = container.querySelector('.deliveryPVZ.second');
		containerPVZ.style.display = 'none';
		let customOptions = containerPVZ.querySelector('.custom-options');
		customOptions.innerHTML = '';
		
		optionsToActive('first', pickupType);
	}, function(status) {
		console.log('Something went wrong.');
	});
}

let findDeliveryServices = function() {
	let inputTypeDelivery = document.querySelector('input[name="types_delivery"]:checked');
	let city = document.querySelector('.js-city .autocomplete__input[name="search"]');
	
	if(inputTypeDelivery != undefined && city.value != '') {
		
		let type = inputTypeDelivery.value;		
		let pickupType;		
		if(type == 'courier') {
			pickupType = 1;
		} else if(type == 'pickup') {
			pickupType = 2;
		}		
		console.log('start');
		
		let productHeaders = document.querySelectorAll('.checkout-product__header');
		let productUls = document.querySelectorAll('.checkout-product__header + ul');
		
	    let deliveryBlocks = document.querySelectorAll('.container_delivery');
	    
		for(let i = 0; i < productHeaders.length; i++) {
		    let container = deliveryBlocks[i];
		
    		let headerDeliveryServices = container.querySelector('.container.deliveryServices .custom-select__trigger');
    		headerDeliveryServices.innerHTML = '<span>Выберите службу доставки</span><div class="arrow"></div>';
    		
    		let selectDeliveryServices = container.querySelector('.container.deliveryServices .custom-options');
    		selectDeliveryServices.innerHTML = '';
    		
			let postcode = productHeaders[i].dataset.cityPostcode;
			console.log(productHeaders[i]);
			let products = productUls[i].querySelectorAll('.checkout-product');
			
			let sizes = [];
			let sides = [];
			let widthes = [];
			let costes = [];
			
			for(let el of products) {
				sides.push([el.dataset.productLength, el.dataset.productWidth, el.dataset.productHeight]);
				sizes.push(el.dataset.productLength, el.dataset.productWidth, el.dataset.productHeight);
				widthes.push(Number(el.dataset.productWeight)*Number(el.dataset.productNumber));
				costes.push(Number(el.dataset.productBaseCost));
			}
			
			let weightOrder = widthes.reduce((accumulator, currentValue) => accumulator + currentValue);
			
			let heightOrder = 0;
			for(let el of sides) {
				heightOrder += Math.min.apply(Math, el);
			}
			
			sizes = sizes.sort();
			
			let widthOrder = Number(sizes[sizes.length - 2]);
			let lengthOrder = Number(sizes[sizes.length - 1]);
			
			let costOrder = costes.reduce((accumulator, currentValue) => accumulator + currentValue);
			let placeCount = products.length;
			
			productHeaders[i].dataset.weight = weightOrder;
			productHeaders[i].dataset.width = widthOrder;
			productHeaders[i].dataset.length = lengthOrder;
			productHeaders[i].dataset.height = heightOrder;
			productHeaders[i].dataset.assesedCost = costOrder;
			
			let isDeliveryFromPoint = productHeaders[i].dataset.stockIsDeliveryFromPoint;
			let stockPickUpType;
			if(isDeliveryFromPoint == '1') {
			    stockPickUpType = 2;
			} else {
			    stockPickUpType = 1;
			}
			
			getJSON('https://apidemo.dostav.im/Address/CityByPostcode/?postcode=' + postcode + '&fillRegion=true&fillLowerPostcodes=true', function(data) {
				console.log(data);				
				console.log(widthOrder, lengthOrder, heightOrder);
				
				productHeaders[i].dataset.cityGuid = data.guid;
				
				getJSON('https://apidemo.dostav.im/Calculator?addressFrom=' + data.guid + '&addressTo=' + city.getAttribute('guid') + '&weight=' + weightOrder + '&width=' + widthOrder + '&length=' + lengthOrder + '&height=' + heightOrder + '&assesedCost=' + costOrder + '&placeCount=' + placeCount + '&mainService=true&AllowToReadCache=true&full=true', function(data) {
					let servicesArr = [];
					console.log(data);
					for(let el of data) {
						if(el.pickUpType == stockPickUpType && el.deliveryType == pickupType) {
							servicesArr.push([[el.deliveryService.id, el.deliveryService.name], el.cost, el.deliveryDateMax, el.tariffId, el.pickUpDate, el.courierCost]);
						}
					}
					
					console.log(data);
					appendDeliveryServices(servicesArr, pickupType, i);
					console.log(i);
					
				}, function(status) {
					console.log('Something went wrong.');
				});
				
			}, function(status) {
				console.log('Something went wrong.');
			});
		}
	}
}

let inputCitiesEventChooseHelp = function() {
	let allHelps = document.querySelectorAll(".city-help-inputs");
	
	for(let elem of allHelps) {
		elem.addEventListener('click', inputCityValueToHelp);
	}
}

let inputCityShowHelps = function() {
	this.removeAttribute('guid');
	let value = this.value;
	
	let cities = [];
	let mainContainer = this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
	let region = mainContainer.querySelector('.js-region-field option:checked');
	
	let helpContainer = this.parentNode.parentNode.parentNode.querySelector('.container-city-help-inputs');

	getJSON('https://apidemo.dostav.im/Address/City/?partName=' + value + ' &fillRegion=true&fillLowerPostcodes=true', function(data) {
		
		for(let el of data) {
			cities.push([el.name, el.path, el.regionName, el.guid]);
		}
		
		console.log(cities);
		console.log(data);
		
		helpContainer.innerHTML = '';
			
		if(region.value == '') {
			
			if(cities.length > 0) {
				for(let i = 0; i < cities.length; i++) {
					if(cities[i] != undefined) {
						let newHelp = document.createElement('div');
						newHelp.className = 'city-help-inputs';
						newHelp.setAttribute('value', cities[i][0]);
						newHelp.setAttribute('guid', cities[i][3]);
						newHelp.dataset.regionName = cities[i][2];
						newHelp.innerText = cities[i][0] + ' ' + cities[i][1];
						
						helpContainer.append(newHelp);
					}
				}
			}
		} else {
			
			let regionStr = region.innerText;
			let posSpace = regionStr.indexOf(' ');
			regionStr = regionStr.substring(0, posSpace);
			
			let countHelps = 0;
			
			for(let i = 0; i < cities.length; i++) {
				if(cities[i] != undefined) {
					if(cities[i][2].indexOf(regionStr) >= 0 && countHelps < 6) {
						let newHelp = document.createElement('div');
						newHelp.className = 'city-help-inputs';
						newHelp.setAttribute('value', cities[i][0]);
						newHelp.setAttribute('guid', cities[i][3]);
						newHelp.innerText = cities[i][0] + ' ' + cities[i][1];
						
						helpContainer.append(newHelp);
						console.log(cities);
						countHelps++;
					}
				}
			}
			
			console.log(regionStr);
		}
		
		inputCitiesEventChooseHelp();
		
	}, function(status) {
		console.log(false);
	});
	
	console.log();	
}

let blurCityShowHelps = function() {
	let help = this;
	
	setTimeout(function() {
		let guid = help.getAttribute('guid');
		
		if(guid == undefined) {
			help.value = '';
		}
		
		let helpContainer = help.parentNode.parentNode.parentNode.querySelector('.container-city-help-inputs');
		helpContainer.innerHTML = '';
	}, 300);
}

let inputCityEventToShowHelps = function() {
	let allInputsCities = document.querySelectorAll('.js-city .autocomplete__input[name="search"]');
	
	for(let elem of allInputsCities) {
		elem.addEventListener('input', inputCityShowHelps);
		elem.addEventListener('blur', blurCityShowHelps);
	}
}

let changeInputsAddressToRequired = function(input) {
	let inputCity = document.querySelector('.autocomplete__input.search-city[name="search"]');
	let inputStreet = document.querySelector('.autocomplete__input[name="street"]');
	let inputHome = document.querySelector('.autocomplete__input[name="numberHome"]');
	let inputFlat = document.querySelector('.autocomplete__input[name="number_flat"]');
	let c = inputCity.parentNode.parentNode.parentNode.querySelector('.wa-required');
	let s = inputStreet.parentNode.parentNode.parentNode.querySelector('.wa-required');
	let h = inputHome.parentNode.parentNode.parentNode.querySelector('.wa-required');
	
	let deliveries = document.querySelectorAll('.container_delivery');
	
	console.log(input);
	if (input.value == 'courier') {
		c.style.display = 'inline';	
		s.style.display = 'inline';
		h.style.display = 'inline';
		
		for(let el of deliveries) {
		    el.style.display = 'block';
		}
	} else if (input.value == 'pickup') {
		c.style.display = 'inline';	
		s.style.display = 'none';
		h.style.display = 'none';
		
		for(let el of deliveries) {
		    el.style.display = 'block';
		}
	} else if (input.value == 'pickup-from-stock') {
		c.style.display = 'none';
		s.style.display = 'none';
		h.style.display = 'none';
		
		for(let el of deliveries) {
		    el.style.display = 'none';
		}
	}
}

let changeTypesDelivery = function() {
	findDeliveryServices();
	changeInputsAddressToRequired(this);
}

let typesDeliveryToChange = function() {
	let allTypesDelivery = document.querySelectorAll('input[name="types_delivery"]');
	
	for(let elem of allTypesDelivery) {
		elem.addEventListener('change', changeTypesDelivery);
	}
}

let appendSelectPVZ = function(deliveryId, container) {
	console.log(deliveryId);
	let containerPVZ = container.querySelector('.deliveryPVZ.second');
	
	let customOptions = containerPVZ.querySelector('.custom-options');
	customOptions.innerHTML = '';
	
	for(let el of pvzList) {
		if(el.DsKey == deliveryId) {
			console.log(el.Filials);
			for(let elem of el.Filials) {
				let span = document.createElement('span');
				span.dataset.deliveryId = deliveryId;
				span.dataset.pvzId = elem.id;			
				span.innerHTML = '<img src="https://dostav.im/img/' + deliveryId + '.png" height="30px" style=" padding-right: 5px; ">';
				span.innerHTML += elem.address;		
				span.className = "custom-option second";
				customOptions.append(span);
			}
		}
	}
	
	let customSelectHeader = containerPVZ.querySelector('.custom-select__trigger');
	customSelectHeader.innerHTML = '<span>Выберите пункт выдачи заказа</span><div class="arrow"></div>';
	
	optionsToActive('second', '');
	containerPVZ.style.display = 'block';
}

let checkIsFullFieldsDelivery = function() {
	let isOK = true;
	let inpuTypeDelivery = document.querySelector('input[name="types_delivery"]:checked');
	if(inpuTypeDelivery != null) {
		let deliveryesServices = document.querySelectorAll('.deliveryServices .custom-select__trigger');
		let isAllFullDeliveryesServices = true;
		
		for(el of deliveryesServices) {
			let span = el.querySelector('span');
			if(span.dataset.deliveryId == undefined || span.dataset.deliveryId == null || span.dataset.deliveryId == '') {
				isAllFullDeliveryesServices = false;
			}
		}
		
		if(!isAllFullDeliveryesServices) {
			isOK = false;
		}
		
		if(inpuTypeDelivery.value == 'pickup') {
			let deliveryesPVZ = document.querySelectorAll('.deliveryPVZ .custom-select__trigger');
			let isAllFullDeliveryesPVZ = true;
		
			for(el of deliveryesPVZ) {
				let span = el.querySelector('span');
				if(span.dataset.deliveryId == undefined || span.dataset.deliveryId == null || span.dataset.deliveryId == '') {
					isAllFullDeliveryesPVZ = false;
				}
			}
			
			if(!isAllFullDeliveryesPVZ) {
				isOK = false;
			}
		}
	} else {
		isOK = false;
	}
	
	return isOK;
}

let countPriceProductsAndChangeDOM = function() {
	let quantity = 0;
	
	let products = document.querySelectorAll('.checkout-product');
	
	for(let el of products) {
		let cost = Number(el.dataset.productBaseCost);
		let numberProducts = Number(el.dataset.productNumber);
		quantity += numberProducts * cost;
	}
	
	let productNumber = document.querySelector('.checkout-total__label .product_number');
	productNumber.innerHTML = products.length;
	
	let productCostSmall = document.querySelector('.checkout-total__value .product_cost_small');
	productCostSmall.innerHTML = quantity;
	let productCost = document.querySelector('.checkout-total__value .product_cost');
	productCost.innerHTML = quantity;	
}

let countPriceDeliveryAndChangeDOM = function() {
	let quantity = 0;
	
	let deliveryesServices = document.querySelectorAll('.deliveryServices .custom-select__trigger span');
	
	for(el of deliveryesServices) {
		quantity += Number(el.dataset.deliveryCostWithUp);
		console.log(el.dataset.deliveryCostWithUp);
	}
	
	let deliveryText = document.querySelector('.checkout-total__value .text_delivery');
	let deliveryMoneySymbol = document.querySelector('.checkout-total__value .money_symbol_delivery');
	
	deliveryText.innerHTML = quantity;
	deliveryMoneySymbol.style.display = 'inline';
}

let countFullPriceAndChangeDOM = function() {	
	let productCostSmall = document.querySelector('.checkout-total__value .product_cost_small');
	let productsCost = Number(productCostSmall.innerHTML);
	
	let deliveryCostText = document.querySelector('.checkout-total__value .text_delivery');
	let deliveryCost = Number(deliveryCostText.innerHTML);
	
	let productCost = document.querySelector('.checkout-total__value .product_cost');
	productCost.innerHTML = productsCost + deliveryCost;	
}

countPriceProductsAndChangeDOM();

let countPriceAndChangeDOM = function() {
	countPriceProductsAndChangeDOM();
	countPriceDeliveryAndChangeDOM();
	countFullPriceAndChangeDOM();
}

let optionsToActive = function(numb, pickupType) {
	for (const option of document.querySelectorAll(".custom-option." + numb)) {
		option.addEventListener('click', function () {
			console.log(this.classList.contains('selected'));
			if (!this.classList.contains('selected')) {
				let selected = this.parentNode.querySelector('.custom-option.selected');
				if(selected != undefined) {
					selected.classList.remove('selected');
				}
				this.classList.add('selected');
				console.log(this.classList.contains('selected'));
				
				let header = this.parentNode.parentNode.querySelector('.custom-select__trigger');
				header.style.height = 'auto';
				let spanHeader = header.querySelector('span');
				spanHeader.dataset.deliveryId = option.dataset.deliveryId;
				spanHeader.style.padding = '5px 0px 3px 0px';
				spanHeader.innerHTML = this.innerHTML;
				
				if(numb == 'first') {
					spanHeader.dataset.deliveryCost = option.dataset.deliveryCost;
					spanHeader.dataset.deliveryCostWithUp = option.dataset.deliveryCostWithUp;
					spanHeader.dataset.deliveryDate = option.dataset.deliveryDate;
					spanHeader.dataset.deliveryPickupDate = option.dataset.deliveryPickupDate;
					spanHeader.dataset.deliveryTarifId = option.dataset.deliveryTarifId;
					spanHeader.dataset.courierCost = option.dataset.courierCost;
					if(pickupType == 2) {
						appendSelectPVZ(option.dataset.deliveryId, option.parentNode.parentNode.parentNode.parentNode.parentNode);
					}
				}
				
				if(numb == 'second') {
					spanHeader.dataset.pvzId = option.dataset.pvzId;					
				}
				
				if(checkIsFullFieldsDelivery()) {
					countPriceAndChangeDOM();
				}
			}
		});
	}
}

inputCityEventToShowHelps();
typesDeliveryToChange();
