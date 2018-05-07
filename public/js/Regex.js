function producePrompt(Message, promptLocation, color) {

    'use strict';

    document.getElementById(promptLocation).innerHTML = Message;
    document.getElementById(promptLocation).style.color = color;

}



function validateEmail() {

    'use strict';

    var email = document.getElementById("email").value;

    if (email.length === 0) {

        producePrompt("Email is Required", "emailPrompt", "red");


    } else if (!email.match(/^[A-Za-z0-9\._\-]+@[A-Za-z0-9]+[\.]+[a-z]{2,4}$/)) {

        producePrompt("Invalid Email", "emailPrompt", "red");



    } else {

        producePrompt("Valid Email", "emailPrompt", "green");


    }
}



function validateUsername() {
    'use strict';

    var username = document.getElementById("username").value;

    if (username.length === 0) {

        producePrompt("username is Required", "usernamePrompt", "red");
        return false;

    } else if (!username.match(/^[a-z0-9_-]{3,25}$/)) {


        producePrompt("Not valid username,Username cannot be less than 3 and more than 25", "usernamePrompt", "red");



    } else {

        producePrompt("valid username", "usernamePrompt", "green");

        return true;
    }
}



function validatePassword() {
    'use strict';


    var Password = document.getElementById("password").value;

    if (Password.length === 0) {

        producePrompt("Password is Required", "PasswordPrompt", "red");


    } else if (!Password.match(/^[a-z0-9-_+*#$%&!@]{8,}$/)) {

        producePrompt("Invalid password ,Password must be at least 8 numbers or characters", "PasswordPrompt", "red");


    } else {

        producePrompt("Valid password", "PasswordPrompt", "green");

    }
}