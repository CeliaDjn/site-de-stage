<?php
$pdo = new PDO('mysql:host=db;dbname=quizzdb;charset=utf8', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$answer = strtoupper($data['answer']);

$stmt = $pdo->prepare("SELECT correct_option FROM questions WHERE id = ?");
$stmt->execute([$id]);
$correct = strtoupper($stmt->fetchColumn());

echo json_encode([
    'correct' => $correct,
    'is_correct' => $correct === $answer
]);
