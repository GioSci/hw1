<?php
    require_once 'dbconfig.php';
    require_once 'check.php';
    if (!$cf= checkAuth()) {
        header("Location: index.php");
        exit;
    }
    $anno=$_SESSION["anno"];

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $query="SELECT * from facoltà where id=any(select facoltà from anno_facoltà where anno= '$anno')";
    $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $insegnamenti=array();
   
    while($entry = mysqli_fetch_assoc($res)) {
        $insegnamenti[] = array('id' => $entry['id'],
        'nome' => $entry['nome']);
    }
    echo json_encode($insegnamenti);
    mysqli_free_result($res);
    mysqli_close($conn);

?>