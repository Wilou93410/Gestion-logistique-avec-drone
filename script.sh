#!/bin/bash

# Chemin du fichier app.js
Drone="/var/www/html/projet-logistic/app.js"

# Atttente 5 minutes après le démarrage
sleep 5m

# Fonction pour lancer app.js
start_app() {
    echo "Démarrage du fichier app.js."
    # Lancement du fichier app.js avec Node.js
    node "$Drone" &
}

# Vérification toutes les 2 minutes si app.js est en cours d'exécution
while true; do
    if pgrep -f "node $Drone" >/dev/null; then
        echo "Le fichier app.js est déjà en cours d'exécution."
    else
        echo "Le fichier app.js est arrêté. Redémarrage en cours..."
        start_app
    fi
    sleep 2m
done


