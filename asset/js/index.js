// on récupére l'élement du DOM
const zone = document.querySelector('#message');


/**
 * Fonction qui sert pour afficher un message dans la div ayant pour idetifiant "message"
 * @param {string} message 
 * @param {string} type
 */
function ecrireMessage(message, type){
    console.log(zone);
    // on modifie le contenu de l'element
    zone.innerText = message;
    // on change le style de l'element en fonction du type
    zone.style.backgroundColor = "var(--" + type + ")";
}

/**
 * Partie pour le profil
 */
// on récupére les element du DOM
const nom = document.querySelector('#name');
const email = document.querySelector('#email');

/**
 * Fonction qui prerempli les champs nom et email du formulaire
 * @param {string} name 
 * @param {string} mail 
 */
function fillFields(name, mail){
    nom.value = name;
    email.value = mail;
}