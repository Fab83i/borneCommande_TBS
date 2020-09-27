<?php


include_once('./../includeAll.php');



// Variables requêtes bdd
$GET_SALADE_NAME = getItemSalade();
$RETOUR_PANIER = panier();
$TOTAL_PANIER = getTotal() . " €";

$TBS = new clsTinyButStrong();
$TBS->LoadTemplate('./../salades/salade.html');
$TBS->MergeBlock("itemsSalade", $GET_SALADE_NAME);
$TBS->MergeBlock("retourPanier", $RETOUR_PANIER);
$TBS->Show();

