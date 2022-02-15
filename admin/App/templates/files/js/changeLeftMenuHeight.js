function changeLeftMenuHeight() {
	document.querySelector('.admin-block-left').style.height = 5 + "px";
	
	let scrollHeight = Math.max(
	  document.body.scrollHeight, document.documentElement.scrollHeight,
	  document.body.offsetHeight, document.documentElement.offsetHeight,
	  document.body.clientHeight, document.documentElement.clientHeight
	);

	document.querySelector('.admin-block-left').style.height = scrollHeight + "px";
}