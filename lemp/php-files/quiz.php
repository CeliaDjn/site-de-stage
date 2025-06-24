<?php
session_start();
$niveau = $_GET['niveau'] ?? 'facile';
$pdo = new PDO('mysql:host=mariadb;dbname=quizzdb;charset=utf8', 'root', 'adminmariadb');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Initialisation du score et de l'index pour ce niveau spécifique
$session_key_score = 'score_' . $niveau;
$session_key_index = 'index_' . $niveau;
if (!isset($_SESSION[$session_key_score])) $_SESSION[$session_key_score] = 0;
if (!isset($_SESSION[$session_key_index])) $_SESSION[$session_key_index] = 0;

// Récupération des questions pour le niveau spécifique
$stmt = $pdo->prepare('SELECT * FROM questions WHERE niveau = ? ORDER BY id LIMIT 6');
$stmt->execute([$niveau]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalQuestions = 6;

// Vérification si le quiz est terminé
if ($_SESSION[$session_key_index] >= $totalQuestions || $_SESSION[$session_key_index] >= count($questions)) {
    $finalScore = $_SESSION[$session_key_score];
    // Réinitialiser pour ce niveau
    unset($_SESSION[$session_key_score]);
    unset($_SESSION[$session_key_index]);
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Résultat - <?= ucfirst($niveau) ?></title>
        <link rel="stylesheet" href="quiz.css">
    </head>

    <body>
        <div class="grid-bg">
            <video autoplay loop muted class="background-video">
                <source src="neon.mp4" type="video/mp4">
            </video>
            <div class="my-form">
                <h1>QUIZ TERMINÉ !</h1>
                <h2>Niveau : <?= ucfirst($niveau) ?></h2>
                <p>Votre score est : <?= $finalScore ?> / 6</p>
                <a href="?niveau=<?= $niveau ?>" class="btn">Recommencer</a>
                <a href="selection-quiz.html" class="btn">Retour au menu</a>
            </div>
        </div>
    </body>

    </html>
<?php
    exit;
}
if (isset($_GET['next']) && $_GET['next'] == 1) {
    $_SESSION[$session_key_index]++;
    header("Location: quiz.php?niveau=" . urlencode($niveau));
    exit;
}


// Vérification de la réponse si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['option'])) {
    $selected = $_POST['option'];
    $currentQuestion = $questions[$_SESSION[$session_key_index]];

    $isCorrect = ($selected === $currentQuestion['correct_option']);
    if ($isCorrect) {
        $_SESSION[$session_key_score]++;
    }
    $showFeedback = true;
}


// S'il n'y a pas assez de questions dans la BDD
if (empty($questions)) {
    echo "<p>Aucune question trouvée pour le niveau '$niveau'</p>";
    exit;
}

$currentQuestion = $questions[$_SESSION[$session_key_index]];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= ucfirst($niveau) ?> - Question <?= $_SESSION[$session_key_index] + 1 ?></title>
    <link rel="stylesheet" href="quiz.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
    <header>
        <button
            class="back-btn"
            onclick="window.location.href='selection-quiz.html'"
            aria-label="Retour en arrière">
            <i class="fas fa-arrow-left"></i>
        </button>
    </header>
    <div class="grid-bg">
        <video autoplay loop muted class="background-video">
            <source src="neon.mp4" type="video/mp4">
        </video>


        <div class="my-form">
            <h1><?= strtoupper($niveau) ?> LOGIQUE</h1>
            <h2>Question <?= $_SESSION[$session_key_index] + 1 ?> / 6</h2>
            <p><?= htmlspecialchars($currentQuestion['question']) ?></p>

            <form method="POST">
                <div class="options">
                    <div class="option">
                        <input type="radio" name="option" value="A" id="option_a">
                        <label for="option_a"><?= htmlspecialchars($currentQuestion['option_a']) ?></label>
                    </div>
                    <div class="option">
                        <input type="radio" name="option" value="B" id="option_b">
                        <label for="option_b"><?= htmlspecialchars($currentQuestion['option_b']) ?></label>
                    </div>
                    <div class="option">
                        <input type="radio" name="option" value="C" id="option_c">
                        <label for="option_c"><?= htmlspecialchars($currentQuestion['option_c']) ?></label>
                    </div>
                    <div class="option">
                        <input type="radio" name="option" value="D" id="option_d">
                        <label for="option_d"><?= htmlspecialchars($currentQuestion['option_d']) ?></label>
                    </div>
                </div>
                <input type="submit" value="Valider" class="btn">
            </form>

            <div class="progress">
                <p>Score actuel : <?= $_SESSION[$session_key_score] ?> / 6</p>
            </div>
            <?php if (isset($showFeedback)): ?>
                <div class="feedback">
                    <?php if ($isCorrect): ?>
                        <p class="correct">✅ Bonne réponse !</p>
                    <?php else: ?>
                        <p class="wrong">❌ Mauvaise réponse.</p>
                        <p>La bonne réponse était :
                            <strong>
                                <?= htmlspecialchars($currentQuestion['option_' . strtolower($currentQuestion['correct_option'])]) ?>
                            </strong>
                        </p>
                    <?php endif; ?>
                </div>

                <script>
                    setTimeout(function() {
                        window.location.href = "quiz.php?niveau=<?= urlencode($niveau) ?>&next=1";
                    }, 4000); // 3 secondes
                </script>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>