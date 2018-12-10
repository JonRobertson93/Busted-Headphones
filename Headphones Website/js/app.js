// Model: If option 'Bose' selected create all Bose models as option values
const brands = document.getElementById("brands");
const models = document.getElementById("models");
const qty = document.getElementById('qty');
const quoteButton = document.getElementById('quoteButton');
let brandModels = {};
brandModels['Bose'] = ['QC25', 'QC35'];
brandModels['Beats by Dre'] = ['Solo3', 'Studio2', 'Studio3'];

let firstTotalPrice;

// Storing form data - doing calculations
class Headphones {
	constructor(model, price) {
		this.model = model;
		this.price = price;
	}
}

const Solo2 = new Headphones("Solo2", 10);
const Solo3 = new Headphones("Solo3", 15);
const Studio2 = new Headphones("Studio2", 25);
const Studio3 = new Headphones("Studio3", 35);

const allHeadphones = [Solo2, Solo3, Studio2, Studio3];

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
	models.innerHTML = "";
}

quoteButton.addEventListener('click', function() {
	let selectModel = models.options[models.selectedIndex].innerHTML;
	for (let i = 0; i < allHeadphones.length; i++) {
		if (selectModel == allHeadphones[i].model) {
			firstTotalPrice = allHeadphones[i].price;
			console.log(firstTotalPrice);
		}
	}
	firstTotalPrice *= qty.value;
	console.log(`We can offer ${firstTotalPrice} for your ${qty.value} ${selectModel} headphones.`);
});






//Functions




// When submit is clicked, do the following:
// Find value associated with model * quantity. Set this equal to total for that item.
// Add this value to a confirmation page
// Do this for all items added in get quote.
// Reroute to confirmation page.