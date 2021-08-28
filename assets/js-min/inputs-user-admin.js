var elements = document.querySelectorAll(".personal-cabinet-content > .right .content .acf-fields .acf-field .acf-input input[type='text'],.personal-cabinet-content > .right .content .acf-fields .acf-field .acf-input input[type='number']");

var myFunction = function (e) {
    e.preventDefault();
	this.classList.toggle("active");
	if (this.previousSibling.hasAttribute("disabled")) {
		this.previousSibling.removeAttribute("disabled");
		this.previousSibling.focus();
		this.textContent = '➤';
	} else {
		this.previousSibling.setAttribute("disabled", "true");
		this.textContent = 'Изменить';
	}
};

for (var i = 0; i < elements.length; i++) {
    var button = document.createElement("button");
    button.textContent = 'Изменить';
    button.addEventListener('click', myFunction, false);
    elements[i].setAttribute("disabled", "true");
    var instruction = elements[i].parentElement.parentElement.querySelector('.description');
    elements[i].setAttribute("placeholder", instruction.textContent);
    instruction.remove();
    elements[i].setAttribute("size", elements[i].value.length);
	elements[i].parentElement.appendChild(button);
}

var submitButton = document.querySelector('.personal-cabinet-content > .right .content .acf-form-submit input[type="submit"]');
if (submitButton) {
        submitButton.addEventListener('click', function () {
        for (var i = 0; i < elements.length; i++) {
            elements[i].removeAttribute("disabled");
        }
    }, false);
};

var equipInputs = document.querySelectorAll(".personal-cabinet-content > .right .content .images .images-list .image-element span.filename.equipment input[type='checkbox']");

var equipFunc = function (e) {
    this.classList.toggle('checked');
    if (this.classList.contains('checked')) {
        var radio = document.getElementById(this.dataset.input_id);
        radio.checked = true;
    } else {
        var radio = document.getElementById(this.dataset.input_id + '-false');
        radio.checked = true;
    };
};

for (var i = 0; i < equipInputs.length; i++) {
    if (document.getElementById(equipInputs[i].dataset.input_id).checked == true) {
        equipInputs[i].setAttribute('checked', 'true');
        equipInputs[i].classList.add('checked');
    };
    equipInputs[i].addEventListener('click', equipFunc, false);
};

document.getElementById('acf-equipment-save').addEventListener('click', function () {
    document.getElementById('acf-form').submit();
}, false);