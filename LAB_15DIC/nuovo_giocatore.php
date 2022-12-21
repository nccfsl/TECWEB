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
$altezza = '';

$squadra = '';
$maglia = '';

$ruolo = '';
$magliaNazionale = '';

$punti = '';
$riconoscimenti = '';
$note = '';

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
    // Controllo NOME
    $nome = pulisciInput($_POST['nome']);
    if (strlen($nome) == 0) {
        $messaggiPerForm .= '<li>Inserire Nome e Cognome</li>';
    }
    else {
        if (preg_match("/\d/", $nome)) {
            $messaggiPerForm .= '<li>Nome e Cognome non possono contenere numeri</li>';
        }
    }
    // Controllo CAPITANO
    $capitano = pulisciInput($_POST['capitano']);
    // Controllo DATANASCITA
    $dataNascita = pulisciInput($_POST['dataNascita']);
    if (strlen($dataNascita) == 0) {
        $messaggiPerForm .= '<li>Inserire Data di nascita</li>';
    }
    else {
        if (preg_match("/\d{4}\-\d{2}\-\d{2}/", $dataNascita)) { // regex da cambiare
            $messaggiPerForm .= '<li>Data di nascita in formato non corretto</li>';
        }
    }
    // Controllo LUOGO
    $luogo = pulisciInput($_POST['luogo']);
    if (strlen($luogo) == 0) {
        $messaggiPerForm .= '<li>Inserire Luogo di nascita</li>';
    }
    else {
        if (preg_match("/\d/", $luogo)) {
            $messaggiPerForm .= '<li>Luogo di nascita non può contenere numeri</li>';
        }
    }
    // Controllo ALTEZZA
    $altezza = pulisciInput($_POST['altezza']);
    if (strlen($altezza) == 0) {
        $messaggiPerForm .= '<li>Inserire Altezza</li>';
    }
    else {
        if (preg_match("/[A-Za-z]+/", $altezza)) {
            $messaggiPerForm .= '<li>Altezza non può contenere lettere</li>';
        }
    }
    // Controllo SQUADRA
    $squadra = pulisciInput($_POST['squadra']);
    if (strlen($squadra) == 0) {
        $messaggiPerForm .= '<li>Inserire Squadra</li>';
    }
    else {
        if (preg_match("/\W/", $squadra)) {
            $messaggiPerForm .= '<li>Squadra deve contenere solo lettere e numeri</li>';
        }
    }
    // Controllo MAGLIA
    $maglia = pulisciInput($_POST['maglia']);
    if (strlen($maglia) == 0) {
        $messaggiPerForm .= '<li>Inserire Maglia</li>';
    }
    else {
        if (preg_match("/[A-Za-z]+/", $maglia)) {
            $messaggiPerForm .= '<li>Maglia non può contenere lettere</li>';
        }
    }
    // Controllo RUOLO
    $ruolo = pulisciInput($_POST['ruolo']);
    if (strlen($ruolo) == 0) {
        $messaggiPerForm .= '<li>Inserire Ruolo</li>';
    }
    else {
        if (preg_match("/^\b(Palleggiatore|Libero|Centrale|Schiacciatore|Opposto)/", $ruolo)) {
            $messaggiPerForm .= '<li>Ruolo può essere solo: Palleggiatore, Libero, Centrale, Schiacciatore, Opposto</li>';
        }
    }
    // Controllo MAGLIANAZIONALE
    $magliaNazionale = pulisciInput($_POST['magliaNazionale']);
    if (strlen($magliaNazionale) == 0) {
        $messaggiPerForm .= '<li>Inserire Maglia in nazionale</li>';
    }
    else {
        if (preg_match("/[A-Za-z]+/", $maglia)) {
            $messaggiPerForm .= '<li>Maglia in nazionale non può contenere lettere</li>';
        }
    }
    // Controllo PUNTI/RICEZIONI
    $punti = pulisciInput($_POST['punti']);
    if (strlen($punti) == 0) {
        $messaggiPerForm .= '<li>Inserire Punti/Ricezioni</li>';
    }
    else {
        if (preg_match("/[A-Za-z]+/", $punti)) {
            $messaggiPerForm .= '<li>Punti/Ricezioni non può contenere lettere</li>';
        }
    }
    // Controllo RICONOSCIMENTI
    $riconoscimenti = pulisciNote($_POST['riconoscimenti']);
    // Controllo NOTE
    $note = pulisciNote($_POST['note']);
}

$paginaHTML = str_replace('<messaggiForm />', $messaggiPerForm, $paginaHTML);
$paginaHTML = str_replace('<valoreNome />', $nome, $paginaHTML);
$paginaHTML = str_replace('<valData />', $dataNascita, $paginaHTML);
$paginaHTML = str_replace('<valLuogo />', $luogo, $paginaHTML);
$paginaHTML = str_replace('<valoreAltezza />', $altezza, $paginaHTML);
$paginaHTML = str_replace('<valoreSquadra />', $squadra, $paginaHTML);
$paginaHTML = str_replace('<valoreMaglia />', $maglia, $paginaHTML);
$paginaHTML = str_replace('<valoreRuolo />', $ruolo, $paginaHTML);
$paginaHTML = str_replace('<valoreMagliaNazionale />', $magliaNazionale, $paginaHTML);
$paginaHTML = str_replace('<valorePunti />', $punti, $paginaHTML);
$paginaHTML = str_replace('<valoreRiconoscimenti />', $riconoscimenti, $paginaHTML);
$paginaHTML = str_replace('<valoreNote />', $note, $paginaHTML);
echo $paginaHTML;
?>