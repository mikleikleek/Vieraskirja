<?php

require_once "../resources/config.php";

$lomake = new kommentit($mysli);

$vastaus = [];

$id = "";
$nimi = "";
$email = "";
$viesti = "";

$virhe = "";

if(!isset($_POST['id']) || !is_numeric($_POST['id'])) {

    $virhe .= "ID puuttuu jostain kumman syystä";
}

if(!isset($_POST['nimi']) || strlen($_POST['nimi']) == 0) {
    
    if(strlen($virhe) > 0) {
        
        $virhe .= "<br>Nimi puuttuu";
    }
    else {
        
        $virhe .= "Nimi puuttuu";
    }
}

if(!strpos($_POST['email'], '@') || !strpos($_POST['email'], '.') || strlen($_POST['email']) < 7) {
    
    if(strlen($virhe) > 0) {
        
        $virhe .= "<br>Sähköposti puuttuu tai on virheellinen";
    }
    else {
        
        $virhe .= "Sähköposti puuttuu tai on virheellinen";
    }
}

if(!isset($_POST['viesti']) || strlen($_POST['viesti']) == 0) {
    
    if(strlen($virhe) > 0) {
        
        $virhe .= "<br>Viesti puuttuu";
    }
    else {
        
        $virhe .= "Viesti puuttuu";
    }
}


if(!$virhe) {
    $id = $_POST['id'];
    $nimi = $_POST['nimi'];
    $email = $_POST['email'];
    $viesti = $_POST['viesti'];

    $tallennus = $lomake->uusi($id, $nimi, $email, $viesti);

        if($tallennus){
            $vastaus['success'] = 1;
            $vastaus['msg'] = 'Viestisi lähetettiin onnistuneesti';

        }
        else{
            $vastaus['success'] = 0;
            $vastaus['msg'] = 'Viestisi lähetys epäonnistui';
        }
}
else {
    $vastaus["success"] = 0;
    $vastaus["msg"] = $virhe;
}

header('Content-Type: application/json');
echo json_encode($vastaus);