
<?php

    session_start();

    function checkAuth() {
        if(isset($_SESSION['cf'])) {
            if(isset($_SESSION["matricola"]))
                return 1; 
            else
            return $_SESSION['cf'];
        } else 
            return 0;
    }
?>