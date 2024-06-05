<?php
    require_once 'dbconfig.php';
    require_once 'check.php';
    if (checkAuth()) {
        if(checkAuth() == 1)
            header('Location: admin.php');
        else
            header('Location: home.php');
        exit;
    }
    // Verifica l'esistenza di dati POST
    if(  isset($_POST["anno"]) && isset($_POST["cf"]) && isset($_POST["password"]))
    {
        // Connetti al database
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        // Cerca utenti con quelle credenziali
		$cf = mysqli_real_escape_string($conn,$_POST['cf']);
		$password = mysqli_real_escape_string($conn,$_POST['password']);
        $anno= mysqli_real_escape_string($conn,$_POST['anno']);

        $query = "SELECT * FROM utente WHERE cf ='$cf' AND matricola= ANY(SELECT utente FROM iscrizione WHERE anno ='$anno')";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $entry = mysqli_fetch_assoc($res);
       if(mysqli_num_rows($res) > 0)
        {
            if (password_verify($_POST['password'], $entry['password'])) {
                if($entry['tipo'] == 1){
                    $_SESSION["cf"] = $_POST["cf"];
                    $_SESSION["anno"]=$_POST["anno"];
                    $_SESSION["matricola"]=$entry["matricola"];
                    header("Location: admin.php");
                    exit;
                }else{
                $_SESSION["cf"] = $_POST["cf"];
                $_SESSION["anno"]=$_POST["anno"];
                header("Location: home.php");
                exit;
                }
            }
        }
        else
        {
            // Flag di errore
            $errore = true;
        }
    }

?>

<html>
    <head>
        <link rel="stylesheet" href="index.css">
        <script src="index.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav>
            <div id="grigio_chiaro"></div>
            <div id="grigio"></div>
            <div id="rosso"></div>

        </nav>

        <div id="barra_pulsanti">
            <a id="home" href="index.php">
                <img src="img/1.png">
                <h1>Home</h1>
            </a>
       </div>
        
        <section>
            <header>
                <img id="img2" src="img/2.png">
                <img id="img3" src="img/3.png">
            </header>

            <div id="p_centrale">
                <div id="colonna_sx">
                    <form name='acesso_utente' method='post'>
                        <div class="parti">
                            <h2 class="h2blu">ANNO ACCADEMICO</h2>
                            <select name="anno" id="anno">

                            </select>
                        </div>
                        <div class="parti">
                            <h2 class="h2blu">ACCESSO UTENTI</h2>
                            <label >NOME UTENTE</label>
                            <input class="accesso" type="text" placeholder="Codice fiscale" name='cf' maxlength="16" required>
                            <label >PASSWORD</label>
                            <input class="accesso" type="password" placeholder="PASSWORD" name='password'>
                            <?php
                                if(isset($errore))
                                {
                                    echo "<p class='errore'>Credenziali non valide.</p>";
                                }
                            ?>
                            <div id="box_bottone">
                                <input type="submit" value="entra" id="entra">
                            </div>
                            <div id="tIscrizione">Se non sei iscritto <a id="registrati" href="registrazione.php">registrati</a></div>
                        </div>
                    </form>
                    <div class="parti">
                        <h2 class="h2blu">IN EVIDENZA</h2>
                        <li><a href="">Collegamento Insegnamenti con Teams</a></li>
                        <li><a href="">Attivazione Insegnamenti</a></li>
                        <li><a href="">Portale UniCT</a></li>
                        <li><a href="">Portale Docenti</a></li>
                        <li><a href="">Portale Docenti</a></li>
                        <li><a href="">Tutorial Studenti</a></li>
                        <li><a href="">Tutorial Docenti</a></li>
                        <li><a href="">Tutorial export e import materiale didattico</a></li>
                        <li><a href="">Tutorial prenotazione</a></li>
                    </div>
                    <div id="info">
                        <h2 class="h2blu">LOGIN STUDENTI</h2>
                        <p>il login degli studenti deve avvenire con le credenziali
                             (Codice Fiscale e password) del nuovo portale studenti Smart_edu.
                              Se non è stata impostata una password, fare accesso al
                               portale studenti con SPID o CIE e impostarla tramite le impostazioni.</p>
                    </div>
                    <div class="parti">
                        <h2 class="h2blu">APP MOBILE</h2>
                        <a href=""><img class="app" src="img/5.png"></a>
                        <a href=""><img class="app" src="img/4.png"></a>
                    </div>
                </div>
                <div id="colonna_dx">
                    <h2 class="h2rosso">DIPARTIMENTI</h2>
                    <li data-telefono="1111" data-indirizzo="cit"><a href="">AGRICOLTURA, ALIMENTAZIONE E AMBIENTE (Di3A)</a></li>
                    <li data-telefono="2222" data-indirizzo="citta"><a href="">CHIRURGIA GENERALE E SPECIALITÀ MEDICO-CHIRURGICHE</a></li>
                    <li data-telefono="3333" data-indirizzo="ct"><a href="">ECONOMIA E IMPRESA</a></li>
                    <li data-telefono="4444" data-indirizzo="via"><a href="">FISICA ED ASTRONOMIA "Ettore Majorana"</a></li>
                    <li data-telefono="5555" data-indirizzo="ciao"><a href="">GIURISPRUDENZA</a></li>
                    <li data-telefono="6666" data-indirizzo="casa"><a href="">INGEGNERIA CIVILE E ARCHITETTURA (DICAR)</a></li>
                    <li data-telefono="7777" data-indirizzo="fuori"><a href="">INGEGNERIA ELETTRICA ELETTRONICA E INFORMATICA</a></li>
                    <li data-telefono="8888" data-indirizzo="pippo"><a href="">MATEMATICA E INFORMATICA</a></li>
                    <li data-telefono="9999" data-indirizzo="etnea"><a href="">MEDICINA CLINICA E SPERIMENTALE</a></li>
                    <li data-telefono="1010" data-indirizzo="etna"><a href="">SCIENZE BIOLOGICHE, GEOLOGICHE E AMBIENTALI</a></li>
                    <li data-telefono="1212" data-indirizzo="vesuvio"><a href="">SCIENZE BIOMEDICHE E BIOTECNOLOGICHE</a></li>
                    <li data-telefono="1313" data-indirizzo="cittadella"><a href="">SCIENZE CHIMICHE</a></li>
                    <li data-telefono="1414" data-indirizzo="cittadella"><a href="">SCIENZE DEL FARMACO E DELLA SALUTE</a></li>
                    <li data-telefono="1515" data-indirizzo="cittadella"><a href="">SCIENZE DELLA FORMAZIONE</a></li>
                    <li data-telefono="1616" data-indirizzo="citta"><a href="">SCIENZE MEDICHE, CHIRURGICHE E TECNOLOGIE AVANZATE G.F. INGRASSIA</a></li>
                    <li data-telefono="1717" data-indirizzo="cittadella"><a href="">SCIENZE POLITICHE E SOCIALI</a></li>
                    <li data-telefono="1818" data-indirizzo="cit"><a href="">SCIENZE UMANISTICHE</a></li>
                    <li data-telefono="1919" data-indirizzo="cit"><a href="">STRUTTURA DIDATTICA SPECIALE DI ARCHITETTURA, SEDE DECENTRATA DI SIRACUSA</a></li>
                    <div id="infoBox" class="hidden"></div>
                    <div id="button_container">
                        <button id="più_info" class="b_blu" >PIU' INFO</button>
                        <button id="cerca_libri" class="b_blu">CERCA LIBRI</button>
                    </div>
                    
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
        <div id="modal_view" class="hidden" >
            <div id="box_libri">
                <img class="back" src="img/back.png">
                <h2>Inserisci keyWord</h2>
                <form id="form1" >
                    <input id="keyWordIn" type="text" placeholder="Es.:  'Fisica'" >
                    <input type="submit" value="cerca">
                </form>
                <div id="libreria"></div>
            </div>
        </div>
    </body>
</html>