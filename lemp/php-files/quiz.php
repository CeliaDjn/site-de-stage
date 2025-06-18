<?php
$pdo = new PDO('mysql:host=mariadb;dbname=quizzdb;charset=utf8', 'root', 'adminmariadb');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$questions = $pdo->query('SELECT * FROM questions ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
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

  <form class="my-form" onsubmit="return false;">
    <h1>DÉBUTANT LOGIQUE</h1>
    <div id="quiz" data-questions='<?= htmlspecialchars(json_encode($questions), ENT_QUOTES, 'UTF-8') ?>'></div>
  </form>
</div>

<script src="quiz.js"></script>
</body>
</html>

