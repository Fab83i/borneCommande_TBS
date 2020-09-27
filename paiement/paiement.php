<?php
include_once('./../includeAll.php');

// Variables requêtes bdd


$TBS = new clsTinyButStrong();
$TBS->LoadTemplate('./../paiement/paiement.html');
trashBag();
$TBS->Show();
