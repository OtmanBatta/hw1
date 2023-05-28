const tbn= document.querySelector("form").querySelector("input");
const sbt= document.querySelector("#SearchButton");
const SearchDiv = document.querySelector("#SearchResults");

sbt.addEventListener('click',SearchElements);
tbn.addEventListener('click',DestroySession);

console.log(tbn);


function DestroySession(){
    fetch("LogOut.php").then(OnR).then(OnT);
}

function OnR(R){
return R.text();
}

function OnT(T){
    console.log(T);
}


function SearchElements(){

    const data = new FormData();

    data.append('SearchValue',document.querySelector("#SearchBar").value);

    fetch("SearchElements.php",{method:'POST',body:data}).then(OnR).then(onJ);

}

function onJ(J){
    const ElemResult = JSON.parse(J);
    let count=0;
    SearchDiv.innerHTML="";
    for (const elem of ElemResult) {
        if(count<10){
        const divElement = document.createElement("div");
        divElement.classList.add("Elements");
        const title = document.createElement("h1");
        const description = document.createElement("h2");
        const image = document.createElement("img");
        const user = document.createElement("h3");
        const date = document.createElement("h3");
        const id = document.createElement("span");
        const GoToPage = document.createElement("form");
        GoToPage.addEventListener('submit',GoToInfoPage);

        title.innerHTML=elem['Titolo'];
        description.innerHTML=elem['Descrizione'];
        user.innerHTML=elem['Utente'];
        date.innerHTML=elem['Data'];
        id.innerHTML=elem['ID'];
        image.src=elem['UrlImmagine'];
        GoToPage.innerHTML="<input type=\"hidden\" name=\"IdArticolo\" value=\""+elem['ID']+"\"> <input type=\"submit\" value=\"Go To Page\">";
        GoToPage.action="SingleItem.php";
        GoToPage.method='POST';

        divElement.appendChild(title);
        divElement.appendChild(description);
        divElement.appendChild(image);
        divElement.appendChild(user);
        divElement.appendChild(date);
        GoToPage.appendChild(id);
        divElement.appendChild(GoToPage);

        SearchDiv.appendChild(divElement);
        count++;
        }
    }
    if(count==0){
        SearchDiv.innerHTML="<h1>Non sono stati trovati risultati</h1>";
    }
}

function GoToInfoPage(event){
}
