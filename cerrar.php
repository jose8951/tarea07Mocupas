<?php
//Se recupera la session
session_start();
//Si existe login en la sesión se elimina la sesión.
if (isset($_SESSION['login'])) {
    session_destroy();
}

header("Location:index.php");
