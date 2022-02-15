let buttonCloseEditingGood = document.querySelector('.editing_good .header .close');
buttonCloseEditingGood.addEventListener('click', closeEditingGood, false);

function closeEditingGood() {
	let table = mainContent.querySelector('.table_goods');
	table.classList.remove('none');
	
	let editing = mainContent.querySelector('.editing_good');
	
	editing.classList.add('none');
	
	let paginations = document.querySelectorAll('.pagination');
	for(let pag of paginations) {
	    pag.classList.remove('none');
	}
	
	changeLeftMenuHeight();
}