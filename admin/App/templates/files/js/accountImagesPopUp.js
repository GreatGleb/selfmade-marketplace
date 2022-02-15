function editingDOMnotSelectToSelect(notSelect) {	
	let img = notSelect.querySelector('img');
	let blockLeftImg = document.querySelector('.admin-block-left .profile img');
	blockLeftImg.src = img.src;
	let blockTopImg = document.querySelector('.admin-block-top .icon img');
	blockTopImg.src = img.src;
	
	let imgSrcCell = img.src.replace(/_150x150(?!.*_150x150)/,'');
	let blockMainImg = document.querySelector('.mainHtmlContent .accountForm .divAvatar img');
	blockMainImg.src = imgSrcCell;
}

function editingDOMyesSelectToNotSelect() {
	let blockLeftImg = document.querySelector('.admin-block-left .profile img');
	blockLeftImg.src = 'App/templates/files/img/accounts/user_150x150.png';
	
	let blockTopImg = document.querySelector('.admin-block-top .icon img');
	blockTopImg.src = 'App/templates/files/img/accounts/user_150x150.png';
	
	let blockMainImg = document.querySelector('.mainHtmlContent .accountForm .divAvatar img');
	blockMainImg.src = 'App/templates/files/img/accounts/user.png';
}

currentTableId = userIdForLoadingImages;
onlyOne = 1;

document.addEventListener('DOMContentLoaded', loadingImagesInPopUp(0, 'accounts/', editingDOMnotSelectToSelect, editingDOMyesSelectToNotSelect, 'ImagesForAdmin', 'userId', userIdForLoadingImages));

changeLeftMenuHeight();