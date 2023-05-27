const fs = require('fs');
const Jimp = require('jimp');
const { createWorker } = require('tesseract.js');
const path = require('path');

async function processLastPhoto() {
  const imagePath = path.join(__dirname, 'images'); // Chemin vers le dossier contenant les photos
  const photoFiles = fs.readdirSync(imagePath); // Liste des fichiers dans le dossier

  // Trier les fichiers par date de modification (le plus récent en premier)
  const sortedFiles = photoFiles.sort((a, b) => {
    const pathA = path.join(imagePath, a);
    const pathB = path.join(imagePath, b);
    const statA = fs.statSync(pathA);c
    const statB = fs.statSync(pathB);
    return statB.mtime.getTime() - statA.mtime.getTime();
  });

  let barcode = null; // Variable pour stocker le texte extrait du code-barres

  if (sortedFiles.length > 0) {
    const latestPhoto = sortedFiles[0]; // Prendre le fichier le plus récent
    const photoPath = path.join(imagePath, latestPhoto);

    // Charger l'image avec Jimp
    const image = await Jimp.read(photoPath);

    // Convertir l'image en noir et blanc pour améliorer la lisibilité du code-barres
    image.greyscale();

    // Enregistrer l'image modifiée
    const processedPhotoPath = path.join(imagePath, 'processed.jpg');
    await image.writeAsync(processedPhotoPath);

    // Utiliser Tesseract.js pour détecter et extraire le code-barres
    const worker = await createWorker({
      logger: m => console.log(m)
    });

    await worker.loadLanguage('eng');
    await worker.initialize('eng');
    const { data: { text: extractedText } } = await worker.recognize(processedPhotoPath);
    barcode = extractedText.replace(/\|\|/g, '').trim(); // Supprimer les caractères indésirables du code-barres
    console.log(barcode);
    await worker.terminate();

    // Supprimer les fichiers temporaires
    fs.unlinkSync(photoPath);
    fs.unlinkSync(processedPhotoPath);
  }

  return barcode; // Retourner la chaîne de caractères du code-barres (peut être null si aucune photo trouvée)
}

module.exports = {
  processLastPhoto
};
