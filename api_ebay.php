<?php 

    $client_id =     "giovanni-MHW-PRD-7c42364b7-18f25a56";
    $client_secret = "PRD-c42364b7e9b5-4a00-4aa6-8bd0-2f1a";

    $headers = array(
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Basic '.base64_encode($client_id.':'.$client_secret).''
    );
    // ACCESS TOKEN
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.ebay.com/identity/v1/oauth2/token' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    # Eseguo la POST
    curl_setopt($ch, CURLOPT_POST, 1);
    # Setto body e header della POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&scope='https://api.ebay.com/oauth/api_scope'"); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     
    $token=json_decode(curl_exec($ch), true);
    curl_close($ch);   
    
    $access_token= $token['access_token'];       

    $query = $_POST['q'];
    $headers=array(
        'convertedFromValue: EUR',
        'Accept-Language: it-IT',
        'Authorization: Bearer '.$access_token.''
    );
    $url = 'https://api.ebay.com/buy/browse/v1/item_summary/search?q='.$query.'&category_ids=261186&limit=1&offset=0';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
?>
