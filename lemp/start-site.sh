#!/bin/bash

# Étape 1 : Supprimer le dossier mysql-data
echo "Suppression du dossier ./mysql-data..."
rm -rf ./mysql-data

# Étape 2 : Lancer docker compose
echo "Lancement de docker compose..."
docker compose up --build -d

# Petite pause pour laisser Docker démarrer les services (adapter si besoin)
echo "Attente du démarrage des services..."
sleep 5

# Étape 3 : Ouvrir le site dans le navigateur (selon ton OS)
echo "Ouverture du site sur http://localhost:8085"

# Détection OS pour ouvrir le navigateur
if [[ "$OSTYPE" == "linux-gnu"* ]]; then
    xdg-open http://localhost:8085
elif [[ "$OSTYPE" == "darwin"* ]]; then
    open http://localhost:8085
elif [[ "$OSTYPE" == "cygwin" ]] || [[ "$OSTYPE" == "msys" ]]; then
    start http://localhost:8085
else
    echo "Système non reconnu, ouvre manuellement : http://localhost:8085"
fi
