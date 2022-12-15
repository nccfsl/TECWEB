<?php
use DB\DBAccess;
require_once ".." . DIRECTORY_SEPARATOR . "connessione.php"; //importo DBAccess dentro connessione.php

$paginaHTML = file_get_contents("squadra.html");
$connessione = new DBAccess();
$stringaGiocatori = "";
$giocatori = "";

$connOk = $connessione->openDBConnection();

if ($connOk) {
    $giocatori = $connessione->getList();
    $connessione->closeConnection();

    if ($giocatori != null) {
        $stringaGiocatori .= '<dl id="giocatori">';

        foreach ($giocatori as $giocatore) {
            // creare i vari dt e dd
        }

        $stringaGiocatori .= '</dl>';
    }
    else {
        $stringaGiocatori = "<p>Nessun giocatore presente.</p>";
    }
}
else {
    $stringaGiocatori = "<p>I sistemi sono momentaneamente fuori servizio, ci scusiamo per il disagio.</p>";
}

echo str_replace("<listaGiocatori />", $stringaGiocatori, $paginaHTML);
?>