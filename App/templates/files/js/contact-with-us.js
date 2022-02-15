document.querySelector('form.form-horizontal button.btn').addEventListener("click", checkMessage, false);

function checkMessage(e) {
	e.preventDefault(); 
	let input1 = document.querySelectorAll('form.form-horizontal input')[0];
	let value1 = input1.value;
	let input2 = document.querySelectorAll('form.form-horizontal input')[1];
	let value2 = input2.value;
	let input3 = document.querySelector('form.form-horizontal textarea');
	let value3 = input3.value;
	
	if(value1.length < 1 || value2.length < 1 || value3.length < 1) {
		let formHead = document.querySelector('form.form-horizontal legend');
		
		if(document.getElementById('send_messsage_error') == null) {
			let errorMesage = document.createElement('span');
			errorMesage.id = 'send_messsage_error';
			errorMesage.innerText = "Проверьте, заполнили ли Вы все поля.";
			
			formHead.after(errorMesage);
		}
		
		input1.style.borderBottom = "0px solid red";
		input2.style.borderBottom = "0px solid red";
		input3.style.borderBottom = "0px solid red";
		
		if(value1.length < 1) {
			input1.style.borderBottom = "1px solid red";
		}
		
		if(value2.length < 1) {
			input2.style.borderBottom = "1px solid red";
		}
		
		if(value3.length < 1) {
			input3.style.borderBottom = "1px solid red";
		}
	} else {
		if(document.querySelector('form.form-horizontal #send_messsage_error') !== null) {
			document.querySelector('form.form-horizontal #send_messsage_error').remove();
			input1.style.borderBottom = "0px solid red";
			input2.style.borderBottom = "0px solid red";
			input3.style.borderBottom = "0px solid red";
		}
		
		sendMessage(value1, value2, value3);		
	}
}

function sendMessage(login, email, message) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/sendMessage.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			formToReady('Ваше сообщение было успешно отправленно администрации магазина!');
			console.log(e.target.response)
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response)) {
			formToReady('К сожалению, не удалось отправить Ваше сообщение.');
		}
	});

	xhr.send('["' + login + '", "' + email + '", "' + message + '"]');
}

function formToReady(readyText) {
	let input1 = document.querySelectorAll('form.form-horizontal input')[0];
	let value1 = input1.value;
	let input2 = document.querySelectorAll('form.form-horizontal input')[1];
	let value2 = input2.value;
	let input3 = document.querySelector('form.form-horizontal textarea');
	let value3 = input3.value;
	
	let forma = document.querySelector('form.form-horizontal');
	let formHTML = forma.innerHTML;
	forma.innerHTML = '<p style="color: #000;">' + readyText + '</p>';
	
	let paragraf = document.createElement('p');
	paragraf.innerHTML = '<a id="send_messsage_yet">Написать ещё!</a>';
	forma.append(paragraf);
	
	document.querySelector('#send_messsage_yet').addEventListener("click", function() {
		forma.innerHTML = formHTML;
		
		document.querySelectorAll('form.form-horizontal input')[0].value = value1;
		document.querySelectorAll('form.form-horizontal input')[1].value = value2;
		
		document.querySelector('form.form-horizontal button.btn').addEventListener("click", checkMessage, false);
	}, false);
}