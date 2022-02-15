let AllmodalB = document.querySelectorAll('.modalBlock');

for (let i = 0; i < AllmodalB.length; i++) {
	let modalB = AllmodalB[i];
	
	let error = modalB.querySelector('.error');
	
	let modalwindowB = modalB.querySelector('.modal__block');
	let classForToggleModal = 'toggleModal' + i;
	let togglesB = document.getElementsByClassName(classForToggleModal);

	for (let j = 0; j < togglesB.length; j++) {
	    function toggleEvent() {
			if(togglesB[j].classList.contains('level3')) {
				toggleModalBlock(i, 3);
			} else if(togglesB[j].classList.contains('level2')) {
				toggleModalBlock(i, 2);
			} else {
				toggleModalBlock(i, 1);
			}
	    }
	    
	    togglesB[j].addEventListener('click', toggleEvent);
	    togglesB[j].addEventListener('touchenter', toggleEvent);
	}

	modalwindowB.addEventListener('click', function() {
		event.stopPropagation();
	});
}

function toggleModalBlock(i, level) {
	let modalClass = 'toggleModal' + i;
	let modalB = document.querySelector('.modalBlock.' + modalClass);
	let modals = document.querySelectorAll('.modalBlock');
	let error = modalB.querySelector('.error');

	let stateB = modalB.getAttribute('data-state');
	if (stateB == 'open') {
		
		for(let elem of modals) {
			if(!elem.classList.contains(modalClass)) {
				elem.style.overflow = "auto";
			}
		}
		
		if(level == 1) {
			document.getElementById("cover").style.display = "none"; 
			document.body.style.overflow = "auto";
		} else if(level == 2) {
			document.getElementById("cover2").style.display = "none"; 
		} else if(level == 3) {
			document.getElementById("cover3").style.display = "none"; 
		}
		
	  modalB.setAttribute('data-state', 'closed');
	} else {
		modalB.style.overflow = "auto";
		
		document.body.style.overflow = "hidden";
		
		for(let elem of modals) {
			if(!elem.classList.contains(modalClass)) {
				elem.style.overflow = "hidden";
			}
		}

		if(level == 1) {
			document.getElementById("cover").style.display = "block"; 
		} else if(level == 2) {
			document.getElementById("cover2").style.display = "block"; 
		} else if(level == 3) {
			document.getElementById("cover3").style.display = "block"; 
		}
		
		modalB.setAttribute('data-state', 'open');
	}
}

function launchToggleModalBlock(i, level, event) {
    toggleModalBlock(i, level);
}

function launchToggle2ModalBlocks(i1, level1, i2, level2, event) {
    toggleModalBlock(i1, level1);
    toggleModalBlock(i2, level2);
}