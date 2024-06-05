<?php
    require_once 'dbconfig.php';
    require_once 'check.php';
    if (!$cf= checkAuth()) {
        header("Location: index.php");
        exit;
    }
    $anno=$_SESSION["anno"];

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $query="INSERT into partecipa (utente, anno, insegnamento) values((select matricola from utente where cf ='$cf'),'$anno','$id')";

    if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
        echo json_encode(array('ok' => true));
        exit;
    }
    $insegnamenti=array();
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode(array('ok' => false));
?>