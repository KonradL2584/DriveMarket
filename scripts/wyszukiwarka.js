document.getElementById('wyszukiwarka').addEventListener('input', function() {
	const wpisanytekst = this.value.toLowerCase();
	const wszystkieprodukty = document.querySelectorAll('.produkty-glowne');

	wszystkieprodukty.forEach(container => {
		const nazwaproduktu = container.querySelector('.nazwa-produktu').innerText.toLowerCase();
		if (nazwaproduktu.includes(wpisanytekst)) {
			container.style.display = 'flex';
		}
		else {
			container.style.display = 'none';
		}
	});
});

//getElementById = pobieranie elementu o ID "wyszukiwarka"
//addEventListener = funkcja uruchamia sie przy pisaniu w polu wyszukiwania
//toLowerCase = zamiana na male litery aby nie zalezalo od wielkosci liter
//querySelectorAl = pobieranie wszystkich elementow o nazwie "produkty-glowne"
//forEach = sprawdzanie kazdego elementu
//includes(wpisanytekst) = porownanie czy nazwa produktu zawiera tekst wpisany w pole wyszukiwarki
//display = 'flex' widoczny element
//display = 'none' ukrywany element