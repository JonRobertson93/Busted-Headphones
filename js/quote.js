// JS for hamburger menu
let hamburger = document.getElementById('icon');
hamburger.addEventListener('click', function() {
	let navMenu = document.getElementById('navbar');
	let navItems = document.getElementsByClassName('nav-link');
	let container = document.getElementById('container');
	if (navMenu.className == 'smallNav') {
		navMenu.classList.remove('smallNav');
	} else {
		navMenu.classList.add("smallNav");
	}
	Array.from(navItems).forEach(function(item){
		if (item.classList.contains('smallNavLink')) {
			item.classList.remove('smallNavLink');

		} else {
			item.classList.add('smallNavLink');
		}
	});
	if (container.classList.contains('biggerContainer')) {
		container.classList.remove('biggerContainer');
	} else {
		container.classList.add('biggerContainer');
	}
});
