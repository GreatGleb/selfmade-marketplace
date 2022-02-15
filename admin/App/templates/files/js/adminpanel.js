document.querySelector('.admin-block-top .threeLines').addEventListener("click", function() {
	let leftMenu = document.querySelector('.admin-block-left');
	let html = document.querySelector('.mainHtmlContent');
	
	if(leftMenu.className == 'admin-block-left' || leftMenu.className == 'admin-block-left addRight') {
		leftMenu.className = 'admin-block-left hiddenLeft';
		html.className = 'mainHtmlContent htmlContenToLeft';
		
		toggleLeftMenuPOST('hidden');
	} else {
		leftMenu.className = "admin-block-left addRight";
		html.className = 'mainHtmlContent';
		
		toggleLeftMenuPOST('open');
	}
});

let menuLists = document.querySelectorAll('.admin-block-left .list');

for (let elem of menuLists) {
	elem.addEventListener('click', openDownMenuList, false);
}

function openDownMenuList(e) {
	
	if(e.path[0].className == 'list') {
		let list = e.path[0];
		if(list.querySelector('.arrowDown') != null) {
			toggleListDown(list);
		}
	} else {
		let list = e.path[1];
		if(list.querySelector('.arrowDown') != null) {
			toggleListDown(list);
		}
	}
}

function toggleListDown(list) {	
	let menuList = list.nextElementSibling;
	let menuListArrow = list.querySelector('.arrowDown');
	
	console.log(menuList);
	
	if(menuList.className == 'listDown closed') {
		menuList.className = 'listDown opened';
		menuListArrow.className = 'arrowDown toTop';
	} else {
		menuList.className = 'listDown closed';
		menuListArrow.className = 'arrowDown';
	}
}

function toggleLeftMenuPOST(toggle) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/toggleLeftMenu.php');
	xhr.setRequestHeader( "Content-Type", "application/json" );

	xhr.send('"' + toggle + '"');
}
