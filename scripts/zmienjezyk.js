let bPolski = true;
let bAngielski = false;

function zmienjezyk() {
	if (bPolski) {
		bPolski = false;
		bAngielski = true;

		document.getElementById("site-name").innerText = "Strona Test 1";
		document.getElementById("opistext1").innerText = "Opis 1";
		document.getElementById("opistext2").innerText = "Opis 2";
		document.getElementById("opistext3").innerText = "Opis 3";
		document.getElementById("offers-text").innerText = "Oferty";
		document.getElementById("button-wlacz-darkmode").innerText = "Włącz / Wylacz dark mode";
		document.getElementById("button-wlacz-angielski").innerText = "Switch to English";
		document.getElementById("option3").innerText = "Opcja 3";
	}

	if (bAngielski) {
		bPolski = true;
		bAngielski = false;

		document.getElementById("site-name").innerText = "Test Site 1";
		document.getElementById("opistext1").innerText = "Description 1";
		document.getElementById("opistext2").innerText = "Description 2";
		document.getElementById("opistext3").innerText = "Description 3";
		document.getElementById("offers-text").innerText = "Offers";
		document.getElementById("button-wlacz-darkmode").innerText = "Enable / Disable Dark Mode";
		document.getElementById("button-wlacz-angielski").innerText = "Zamien na Polski";
		document.getElementById("option3").innerText = "Option 3";
	}
}

window.onload = function() {
	zmienjezyk();
}