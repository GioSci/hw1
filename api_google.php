<?php
    $key='AIzaSyAZpq_fcj03tlvPtQeATUXendwUIx38Tt0';

    $q=$_POST['q'];
    $url='https://www.googleapis.com/books/v1/volumes?q='.$q.'&key='.$key.'';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 0);
    $res=curl_exec($ch);
    echo $res;
?>