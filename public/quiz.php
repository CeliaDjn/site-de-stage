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
  <style>
    body {
      background-color: black;
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      color: white;
    }

    .grid-bg {
      background-image: linear-gradient(to right, #0ff 1px, transparent 1px),
                        linear-gradient(to bottom, #f0f 1px, transparent 1px);
      background-size: 50px 50px;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .quiz-box {
      background-color: #ddd;
      padding: 40px;
      border-radius: 30px;
      width: 400px;
      color: black;
      text-align: center;
      box-shadow: 0 0 20px #0ff, 0 0 20px #f0f inset;
    }

    .quiz-box h1 {
      font-family: 'Orbitron', sans-serif;
      font-size: 1.4em;
      margin-bottom: 20px;
    }

    .option {
      display: flex;
      align-items: center;
      margin: 10px 0;
      font-size: 1.1em;
    }

    .option input {
      width: 20px;
      height: 20px;
      margin-right: 10px;
      transform: scale(1.3);
    }

    .btn {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #000;
      color: #0ff;
      border: 2px solid #0ff;
      border-radius: 10px;
      cursor: pointer;
    }

    .message {
      margin-top: 20px;
      font-weight: bold;
    }
  </style>
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
