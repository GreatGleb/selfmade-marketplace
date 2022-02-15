let divEmail = document.querySelector('.mainHtmlContent .accountForm .email');
let emailLink = divEmail.querySelector('a');
let emailSvg = divEmail.querySelector('a svg');

let toggleForChangingEmail = 1;

emailLink.addEventListener("click", changingEmail, false);

toShortTitlesEmail();

function toShortTitlesEmail() {
	let accountFormEmail = document.querySelector('.accountForm .email span');
	if(accountFormEmail.innerText.length > 23) accountFormEmail.innerText = accountFormEmail.innerText.substring(0,23)+"…";
	
	let leftMenuEmail = document.querySelector('.admin-block-left .profile .names .email');
	if(leftMenuEmail.innerText.length > 14) leftMenuEmail.innerText = leftMenuEmail.innerText.substring(0,14)+"…";
}

function changingEmail() {
	if (toggleForChangingEmail%2) {
		
		let span = divEmail.querySelector('span');
		if(toggleForChangingEmail == 1) {
			let input = document.createElement('input');
			input.value = emailText;
			
			divEmail.append(input);
		} else {
			let input = divEmail.querySelector('input');
			input.classList.remove('none');
		}
		
		span.classList.add('none');
		
		toggleForChangingEmail++;
		
		changeSvgEmailToSave();
	} else {
		toggleForChangingEmail++;
		
		let input = divEmail.querySelector('input');
		changingEmailPOST(input.value);		
	}
}

function changeSvgEmailToSave() {	
	emailSvg.innerHTML = '<g transform="matrix(1,0,0,-1,129.08475,1270.2373)"><path d="m 384,0 h 768 V 384 H 384 V 0 z m 896,0 h 128 v 896 q 0,14 -10,38.5 -10,24.5 -20,34.5 l -281,281 q -10,10 -34,20 -24,10 -39,10 V 864 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 v 416 H 128 V 0 h 128 v 416 q 0,40 28,68 28,28 68,28 h 832 q 40,0 68,-28 28,-28 28,-68 V 0 z M 896,928 v 320 q 0,13 -9.5,22.5 -9.5,9.5 -22.5,9.5 H 672 q -13,0 -22.5,-9.5 Q 640,1261 640,1248 V 928 q 0,-13 9.5,-22.5 Q 659,896 672,896 h 192 q 13,0 22.5,9.5 9.5,9.5 9.5,22.5 z m 640,-32 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 96 q -40,0 -68,28 -28,28 -28,68 v 1344 q 0,40 28,68 28,28 68,28 h 928 q 40,0 88,-20 48,-20 76,-48 l 280,-280 q 28,-28 48,-76 20,-48 20,-88 z"/></g>';
	
	emailSvg.setAttribute('viewBox', '0 -256 1792 1792');
	emailSvg.style.width = '16px';
	emailSvg.style.height = '16px';
	emailSvg.style.right = '-19px';
}

function changeSvgEmailToEdit() {	
	emailSvg.innerHTML = '<g><path d="M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z"></path></g>';
	
	emailSvg.setAttribute('viewBox', '0 0 1000 1000');
	emailSvg.style.width = '14px';
	emailSvg.style.height = '14px';
	emailSvg.style.right = '-18px';

	let span = divEmail.querySelector('span');
	let input = divEmail.querySelector('input');
	span.innerText = input.value;
	input.classList.add('none');		
	span.classList.remove('none');
	toShortTitlesEmail();
}

function changinEmailOnDOM(email) {
	document.querySelector('.admin-block-left .profile .names .email').innerText = email;
}

function changingEmailPOST(email) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/changingEmail.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			changinEmailOnDOM(email);
			changeSvgEmailToEdit();	
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response)) {
			console.log('К сожалению, не удалось изменить email.');
			changeSvgEmailToEdit();
		}
	});

	xhr.send('"' + email + '"');
}