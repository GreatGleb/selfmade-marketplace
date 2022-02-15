let currentTableId;
let onlyOne;

function loadingImagesInPopUp(modalNumber, img_path, editingDOMnotSelectToSelect, editingDOMyesSelectToNotSelect, table_for_insert_image, tableField_for_insert_image, valueTableField_for_insert_image) {
	console.log(img_path);
	// ************************ Drag and drop ***************** //
	let modalBlock = document.querySelector('.modalBlock.toggleModal' + modalNumber);
	let dropArea = modalBlock.querySelector("#drop-area");
	let titleError = modalBlock.querySelector(".modalBody .fileUploadError");
	let titleLoading = modalBlock.querySelector('.modalBody .fileLoading');
		
	let inputForUpload = document.querySelector('#fileToUpload' + modalNumber);
		
	inputForUpload.addEventListener('change', function() {
		let files = inputForUpload.files;
			handleDrop(files);		
	}, false);

	if (window.FormData == 'undefined') {
		titleError.style.display = "block";
		titleError.innerText = 'К сожалению, загрузка изображений не поддерживается браузером.';
		return false;
	}
	
	let maxFileSize = 5*1048576; // максимальный размер файла - 5 мб.
	
	let modalChilds = [];
		
	let isFirstPreviewToNormal = [];
	
	let heightOfImages = getImgHeight();
	
	let files, loadingFilesNow;
	let currentFile;
	let numberFiles = 0, numberUploads = 0;
	let arraySrc = [];

	findChildsWithoutOneChild(modalBlock, 'modalHeader');

	function findChildsWithoutOneChild(parent, child) {
		for (let elem of parent.childNodes) {
			if(elem != undefined && elem.tagName != undefined && elem.className != child) {
				modalChilds.push(elem);
				findChildsWithoutOneChild(elem, child);
			}
		}
	}

	let modalHeaderChilds = [];

	let modalHeader = modalBlock.querySelector('.modalHeader');
	modalHeaderChilds.push(modalHeader);

	findChilds(modalHeader);

	function findChilds(parent) {
		for (let elem of parent.childNodes) {
			if(elem != undefined && elem.tagName != undefined && elem.className != "modalHeader") {
				modalHeaderChilds.push(elem);
				findChilds(elem);
			}
		}
	}

	['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
	  modalBlock.addEventListener(eventName, preventDefaults, false);
	  
	  for (let elem of modalChilds) {
		  elem.addEventListener(eventName, preventDefaults, false);
	  }	  			  
	});
	
	blockOrLaunchDragStartForImages();
	
	function blockOrLaunchDragStartForImages() {
		let allImages = modalBlock.querySelectorAll('.windowAllImages .rowImages .imageCart');
		for (let elem of allImages) {
			elem.addEventListener('dragstart', preventDefaults, false);
			//elem.addEventListener('dragstart', dragCart, false);
		}
	}
		
	let canLight = 1;
	let canDrop = 1;
	let canCartDrag = 0;

	['dragenter', 'dragover'].forEach(eventName => {
	  modalBlock.addEventListener(eventName, highlight, false);
	  
	  for (let elem of modalChilds) {
		  elem.addEventListener(eventName, highlight, false);
	  }
	});

	modalBlock.addEventListener('dragleave', unhighlight, false);
	modalBlock.addEventListener('drop', handleDrop, false);

	for (let elem of modalChilds) {
	  elem.addEventListener('dragleave', unhighlight, false);
	}
	  
	for (let elem of modalHeaderChilds) {
	  elem.addEventListener('drop', handleDrop, false);
	}

	dropArea.addEventListener('drop', handleDrop, false);
	for (let elem of modalChilds) {
	  elem.addEventListener('drop', handleDrop, false);
	}
	
	function preventDefaults (e) {
	  e.preventDefault();
	  e.stopPropagation();
	}
	
	function stopAllEvents(e) {
	  e.stopImmediatePropagation();
	}

	function highlight(e) {
		if(canLight) {
			dropAreaToCenter();
			dropArea.classList.add('highlight');
		}
	}
		
	function dragCart(e) {
		if(e.type == 'dragstart') {
			canLight = 0;
			canDrop = 0;
			canCartDrag = 1;
			
			modalBlock.addEventListener('dragleave', turnOnDragNDrop, false);
			for (let elem of modalChilds) {
			  elem.addEventListener('drop', turnOnDragNDrop, false);
			}  
			modalBlock.addEventListener('drop', turnOnDragNDrop, false);
			for (let elem of modalChilds) {
			  elem.addEventListener('drop', turnOnDragNDrop, false);
			}  
		}
	}
		
	function turnOnDragNDrop(e) {
		if(canCartDrag) {
			if(e.type == 'dragleave') {
			  if(e.relatedTarget == null) {
					canLight = 1;
					canDrop = 1;
					canCartDrag = 0;
					console.log(e.type);
			  }	  
			} else {
				canLight = 1;
				canDrop = 1;
				canCartDrag = 0;
				console.log(e.type);
			}   
		}
	}

	function unhighlight(e) {
	  if(e.type == 'dragleave') {
		  if(e.relatedTarget == null) {
			  dropArea.classList.remove('highlight');
		  }	  
	  } else {
		  dropArea.classList.remove('highlight');
	  }    
	}

	function handleDrop(e) {
		if(canDrop) {
			numberUploads = 0;
			
			dropArea.classList.remove('highlight');

			if(titleError.style.display == 'block') {
			  titleError.style.display = 'none';
			}

			if(e.dataTransfer !== undefined) {
				files = e.dataTransfer.files;
			} else {
				files = e;
			}
			
			let row = modalBlock.querySelector('.windowAllImages .rowImages');
			let imagesInRow = row.getElementsByTagName('img');
			
			console.log(imagesInRow.length);
			console.log(onlyOne);
			//console.log(e);
			
			if(Number.isInteger(onlyOne) && imagesInRow.length < onlyOne) {
				console.log("GGG");
				
				let onlyAvailableFiles = [];
				let availableNumber = onlyOne - imagesInRow.length;
				for(let i = 0; i < availableNumber; i++) {
					onlyAvailableFiles.push(files[i]);
				}				
				if(files.length > availableNumber) {					
					let modalError = document.querySelector('.modalBlock.error.level3');
					let toggleNumber = 0;
					for(let toggleClassError of modalError.classList) {
						let tce = toggleClassError;
						if(tce.indexOf('toggleModal') >= 0) {
							tce = tce.replace('toggleModal', '');
							toggleNumber = tce;
						}
					}
					toggleModalBlock(toggleNumber, 3);
					
					if(onlyOne == 1) {
						modalError.querySelector('.modalBody').innerHTML = '<p style="text-align: center;">В этой колонке может одновременно храниться только одно изображение. Для загрузки нового изображения удалите все ранее загруженные изображения в этой колонке.</p>';
					} else {
						modalError.querySelector('.modalBody').innerHTML = '<p style="text-align: center;">Загрузятся не все изображения. В этой колонке может одновременно храниться только ' + onlyOne + ' изображений. Для загрузки нового изображения удалите некоторые ранее загруженные изображения в этой колонке.</p>';
					}
				}
				files = onlyAvailableFiles;
			} else if (Number.isInteger(onlyOne) && imagesInRow.length >= onlyOne) {
				console.log("GHG");
				files = [];
				let modalError = document.querySelector('.modalBlock.error.level3');
				let toggleNumber = 0;
				for(let toggleClassError of modalError.classList) {
					let tce = toggleClassError;
					if(tce.indexOf('toggleModal') >= 0) {
						tce = tce.replace('toggleModal', '');
						toggleNumber = tce;
					}
				}
				toggleModalBlock(toggleNumber, 3);
				modalError.querySelector('.modalBody').innerHTML = '<p style="text-align: center;">В этой колонке может одновременно храниться только ' + onlyOne + ' изображений. Для загрузки нового изображения удалите некоторые ранее загруженные изображения в этой колонке.</p>';
			}
			
			if(loadingFilesNow !== undefined) {
				for (let elem of files) {
					loadingFilesNow.push(elem);
				}
				
				console.log(loadingFilesNow);
				let numberFiles = loadingFilesNow.length;
				
				if(loadingFilesNow.length == files.length) {
					for(let i = 0; i < numberFiles; i++) {
						if(prepareFile(loadingFilesNow[0])) {
							addLoadingBar(loadingFilesNow[0]);
							previewFile(loadingFilesNow[0]);
							uploadFile(loadingFilesNow[0]);
							i = loadingFilesNow.length;
						}
					}
				}
			} else {
				currentFile = 0;
				loadingFilesNow = [];
				
				for (let elem of files) {
					loadingFilesNow.push(elem);
				}
				console.log(files);
				let numberFiles = loadingFilesNow.length;
				
				for(let i = 0; i < numberFiles; i++) {

					if(prepareFile(loadingFilesNow[0])) {
						addLoadingBar(loadingFilesNow[0]);
						previewFile(loadingFilesNow[0]);
						uploadFile(loadingFilesNow[0]);
						i = loadingFilesNow.length;
					}
				}
			}
			
			numberFiles = loadingFilesNow.length;
		}
	}
	
	function addLoadingBar(file) {
		let load = document.getElementById(''+file.name + file.lastModified + file.size);
		if(load !== null) {
			let containerProgress = document.createElement('div');
			containerProgress.className = 'containerForProgressAndName';
			
			let loadCont = document.createElement('div');
			loadCont.className = 'containerForProgress';
			
			let load = document.createElement('div');
			load.id = file.name + file.lastModified + file.size;
			load.className = 'progressLine';

			let title = document.createElement('span');
			title.className = 'titleFileName';
			title.innerText = file.name;
			
			loadCont.append(load);
			containerProgress.append(loadCont);
			containerProgress.append(title);
			windowAllImages.prepend(containerProgress);	
			
		}
	}
	
	function prepareFile(file) {

		if(file == undefined) {
			loadingFilesNow.shift();
			return false;
		}

		let extension = file.name.substr(file.name.lastIndexOf('.') + 1).toLowerCase();
		file.name = file.name.substr(0, file.name.lastIndexOf('.'))+extension;

		if(extension != "jpg" && extension != "png" && extension != "jpeg") {
		  loadingFilesNow.shift();
		  titleError.style.display = "block";
		  titleError.innerText = 'К сожалению, доступны только JPG, JPEG, PNG.';

		  setTimeout(deleteTitleError, 5000);
		  
		  return false;
		}
			  
		if (file.size > maxFileSize) {
		  loadingFilesNow.shift();
		  titleError.style.display = "block";
		  titleError.innerText = 'К сожалению, Ваш файл слишком большой.';
		  setTimeout(deleteTitleError, 5000);
		  
		  return false;
		}
		
		return true;
	}

	function previewFile(file) {
		if (window.FileReader == 'undefined') {
			titleError.style.display = "block";
			titleError.innerHTML = 'К сожалению, быстрая загрузка изображений не поддерживается браузером.<br>\
									Для просмотра загруженных изображений обновите страницу.';
			return false;
		}
		
		let reader = new FileReader();
		reader.readAsDataURL(file);
		reader.addEventListener('loadend', loadImg, false); 
				
		let divCart = document.createElement('div');
		divCart.className = 'imageCart none';
		
		let hoverForSelect = document.createElement('div');
		hoverForSelect.className = 'hoverForSelect notSelect';
		
		let shadow = document.createElement('div');
		shadow.className = 'shadow';
		let before1 = document.createElement('div');
		before1.className = 'before1';
		let before2 = document.createElement('div');
		before2.className = 'before2';
		let after1 = document.createElement('div');
		after1.className = 'after1';
		let after2 = document.createElement('div');
		after2.className = 'after2';
		
		let selectImages = document.createElement('div');
		selectImages.className = 'selectImages';
		selectImages.innerHTML = '<div class="item"><div class="galka"></div></div>';
		
		let img = document.createElement('img');
		img.className = "avatarImages";
		
		hoverForSelect.append(shadow);
		hoverForSelect.append(before1);
		hoverForSelect.append(before2);
		hoverForSelect.append(after1);
		hoverForSelect.append(after2);
		hoverForSelect.append(selectImages);
		hoverForSelect.append(img);
		divCart.append(hoverForSelect);
		
		let row = modalBlock.querySelector('.windowAllImages .rowImages');
		
		if(typeof(tableForManyPhotos) == "undefined") {
			row.prepend(divCart);
		} else {
			row.append(divCart);
		}
		
		function loadImg(e) {
			
			let windowAllImages = modalBlock.querySelector('.windowAllImages');
			
			let imgInCartNone = modalBlock.querySelector('.imageCart.none img');
			if(imgInCartNone != null) {
				imgInCartNone.src = e.target.result;
			}
				
			if(numberUploads == numberFiles) {
				console.log(numberFiles);
				console.log(numberUploads);
				console.log("Сразу добавили в див");
				
				let divCartNone = modalBlock.querySelector('.imageCart.none');
				let selectImagesNone = divCartNone.querySelector('.selectImages');
				if(divCartNone != null) {
					divCartNone.className = "imageCart";
					divCartNone.addEventListener('click', changeSelect, false);
					selectImagesNone.addEventListener('click', selectingImages, false);
				}
				
				if(loadingFilesNow[0] != undefined) {
					previewFile(loadingFilesNow[0]);
					uploadFile(loadingFilesNow[0]);
				}
	
				/*
				let modalImagesWidth = modalBlock.querySelector('.windowAllImages .rowImages').clientWidth;
	
				if(!isFirstPreviewToNormal.length) {
					let needWidth = imgToNormalWidth(img, modalImagesWidth - 17);
					isFirstPreviewToNormal.push(needWidth);
				} else {
					imgToNormalWidth(img, isFirstPreviewToNormal[0]);
				}*/
				//console.log('Loaded Preview');
			}
		}
	}
	
	function uploadFile(file) {
		var xhr = new XMLHttpRequest();
		xhr.upload.addEventListener('progress', {handleEvent: uploadProgress, file}, false);
		xhr.addEventListener('readystatechange', stateChange, false);
		xhr.open('POST', 'App/Controllers/upload.php');
		//console.log("Start Function");
				
		xhr.setRequestHeader('X-FILE-NAME', escape(file.name));
				
		var fd = new FormData;
		fd.append("file", file);
		fd.append("path", img_path);
		fd.append("table", table_for_insert_image);
		fd.append("tableField", tableField_for_insert_image);
		fd.append("valueTableField", valueTableField_for_insert_image);
		xhr.send(fd);
	}
	
	function uploadProgress(event) {
		let extension = this.file.name.substr(this.file.name.lastIndexOf('.') + 1).toLowerCase();
		let fileName = this.file.name.substr(0, this.file.name.lastIndexOf('.') - 1) + extension;
		
		let percent = parseInt(event.loaded / event.total * 100);
		//console.log(percent);
		
		let modal = modalBlock.querySelector('.modalBody .windowAllImages');
		
		let load = modal.querySelector('#' + extension + this.file.lastModified + this.file.size);
		if(load !== null) {
			if(event.loaded < load.dataset.value) {
				let containerProgress = document.createElement('div');
				containerProgress.className = 'containerForProgressAndName';
				
				let loadCont = document.createElement('div');
				loadCont.className = 'containerForProgress';
				
				load = document.createElement('div');
				load.id = extension + this.file.lastModified + this.file.size+2;
				load.className = 'progressLine';
				load.dataset.value = event.loaded;
				load.style.width = percent + 'px';
				
				if(percent < 98) {
					load.style.borderRadius = "4px 0 0 4px";
				} else if (percent > 97 && percent < 98) {
					load.style.borderRadius = "4px 2px 2px 4px";
				} else if (percent > 98) {
					load.style.borderRadius = "4px";
				}
				
				if(percent < 2 && percent >= 0) {
					load.style.height = '7px';
					load.style.top = '2px';
				} else {
					load.style.height = '12px';
					load.style.top = '-1px';
				}
				
				let title = document.createElement('span');
				title.className = 'titleFileName';
				title.innerText = this.file.name;
				
				loadCont.append(load);
				containerProgress.append(loadCont);
				containerProgress.append(title);
				modal.prepend(containerProgress);	
				//console.log('Noviy load 2');
			} else {
				//console.log('Modern ' + percent);
				load.dataset.value = event.loaded;
				load.style.width = percent + 'px';
				
				if(percent < 98) {
					load.style.borderRadius = "4px 0 0 4px";
				} else if (percent > 97 && percent < 98) {
					load.style.borderRadius = "4px 2px 2px 4px";
				} else if (percent > 98) {
					load.style.borderRadius = "4px";
				}
				
				if(percent < 2 && percent >= 0) {
					load.style.height = '7px';
					load.style.top = '2px';
				} else {
					load.style.height = '12px';
					load.style.top = '-1px';
				}
			}
		} else {
			let containerProgress = document.createElement('div');
			containerProgress.className = 'containerForProgressAndName';
			
			let loadCont = document.createElement('div');
			loadCont.className = 'containerForProgress';
			
			load = document.createElement('div');
			load.id = extension + this.file.lastModified + this.file.size;
			load.className = 'progressLine';
			load.dataset.value = event.loaded;			
			load.style.width = percent + 'px';
			
			if(percent < 98) {
				load.style.borderRadius = "4px 0 0 4px";
			} else if (percent > 97 && percent < 98) {
				load.style.borderRadius = "4px 2px 2px 4px";
			} else if (percent > 98) {
				load.style.borderRadius = "4px";
			}
			
			if(percent < 2 && percent >= 0) {
				load.style.height = '7px';
				load.style.top = '2px';
			} else {
				load.style.height = '12px';
				load.style.top = '-1px';
			}
			
			let title = document.createElement('span');
			title.className = 'titleFileName';
			title.innerText = this.file.name;
			
			loadCont.append(load);
			containerProgress.append(loadCont);
			containerProgress.append(title);
			modal.prepend(containerProgress);	
			//console.log('Noviy load 1');	
		}
	}
	
	function stateChange(event) {
		if (event.target.readyState == 4) {
			if(event.target.response) {
				console.log(event.target.response);
				
			}
			
			if (event.target.status != 200 || event.target.response == 'File is not an image.'
			|| event.target.response == 'Sorry, there was an error uploading your file.'
			|| event.target.response.indexOf('<br />') >= 0) {
				titleError.style.display = "block";
				if(event.target.response == 'File is not an image.') {
					titleError.innerText = 'Файл не является изображением.';
				} else if((event.target.response == 'Sorry, there was an error uploading your file.')
					|| event.target.response.indexOf('<br />') >= 0) {
					titleError.innerText = 'При загрузке произошла ошибка!';
				}
				
				let imageCart = modalBlock.querySelector('.imageCart');
				if(imageCart != null) {
					imageCart.className = "none";
				}
				
				setTimeout(deleteTitleError, 5000);
			} else {
				previewToNormal(event.target.response);
				if(typeof(tableForManyPhotos) != "undefined") {
					changingDOMafterUploadPhoto(event.target.response);
				}
			}
		
			let linesForProgress = modalBlock.querySelectorAll('.modalBody .containerForProgressAndName');
			
			for (let elem of linesForProgress) {
				elem.remove();
				dropAreaToCenter();
			}
			
			numberUploads++;
			currentFile++;
			loadingFilesNow.shift();
			
			console.log("upl "+numberUploads);
			
			timeFilesArray = [];
			
			for(let i = 0; i < loadingFilesNow.length; i++) {
				if(loadingFilesNow[i] != undefined) {
					timeFilesArray.push(loadingFilesNow[i]);
				}
			}
			
			loadingFilesNow = timeFilesArray;
			
			if(numberUploads == numberFiles) {
				let img = modalBlock.querySelector('.imageCart img');
				img.dataset.filename = event.target.response;
			
				if(loadingFilesNow[0] != undefined) {
					if(prepareFile(loadingFilesNow[0])) {
						addLoadingBar(loadingFilesNow[0]);
					}
				}
			} else {
				if(loadingFilesNow[0] != undefined) {
					if(prepareFile(loadingFilesNow[0])) {
						addLoadingBar(loadingFilesNow[0]);
						previewFile(loadingFilesNow[0]);
						uploadFile(loadingFilesNow[0]);
					}
				}
			}
		}
	}
	
	function deleteTitleError() {
		titleError.style.display = "none";
	}
	
	function previewToNormal(filename) {
		let divCartNone = modalBlock.querySelectorAll('.imageCart.none');

		for (let i = 0; i < divCartNone.length; i++) {
			divCartNone[i].className = 'imageCart';
			
			let img = divCartNone[i].querySelector('.hoverForSelect img');
			img.dataset.filename = filename;
			
			let selectImagesNone = divCartNone[i].querySelector('.selectImages');
			
			divCartNone[i].addEventListener('click', changeSelect, false);
			selectImagesNone.addEventListener('click', selectingImages, false);
		}
		
		blockOrLaunchDragStartForImages();
		
		let loading = modalBlock.querySelector('.rowImagesLoading');
		if(loading !== null) {
			loading.remove();
		}
	}
	
	function imgToNormalWidth(img, needWidth) {
		if(img.clientWidth > needWidth) {
			img.style.width = needWidth + 'px';
			img.style.height = getSizeImg(img.clientWidth, needWidth) + 'px';
			return needWidth;
		}
	}
		
	function getSizeImg(img_width, window_width) {
		
		/***
		
		let ratio = img.width / img.height;
		let new_height = heightOfImages;
		let new_width = new_height * ratio;
		
		return new_width;	
		*/
		
		let ratio = heightOfImages / img_width;
		let new_height = window_width * ratio;
		
		return new_height;				
	}
	
	function getImgHeight() {
		let divCart = document.createElement('div');
		divCart.id = 'fsedf34fe';
		divCart.className = 'imageCart none';
		
		let img = document.createElement('img');
		img.className = "avatarImages"
		divCart.append(img);
		document.body.append(divCart);
		
		let img_height = window.getComputedStyle(document.querySelector('#fsedf34fe.imageCart img.avatarImages'), null).getPropertyValue('height');
		
		return parseInt(img_height);				
	}
	
	modalBlock.addEventListener('scroll', function() {
		let heightScreen = document.documentElement.clientHeight;
		let heightModal = modalBlock.querySelector(' .modalBody').getBoundingClientRect().height;
		let fromTopToImages = modalBlock.querySelector(' .windowAllImages').getBoundingClientRect().y;
		let scrollFromBlock;
		let scrollTop = modalBlock.scrollTop;
		
		if(scrollTop < 80) {
			scrollTop = 0;
			scrollFromBlock = 40;
		} else {
			scrollFromBlock = -40;
			if(modalBlock.scrollTop + heightScreen + 40 > modalBlock.scrollHeight) {
				let addToHeight = modalBlock.scrollHeight - (modalBlock.scrollTop + heightScreen);	
				dropArea.style.height = heightScreen - 40 + addToHeight + 'px';
				dropArea.style.padding = '14px';
			}
		}
		dropArea.style.top = scrollFromBlock + scrollTop + 'px';
		
		if(modalBlock.scrollTop + heightScreen < modalBlock.scrollHeight) {
			if(modalBlock.scrollTop < 80) {
				dropArea.style.height = heightScreen + modalBlock.scrollTop - 80 + 'px';	
			} else if(modalBlock.scrollTop + heightScreen + 40 < modalBlock.scrollHeight) {
				dropArea.style.height = heightScreen + 'px';
				dropArea.style.padding = '14px';
			}
			
			if(heightModal + fromTopToImages < heightScreen && fromTopToImages > 0) {
				dropArea.style.height = heightModal + 30 + 'px';
				dropArea.style.padding = '14px';
			}
		}
	});
	
	function dropAreaToCenter() {
		let heightScreen = document.documentElement.clientHeight;
		let heightModal = modalBlock.querySelector(' .modalBody').getBoundingClientRect().height;
		let fromTopToImages = modalBlock.querySelector(' .windowAllImages').getBoundingClientRect().y;
		let fromTopToDropArea = modalBlock.querySelector('#drop-area .areaBackground').getBoundingClientRect().y;

		if(heightModal + fromTopToImages > heightScreen) {
			dropArea.style.height = heightScreen - fromTopToDropArea  + 14 + 'px';

			let scrollTop = modalBlock.scrollTop;
		
			if(scrollTop < 80) {
				scrollTop = 0;
				scrollFromBlock = 40;
			} else {
				scrollFromBlock = -40;
			}

			dropArea.style.top = scrollFromBlock + scrollTop + 'px';
			dropArea.style.padding = '14px';
		}
	}
	
	/** Select img **/
	let allImages = modalBlock.querySelectorAll('.windowAllImages .rowImages .imageCart');
	
	for (let elem of allImages) {
		elem.addEventListener('click', changeSelect, false);
	}
	
	function changeSelect(e) {
		if(typeof(tableForManyPhotos) == "undefined") {
			event.stopImmediatePropagation();
			if(currentTableId == valueTableField_for_insert_image) {
				if(e.path[0].className != 'selectImages') {
					let notSelect = e.path[2].querySelector('.notSelect');
					let yesSelect = e.path[2].querySelector('.select');
					
					if(notSelect != null) {
						let img = notSelect.querySelector('img');
						changingImagePOST(img.dataset.filename, '', notSelect, yesSelect);
					} else if(yesSelect != null) {
						let img = yesSelect.querySelector('img');
						changingImagePOST('', img.dataset.filename, notSelect, yesSelect);		
					}
				}
			}
		}
	}
	
	function turnOnHover(e) {
		e.fromElement.classList.remove('no-hover');
		e.fromElement.removeEventListener('mouseleave', turnOnHover, false);
	}
	
	function notSelectToSelect(notSelect) {
		let allImages = modalBlock.querySelectorAll('.windowAllImages .rowImages .imageCart');
		for (let elem of allImages) {
		  if(elem.querySelector('.select')!= null) {
				elem.querySelector('.select').className = "hoverForSelect notSelect";			
			}
		}

		notSelect.className = "hoverForSelect select no-hover";
		notSelect.addEventListener('mouseleave', turnOnHover, false);
	}
	
	function yesSelectToNotSelect(yesSelect) {		
		yesSelect.className = "hoverForSelect notSelect no-hover";	
		yesSelect.addEventListener('mouseleave', turnOnHover, false);
	}
	
	function changingImagePOST(a, b, notSelect, yesSelect) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'App/Controllers/changingCurrentImage.php');
		xhr.setRequestHeader( "Content-Type", "application/json" );
				
		xhr.addEventListener('readystatechange', function(e) {
			if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
				console.log(e.target.response);
				console.log('Фотка выбрана');
				
				if(notSelect != null) {
					notSelectToSelect(notSelect);
					editingDOMnotSelectToSelect(notSelect);
				} else if(yesSelect != null) {
					yesSelectToNotSelect(yesSelect);
					editingDOMyesSelectToNotSelect();
				}
			} else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
				titleError.style.display = "block";
				titleError.innerText = 'К сожалению, не удалось выбрать фотографию.';
				setTimeout(deleteTitleError, 5000);
				console.log('К сожалению, не удалось выбрать фотографию.');
			}
		});

		xhr.send('["' + a + '", "' + b + '", "' + table_for_insert_image + '", "' + tableField_for_insert_image + '", "' + valueTableField_for_insert_image + '", "' + img_path + '"]');
	}
	
	let allSelectImages = modalBlock.querySelectorAll('.windowAllImages .rowImages .imageCart .selectImages');
	
	for (let elem of allSelectImages) {
		elem.addEventListener('click', selectingImages, false);
	}
	
	let deleteBin = modalHeader.querySelector('.delete-bin');
	
	function selectingImages(e) {
		e.path[2].querySelector('.item').classList.toggle('active');
		
		let allActiveImages = modalBlock.querySelectorAll('.item.active').length;
		if(allActiveImages > 0 && deleteBin.classList == 'delete-bin') {
			deleteBin.className = 'delete-bin active';
		} else if (allActiveImages == 0) {
			deleteBin.className = 'delete-bin';
		}
	}
	
	modalHeader.querySelector('.select-all').addEventListener('click', selectingAllImages, false);
	
	function selectingAllImages() {
		let allImages = modalBlock.querySelectorAll('.item');
		let allActiveImages = modalBlock.querySelectorAll('.item.active');
		
		if(allImages.length == allActiveImages.length) {
			for (let elem of allImages) {
				elem.className = 'item';
			}
			deleteBin.className = 'delete-bin';
		} else {
			for (let elem of allImages) {
				if(elem.className == 'item') {
					elem.className = 'item active';
				}
			}	
			deleteBin.className = 'delete-bin active';		
		}
	}
	
	deleteBin.addEventListener('click', deletingImages, false);
	
	function deletingImages() {
		deleteBin.className = 'delete-bin';
		let allCartsImages = modalBlock.querySelectorAll('.imageCart .selectImages .item.active');
		for (let elem of allCartsImages) {
			let cart = elem.closest('.imageCart');
			let yesSelect = cart.querySelector('.select');
			let img = cart.querySelector('img');
			
			if(yesSelect != null) {
				changingImagePOST('', img.dataset.filename, null, yesSelect);
			}
			deletingImagePOST(img.dataset.filename, cart);
		}
	}
	
	function deletingImagePOST(filename, cart) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'App/Controllers/deletingImage.php');
		xhr.setRequestHeader( "Content-Type", "application/json" );
		
		xhr.addEventListener('readystatechange', function(e) {
			let heightModal = modalBlock.querySelector(' .modalBody').getBoundingClientRect().height;
			
			if(heightModal == 0) {
				toggleModalBlock(modalNumber, 2);
			}
			if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
				console.log(e.target.response);
				console.log('Фотка удалена');
				
				if(typeof(tableForManyPhotos) != "undefined") {
					changingDOMafterDeletingPhoto(e.target.response);
				}
				
				cart.remove();
				
				let heightScreen = document.documentElement.clientHeight;
				let fromTopToImages = modalBlock.querySelector(' .windowAllImages').getBoundingClientRect().y;
				heightModal = modalBlock.querySelector(' .modalBody').getBoundingClientRect().height;
				
				if(heightScreen > fromTopToImages+heightModal && heightModal > 0) {
					dropArea.style.height = heightModal + 40 + 'px';
				}
			}
			else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == "")) {
				titleError.style.display = "block";
				titleError.innerText = 'К сожалению, не удалось удалить фотографию.';
				setTimeout(deleteTitleError, 5000);
			}
		});

		xhr.send('["' + filename + '", "' + table_for_insert_image + '", "' + tableField_for_insert_image + '", "' + valueTableField_for_insert_image + '", "' + img_path + '"]');
	}
}