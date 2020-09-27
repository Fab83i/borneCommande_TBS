<?php


include_once('./../includeAll.php');


// Variables requêtes bdd
$GET_PETITE_FAIM_NAME = getItemPetiteFaim();
$RETOUR_PANIER = panier();
$TOTAL_PANIER = getTotal() . " €";

$TBS = new clsTinyButStrong();
$TBS->LoadTemplate('./../petitesFaims/petiteFaim.html');
$TBS->MergeBlock("itemsPetiteFaim", $GET_PETITE_FAIM_NAME);
$TBS->MergeBlock("retourPanier", $RETOUR_PANIER);
$TBS->Show();

