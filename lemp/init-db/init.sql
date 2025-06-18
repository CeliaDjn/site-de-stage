CREATE DATABASE IF NOT EXISTS quizzdb;
USE quizzdb;


CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question TEXT NOT NULL,
  option_a TEXT NOT NULL,
  option_b TEXT NOT NULL,
  option_c TEXT NOT NULL,
  option_d TEXT NOT NULL,
  correct_option CHAR(1) NOT NULL
);

INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct_option) VALUES
('Quelle est la capitale de la France ?', 'Paris', 'Lyon', 'Marseille', 'Toulouse', 'A'),
('Combien y a-t-il de continents ?', '5', '6', '7', '8', 'C'),
('Quelle est la couleur du ciel ?', 'Vert', 'Bleu', 'Rouge', 'Noir', 'B');
