<?php
session_start();
unset($_SESSION["s_usuario"]);
unset($_SESSION["s_password"]);
session_destroy();
header("Location: ../index.php");
?>