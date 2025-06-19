<?php
$pdo = new PDO('mysql:host=mariadb;dbname=quizzdb;charset=utf8', 'root', 'adminmariadb');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$answer = strtoupper($data['answer']);
$niveau = $data['niveau'];

$stmt = $pdo->prepare("SELECT correct_option FROM questions WHERE id = ? AND niveau = ?");
$stmt->execute([$id, $niveau]);
$correct = strtoupper($stmt->fetchColumn());

echo json_encode([
    'correct' => $correct,
    'is_correct' => $correct === $answer
]);

?>