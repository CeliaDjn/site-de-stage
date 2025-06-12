<?php
$reponse_valide = "a";
$checked = $_POST['reponse'] ?? null;
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($checked === $reponse_valide) {
        $message = "✅ Bonne réponse !";
    } else {
        $message = "❌ Mauvaise réponse !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Débutant Logique</title>
  <link rel="stylesheet" href="quiz.css">
</head>
<body>
<div class="grid-bg">
  <form method="POST" class="quiz-box">
    <h1>DÉBUTANT LOGIQUE</h1>
    <p>Qu’est-ce que tu penses de ce test ?</p>

    <div class="option">
      <input type="radio" name="reponse" value="a" id="opt1" required>
      <label for="opt1">J’aime pas</label>
    </div>
    <div class="option">
      <input type="radio" name="reponse" value="b" id="opt2">
      <label for="opt2">J’adore</label>
    </div>
    <div class="option">
      <input type="radio" name="reponse" value="c" id="opt3">
      <label for="opt3">J’adore</label>
    </div>

    <button class="btn" type="submit">Valider</button>

    <?php if ($message): ?>
      <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
  </form>
</div>
</body>
</html>
