CREATE DATABASE IF NOT EXISTS quizzdb;
USE quizzdb;

DROP TABLE IF EXISTS questions;

CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question TEXT NOT NULL,
  option_a TEXT NOT NULL,
  option_b TEXT NOT NULL,
  option_c TEXT NOT NULL,
  option_d TEXT NOT NULL,
  correct_option CHAR(1) NOT NULL,
  niveau ENUM('facile', 'moyen', 'difficile') NOT NULL
);

-- Questions Faciles
INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct_option, niveau) VALUES
('Si tu dors à 22h et te réveilles à 6h, combien d’heures as-tu dormi ?', '6', '7', '8', '9', 'C', 'facile'),
('Quel est l’intrus : 2, 4, 6, 9, 8 ?', '2', '4', '6', '9', 'D', 'facile'),
('Quelle couleur obtient-on en mélangeant bleu et jaune ?', 'Vert', 'Orange', 'Violet', 'Rouge', 'A', 'facile'),
('Quel jour vient après mardi ?', 'Lundi', 'Mercredi', 'Jeudi', 'Vendredi', 'B', 'facile'),
('Si un chat a 4 pattes, combien de pattes ont 3 chats ?', '8', '10', '12', '14', 'C', 'facile'),
('Combien y a-t-il de côtés dans un triangle ?', '2', '3', '4', '5', 'B', 'facile');

-- Questions Moyennes
INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct_option, niveau) VALUES
('Quel est le système d’exploitation libre le plus connu ?', 'Windows', 'Linux', 'MacOS', 'ChromeOS', 'B', 'moyen'),
('Quelle est la fonction de Alan Turing ?', 'Mathématicien', 'Physicien', 'Biologiste', 'Ingénieur', 'A', 'moyen'),
('Quel est le plus petit nombre premier ?', '0', '1', '2', '3', 'C', 'moyen'),
('Dans un triangle, combien y a-t-il de degrés en tout ?', '90°', '180°', '270°', '360°', 'B', 'moyen'),
('Quel est le langage natif du navigateur Google Chrome ?', 'Python', 'Java', 'C++', 'Go', 'C', 'moyen'),
('Combien de bits dans un octet ?', '4', '8', '16', '32', 'B', 'moyen');


-- Questions Difficiles
INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct_option, niveau) VALUES
('Quel langage Ada Lovelace a-t-elle contribué à écrire ?', 'Python', 'C', 'Langage de la machine analytique', 'FORTRAN', 'C', 'difficile'),
('Quel est le rôle de Grace Hopper dans l’histoire de l’informatique ?', 'Création de Java', 'Invention du compilateur', 'Création d’Internet', 'Création de Windows', 'B', 'difficile'),
('Quel est le nom de la structure de données utilisée dans une pile ?', 'FIFO', 'LIFO', 'HashMap', 'Tree', 'B', 'difficile'),
('Quelle est la complexité temporelle du tri rapide dans le pire des cas ?', 'O(n)', 'O(log n)', 'O(n^2)', 'O(n log n)', 'C', 'difficile'),
('Quel est l’algorithme de chiffrement utilisé dans HTTPS ?', 'AES', 'RSA', 'SHA-1', 'MD5', 'B', 'difficile'),
('Qui a prouvé le dernier théorème de Fermat ?', 'Isaac Newton', 'Andrew Wiles', 'Évariste Galois', 'Euclide', 'B', 'difficile');
