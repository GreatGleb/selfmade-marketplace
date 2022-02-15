setEventForActionToUser();

let clickDeletingUser = 0;
let deletingUserId;
let deletingUserTd;

function setEventForActionToUser() {
	let table_usersAllAction = document.querySelectorAll('.table_users tbody .actionToUser');

	for(let blockUser of table_usersAllAction) {
		blockUser.addEventListener('click', settingEventForActionToUser, false);
	}
}

let buttonForDeleteUser = document.querySelector('.modalBlock.error.warning .modalBody > div.buttons .ok');

function settingEventForActionToUser() {
	let id = event.path[1].querySelector('td').innerText;
	
	if(event.path[0].className == 'actionToUser block-user') {
		blockingUserPOST(id, event.path[0]);
	} else if(event.path[0].className == 'actionToUser unblock-user') {
		unblockingUserPOST(id, event.path[0]);				
	} else if(event.path[0].className == 'actionToUser voice-to-delete-user') {
		voiceToDeleteUserPOST(id, event.path[0]);	
	} else if(event.path[0].className == 'actionToUser cancel-voice-to-delete-user') {
		dropVoiceToDeleteUserPOST(id, event.path[0]);
	} else if(event.path[0].className == 'actionToUser delete-user') {
		
		let fio = event.path[1].querySelector('.fio').innerText;
		let typeOfUser = event.path[1].querySelector('.typeOfUser').innerText;
		
		deletingUserId = id;
		deletingUserTd = event.path[0];
		
		let errorMessage = document.querySelector('.modalBlock.error.warning .modalBody > div:not([class])');
		errorMessage.innerHTML = "<p>Вы действительно хотите удалить пользователя " + fio +"?</p>";
		if(typeOfUser == 'Seller') {
			errorMessage.innerHTML += "<p>При удалении этого продавца также удаляться все магазины и товары, которые закреплены за этим продавцом.</p>";
		}
		
		buttonForDeleteUser.addEventListener('click', beforeDeleteUserPOST, false);
		
		toggleModalBlock(2, 1);
	}
	
}

function blockingUserPOST(id, currentTd) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/blockingUser.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
			currentTd.classList.remove('block-user');
			currentTd.classList.add('unblock-user');
			currentTd.innerText = 'Разблокировать';
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response)) {
			console.log('К сожалению, не удалось изменить email.');
		}
	});

	xhr.send('"' + id + '"');
}

function unblockingUserPOST(id, currentTd) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/unblockingUser.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			currentTd.classList.remove('unblock-user');
			currentTd.classList.add('block-user');
			currentTd.innerText = 'Заблокировать';
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response)) {
			console.log('К сожалению, не удалось изменить email.');
		}
	});

	xhr.send('"' + id + '"');
}

function voiceToDeleteUserPOST(id, currentTd) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/voiceToDeleteUser.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			currentTd.classList.remove('voice-to-delete-user');
			currentTd.classList.add('cancel-voice-to-delete-user');
			currentTd.innerText = 'Снять голос за удаление';
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response)) {
			console.log('К сожалению, не удалось изменить email.');
		}
	});

	xhr.send('"' + id + '"');
}

function dropVoiceToDeleteUserPOST(id, currentTd) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/dropVoiceToDeleteUser.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			currentTd.classList.remove('cancel-voice-to-delete-user');
			currentTd.classList.add('voice-to-delete-user');
			currentTd.innerText = 'Голосовать за удаление';
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response)) {
			console.log('К сожалению, не удалось изменить email.');
		}
	});

	xhr.send('"' + id + '"');
}

function beforeDeleteUserPOST() {
	if(clickDeletingUser == 0) {
		clickDeletingUser = 1;
		deleteUserPOST();
	}
	buttonForDeleteUser.removeEventListener('click', beforeDeleteUserPOST);
}

function deleteUserPOST() {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/deleteUser.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			deletingUserTd.parentNode.remove();
			console.log(e.target.response);
			changeLeftMenuHeight();
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response)) {
			console.log('К сожалению, не удалось изменить email.');
		}
	});

	xhr.send('"' + deletingUserId + '"');
}