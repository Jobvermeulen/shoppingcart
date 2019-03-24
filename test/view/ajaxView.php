<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

if ((isset($_POST['functionname']) && !empty($_POST['functionname'])) && ($_POST['functionname'] == 'removeCard') && (isset($_POST['cardID']) && !empty($_POST['cardID']))) {
    $function = $_POST['functionname'];
    $cardID = $_POST['cardID'];

    $cardController = new cardController;
    $output = $cardController->$function($cardID);

    //echo the output
    echo $output;
}elseif((isset($_POST['functionname']) && !empty($_POST['functionname'])) && ($_POST['functionname'] == 'getDonateHTML')){
    $HTMLdonate = new HTMLdonate;
    $output = $HTMLdonate->returnHTML();

    echo $output;
}elseif ((isset($_POST['functionname']) && !empty($_POST['functionname'])) && ($_POST['functionname'] == 'getStationList')) {
    $function = $_POST['functionname'];

    $NS_API_Controller = new nsController;
    $stations_array[] = $NS_API_Controller->fill_Station_Array();
    //this header functions only for this echo
    header("Content-Type: application/json");
    echo json_encode ($stations_array);
}else if(((isset($_POST['functionname']) && !empty($_POST['functionname'])) && (isset($_POST['station']) && !empty($_POST['station']))) && ($_POST['functionname'] == 'getStationInfo')){
    $function = $_POST['functionname'];
    $station = $_POST['station'];

    $NS_API_Controller = new nsController;
    $DepartInfo = $NS_API_Controller->departinfoForStation($station);
    echo $DepartInfo;
}else if(((isset($_POST['functionname']) && !empty($_POST['functionname'])) && (isset($_POST['tokenwaarde']) && !empty($_POST['tokenwaarde']))) && ($_POST['functionname'] == 'checkToken')){
    $token = $_POST['tokenwaarde'];

    $wwvergetenController = new wwvergetenController('');
    $result = $wwvergetenController->checkToken($token);
    echo $result;
}else if((isset($_POST['functionname']) && !empty($_POST['functionname'])) && ($_POST['functionname'] == 'alertbox')){
    $alertbox = new alertbox;
    $output = $alertbox->returnHTML();

    echo $output;
}
else{
    $result = 'error_uploadToPHPWentWrong';
    echo $result;
}
?>