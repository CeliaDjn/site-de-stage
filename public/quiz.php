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
  <video autoplay loop muted class="background-video">
    <source src="neon.mp4" type="video/mp4">
  </video>
  <form method="POST" class="my-form">
    <h1>DÉBUTANT LOGIQUE</h1>
    <p>Qu’est-ce que tu penses de ce test ?</p>

     <div>
    <input id="check-1" type="checkbox" />
    <label for="check-1">Checkbox 1</label>
  </div>
  <div>
    <input checked="" id="check-2" type="checkbox" />
    <label for="check-2">Checkbox 2</label>
  </div>
  <div>
    <input id="check-3" type="checkbox" />
    <label for="check-3">Checkbox 3</label>
  </div>
  <div>
    <input id="check-4" type="checkbox" />
    <label for="check-4">Checkbox 4</label>
  </div>

    <button class="btn" type="submit">Valider</button>

    <?php if ($message): ?>
      <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
  </form>
</div>
  


  
</body>
</html>
