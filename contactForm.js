let page = document.getElementById("container");
let message = document.getElementById("message");
message.addEventListener('click', function(){
    if (page.classList.contains('shiftUp')) {
    		page.classList.remove('shiftUp');
    	} else {
    		page.classList.add('shiftUp');
    	}
});
    