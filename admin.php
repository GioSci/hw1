<?php 
    require_once 'dbconfig.php';
    require_once 'check.php';
    if (!$cf= checkAuth()) {
        header("Location: index.php");
        exit;
    }else if($cf !== 1)
    {
        header("Location: home.php");
        exit;
    }
    $matricola=$_SESSION["matricola"];

    $error=array();

    if(!empty($_POST["anno"]))
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $anno= mysqli_real_escape_string($conn,$_POST['anno']);
        $query="SELECT * from anno_accademico where anni_accademici='$anno'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0){
            $error[]="Anno già presente";
            
        }else{
            $query="INSERT into anno_accademico (anni_accademici) values('$anno')";
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if(!$res){
                $error[]="Errore inserimento anno";
            }
        }
    }
    if(!empty($_POST["nome_facolta"]))
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $nome_facolta= mysqli_real_escape_string($conn,$_POST['nome_facolta']);
        $query="SELECT * from facoltà where nome='$nome_facolta'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(!mysqli_num_rows($res) > 0)
        {
            $query="INSERT into facoltà (nome) values('$nome_facolta')";
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if($res){
                $query="INSERT into anno_facoltà (anno, facoltà) VALUES  ((select id from anno_accademico a where id >= all(select id from anno_accademico)),(select id from facoltà where nome='$nome_facolta'))";
                $res2 = mysqli_query($conn, $query);
                if(!$res2)
                {
                    $error[]="Errore relazione ad anno accademico in corso";
                }
            }else{
                $error[] = "Errore inserimento facoltà";
            }
        }
        else {
            $error[] = "Facoltà già esistete";
        }
    }
    if(!empty($_POST["id_facolta"]))
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $id_facolta= mysqli_real_escape_string($conn,$_POST['id_facolta']);
        $query="SELECT * from insegnamento where facoltà='$id_facolta'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0)
        {
            $error[] = "Impossibile rimuovere questa facoltà perchè presenti insegnamenti";
        }else{
            $query="DELETE from anno_facoltà where facoltà='$id_facolta'";
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if($res){
                $query="DELETE from facoltà where id='$id_facolta'";
                $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if(!$res){
                    $error[] = "Erore rimuovere questa facoltà da facoltà";
                }
            }else{
                $error[] = "Erore rimuovere questa facoltà da anno_facoltà";
            }
            
        }
    }
    if(!empty($_POST["nome_insegnamento"]) && !empty($_POST["prof"]) && !empty($_POST["id_apparteneza"]))
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $nome_insegnamento= mysqli_real_escape_string($conn,$_POST['nome_insegnamento']);
        $prof= mysqli_real_escape_string($conn,$_POST['prof']);
        $id_apparteneza= mysqli_real_escape_string($conn,$_POST['id_apparteneza']);
        $query="SELECT * from insegnamento where nome='$nome_insegnamento'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0)
        {
            $error[]="Insegnamento già presente";
        }else{
            $query="INSERT INTO insegnamento (nome, prof, facoltà) VALUES ('$nome_insegnamento','$prof','$id_apparteneza')";
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if(!$res){
                $error[]="Errore inserimento insegnamento";
            };
        }
    }
    if(!empty($_POST["id_insegnamento"]))
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $id_insegnamento= mysqli_real_escape_string($conn,$_POST['id_insegnamento']);
        $query="SELECT * from partecipa where insegnamento='$id_insegnamento'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0)
        {
            $error[]="Impossibile rimuovere insegnamento perchè presente in relazione";
        }else{
            $query="DELETE from insegnamento where id='$id_insegnamento'";
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if(!$res){
            $error[]="Impossibile rimuovere insegnamento";
            };
        }
    }
?>


<head>
        <link rel="stylesheet" href="admin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav>
            <div id="grigio_chiaro"></div>
            <div id="grigio"></div>
            <div id="rosso"></div>

        </nav>

        <div id="barra_pulsanti">

            <a id="logout" href="logout.php">
                <img src="img/7.png">
                <h1>Esci</h1>
            </a>
       </div>
        
        <section>
            <header>
                <img id="img2" src="img/2.png">
                <img id="img3" src="img/3.png">
            </header>
            <?php
                             echo "<h2 class='h2blu'>MATRICOLA ADMIN N: $matricola</h2>";
            ?>
            <?php
                    if(isset($error)) {
                        foreach($error as $err) {
                            echo "<div><h2 class='h2rosso'>".$err."</h2></div>";
                        }
                    }
                ?>
            <div id="sezione_admin">
                <div class="funzioni">
                    <h1>INSERISCI ANNO</h1>
                    <form action="" method="POST">
                        <input type="text" placeholder="aaaa/aaaa" name="anno">
                        <input type="submit" value="Aggiungi">
                    </form>
                </div>
                <div class="funzioni">
                    <h1>INSERISCI FACOLTA'</h1>
                    <form action="" method="POST">
                        <input type="text" placeholder="NOME FACOLTA'" name="nome_facolta">
                        <input type="submit" value="Aggiungi">
                    </form>
                </div>
                <div class="funzioni">
                    <h1>RIMUOVI FACOLTA'</h1>
                    <form action="" method="POST">
                        <input type="text" placeholder="ID FACOLTA'" name="id_facolta">
                        <input type="submit" value="Rimuovi">
                    </form>
                </div>
                <div class="funzioni">
                    <h1>INSERISCI INSEGNAMENTO</h1>
                    <form action="" method="POST">
                        <input type="text" placeholder="NOME INSEGNAMENTO" name="nome_insegnamento">
                        <input type="text" placeholder="Prof. COGNOME" name="prof">
                        <input type="text" placeholder="FACOLTA' APPARTENENZA" name="id_apparteneza">
                        <input type="submit" value="Aggiungi">
                    </form>
                </div>
                <div class="funzioni">
                    <h1>RIMUOVI INSEGNAMENTO</h1>
                    <form action="" method="POST">
                        <input type="text" placeholder="ID INSEGNAMENTO" name="id_insegnamento">
                        <input type="submit" value="Rimuovi">
                    </form>
                </div>
            </div>
            <footer>
                <div id="div_foot">
                    <h1>AMMINISTRATORE:GIOVANNI</h1>
                    <h1>_ _ _</h1>
                </div>
                <div id="linea"></div>
            </footer>
        </section>
    </body>
</html>