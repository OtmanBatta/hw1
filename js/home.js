const sbt= document.querySelector("#SearchButton");
const SearchDiv = document.querySelector("#SearchResults");

sbt.addEventListener('click',SearchElements);

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
        const divElement = document.createElement("div");
        divElement.classList.add("Elements");
        const divElementinfo = document.createElement("div");
        divElementinfo.classList.add("ElementsInfo");
        const title = document.createElement("h1");
        const description = document.createElement("h2");
        const image = document.createElement("img");
        const user = document.createElement("h3");
        const date = document.createElement("h3");
        const GoToPage = document.createElement("form");
        GoToPage.addEventListener('submit',GoToInfoPage);

        title.innerHTML=elem['Titolo'];
        description.innerHTML=elem['Descrizione'];
        user.innerHTML="<label>Utente: "+elem['Utente']+"</label>";
        date.innerHTML="<label>Data: "+elem['Data']+"</label>";
        image.src=elem['UrlImmagine'];
        GoToPage.innerHTML="<input type=\"hidden\" name=\"IdArticolo\" value=\""+elem['ID']+"\"> <input type=\"submit\" value=\"Vai all'articolo\">";
        GoToPage.action="SingleItem.php";
        GoToPage.method='POST';

        divElementinfo.appendChild(title);
        divElementinfo.appendChild(description);
        divElement.appendChild(image);
        divElementinfo.appendChild(user);
        divElementinfo.appendChild(date);
        divElementinfo.appendChild(GoToPage);
        divElement.appendChild(divElementinfo);

        SearchDiv.appendChild(divElement);
        count++;
        }
    if(count==0){
        SearchDiv.innerHTML="<p1>Non sono stati trovati risultati</p1>";
    }
}

function GoToInfoPage(event){
}
