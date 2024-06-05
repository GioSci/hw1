<?php
    require_once 'dbconfig.php';
    require_once 'check.php';
    if (!$cf= checkAuth()) {
        header("Location: index.php");
        exit;
    }
    $anno=$_SESSION["anno"];

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $facolta = mysqli_real_escape_string($conn, $_POST['facolta']);
    //$query="SELECT * from insegnamento where facoltà='$facolta'";
    $query="SELECT * from insegnamento where facoltà=(select facoltà from anno_facoltà where anno='$anno' and facoltà='$facolta') 
                and id <> all(select insegnamento from partecipa where utente=any(select matricola from utente where cf= '$cf') and anno='$anno')";
    $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $insegnamenti=array();
   
    while($entry = mysqli_fetch_assoc($res)) {
        $insegnamenti[] = array('id' => $entry['id'],
        'nome' => $entry['nome'], 'prof' => ($entry['prof']), 'facolta' => ($entry['facoltà']));
    }
    echo json_encode($insegnamenti);
    mysqli_free_result($res);
    mysqli_close($conn);

?>