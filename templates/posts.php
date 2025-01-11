<?php
// Ścieżka do pliku JSON z postami
$sciezkaDoPliku = 'posts.json';

// Sprawdzamy, czy plik istnieje i jest odczytywalny
if (file_exists($sciezkaDoPliku)) {
	// Odczytujemy dane z pliku JSON
	$jsonData = file_get_contents($sciezkaDoPliku);
	// Dekodujemy dane z JSON na tablicę PHP
	$posts = json_decode($jsonData, true);
} else {
	$posts = []; // Jeśli plik nie istnieje, inicjujemy pustą tablicę
}

// =============================================================

// Sprawdzamy, czy została wybrana opcja sortowania
if (isset($_GET['sortowanie'])) {
	$sortowanie = $_GET['sortowanie'];

	// Sortowanie postów według tytułu (alfabetycznie)
	if ($sortowanie == 'title') {
		usort($posts, function($a, $b) {
			return strcmp($a['tytul'], $b['tytul']);
		});
	}
	// Sortowanie postów według daty (od najnowszych)
	elseif ($sortowanie == 'datenew') {
		usort($posts, function($a, $b) {
			return strtotime($b['data']) - strtotime($a['data']);
		});
	}
	// Sortowanie postów według daty (od najstarszych)
	elseif ($sortowanie == 'dateold') {
		usort($posts, function($a, $b) {
			return strtotime($a['data']) - strtotime($b['data']);
		});
	}
	// Sortowanie postów według ceny (od najtańszych)
	elseif ($sortowanie == 'priceasc') {
		usort($posts, function($a, $b) {
			return $a['cena'] <=> $b['cena'];
		});
	}
	// Sortowanie postów według ceny (od najdroższych)
	elseif ($sortowanie == 'pricedesc') {
		usort($posts, function($a, $b) {
			return $b['cena'] <=> $a['cena'];
		});
	}
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DriveMarket - Post</title>
	<link rel="stylesheet" href="../styles/common.css">
	<link rel="stylesheet" href="../styles/posts.css">
</head>

<body>
	<header class="header">
		<div class="logo">DriveMarket</div>
		<nav class="menu">
		<a href="../index.html">Strona główna</a>
		<a href="posts.php">Produkty</a>
		<a href="#">Kontakt</a>
	</nav>
	<div class="auth-container">
		<div class="auth-buttons">
			<a href="login.php" class="auth-btn">Zaloguj się</a>
			<a href="register.php" class="auth-btn">Zarejestruj się</a>
		</div>

		<div class="user-menu">
			<div class="avatar-circle" onclick="toggleDropdown()">
			<span id="userInitials">A</span>
		</div>
 
               <div class="dropdown-menu" id="dropdownMenu">
                    <a href="profile.php">Profil</a>
                    <button onclick="logout()">Wyloguj</button>
                </div>
            </div>
        </div>
    </header>

	<!-- Posty Section -->
	<section class="posts">

	<form action="templates/wstaw.php" method="post" enctype="multipart/form-data">
		<input type="text" name="tytul" placeholder="Tytuł postu" required>
		<br><br>
		<textarea name="post" rows="5" cols="50" placeholder="Tu wpisz swój post" required></textarea>
		<br><br>
		<input type="text" name="autor" placeholder="Autor" required>
		<br><br>
		<input type="number" name="cena" placeholder="Cena" required min="0" step="0.01">
		<br><br>
		<input type="file" name="zdjecie" accept="image/*">
		<br><br>
		<input type="submit" value="Opublikuj">
</form>

<form action="posts.php" method="get">
	<label for="sortowanie">Sortuj posty:</label>

	<select name="sortowanie" id="sortowanie">
		<option value="default">Brak / Domyslne</option>
		<option value="title" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'title') ? 'selected' : ''; ?>>Według tytułu (alfabetycznie)</option>
		<option value="datenew" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'datenew') ? 'selected' : ''; ?>>Według daty (od najnowszych)</option>
		<option value="dateold" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'dateold') ? 'selected' : ''; ?>>Według daty (od najstarszych)</option>
		<option value="priceasc" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'priceasc') ? 'selected' : ''; ?>>Według ceny (od najtanszych)</option>
		<option value="pricedesc" <?php echo (isset($_GET['sortowanie']) && $_GET['sortowanie'] == 'pricedesc') ? 'selected' : ''; ?>>Według ceny (od najdroższych)</option>
	</select>
	<input type="submit" value="Sortuj">
</form>

<!-- <form action="posts.php" method="get">
	<input type="text" id="wyszukiwarka" name="search" placeholder="Wyszukaj posty po tytule" value="">
	<input type="submit" value="Szukaj">
</form> -->

<?php if (count($posts) > 0): ?>
	<!-- Wyświetlamy wszystkie posty -->
<?php foreach ($posts as $index => $post): ?>

<div class="post">
	<div class="post-box">
		<?php if (!empty($post['zdjecie'])): ?>
			<img src="<?php echo htmlspecialchars($post['zdjecie']); ?>" alt="Zdjęcie" width="300">
		<?php endif; ?>
	</div>

	<p class="tytul"><strong>Tytul:</strong> <?php echo htmlspecialchars($post['tytul']); ?></p>
	<p><strong>Tresc:</strong> <?php echo nl2br(htmlspecialchars($post['post'])); ?></p>
	<p><strong>Autor:</strong> <?php echo htmlspecialchars($post['autor']); ?></p>
	<p><strong>Data:</strong> <?php echo htmlspecialchars($post['data']); ?></p>
	<p><strong>Cena:</strong> <?php echo htmlspecialchars($post['cena']); ?></p>
</div>

<?php endforeach; ?>

	<?php else: ?>
		<!-- Komunikat, jeśli brak postów -->
		<p>Nie ma zadnych postow do wyświetlenia.</p>
	<?php endif; ?>

	</section>

	<!-- Footer -->
	<footer class="footer">
		<p>&copy; 2024 DriveMarket. Wszystkie prawa zastrzeżone.</p>
	</footer>

	<script src="../scripts/auth.js"></script>
	<script src="../scripts/posts.js"></script>
	<script src="../scripts/wyszukiwarka.js"></script>
</body>

</html>
