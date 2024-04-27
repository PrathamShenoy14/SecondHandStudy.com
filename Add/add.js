const submit = document.getElementById("submit");
const form = document.getElementById("form");
const name = document.getElementById("name");
const describe = document.getElementById("describe");


form.addEventListener('submit',(e)=>{
    if(!validateInputs()){
        e.preventDefault();
    }
})


const validateInputs = () =>{

    let isValid = true;
    const describeValue = describe.value.trim();
    const nameValue = name.value.trim();

    if(nameValue === ""){
        setError(name,"Description is required");
        isValid = false;
    }
    else{
        setSuccess(name);
        
    }

    if(describeValue === ""){
        setError(describe,"Description is required");
        isValid = false;
    }
    else{
        setSuccess(describe);
        
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

