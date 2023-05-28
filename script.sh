#!/bin/bash

# Chemin du fichier app.js
APP_PATH="/var/www/logistic_drone/app.js"

# Attente de 3 minutes après le démarrage
sleep 3m

# Fonction pour lancer app.js
start_app() {
    echo "Démarrage du fichier app.js."
    # Lancement du fichier app.js avec Node.js
    node "$APP_PATH" &
}

# Lancer le fichier app.js
start_app

echo "Le fichier app.js a été lancé."

