let table_usersAllSelects = document.querySelectorAll('.table_users tbody select');

for(let selectTypeOfUser of table_usersAllSelects) {
	selectTypeOfUser.addEventListener('change', function() {
		let id = event.path[2].querySelector('td').innerText;
		changeTypeOfUserPOST(id, this.value);
		
	}, false);
}


function changeTypeOfUserPOST(id, newType) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/changeTypeOfUser.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.addEventListener('readystatechange', function(e) {
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
			console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response)) {
			console.log('К сожалению, не удалось изменить email.');
		}
	});

	xhr.send('["' + id + '", "' + newType + '"]');
}