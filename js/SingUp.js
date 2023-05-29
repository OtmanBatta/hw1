const form = document.querySelector("Form");
const label = document.createElement("h3");
const Values = form.querySelectorAll("input");
let ErrorCampo

form.addEventListener('submit',SingUp);

function SingUp(event){
    event.preventDefault();

    ErrorCampo=false;
    label.innerHTML="";
    
    let EmptyField = false;
    let IncongruentPass = false;
    let EmailMatch = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(document.getElementsByName("Email")[0].value);

    if(!EmailMatch&&document.getElementsByName("Email")[0].value.length>0){
        label.innerHTML= label.innerHTML + "Inserisci una Email valida</br>";
        ErrorCampo=true;
    }

    let PassMatch = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(document.getElementsByName("Pass")[0].value)

    if(!PassMatch&&document.getElementsByName("Pass")[0].value.length>0){
        console.log("PasswordErrata");
        label.innerHTML= label.innerHTML + "Inserisci una Password valida.</br>Deve soddisfare i seguenti requisiti </br><h5> - 1 carattere minuscolo </br> - 1 carattere maiuscolo </br> - 1 carattere numerico </br> - 1 carattere speciale (!@#$%^&*) </br> - minimo 8 caratteri </h5>";
        ErrorCampo=true;
    }

    CheckLenght(document.getElementsByName("User")[0].value,25,"L'username non puo superare i 25 caratteri");
    CheckLenght(document.getElementsByName("Nome")[0].value,20,"Il nome non puo superare i 20 caratteri");
    CheckLenght(document.getElementsByName("Cognome")[0].value,20,"Il cognome non puo superare i 20 caratteri");
    CheckLenght(document.getElementsByName("Email")[0].value,30,"L'email non puo superare i 30 caratteri");
    CheckLenght(document.getElementsByName("Pass")[0].value,20,"La password non puo superare i 20 caratteri");


    
    //Controllo campi vuoti
    for (const FieldValue of Values) {   
        if(FieldValue.value.length==0){
            EmptyField=true;
            break;
        }
    }
    
    if(EmptyField){
        label.innerHTML = label.innerHTML + "Compila tutti i campi </br>";
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
    label.innerHTML="<h2>Registrazione avvenuta con successo.</h2>";
    for (const Input of Values) {
        Input.parentElement.classList.add("hidden");
    }
    document.querySelector("body").style.height='100vh';
    document.getElementById("Registrati").id="Registrato"
   }else{
    label.innerHTML="L'username usato e già stato utilizzato, prego di sceglierne un'altro";
   }
}

function CheckLenght(string,max,Errmsg){
    if(string.length>max){
        label.innerHTML= label.innerHTML + Errmsg + "</br>";
        ErrorCampo=true;
    }
}