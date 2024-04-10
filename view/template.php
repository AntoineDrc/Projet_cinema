<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/d036d365f0.js" crossorigin="anonymous"></script>
    <title><?= $titre ?></title>
</head>
<body>
    <div id="wrapper">
        <header>
            <?= include 'nav.php'; ?>
        </header>
        <main>
            <?= $contenu ?>
        </main>
        <footer>
            <?= include 'footer.php'; ?>
        </footer>
    </div>
</body>
</html>