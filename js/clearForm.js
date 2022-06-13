const clearButton = document.querySelector(".clear-form");

clearButton.addEventListener("click", (e) => {
	const textInputs = document.querySelectorAll(".create-update input[type=text]");
	const textAreas = document.querySelectorAll(".create-update textarea");
	const submitButton = document.querySelector(".create-update input[type=submit]");

	textInputs.forEach((input) => {
		input.value = "";
	});

	textAreas.forEach((textArea) => {
		textArea.value = "";
	});

	submitButton.name = "create";
	submitButton.value = "Create";
});
