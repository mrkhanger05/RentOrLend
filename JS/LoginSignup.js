// Conatins JS fo Login and Signin Popup

// Blur effect given to the code

function LoginForm() {

    document.getElementById("Loginid").style.display = "block"
    document.getElementById("blur").style.filter = "blur(2px)"
}


function OpenSignUp() {

    document.getElementById("SignUp-btn").style.display = "block"
}




function OpenLoginForm() {

    document.getElementById("Loginid").style.display = "block"
    if (document.getElementById("Loginid").style.display = "block") {

        (document.getElementById("SignUp-btn").style.display = "none")

    }
}

function CloseLogin() {

    (document.getElementById("blur").style.filter = "none")
    document.getElementById("Loginid").style.display = "none"
}

function CloseSignUp() {
    document.getElementById("blur").style.filter = "none"
    document.getElementById("SignUp-btn").style.display = "none"

    if (document.getElementById("SignUp-btn").style.display = "none") {

        (document.getElementById("Loginid").style.display = "none")

    }

}
