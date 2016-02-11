var sentForm = document.querySelector('form');

function validateForm(e) {
	// alert('Form submitted');
	var nameField = document.getElementById('name');
	var emailField = document.getElementById('email');
	var emailLabel = document.querySelectorAll('label')[1];
	var nameValid, emailValid;

	if (nameField.value == null || nameField.value == '') {
		nameValid = false;
		nameField.className = "incomplete";
	} else {
		nameValid = true;
		nameField.className = "complete";
	}

	if (emailField.value == null || emailField.value == '') {
		emailValid = false;
		emailField.className = 'incomplete';
	} else if (emailField.value.indexOf('@') == -1) { // if no @ symbol
		emailValid = false;
		emailField.className = 'incomplete';
		emailLabel.textContent = "Please enter a valid email address.";
	}	else {
		emailValid = true;
		emailField.className = "complete";
		emailLabel.textContent = "Email";
	}

	if (nameValid == false || emailValid == false) {
		e.preventDefault(); // prevent form from being submitted
	}
}

sentForm.addEventListener('submit', validateForm, false);