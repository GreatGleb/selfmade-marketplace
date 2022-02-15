document.querySelector('.save-new-table').addEventListener('click', function() {
	let fio = document.querySelector('.modalBody #add_new_user_fio').value;
	let login = document.querySelector('.modalBody #add_new_user_login').value;
	let email = document.querySelector('.modalBody #add_new_user_email').value;
	let new_password = document.querySelector('.modalBody #add_new_user_password').value;
	let typeOfUser = document.querySelector('.modalBody #add_new_user_typeOfUser').value;
	
	if(fio.length > 5 && login.length > 2 && email.length > 2 && new_password.length > 4) {
		addNewUserPOST(fio, login, email, new_password, typeOfUser);
	} else {
		let modalError = document.querySelector('.modalBlock.error');
		modalError.setAttribute('data-state', 'open');
		modalError.querySelector('.modalBody').innerHTML = '<p style="text-align: center;">Проверьте правильность введенных полей.<br>Пароль должен состоять не меньше чем из 5-ти символов!</p>';
	}
}, false);

function addNewUserPOST(fio, login, email, new_password, typeOfUser) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/addNewUser.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			document.querySelector('.modalBlock').setAttribute('data-state', 'closed');
			document.getElementById("cover").style.display = "none";
			
			let newTrforNewUser = document.createElement('tr');
			newTrforNewUser.innerHTML = e.target.response;
			
			document.querySelector('table tbody').append(newTrforNewUser);
			
			let newUserSelect = newTrforNewUser.querySelector('select');
			
			newUserSelect.addEventListener('change', function() {
				let id = newTrforNewUser.querySelector('td').innerText;
				changeTypeOfUserPOST(id, newUserSelect.value);
			}, false);
			
			let newUserAction = newTrforNewUser.querySelectorAll('.actionToUser');
			
			newUserAction[0].addEventListener('click', settingEventForActionToUser, false);
			newUserAction[1].addEventListener('click', settingEventForActionToUser, false);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response)) {
			let modalError = document.querySelector('.modalBlock.error');
			modalError.setAttribute('data-state', 'open');
			modalError.querySelector('.modalBody').innerHTML = '<p style="text-align: center;">К сожалению, не удалось добавить нового пользователя.</p>';
		}
	});

	xhr.send('["' + fio + '", "' + login + '", "' + email + '", "' + new_password + '", "' + typeOfUser + '"]');
}

changeLeftMenuHeight();