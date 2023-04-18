const eyeIconNewPsw = document.querySelector("#eye-icon-new-psw");
const newPsw = document.querySelector("#pwd");
eyeIconNewPsw.addEventListener('click', function(){
    // on verifie si l'attribut "type" du champ password est "password" on passe à la variable type la valeur "text" et "password" sinon
    const type = newPsw.getAttribute('type') === 'password' ? 'text' : 'password';
    // on set l'attribut "type" du champ password avec la valeur de la variable type défini ci-dessus
    newPsw.setAttribute('type', type);
    // on modifie l'icône pour avoir l'oeil barré en modifiant la class de l'element html
    this.classList.toggle('fa-eye-slash');
});

const eyeIconCheckPsw = document.querySelector("#eye-icon-check");
const confirmnewPsw = document.querySelector("#check");
eyeIconCheckPsw.addEventListener('click', function(){
    // on verifie si l'attribut "type" du champ password est "password" on passe à la variable type la valeur "text" et "password" sinon
    const type = confirmnewPsw.getAttribute('type') === 'password' ? 'text' : 'password';
    // on set l'attribut "type" du champ password avec la valeur de la variable type défini ci-dessus
    confirmnewPsw.setAttribute('type', type);
    // on modifie l'icône pour avoir l'oeil barré en modifiant la class de l'element html
    this.classList.toggle('fa-eye-slash');
});