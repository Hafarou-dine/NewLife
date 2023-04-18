/* partie sur le chapm mot de passe du formulaire d'inscription */
const eyeIconInscrire = document.querySelector('#eye-icon-inscrire');
const pswInscrire = document.querySelector('#psw');
eyeIconInscrire.addEventListener('click', function(){
    // on verifie si l'attribut "type" du champ mot de passe est "password" on passe à la variable type la valeur "text" et "password" sinon
    const type = pswInscrire.getAttribute('type') === 'password' ? 'text' : 'password';
    // on set l'attribut "type" du champ mot de passe avec la valeur de la variable type défini ci-dessus
    pswInscrire.setAttribute('type', type);
    // on modifie l'icône pour avoir l'oeil barré en modifiant la class de l'element html
    this.classList.toggle('fa-eye-slash');
});


/* partie sur le champ confirmer le mot de passe du formulaire d'inscription */
const eyeIconConfirm = document.querySelector('#eye-icon-confirm');
const pswConfirm = document.querySelector('#check');
eyeIconConfirm.addEventListener('click', function(){
    // on verifie si l'attribut "type" du champ de mot de passe est "password" on passe à la variable type la valeur "text" et "password" sinon
    const type = pswConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
    // on set l'attribut "type" du champ mot de passe avec la valeur de la variable type défini ci-dessus
    pswConfirm.setAttribute('type', type);
    // on modifie l'icône pour avoir l'oeil barré en modifiant la class de l'element html
    this.classList.toggle('fa-eye-slash');
});


/* partie sur le mot de passe du formulaire de connexion */
const eyeIconConnexion = document.querySelector('#eye-icon-connexion');
const pswConnexion = document.querySelector('#password');
eyeIconConnexion.addEventListener('click', function(){
    /* on verifie si l'attribut "type" du champ mot de passe est "password" on passe à la variable 
    type la valeur "text" et "password" sinon */
    const type = pswConnexion.getAttribute('type') === 'password' ? 'text' : 'password';
    // on set l'attribut "type" du champ mot de passe avec la valeur de la variable type défini ci-dessus
    pswConnexion.setAttribute('type', type);
    // on modifie l'icône pour avoir l'oeil barré en modifiant la class de l'element html
    this.classList.toggle('fa-eye-slash');
});

