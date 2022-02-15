function addNewShop() {
	let isLaunchSaving = 0;
	let isFirstSaving = 1;
	
	let isCheckedShopJurName = 1;
	let isCheckedShopURL = 1;
	let isCheckedShopName = 1;
		
	function checkIsAvailableShopJurName() {
		let div = this.parentNode.parentNode;
		let label = div.querySelector('label');
		
		console.log(label);
		
		if(this.value.length > 0) {
			label.classList.remove('error');
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'App/Controllers/checkIsAvailableShopJurName.php');
			xhr.setRequestHeader( "Content-Type", "application/json" );

			xhr.addEventListener('readystatechange', function(e) {
				console.log(e.target.response);
				if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
					if(e.target.response == '1') {
						label.classList.remove('error');
						label.classList.remove('notAvailble');
					} else {							
						label.classList.add('error');
						label.classList.add('notAvailble');
						isNormal = false;
					}
					isCheckedShopJurName = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveNewSeller();
					}
				}
				else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
					console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
					isCheckedShopJurName = 1;
					if(isLaunchSaving) {
						isLaunchSaving = 0;
						saveNewSeller();
					}
				}
			});
			xhr.send('"' + this.value + '"');
		} else {
			label.classList.remove('error');
			label.classList.remove('notAvailble');
			isCheckedShopJurName = 1;
		}
	}
	
	function inputShopJurName() {
		let div = this.parentNode.parentNode;
		let label = div.querySelector('label');
		
		label.classList.remove('error');
		label.classList.remove('needMore');
		label.classList.remove('notAvailble');
		isCheckedShopJurName = 0;
	}
	
	let shopJurName;
	if(typeof(sellerJuridicName) == "undefined") {
		shopJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_jurName');	
		shopJurName.addEventListener('blur', checkIsAvailableShopJurName, false);
		shopJurName.addEventListener('input', inputShopJurName, false);
	}
	
	function checkIsAvailableShopName() {
		let div = this.parentNode;
		let label = div.querySelector('label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.' + div.classList[0] + ' + div');
		
		if(this.value.length > 0) {
			if(this.value.length < 4) {
				label.classList.remove('notAvailble');
				label.classList.add('error');
				label.classList.add('needMore');
				title.style.paddingTop = "17px";
				isCheckedShopName = 1;
			} else {
				label.classList.remove('error');
				label.classList.remove('needMore');
				
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'App/Controllers/checkIsAvailableShopName.php');
				xhr.setRequestHeader( "Content-Type", "application/json" );

				xhr.addEventListener('readystatechange', function(e) {
					console.log(e.target.response);
					if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
						if(e.target.response == '1') {
							label.classList.remove('error');
							label.classList.remove('notAvailble');
							title.style.paddingTop = "5px";
						} else {							
							label.classList.add('error');
							label.classList.add('notAvailble');
							title.style.paddingTop = "17px";
							isNormal = false;
						}
						isCheckedShopName = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
						}
					}
					else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
						console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
						isCheckedShopName = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
						}
					}
				});
				xhr.send('"' + this.value + '"');
			}
		} else {
			label.classList.remove('error');
			label.classList.remove('notAvailble');
			label.classList.remove('needMore');
			title.style.paddingTop = "5px";
			isCheckedShopName = 1;
		}
	}
	
	function inputShopName() {
		let div = this.parentNode;
		let label = div.querySelector('label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.' + div.classList[0] + ' + div');
		
		label.classList.remove('error');
		label.classList.remove('needMore');
		label.classList.remove('notAvailble');
		title.style.paddingTop = "5px";
		isCheckedShopName = 0;
	}
	
	let shopName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_nameOfShop');	
	shopName.addEventListener('blur', checkIsAvailableShopName, false);
	shopName.addEventListener('input', inputShopName, false);
	
	function inputingPhoneCode() {
		let input = this.value.replace(/\D/g, '');
		let indexPlus = this.value.indexOf("+");
		
		if(indexPlus) {
			this.value = "+" + input.substring(indexPlus) + input.substring(0, indexPlus);
		} else {
			this.value = "+" + input;
		}
		
		if(this.value.length > 8) {
			this.value = this.value.substring(0, 8);
		}
			
		if(this.value !== "+") {
			this.parentNode.querySelector('.code label').classList.add('active');
			this.classList.add('active');
			addingNewPhone(this);
		} else {
			this.classList.remove('active');
			this.parentNode.querySelector('.code label').classList.remove('active');
		}
	}
	
	function inputingPhoneNumber() {
		this.value = this.value.replace(/\D/g, '');
		
		if(this.value.length > 15) {
			this.value = this.value.substring(0, 15);
		}
		
		if(this.value !== "") {
			this.parentNode.querySelector('.number label').classList.add('active');
			this.classList.add('active');
			addingNewPhone(this);
		} else {
			this.classList.remove('active');
			this.parentNode.querySelector('.number label').classList.remove('active');
		}
	}
	
	function addingNewPhone(input) {
		let phoneParentNode = input.parentNode.parentNode.parentNode.parentNode;
		
		if(phoneParentNode.classList.contains('add_new_user_phone')
			|| phoneParentNode.classList.contains('addNewSeller_phone')) {
			
			let nameClass;
			
			if(phoneParentNode.classList.contains('add_new_user_phone')) {
				nameClass = 'add_new_user_phone';
			} else if(phoneParentNode.classList.contains('addNewSeller_phone')) {
				nameClass = 'addNewSeller_phone';
			}
			
			let newPhone = phoneParentNode.querySelector('div');
			let editPhone =  newPhone.querySelectorAll('.input');
			
			let numberOfNewPhone = editPhone.length + 1;
			let newEditPhone = editPhone[editPhone.length-1];
		
			let inputNewPhoneCode = newEditPhone.querySelector('.code input');
			let inputNewPhoneNumber = newEditPhone.querySelector('.number input');
			
			if(input.parentNode.parentNode.querySelector('.code input').value !== "+" && input.value !== "") {
				if(inputNewPhoneCode.value !== "+" && inputNewPhoneNumber.value !== "") {
					let addNewPhone = document.createElement("div");
					addNewPhone.className = "input";
					addNewPhone.innerHTML = "<div class=\"code\">\
												<input type=\"text\" id=\"" + nameClass + "Code" + numberOfNewPhone + "\" value=\"+\">\
												<label for=\"" + nameClass + "Code" + numberOfNewPhone + "\">Код страны</label>\
											</div>\
											<div class=\"number\">\
												<input type=\"text\" id=\"" + nameClass + "" + numberOfNewPhone + "\">\
												<label for=\"" + nameClass + "" + numberOfNewPhone + "\">Номер телефона</label>\
											</div>";
					
					newPhone.append(addNewPhone);
					
					inputNewPhoneCode = addNewPhone.querySelector('.code input');
					inputNewPhoneNumber = addNewPhone.querySelector('.number input');
					
					inputNewPhoneCode.addEventListener('input', inputingPhoneCode, false);
					inputNewPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
				}
			}
		}
	}
	
	let shopPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_phone > div .input');
	
	let inputShopPhoneCode = shopPhone.querySelector('.code input');
	let inputShopPhoneNumber = shopPhone.querySelector('.number input');
	
	inputShopPhoneCode.addEventListener('input', inputingPhoneCode, false);
	inputShopPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
	
	function checkIsAvailableURL() {
		let divURLShop = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop');
		let label = divURLShop.querySelector('label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop + div');
		
		if(this.value.length > 0) {
			if(this.value.length < 4) {
				label.classList.remove('falseSimbols');
				label.classList.remove('notAvailble');
				label.classList.add('error');
				label.classList.add('needMore');
				title.style.paddingTop = "17px";
				isCheckedShopURL = 1;
			} else {
				label.classList.remove('error');
				label.classList.remove('needMore');
				label.classList.remove('notAvailble');
				label.classList.remove('falseSimbols');
				
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'App/Controllers/checkIsAvailableURL.php');
				xhr.setRequestHeader( "Content-Type", "application/json" );

				xhr.addEventListener('readystatechange', function(e) {
					console.log(e.target.response);
					if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
						if(e.target.response == '1') {
							title.style.paddingTop = "5px";
						} else {							
							label.classList.add('error');
							label.classList.add('notAvailble');
							title.style.paddingTop = "17px";
							isNormal = false;
						}
						isCheckedShopURL = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
						}
					}
					else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
						console.log('К сожалению, не удалось определить, доступен ли адрес магазина на платформе Saterno.');
						isCheckedShopURL = 1;
						if(isLaunchSaving) {
							isLaunchSaving = 0;
							saveNewSeller();
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
			title.style.paddingTop = "5px";
			isCheckedShopURL = 1;
		}
	}
	
	function inputURL() {
		let label = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop label');
		let title = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop + div');
		
		if(this.value.match(/\W/g) != null) {			
			label.classList.add('error');
			label.classList.add('falseSimbols');
			title.style.paddingTop = "57px";
			this.value = this.value.replace(/\W/g, '');
		} else {
			label.classList.remove('error');
			label.classList.remove('falseSimbols');
			title.style.paddingTop = "5px";
		}
		isCheckedShopURL = 0;
	}
	
	let devShopUrl = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_URLShop');
	devShopUrl.addEventListener('input', inputURL, false);
	devShopUrl.addEventListener('blur', checkIsAvailableURL, false);
	
	let addNewSeller_logoOfShop = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_logoOfShop');
	let clickAddNewSeller_logoOfShop = 0;
	addNewSeller_logoOfShop.querySelector('svg').addEventListener('click', clickingAddNewSeller_logoOfShop);
	
	function clickingAddNewSeller_logoOfShop() {
		onlyOne = 1;
		if(clickAddNewSeller_logoOfShop == 0) {
			launchImagesForNewShopPopUp();
			clickAddNewSeller_logoOfShop = 1;
		}
	}
	
	function clearTableForAddSeller() {
		
		let formShopPhonesHTML = "<div class=\"input\">\
									<div class=\"code\">\
										<input type=\"text\" id=\"addNewSeller_phoneCode\" value=\"+\">\
										<label for=\"addNewSeller_phoneCode\">Код страны</label>\
									</div>\
									<div class=\"number\">\
										<input type=\"number\" id=\"addNewSeller_phone\">\
										<label for=\"addNewSeller_phone\">Номер телефона</label>\
									</div>\
							</div>";
		
		let divShopPhone = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_phone > div');
		divShopPhone.innerHTML = formShopPhonesHTML;
		
		let editShopPhone =  divShopPhone.querySelector('.input');
		let inputShopPhoneCode = editShopPhone.querySelector('.code input');
		let inputShopPhoneNumber = editShopPhone.querySelector('.number input');
		
		inputShopPhoneCode.addEventListener('input', inputingPhoneCode, false);
		inputShopPhoneNumber.addEventListener('input', inputingPhoneNumber, false);
		
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_nameOfShop').value = '';
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_URLShop').value = '';
		document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_descriptionOfShop').value = '';
		
		let addNewSeller_logoOfShop = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_logoOfShop img');
		addNewSeller_logoOfShop.src = 'App/templates/files/img/shops/default.png';
		
		clickAddNewSeller_logoOfShop = 0;
		
		let oldBlockImages = document.querySelector('.loadNewLogoOfShop.toggleModal3');
		oldBlockImages.remove();
		
		newBlockImages = document.createElement('div');
		newBlockImages.className = "modalBlock loadNewLogoOfShop toggleModal3 level2";
		newBlockImages.dataset.state = "closed";
		newBlockImages.innerHTML = "<div class=\"modal__block\">\
			<div class=\"modalHeader\">\
				<div class=\"title\">Изменение фотографии</div>\
				<div class=\"select-all\">\
					<svg width=\"19\" height=\"19\" viewBox=\"0 0 512.000000 512.000000\" preserveAspectRatio=\"xMidYMid meet\" xmlns=\"http://www.w3.org/2000/svg\">\
						<g transform=\"translate(0.000000,512.000000) scale(0.100000,-0.100000)\" stroke=\"none\">\
						<path d=\"M203 4958 c-174 -172 -196 -198 -191 -231 3 -19 32 5 192 163 103 102 192 193 197 203 8 14 5 17 -17 17 -21 0 -60 -33 -181 -152z\"/>\
						<path d=\"M303 4858 c-140 -139 -264 -265 -275 -281 -10 -15 -18 -37 -16 -50 3 -18 49 23 292 263 158 157 292 293 297 303 8 14 5 17 -17 17 -22 0 -75 -47 -281 -252z\"/>\
						<path d=\"M402 4758 c-194 -194 -362 -365 -373 -381 -11 -15 -19 -37 -17 -50 4 -18 67 40 392 363 213 212 392 393 397 403 8 14 5 17 -18 17 -22 0 -89 -62 -381 -352z\"/>\
						<path d=\"M502 4658 c-249 -249 -462 -465 -473 -481 -11 -15 -19 -37 -17 -50 4 -18 84 57 492 463 268 267 492 493 497 503 8 14 5 17 -18 17 -22 0 -104 -76 -481 -452z\"/>\
						<path d=\"M602 4558 c-304 -304 -562 -565 -573 -581 -11 -15 -19 -37 -17 -50 4 -18 101 75 592 563 323 322 592 593 597 603 8 14 5 17 -18 17 -23 0 -118 -91 -581 -552z\"/>\
						<path d=\"M702 4458 c-359 -359 -662 -665 -673 -681 -11 -15 -19 -37 -17 -50 4 -18 118 92 692 663 378 377 692 693 697 703 8 14 5 17 -18 17 -23 0 -133 -106 -681 -652z\"/>\
						<path d=\"M802 4358 c-414 -414 -762 -765 -773 -781 -11 -15 -19 -37 -17 -50 4 -18 57 30 335 307 330 327 331 328 312 275 -10 -30 -18 -67 -19 -84 0 -25 -45 -75 -315 -345 -257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 146 138 315 307 l308 308 0 -65 0 -64 -315 -316 c-257 -258 -315 -321 -315 -343 0 -15 3 -27 7 -27 4 0 145 138 314 306 l307 307 15 -49 14 -49 -329 -331 c-267 -269 -328 -335 -328 -357 0 -15 3 -27 7 -27 4 0 156 149 338 331 l332 330 25 -38 26 -38 -364 -366 c-298 -299 -364 -370 -364 -392 0 -15 3 -27 7 -27 4 0 175 168 380 372 l373 373 32 -33 33 -32 -413 -413 c-339 -340 -412 -418 -412 -440 0 -15 3 -27 7 -27 4 0 199 191 433 425 l426 426 42 -23 41 -23 -474 -475 c-395 -396 -475 -480 -475 -503 0 -23 3 -26 18 -18 9 5 234 227 500 494 l483 483 55 -10 55 -10 -555 -556 c-461 -461 -556 -560 -556 -583 0 -15 3 -27 7 -27 4 0 313 305 685 677 l678 678 0 -65 0 -65 -651 -650 c-357 -358 -655 -658 -660 -668 -8 -14 -5 -17 18 -17 23 0 130 102 660 632 l633 633 0 -65 0 -65 -551 -550 c-302 -303 -555 -558 -560 -567 -8 -15 -5 -18 18 -18 23 0 116 88 564 536 l537 537 15 -49 14 -49 -478 -480 c-264 -264 -479 -484 -479 -488 0 -4 12 -7 27 -7 22 0 108 81 490 462 254 254 464 460 466 457 2 -2 13 -20 25 -39 l21 -36 -405 -404 c-223 -223 -410 -413 -415 -422 -8 -15 -5 -18 18 -18 22 0 96 69 429 401 l402 401 37 -27 36 -28 -365 -366 c-201 -202 -366 -370 -366 -374 0 -4 12 -7 27 -7 22 0 92 65 384 357 l358 356 41 -18 c22 -10 40 -21 40 -24 0 -3 -142 -148 -316 -321 -173 -173 -320 -323 -325 -332 -8 -15 -5 -18 18 -18 22 0 85 58 353 325 l326 326 58 -7 58 -7 -311 -311 c-171 -172 -311 -315 -311 -319 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 348 320 l321 320 64 0 65 0 -313 -313 c-171 -172 -312 -316 -312 -320 0 -4 12 -7 27 -7 22 0 86 59 347 319 l321 319 70 6 69 6 -317 -318 c-174 -175 -317 -321 -317 -325 0 -4 12 -7 27 -7 21 0 97 70 402 370 458 451 410 403 861 861 300 305 370 381 370 402 0 15 -3 27 -7 27 -4 0 -150 -143 -325 -317 l-318 -317 6 69 6 70 319 321 c260 261 319 325 319 347 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c261 262 320 326 320 348 0 15 -3 27 -7 27 -4 0 -148 -141 -320 -312 l-313 -313 0 65 0 64 320 321 c263 264 320 326 320 349 0 22 -3 25 -17 17 -10 -5 -155 -147 -323 -315 l-304 -305 -18 47 -18 47 340 340 c280 281 340 346 340 368 0 23 -3 26 -17 18 -10 -5 -166 -159 -348 -340 -181 -182 -333 -331 -337 -331 -3 0 -16 16 -29 36 l-22 36 377 377 c308 309 376 382 376 404 0 15 -3 27 -7 27 -4 0 -182 -174 -394 -387 l-388 -386 -34 29 -35 29 429 430 c353 355 429 436 429 458 0 15 -3 27 -7 27 -4 0 -206 -199 -449 -441 l-442 -441 -47 17 -46 18 495 497 c410 410 496 501 496 523 0 15 -3 27 -7 27 -4 0 -239 -231 -523 -513 l-515 -513 -59 4 -59 4 582 582 c486 487 581 586 581 609 0 23 -3 26 -17 18 -10 -5 -288 -280 -618 -610 l-600 -601 -65 0 -65 0 628 628 c345 345 627 631 627 635 0 4 -12 7 -27 7 -23 0 -134 -107 -663 -635 l-635 -635 -65 0 -65 0 628 628 c345 345 627 631 627 635 0 4 -12 7 -27 7 -23 0 -116 -89 -543 -515 l-515 -515 -17 48 -17 47 459 460 c253 253 460 464 460 468 0 4 -12 7 -27 7 -22 0 -105 -78 -473 -444 l-445 -444 -26 37 -27 38 390 389 c214 214 394 397 399 407 8 14 5 17 -18 17 -22 0 -94 -67 -414 -386 -415 -414 -395 -398 -441 -347 -17 18 -4 32 323 358 187 187 345 348 350 358 8 14 5 17 -18 17 -22 0 -88 -61 -373 -346 l-347 -345 -39 18 c-21 9 -41 19 -43 21 -3 1 138 146 312 320 174 175 317 321 317 325 0 4 -12 7 -27 7 -22 0 -87 -59 -347 -318 l-321 -317 -58 5 -57 5 295 295 c163 162 301 303 306 313 8 14 5 17 -17 17 -23 0 -84 -56 -344 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 l-316 -315 -64 0 -65 0 308 308 c169 169 307 311 307 315 0 4 -12 7 -27 7 -22 0 -85 -58 -343 -315 -270 -270 -320 -315 -345 -315 -17 -1 -54 -9 -84 -19 -53 -19 -52 -17 273 308 179 180 326 330 326 334 0 4 -12 7 -27 7 -23 0 -152 -125 -781 -752z m738 -663 c-210 -210 -356 -349 -358 -341 -2 8 2 41 7 73 l11 58 273 272 272 273 55 9 c30 5 64 9 75 10 13 1 -106 -125 -335 -354z m450 250 c-88 -88 -110 -105 -136 -105 -17 0 -53 -7 -79 -15 l-49 -14 119 119 120 120 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m200 0 l-105 -105 -65 0 -65 0 105 105 105 105 65 0 65 0 -105 -105z m-2150 -150 c-107 -107 -196 -195 -198 -195 -1 0 9 21 22 48 36 70 110 166 170 216 45 39 181 126 196 126 3 0 -83 -88 -190 -195z m-48 -386 l-15 -77 -98 -98 -99 -99 0 65 0 65 112 112 c62 62 113 111 114 110 1 -1 -5 -36 -14 -78z m-111 -373 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m0 -200 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m1847 -553 l-588 -588 -32 32 -32 33 44 46 c141 145 1067 1032 1093 1047 18 9 48 17 67 17 34 0 15 -20 -552 -587z m-1847 353 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m2531 160 c9 -16 -64 -93 -572 -601 -568 -568 -584 -583 -611 -573 -71 25 -94 -2 541 633 571 571 595 594 613 577 10 -9 23 -25 29 -36z m3 -123 c-9 -21 -39 -61 -68 -89 -128 -125 -917 -882 -957 -918 -25 -22 198 203 495 502 297 298 541 542 543 542 1 0 -5 -17 -13 -37z m-2534 -237 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m0 -200 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m973 186 c7 -11 -188 -205 -197 -196 -4 4 -7 30 -7 57 0 46 3 53 49 98 45 46 52 49 99 49 28 0 53 -4 56 -8z m9 -204 l-107 -108 -33 32 -33 32 107 108 107 108 33 -32 33 -32 -107 -108z m172 32 l29 -31 -107 -107 -107 -107 -32 33 -33 32 105 105 c58 58 107 105 110 105 4 0 19 -14 35 -30z m-1154 -214 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m1172 -28 c-59 -59 -110 -104 -113 -100 -3 4 -16 20 -30 35 l-24 28 104 104 104 105 33 -32 33 -32 -107 -108z m172 36 l28 -36 -104 -104 -103 -104 -33 32 -33 32 107 108 c59 59 108 108 109 108 1 0 14 -16 29 -36z m-1344 -208 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m0 -200 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z m0 -200 l-101 -101 0 65 0 65 98 98 97 98 3 -63 3 -62 -100 -100z\"/>\
						<path d=\"M4396 750 c-394 -393 -722 -723 -727 -732 -8 -15 -5 -18 18 -18 23 0 137 110 711 683 376 375 692 694 703 710 11 15 19 37 17 50 -4 18 -124 -97 -722 -693z\"/>\
						<path d=\"M4496 650 c-339 -338 -622 -623 -627 -632 -8 -15 -5 -18 18 -18 23 0 123 95 611 583 321 320 592 594 603 610 11 15 19 37 17 50 -4 18 -106 -80 -622 -593z\"/>\
						<path d=\"M4596 550 c-284 -283 -522 -523 -527 -533 -8 -14 -5 -17 18 -17 23 0 108 81 511 483 266 265 492 494 503 510 11 15 19 37 17 50 -4 18 -89 -62 -522 -493z\"/>\
						<path d=\"M4696 450 c-229 -228 -422 -423 -427 -432 -8 -15 -5 -18 18 -18 22 0 93 66 411 383 211 210 392 394 403 410 11 15 19 37 17 50 -4 18 -72 -45 -422 -393z\"/> \
						<path d=\"M4796 350 c-174 -173 -322 -323 -327 -332 -8 -15 -5 -18 17 -18 23 0 80 52 312 282 156 156 293 295 303 311 11 15 19 37 17 50 -4 18 -54 -28 -322 -293z\"/>\
						<path d=\"M4896 250 c-119 -118 -222 -223 -227 -232 -8 -15 -5 -18 17 -18 21 0 65 37 211 183 205 202 226 227 221 260 -3 19 -37 -11 -222 -193z\"/>\
						<path d=\"M4996 150 c-136 -133 -149 -150 -111 -150 18 0 49 23 111 82 102 98 127 130 122 161 -3 19 -19 7 -122 -93z\"/> </g>\
					</svg>\
				</div>\
				<div class=\"delete-bin\">\
					<svg width=\"17\" height=\"17\"  viewBox=\"0 0 225.000000 225.000000\" preserveAspectRatio=\"xMidYMid meet\" xmlns=\"http://www.w3.org/2000/svg\">\
						<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\">\
							<path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3-595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"/>\
							<path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/>\
							<path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/>\
							<path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"/>\
						</g>\
					</svg>\
				</div>\
				<button class=\"modal__close toggleModal3 level2\" data-toggle=\"true\">\
					<svg width=\"14\" height=\"14\" viewBox=\"0 0 14 14\" xmlns=\"http://www.w3.org/2000/svg\">\
						<path d=\"M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z\" fill-rule=\"evenodd\"/>\
					</svg>\
				</button>\
			</div>\
			<div id=\"drop-area\">\
				<div class=\"areaBackground\">\
						<input type=\"file\" accept=\"image/*\" name=\"fileToUpload3\" id=\"fileToUpload3\" class=\"none\">\
						<div class=\"camera\">\
							<svg width=\"45\" height=\"45\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
								<g><path d=\"M500,359.2c-98.3,0-178.1,79.7-178.1,178.1c0,98.3,79.7,178.1,178.1,178.1c98.4,0,178.1-79.7,178.1-178.1C678.1,439,598.4,359.2,500,359.2z M203.1,136.4H99.4v44.9h103.7V136.4z M926.8,225.7h-194c-14.7-10.6-32.2-29.3-48.3-62.5c-19.5-40.2-89.7-41.5-89.7-41.5H368.6c0,0-23.1-5.7-50.3,41c-18.4,31.7-35.1,51.3-50.8,62.9H73.2c-34.9,0-63.2,30-63.2,67v518.8c0,37,28.3,67,63.2,67h853.5c34.9,0,63.2-30,63.2-67V292.6C990,255.7,961.7,225.7,926.8,225.7L926.8,225.7z M499.9,760.2c-122.9,0-222.6-99.7-222.6-222.6S377,314.9,499.9,314.9c122.9,0,222.6,99.7,222.6,222.6S622.8,760.2,499.9,760.2z M819,359.3c-20.5,0-37-16.6-37-37.2c0-20.5,16.6-37.2,37-37.2c20.5,0,37.1,16.6,37.1,37.2C856.1,342.7,839.5,359.3,819,359.3L819,359.3z\"/></g>\
							</svg>\
						</div>\
						<div class=\"title\">\
							Отпустите, чтобы начать загрузку\
						</div>\
				</div>\
			</div>\
			<label class=\"modalLoadNewPhoto\" for=\"fileToUpload3\">\
				<div class=\"title\">\
					<svg class=\"iconPlus\" width=\"14\" height=\"14\" viewBox=\"0 0 14 14\" xmlns=\"http://www.w3.org/2000/svg\">\
						<path d=\"M8.414 7l4.95-4.95L11.948.638 7 5.587 2.05.636.638 2.05 5.587 7l-4.95 4.95 1.414 1.413L7 8.413l4.95 4.95 1.413-1.414L8.413 7z\" fill-rule=\"evenodd\"/>\
					</svg>\
					<span>Загрузить новую фотографию</span>\
				</div>\
			</label>\
			<div class=\"modalBody\">\
				<div class=\"fileUploadError\"></div>\
				<div class=\"fileLoading\"></div>\
				<div class=\"windowAllImages\">\
					<div class=\"rowImages\">\
					</div>\
				</div>\
			</div>\
		  </div>";
		
		let content = document.querySelector('.mainHtmlContent');
		content.append(newBlockImages);
		
		let togglesB = document.getElementsByClassName('toggleModal3');

		togglesB[2].addEventListener('click', function() {
				toggleModalBlock(3, 2);
		});
		
		togglesB[1].addEventListener('click', function() {
				toggleModalBlock(3, 2);
		});
		
		let modalwindowB = document.querySelector('.modalBlock.loadNewLogoOfShop .modal__block');
		modalwindowB.addEventListener('click', function() {
			event.stopPropagation();
		});
		
		let rowImages = document.querySelector('.modalBlock.loadNewLogoOfShop .modal__block .modalBody .rowImages');
		rowImages.innerHTML = "";
		
		if(typeof(sellerJuridicName) == "undefined") {
			let jurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name .input input');
			jurName.value = "";
		}
	}
	
	function addNewSellerToDOM(dataOfNewUser) {
		let data = dataOfNewUser.split(',');
		
		let shopId = data[0];
		let dataAdd = data[1];
		let sellerId = data[2];
		let photoName = data[4];
		
		let fio = data[3];
		let jurSelectedType = data[5];
		let jurType = data[6];
		let isTrading = data[7];
		
		let strIsTrading = "";
		
		if(isTrading == "1") {
			strIsTrading = "Одобрен";
		} else {
			strIsTrading = "Неодобрен";
		}
		
		let jurName;
		if(typeof(sellerJuridicName) == "undefined") {
			jurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name .input #addNewSeller_jurName').value;
		}
		
		let shopName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_nameOfShop').value;
		let shopDescription = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_descriptionOfShop').value;
		let shopUrl = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_URLShop').value;

		let divPhones = document.querySelectorAll('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_phone > div .input');
		let phones = "['";
		for(let elem of divPhones) {
			let code = elem.querySelector('.code input').value;
			let number = elem.querySelector('.number input').value;
			let phone = code + number;
			if(code != "+" && number != "") {
				phones += phone;
				phones += "', '";
			}
		}
		phones += "]";
		
		let newTr = document.createElement('tr');
		newTrStrHtml = "<td class=\"none\" data-id=\"" + shopId + "\"\
		data-img-url=\"App/templates/files/img/shops/\" data-img-name=\"" + photoName + "\"\
		data-phones=\"" + phones + "\" data-shop-description=\"" + shopDescription + "\"\
		data-shop-url=\"" + shopUrl + "\" data-jur-selected-type=\"" + jurSelectedType + "\" data-jur-type=\"" + jurType + "\" ";
		
		if(typeof(sellerJuridicName) == "undefined") {
			newTrStrHtml += "data-jur-name=\"" + jurName + "\" ";
		}
		
		newTrStrHtml += "data-istrading=\"" + isTrading + "\" data-status-of-trading=\"\" data-is-included=\"1\"\
		data-shopistrading=\"1\" data-shop-status-of-trading=\"\" data-shop-is-included=\"1\"></td>";
		
		if(typeof(sellerJuridicName) == "undefined") {
			newTrStrHtml += "<td class=\"full_name\">" + fio + "</td>";
		}
		
		newTrStrHtml += "<td class=\"name\">" + shopName + "</td>\
		<td>" + dataAdd + "</td>\
		<td>"+ strIsTrading +"</td>";
				
		newTrStrHtml += "<td></td><td>Включён</td>\
		<td class=\"editShop\">\
			<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"version=&quot;1.1&quot;\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 1000 1000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
				<g><path d=\"M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z\"></path></g>\
			</svg><br>Редактировать\
		</td>\
		<td class=\"deleteShop\">\
			<svg width=\"20px\" height=\"20px\" title=\"change\" class=\"version=&quot;1.1&quot;\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 225.000000 225.000000\" enable-background=\"new 0 0 1000 1000\" xml:space=\"preserve\">\
				<g transform=\"translate(0.000000,225.000000) scale(0.100000,-0.100000)\" stroke=\"none\"><path d=\"M875 2219 c-100 -48 -167 -145 -181 -261 l-6 -57 -190 -3 c-221 -4 -222 -4 -234 -109 l-7 -59 -38 0 -39 0 0 -84 0 -83 31 -7 c17 -3 56 -6 85 -6 l54 0 0 -671 0 -670 25 -54 c28 -58 79 -109 131 -131 27 -11 146 -14 624 -14 666 0 628 -4 703 79 70 78 67 40 67 787 l0 674 59 0 c32 0 73 3 90 6 l31 7 0 83 0 84 -45 0 -45 0 0 54 c0 44 -5 61 -24 83 l-24 28 -191 3 -191 3 0 44 c0 105 -74 220 -173 270 -50 24 -55 25 -261 25 -189 -1 -215 -3 -251 -21z m430 -163 c43 -18 75 -69 75 -118 l0 -38 -255 0 -255 0 0 28 c1 47 34 107 71 125 46 22 312 24 364 3z m425 -1165 l0 -660 -24 -28 -24 -28 -526 -3 c-554 -3 -595 0 -618 41 -10 17 -14 172 -16 680 l-3 657 605 0 606 0 0 -659z\"></path><path d=\"M700 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1040 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path><path d=\"M1390 865 l0 -515 85 0 85 0 0 515 0 515 -85 0 -85 0 0 -515z\"></path></g>\
			</svg><br>Удалить\
		</td>";
		
		newTr.innerHTML = newTrStrHtml;
		
		let tableSellersTbody = document.querySelector('.table_shops tbody');
		tableSellersTbody.append(newTr);
		
		newTr.querySelector('.editShop').addEventListener('click', actionShop, false);
		newTr.querySelector('.deleteShop').addEventListener('click', actionShop, false);
		changeLeftMenuHeight();
	}
	
	function afterSavingNewSeller(dataOfNewUser) {
		addNewSellerToDOM(dataOfNewUser);
		clearTableForAddSeller();		
		toggleModalBlock(0, 1);
	}
	
	function saveNewSellerPOST(arrayForNewSeller) {
		console.log(arrayForNewSeller);
		
		isFirstSaving = 0;
		
		let jurName = arrayForNewSeller[0];
		
		let shopName = arrayForNewSeller[1]; 
		let shopUrl = arrayForNewSeller[2]; 
		let shopDescription = arrayForNewSeller[3]; 
		let shopLogoUrl = arrayForNewSeller[4]; 
		let shopPhones = arrayForNewSeller[5];
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'App/Controllers/registerNewShop.php');

		xhr.addEventListener('readystatechange', function(e) {
			
			if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
				afterSavingNewSeller(e.target.response);
				isFirstSaving = 1;
				console.log(e.target.response);
			}
			else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
				let errorMessage = document.querySelector('.modalBlock.error.level2 .modalBody');
				errorMessage.innerHTML = "<p>Не удалось добавить нового продавца.</p>";
				toggleModalBlock(4, 2);
				isFirstSaving = 1;
				console.log('Не удалось добавить нового продавца.');
			}
		});
				
				
        var fd = new FormData;
		fd.append("jurName", jurName);
		fd.append("shopName", shopName);
		fd.append("shopUrl", shopUrl);
		fd.append("shopDescription", shopDescription);
		fd.append("shopLogoUrl", shopLogoUrl);
		fd.append("shopPhones", shopPhones);
		xhr.send(fd);
	}
	
	function saveNewSeller() {
		if(isFirstSaving == 0) {
			return false;
		}
		
		if(typeof(sellerJuridicName) == "undefined") {
			if(isCheckedShopJurName == 0) {
				let inputShopJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_jurName');
			
				isLaunchSaving = 1;
				
				let eventBlur = new Event("blur");
				inputShopJurName.dispatchEvent(eventBlur);
				
				return false;
			}
		}
		
		if(isCheckedShopURL == 0) {
			let inputShopUrl = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_URLShop');
		
			isLaunchSaving = 1;
			
			let eventBlur = new Event("blur");
			inputShopUrl.dispatchEvent(eventBlur);
			
			return false;
		}
		
		if(isCheckedShopName == 0) {
			let inputShopName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_nameOfShop');	
		
			isLaunchSaving = 1;
			
			let eventBlur = new Event("blur");
			inputShopName.dispatchEvent(eventBlur);
			
			return false;
		}
		
		let isNormal = true;
		let errorField = "";
				
		let jurName;
		if(typeof(sellerJuridicName) == "undefined") {
			let divJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name');
			let labelShopJurName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.juridic_name label');
			
			let jurNameInputed = divJurName.querySelector('.input #addNewSeller_jurName');
			if(jurNameInputed != null) {
				jurName = jurNameInputed.value;
				if(jurName == '') {
					isNormal = false;
					errorField += "<p>Введите юридическое название компании продавца.</p>";
				} else if(labelShopJurName.classList.contains('notAvailble')) {
					isNormal = false;
					errorField += "<p>Измените юридическое название компании продавца на доступное.</p>";
				}
			}
		} else {
			jurName = sellerJuridicName;
		}
		
		let shopName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_nameOfShop').value;
		let labelShopName = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_shopName label');
		
		if(shopName.length == 0) {
			isNormal = false;
			errorField += "<p>Введите название магазина продавца.</p>";
		} else if(shopName.length < 4) {
			isNormal = false;
			errorField += "<p>Название магазина должно быть не меньше 4-х символов.</p>";
		} else if(labelShopName.classList.contains('notAvailble')) {
			isNormal = false;
			errorField += "<p>Измените название магазина на доступный.</p>";
		}
		
		let inputShopUrl = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div input#addNewSeller_URLShop');
		let shopUrl = inputShopUrl.value;
				
		let labelShopURL = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_URLShop label');
		
		if(shopUrl.length > 0 && shopUrl.length < 4) {
			isNormal = false;
			errorField += "<p>Адрес(URL) магазина  должен быть не меньше 4-х символов.</p>";
		} else if(labelShopURL.classList.contains('notAvailble')) {
			isNormal = false;
			errorField += "<p>Измените URL магазина на доступный.</p>";
		}
		
		let shopDescription = document.querySelector('.modalBlock.addNewTable .modal__block .modalBody > div #addNewSeller_descriptionOfShop').value;
		if(shopDescription == '') {
			isNormal = false;
			errorField += "<p>Введите описание магазина продавца.</p>";
		}
		let shopLogo = document.querySelector('.modalBlock.loadNewLogoOfShop .modal__block .modalBody .imageCart .select img');
		let shopLogoUrl = "App/templates/files/img/shops/default.png";
		if(shopLogo != null) {
			shopLogoUrl = "App/templates/files/img/shops/" + shopLogo.dataset.filename;
		} else {
			isNormal = false;
			errorField += "<p>Загрузите и выбирете логотип для магазина продавца.</p>";
		}
		
		let divShopPhones = document.querySelectorAll('.modalBlock.addNewTable .modal__block .modalBody > div.addNewSeller_phone > div .input');
		let shopPhones = [];
		for(let elem of divShopPhones) {
			let code = elem.querySelector('.code input').value;
			let number = elem.querySelector('.number input').value;
			let phone = code + number;
			if(code != "+" && number != "") {				
				shopPhones.push(phone);
			}
		}
		if(shopPhones.length == 0) {
			isNormal = false;
			errorField += "<p>Введите номер телефона для отслеживания покупок.</p>";
		}
		
		if(!isNormal) {
			let errorMessage = document.querySelector('.modalBlock.error.level2 .modalBody');
			errorMessage.innerHTML = errorField;
			toggleModalBlock(4, 2);
		} else {
			saveNewSellerPOST([jurName, shopName, shopUrl, shopDescription, shopLogoUrl, shopPhones]);
		}
	}
	
	let buttonSaveAddingSeller = document.querySelector('.modalBlock.addNewTable .modalHeader .save-new-table');
	buttonSaveAddingSeller.addEventListener('click', saveNewSeller, false);
}

addNewShop();