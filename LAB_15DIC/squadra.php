<?php
use DB\DBAccess;
/* require_once ".." . DIRECTORY_SEPARATOR . "connessione.php"; */ //importo DBAccess dentro connessione.php
require_once "connessione.php";

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
            $stringaGiocatori .= "<dt>" . $giocatore['nome'];
            if ($giocatore['capitano']) {
                $stringaGiocatori .= " - <em>Capitano</em>";
            }
            $stringaGiocatori .= "</dt>"
                . '<dd>'
                . '<img src="' . $giocatore['immagine'] . '" alt=""/>'
                . '<dl class="giocatore">'
                . '<dt>Data di nascita: </dt><dd>' .$giocatore['dataNascita'] . '</dd>'
                . '<dt>Luogo: </dt><dd>' . $giocatore['luogo'] . '</dd>'
                . '<dt>Squadra: </dt><dd>' . $giocatore['squadra'] . '</dd>'
                . '<dt>Ruolo: </dt><dd>' . $giocatore['ruolo'] . '</dd>'
                . '<dt>Altezza: </dt><dd>' . $giocatore['altezza'] . ' cm</dd>'
                . '<dt>Maglia: </dt><dd>' . $giocatore['maglia'] . '</dd>'
                . '<dt>Maglia in nazionale: </dt><dd>' . $giocatore['magliaNazionale'] . '</dd>';
            
            if ($giocatore['ruolo'] != 'Libero') {
                $stringaGiocatori .= '<dt>Punti totali: </dt>';
            }
            else {
                $stringaGiocatori .= '<dt>Ricezioni: </dt>';
            }
            $stringaGiocatori .= '<dt>Punti totali: </dt><dd>' . $giocatore['punti'] . '</dd>';
            if ($giocatore['riconoscimenti']) {
                $stringaGiocatori .= '<dt class="riconoscimenti">Riconoscimenti: </dt>'
                    . '<dd>' . $giocatore['riconoscimenti'] . '</dd>';
            }
            if ($giocatore['note']) {
                $stringaGiocatori .= '<dt>Note: </dt>'
                    . '<dd>' . $giocatore['note'] . '</dd>';
            }
            $stringaGiocatori .= '</dl></dd>';
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