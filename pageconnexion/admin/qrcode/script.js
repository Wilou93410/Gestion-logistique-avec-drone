var message_valeur=document.querySelector(".information").children[1];
var taille,poids,contenu,quantite,id_destination,id_fournisseur,id_provenance;
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
        case "taille":
            taille=element.value;
            break;
        case "poids":
            poids=element.value;
            break;
        case "contenu":
            contenu=element.value;
            break;
        case "quantite":
            quantite=element.value;
            break;
        case "destination":
            id_destination=element.value;
            break;
        case "fournisseur":
            id_fournisseur=element.value;
            break;
        case "provenance":
            id_provenance=element.value;
            break;
    }

    valeur=taille+'-'+poids+'-'+contenu+'-'+quantite+'-'+id_destination+'-'+id_fournisseur+'-'+id_provenance;
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
