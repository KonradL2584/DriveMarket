<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

<?php
// Sprawdzamy, czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Sprawdzamy, czy wszystkie wymagane pola zostały wypełnione
	if (
		!isset($_POST['tytul']) || !isset($_POST['post']) || !isset($_POST['autor']) || !isset($_POST['cena'])
		|| empty($_POST['tytul']) || empty($_POST['post']) || empty($_POST['autor']) || empty($_POST['cena'])
	) {
		echo "<br><hr><p>Podaj wszystkie dane do opublikowania postu</p>";
		return;
	}

	// Pobieramy dane z formularza
	$tytul = $_POST['tytul'];
	$post = $_POST['post'];
	$autor = $_POST['autor'];
	$cena = $_POST['cena'];  // Pobieramy cenę

	// =============================================================

	// Walidacja ceny - sprawdzamy, czy cena jest liczbą
	if (!is_numeric($cena)) {
		echo "<br><hr><p>Cena musi być liczbą.</p>";
		return;
	}

	// Można opcjonalnie przekonwertować cenę na float
	$cena = floatval($cena);

	// =============================================================

	// Przesyłanie pliku (zdjęcia)
	$sciezkaZdjecia = '';
	if (isset($_FILES['zdjecie']) && $_FILES['zdjecie']['error'] == 0) {
		// Sprawdzamy, czy plik jest obrazu
		$dozwoloneTypy = ['image/jpeg', 'image/png', 'image/gif'];
		if (in_array($_FILES['zdjecie']['type'], $dozwoloneTypy)) {
			// Generujemy unikalną nazwę pliku aby pominąć duplikaty
			$nazwaPliku = uniqid('zdjecie_', true) . '.' . pathinfo($_FILES['zdjecie']['name'], PATHINFO_EXTENSION);
			// Definiujemy ścieżkę do folderu, gdzie zdjęcia będą przechowywane
			$sciezkaDocelowa = 'postimages/' . $nazwaPliku;

			// Przenosimy plik z folderu tymczasowego do docelowego
			if (move_uploaded_file($_FILES['zdjecie']['tmp_name'], $sciezkaDocelowa)) {
				$sciezkaZdjecia = $sciezkaDocelowa; // Zapisujemy ścieżkę pliku
			} else {
				echo "Błąd podczas przesyłania zdjęcia.";
				return;
			}
		} else {
			echo "Plik nie jest poprawnym formatem. Dozwolone formaty: .jpeg; .png; .gif";
			return;
		}
	}

	// =============================================================

	// Tworzymy tablicę z danymi postu
	$nowyPost = compact("tytul", "post", "autor", "cena");

	// Dodajemy datę publikacji
	$nowyPost['data'] = date('Y-m-d H:i:s');

	// Jeśli zdjęcie zostało przesłane, dodajemy jego ścieżkę do postu
	if ($sciezkaZdjecia) {
		$nowyPost['zdjecie'] = $sciezkaZdjecia;
	}

	// Ścieżka do pliku JSON, gdzie będą zapisane posty
	$sciezkaDoPliku = 'posts.json';

	// Odczytujemy obecne posty z pliku, jeśli plik istnieje
	if (file_exists($sciezkaDoPliku)) {
		$jsonData = file_get_contents($sciezkaDoPliku);
		$posts = json_decode($jsonData, true); // Dekodujemy JSON na tablicę
	} else {
		$posts = []; // Jeśli plik nie istnieje, inicjujemy pustą tablicę
	}

	// Dodajemy nowy post do tablicy
	$posts[] = $nowyPost;

	// Konwertujemy tablicę na JSON
	$postsJson = json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

	// Sprawdzamy, czy kodowanie JSON przebiegło poprawnie
	if ($postsJson === false) {
		echo "Błąd podczas kodowania JSON: " . json_last_error_msg();
		exit;
	}

	// Zapisujemy tablicę z postami do pliku JSON
	if (file_put_contents($sciezkaDoPliku, $postsJson) !== false) {
		// Po zapisaniu postu, przekierowujemy użytkownika na stronę posts.php
		header('Location: posts.php');
		exit;
	} else {
		echo "Błąd podczas zapisywania pliku.";
	}
}
?>

</body>

</html>