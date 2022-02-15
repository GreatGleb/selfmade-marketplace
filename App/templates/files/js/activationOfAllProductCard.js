let buttonsAddToCart = document.querySelectorAll('.ltabs-item.product-layout .product-item-container .svg.buttonBuy > svg');

for (let button of buttonsAddToCart) {
	button.addEventListener('click', addingToCartP);
}

function editSvgProductToCartP(buttonSvg) {
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

	buttonSvg.removeEventListener('click', addingToCartP);
}

function editSvgProductToEmptyCartP(buttonSvg) {
	buttonSvg.style.fill = "#000";
	buttonSvg.innerHTML = "<svg viewBox=\"0 0 24 24\" id=\"icon-basket\">\
								<g>\
									<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4H2.68121C3.08124 4 3.44277 4.2384 3.60035 4.60608L8.44161 15.9023C9.00044 17.2063 10.3963 17.9405 11.7874 17.6623L19.058 16.2082C20.1137 15.9971 20.9753 15.2365 21.3157 14.2151L23.0712 8.94868C23.7187 7.00609 22.2728 5 20.2251 5H5.94511L5.43864 3.81824C4.96591 2.71519 3.88129 2 2.68121 2H1ZM10.2799 15.1145L6.80225 7H20.2251C20.9077 7 21.3897 7.6687 21.1738 8.31623L19.4183 13.5827C19.3049 13.9231 19.0177 14.1767 18.6658 14.247L11.3952 15.7012C10.9315 15.7939 10.4662 15.5492 10.2799 15.1145Z\"></path>\
									<path d=\"M11 22C11 23.1046 10.1046 24 9 24C7.89543 24 7 23.1046 7 22C7 20.8954 7.89543 20 9 20C10.1046 20 11 20.8954 11 22Z\"></path>\
									<path d=\"M21 22C21 23.1046 20.1046 24 19 24C17.8954 24 17 23.1046 17 22C17 20.8954 17.8954 20 19 20C20.1046 20 21 20.8954 21 22Z\"></path>\
								</g>\
							</svg>";

	buttonSvg.removeEventListener('click', addingToCartP);
}

function addProducToCartP(buttonSvg, atributesId) {
	let divProduct = buttonSvg.parentNode.parentNode.parentNode.parentNode.parentNode;
	let productId = divProduct.dataset.productId;
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/addProductToCart.php');

	xhr.addEventListener('readystatechange', function(e) {			
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			addProducToCartDOMP(divProduct, atributesId);
			if(atributesId == '') {
				editSvgProductToCartP(buttonSvg);
				changeClassSpanSvg(buttonSvg);
				if(atributesId == '') {
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

function addingToCartWithAtributesP() {
	event.stopImmediatePropagation();
	
	let buttonSvg = this.divProduct.querySelector('.buttonBuy > svg');
	
	let divProduct = buttonSvg.parentNode.parentNode.parentNode.parentNode.parentNode;
	let productId = divProduct.dataset.productId;
	
	let windowModal = document.querySelector('.toggleModal0');
	let windowBody = windowModal.querySelector('.modalBody');
	
	let arrLi = windowBody.querySelectorAll('.atributes p ul li label input:checked');
	let arrAtributes = [];
	
	for(let atrib of arrLi) {
		let li = atrib.parentNode.parentNode
		let el = li.dataset.atributeId;
		arrAtributes.push(el);
	}
	
	strAtributes = arrAtributes.join(',');
	let boughtAtributes = divProduct.dataset.boughtAtributes;
	
	divProduct.dataset.boughtAtributes = boughtAtributes + strAtributes + ',]';
	
	addProducToCartP(buttonSvg, strAtributes);
	
	let pButtonEvent = windowBody.querySelector('.pButtonBuy');
	pButtonEvent.innerHTML = '<span class="svg buttonBuy"><svg height="24" width="24" style="fill: #000;cursor: pointer;"></svg></span>';
	
	let button = windowBody.querySelector('.modalBody .buttonBuy > svg');
	
	editSvgProductToCartP(button);
	button.addEventListener('click', launchToggle2ModalBlocks.bind(null, 0, 1, 1, 1));
	
	//toggleModalBlock(0, 1);
}

let htmlModalBody0 = document.querySelector('.toggleModal0 .modalBody').innerHTML;

function changeButtonWindowAtributesP(divProduct) {
	let windowModal = document.querySelector('.toggleModal0');
	let windowBody = windowModal.querySelector('.modalBody');
	
	let list = windowBody.querySelectorAll('.atributes p ul li label input:checked');
	let arrAtributes = [];
	
	for(let atrib of list) {
		let li = atrib.parentNode.parentNode
		let el = li.dataset.atributeId;
		arrAtributes.push(el);
	}
	
	let arrBoughtAtributes = divProduct.dataset.boughtAtributes.split(']');
	
	let atributes = [];
	
	for(let atr of arrBoughtAtributes) {
		if(atr != '') {
			let atributesElem = atr.split(',');
			let atribs = [];
			
			for(let atrib of atributesElem) {
				if(atrib != '') {
					atribs.push(atrib);
				}
			}
			atributes.push(atribs);
		}
	}
	
	let isBoughtAtribut = 0;
	
	for(let atr of atributes) {
		let numb = atr.length;
		
		for(let i = 0; i < atr.length; i++) {
			if(arrAtributes[i] == atr[i]) {
				numb--;
			}
		}
		
		if(numb == 0) {
			isBoughtAtribut = 1;
		}
	}
	
	if(isBoughtAtribut == 1) {
		let pButtonEvent = windowBody.querySelector('.pButtonBuy');
		pButtonEvent.innerHTML = '<span class="svg buttonBuy"><svg height="24" width="24" style="fill: #000;cursor: pointer;"></svg></span>';
	
		let button = windowBody.querySelector('.buttonBuy > svg');
		editSvgProductToCartP(button);
		button.addEventListener('click', launchToggle2ModalBlocks.bind(null, 0, 1, 1, 1));
	} else {
		let pButtonEvent = windowBody.querySelector('.pButtonBuy');
		pButtonEvent.innerHTML = '<span class="svg buttonBuy"><svg height="24" width="24" style="fill: #000;cursor: pointer;"></svg></span>';
		
		let button = windowBody.querySelector('.buttonBuy > svg');
		editSvgProductToEmptyCartP(button);
		
		button.addEventListener('click', {handleEvent: addingToCartWithAtributesP, divProduct: divProduct});
	}
}

function inputsAtributsOnChangeP(divProduct) {
	let windowModal = document.querySelector('.toggleModal0');
	let windowBody = windowModal.querySelector('.modalBody');
	
	let inputs = windowBody.querySelectorAll('.atributes p ul li label input');
	
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].addEventListener('change', function() {
			event.stopImmediatePropagation();
			
			changeButtonWindowAtributesP(divProduct);
		});
	}
}

function chooseProductAtributeP(divProduct) {
	let windowModal = document.querySelector('.toggleModal0');
	let windowBody = windowModal.querySelector('.modalBody');
	windowBody.innerHTML = htmlModalBody0;
	let titleProduct = divProduct.querySelector('.right-block .caption h4 a').innerText;
	let spanTitleProduct = windowBody.querySelector('.product-title');
	spanTitleProduct.innerText = titleProduct;
	
	let price = divProduct.querySelector('.right-block .caption .price span').innerText;
	let spanPrice = windowBody.querySelector('.price-value');
	spanPrice.innerHTML = price + "&#8381";
	
	let oldPrice = divProduct.querySelector('.right-block .caption .old-price');
	if(oldPrice == null) {
		spanPrice.style.color = '#3b3b3b';
	}
	
	let productAtributes = divProduct.dataset.atributes;
	
	if(productAtributes == '' || productAtributes == undefined) {
		productAtributes = divProduct.parentNode.dataset.atributes;
	}
	
	productAtributes = productAtributes.split(']]]');
	
	let arrAtributes = [];
	
	for(let el of productAtributes) {
		if(el != "") {
			let arr = el.split(',!,');
			arrAtributes.push(arr);
		}
	}
	
	let divAtributes = windowBody.querySelector('.modalBody .atributes');
	
	for(let el of arrAtributes) {
	    console.log(el);
		let p = document.createElement('p');
		p.style.borderTop = "1px solid #e5e5e5";
		if(el[0] == arrAtributes[arrAtributes.length-1][0]) {
			p.style.borderBottom = "1px solid #e5e5e5";
		}
		p.style.padding = "10px 20px 0 20px";
		p.style.margin = "0";
		p.innerText = el[0] + ':';
		
		divAtributes.append(p);
		
		let list = document.createElement('ul');
		list.style.width = "80px";
		list.style.marginLeft = "10%";
		list.style.marginTop = "10px";
		
		for(let i = 1; i < el.length; i += 3) {
			let li = document.createElement('li');
			let label = document.createElement('label');
			label.className="form-label--radio form-label";
			let inputRadio = document.createElement('input');
			inputRadio.setAttribute("type", "radio");
			inputRadio.setAttribute("name", el[0]);
			
			if(i == 1) {
				inputRadio.setAttribute("checked", "checked");
			}
			
			let spanItem = document.createElement('span');
			spanItem.className = "form-stylized-option";
			
			let spanText = document.createElement('span');
			spanText.className = "label-text";
			spanText.innerText = el[i]
			let spanImg = document.createElement('span');
			
			if(el[i+1] !== '') {
				let fullSrc = el[i+1];
				let posDot = fullSrc.lastIndexOf('.');
				let imgName = fullSrc.substring(0, posDot);
				imgName += '_150x150' + fullSrc.substring(posDot);
				
				let img = document.createElement('img');
				img.setAttribute("src", "admin/App/templates/files/img/product-attributes/" + imgName);
				img.style.width = "35px";
				img.style.borderRadius = "5px";
				spanImg.append(img);
			}
			
			li.dataset.atributeId = el[i+2];
			
			label.append(inputRadio);
			label.append(spanItem);
			label.append(spanText);
			label.append(spanImg);
			
			li.append(label);
			list.append(li);
		}
		
		p.append(list);
	}
	
	changeButtonWindowAtributesP(divProduct);
	
	inputsAtributsOnChangeP(divProduct);
	
	toggleModalBlock(0, 1);
}

function addingToCartP() {
	let divProduct = this.parentNode.parentNode.parentNode.parentNode.parentNode;
	let productAtributes = divProduct.dataset.atributes;
	if((productAtributes == '' || productAtributes == undefined) && (divProduct.parentNode.dataset.atributes == '' || divProduct.parentNode.dataset.atributes == undefined)) {
		if(this.parentNode.tagName.toLowerCase() == 'span') {
			addProducToCartP(this, '');
		}
	} else {
		chooseProductAtributeP(divProduct);
	}
	
}