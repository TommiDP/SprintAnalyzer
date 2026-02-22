<?php

define("DBHOST", "localhost");
define("DBNAME", "sprintanalyzer_db");
define("DBUSER", "root");
define("DBPASS", "");

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if (!$connection) {
    die("Connessione fallita: " . mysqli_connect_error());
}

?>