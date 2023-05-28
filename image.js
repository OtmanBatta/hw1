const form = document.querySelector("form");
const inputF = document.querySelector("#file");

console.log(inputF);

form.addEventListener('submit',UploadFile);


function UploadFile(event){
  event.preventDefault();

  let data = new FormData;

  data.append('media',inputF.files[0]);
  data.append('key','000439f371f21ba7e041e6dcb8e57212');

  fetch("image.php",{method:'POST',body:data}).then(onR).then(onT);
}

function onR(R){
  return R.text();
}

function onT(T){
  console.log(T);
}