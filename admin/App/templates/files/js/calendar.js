function getDay(date) {
  const day = date.getDay();
  return day === 0 ? 7 : day;
}
  
function renderRowsWithDates(year, month, divMonthes) {
	const buttons = [];

	const date = new Date(year, month - 1);
	const firstDay = getDay(date);

	let currentYear = new Date().getFullYear();
	let currentMonth = new Date().getMonth();
	let currentDay = new Date().getDate();
	
	if(currentYear != year || currentMonth != Number(month - 1)) {
		currentDay = "";
	}

	let focusYear = divMonthes.dataset.year;
	let focusMonth = months.indexOf(divMonthes.dataset.month);
	let focusDay = divMonthes.dataset.day;

	if(focusYear != year || focusMonth != Number(month - 1)) {
		focusDay = "";
	}
	
	let i = 0;

	while(date.getMonth() === month - 1) {
		const text = document.createTextNode(date.getDate());
		const time = document.createElement('time');
		const cell = document.createElement('button');

		if(i == 0) {
			cell.style.gridColumn = firstDay;
		}
		
		if(date.getDate() == currentDay) {
			let oldToday = divMonthes.querySelector('.dates button.today');
			
			if(oldToday != null) {
				oldToday.className = "";
			}
			
			cell.className = "today";
		}
		
		if(date.getDate() == focusDay) {
			let focusedDates = divMonthes.querySelectorAll('.dates .focus');
			
			for(let elem of focusedDates) {
				elem.classList.remove('focus');
			}
			
			cell.classList.add("focus");
		}

		time.appendChild(text);
		cell.appendChild(time);
		buttons.push(cell);

		date.setDate(date.getDate()+1);

		i = 1;
  }
  
  return buttons;
}

function createCalendar (element, year, month) {
  const datesContainer = document.createElement('div');
  datesContainer.className = 'dates';
  
  const buttons = renderRowsWithDates(year, month, element);
  
  for(index in buttons) {
    datesContainer.appendChild(buttons[index]);
  }
  
  element.appendChild(datesContainer);
    
  spanYear = element.parentNode.querySelector('.month-switcher .year');
  spanYear.innerText = " " + year;
}

const months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

function renderMonthCalendar(currentMonth, currentYear, elementCalendar) {
  const monthCalendar = elementCalendar.querySelector('.monthes');

  const text = document.createTextNode(months[currentMonth]);
  const textChild = elementCalendar.querySelector('.month').childNodes[0];
  
  if(textChild) {
    elementCalendar.querySelector('.month').removeChild(textChild);
  }

  elementCalendar.querySelector('.month').appendChild(text);
  
  var item = elementCalendar.querySelector('.dates');
  
  if (item) {
    monthCalendar.removeChild(item);  
  }
  
  createCalendar(monthCalendar, currentYear, currentMonth + 1);
}

let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();

let calendars = document.querySelectorAll('.calendar');

for(let calendar of calendars) {
	renderMonthCalendar(currentMonth, currentYear, calendar);
	console.log(calendar)
	
	calendar.querySelector('.prev').addEventListener("click", calendarPrev);
	calendar.querySelector('.next').addEventListener("click", calendarNext);
}

function calendarPrev() {
	let calendarContainer = this.parentNode.parentNode;
	
	currentMonth = currentMonth - 1;
	
	if(currentMonth - 1 < 0) {
		const lastIndex = months.length - 1;
		
		currentMonth = lastIndex;
		currentYear -= 1;
	}

	renderMonthCalendar(currentMonth, currentYear, calendarContainer);
}

function calendarNext() {
    console.log(this);
	let calendarContainer = this.parentNode.parentNode;
	
	const lastIndex = months.length - 1;
  
	currentMonth = currentMonth + 1;
	
	if(currentMonth > lastIndex) {
		currentMonth = 0;
		currentYear += 1;
	}
  
	renderMonthCalendar(currentMonth, currentYear, calendarContainer);
}
