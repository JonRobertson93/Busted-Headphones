// Model: If option 'Bose' selected create all Bose models as option values
// DOM elements
let submissionForm = document.getElementById("submission-form");
let brands = document.getElementsByClassName("brands");
let models = document.getElementsByClassName("models");
let qty = document.getElementsByClassName('qty');
const quoteButton = document.getElementById('quoteButton');
let quoted = document.getElementById('quote');
const addMoreButton = document.getElementById('addMore');
let rowCount = 0;
let rows = {};
rows['zero'] = 0;
rows['one'] = 1;
rows['two'] = 2;
rows['three'] = 3;
rows['four'] = 4;
rows['five'] = 5;


// Headphones RAW data
let brandModels = {};
brandModels['Bose'] = ['QuietComfort 25 Wired', 'QuietComfort 25 Wireless', 'QuietComfort 35 Series I', 'QuietComfort 35 Series II', 'BT2R'];
brandModels['Beats'] = ['Solo2 Wired', 'Solo2 Wireless', 'Solo3 Wireless', 'Studio Wired', 'Studio Wireless', 'Studio2 Wired', 'Studio2 Wireless', 'Studio3 Wireless'];
brandModels['Sony'] = ['MDR-1000X', 'MDR-XB950BT', 'MDR-XB950B1', 'MDR-1000X', 'WH-1000XM2', 'WH-1000XM3'];
brandModels['JBL'] = ['Everest 700 Elite'];

let firstTotalPrice;
let modelCounter = 0;

let allCartItems = [];

let selectedBrand;
let selectModel;
let currentModels;

Array.from(brands).forEach(function(brand) {
      brand.addEventListener('change', addModels);
    });

addMoreButton.addEventListener('click', addMore);

//TODO - Move functions down here
function addModels(e) {
	//testing which item is selected
	e.target.style.color = "purple";
	//deleteModels();
	selectedBrand = e.target.options[e.target.selectedIndex].value;
	currentModels = brandModels[selectedBrand];
	Array.from(currentModels).forEach(function(model) {
		model.innerHMTL = "";
	});
	
	// Array of all models of selectedBrand
	//add correct brand's models to current models select box:
	models[rowCount].options.add(new Option());	// Adds one blank option at top
	for (let i = 0; i < currentModels.length; i ++) {
		models[rowCount].options.add(new Option(currentModels[i]));
	}
};

function deleteModels(e) {
	Array.from(models).forEach(function(model) {
		model.innerHTML = "";
	});
}


function addMore() {
	// Allows up to 10 rows
	if (rowCount < 9) {
		addMoreButton.insertAdjacentHTML('beforebegin', `<label class="label" for="brands"> Brand: </label>
				<select class="brands" name="brand[]">
					<option></option>
					<option value="Bose">Bose</option>
					<option value="Beats">Beats</option>
					<option value="Sony">Sony</option>
					<option value="JBL">JBL</option>
				</select>

				<label class="label" for="models"> Model: </label>
				<select class="models" name="model[]">
				</select>

				<label class="label" for="qty"> Quantity: </label>
				<input type="text" class="qty" name="qty[]">
				<br />`);
		brands = document.getElementsByClassName("brands");
		models = document.getElementsByClassName("models");
		qty = document.getElementsByClassName('qty');
		rowCount++;

		Array.from(brands).forEach(function(brand) {
	      brand.addEventListener('change', addModels);
	    });
	} else {
		oops = document.getElementById('oops');
		oops.innerHTML = `<p> I'm sorry, but you've added the maximum number of items for one order! </p>`;
	}

}

// OLD ADDMORE() FUNCTION:
	// selectModel = models.options[models.selectedIndex].innerHTML;
	// for (let i = 0; i < allHeadphones.length; i++) {
	// 	if (selectModel == allHeadphones[i].model) {
	// 		firstTotalPrice = allHeadphones[i].price;
	// 		console.log(firstTotalPrice);
	// 	}
	// }
	// let item = new CartItem(selectModel, qty.value);
	// allCartItems.push(item);



// When submit is clicked, do the following:
// Find value associated with model * quantity. Set this equal to total for that item.
// Add this value to a confirmation page
// Do this for all items added in get quote.
// Reroute to confirmation page.


// QUOTE INFO - May use some of this later 

// quoteButton.addEventListener('click', generateQuote);
// 	selectModel = models.options[models.selectedIndex].innerHTML;
// 	for (let i = 0; i < allHeadphones.length; i++) {
// 		if (selectModel == allHeadphones[i].model) {
// 			firstTotalPrice = allHeadphones[i].price;
// 			console.log(firstTotalPrice);
// 		}
// 	}
// 	firstTotalPrice *= qty.value;
// 	clearQuotes();
// 	setTimeout(generateQuote, 1000);

// function generateQuote() {
// 	quoted.innerHTML = `We can offer $${firstTotalPrice} for your ${qty.value} ${selectedBrand} ${selectModel} headphones.`;
// 	// TESTING - WORKING SO FAR!
// 	for (let i = 0; i <allCartItems.length; i++) {
// 		console.log(allCartItems[i].model + " x " + allCartItems[i].quantity);	
// 	}
// }

// function clearQuotes() {
// 	quoted.innerHTML = "";
// }


