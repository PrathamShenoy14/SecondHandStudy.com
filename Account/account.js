const submit = document.getElementById("submit");
const form = document.getElementById("form");
const newpassword = document.getElementById("newpass");
const oldpassword = document.getElementById("oldpass");
const cPassword = document.getElementById("cPass");


form.addEventListener('submit',(e)=>{
    
    if(!validateInputs()){
        e.preventDefault();
    }

})


const validateInputs = () =>{

    const newpasswordValue = newpassword.value.trim();
    const oldpasswordValue = oldpassword.value.trim();
    const cPasswordValue = cPassword.value.trim();
    let isValid =true;

    if(oldpasswordValue === ""){
        setError(oldpassword,"Password is required");
        isValid = false;
    }
    else if(newpasswordValue.length<8){
        setError(oldpassword,"Password needs to atleast 8 characters");
        isValid = false;
    }
    else{
        setSuccess(oldpassword);
    }
    if(newpasswordValue === ""){
        setError(newpassword,"Password is required");
        isValid = false;
    }
    else if(newpasswordValue.length<8){
        setError(password,"Password needs to atleast 8 characters");
        isValid = false;
    }
    else{
        setSuccess(newpassword);
    }
    if(cPasswordValue === ""){
        setError(cPassword,"Please confirm your password");
        isValid = false;
    }
    else if(cPasswordValue !== newpasswordValue){
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
