<?php

include_once('./../includeAll.php');

// Données transmises par le formulaire

$LAST_PAGE = $_POST['lastPage'];
$ID_PRODUCT = $_POST['idProduct'];
$NAME_PRODUCT = $_POST['nameProduct'];
$URL_PRODUCT = $_POST['urlProduct'];
$PRICE_PRODUCT = $_POST['priceProduct'].' €';

$RETOUR_PANIER = panier();
$TOTAL_PANIER = getTotal() . " €";

$TBS = new clsTinyButStrong();
$TBS->LoadTemplate('./../commande/command.html');
$TBS->MergeBlock("retourPanier", $RETOUR_PANIER);
$TBS->Show();