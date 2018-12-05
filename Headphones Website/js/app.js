let navMenu = document.querySelectorAll('#topMenu li');
navMenu.forEach(function() {
	addEventListener("click", function() {
		this.style.backgroundColor = "red";}
	);
});