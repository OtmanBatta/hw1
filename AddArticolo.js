const form = document.querySelector("form");
const titolo = document.querySelector("#Titolo");
const descrizione = document.querySelector("#Descrizione");
const media = document.querySelector("#Media");
const div = document.querySelector("#Risultato");

form.addEventListener('submit',AggiungiArticolo);


function AggiungiArticolo(event){
    event.preventDefault();
    form.classList.add("hidden");
    div.innerHTML="Caricamento Dati... prego attendere";
    if(titolo.value.length>0 &&descrizione.value.length>0 &&media.files[0]!=null){
        const data = new FormData();

        data.append('Titolo',titolo.value);
        data.append('Descrizione',descrizione.value);
        data.append('Media',media.files[0]);
        data.append('Data',form.querySelector("input[name=Data]").value);
        data.append('Utente',form.querySelector("input[name=Utente]").value);

        fetch("AddArticolo.php",{method:'POST',body:data}).then(OnR).then(OnT);
    }
    else{
        ShowError("Compila tutti i campi");
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

function ShowError(string){
    console.log(string);
}