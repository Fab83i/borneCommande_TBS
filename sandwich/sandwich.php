<?php

include_once('./../includeAll.php');

// Variables requêtes bdd
$GET_SANDWICH_NAME = getItemSandwich();

$RETOUR_PANIER = panier();
$TOTAL_PANIER = getTotal() . " €";

$TBS = new clsTinyButStrong();
$TBS->LoadTemplate('./../sandwich/sandwich.html');
$TBS->MergeBlock("itemsSandwich",$GET_SANDWICH_NAME);
$TBS->MergeBlock("retourPanier", $RETOUR_PANIER);
$TBS->Show();
