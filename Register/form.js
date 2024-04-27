const submit = document.getElementById("submit");
const form = document.getElementById("form");
const username = document.getElementById("user");
const email = document.getElementById("email");
const password = document.getElementById("pass");
const cPassword = document.getElementById("cPass");
const phone = document.getElementById("phone");


form.addEventListener('submit',(e)=>{
    
    if(!validateInputs()){
        e.preventDefault();
    }

})


const validateInputs = () =>{

    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const cPasswordValue = cPassword.value.trim();
    const phoneValue= phone.value.trim();
    let isValid =true;

    if(usernameValue === ""){
        setError(username,"Username is required");
        isValid = false;
    }
    else{
        setSuccess(username);
    }
    if(emailValue === ""){
        setError(email,"Email Id is required");
        isValid = false;
    }
    else if(!isValidEmail(emailValue)){
        setError(email,"Enter a valid email");
        isValid = false;
    }
    else{
        setSuccess(email);
    }
    if(phoneValue === ""){
        setError(phone,"Phone No. is required");
        isValid = false;
    }
    else if(!isValidPhone(phoneValue)){
        setError(phone,"Enter a valid Phone No.");
        isValid = false;
    }
    else{
        setSuccess(phone);
    }
    if(passwordValue === ""){
        setError(password,"Password is required");
        isValid = false;
    }
    else if(passwordValue.length<8){
        setError(password,"Password needs to atleast 8 characters");
        isValid = false;
    }
    else{
        setSuccess(password);
    }
    if(cPasswordValue === ""){
        setError(cPassword,"Please confirm your password");
        isValid = false;
    }
    else if(cPasswordValue !== passwordValue){
        setError(cPassword,"Password does not match");
        isValid = false;
    }
    else{
        setSuccess(cPassword);
        
    }
    return isValid;
}



function setError(element,message) {
    
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector(".error");
    errorDisplay.textContent = message;
    inputControl.classList.add("failure");
    inputControl.classList.remove("success");
}

function setSuccess(element) {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector(".error");
    errorDisplay.textContent ="";
    inputControl.classList.add("success");
    inputControl.classList.remove("failure")
}

function isValidEmail(emailValue) {
    const emailRegex = /^[a-zA-Z0-9._-]+@somaiya\.edu$/;
    return emailRegex.test(emailValue);
}

function isValidPhone(phoneValue) {
    const regExp = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    return regExp.test(phoneValue);
}