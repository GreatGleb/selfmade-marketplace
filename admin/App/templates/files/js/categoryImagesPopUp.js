function editingDOMnotSelectToSelect(notSelect) {	
	let img = notSelect.querySelector('img');
	
	let td = document.querySelector('td.imageCategoryEdit[data-show-pop-up="true"]');
	let tdImg = td.querySelector('img');
	
	if(tdImg !== null) {
		tdImg.dataset.src = img.src;
		tdImg.src = img.src;
	} else {
		let newImg = document.createElement('img');
		newImg.src = img.src;
		td.prepend(newImg);
		newImg.style.width = "50px";
		newImg.style.height = "50px";
		newImg.dataset.src = img.src;;
	}
}

function editingDOMyesSelectToNotSelect() {
	document.querySelector('td.imageCategoryEdit[data-show-pop-up="true"] img').remove();
}
