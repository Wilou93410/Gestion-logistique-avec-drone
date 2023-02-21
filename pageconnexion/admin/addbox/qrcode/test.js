var message_valeur = document.querySelector(".information").children[1];
var taille, poids, contenu, quantite, id_destination, id_fournisseur, id_provenance;
var valeur;

// On définit une fonction qui permet de télécharger l'image du code QR
function downloadQRCode() {
  var link = document.createElement('a');
  link.download = 'qrcode.png';
  link.href = document.querySelector('.qrious canvas').toDataURL();
  link.click();
}

window.onload = () => {
  valeur = "Aucune valeur"
  message_valeur.innerHTML = valeur;
}

document.forms[0].onchange = () => {
  console.log("change");
}

var qr = new QRious({
  element: document.querySelector('.qrious'),
  size: 250,
  value: valeur
});

function change(element) {
  switch (element.name) {
    case "taille":
      taille = element.value;
      break;
    case "poids":
      poids = element.value
      break;
    case "contenu":
      contenu = element.value;
      break;
    case "quantite":
      quantite = element.value;
      break;
    case "id_destination":
      id_destination = element.value;
      break;
    case "id_fournisseur":
      id_fournisseur = element.value;
      break;
    case "id_provenance":
      id_provenance = element.value;
      break;
  }

  valeur = taille + '-' + poids + '-' + contenu + '-' + quantite + '-' + id_destination + '-' + id_fournisseur + '-' + id_provenance;
  qr.value = valeur;
  message_valeur.innerHTML = qr.value;
}

// On ajoute un bouton pour télécharger l'image du code QR
var downloadButton = document.createElement('button');
downloadButton.textContent = 'Télécharger';
downloadButton.addEventListener('click', downloadQRCode);
document.querySelector('.qrious').appendChild(downloadButton);
