// Model: If option 'Bose' selected create all Bose models as option values
// DOM elements
const brands = document.getElementById("brands");
const models = document.getElementById("models");
const qty = document.getElementById('qty');
const quoteButton = document.getElementById('quoteButton');
let quoted = document.getElementById('quote');


// Headphones RAW data
let brandModels = {};
brandModels['Bose'] = ['QC25', 'QC35'];
brandModels['Beats by Dre'] = ['Solo2', 'Solo3', 'Studio2', 'Studio3'];
brandModels['Sony'] = ['MDR-1000X', 'MDR-950BT', 'MDR-950B1', 'WH-1000XM2', 'WH-1000XM3'];
brandModels['JBL'] = ['Everest 700 Elite'];

let firstTotalPrice;

// Storing form data - doing calculations
class Headphones {
	constructor(model, price) {
		this.model = model;
		this.price = price;
	}
}

class CartItem {
	constructor(model, quantity) {
		this.model = model;
		this.quantity = quantity;
	}
}

let allCartItems = [];



// More headphones data - tuples basically
const QC25 = new Headphones("QC25", 20);
const QC35 = new Headphones("QC35", 40);
const Solo2 = new Headphones("Solo2", 10);
const Solo3 = new Headphones("Solo3", 15);
const Studio2 = new Headphones("Studio2", 25);
const Studio3 = new Headphones("Studio3", 35);
const MDRX = new Headphones("MDR-1000X", 15); 

const allHeadphones = [Solo2, Solo3, Studio2, Studio3, QC25, QC35, MDRX];

let selectedBrand;
let selectModel;

brands.addEventListener('change', addModels);

quoteButton.addEventListener('click', function() {
	firstTotalPrice = 0;
	selectModel = models.options[models.selectedIndex].innerHTML;
	for (let i = 0; i < allHeadphones.length; i++) {
		if (selectModel == allHeadphones[i].model) {
			firstTotalPrice = allHeadphones[i].price;
			console.log(firstTotalPrice);
		}
	}
	firstTotalPrice *= qty.value;
	clearQuotes();
	setTimeout(generateQuote, 1000);
	console.log(`We can offer $${firstTotalPrice} for your ${qty.value} ${selectedBrand} ${selectModel} headphones.`);
});




//TODO - Move functions down here
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

function generateQuote() {
	quoted.innerHTML = `We can offer $${firstTotalPrice} for your ${qty.value} ${selectedBrand} ${selectModel} headphones.`;
	// TESTING - WORKING SO FAR!
	let item1 = new CartItem(selectModel, qty.value);
	allCartItems.push(item1);
	console.log("Items in your cart:");
	for (let i = 0; i <allCartItems.length; i++) {
		console.log(allCartItems[i].model + " x " + allCartItems[i].quantity);	
	}
}

function clearQuotes() {
	quoted.innerHTML = "";
}



// When submit is clicked, do the following:
// Find value associated with model * quantity. Set this equal to total for that item.
// Add this value to a confirmation page
// Do this for all items added in get quote.
// Reroute to confirmation page.