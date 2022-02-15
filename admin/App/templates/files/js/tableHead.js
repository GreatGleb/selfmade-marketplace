function tHeadToNormalView() {
	let trs = document.querySelectorAll('table tbody tr');
	let thead = document.querySelector('table thead tr');
	let maxTd = 0;
	
	for (let elem of trs) {
		let numberTd = elem.querySelectorAll('td').length;
		if(numberTd > maxTd) {
			maxTd = numberTd;
		}
	}
	
	let numberTh = thead.querySelectorAll('th').length;
	
	if(numberTh < maxTd) {
		let valueColspan = maxTd - numberTh + 1;
		thead.querySelector('th:last-of-type').setAttribute('colspan', valueColspan);
	}
	
	for (let elem of trs) {
		let numberTd = elem.querySelectorAll('td').length;
		
		if(numberTd < maxTd) {
			let valueColspan = maxTd - numberTd;
			
			let newEmptyTd = document.createElement('td');
			elem.append(newEmptyTd);
			
			let lastTd = elem.querySelector('td:last-of-type');
			lastTd.setAttribute('colspan', valueColspan);
		}
	}
}

tHeadToNormalView();