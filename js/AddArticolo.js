const form = document.querySelector("form");
const titolo = document.querySelector("#Titolo");
const descrizione = document.querySelector("#Descrizione");
const media = document.querySelector("#Media");
const div = document.querySelector("#Risultato");

form.addEventListener('submit',AggiungiArticolo);


function AggiungiArticolo(event){
    event.preventDefault();

    if(titolo.value.length<40 &&descrizione.value.length<300){
        if(titolo.value.length>0 &&descrizione.value.length>0 &&media.files[0]!=null){
            form.classList.add("hidden");
            div.innerHTML="Caricamento Dati... prego attendere";
            const data = new FormData();
    
            data.append('Titolo',titolo.value);
            data.append('Descrizione',descrizione.value);
            data.append('Media',media.files[0]);
            data.append('Data',form.querySelector("input[name=Data]").value);
            data.append('Utente',form.querySelector("input[name=Utente]").value);
    
            fetch("AddArticolo.php",{method:'POST',body:data}).then(OnR).then(OnT);
        }
        else{
            form.classList.remove("hidden");
            ShowErrore("Compila tutti i campi");
        }
    }
    else{
        ShowErrore("Limiti massimo di caratteri: Titolo max 40, Descrizione max 300");
    }
    
}

function OnR(R){
  return R.text();
}

function OnT(T){
    const message = document.createElement("span");
    message.innerHTML=T;
    div.innerHTML="";
    div.appendChild(message);
}

function ShowErrore(string){
    let MSG = document.querySelector("#Form").querySelector("h3");
    if(MSG==null){
        MSG = document.createElement("h3"); 
    }
    MSG.classList.add("Errore");
    MSG.innerHTML=string;
    document.querySelector("#Form").appendChild(MSG);
}