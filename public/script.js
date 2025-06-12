const menuBtn = document.querySelector('.btn3');
const closeBtn = document.querySelector('.close-btn');
const sideMenu = document.getElementById('sideMenu');
const navButtons = document.querySelectorAll('.nav-btn');
const characterList = document.getElementById('character-list');
const charactersUl = document.getElementById('characters');
const mainContent = document.querySelector('.main-content');
const overlay = document.querySelector('.main-content-overlay');

// Liste de personnages
const characters = [
  "ADA LOVELACE",
  "ALAN TURING", 
  "GRACE HOPPER",
  "LINUS TORVALDS"
];

// Liste de quiz
const quizzes = [
  "QUIZ 1",
  "QUIZ 2",
  "QUIZ 3"
];

menuBtn.addEventListener('click', () => {
  sideMenu.classList.add('open');
  menuBtn.classList.add('hide');
  // Ajouter l'effet de flou
  overlay.classList.add('active');
});

closeBtn.addEventListener('click', () => {
  sideMenu.classList.remove('open');
  menuBtn.classList.remove('hide');
  characterList.style.display = "none";
  document.getElementById('quiz-list').style.display = "none";
  hideCharacterImage();
  hideQuizImage();
  // Retirer l'effet de flou
  mainContent.classList.remove('blurred');
  overlay.classList.remove('active');
});

// Fermer le menu si on clique sur l'overlay
overlay.addEventListener('click', () => {
  sideMenu.classList.remove('open');
  menuBtn.classList.remove('hide');
  characterList.style.display = "none";
  document.getElementById('quiz-list').style.display = "none";
  hideCharacterImage();
  hideQuizImage();
  mainContent.classList.remove('blurred');
  overlay.classList.remove('active');
});

navButtons.forEach(button => {
  button.addEventListener('click', () => {
    // Style actif
    navButtons.forEach(btn => btn.classList.remove('active'));
    button.classList.add('active');
    
    if (button.textContent === "Personnages") {
      showCharacterList();
      document.getElementById("contact-info").style.display = "none";
      document.getElementById('quiz-list').style.display = "none";
      hideQuizImage();
    } else if (button.textContent === "Jouer") {
      showQuizList();
      document.getElementById("contact-info").style.display = "none";
      characterList.style.display = "none";
      hideCharacterImage();
    } else if (button.textContent === "Contact") {
      document.getElementById("contact-info").style.display = "block";
      characterList.style.display = "none";
      document.getElementById('quiz-list').style.display = "none";
      hideCharacterImage();
      hideQuizImage();
    } else {
      characterList.style.display = "none";
      document.getElementById('quiz-list').style.display = "none";
      document.getElementById("contact-info").style.display = "none";
      hideCharacterImage();
      hideQuizImage();
    }
  });
});

function showCharacterList() {
  charactersUl.innerHTML = "";
  
  characters.forEach(name => {
    const li = document.createElement('li');
    const link = document.createElement('a');
    
    // Normalise le nom pour créer un ID propre
    const id = name.toLowerCase().replace(/\s+/g, '-'); // ex: "Alan Turing" -> "alan-turing"
    link.href = `#${id}`;
    link.textContent = name;

    // Hover image pour les personnages
    link.addEventListener('mouseenter', () => showCharacterImage(name));
    link.addEventListener('mouseleave', hideCharacterImage);
    link.addEventListener('click', (e) => {
      // Fermer le menu après le clic
      sideMenu.classList.remove('open');
      menuBtn.classList.remove('hide');
      overlay.classList.remove('active');
      mainContent.classList.remove('blurred');
      characterList.style.display = "none";
      hideCharacterImage();
    });

    li.appendChild(link);
    charactersUl.appendChild(li);
  });
  
  characterList.style.display = "block";
}

function showQuizList() {
  const quizUl = document.getElementById('quizzes');
  quizUl.innerHTML = "";

  quizzes.forEach(name => {
    const li = document.createElement('li');
    const link = document.createElement('a');

    const quizNumber = name.split(' ')[1]; // Extrait "1" de "QUIZ 1"
    link.href = 'quiz.php';
    link.textContent = name;

    // Si tu veux des effets visuels au survol, tu peux les réactiver :
    // link.addEventListener('mouseenter', () => showQuizImage(name));
    // link.addEventListener('mouseleave', hideQuizImage);

    li.appendChild(link);
    quizUl.appendChild(li);
  });

  // Affiche une image fixe (cerveau)
  const imageContainer = document.getElementById("quiz-image-container");
  const imageElement = document.getElementById("quiz-image");

  imageElement.src = "images/brain.png";
  imageContainer.classList.add('show');

  // Affiche la section contenant la liste
  document.getElementById('quiz-list').style.display = "block";
}

function showCharacterImage(name) {
  const imageContainer = document.getElementById("character-image-container");
  const imageElement = document.getElementById("character-image");
  
  // Mapping des noms avec les images
  const imageMap = {
    "LINUS TORVALDS": "images/linus.png",
    "ADA LOVELACE": "images/ada.jpeg", 
    "ALAN TURING": "images/alan.png",
    "GRACE HOPPER": "images/grace.png"
  };
  
  console.log("Tentative d'affichage de l'image pour:", name); // Debug
  
  if (imageMap[name]) {
    imageElement.src = imageMap[name];
    imageContainer.classList.add('show');
    console.log("Image chargée:", imageMap[name]); // Debug
  } else {
    console.log("Aucune image trouvée pour:", name); // Debug
  }
}

function hideCharacterImage() {
  const imageContainer = document.getElementById("character-image-container");
  const imageElement = document.getElementById("character-image");
  
  imageContainer.classList.remove('show');
  // Petit délai avant de vider le src pour une transition plus fluide
  setTimeout(() => {
    if (!imageContainer.classList.contains('show')) {
      imageElement.src = "";
    }
  }, 300);
}

function showQuizImage(name) {
  const imageContainer = document.getElementById("quiz-image-container");
  const imageElement = document.getElementById("quiz-image");
  
  // Mapping des noms avec les images de quiz
  const imageMap = {
    "QUIZ 1": "images/quiz1.png",
    "QUIZ 2": "images/quiz2.png", 
    "QUIZ 3": "images/quiz3.png"
  };
  
  console.log("Tentative d'affichage de l'image quiz pour:", name); // Debug
  
  if (imageMap[name]) {
    imageElement.src = imageMap[name];
    imageContainer.classList.add('show');
    console.log("Image quiz chargée:", imageMap[name]); // Debug
  } else {
    console.log("Aucune image quiz trouvée pour:", name); // Debug
  }
}

function hideQuizImage() {
  const imageContainer = document.getElementById("quiz-image-container");
  const imageElement = document.getElementById("quiz-image");
  
  imageContainer.classList.remove('show');
  // Petit délai avant de vider le src pour une transition plus fluide
  setTimeout(() => {
    if (!imageContainer.classList.contains('show')) {
      imageElement.src = "";
    }
  }, 300);
}