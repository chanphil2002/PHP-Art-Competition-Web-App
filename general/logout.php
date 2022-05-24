<?php
    include "condb.php";

    session_start();
    session_destroy();

    header("Location: ../general/registeredUserLogin.php");
?>