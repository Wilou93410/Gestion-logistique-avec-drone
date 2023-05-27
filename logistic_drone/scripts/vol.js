const Tello = require('../../node_modules/@harleylara/tello-js/src/tello');
const db = require('../db');
const { processLastPhoto } = require('./photo');
const drone = new Tello();

// Fonction pour récupérer les coordonnées X, Y, Z et la rotation d'une zone à partir de son ID
function getZone(zoneId, callback) {
  const query = `SELECT x, y, z, rotation FROM location WHERE id_location = ${zoneId}`;
  db.query(query, (error, results) => {
    if (error) {
      console.error(error);
      callback(null);
    } else {
      const { x, y, z, rotation } = results[0];
      callback({ x, y, z, rotation });
    }
  });
}

function flyToPosition(zoneId, userId) {
  console.log(userId);
  return new Promise((resolve, reject) => {
    getZone(zoneId, (zone) => {
      if (!zone) {
        reject(new Error(`Zone ${zoneId} not found`));
        return;
      }

      drone.connect()
        .then(() => {
          return drone.sendCmd('takeoff');
        })
        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 2000));
        })
        .then(() => {
          return drone.sendCmd(`up ${zone.y}-75`);
        })
        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 4000));
        })
        .then(() => {
          return drone.sendCmd(`right ${zone.x}`);
        })
        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 6000));
        })
        .then(() => {
          return drone.sendCmd(`back ${zone.z}`);
        })
        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 8000));
        })
        .then(() => {
          return drone.sendCmd(`cw ${zone.rotation}`);
        })
        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 10000));
        })
        // ...

        .then(() => {
          return drone.getFrame();
        })

        // ...

        .then(async () => {
          const barcode = await processLastPhoto();
          console.log('Code-barres détecté :',barcode);

          // Effectuer la requête SQL pour récupérer l'ID du carton en fonction du code-barres scanné
          const query = `SELECT id_carton FROM carton WHERE REFERENCE = '${barcode}'`;
          console.log(query);
          db.query(query, (error, results) => {
            if (error) {
              console.error(error);
              return;
            }

            const cartonId = results[0].id_carton;
            console.log(cartonId);
            // Insérer les données dans la table 'scan'
            const currentDate = new Date().toISOString();
            const sql = "INSERT INTO scan (date, id_user, id_carton) VALUES (?, ?, ?)";
            const values = [currentDate, userId, cartonId];

            // Exécuter la requête SQL pour insérer le scan dans la base de données
            db.query(sql, values, (error, results) => {
              if (error) {
                console.error(error);
                return;
              }
              console.log("Scan ajouté avec succès !");
            });
          });

          return barcode;
        })

        // ...

        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 12000));
        })
        .then(() => {
          return drone.sendCmd(`ccw ${zone.rotation}`);
        })
        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 14000));
        })
        .then(() => {
          return drone.sendCmd(`forward ${zone.z}`);
        })
        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 16000));
        })
        .then(() => {
          return drone.sendCmd(`left ${zone.x}`);
        })
        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 18000));
        })
        .then(() => {
          return drone.sendCmd('land');
        })
        .then(() => {
          return new Promise(resolve => setTimeout(resolve, 20000));
        })
        .then(() => {
          resolve();
        })
        .catch((error) => {
          reject(error);
        });
    });
  });
}
module.exports = flyToPosition;
