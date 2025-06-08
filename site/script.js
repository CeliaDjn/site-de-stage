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
  hideCharacterImage();
  // Retirer l'effet de flou
  mainContent.classList.remove('blurred');
  overlay.classList.remove('active');
});

// Fermer le menu si on clique sur l'overlay
overlay.addEventListener('click', () => {
  sideMenu.classList.remove('open');
  menuBtn.classList.remove('hide');
  characterList.style.display = "none";
  hideCharacterImage();
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
    } else {
      characterList.style.display = "none";
      hideCharacterImage(); // Cacher l'image si on change d'onglet
    }
  });
});

function showCharacterList() {
  charactersUl.innerHTML = "";

  characters.forEach(name => {
    const li = document.createElement('li');
    const link = document.createElement('a');
    link.textContent = name;
    link.href = "#";

    // Image au survol
    link.addEventListener('mouseenter', () => {
      showCharacterImage(name);
    });

    link.addEventListener('mouseleave', () => {
      hideCharacterImage();
    });

    li.appendChild(link);
    charactersUl.appendChild(li);
  });

  characterList.style.display = "block";
}

function showCharacterImage(name) {
  const imageContainer = document.getElementById("character-image-container");
  const imageElement = document.getElementById("character-image");

  // Mapping des noms avec les images
  const imageMap = {
    "LINUS TORVALDS": "images/linus.png",
    "ADA LOVELACE": "images/ada.png",
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
