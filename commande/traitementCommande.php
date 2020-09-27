<?php
include_once('./../includeAll.php');

$IdSelect = $_POST['idProduct'];
$qteSelect = $_POST['qte'];
ajoutCommande($IdSelect, $qteSelect );


//print_r($_POST['idProduct']);
//print_r($_POST['qte']);

header('Location: '.$_POST['lastPage'].'');


//print_r(ajoutCommande($_POST['idProduct'], $_POST['qte']));
//print_r(isAlone('27'));
//print_r(getQte("27")+4);
//print_r('count affiche : '.count(afficheCommande()));
print_r(afficheCommande()[0]['id_produit']);
//print_r(getQte('2'));
//print_r(getTotal());
//print_r(getItemCommand('sandwich')[0]['name']);
?>
