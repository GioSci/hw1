<?php
    require_once 'dbconfig.php';
    require_once 'check.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }
    

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $query="SELECT * from anno_accademico";
    $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $insegnamenti=array();
   
    while($entry = mysqli_fetch_assoc($res)) {
        $info[] = array('id' => $entry['id'],
        'anni' => $entry['anni_accademici']);
    }
    echo json_encode($info);
    mysqli_free_result($res);
    mysqli_close($conn);

?>