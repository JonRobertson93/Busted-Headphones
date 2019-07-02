let hamburger = document.getElementById('hamburger');

hamburger.addEventListener('click', toggleMenu);

function toggleMenu() {
	let navOptions = document.getElementsByClassName('navLinks');
	for (option of navOptions) {
		if (option.classList.contains('hidden')) {
			option.classList.remove('hidden');
		}
		else {
			option.classList.add('hidden');

		}
	}
}