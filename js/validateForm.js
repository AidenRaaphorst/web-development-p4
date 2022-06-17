const registerForm = document.querySelector("#registerform");
const registerButton = document.querySelector("#reg");

registerButton.addEventListener("click", (e) => {
	e.preventDefault();

	const pass1 = document.querySelector("#pass1");
	const pass2 = document.querySelector("#pass2");

	let msg = "";

	if (pass1.value.length < 8) {
		msg += "Wachtwoord is te kort (minimaal 8 tekens)\n";
	}

	if (pass2.value != pass1.value) {
		msg += "Wachtwoorden komen niet overeen\n";
	}

	if (msg == "") {
		registerForm.submit();
	} else {
		alert(msg.trim());
	}
});
