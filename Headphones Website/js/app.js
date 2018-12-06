// Model: If option 'Bose' selected create all Bose models as option values
const brands = document.getElementById("brands");
let models = document.getElementById("models");
let brandModels = {};
brandModels['Bose'] = ['QC25', 'QC35'];
brandModels['Beats by Dre'] = ['Solo3', 'Studio2', 'Studio3'];

let selectedBrand;

brands.addEventListener('change', addModels);

function addModels() {
	deleteModels();
	selectedBrand = brands.options[brands.selectedIndex].value;
	let current = brandModels[selectedBrand];
	models.options.add(new Option());	// Adds one blank option at top
	for (i = 0; i < current.length; i ++) {
		models.options.add(new Option(current[i], i));
	}
}

function deleteModels() {
	for (i = 0; i < models.length; i++) {
		models.remove();
	}
}




//Functions




// When submit is clicked, do the following:
// Find value associated with model * quantity. Set this equal to total for that item.
// Add this value to a confirmation page
// Do this for all items added in get quote.
// Reroute to confirmation page.