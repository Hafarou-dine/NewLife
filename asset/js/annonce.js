/**
 * Fonction qui permet d'ajouter des options au select des categories
 * @param {string} text 
 * @param {string} value
 */
function addOptionCategorie(text, value){
    const select = document.getElementById("category");
    const newOption = new Option(text, value);
    select.options.add(newOption);
}


/**
 * Fonction qui permet d'ajouter des options au select des departements
 * @param {string} text 
 * @param {string} value 
 */
 function addOptionDepartement(text, value){
    const select = document.getElementById("location");
    const newOption = new Option(text, value);
    select.options.add(newOption);
}

// on récupère les élements du DOM
// const titre = document.querySelector('#title');
// const descr = document.querySelector('#desc');
// const prix = document.querySelector('#price');
// const cat = document.querySelector('#category');
// const dep = document.querySelector('#location');
// const nego = document.querySelector('#marketable');
// const livrer = document.querySelector('#delivery');
// const vendu = document.querySelector('#sold');



// /**
//  * Fonction de preremplissage du formulaire de modification d'une annonce
//  * @param {string} title 
//  * @param {string} description 
//  * @param {string} price 
//  */
// function preRemplirAnnonce(title, description, price){
//     console.log("fonction ok");
//     titre.value = title;
//     descr.value = description;
//     prix.value = price; 
// }

// /**
//  * 
//  * @param {boolean} negociable 
//  * @param {boolean} livraison 
//  * @param {boolean} vendue 
//  */
// function cases(negociable, livraison, vendue){
//     console.log("entrer dans la fonction ok");
//     negociable ? nego.setAttribute('checked', true) : nego.setAttribute('checked', false);
//     livraison ? livrer.setAttribute('checked', true) : livrer.setAttribute('checked', false);
//     vendue ? vendu.setAttribute('checked', true) : vendu.setAttribute('checked', true);
// }


