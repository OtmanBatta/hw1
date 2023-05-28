const form = document.querySelector("Form");
const User=form.querySelector("#UserField");
const Pass=form.querySelector("#PassField");

form.addEventListener('submit',Login);

function Login(event){
    if(User.value.length>0 && Pass.value.length>0){ 
        const data={ method: 'post' ,body: new FormData(form)};
        fetch("http://localhost/hw1-1/login.php",data).then(OnR).then(OnT);
    }else{
        ShowError("Prego inserire tutti i Dati");
        event.preventDefault();
    }
    CheckField();

}

function CheckField(){
    User.classList.remove("ErrorField");
    Pass.classList.remove("ErrorField");

    if(User.value.length==0){
        User.classList.add("ErrorField");
    }

    if(Pass.value.length==0){
        Pass.classList.add("ErrorField");
    }
}

function OnR(R){
    return R.text();
}

function OnT(T){
}

function ShowError(ErrorString){
    let ErrorMSG = form.querySelector("h1");
    if(ErrorMSG==null){
        ErrorMSG=document.createElement("h1");
    }
    ErrorMSG.innerHTML=ErrorString;
    document.querySelector("#FormBorder").appendChild(ErrorMSG);
}