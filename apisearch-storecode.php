<?php

//Database connection Module
require_once './conf/DBconnect.php';

if(isset($_GET['storecode'])) {
    $storecode = filter_input(INPUT_GET, 'storecode', FILTER_SANITIZE_STRING);
}

$query = "SELECT * FROM storeref left join plant on storeref.idPlant=plant.idPlant WHERE lower(storeref.StoreCode) LIKE lower('%$storecode%')";


if ($result = $dbcnx->query($query)) {

    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    print json_encode($rows);


//    foreach($result as $row) {
//        $data[] = array(
//            'idPlant' => $result["idPlant"],
//            'StoreCode' => $result["StoreCode"]
//        );
//    }
//    echo json_encode($data);
    $result->close();
}

$dbcnx->close();
?>