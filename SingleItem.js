const id = document.querySelector("#ID");
const infodiv = document.querySelector("#ItemInfo");
const OfferForm = document.querySelector("#Offer");

OfferForm.addEventListener('submit',FaiOfferta);


const data = new FormData();
data.append('Id',id.value);

function Start(){
fetch("SingleItem.php",{method:'POST',body:data}).then(OnR).then(OnJ);
}

Start();

function OnR(R){
    return R.text();
}

function OnJ(J){
    const ElemResult = JSON.parse(J);
    infodiv.innerHTML="";
    for (const elem of ElemResult) {
        const divElement = document.createElement("div");
        divElement.classList.add("Elements");
        const title = document.createElement("h1");
        const description = document.createElement("h2");
        const image = document.createElement("img");
        const user = document.createElement("h3");
        const date = document.createElement("h3");
        const UserWinner = document.createElement("h3");
        const Amount = document.createElement("h3");

        title.innerHTML=elem['Titolo'];
        description.innerHTML=elem['Descrizione'];
        user.innerHTML=elem['Utente'];
        date.innerHTML=elem['Data'];
        image.src=elem['UrlImmagine'];
        if(elem['Username']==null){
        UserWinner.innerHTML="Ancora Nessuna Offerta Vincente, Affrettati!!";
        }else{
        UserWinner.innerHTML=elem['Username'];
        Amount.innerHTML=elem['Offerta']+",00€";
        }


        divElement.appendChild(title);
        divElement.appendChild(description);
        divElement.appendChild(image);
        divElement.appendChild(user);
        divElement.appendChild(date);
        divElement.appendChild(UserWinner);
        if(elem['Username']!=null){
        divElement.appendChild(Amount);
        }
        infodiv.appendChild(divElement);
    }
}

function FaiOfferta(event){
      event.preventDefault();
      const value=OfferForm.querySelector("#Amount").value
      const user=OfferForm.querySelector("#User").value;

      let isnum = /^\d+$/.test(value);

      if(value.length>0){
        if(isnum){
            const data = new FormData();
            data.append('Valore',value);
            data.append('Username',user);
            data.append('IdArticolo',id.value);
            fetch("MakeOffer.php",{method:'POST',body:data}).then(OnR).then(onOfferText);

        }else{
            ShowResult("Inserire solo valori numerici");
        }
      }else{
           ShowResult("Prego Inserire Un Valore");
      }
}

function onOfferText(T){
     ShowResult(T);
     Start();
}

function ShowResult(string){
    let Result = OfferForm.querySelector("h1");
    if(Result==null){
     Result = document.createElement("h1");
    }
    Result.innerHTML=string;
    OfferForm.appendChild(Result);
}
