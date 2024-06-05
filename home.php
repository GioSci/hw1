<?php 
    require_once 'dbconfig.php';
    require_once 'check.php';
    if (!$cf= checkAuth()) {
        header("Location: index.php");
        exit;
    }else if($cf == 1)
    {
        header("Location: admin.php");
        exit;
    }
    $anno=$_SESSION["anno"];
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $query = "SELECT anni_accademici FROM anno_accademico WHERE id='$anno'";
    $res = mysqli_query($conn, $query);
    $entry = mysqli_fetch_assoc($res);
    $anni = $entry['anni_accademici'];
    mysqli_free_result($res);
    mysqli_close($conn);
?>

<head>
        <link rel="stylesheet" href="index.css">
        <script src="home.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav>
            <div id="grigio_chiaro"></div>
            <div id="grigio"></div>
            <div id="rosso"></div>

        </nav>

        <div id="barra_pulsanti">
            <a id="home" href="home.php">
                <img src="img/1.png">
                <h1>Home</h1>
            </a>
            <a id="insegnamenti" href="insegnamenti.php">
                <img src="img/6.png">
                <h1>Insegnamenti</h1>
            </a>
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

            <div id="p_centrale">
                <div id="colonna_sx">
                    <div class="parti">
                        <?php
                             echo "<h2 class='h2blu'>$anni</h2>";
                        ?>
                    </div>
                    <div class="parti">
                        <h2 class="h2blu">UTENTE</h2>
                        <li><a href="gestisci_insegnamenti.php">Gestisci i  miei insegnamenti</a></li>
                    </div>
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