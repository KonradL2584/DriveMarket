const toggleButton = document.getElementById('button-wlacz-darkmode');
const body = document.body;

toggleButton.addEventListener('click', function() {
	body.classList.toggle('dark-mode');
});