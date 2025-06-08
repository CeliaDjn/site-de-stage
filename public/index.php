<?php
$pdo = new PDO('mysql:host=db;dbname=quizzdb;charset=utf8', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$questions = $pdo->query('SELECT * FROM questions ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Quizz fluide</title>
  <style>
    body { font-family: sans-serif; max-width: 600px; margin: auto; padding: 2rem; }
    .question { margin-bottom: 2rem; }
    .feedback { font-weight: bold; margin-top: 1rem; }
    button { margin-top: 1rem; }
  </style>
</head>
<body>
  <h1>Quizz instantané ...</h1>
  <div id="quiz" data-questions='<?= json_encode($questions) ?>'></div>
  <script src="script.js"></script>
</body>
</html>
