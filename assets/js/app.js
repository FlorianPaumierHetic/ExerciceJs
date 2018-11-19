/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
var $ = require('jquery');


$(document).ready(function () {

    $('#btn-login').click(function () {

       let login = $('#Login').val();

       let password = $('#password').val();

       if(login !== null && login !== ""){
           if(password !== null && password !== ""){

               fetch("/logins", {
                   method: 'post',
                   headers: {
                       'Accept': 'application/json, text/plain',
                       'Content-Type': 'application/json'
                   },
                   body: JSON.stringify({
                       "login": login,
                       "password": password,
                   })
               }).then(res => res.json())
                   .then(res => {
                       console.log(res);
                       if(res.message){
                           alert(res.message);
                       }else{
                           alert("Vous êtes connu");
                       }

                   }).catch(res => {
                        console.log(res);
                        alert("Votre login ou password n'est pas correct");
                   });

           }else{
               alert("Entrez votre password");
               $('#password').addClass("border-danger");
           }
       }else{
           alert("Entrez votre Login");
           $('#Login').addClass("border-danger");
       }

    });

    $('#Login').change(function () {
        if(this.classList.contains('border-danger')){
            $(this).removeClass('border-danger');
        }
    });

    $('#password').change(function () {
        if(this.classList.contains('border-danger')){
            $(this).removeClass('border-danger');
        }
    })

});
