<?php
use DB\DBAccess;
require_once "connessione.php"; //importo DBAccess dentro connessione.php

$paginaHTML = file_get_contents("form.html");
$connessione = new DBAccess();

$tagPermessi = '<em><strong><ul><li><span>';
$messaggiPerForm = '';

$nome = '';
$capitano = '';
$dataNascita = '';
$luogo = '';

function pulisciInput($value) { // l'ordine di queste istruzioni è fondamentale
    $value = trim($value);
    $value = strip_tags($value);
    $value = htmlentities($value);
    return $value;
}

function pulisciNote($value) {
    global $tagPermessi;

    $value = trim($value);
    $value = strip_tags($value, $tagPermessi);
    $value = htmlentities($value);
    return $value;
}

if (isset($_POST['submit'])) {
    $nome = pulisciInput($_POST['nome']);
    if (strlen($nome) == 0) {
        $messaggiPerForm .= '<li>Inserire Nome e Cognome</li>';
    }
    else {
        if (preg_match("/\d{4}\-\d{2}\-\d{2}/", $nome)) {
            $messaggiPerForm .= '<li>Nome e Cognome non possono contenere numeri</li>';
        }
    }

    $capitano = pulisciInput($_POST['capitano']);

    $dataNascita = pulisciInput($_POST['dataNascita']);
    if (strlen($dataNascita) == 0) {
        $messaggiPerForm .= '<li>Inserire Data di Nascita</li>';
    }
    else {
        if (preg_match("/\d/", $dataNascita)) {
            $messaggiPerForm .= '<li>Data di Nascita in formato non corretto</li>';
        }
    }
    // ...(tutto il resto è da fare)
}

$paginaHTML = str_replace('<messaggiForm />', $messaggiPerForm, $paginaHTML);
$paginaHTML = str_replace('<valoreNome />', $nome, $paginaHTML);
$paginaHTML = str_replace('<valData />', $dataNascita, $paginaHTML);
$paginaHTML = str_replace('<valLuogo />', $luogo, $paginaHTML)
// ... (tutto il resto è da fare)

?>