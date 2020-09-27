<?php

include_once('./../includeAll.php');

// Variables requêtes bdd
$GET_DESSERT_NAME = getItemDessert();
$RETOUR_PANIER = panier();
$TOTAL_PANIER = getTotal() . " €";

$TBS = new clsTinyButStrong();
$TBS->LoadTemplate('./../desserts/dessert.html');
$TBS->MergeBlock("itemsDessert", $GET_DESSERT_NAME);
$TBS->MergeBlock("retourPanier", $RETOUR_PANIER);

$TBS->Show();
