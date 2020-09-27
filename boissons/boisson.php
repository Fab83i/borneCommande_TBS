<?php


include_once('./../includeAll.php');


// Variables requêtes bdd
$GET_BOISSON_NAME = getItemBoisson();

$RETOUR_PANIER = panier();
$TOTAL_PANIER = getTotal() . " €";

$TBS = new clsTinyButStrong();
$TBS->LoadTemplate('./../boissons/boisson.html');
$TBS->MergeBlock("itemsBoisson", $GET_BOISSON_NAME);
$TBS->MergeBlock("retourPanier", $RETOUR_PANIER);
$TBS->Show();

