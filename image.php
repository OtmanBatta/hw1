<?php 

print_r($_FILES);

if(isset($_POST['key']) && isset($_FILES['media'])){
$file = new CURLFile($_FILES['media']['tmp_name'],$_FILES['media']['type']);
$dati = array("key" => $_POST['key'], "media" => $file);

print_r($dati);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://thumbsnap.com/api/upload");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $dati);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
echo $result;
curl_close($curl);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="image.js" defer></script>
    <title>Document</title>
</head>
<body>
<form action="image.php" method="post" name="frmUpload">
<tr>
  <td>Upload</td>
  <td><input name="file" type="file" id="file"/></td>
</tr>
<tr>
  <td><input name="btnUpload" type="submit" value="Upload" /></td>
</tr>
</body>
</html>