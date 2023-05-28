#!/bin/bash

# Chemin du répertoire contenant app.js
APP_DIR="$(dirname "$(readlink -f "$0")")"

# Nom du fichier app.js
APP_FILE="app.js"

# Attente de 2 minutes après le démarrage
sleep 2m

# Fonction pour lancer app.js
start_app() {
    echo "Démarrage du fichier app.js."
    # Lancement du fichier app.js avec Node.js
    node "$APP_DIR/$APP_FILE" &
}

# Lancer le fichier app.js
start_app

echo "Le fichier app.js a été lancé."
