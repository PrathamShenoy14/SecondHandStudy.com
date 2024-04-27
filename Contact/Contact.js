const submit = document.getElementById("submit");
const form = document.getElementById("form");
const query = document.getElementById("query");


form.addEventListener('submit',(e)=>{
    if(!validateInputs()){
        e.preventDefault();
    }
})


const validateInputs = () =>{

    let isValid = true;
    const queryValue = query.value.trim();

    if(queryValue === ""){
        setError(query,"Description is required");
        isValid = false;
    }
    else{
        setSuccess(query);
        
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

