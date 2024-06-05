<?php
    require_once 'dbconfig.php';
     require_once 'check.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    if (!empty($_POST["cf"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["nome"]) && 
        !empty($_POST["cognome"]) && !empty($_POST["cPassword"]))
    {
        echo "dentro";
        $error = array();
        $conn = $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        if(!preg_match('/^[a-zA-Z0-9_]{16}$/', $_POST['cf'])) {
            $error[] = "Codice fiscale non valido";
        } else {
            $cf = mysqli_real_escape_string($conn, $_POST['cf']);
            $query = "SELECT * FROM utente WHERE cf = '$cf'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Utente già registrato già utilizzato";
            }
        }

        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 

        if (strcmp($_POST["password"], $_POST["cPassword"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM utente WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        if (count($error) == 0) {
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO utente(nome, cognome, cf, email, password) VALUES('$nome', '$cognome', '$cf', '$email', '$password')";
            $res = mysqli_query($conn, $query);

            if($res)
            {
                $query="INSERT into iscrizione (utente, anno) VALUES ((select matricola from utente where cf='$cf'), (select id from anno_accademico a where id >= all(select id from anno_accademico)))";
                $res2 = mysqli_query($conn, $query);
                if($res2)
                {
                    header("Location: index.php");
                    exit;
                }
                else{
                    $error[]="Errore iscrizione ad anno accademico in corso";
                }
            }
            else {
                $error[] = "Errore di connessione al Database";
            }
        }


    }
    else if (isset($_POST["cf"])) {
        $error = array("Riempi tutti i campi");
        echo"non entro";
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="registrazione.css">
        <script src="registrazione.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <section>
            <img src="img/2.png" alt="">
            <form action="" method="POST">
                <div  id="nome"  class="campo" >
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>>
                    <span>Campo vuoto</span>
                </div>
                <div id="cognome" class="campo">
                    <label for="cognome">Cognome</label>
                    <input  type="text" name="cognome">
                    <span>Campo vuoto</span>
                </div>
                <div id="email" class="campo">
                    <label for="email">Email</label>
                    <input type="text" name="email">
                    <span>Email non valida</span>
                </div>
                <div id="cf" class="campo">
                    <label for="cf">Codice fiscale</label>
                    <input type="text" name="cf" maxlength="16" required>
                    <span>Utente già registrato</span>
                </div>
                <div id="password" class="campo">
                    <label for="password">Password <img src="img/13.png" data-codI="1"></label>
                    <input type="password" name="password" data-codP="1">
                    <span>Password non valida</span>
                </div>
                <div id="cPassword" class="campo" >
                    <label for="cPassword">Conferma Password <img src="img/13.png" data-codI="2"></label>
                    <input type="password" name="cPassword" data-codP="2">
                    <span>Le password non coincidono</span>
                </div>
                <input type='submit' value="Registrati" id="submitReg">
            </form>
            <?php
                if(isset($error)) {
                    foreach($error as $err) {
                        echo "<div><span>".$err."</span></div>";
                    }
                }
            ?>
        </section>
    </body>
</html>