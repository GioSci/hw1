<?php 
    require_once 'check.php';
    if (!$cf= checkAuth()) {
        header("Location: index.php");
        exit;
    }
?>

<head>
        <link rel="stylesheet" href="insegnamenti.css">
        <script src="gestisci_insegnamenti.js" defer></script>
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
            
            <div id="pulsanti_gestione">
                <a href="insegnamenti.php"><img src="img/9.png"></a>
                <a href="facolta.php"><img src="img/10.png"></a>
            </div>
            <div id="lista_insegnamenti">
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