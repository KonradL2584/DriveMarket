document.getElementById('wyszukiwarka').addEventListener('input', function() {
    const wpisanytekst = this.value.toLowerCase();
    const wszystkiePosty = document.querySelectorAll('.post'); // Wszystkie posty na stronie

    wszystkiePosty.forEach(post => {
        const tytulPostu = post.querySelector('.tytul').innerText.toLowerCase();
        if (tytulPostu.includes(wpisanytekst)) {
            post.style.display = 'block'; // Pokazuje post
        } else {
            post.style.display = 'none'; // Ukrywa post
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