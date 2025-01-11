const teksty = {
	pl: {
		powitalny: "Witaj w DriveMarket – najlepszym sklepie online!",
		usluga1: "Usługa 1",
		usluga2: "Usługa 2",
		usluga3: "Usługa 3",
		zobaczWiecej: "Zobacz więcej",
		copyright: "&copy; 2024 DriveMarket. Wszystkie prawa zastrzeżone."
	},
	en: {
		powitalny: "Welcome to DriveMarket - the best online store!",
		usluga1: "Service 1",
		usluga2: "Service 2",
		usluga3: "Service 3",
		zobaczWiecej: "See more",
		copyright: "&copy; 2024 DriveMarket. All rights reserved."
	}
};

const jezyki = ['pl', 'en'];

let jezykIndex = 0;

function zmienjezyk() {
	jezykIndex = (jezykIndex + 1) % jezyki.length;

	const aktualnyJezyk = jezyki[jezykIndex];

	document.getElementById("string-powitalny").innerText = teksty[aktualnyJezyk].powitalny;
	document.getElementById("string-usluga1").innerText = teksty[aktualnyJezyk].usluga1;
	document.getElementById("string-usluga2").innerText = teksty[aktualnyJezyk].usluga2;
	document.getElementById("string-usluga3").innerText = teksty[aktualnyJezyk].usluga3;
	document.getElementById("string-zobacz-wiecej").innerText = teksty[aktualnyJezyk].zobaczWiecej;
	document.getElementById("string-copyright").innerHTML = teksty[aktualnyJezyk].copyright;
}

window.onload = function() {
	const aktualnyJezyk = jezyki[jezykIndex];

	document.getElementById("string-powitalny").innerText = teksty[aktualnyJezyk].powitalny;
	document.getElementById("string-usluga1").innerText = teksty[aktualnyJezyk].usluga1;
	document.getElementById("string-usluga2").innerText = teksty[aktualnyJezyk].usluga2;
	document.getElementById("string-usluga3").innerText = teksty[aktualnyJezyk].usluga3;
	document.getElementById("string-zobacz-wiecej").innerText = teksty[aktualnyJezyk].zobaczWiecej;
	document.getElementById("string-copyright").innerHTML = teksty[aktualnyJezyk].copyright;
}
