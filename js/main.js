let prevScrollpos = window.pageYOffset;
window.onscroll = function () {
	var currentScrollPos = window.pageYOffset;
	if (prevScrollpos > currentScrollPos) {
		document.getElementById("navbar").style.top = "0";
	} else {
		document.getElementById("navbar").style.top = "-800px";
	}
	prevScrollpos = currentScrollPos;
};

const accountButton = document.querySelector("#account-button");

accountButton.addEventListener("click", () => {
	const accountDropdown = document.querySelector(".account-dropdown");

	if (getComputedStyle(accountDropdown).display == "flex") {
		accountDropdown.style.display = "none";
	} else {
		accountDropdown.style.display = "flex";
	}
});
