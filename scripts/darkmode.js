// Po kliknięciu w przycisk z id "button-wlacz-darkmode", przełącza elementy na wersję w trybie ciemnym.
// Elementy, które mają klasę dark-mode, będą przyjmować kolory zdefiniowane w CSS dla tej klasy 

const toggleButton = document.getElementById('button-wlacz-darkmode');

// Odczytanie elemntów
const body = document.body;
const header = document.querySelector('.header');
const hero = document.querySelector('.hero');
const heroBox = document.querySelector('.hero-box');
const ctaButton = document.querySelector('.cta-btn');
const services = document.querySelector('.services');
const serviceBtns = document.querySelectorAll('.service-btn');
const serviceBoxes = document.querySelectorAll('.service-box');
const footer = document.querySelector('.footer');

// Funkcja przełączająca tryb ciemny przy kliknięciu, dodaje lub usuwa klasę "dark-mode" na odpowiednich elementach
toggleButton.addEventListener('click', function() {
    body.classList.toggle('dark-mode');
    header.classList.toggle('dark-mode');
    hero.classList.toggle('dark-mode');
    heroBox.classList.toggle('dark-mode');
    ctaButton.classList.toggle('dark-mode');
    services.classList.toggle('dark-mode');
    footer.classList.toggle('dark-mode');

    serviceBoxes.forEach(serviceBox => serviceBox.classList.toggle('dark-mode'));
    serviceBtns.forEach(serviceBtn => serviceBtn.classList.toggle('dark-mode'));
});