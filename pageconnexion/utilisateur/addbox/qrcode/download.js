// Récupérer l'élément HTML de l'image QR
var qrImage = document.querySelector(".qrious");

// Récupérer les données du formulaire
var formData = document.forms["form1"];

// Écouter les événements "input" des champs du formulaire
formData.addEventListener("input", function() {
  // Récupérer les données du formulaire
  var formData = new FormData(document.forms["form1"]);

  // Générer le code QR avec les données du formulaire
  var qr = new QRious({
    value: JSON.stringify(Object.fromEntries(formData)),
    size: 300
  });

  // Mettre à jour l'image QR
  qrImage.src = qr.toDataURL();
});

// Écouter l'événement "click" du bouton de téléchargement
var downloadButton = document.querySelector(".download");
downloadButton.addEventListener("click", function() {
  // Créer un lien de téléchargement avec l'image QR
  var link = document.createElement("a");
  link.download = "qr-code.png";
  link.href = qrImage.src;
  link.click();
});
