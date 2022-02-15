function DOMparents(domElem) {
	let arrParents = [];
	
	arrParents.push(domElem);
	
	let parent = domElem.parentNode;
	while(1) {
		if(parent != null) {
			arrParents.push(parent);
			parent = parent.parentNode;
		} else {
			break;
		}
	}
	
	return arrParents;
};

function removerBodyClick() {
	document.removeEventListener('click', bodyClick, true);
}

function bodyClick() {
	let optionDropdownMenu = document.querySelector('.optionDropdownMenu.open');
	
	let elem = event.path[0];
	
	let isClickOnNotOptionDropdownMenu = true;
	
	for(let el of DOMparents(elem)) {
		if(el.tagName.toLowerCase() == 'body') {
			break;
		}
		
		if(optionDropdownMenu != null) {
			if (el.classList.contains('optionDropdownMenu')) {
				isClickOnNotOptionDropdownMenu = false;
				break;
			}
		}
	}
	
	if(isClickOnNotOptionDropdownMenu && optionDropdownMenu != null) {
		//optionDropdownMenu.classList.remove('open');
	}
	
	optionDropdownMenu.classList.remove('open');
	removerBodyClick();
}

function editSvgProductToCart(buttonSvg) {
	buttonSvg.style.fill = "#f4a137";
	buttonSvg.innerHTML = "<svg viewBox=\"0 0 24 24\">\
		<g fill=\"#f4a137\">\
			<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4H2.68121C3.08124 4 3.44277 4.2384 3.60035 4.60608L8.44161 15.9023C9.00044 17.2063 10.3963 17.9405 11.7874 17.6623L19.058 16.2082C20.1137 15.9971 20.9753 15.2365 21.3157 14.2151L23.0712 8.94868C23.7187 7.00609 22.2728 5 20.2251 5H5.94511L5.43864 3.81824C4.96591 2.71519 3.88129 2 2.68121 2H1ZM10.2799 15.1145L6.80225 7H20.2251C20.9077 7 21.3897 7.6687 21.1738 8.31623L19.4183 13.5827C19.3049 13.9231 19.0177 14.1767 18.6658 14.247L11.3952 15.7012C10.9315 15.7939 10.4662 15.5492 10.2799 15.1145Z\"></path>\
			<path d=\"M11 22C11 23.1046 10.1046 24 9 24C7.89543 24 7 23.1046 7 22C7 20.8954 7.89543 20 9 20C10.1046 20 11 20.8954 11 22Z\"></path>\
			<path d=\"M21 22C21 23.1046 20.1046 24 19 24C17.8954 24 17 23.1046 17 22C17 20.8954 17.8954 20 19 20C20.1046 20 21 20.8954 21 22Z\"></path>\
		</g>\
		<g id=\"icon-basket-filled__fill\">\
			<path d=\"M20 15L21 6H6L10 16L20 15Z\" fill=\"#f4a137\"></path>\
			<circle cx=\"17\" cy=\"7\" r=\"7\" fill=\"white\"></circle>\
			<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M17 13C20.3137 13 23 10.3137 23 7C23 3.68629 20.3137 1 17 1C13.6863 1 11 3.68629 11 7C11 10.3137 13.6863 13 17 13ZM20.7071 5.70711C21.0976 5.31658 21.0976 4.68342 20.7071 4.29289C20.3166 3.90237 19.6834 3.90237 19.2929 4.29289L16 7.58579L14.7071 6.29289C14.3166 5.90237 13.6834 5.90237 13.2929 6.29289C12.9024 6.68342 12.9024 7.31658 13.2929 7.70711L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711L20.7071 5.70711Z\" fill=\"#f4a137\"></path>\
		</g>\
	</svg>";
	
	buttonSvg.removeEventListener('click', addingToCart);
}

function editSvgProductToEmptyCart(buttonSvg) {
	buttonSvg.style.fill = "#000";
	buttonSvg.innerHTML = "<svg viewBox=\"0 0 24 24\" id=\"icon-basket\">\
								<g>\
									<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4H2.68121C3.08124 4 3.44277 4.2384 3.60035 4.60608L8.44161 15.9023C9.00044 17.2063 10.3963 17.9405 11.7874 17.6623L19.058 16.2082C20.1137 15.9971 20.9753 15.2365 21.3157 14.2151L23.0712 8.94868C23.7187 7.00609 22.2728 5 20.2251 5H5.94511L5.43864 3.81824C4.96591 2.71519 3.88129 2 2.68121 2H1ZM10.2799 15.1145L6.80225 7H20.2251C20.9077 7 21.3897 7.6687 21.1738 8.31623L19.4183 13.5827C19.3049 13.9231 19.0177 14.1767 18.6658 14.247L11.3952 15.7012C10.9315 15.7939 10.4662 15.5492 10.2799 15.1145Z\"></path>\
									<path d=\"M11 22C11 23.1046 10.1046 24 9 24C7.89543 24 7 23.1046 7 22C7 20.8954 7.89543 20 9 20C10.1046 20 11 20.8954 11 22Z\"></path>\
									<path d=\"M21 22C21 23.1046 20.1046 24 19 24C17.8954 24 17 23.1046 17 22C17 20.8954 17.8954 20 19 20C20.1046 20 21 20.8954 21 22Z\"></path>\
								</g>\
							</svg>";

	buttonSvg.removeEventListener('click', addingToCart);
}

function addProducToCartDOMP(divProduct, atributesId) {
	let productId = divProduct.dataset.productId;
	let name = divProduct.querySelector('.right-block a').innerText;
	let price = divProduct.querySelector('.right-block .price span').innerText;
	let minOrder = divProduct.dataset.productMinOrder;
	let number = 1;
	if(Number(minOrder) > number) {
		number = minOrder;
	}
	
	let maxOrder = divProduct.dataset.productMaxOrder;
	let img = divProduct.querySelector('.left-block .image img').getAttribute('src');
	let posImgSubStr1 = img.lastIndexOf('_150x150');
	let posImgSubStr2 = img.lastIndexOf('.');
	//img = img.substring(6, posImgSubStr1) + img.substring(posImgSubStr2);
	img = img.substring(6);
	let strAtributes = '';
	let strAllProductAtributes = divProduct.dataset.atributes;
	if(atributesId != ''){
		let arrProductAtributes = atributesId.split(',');
		let arrAllProductAtributes = strAllProductAtributes.split(']]]');
		for(let oneTypeAtribues of arrAllProductAtributes) {
			let smallArrAtributes = oneTypeAtribues.split(',!,');
			let type = smallArrAtributes[0];
			
			for(let i = 1; i < smallArrAtributes.length; i+=3) {
				let value = smallArrAtributes[i];
				let imgAtr = smallArrAtributes[i+1];
				let idAtr = smallArrAtributes[i+2];
				for(let atrProduct of arrProductAtributes) {
					if(Number(idAtr) == Number(atrProduct)) {
						strAtributes += idAtr + ',!,' + type + ',!,' + value + ',!,' + imgAtr + ']';
					}
				}
			}
		}
	}
	
	let brandUrl = divProduct.dataset.brandUrl;
	let productUrl = divProduct.dataset.productUrl;
	
	let arrProduct = [productId, name, price, number, img, strAtributes, brandUrl, productUrl, minOrder, maxOrder];
	let modalBody = document.querySelector('.modalBlock.buyCartModal .modalBody');
	let container = modalBody.querySelector('.container-bought-products');
	
	if(container != null) {
		addProductToBuyCart(arrProduct, container);
		
		changeClassesOfProductsOnBuyCart(container);
		
		let divCounter = container.querySelector('.cart-counter');
		if(divCounter != null) {
			updateCostAllProducts(divCounter);
		}
	} else {
		let containerBoughtProducts = document.createElement('div');
		containerBoughtProducts.className = "container-bought-products";
		containerBoughtProducts.style.padding = "25px";
		
		addProductToBuyCart(arrProduct, containerBoughtProducts);
		
		changeClassesOfProductsOnBuyCart(containerBoughtProducts);
		createMainContainerOrderBuyCart(containerBoughtProducts);
		
		modalBody.innerHTML = "";
		modalBody.append(containerBoughtProducts);
		
		createAndAppendNumberBoughtProducts();
		createHeaderModuleBoughtProducts(number, price);
		updateCostAllProducts(containerBoughtProducts);
	}
}

function addProducToCart(buttonSvg, atributesId) {
	let divProduct = buttonSvg.parentNode.parentNode.parentNode.parentNode.parentNode;
	let productId = divProduct.dataset.productId;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '/App/Controllers/addProductToCart.php');

	xhr.addEventListener('readystatechange', function(e) {			
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			if(atributesId == '') {
				editSvgProductToCart(buttonSvg);
				if(atributesId == '') {
					addProducToCartDOMP(divProduct, atributesId);
					buttonSvg.addEventListener('click', launchToggleModalBlock.bind(null, 1, 1));
				}
			}
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('Не удалось добавить товар.');
		}
	});
	
	var fd = new FormData;
	fd.append("productId", productId);
	if(atributesId != '') {
		fd.append("atributesId", atributesId);
	}
	xhr.send(fd);
}

function addingToCart() {
	addProducToCart(this, '');
}

function deleteBoughtProductFromCart(container, number) {
	let mainContainer = container.parentNode;
	let productId = container.dataset.productId;
	let atributesOnCart = container.dataset.atributes;
	
	container.remove();
	
	let productCart = document.querySelector('#product');
	if(productCart != null) {
		let boughtAtributes = productCart.dataset.boughtAtributes;
		
		if(boughtAtributes == '') {
			let buttonToBuy = document.querySelector('.buttonBuy');
			buttonToBuy.classList.remove('none');
			let buttonBuyed = document.querySelector('.buttonBuyed');
			buttonBuyed.classList.add('none');
		} else {
			let arrAtributesId = atributesOnCart.split(']');
			let arrCartAtributes = [];
			
			for(let el of arrAtributesId) {
				let atributeId = el.split(',!,')[0];
				if(atributeId != '') {
					arrCartAtributes.push(Number(atributeId));
				}
			}
			
			let arrBoughtAtributesId = boughtAtributes.split(']');
			let arrBoughtAtributes = [];
			
			for(let el of arrBoughtAtributesId) {
				if(el == '') {
					break;
				}
				
				let smallArr = [];
				
				let atributesId = el.split(',');
				for(let atr of atributesId) {
					if(atr != '') {
						smallArr.push(Number(atr));
					}
				}
				arrBoughtAtributes.push(smallArr);
			}
			
			let idDeletedAtribute;
			
			for(let i = 0; i < arrBoughtAtributes.length; i++) {
				let numbThereAtributes = 0;
				for(let el of arrCartAtributes) {
					for(let e of arrBoughtAtributes[i]) {
						if(el == e) {
							numbThereAtributes++;
						}
					}
				}
				
				if(numbThereAtributes == arrBoughtAtributes[i].length) {
					idDeletedAtribute = i;
					break;
				}
			}
			
			console.log(arrCartAtributes);
			console.log(boughtAtributes);
			console.log(arrBoughtAtributes);
			
			let newAtributeStr = '';
			
			for(let i = 0; i < arrBoughtAtributes.length; i++) {
				if(i != idDeletedAtribute) {
					newAtributeStr += arrBoughtAtributes[i].join(',') +  ']';
				}
			}
			
			console.log(newAtributeStr);
			productCart.dataset.boughtAtributes = newAtributeStr;
		}
	}
	
	let allBoughtProducts = mainContainer.querySelectorAll('.bought-product-container');
	
	if(allBoughtProducts.length > 0) {
		let lastBoughtProduct = allBoughtProducts[allBoughtProducts.length-1];
		if(!lastBoughtProduct.classList.contains('last')) {
			lastBoughtProduct.classList.add('last');
		}
		
		let numberProductsOnHeader = document.querySelector('.quick-panel__num');
		let oldNumber = Number(numberProductsOnHeader.innerText);
		let newNumber = oldNumber - Number(number)
		numberProductsOnHeader.innerText = newNumber;
		
		let divCounter = mainContainer.querySelector('.cart-counter');
		if(divCounter != null) {
			updateProductCost(divCounter);
		}
	} else {
		let numberProductsOnHeader = document.querySelector('.quick-panel__num');
		numberProductsOnHeader.remove();
		
		let modalBody = document.querySelector('.buyCartModal .modalBody');
		modalBody.innerHTML = "<div>\
						<p><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 240 240\" style=\"width: 100%; max-width: 240px; margin-bottom: 30px;\">\
							<path d=\"m9.30006 136.5c-.6 12.8 8.70004 27.2 20.70004 31.7 18.1 6.8 30.3-10.2 41-21.9 8.2-9 18.5-17.2 30.4999-18.8 7-1 14 .3 21 1.3 17.7 2.6 35.8 4.2 53.2.3s34.2-13.5 43.4-28.8c2.3-3.9 4.1-8.1 4.8-12.5 1.8-9.7-1.3-19.7-6-28.2-6.6-12.1-16.5-22.4-28.5-29.4-11.1-6.4-24.3-10.1-37-7.6-18 3.6-31.3 18.6-42.9 33-11.3999 14.3-23.9999 29.6-41.7999 34.5-5.5 1.5-11.3 1.8-16.7 3.3-16.5 4.2-31.9 17-38.9 32.6-1.7 3.7-2.50004 7.2-2.80004 10.5z\" fill=\"#f5f5f5\"/>\
							<path d=\"m218.9 99.1c-2.8-13.7-6.5-27.2-7.3-30 0-.7-.2-1.3-.6-1.9-1-1.5-3-4.8-39.4-12.9-18.5-4.2-38.7-7.9-46-8.8-1.5-.2-3.3-.3-5.4-.4l-2.5-1.8c-4.9-6.8-13-10.8-21.4-10.3l-35.9 2c-4.5.2-8.3 2.8-10.3 6.9-1.9 4.1-1.5 8.7 1.2 12.3l5.4 7.4c1.3 9.2 6.6 26.6 14.6 51.5 1.3 4.1 2.4 7.4 2.9 9.1.4 1.5 1.7 2.8 3.8 3.9 2.2 9.2 12.5 52.6 17.6 61.1.6 1.1 1.7 2.1 3.1 3-2 1.3-3.3 3.8-3.3 6.6 0 4.2 3 7.7 6.8 7.7 3.7 0 6.8-3.4 6.8-7.7 0-1-.2-1.9-.5-2.8 9.3 2.5 23.1 4.3 40.2 6.3 9.7 1.1 18 2.1 22.5 3.2 1.3.3 2.7.5 4.1.7-.7 1.2-1.1 2.6-1.1 4.1 0 4.2 3 7.7 6.8 7.7 3.7 0 6.8-3.4 6.8-7.7 0-1.6-.4-3.1-1.2-4.4 5.6-.8 11-2.4 15.4-4.6-.3.8-.4 1.8-.4 2.7 0 4.2 3 7.7 6.8 7.7 3.7 0 6.8-3.4 6.8-7.7 0-3.9-2.5-7-5.8-7.6 1.4-1.4 2.5-2.8 3-4.2.5-1.2.3-2.4-.3-3.5-2.6-4.4-16.1-6.7-52.8-11-12.7-1.5-25.8-3-28.3-4.2-3.3-1.4-7.5-18.5-9.4-38 5.5.5 11.5 1 18.1 1.5 10.6.8 19.8 1.5 23.8 2.3 5.5 1 13.9 1.5 22.7 1.5 13.3 0 27.3-1.2 32.7-3.6 4-1.8 5.7-8.7 0-36.1zm-48.7 33.3-1.5-7c2.6 0 6.4-.3 10.7-.6l1.1 8.2c-3.7-.1-7.2-.3-10.3-.6zm-61.6-5.9-1.7-8.9c4.9.7 10.1 1.4 15.3 2.1l1.6 8.3c-5.2-.5-10.3-1-15.2-1.5zm-28.8-6.1c-.4-1.4-1.2-3.8-2.1-6.8 2.4.3 6.3.9 11.1 1.5l1.6 8.7c-8.4-1.6-10.2-3-10.6-3.4zm12.1 3.7-1.7-8.8c4.5.6 9.7 1.3 15.2 2.1l1.7 8.9c-2-.2-3.9-.5-5.8-.7-3.8-.5-6.9-1-9.4-1.5zm-25.6-47.4c3.4.6 8.9 1.6 15.7 2.8l3.1 16.5c-6-.8-10.8-1.5-13.6-1.9-1.8-5.7-3.6-11.8-5.2-17.4zm140.9-1.7c1 3.7 1.9 7.3 2.8 10.8-2.4.2-6.9.6-12.4 1.1l-1.6-11.5c4.9-.2 8.8-.3 11.2-.4zm-90 10.4c6.1 1 12.2 1.9 17.8 2.6l2.8 14.8c-5.8-.7-11.8-1.4-17.8-2.2zm1.4 15c-5.2-.7-10.3-1.3-15.3-2l-3-15.8c5 .8 10.2 1.7 15.3 2.5zm18-12.2c7.1.9 13.5 1.7 18.5 2l3.2 14.9c-5.5-.6-12-1.3-18.9-2.1zm24.5 2.3c3.7 0 8.5-.2 13.7-.5l2.1 16c-4 .1-8.2 0-12.5-.3zm15.1-.6c6.7-.4 13.9-1 20-1.5l2.1 15.8c-5.8.8-12.6 1.5-20 1.7zm21.5-1.6c5.7-.5 10.3-.9 12.6-1.1 1.2 5.1 2.3 9.9 3.2 14.3-2.8.7-7.6 1.7-13.7 2.6zm-3.2-12.9 1.5 11.6c-6.2.5-13.4 1.1-20 1.5l-1.6-12.4c7.1-.2 14.2-.5 20.1-.7zm-21.6.8 1.6 12.4c-5.3.3-10.1.5-13.8.5l-2.7-12.3c4.8-.3 9.9-.4 14.9-.6zm-21 .7h.3l2.6 11.9c-5-.4-11.4-1.1-18.4-2.1l-2.1-11.2c7 .9 13.2 1.4 17.6 1.4zm-19.2-1.6 2.1 11.2c-5.7-.8-11.7-1.7-17.8-2.6l-2.1-11.3c6.1 1 12.2 2 17.8 2.7zm-19.4-2.9 2.1 11.3c-5.2-.8-10.4-1.7-15.3-2.5l-2.2-11.4c5.1.8 10.3 1.7 15.4 2.6zm-16.9-3 2.2 11.5c-5.5-.9-10.7-1.8-15.3-2.6l-2.3-11.8c4.8 1 10 1.9 15.4 2.9zm-16.9-3.2 2.2 11.8c-7-1.2-12.6-2.3-15.8-2.9-1.3-4.7-2.4-8.9-3-12.2 3.8.8 9.7 2 16.6 3.3zm4 13.6c4.7.8 9.9 1.7 15.3 2.6l3 15.8c-5.5-.7-10.7-1.4-15.2-2.1zm18.6 19.9 3 16.2c-5.6-.8-10.8-1.5-15.2-2.1l-3-16.1c4.6.6 9.7 1.3 15.2 2zm4.6 16.4-3-16.2c4.9.7 10.1 1.3 15.3 2l3.1 16.2c-5.3-.6-10.5-1.3-15.4-2zm13.7-14c6 .8 12 1.5 17.8 2.2l3.1 16.4c-5.6-.7-11.6-1.6-17.8-2.4zm19.2 2.4c7 .8 13.5 1.6 19 2.1l3.7 16.9c-4.2-.5-11.2-1.4-19.5-2.5zm28.7 19.4-3.6-16.8c3.3.2 6.6.3 9.8.3h2.5l2.1 16c-4.4.3-8.2.5-10.8.5zm10.2-16.5c7.4-.2 14.2-.9 20-1.7l2.1 15.9c-6.5.6-13.8 1.2-20 1.7zm21.4-1.9c6.1-.9 10.9-1.9 13.8-2.6 1.4 6.9 2.2 12.7 2.7 17.2-3 .3-8.3.8-14.3 1.4zm4.2-36.2c-10.3.3-34.1 1.1-50.8 1.8-17 .7-75.6-11.1-90.6-14.2 5-3.3 35.6-6.9 55.6-6.1.7.3 1.4.3 2 .1 1.6.1 3.2.2 4.6.4 15 1.8 67.3 12.6 79.2 18zm-148.6-25c1-2.1 3-3.4 5.3-3.6l35.9-2c5.6-.3 11.1 2 14.9 6.2-7.5.1-16.3.5-24.4 1.2-8.2.8-24.2 2.3-29.2 7.2l-1.9-2.6c-1.4-1.9-1.6-4.3-.6-6.4zm16.4 51.3c3 .4 7.7 1.1 13.4 1.9l3 16.1c-5-.7-9-1.2-11.3-1.5-.1-.3-.2-.5-.3-.8-.9-3.6-2.8-9.3-4.8-15.7zm46.2 56.2c3.6 19.8 7.4 23.9 10.4 25.2.2.1.4.2.7.3-2 1.3-3.3 3.8-3.3 6.6 0 4.2 3 7.7 6.8 7.7 3.7 0 6.8-3.4 6.8-7.7 0-1.8-.6-3.5-1.5-4.8 5 .7 11.8 1.6 20.5 2.6 14.8 1.7 41.6 4.9 47.6 7.8-3.9 5-20.6 11.6-33.6 8.5-4.9-1.1-13.4-2.2-23.2-3.3-16-1.9-45.9-5.5-48.7-10.3-3.8-6.2-12-38.7-16-55.7 6.7 1.8 16.8 3.2 31 4.5.3 3.3 1.1 10.8 2.5 18.6zm7.2-23.7-1.5-8.2c6.2.8 12.2 1.6 17.8 2.4l1.4 7.3c-.9-.1-1.9-.1-2.8-.2-4.9-.5-9.9-.9-14.9-1.3zm19 1.5-1.3-7.2c8.5 1.1 15.6 2 19.6 2.5l1.4 6.6c-3.9-.6-10.8-1.2-19.7-1.9zm37.6 3.4-1.1-8.3c6.3-.5 13.5-1.1 20-1.7l1.2 9.4c-6.1.5-13.3.7-20.1.6zm34.2-2.9c-2.4 1-7 1.7-12.6 2.2l-1.2-9.4c6-.6 11.2-1.1 14.3-1.4.3 4.6.1 7.5-.5 8.6z\" fill=\"#c3822f\"/>\
							<path d=\"m62.7 182.7c-.6-17.1 6.4-22.5 12.5-22.5 5.5-.1 12.2.6 18.6-3.7.6-.4.6-1.3 0-1.7-4.3-2.3-9.8-4.4-14.6-3.8-5.9.8-10.5 5-13.2 7.7-.7.8-1.9-.1-1.4-1.1 2-4.7 5.3-6.4 8.2-9.1 3.5-3.2 9.2-5.2 13-8 5.8-4.5 9.4-10.8 12.8-17.4.4-.6-.1-1.4-.9-1.4-6.3.4-10.3 1.9-15.5 6.5-4.4 4-11.7 15.6-15.4 19.5-.7.7-1.9.1-1.5-.8 2.2-8 10.7-18.3 14.4-27.1 4.9-11.4 3.7-20.4.2-28.9-.3-.7-1.5-.8-1.7 0-2.4 11.1-10.8 13.3-13.7 40.5-.2 1.9-.6 6.4-1.2 6.9-.9.8-1.2 0-1.7-1.1-2.9-7.6-.6-47.2-22.1-60.2-.8-.4-1.7.2-1.4 1 6.4 23.1-9.2 26 21.6 67.8.1.2.4.6.5.8.8 2.1-.6 2.5-1.3 2.4-3.9-.5-18.9-27.6-48.90004-24.1-.8 0-1.1 1-.6 1.6 7.30004 8 15.00004 15.7 24.80004 19.8 6 2.6 14 3.1 19.6 6.6 5 3.1 7.7 9.6 6.1 15.2-.3.8-1.3 1.1-1.6.3-2.8-4.8-9.5-8.6-14.7-10.2-5.6-1.7-10.2-1.5-15.8-1.6-.8 0-1.2.9-.8 1.5 11.7 16.7 28.6 3.5 31 23.3 0 .3.3.7.6.8 3.3.9 6.5 1.8 6.4-1.7z\" fill=\"#4ad029\"/>\
							<path d=\"m76.8 180.1-33.1-1.1c-1.5-.1-1.4 1.2-1.2 2.6l6 30.5c.2 1.1 1.3 2 2.4 1.9l16.2.4c1-.1 1.7-.8 2-1.7l8.4-31.3c.3-.6-.1-1.2-.7-1.3z\" fill=\"#1c398e\"/>\
						</svg></p>\
					   \
					   <h3 style=\"text-align: center;\">Корзина пуста</h3>\
						\
						<p style=\"padding-bottom: 20px\">Но это никогда не поздно исправить :) </p>\
					</div>";
					
		updateHeaderModuleBoughtProducts(true, 0, 0);
	}
}

function deleteBoughtProductPost(container, productId, atributes) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '/App/Controllers/deleteProductFromCart.php');

	xhr.addEventListener('readystatechange', function(e) {			
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			deleteBoughtProductFromCart(container, e.target.response);
			
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('Не удалось удалить товар.');
		}
	});
	
	var fd = new FormData;
	fd.append("productId", productId);
	if(atributes != '') {
		fd.append("atributes", atributes);
	}
	xhr.send(fd);
}

function deleteBoughtProduct() {
	let container = this.parentNode.parentNode.parentNode;
	
	let productId = container.dataset.productId;
	
	let spanAtributes = container.querySelectorAll('.product-name span[data-atribute-id]');
	let atributes = [];
	
	for(let el of spanAtributes) {
		atributes.push(el.dataset.atributeId);
	}
	
	atributes = atributes.join(',');
	
	deleteBoughtProductPost(container, productId, atributes)
}

function productOptionClick() {
	console.log(this);
	let optionDropdownMenu = this.parentNode.querySelector('.optionDropdownMenu');
	optionDropdownMenu.classList.add('open');
	
	optionDropdownMenu.addEventListener('click', deleteBoughtProduct);
	
	document.addEventListener('click', bodyClick, true);
}

function createHeaderModuleBoughtProducts(number, cost) {
	let headerModule = document.querySelector('.dropdownBuyCart');
	
	headerModule.innerHTML = " <div style=\"\
								  margin-left: 20px;\
								  color: #000;\
								  font-weight: 400;\
								  font-size: 15px;\
								  \">\
									<p>Товаров в корзине: <span class=\"number-of-goods\">" + number + "</span></p>\
									<p>На сумму <span class=\"cost-of-goods\">" + cost + "</span> руб</p>\
									<a href=\"/checkout\">\
										<div class=\"button-order-buy-cart\">\
											Оформить заказ\
										</div>\
									</a>\
									<p style=\"\
										font-size: 16px;\
										margin-left: 73px;\
										margin-top: 20px;\
										cursor: pointer;\
										text-align: center;\
									\" class=\"goToBuyCart toggleModal1\">\
										Перейти в корзину\
									</p>\
								</div>";
	let buttonToCart = headerModule.querySelector('.goToBuyCart');
	buttonToCart.addEventListener('click', launchToggleModalBlock.bind(null, 1, 1));
}

function updateHeaderModuleBoughtProducts(isEmpty, number, cost) {
	let headerModule = document.querySelector('.dropdownBuyCart');
	if(isEmpty) {
		headerModule.innerHTML = "<svg height=\"45\" width=\"45\" style=\"fill: #f4a137;\">\
									  <svg viewBox=\"0 0 24 24\" id=\"icon-basket\">\
										 <g>\
											<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4H2.68121C3.08124 4 3.44277 4.2384 3.60035 4.60608L8.44161 15.9023C9.00044 17.2063 10.3963 17.9405 11.7874 17.6623L19.058 16.2082C20.1137 15.9971 20.9753 15.2365 21.3157 14.2151L23.0712 8.94868C23.7187 7.00609 22.2728 5 20.2251 5H5.94511L5.43864 3.81824C4.96591 2.71519 3.88129 2 2.68121 2H1ZM10.2799 15.1145L6.80225 7H20.2251C20.9077 7 21.3897 7.6687 21.1738 8.31623L19.4183 13.5827C19.3049 13.9231 19.0177 14.1767 18.6658 14.247L11.3952 15.7012C10.9315 15.7939 10.4662 15.5492 10.2799 15.1145Z\"></path>\
											<path d=\"M11 22C11 23.1046 10.1046 24 9 24C7.89543 24 7 23.1046 7 22C7 20.8954 7.89543 20 9 20C10.1046 20 11 20.8954 11 22Z\"></path>\
											<path d=\"M21 22C21 23.1046 20.1046 24 19 24C17.8954 24 17 23.1046 17 22C17 20.8954 17.8954 20 19 20C20.1046 20 21 20.8954 21 22Z\"></path>\
										 </g>\
									  </svg>\
								   </svg>\
								   <div style=\"\
									  margin-left: 20px;\
									  \">\
									  <p style=\"\
										 font-size: 18px;\
										 color: #000;\
										 font-weight: 400;\
										 \">Ваша корзина пуста</p>\
									  <p style=\"\
										 font-size: 14px;\
										 \">Добавляйте понравившиеся товары в корзину</p>\
								   </div>";
	} else {
		let spanNumber = headerModule.querySelector('.number-of-goods');
		spanNumber.innerText = number;
		
		let spanCost = headerModule.querySelector('.cost-of-goods');
		spanCost.innerText = cost;
	}
}

function updateNumberBoughtProducts(container) {
	let number = 0;
	
	let allNumbers = container.querySelectorAll('.price-and-counter .cart-counter input');
	
	for(let el of allNumbers) {
		number += Number(el.value);
	}
	
	let miniCounterProductsOnHeader = document.querySelector('.quick-panel__num');
	miniCounterProductsOnHeader.innerHTML = number;
}

function updateCostAllProducts(divCounter) {
	let container = divCounter.parentNode.parentNode.parentNode;
	
	let valueCostAllProducts = 0;
	let allPrices = container.querySelectorAll('.cart-price-count span');
	for(let el of allPrices) {
		valueCostAllProducts += Number(el.innerText);
	}
	
	let spanCost = container.querySelector('.order-buy-cart .cost-all-products span');
	spanCost.innerHTML = valueCostAllProducts;
	
	updateNumberBoughtProducts(container);
	
	let number = 0;
	
	let allNumbers = container.querySelectorAll('.price-and-counter .cart-counter input');
	
	for(let el of allNumbers) {
		number += Number(el.value);
	}
	
	updateHeaderModuleBoughtProducts(false, number, valueCostAllProducts);
}

function updateProductCost(divCounter) {
	let spanPriceCount = divCounter.parentNode.querySelector('.cart-price-count span');
	let basePrice = spanPriceCount.dataset.price;
	
	let input = divCounter.querySelector('input');
	let number = Number(input.value);
	
	let minPrice = Number(input.dataset.minNumberForSale);
	if(number < minPrice) {
		number = minPrice;
	}
	
	if(number < 1) {
		number = 1;
	}
	
	spanPriceCount.innerHTML = Number(number)*Number(basePrice);
	
	updateCostAllProducts(divCounter);
}

function updateProductCostPost(divCounter) {
	let divProduct = divCounter.parentNode.parentNode;
	let productId = divProduct.dataset.productId;
	
	let input = divCounter.querySelector('input');
	let number = Number(input.value);
	
	let minPrice = Number(input.dataset.minNumberForSale);
	if(number < minPrice) {
		number = minPrice;
	}
	
	if(number < 1) {
		number = 1;
	}
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '/App/Controllers/changeNumberProductForCart.php');

	xhr.addEventListener('readystatechange', function(e) {			
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			updateProductCost(divCounter)
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			console.log('Не удалось добавить товар.');
		}
	});
	
	var fd = new FormData;
	fd.append("productId", productId);
	fd.append("number", number);
	xhr.send(fd);
}

function minusNumberProduct() {
	let divCounter = this.parentNode;
	let input = divCounter.querySelector('input');
	input.value = Number(input.value) - 1;
	
	let minPrice = Number(input.dataset.minNumberForSale);
	if(input.value < minPrice || input.value < 1) {
		input.value = minPrice;
		if(input.value < 1) {
			input.value = 1;
		}
	}
	
	updateProductCostPost(divCounter);
	checkButtonsForChangeInputNumberProduct(divCounter);
}

function plusNumberProduct() {
	let divCounter = this.parentNode;
	let input = divCounter.querySelector('input');
	console.log(input.value);
	input.value = Number(input.value) + 1;
	
	let maxPrice = Number(this.dataset.maxNumberForSale);
	if(input.value > maxPrice) {
		input.value = maxPrice;
	}
	
	console.log(input.value);
	
	updateProductCostPost(divCounter);
	checkButtonsForChangeInputNumberProduct(divCounter);
}

function checkButtonsForChangeInputNumberProduct(divCounter) {
	console.log('ot sk');
	
	let buttonMinus = divCounter.querySelector('.number-product-minus');
	let buttonPlus = divCounter.querySelector('.number-product-plus');
	
	let inputCounter = divCounter.querySelector('input');
	
	console.log(inputCounter.value);
	console.log(inputCounter.dataset.minNumberForSale);
	
	if(inputCounter.value != inputCounter.dataset.minNumberForSale && Number(inputCounter.value) != 1) {
		buttonMinus.addEventListener('click', minusNumberProduct);
		buttonMinus.classList.remove('disabled');
	} else {
		buttonMinus.removeEventListener('click', minusNumberProduct);
		buttonMinus.classList.add('disabled');
	}
	
	if(inputCounter.value != inputCounter.dataset.maxNumberForSale) {
		buttonPlus.addEventListener('click', plusNumberProduct);
		buttonPlus.classList.remove('disabled');
	} else {
		buttonPlus.removeEventListener('click', plusNumberProduct);
		buttonPlus.classList.add('disabled');
	}
}

function inputingOfNumberBoughtProduct() {
	while(this.value.match(/[^0-9]/g)) {
		console.log(this.value.match(/[^0-9]/g));
		let pos = this.value.indexOf(this.value.match(/[^0-9]/g));
		
		if(pos > 0) {
			this.value = this.value.substring(0, pos) + this.value.substring(pos+1);
		} else if(pos == 0) {
			this.value = this.value.substring(1);
		}
	}
	if(this.value != '') {
		this.value = Number(this.value);
		
		let maxPrice = Number(this.dataset.maxNumberForSale);
		if(this.value > maxPrice) {
			this.value = maxPrice;
		}
		
		let minPrice = Number(this.dataset.minNumberForSale);
		if(this.value < minPrice) {
			this.value = minPrice;
			if(this.value < 1) {
				this.value = 1;
			}
		}
	}
	
	let divCounter = this.parentNode;
	
	updateProductCostPost(divCounter);
	checkButtonsForChangeInputNumberProduct(divCounter);
}

function blurOfNumberBoughtProduct() {
	function blurTimeOut(input){
		if(input.value == '') {
			console.log('ki');
			let minPrice = Number(input.dataset.minNumberForSale);
			input.value = minPrice;
			
			if(input.value < 1) {
				input.value = 1;
			}
				
			let divCounter = input.parentNode;
			
			updateProductCostPost(divCounter);
			checkButtonsForChangeInputNumberProduct(divCounter);
		}
	}
	
	let input = this;
	
	setTimeout(function() {
		blurTimeOut(input);
	}, 400);
}

function addProductToBuyCart(boughtProducts, containerBoughtProducts) {
	let divProduct = document.createElement('div');
	divProduct.className="bought-product-container";
	divProduct.dataset.productId = boughtProducts[0];
	
	let divImg = document.createElement('div');
	divImg.style.marginRight = "16px";
	let img = document.createElement('img');
	let imgUrl = boughtProducts[4];
	let posImgLastSlesh = imgUrl.lastIndexOf('.');
	//img.src = 'admin/' + imgUrl.substring(0, posImgLastSlesh) + '_150x150' + imgUrl.substring(posImgLastSlesh);
	img.src = '/admin/' + imgUrl;
	img.style.width = '96px';
	img.style.minWidth = '96px';
	
	divImg.append(img);
	divProduct.append(divImg);
	
	let divName = document.createElement('div');
	divName.className = "product-name";
	let aName = document.createElement('a');
	aName.setAttribute('href', '/' + boughtProducts[6] + '/' + boughtProducts[7]);
	let pName = document.createElement('p');
	pName.innerText = boughtProducts[1];
	
	if(boughtProducts[5] != '') {
		divProduct.dataset.atributes = boughtProducts[5];
		console.log(boughtProducts[5]);
		let allAtributes = boughtProducts[5].split(']');
		let spanAtributes = document.createElement('span');
		
		for(let j = 0; j < allAtributes.length; j++) {
			if(allAtributes[j] != '') {
				let atributes = allAtributes[j].split(',!,');
				let spanAtribute = document.createElement('span');
				spanAtribute.dataset.atributeId = atributes[0];
				
				spanAtribute.innerText = ', ' + atributes[1] + ': ' + atributes[2];
				console.log(atributes);
				console.log(atributes[3]);
				if(atributes[3] != '') {
					let imgAtribute = document.createElement('img');
					let imgUrlAtr = atributes[3];
					let posImgLastSleshAtr = imgUrlAtr.lastIndexOf('.');
					imgAtribute.src = '/admin/App/templates/files/img/product-attributes/' + imgUrlAtr.substring(0, posImgLastSleshAtr) + '_150x150' + imgUrlAtr.substring(posImgLastSleshAtr);
					imgAtribute.style.width = '20px';
					imgAtribute.style.borderRadius = '2px';
					
					spanAtribute.append(imgAtribute);
				}
				
				spanAtributes.append(spanAtribute);
			}
			pName.append(spanAtributes);
			aName.append(pName);
		}
	}
	
	aName.append(pName);
	divName.append(aName);
	divProduct.append(divName);
	
	let divOptionMenu = document.createElement('div');
	divOptionMenu.style.position = "absolute";
	divOptionMenu.style.top = "5px";
	divOptionMenu.style.right = "-17.5px";
	
	let divContainerOptionMenu = document.createElement('div');
	divContainerOptionMenu.style.position="relative";
	
	let divOptionDelete = document.createElement('div');
	divOptionDelete.style.position="relative";
	divOptionDelete.className = "option-delete";
	divOptionDelete.style.cursor = "pointer";
	divOptionDelete.style.width = "40px";
	divOptionDelete.style.height = "40px";
	
	let divSmallCircle1 = document.createElement('div');
	divSmallCircle1.style.position = "absolute";
	divSmallCircle1.style.top = "10px";
	divSmallCircle1.style.right = "17.5px";
	divSmallCircle1.style.border = "2px solid #000";
	divSmallCircle1.style.background = "#000";
	divSmallCircle1.style.borderRadius = "3px";
	divSmallCircle1.style.padding = "0.5px";
	let divSmallCircle2 = document.createElement('div');
	divSmallCircle2.style.position = "absolute";
	divSmallCircle2.style.top = "16px";
	divSmallCircle2.style.right = "17.5px";
	divSmallCircle2.style.border = "2px solid #000";
	divSmallCircle2.style.background = "#000";
	divSmallCircle2.style.borderRadius = "3px";
	divSmallCircle2.style.padding = "0.5px";
	let divSmallCircle3 = document.createElement('div');
	divSmallCircle3.style.position = "absolute";
	divSmallCircle3.style.top = "22px";
	divSmallCircle3.style.right = "17.5px";
	divSmallCircle3.style.border = "2px solid #000";
	divSmallCircle3.style.background = "#000";
	divSmallCircle3.style.borderRadius = "3px";
	divSmallCircle3.style.padding = "0.5px";
	
	divOptionDelete.append(divSmallCircle1);
	divOptionDelete.append(divSmallCircle2);
	divOptionDelete.append(divSmallCircle3);
	
	divContainerOptionMenu.append(divOptionDelete);
	
	let divOptionDropdownMenu = document.createElement('div');
	divOptionDropdownMenu.className = "optionDropdownMenu";
	divOptionDropdownMenu.innerHTML = "<div class=\"delete-svg\">\
	<svg width=\"17\" height=\"17\" viewBox=\"0 0 225.000000 225.000000\" preserveAspectRatio=\"xMidYMid meet\" xmlns=\"http://www.w3.org/2000/svg\">\
		<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\">\
			<path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4\
			-222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6\
			l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14\
			666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0\
			83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0\
			105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430\
			-163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125\
			46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3\
			-595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"></path>\
			<path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path>\
			<path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path>\
			<path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path>\
		</g>\
	</svg>\
	</div>\
	<div class=\"delete-text\">\
		Удалить\
	</div>";
	
	divContainerOptionMenu.append(divOptionDropdownMenu);
	divOptionMenu.append(divContainerOptionMenu);
	
	divOptionDelete.addEventListener('click', productOptionClick);
	
	let divCounter = document.createElement('div');
	divCounter.className = "cart-counter";
	divCounter.innerHTML = "<div aria-label=\"Убрать один товар\" class=\"number-product-minus\">\
	  <svg height=\"24\" width=\"24\">\
		 <svg viewBox=\"0 0 24 24\">\
			<path clip-rule=\"evenodd\" d=\"m3 12c0-.5523.44772-1 1-1h16c.5523 0 1 .4477 1 1s-.4477 1-1 1h-16c-.55228 0-1-.4477-1-1z\" fill-rule=\"evenodd\"></path>\
		 </svg>\
	  </svg>\
	</div>\
	<input class=\"cart-counter_input\" type=\"text\" value=\"" + boughtProducts[3] + "\" data-min-number-for-sale=\"" + boughtProducts[8] + "\" data-max-number-for-sale=\"" + boughtProducts[9] + "\">\
	<div aria-label=\"Добавить ещё один товар\" class=\"number-product-plus\">\
	  <svg height=\"24\" width=\"24\">\
		 <svg viewBox=\"0 0 24 24\">\
			<path d=\"m13 4c0-.55228-.4477-1-1-1s-1 .44772-1 1v7h-7c-.55228 0-1 .4477-1 1s.44772 1 1 1h7v7c0 .5523.4477 1 1 1s1-.4477 1-1v-7h7c.5523 0 1-.4477 1-1s-.4477-1-1-1h-7z\"></path>\
		 </svg>\
	  </svg>\
	</div>";
	
	let inputCounter = divCounter.querySelector('input');
	inputCounter.addEventListener('input', inputingOfNumberBoughtProduct);
	inputCounter.addEventListener('blur', blurOfNumberBoughtProduct);
	
	checkButtonsForChangeInputNumberProduct(divCounter);
	
	let divPriceAndCounter = document.createElement('div');
	divPriceAndCounter.className = "price-and-counter";
	
	let divPriceCount = document.createElement('div');
	divPriceCount.className = "cart-price-count";
	
	divPriceCount.innerHTML = "<span data-price=\"" + Number(boughtProducts[2]) + "\">" + Math.ceil(Number(boughtProducts[2])*Number(boughtProducts[3])) + "</span> &#8381;";
	
	divPriceAndCounter.append(divCounter);
	divPriceAndCounter.append(divPriceCount);
	divProduct.append(divPriceAndCounter);
	
	divProduct.append(divOptionMenu);
	
	let buttonContinueShoppingCart = containerBoughtProducts.querySelector('.button-continue-shopping');
	if(buttonContinueShoppingCart == null) {
		containerBoughtProducts.append(divProduct);
	} else {
		buttonContinueShoppingCart.parentNode.before(divProduct);
	}
}

function createAndAppendNumberBoughtProducts() {
	let container = document.querySelector('#cart').parentNode;
	
	let numberOfProductsOnHeader = document.createElement('div');
	numberOfProductsOnHeader.className = "quick-panel__num";
	
	container.prepend(numberOfProductsOnHeader);
}

function changeClassOfProductOnBuyCart(containerBoughtProducts) {
	let allBoughtProducts = containerBoughtProducts.querySelectorAll('.bought-product-container');
	let lastBoughtProduct = allBoughtProducts[allBoughtProducts.length-1];
	lastBoughtProduct.classList.add('last');
}

function changeClassesOfProductsOnBuyCart(containerBoughtProducts) {
	let allBoughtProducts = containerBoughtProducts.querySelectorAll('.bought-product-container');

	for(let i = 0; i < allBoughtProducts.length; i++) {
		let boughtProduct = allBoughtProducts[i];
		
		if(i < allBoughtProducts.length-1) {
			if(boughtProduct.classList.contains('last')) {
				boughtProduct.classList.remove('last');
			}
		} else {
			boughtProduct.classList.add('last');
		}
	}
}

function changeClassSpanSvg(buttonSvg) {
	let buttonToBuy = document.querySelector('.buttonBuy');
	buttonToBuy.classList.add('none');
	let buttonBuyed = document.querySelector('.buttonBuyed');
	buttonBuyed.classList.remove('none');
}

function createMainContainerOrderBuyCart(containerBoughtProducts) {
	let valueCostAllProducts = 0;
	let allPrices = containerBoughtProducts.querySelectorAll('.cart-price-count span');
	for(let el of allPrices) {
		valueCostAllProducts += Number(el.innerText);
	}
	
	let divMainContainerOrderBuyCart = document.createElement('div');
	divMainContainerOrderBuyCart.style.display = "flex";
	
	let divContainerOrderBuyCart = document.createElement('div');
	divContainerOrderBuyCart.className = "order-buy-cart";
	
	let divCostAllProducts = document.createElement('div');
	divCostAllProducts.className = "cost-all-products";
	
	divCostAllProducts.innerHTML = "<span>" + valueCostAllProducts + "</span> &#8381;";
	
	aOrderLink = document.createElement('a');
	aOrderLink.setAttribute('href', '/checkout');
	
	let divOrderBuyCart = document.createElement('div');
	divOrderBuyCart.className = "button-order-buy-cart";
	divOrderBuyCart.innerHTML = "Оформить заказ";
	
	aOrderLink.append(divOrderBuyCart);
	
	divContainerOrderBuyCart.append(divCostAllProducts);
	divContainerOrderBuyCart.append(aOrderLink);
	
	divButtonContinueShopping = document.createElement('div');
	divButtonContinueShopping.className = "button-continue-shopping";
	divButtonContinueShopping.style.padding = "10px";
	divButtonContinueShopping.innerHTML = "Продолжить покупки";
	
	divButtonContinueShopping.addEventListener('click', launchToggleModalBlock.bind(null, 1, 1));
	
	divMainContainerOrderBuyCart.append(divButtonContinueShopping);
	divMainContainerOrderBuyCart.append(divContainerOrderBuyCart);
	
	containerBoughtProducts.append(divMainContainerOrderBuyCart);
}

if(typeof(boughtProducts) != 'undefined') {
	let cartModule = document.querySelector('.modalBlock.buyCartModal');
	let cartBody = cartModule.querySelector('.modalBody');
	
	let containerBoughtProducts = document.createElement('div');
	containerBoughtProducts.className = "container-bought-products";
	containerBoughtProducts.style.padding = "25px";
	
	for(let i = 0; i < boughtProducts.length; i++) {
		addProductToBuyCart(boughtProducts[i], containerBoughtProducts);
	}
	
	changeClassOfProductOnBuyCart(containerBoughtProducts);
	
	createMainContainerOrderBuyCart(containerBoughtProducts);
	
	cartBody.append(containerBoughtProducts);
}