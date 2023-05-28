const form = document.querySelector("Form");
const label = document.createElement("h3");
const Values = form.querySelectorAll("input");

form.addEventListener('submit',SingUp);

function SingUp(event){
    event.preventDefault();

    label.innerHTML="";
    
    let EmptyField = false;
    let IncongruentPass = false;
    
    //Controllo campi vuoti
    for (const FieldValue of Values) {   
        if(FieldValue.value.length==0){
            EmptyField=true;
            break;
        }
    }
    
    if(EmptyField){
        label.innerHTML="Compila tutti i campi </br>";
    }

    //Controllo password riscritta correttamente
    if(document.getElementsByName("Pass")[0].value != document.getElementsByName("ConfPass")[0].value){
        IncongruentPass=true
        label.innerHTML= label.innerHTML + "Le due password non coincidono";
    }

    //eseguo fetch
    if(!EmptyField&&!IncongruentPass){ 
        const data={ method: 'post' ,body: new FormData(form)};
        fetch("http://localhost/hw1-1/SingUp.php",data).then(OnRes).then(OnText);
    }
    form.appendChild(label);
}



function OnRes(R){
    return R.text();
}

function OnText(T){
   const Risul = T;
   if(Risul.includes("Successo")){
    label.innerHTML="Registrazione avvenuta con successo. <a href=\"login.php\">Torna alla schermata di login</a>";
    for (const Input of Values) {
        Input.parentElement.classList.add("hidden");
    }
   }else{
    label.innerHTML="L'username usato e già stato utilizzato, prego di sceglierne un'altro";
   }
}