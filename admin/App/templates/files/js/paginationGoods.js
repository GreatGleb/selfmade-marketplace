function htmlEncode(str) {
  var el = document.createElement("div");
  el.innerHTML = str;
  str = el.textContent;
  return str;
}

function changeDOMLoadNewGoods(str) {
    console.log('start')
    let jsonArray = JSON.parse(str);
    
    let tr_s = document.querySelectorAll('tbody tr');
    
    for(let i = 0; i < tr_s.length; i++) {
        let obj = jsonArray[i];
        console.log(obj)
        let tr = tr_s[i];
        
        if(obj == undefined) {
            tr.style.display = 'none';
            continue;
        } else {
            tr.style.display = 'table-row';
        }
        
        let td_s = tr.querySelectorAll('td');
        td_s[0].dataset.id = obj.id;
        td_s[0].dataset.shopName = obj.shop.name;
        td_s[0].dataset.isIncluded = obj.isIncluded;
        td_s[0].dataset.istrading = obj.isTrading;
        if(obj.statusOfTrading != null || obj.statusOfTrading != undefined) {
            td_s[0].dataset.statusOfTrading = obj.statusOfTrading;
        } else {
            td_s[0].dataset.statusOfTrading = '';
        }
        td_s[0].dataset.goodType = obj.typeProduct;
        td_s[0].dataset.goodBrand = obj.brand;
        td_s[0].dataset.goodModel = obj.model;
        
        let strImages = '';
        if(obj.images != null && obj.images != undefined && typeof(obj.images) != 'string') {
            for(let img of obj.images) {
                strImages += img.url + img.name + '|' + img.orderNumber + ',';
            }
        }
        td_s[0].dataset.goodPhotos = strImages;
    
        td_s[0].dataset.goodDescription = htmlEncode(obj.description);
        td_s[0].dataset.goodUrl = obj.url;
        td_s[0].dataset.goodSellerPrice = obj.sellerPrice;
        td_s[0].dataset.goodSystemPrice = obj.systemPrice;
        td_s[0].dataset.goodQuantity = obj.quantity;
        td_s[0].dataset.goodOrderquantity = obj.minOrderQuantity;
        td_s[0].dataset.goodInstock = obj.isInStock;
        td_s[0].dataset.goodLength = obj.length;
        td_s[0].dataset.goodWidth = obj.width;
        td_s[0].dataset.goodHeight = obj.height;
        td_s[0].dataset.goodWeight = obj.weight;
        td_s[0].dataset.goodStockroom = obj.stockroomId;
    
        let strStockrooms = '';
        if(obj.stockrooms != null && obj.stockrooms != undefined && typeof(obj.stockrooms) != 'string') {
            for(let stock of obj.stockrooms) {
                strStockrooms += stock.id + ',' + stock.address.country + ',' + stock.address.region + ',' + stock.address.city + ',' + stock.address.street + ',' + stock.address.home;
                if(stock.address.office != null && stock.address.office != '' && stock.address.office != ' ') {
                    strStockrooms += ',' + stock.address.office;
                }
                strStockrooms += '|';
            }
        }
        td_s[0].dataset.stockrooms = strStockrooms;
        
        td_s[0].dataset.goodArticul = obj.stockCode;
        if(obj.category != null && obj.category != undefined && typeof(obj.category) != 'string') {
            td_s[0].dataset.goodCategoryid = obj.category.id;
            td_s[0].dataset.goodCategory = obj.category.name;
        }
        
        let strCategories = '';
        if(obj.categories != null && obj.categories != undefined && typeof(obj.categories) != 'string') {
            for(let category of obj.categories) {
                strCategories += category.id + ',' + category.name + '|';
            }
        }
        td_s[0].dataset.goodCategories = strCategories;
        
        let strAtributes = '';
        if(obj.atributes != null && obj.atributes != undefined && typeof(obj.atributes) != 'string') {
            for(let atribute of obj.atributes) {
                strAtributes += atribute + ']]]';
            }
        }
        td_s[0].dataset.atributes = strAtributes;
        if(obj.disconts != null && obj.disconts != undefined) {
            td_s[0].dataset.disconts = obj.disconts;
        } else {
            td_s[0].dataset.disconts = '';
        }
        
        let goodImg = tr.querySelector('.image img');
        if(obj.image != null && obj.image != undefined && typeof(obj.image) != 'string') {
            goodImg.setAttribute('src', obj.image.url + obj.image.name);
            goodImg.dataset.filename = obj.image.name;
        } else {
            goodImg.setAttribute('src', '');
            goodImg.dataset.filename = '';
        }
        
        let tdName = tr.querySelector('.name');
        tdName.innerText = obj.typeProduct + ' ' + obj.model;
        
        let strStatusInlude = '';
        let strStatusTrade = '';
        
        if(obj.seller.isIncluded == '1' && obj.shop.isIncluded == '1' && obj.isIncluded == '1') {
            strStatusInlude = 'Статус включения:<br>включён<br><br>';
        } else {
            strStatusInlude = 'Статус включения:<br>выключен<br><br>';
        }
        
        if(obj.seller.isTrading == '1' && obj.shop.isTrading == '1' && obj.isTrading == '1') {
            strStatusTrade = 'Разрешение на продажу:<br>одобрен';
        } else {
            strStatusTrade = 'Разрешение на продажу:<br>неодобрен';
        }
        td_s[3].innerHTML = strStatusInlude + strStatusTrade;
        
        let all_quantity = tr.querySelector('.quantity .all_quantity');
        all_quantity.innerText = 'Всего: ' + obj.quantity + ' шт.';
        let trade_quantity = tr.querySelector('.quantity .trade_quantity');
        trade_quantity.innerText = 'Продажа: от ' + obj.minOrderQuantity + ' шт.';
        
        let tdPrice =  tr.querySelector('td.price');
        tdPrice.innerHTML = 'Цена продавца: ' + obj.sellerPrice + '<br><br>Цена Saterno: ' + obj.systemPrice;
        
        tdJur =  tr.querySelector('td.jur');
        if(tdJur != null) {
            let jurType;
            if(obj.seller.jurSelectedType != null) {
                jurType = obj.seller.jurSelectedType;
            } else {
                jurType = obj.seller.jurType;
            }
            
            if(jurType == null || jurType == undefined) {
                jurType = '';
            }
            
            tdJur.innerHTML = ' Магазин: ' + obj.shop.name + '<br><br>' + 'Юр. лицо:<br><span class="jurName">' + jurType + ' «‎' + obj.seller.jurName + '»‎</span>';
        }
        
        let tdCategories = tr.querySelector('td.categories');
        let strNameCategories = '';
        if(typeof(obj.categories) != 'string' && obj.categories != null && obj.categories != undefined) {
            for(let category of obj.categories) {
                strNameCategories += category.name + '<br>';
            }
        }
        let strCategoryName = '';
        if(obj.category != null && obj.category != undefined && typeof(obj.category) != 'string') {
            strCategoryName = obj.category.name;
        }
        
        tdCategories.innerHTML = strCategoryName + '<br>' + strNameCategories;
        
        let tdDate = tr.querySelector('td.date');
        tdDate.innerText = obj.date_added;
    }
}

function sendGoodPageAndGetGoodsPOST(numberOfPage) {
    var xhr = new XMLHttpRequest();
	xhr.open('POST', 'App/Controllers/getPageOfGoods.php');

	xhr.addEventListener('readystatechange', function(e) {
		
		if (xhr.readyState == 4 && xhr.status == 200 && e.target.response) {
		    changeDOMLoadNewGoods(e.target.response);
		    
			//console.log(e.target.response);
		}
		else if (xhr.readyState == 4 && (xhr.status != 200 || e.target.response.length == 0)) {
			let errorMessage = document.querySelector('.modalBlock.error.level2 .modalBody');
			errorMessage.innerHTML = "<p>Не удалось загрузить новую страницу с товарами.</p>";
			toggleModalBlock(4, 2);
			console.log('Не удалось загрузить новую страницу с товарами.');
			console.log(e.target.response);
		}
	});
	
    var fd = new FormData;
	fd.append("numberOfPage", numberOfPage);
	xhr.send(fd);
}

let pagSpans = document.querySelectorAll('.pagination.pag_1 > span');

let allPagSpans = document.querySelectorAll('.pagination span');

for(let el of allPagSpans) {
    el.addEventListener('click', paginationSpan);
}

function paginationSpan() {
    if(this.dataset.page === 'center' || this.dataset.page == undefined) {
        return;
    }
    
    for(let el of document.querySelectorAll('.pagination')) {
        el.querySelector('.paginator_active').className = '';
        el.querySelector('span[data-page="' + this.dataset.page + '"]').className = 'paginator_active activePage';
        
        if(this.parentNode.parentNode.dataset.page === 'center') {
            el.querySelector('[data-page="center"]').className = 'activePage';
        } else {
            el.querySelector('[data-page="center"]').className = '';
        }
    }
    
    let numberOfPage = document.querySelector('.paginator_active').innerHTML;
    sendGoodPageAndGetGoodsPOST(numberOfPage);
}

let buttonsStart = [];

buttonsStart.push(document.querySelector('#pag_start'));
buttonsStart.push(document.querySelector('#pag_start_2'));

for(let el of buttonsStart) {
    el.addEventListener('click', paginationStart);
}

let buttonsEnd = [];

buttonsEnd.push(document.querySelector('#pag_end'));
buttonsEnd.push(document.querySelector('#pag_end_2'));

for(let el of buttonsEnd) {
    el.addEventListener('click', paginationEnd);
}

function paginationEnd() {
    for(let el of document.querySelectorAll('.pagination')) {
        el.querySelector('.paginator_active').className = '';
        el.querySelector('span[data-page="end"]').className = 'paginator_active activePage';
    }
    let pagesCenter = document.querySelectorAll('span[data-page="center"]');
    for(let el of pagesCenter) {
        el.className = '';
    }
    
    let numberOfPage = document.querySelector('.paginator_active').innerHTML;
    sendGoodPageAndGetGoodsPOST(numberOfPage);
}

function paginationStart() {
    for(let el of document.querySelectorAll('.pagination')) {
        el.querySelector('.paginator_active').className = '';
        el.querySelector('span[data-page="1"]').className = 'paginator_active activePage';
    }
    let pagesCenter = document.querySelectorAll('span[data-page="center"]');
    for(let el of pagesCenter) {
        el.className = '';
    }
    
    let numberOfPage = document.querySelector('.paginator_active').innerHTML;
    sendGoodPageAndGetGoodsPOST(numberOfPage);
}

let buttonsPrev = [];

buttonsPrev.push(document.querySelector('#pag_prev'));
buttonsPrev.push(document.querySelector('#pag_prev_2'));

for(let el of buttonsPrev) {
    el.addEventListener('click', paginationPrev);
}

function paginationPrev() {
    let currentPage = this.parentNode.querySelector('.paginator_active');
    if(currentPage.dataset.page === '2' || currentPage.dataset.page === 2) {
        let pagesTwo = document.querySelectorAll('span[data-page="2"]');
        for(let el of pagesTwo) {
            el.className = '';
            el.parentNode.querySelector('span[data-page="1"]').className = 'paginator_active activePage';
        }
    } else if(currentPage.dataset.page === 'end') {
        let pagesOne = document.querySelectorAll('span[data-page="end"]');
        for(let el of pagesOne) {
            el.className = '';
            el.parentNode.querySelector('span[data-page="next"]').className = 'paginator_active activePage';
        }
    } else {
        let number = currentPage.dataset.page;
        
        if(number == '1') {
            return;
        }
        
        let prev_number;
        if(number == 'next') {
            prev_number = Number(currentPage.innerHTML) - 1;
        } else {
            prev_number = Number(number) - 1;
        }
        
        let findedEl = document.querySelector('span[data-page="' + prev_number + '"]');
        if(findedEl != null) {
            let pagesOne = document.querySelectorAll('span[data-page="' + number + '"]');
            //console.log(number);
            for(let el of pagesOne) {
                el.className = '';
                let container;
                if(el.parentNode.classList.contains('pagination')) {
                    container = el.parentNode;
                } else {
                    container = el.parentNode.parentNode.parentNode;
                }
                
                container.querySelector('span[data-page="' + prev_number + '"]').className = 'paginator_active activePage';
            }
            
            let pagesCenter = document.querySelectorAll('span[data-page="center"]');
            for(let el of pagesCenter) {
                el.className = 'activePage';
            }
        }
        
        if(number == '3') {
            let pagesOne = document.querySelectorAll('span[data-page="center"]');
            for(let el of pagesOne) {
                el.className = '';
            }
        }
    }
    
    let numberOfPage = document.querySelector('.paginator_active').innerHTML;
    sendGoodPageAndGetGoodsPOST(numberOfPage);
}

let buttonsNext = [];

buttonsNext.push(document.querySelector('#pag_next'));
buttonsNext.push(document.querySelector('#pag_next_2'));

for(let el of buttonsNext) {
    el.addEventListener('click', paginationNext);
}

function paginationNext() {
    let currentPage = this.parentNode.querySelector('.paginator_active');
    if(currentPage.dataset.page === '1' || currentPage.dataset.page === 1) {
        let pagesOne = document.querySelectorAll('span[data-page="1"]');
        for(let el of pagesOne) {
            el.className = '';
            el.parentNode.querySelector('span[data-page="2"]').className = 'paginator_active activePage';
        }
    } else if(currentPage.dataset.page === 'next') {
        let pagesOne = document.querySelectorAll('span[data-page="next"]');
        for(let el of pagesOne) {
            el.className = '';
            el.parentNode.querySelector('span[data-page="end"]').className = 'paginator_active activePage';
        }
    } else {
        let number = currentPage.dataset.page;
        
        if(number == 'end') {
            return;
        }
        
        let next_number = Number(number) + 1;
        let findedEl = document.querySelector('span[data-page="' + next_number + '"]');
        if(findedEl != null) {
            let pagesOne = document.querySelectorAll('span[data-page="' + number + '"]');
            for(let el of pagesOne) {
                el.className = '';
                el.parentNode.querySelector('span[data-page="' + next_number + '"]').className = 'paginator_active activePage';
            }
            let pagesCenter = document.querySelectorAll('span[data-page="center"]');
            for(let el of pagesCenter) {
                el.className = 'activePage';
            }
        } else {
            let pagesOne = document.querySelectorAll('.pagination');
            for(let el of pagesOne) {
                el.querySelector('.paginator_active').className = '';
                el.querySelector('span[data-page="next"]').className = 'paginator_active activePage';
            }
            
            let pagesCenter = document.querySelectorAll('span[data-page="center"]');
            for(let el of pagesCenter) {
                el.className = '';
            }
        }
    }
    
    let numberOfPage = document.querySelector('.paginator_active').innerHTML;
    sendGoodPageAndGetGoodsPOST(numberOfPage);
}