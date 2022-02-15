let buttonsCustomerFio = function() {
	let newCustomer = document.querySelector('.new_customer');
	let oldCustomer = document.querySelector('.old_customer');
	
	if(newCustomer != null && oldCustomer != null) {
    	newCustomer.addEventListener('click', editDataSignUp);
    	oldCustomer.addEventListener('click', editDataSignUp);
    	
    	let buttonSignUp = document.querySelector('.checkout-total__submit.sign_up');
    	buttonSignUp.addEventListener('click', signUpForCheckout);
	}
}

let signUpForCheckout = function() {
    let inputemail = document.querySelector('#email-for-sign-up');
    let email;
    if(inputemail != null) {
        email = inputemail.value;
    }
    
    let inputpassword = document.querySelector('#password-for-sign-up');
    let password;
    if(inputpassword != null) {
        password = inputpassword.value;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'App/Controllers/checkUserLoginAndPassword.php');
    
    xhr.addEventListener('readystatechange', function(e) {
    	if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
    	    let error = document.querySelector('#error-sign-up');
    	    
    	    if(e.target.response == '0') {
    	        error.style.display = "block";
    	    } else {
    	        error.style.display = "none";
    	        
    	        let data = e.target.response.split(']');
    	        let fio = data[0].split(' ');
    	        let numb = data[1];
    	        
    	        let f = fio[0];
    	        let i = fio[1];
    	        let o = fio[2];
    	        
    	       let inputf = document.querySelector('#new_customer_surname');
    	       inputf.setAttribute('itEnteredCostumer', '');
    	        if(f != undefined) {
    	            inputf.value = f;
    	        }
    	        
    	        if(i != undefined) {
    	            let inputi = document.querySelector('#new_customer_name');
    	            inputi.value = i;
    	        }
    	        
    	        if(o != undefined) {
    	            let inputo = document.querySelector('#new_customer_patronomic');
    	            inputo.value = o;
    	        }
    	        
    	        if(numb != undefined) {
    	            let inputnumb = document.querySelector('#new_customer_phone');
    	            inputnumb.value = numb;
    	        }
    	        
    	        document.querySelector('#email-for-sign-up').value = '';
    	        document.querySelector('#password-for-sign-up').value = '';
    	        
    	        let fioAndPhoneBlock = document.querySelector('.first_block .fio_and_phone_block');
            	let signUpBlock = document.querySelector('.first_block .sign_up_block');
            	
            	fioAndPhoneBlock.style.display = "block";
            	signUpBlock.style.display = "none";
    	    }
    	    
    	    console.log(e.target.response);
    	}
    	else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
    		console.log('Не удалось сохранить новый заказ.');
    	}
    });
    
    var fd = new FormData;
    fd.append("email", email);
    fd.append("password", password);
    xhr.send(fd);
}

let editDataSignUp = function() {	
	let fioAndPhoneBlock = document.querySelector('.first_block .fio_and_phone_block');
	let signUpBlock = document.querySelector('.first_block .sign_up_block');
	if(fioAndPhoneBlock != null && signUpBlock != null) {
    	if(this.classList.contains('new_customer')) {
    		fioAndPhoneBlock.style.display = "block";
    		signUpBlock.style.display = "none";
    		
    		let inputf = document.querySelector('#new_customer_surname');
        	let isEntered = inputf.getAttribute('itEnteredCostumer');
        	
        	if(isEntered != null && isEntered != undefined) {
        	    inputf.removeAttribute('itEnteredCostumer');
        	    new_customer_surname.value = '';
        	    new_customer_name.value = '';
        	    new_customer_patronomic.value = '';
        	    new_customer_phone.value = '';
        	}
        	       
    	} else if(this.classList.contains('old_customer')) {		
    		signUpBlock.style.display = "block";		
    		fioAndPhoneBlock.style.display = "none";
    	}
	}
}

buttonsCustomerFio();

let toShowBlocks = function() {
	let buttons = document.querySelectorAll('.button-show');
	
	for(let el of buttons) {
		el.addEventListener('click', showBlocks);
	}
}

let showBlocks = function() {
	let blockShow;
	
	if(this.classList.contains('comment')) {
		blockShow = document.querySelector('.showing-blocks .block-show.comment');
	} else if(this.classList.contains('question')) {
		blockShow = document.querySelector('.showing-blocks .block-show.question');
	} else if(this.classList.contains('wishes')) {
		blockShow = document.querySelector('.showing-blocks .block-show.wishes');
	}
	
	if(this.classList.contains('open')) {
		this.style.color = "#333";
		let svg = this.querySelector('svg');
		svg.style.transform = "rotate(0deg)";
		
		if(!this.classList.contains('question')) {
			svg.style.paddingLeft = "5px";
			svg.style.paddingRight = "0";
		}
		
		this.classList.remove('open');
		
		blockShow.style.height = "0";
		blockShow.style.transform = "scale(1, 0)";
	} else {
		let buttons = document.querySelectorAll('.button-show');
	
		for(let el of buttons) {
			el.style.color = "#333";
			el.classList.remove('open');
		}
		
		let blocks = document.querySelectorAll('.showing-blocks .block-show');
		
		for(let el of blocks) {
			el.style.height = "0";
			el.style.transform = "scale(1, 0)";
		}
		
		this.style.color = "#f4a137";
		
		let svg = this.querySelector('svg');
		svg.style.transform = "rotate(180deg)";
		
		if(!this.classList.contains('question')) {
			svg.style.paddingLeft = "0";
			svg.style.paddingRight = "5px";
		}
		
		this.classList.add('open');
		
		blockShow.style.height = "auto";
		blockShow.style.transform = "scale(1, 1)";
	}
}

toShowBlocks();

let optionWhoRecipient = function() {
	let optionFio = document.querySelector('#recipientSurname');
	let optionName = document.querySelector('#recipientName');
	let optionPat = document.querySelector('#recipientPatronymic');
	let optionTel = document.querySelector('#recipientTel');
	let optionEmail = document.querySelector('#recipientEmail');
	
	if(this.id == 'self_recipient_9055_40') {
		optionFio.setAttribute('disabled', '');	
		optionName.setAttribute('disabled', '');
		optionPat.setAttribute('disabled', '');	
		optionTel.setAttribute('disabled', '');
		optionEmail.setAttribute('disabled', '');
		
		optionFio.value = document.querySelector('#new_customer_surname').value;
		optionName.value = document.querySelector('#new_customer_name').value;
		optionPat.value = document.querySelector('#new_customer_patronomic').value;
		optionTel.value = document.querySelector('#new_customer_phone').value;
		optionEmail.value = document.querySelector('#new_customer_email').value;
	} else {
		optionFio.removeAttribute('disabled');
		optionName.removeAttribute('disabled');
		optionPat.removeAttribute('disabled');
		optionTel.removeAttribute('disabled');
		optionEmail.removeAttribute('disabled');
		
		optionFio.value = "";
		optionName.value = "";
		optionPat.value = "";
		optionTel.value = "";	
		optionEmail.value = "";		
	}
}

let changeOptionWhoRecipient = function() {
	let optionI = document.querySelector('#self_recipient_9055_40');	
	optionI.addEventListener('change', optionWhoRecipient);
	
	let optionOther = document.querySelector('#another_recipient_9055_41');	
	optionOther.addEventListener('change', optionWhoRecipient);
}

changeOptionWhoRecipient();

let inputingSurname = function() {
	let whoRecipient = document.querySelector('#self_recipient_9055_40:checked');
	
	if(whoRecipient != null) {
		let input = document.querySelector('#recipientSurname');
		input.value = this.value;		
	}
	
	if(this.parentNode.classList.contains('validation_type_error')) {
		this.parentNode.classList.remove('validation_type_error');
		let formError = this.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '';
		}
	}
}

let inputingName = function() {
	let whoRecipient = document.querySelector('#self_recipient_9055_40:checked');
	
	if(whoRecipient != null) {
		let input = document.querySelector('#recipientName');
		input.value = this.value;		
	}
	
	if(this.parentNode.classList.contains('validation_type_error')) {
		this.parentNode.classList.remove('validation_type_error');
		let formError = this.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '';
		}
	}
}

let inputingPatronomic = function() {
	let whoRecipient = document.querySelector('#self_recipient_9055_40:checked');
	
	if(whoRecipient != null) {
		let input = document.querySelector('#recipientPatronymic');
		input.value = this.value;		
	}
	
	if(this.parentNode.classList.contains('validation_type_error')) {
		this.parentNode.classList.remove('validation_type_error');
		let formError = this.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '';
		}
	}
}

let inputingPhone = function() {
	let whoRecipient = document.querySelector('#self_recipient_9055_40:checked');
	
	if(whoRecipient != null) {
		let input = document.querySelector('#recipientTel');
		input.value = this.value;		
	}
	
	if(this.parentNode.classList.contains('validation_type_error')) {
		this.parentNode.classList.remove('validation_type_error');
		let formError = this.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '';
		}
	}
}

let inputingEmail = function() {
	let whoRecipient = document.querySelector('#self_recipient_9055_40:checked');
	
	if(whoRecipient != null) {
		let input = document.querySelector('#recipientEmail');
		input.value = this.value;		
	}
	
	if(this.parentNode.classList.contains('validation_type_error')) {
		this.parentNode.classList.remove('validation_type_error');
		let formError = this.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '';
		}
	}
}

let inputingDeleteError = function() {	
	if(this.parentNode.classList.contains('validation_type_error')) {
		this.parentNode.classList.remove('validation_type_error');
		let formError = this.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '';
		}
	}	
}

let toInputDataCustomer = function() {
	let inputSurname = document.querySelector('#new_customer_surname');
	let inputName = document.querySelector('#new_customer_name');
	let inputPatronomic = document.querySelector('#new_customer_patronomic');
	let inputPhone = document.querySelector('#new_customer_phone');
	let inputEmail = document.querySelector('#new_customer_email');
	
	inputSurname.addEventListener('input', inputingSurname);
	inputName.addEventListener('input', inputingName);
	inputPatronomic.addEventListener('input', inputingPatronomic);
	inputPhone.addEventListener('input', inputingPhone);
	inputEmail.addEventListener('input', inputingEmail);
	
	let documentNumb = document.querySelector('#numberOfDocument');
	let documentSeria = document.querySelector('#seriaOfDocument');
	let documentDate = document.querySelector('#dateOfDocument');
	
	documentNumb.addEventListener('input', inputingDeleteError);
	documentSeria.addEventListener('input', inputingDeleteError);
	documentDate.addEventListener('input', inputingDeleteError);
}

toInputDataCustomer();

let inputingDateOfDocument = function() {
	let input = this.value;
	let arr = input.match(/[^-0-9]/g);
	
	if(arr != null && arr != undefined) {
		for(let i = 0; i < arr.length; i++) {		
			let pos = input.indexOf(arr[i]);
			
			if(pos > 0) {
				input = input.substring(0, pos) + input.substring(pos+1);
			} else if(pos == 0) {
				input = input.substring(1);
			}
		}
	}
	this.value = input;
		
	if(this.parentNode.classList.contains('validation_type_error')) {
		this.parentNode.classList.remove('validation_type_error');
		let formError = this.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '';
		}
	}
}

let inputToDateOfDocument = function() {
	let input = document.querySelector('#dateOfDocument');
	input.addEventListener('input', inputingDateOfDocument);
}

inputToDateOfDocument();


let inputingRecipient = function() {
	if(this.parentNode.classList.contains('validation_type_error')) {
		this.parentNode.classList.remove('validation_type_error');
		let formError = this.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '';
		}
	}
}

let toInputDataRecipient = function() {
	let inputSurname = document.querySelector('#recipientSurname');
	let inputName = document.querySelector('#recipientName');
	let inputPatronomic = document.querySelector('#recipientPatronymic');
	let inputPhone = document.querySelector('#recipientTel');
	let inputEmail = document.querySelector('#recipientEmail');
	
	inputSurname.addEventListener('input', inputingRecipient);
	inputName.addEventListener('input', inputingRecipient);
	inputPatronomic.addEventListener('input', inputingRecipient);
	inputPhone.addEventListener('input', inputingRecipient);
	inputEmail.addEventListener('input', inputingRecipient);
}

toInputDataRecipient();
let isFirstClickToEND = true;

let finalizingOrder = function() {
	let isOKtoFinal = true;
	let errorMessage = '';
	
	let whoRecipient = document.querySelector('#self_recipient_9055_40:checked');
	
	let optionFio = document.querySelector('#recipientSurname');
	let optionName = document.querySelector('#recipientName');
	let optionPat = document.querySelector('#recipientPatronymic');
	let optionTel = document.querySelector('#recipientTel');
	let optionEmail = document.querySelector('#recipientEmail');
	
	if(optionFio.value == '') {
		isOKtoFinal = false;
				
		let inputNewCustomer;
		
		if(whoRecipient != null) {
			errorMessage += '<p>Ваша фамилия;</p>';
			inputNewCustomer = document.querySelector('#new_customer_surname');
		} else {
			errorMessage += '<p>Фамилия получателя;</p>';
			inputNewCustomer = optionFio;
		}
		
		inputNewCustomer.parentNode.classList.add('validation_type_error');
		let formError = inputNewCustomer.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '<p class="validation-message"> Введите фамилию </p>';
		} else {
			formError = document.createElement('form-error');
			formError.className = 'validation-message';
			formError.innerHTML = '<p class="validation-message"> Введите фамилию </p>';
			inputNewCustomer.parentNode.append(formError);
		}
	}
	
	if(optionName.value == '') {
		isOKtoFinal = false;
		
		let inputNewCustomer;
		
		if(whoRecipient != null) {
			errorMessage += '<p>Ваше имя;</p>';
			inputNewCustomer = document.querySelector('#new_customer_name');
		} else {
			errorMessage += '<p>Имя получателя;</p>';
			inputNewCustomer = optionName;
		}
		
		inputNewCustomer.parentNode.classList.add('validation_type_error');
		let formError = inputNewCustomer.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '<p class="validation-message"> Введите имя </p>';
		} else {
			formError = document.createElement('form-error');
			formError.className = 'validation-message';
			formError.innerHTML = '<p class="validation-message"> Введите имя </p>';
			inputNewCustomer.parentNode.append(formError);
		}
	}
	
	if(optionPat.value == '') {
		isOKtoFinal = false;
		
		let inputNewCustomer;
		
		if(whoRecipient != null) {
			errorMessage += '<p>Ваше отчество;</p>';
			inputNewCustomer = document.querySelector('#new_customer_patronomic');
		} else {
			errorMessage += '<p>Отчество получателя;</p>';
			inputNewCustomer = optionPat;
		}
		
		inputNewCustomer.parentNode.classList.add('validation_type_error');
		let formError = inputNewCustomer.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '<p class="validation-message"> Введите отчество </p>';
		} else {
			formError = document.createElement('form-error');
			formError.className = 'validation-message';
			formError.innerHTML = '<p class="validation-message"> Введите отчество </p>';
			inputNewCustomer.parentNode.append(formError);
		}
	}
	
	if(optionTel.value == '') {
		isOKtoFinal = false;
		
		let inputNewCustomer;
		
		if(whoRecipient != null) {
			errorMessage += '<p>Ваш номер телефона;</p>';
			inputNewCustomer = document.querySelector('#new_customer_phone');
		} else {
			errorMessage += '<p>Номер телефона получателя;</p>';
			inputNewCustomer = optionTel;
		}
		
		inputNewCustomer.parentNode.classList.add('validation_type_error');
		let formError = inputNewCustomer.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '<p class="validation-message"> Введите номер мобильного телефона </p>';
		} else {
			formError = document.createElement('form-error');
			formError.className = 'validation-message';
			formError.innerHTML = '<p class="validation-message"> Введите номер мобильного телефона </p>';
			inputNewCustomer.parentNode.append(formError);
		}
	}
	
	if(optionEmail.value == '') {
		isOKtoFinal = false;
		
		let inputNewCustomer;
		
		if(whoRecipient != null) {
			errorMessage += '<p>Ваша эл. почта;</p>';
			inputNewCustomer = document.querySelector('#new_customer_email');
		} else {
			errorMessage += '<p>Эл. почта получателя;</p>';
			inputNewCustomer = optionEmail;
		}
		
		inputNewCustomer.parentNode.classList.add('validation_type_error');
		let formError = inputNewCustomer.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '<p class="validation-message"> Введите эл. почту </p>';
		} else {
			formError = document.createElement('form-error');
			formError.className = 'validation-message';
			formError.innerHTML = '<p class="validation-message"> Введите эл. почту </p>';
			inputNewCustomer.parentNode.append(formError);
		}
	}
	
	let inputTypeDocument = document.querySelector('input[name="typeDocument"]:checked');
	
	if(inputTypeDocument == null) {
		isOKtoFinal = false;
		errorMessage += '<p>Тип документа получателя;</p>';		
	}
	
	let documentNumb = document.querySelector('#numberOfDocument');
	let documentSeria = document.querySelector('#seriaOfDocument');
	let documentDate = document.querySelector('#dateOfDocument');
	
	if(documentNumb.value == '') {
		isOKtoFinal = false;
		errorMessage += '<p>Номер документа получателя;</p>';
		
		documentNumb.parentNode.classList.add('validation_type_error');
		let formError = documentNumb.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '<p class="validation-message"> Введите номер документа </p>';
		} else {
			formError = document.createElement('form-error');
			formError.className = 'validation-message';
			formError.innerHTML = '<p class="validation-message"> Введите номер документа </p>';
			documentNumb.parentNode.append(formError);
		}
	}
	if(documentSeria.value == '') {
		isOKtoFinal = false;
		errorMessage += '<p>Серия документа получателя;</p>';
		
		documentSeria.parentNode.classList.add('validation_type_error');
		let formError = documentSeria.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '<p class="validation-message"> Введите серию документа </p>';
		} else {
			formError = document.createElement('form-error');
			formError.className = 'validation-message';
			formError.innerHTML = '<p class="validation-message"> Введите серию документа </p>';
			documentSeria.parentNode.append(formError);
		}
	}
	if(documentDate.value == '') {
		isOKtoFinal = false;
		errorMessage += '<p>Дата выдачи документа получателя;</p>';
		
		documentDate.parentNode.classList.add('validation_type_error');
		let formError = documentDate.parentNode.querySelector('form-error');
		if(formError != null) {
			formError.innerHTML = '<p class="validation-message"> Введите дату выдачи документа </p>';
		} else {
			formError = document.createElement('form-error');
			formError.className = 'validation-message';
			formError.innerHTML = '<p class="validation-message"> Введите дату выдачи документа </p>';
			documentDate.parentNode.append(formError);
		}
	}
	
	let inputSearchCity = document.querySelector('.js-city .autocomplete__input[name="search"]');
	
	let inputStreet = document.querySelector('.autocomplete__input[name="street"]');
	let inputHome = document.querySelector('.autocomplete__input[name="numberHome"]');
	let inputFlat = document.querySelector('.autocomplete__input[name="number_flat"]');
		
	let inpuTypeDelivery = document.querySelector('input[name="types_delivery"]:checked');
	if(inpuTypeDelivery == null) {
		isOKtoFinal = false;
		errorMessage += '<p>Тип доставки;</p>';
	} else {
		let deliveryesServices = document.querySelectorAll('.deliveryServices .custom-select__trigger');
		let isAllFullDeliveryesServices = true;
		
		for(el of deliveryesServices) {
			let span = el.querySelector('span');
			if(span.dataset.deliveryId == undefined || span.dataset.deliveryId == null || span.dataset.deliveryId == '') {
				isAllFullDeliveryesServices = false;
			}
		}
					
		if(inpuTypeDelivery.value == 'courier') {
		    
		    if(inputSearchCity.getAttribute('guid') == null) {
            	isOKtoFinal = false;
            	errorMessage += '<p>Город для доставки заказа;</p>';		
            }
			
			if(inputStreet.value == '') {
				isOKtoFinal = false;
				errorMessage += '<p>Улица для доставки заказа;</p>';				
			}
			
			if(inputHome.value == '') {
				isOKtoFinal = false;
				errorMessage += '<p>Номер дома для доставки заказа;</p>';				
			}
		}
		
		if(inpuTypeDelivery.value !== 'pickup-from-stock') {
    		if(!isAllFullDeliveryesServices) {
    			isOKtoFinal = false;
    			errorMessage += '<p>Службы доставки;</p>';
    		}
		}
		
		if(inpuTypeDelivery.value == 'pickup') {
		    
		    if(inputSearchCity.getAttribute('guid') == null) {
            	isOKtoFinal = false;
            	errorMessage += '<p>Город для доставки заказа;</p>';		
            }
            
			let deliveryesPVZ = document.querySelectorAll('.deliveryPVZ .custom-select__trigger');
			let isAllFullDeliveryesPVZ = true;
		
			for(el of deliveryesPVZ) {
				let span = el.querySelector('span');
				if(span.dataset.deliveryId == undefined || span.dataset.deliveryId == null || span.dataset.deliveryId == '') {
					isAllFullDeliveryesPVZ = false;
				}
			}
			
			if(!isAllFullDeliveryesPVZ) {
				isOKtoFinal = false;
				errorMessage += '<p>Пункты выдачи заказа;</p>';
			}
		}
	}
	
	if(!isOKtoFinal) {
		let modalErrorBodyDiv = document.querySelector('.modalBlock.error .modalBody div');
		let classs = modalErrorBodyDiv.parentNode.parentNode.parentNode.className;
		toggleNumb = classs.substring(classs.indexOf('toggleModal')).replace('toggleModal', '');
		
		modalErrorBodyDiv.innerHTML = errorMessage;
		
		toggleModalBlock(toggleNumb, 1);		
	} else {
	    if(!isFirstClickToEND) {
            return;
        } else {
            isFirstClickToEND = false;
        }
        
		let orderCreate = {
			"OrderId": 0,
			"SenderIndex": "",			
			"RecepientIndex": "",
			"RecepientAddressHidden": "",
			"ParcelType": 2,
			"RecepientCompany": "",
			"Description": "Описание",
		}
		
		if(inpuTypeDelivery.value == 'courier') {
			orderCreate['DeliveryType'] = 1;
		} else if(inpuTypeDelivery.value == 'pickup') {
			orderCreate['DeliveryType'] = 2;			
		}
		
		let recepientAddress = inputSearchCity.value + ' ' + inputStreet.value + ' д.' + inputHome.value;
		if(inputFlat.value != '') {
			recepientAddress += ' кв. ' + inputFlat.value;
		}
		let recepientRegion = inputSearchCity.dataset.regionName;
		let recepientCity = inputSearchCity.value;
		let recepientStreet = inputStreet.value;
		let recepientHome = inputHome.value;
		let recepientOffice = inputFlat.value;
		
		let commentDiv = document.querySelector('.block-show.comment textarea');		
		let recepientComment = commentDiv.value;
	
		let recepientFullName = optionFio.value + ' ' + optionName.value + ' ' + optionPat.value;
		let recepientPhone = optionTel.value;
		let recipientCityGuid = inputSearchCity.getAttribute('guid');
		
		let recepientAdvanceAddress = {
			"CityGuid": recipientCityGuid,
			"Street": recepientStreet,
			"Home": recepientHome,
			"Building": "",
			"Structure": "",
			"Flat": recepientOffice
		}
		
		let documentType = document.querySelector('input[name="typeDocument"]').value;
		if(documentType == 'pasport') {
			documentType = 0;
		} else if(documentType == 'zagran') {
			documentType = 1;
		} else if(documentType == 'voditelskoe') {
			documentType = 2;
		}
		
		orderCreate['RecepientAddress'] = recepientAddress;
		orderCreate['RecepientRegion'] = recepientRegion;
		orderCreate['RecepientCity'] = recepientCity;
		orderCreate['RecepientStreet'] = recepientStreet;
		orderCreate['RecepientHome'] = recepientHome;
		orderCreate['RecepientOffice'] = recepientOffice;
		
		orderCreate['RecepientComment'] = recepientComment;
		orderCreate['RecepientFullName'] = recepientFullName;
		orderCreate['RecepientPhone'] = recepientPhone;
		
		orderCreate['RecepientAdvanceAddress'] = recepientAdvanceAddress;
		
		orderCreate['DelLin'] = {
			"RecepientType": 1,
			"RecepientPhisical": {
				"DocumentType": documentType,
				"DocumentNumber": documentNumb.value,
				"DocumentSeries": documentSeria.value,
				"DocumentDate": documentDate.value
			}
		}
		
		let email = '';
		let recEmail = document.querySelector('#new_customer_email').value;
		let isSubscribed = 0;
		if(document.querySelector('#subscribing:checked') != null) {
		   // email = document.querySelector('#eMailRecipient').value;
		   isSubscribed = 1;
		}
		
		let productHeaders = document.querySelectorAll('.checkout-product__header');
		let productUls = document.querySelectorAll('.checkout-product__header + ul');
		
		let deliveryBlocks = document.querySelectorAll('.container_delivery');
		
		let order_pnames = [];
		let order_pcodes = [];
		let order_pninfos = [];
		let order_pnumbers = [];
		let order_prices = [];
		let mplace_price = 0;
		let order_mplase_merchant = [];
		let bill_fname = optionName.value;
		let bill_lname = optionFio.value;
		let bill_countrycode = "RU";
		let bill_city = recepientCity;
		let bill_phone = recepientPhone;
		let bill_email = email;
		let pay_method = "CCVISAMC";
		
		let isFinish = false;
		let payUresult;
		
		for(let i = 0; i < productHeaders.length; i++) {
		    let isDeliveryFromPoint = productHeaders[i].dataset.stockIsDeliveryFromPoint;
			let stockPickUpType;
			if(isDeliveryFromPoint == '1') {
			    stockPickUpType = 2;
			} else {
			    stockPickUpType = 1;
			}
			
			let container = deliveryBlocks[i];
			let headerDeliveryServices = container.querySelector('.container.deliveryServices .custom-select__trigger span');
			
			let strDeliveryServices = productHeaders[i].dataset.deliveryServices;
			if(strDeliveryServices.length > 0) {
    			let arrDeliveryServices = strDeliveryServices.split(']]]');
    			let deliveryServices = {};
    			
    			for(let el of arrDeliveryServices) {
    			    if(el == '') {
    			        break;
    			    }
    			    
    			    el = el.split('=');
    			    deliveryServices[el[0]] = el[1];
    			}
    			
    			console.log(deliveryServices);
    			console.log(deliveryServices[headerDeliveryServices.dataset.deliveryId]);
    			
    		    orderCreate['PickupPointId'] = deliveryServices[headerDeliveryServices.dataset.deliveryId];
			}
			
		    orderCreate['PickupType'] = stockPickUpType;
			orderCreate['ClientOrderNumber'] = String(newOrderIdFromBD + i);
			let products = productUls[i].querySelectorAll('.checkout-product');
			
			let productsIds = [];
			let items = [];
			
			for(let el of products) {
			    let title = el.querySelector('.checkout-product__title-product');
			    /*for(let elem of title.querySelectorAll('img')) {
                    let text = document.createElement('span');
                    text.innerHTML = elem.getAttribute('src');
                    elem.parentNode.replaceChild(text, elem);
                }*/
				let name = title.innerHTML.replace(/"./g, "").replace(/</g, "").replace(/>/g, "");
				let obj = {
					"Name": name,
					"AssessedCost": Number(el.dataset.productBaseCost),
					"Quantity": Number(el.dataset.productNumber),
					"WeightGm": Number(el.dataset.productWeight)
				}
				items.push(obj);
				let atributes = title.dataset.atributesId;
				if(atributes != undefined && atributes != '') {
				    productsIds.push(el.dataset.productId + '|' + name + '|' + el.dataset.productBaseCost + '|' + el.dataset.productSellerCost + '|' + el.dataset.productNumber + '|' + atributes);
				} else {
				    productsIds.push(el.dataset.productId + '|' + name + '|' + el.dataset.productBaseCost + '|' + el.dataset.productSellerCost + '|' + el.dataset.productNumber);
				}
				
				mplace_price += Number(el.dataset.productNumber) * (Number(el.dataset.productBaseCost) - Number(el.dataset.productSellerCost));
				
				let code = Number(el.dataset.productId);
				if(code < 1000) {
				    code = "000" + code;
				    if(code.length > 4) {
				        while(true) {
                            if(code.length > 4) {
                                code = code.substring(1);
                            } else {
                                break;
                            }
                        }
				    }
				}
				
				order_pcodes.push(code);
				order_pnames.push(name);
				order_pnumbers.push(el.dataset.productNumber);
				order_prices.push(el.dataset.productSellerCost);
				order_mplase_merchant.push(productHeaders[i].dataset.payUcode);
			}
			
			if(inpuTypeDelivery.value !== 'pickup-from-stock') {
			    mplace_price += Number(headerDeliveryServices.dataset.deliveryCostWithUp);
			}
			let parts = {
				"Id": 1,
				"LengthCm": productHeaders[i].dataset.length,
				"WidthCm": productHeaders[i].dataset.width,
				"HeightCm": productHeaders[i].dataset.height,
				"WeightGm": productHeaders[i].dataset.weight,
				"Items": items
			}
			
			orderCreate['Parts'] = [parts];
			
			let dispachDate = headerDeliveryServices.dataset.deliveryPickupDate;
			
			orderCreate['DispatchDate'] = dispachDate;
			orderCreate['AssessedCost'] = productHeaders[i].dataset.assesedCost;
			orderCreate['TariffId'] = headerDeliveryServices.dataset.deliveryTarifId;
			orderCreate['TariffProviderId'] = headerDeliveryServices.dataset.deliveryId;
			orderCreate['TariffCost'] = headerDeliveryServices.dataset.deliveryCost;
			orderCreate['CourierCallCost'] = headerDeliveryServices.dataset.courierCost;
			
			let deliveryPointId = '';
			if(inpuTypeDelivery.value == 'pickup') {
				deliveryPointId = container.querySelector('.container.deliveryPVZ .custom-select__trigger span').dataset.pvzId;
				orderCreate['DeliveryPointId'] = deliveryPointId;				
			}
			
			let senderCity = productHeaders[i].dataset.cityName;
			let senderStreet = productHeaders[i].dataset.stockStreet;
			let senderHome = productHeaders[i].dataset.stockHome;
			let senderOffice = productHeaders[i].dataset.stockFlat;
			
			let senderAddress = senderCity + ' ' + senderStreet + ' д.' + senderHome;
			if(senderOffice != '') {
				senderAddress += ' кв. ' + senderOffice;
			}
			
			orderCreate['SenderAddress'] = senderAddress;
			orderCreate['SenderRegion'] = "";
			orderCreate['SenderCity'] = senderCity;
			orderCreate['SenderStreet'] = senderStreet;
			orderCreate['SenderHome'] = senderHome;
			orderCreate['SenderOffice'] = senderOffice;
			orderCreate['SenderComment'] = '';			
			orderCreate['SenderFullName'] = productHeaders[i].dataset.sellerFullname;
			
			orderCreate['SenderPhone'] = productHeaders[i].dataset.sellerPhone,
			orderCreate['SenderCompany'] = productHeaders[i].dataset.sellerCompany,
			orderCreate['SenderAdvanceAddress'] = {
				"CityGuid": productHeaders[i].dataset.cityGuid,
				"Street": senderStreet,
				"Home": senderHome,
				"Building": "",
				"Structure": "",
				"Flat": senderOffice
			}
			
			console.log(orderCreate);
			let wishes = document.querySelector('.block-show.wishes textarea').value;
			let question = document.querySelector('.block-show.question textarea').value;
			
            var xhr = new XMLHttpRequest();
    		xhr.open('POST', 'App/Controllers/saveNewDeliveryOrder.php');
    
    		xhr.addEventListener('readystatechange', function(e) {
    			
    			if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
    			    if(i == productHeaders.length-1) {
        			    window.scrollTo(0,0);
    
        			    let coverForLoadingBankingPage = document.querySelector('.coverForLoadingBankingPage');
        			    coverForLoadingBankingPage.style.display = "block";
        			    let forLoadingBankingPage = document.querySelector('.forLoadingBankingPage');
        			    forLoadingBankingPage.style.display = "block";
        			    document.body.style.overflow = "hidden";
        			    
        			    if(payUresult != undefined) {
        			        toPay(payUresult);
        			    } else {
        			        isFinish = true;
        			    }
    			    }
    			    
    				console.log(e.target.response);
    			}
    			else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
    				console.log('Не удалось сохранить новый заказ.');
    			}
    		});
    		
            var fd = new FormData;
    		fd.append("orderJSON", JSON.stringify(orderCreate));
    		
    		fd.append("deliveryType", orderCreate['DeliveryType']);
    		fd.append("tariffId", orderCreate['TariffId']);
    		fd.append("tariffCost", orderCreate['TariffCost']);
    		fd.append("tariffCostWithUp", headerDeliveryServices.dataset.deliveryCostWithUp);
    		fd.append("courierCallCost", orderCreate['CourierCallCost']);
    		fd.append("deliveryPointId", deliveryPointId);
    		fd.append("products", productsIds.join(']'));
    		
    		fd.append("recepientFullName", recepientFullName);
    		fd.append("recepientPhone", recepientPhone);
    		fd.append("recepientCity", recepientCity);
    		fd.append("recepientStreet", recepientStreet);
    		fd.append("recepientHome", recepientHome);
    		fd.append("recepientOffice", recepientOffice);
    		fd.append("recipientCityGuid", recipientCityGuid);
    		
    		fd.append("recepientDocumentType", documentType);
    		fd.append("recepientDocumentNumber", documentNumb.value);
    		fd.append("recepientDocumentSeries", documentSeria.value);
    		fd.append("recepientDocumentDate", documentDate.value);
    		
    		fd.append("recepientComment", recepientComment);
    		fd.append("recepientWishes", wishes);
    		fd.append("recepientQuestion", question);
    		fd.append("recepientEmail", recEmail);
    		fd.append("isSubscribed", isSubscribed);
    		xhr.send(fd);
        }

		order_pcodes.push("0000");
		for(let el of order_pnames) {
		    order_pninfos.push(el);
		}
		//TODO Убрать это на сторону сервера
		order_pnames.push("saterno.ru commission");
		order_pninfos.push("commission");
		order_pnumbers.push(1);
		order_prices.push(mplace_price);
		order_mplase_merchant.push("hhtyhytj");
		
		let payObject = {
		    "clientOrderNumber": String(newOrderIdFromBD + productHeaders.length - 1),
		    "order_pnames": order_pnames,
    		"order_pcodes": order_pcodes,
    		"order_pninfos": order_pninfos,
    		"order_pnumbers": order_pnumbers,
    		"order_prices": order_prices,
    		"order_mplase_merchant": order_mplase_merchant,
    		"bill_fname": bill_fname,
    		"bill_lname": bill_lname,
    		"bill_countrycode": bill_countrycode,
    		"bill_city": bill_city,
    		"bill_phone": bill_phone,
    		"bill_email": bill_email,
    		"pay_method": pay_method
		}
		
		console.log(JSON.stringify(payObject));
        
        var xhr2 = new XMLHttpRequest();
		xhr2.open('POST', 'App/Controllers/createPayUOrder.php');

		xhr2.addEventListener('load', function(e) {
			
			if (xhr2.readyState == 4 && xhr2.status == 200 && e.target.response) {
			    if(isFinish) {
			        toPay(e.target.response);
			    } else {
			        payUresult = e.target.response;
			        console.log(payUresult);
			    }
			}
			else if (xhr2.readyState == 4 && (xhr2.status != 200 || e.target.response.length == 0)) {
				console.log('Не удалось сохранить новый заказ.');
			}
		});
		
        var fd2 = new FormData;
		fd2.append("orderJSON", JSON.stringify(payObject));
		xhr2.send(fd2);
	}
}

let toPay = function(data) {
    let arr = data.split(']]]');
    
    for(let i = 0; i < arr.length; i++) {
        arr[i] = arr[i].split('|,|');
    }
    
    let form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'https://secure.payu.ru/order/lu.php');
    form.setAttribute('accept-charset', 'utf-8');
    
    for(let i = 0; i < arr.length; i++) {
        if(arr[i] != "" && arr[i] != undefined) {
            let input = document.createElement('input');
            input.setAttribute('name', arr[i][0]);
            input.setAttribute('value', arr[i][1]);
            input.setAttribute('type', 'hidden');
            form.append(input);
        }
    }

    let submit = document.createElement('input');
    submit.setAttribute('type', 'submit');
    submit.setAttribute('value', 'Подтверждение заказа');
    submit.setAttribute('id', 'button-confirm');
    submit.style.display = "none";
    form.append(submit);
    document.body.append(form);
    
    document.querySelector('#button-confirm').click();
    
	console.log(arr);
}

let toFinalizingButton = function() {
	let buttonFinal = document.querySelector('.finalizing_button');
	buttonFinal.addEventListener('click', finalizingOrder);
}

toFinalizingButton();

function full() {
    let inputf = document.querySelector('#new_customer_surname');
    inputf.value = "Комарова";
    let inputn = document.querySelector('#new_customer_name');
    inputn.value = "Митрофан";
    let inputp = document.querySelector('#new_customer_patronomic');
    inputp.value = "Максимович";
    let inputg = document.querySelector('input[name="search"]');
    inputg.setAttribute('guid', 'f3a2db25-007e-4830-b460-e763ced3a642');
    inputg.setAttribute('data-region-name', 'Новосибирская обл. ');
    inputg.value = 'Каргат';
    let inputs = document.querySelector('input[name="street"]');
    inputs.value = "ул. Максимовича";
    let inputh = document.querySelector('input[name="numberHome"]');
    inputh.value = "9";
    let inputk = document.querySelector('#self_recipient_9055_89');
    inputk.checked = true;
    let inputw = document.querySelector('#self_recipient_98979');
    inputw.checked = true;
    let inputd = document.querySelector('#numberOfDocument');
    inputd.value = "754365";
    let inputl = document.querySelector('#seriaOfDocument');
    inputl.value = "7543";
    let inputu = document.querySelector('#dateOfDocument');
    inputu.value = "2000-07-04";
}