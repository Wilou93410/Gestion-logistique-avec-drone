var message_valeur=document.querySelector(".information").children[1];
var serialNumber;
var valeur;

window.onload=()=>{
    valeur="Aucune valeur"
    message_valeur.innerHTML=valeur;

    // Ajouter un gestionnaire d'événements pour le bouton de téléchargement
    var downloadBtn = document.getElementById('download-btn');
    downloadBtn.addEventListener('click', function() {
        downloadQR();
    });
}

document.forms[0].onchange=()=>{
    console.log("change");
}

var qr = new QRious({
    element: document.querySelector('.qrious'),
    size: 250,
    value: valeur
});

function change(element) {
    switch (element.name) {
        case "serialNumber":
            serialNumber=element.value;
            break;
        
    }

    valeur=serialNumber;
    qr.value=valeur;
    message_valeur.innerHTML=qr.value;
}

// Fonction pour télécharger l'image QR
function downloadQR() {
    var canvas = document.querySelector('.qrious canvas');
    var url = canvas.toDataURL('image/png');
    var link = document.createElement('a');
    link.download = 'qr-code.png';
    link.href = url;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }
