const User = document.querySelector("#User").value;
const DivInfo = document.querySelector("#InfoUser");
const DivArticles = document.querySelector("#UserArticles");
const DivOffers = document.querySelector("#UserOffers");

const data = new FormData;

data.append('User',User);

fetch("GetUserInfo.php",{method:'POST',body:data}).then(OnR).then(OnInfoRecieved);
fetch("GetUserArticles.php",{method:'POST',body:data}).then(OnR).then(OnArticlesRecieved);
fetch("GetUserOffers.php",{method:'POST',body:data}).then(OnR).then(OnOffersRecieved);


function OnR(R){
    return R.text();
}

function OnInfoRecieved(J){
   const Infos=JSON.parse(J);
   if(Infos.length>0){
    DivInfo.innerHTML="";
    for (const Info of Infos) {
        const User=document.createElement("div");
        const Name=document.createElement("div");
        const Surname=document.createElement("div");
        const Email=document.createElement("div");

        User.innerHTML="<h2> Username </h2> <h1>"+Info['Username']+"</h1>";
        Name.innerHTML="<h2> Nome </h2> <h1>"+Info['Nome']+"</h1>";
        Surname.innerHTML="<h2> Cognome </h2> <h1>"+Info['Cognome']+"</h1>";
        Email.innerHTML="<h2> Email </h2> <h1>"+Info['Email']+"</h1>";

        DivInfo.appendChild(User);
        DivInfo.appendChild(Name);
        DivInfo.appendChild(Surname);
        DivInfo.appendChild(Email);
    }
   }
   else{
    DivInfo.innerHTML="<h4>C'e stato un problema nel recuperare le informazioni richieste</h4>";
   }
}

function OnArticlesRecieved(J){
    const Articles=JSON.parse(J);
   if(Articles.length>0){
    DivArticles.innerHTML="";
    for (const Article of Articles) {
        const DivArticle = document.createElement("div");
        DivArticle.classList.add("Article");
        const Titolo=document.createElement("h2");
        const Data=document.createElement("h2");
        const image=document.createElement("img");

        Titolo.innerHTML="Titolo: </br>"+Article['Titolo'];
        Data.innerHTML="Data: </br>"+Article['Data'];
        image.src=Article['UrlImmagine'];

        DivArticle.appendChild(Titolo);
        DivArticle.appendChild(Data);
        DivArticle.appendChild(image);
        DivArticles.appendChild(DivArticle);
    }
   }
   else{
    DivArticles.innerHTML="<h4>Non hai ancora messo all'Asta nessun Articolo. Cosa aspetti!!</h4>";
   }
}


function OnOffersRecieved(J){
    const Offers=JSON.parse(J);
   if(Offers.length>0){
    DivOffers.innerHTML="";
    for (const Offer of Offers) {
        const DivOffer = document.createElement("div");
        DivOffer.classList.add("Offer");
        const Titolo=document.createElement("h2");
        const Offerta=document.createElement("h2");
        const image=document.createElement("img");

        Titolo.innerHTML="Titolo: </br>"+Offer['Titolo'];
        Offerta.innerHTML="La tua offerta</br>"+Offer['Offerta']+",00€";
        image.src=Offer['UrlImmagine'];

        DivOffer.appendChild(Titolo);
        DivOffer.appendChild(Offerta);
        DivOffer.appendChild(image);
        DivOffers.appendChild(DivOffer);
    }
   }
   else{
    DivOffers.innerHTML="<h4>Non hai ancora fatto nessuna offerta. Corri a cercare articoli eccezionali</h4>";
   }
}