const submit = document.getElementById("submit");
const form = document.getElementById("form");
const name= document.getElementById("name");


form.addEventListener('submit',(e)=>{
    if(!validateInputs()){
        e.preventDefault();
    }
})


const validateInputs = () =>{

    let isValid = true;
    const nameValue = name.value.trim();

    if(nameValue === ""){
        setError(name,"Name is required");
        isValid = false;
    }
    else{
        setSuccess(name);
        
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

