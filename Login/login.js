const submit = document.getElementById("submit");
const form = document.getElementById("form");
const username = document.getElementById("user");
const password = document.getElementById("pass");


form.addEventListener('submit',(e)=>{
    if(!validateInputs()){
        e.preventDefault();
    }
})


const validateInputs = () =>{

    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();

    if(usernameValue === ""){
        setError(username,"Username is required");
    }
    else{
        setSuccess(username);
    }
    if(passwordValue === ""){
        setError(password,"Password is required");
    }
    else if(passwordValue.length<8){
        setError(password,"Password needs to atleast 8 characters")
    }
    else{
        setSuccess(password);
        return true;
    }

    return false;
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

