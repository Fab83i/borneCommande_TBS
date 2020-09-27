<?php

require_once("connexion.php");
function getItemDessert()
{
    $bdd = connexion::getInstance()->connect();
    $requete = 'SELECT id, name, url, price FROM desserts';
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetchAll();
    return ($result);
}

function getItemSandwich()
{
    $bdd = connexion::getInstance()->connect();
    $requete = 'SELECT id, name, url, price FROM sandwich';
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetchAll();
    return ($result);
}

function getItemSalade()
{
    $bdd = connexion::getInstance()->connect();
    $requete = 'SELECT id, name, url, price FROM salade';
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetchAll();
    return ($result);
}

function getItemPetiteFaim()
{
    $bdd = connexion::getInstance()->connect();
    $requete = 'SELECT id, name, url, price FROM petitefaim';
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetchAll();
    return ($result);
}

function getItemBoisson()
{
    $bdd = connexion::getInstance()->connect();
    $requete = 'SELECT id, name, url, price FROM boisson';
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetchAll();
    return ($result);
}



function getQuotasAllData($idAnnee)
{
    $bdd = connexion::getInstance()->connect();
    $requete = 'SELECT * FROM Quota WHERE idAnnee = "' . $idAnnee . '"';
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetchAll();
    return ($result);
}

function getLastIdCommand(){
    $bdd = connexion::getInstance()->connect();
    $requete = 'SELECT count(id_command) FROM commande';
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetch();
    return ($result);
}

function afficheCommande(){
    $bdd = connexion::getInstance()->connect();
    $requete = 'SELECT id_produit FROM commande';
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetchAll();
    return ($result);

}

function  isAlone($idProduct){
    $bool = true;
    for ($i=0; $i<count(afficheCommande()); $i++){
        if (strcmp(afficheCommande()[$i][0], $idProduct) == 0){
            $bool = false;
        }
    }
    return ($bool);
}


function getQte($idProduct){
    $bdd = connexion::getInstance()->connect();
    $requete = "SELECT SUM(Qte) FROM commande WHERE id_produit = '$idProduct'";
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetch();
    return ($result[0]);
}


function ajoutCommande($IDProductParam ,$qteParam){

    $bdd = connexion::getInstance()->connect();
    $lastIDCommand = getLastIdCommand()[0]+1;
    if (isAlone($IDProductParam)){
        $requete = $bdd ->prepare("INSERT INTO commande(id_command, id_user, id_produit, Qte) VALUES (:lastIDCommand,1,:IDProductParam ,:qteParam)");
        $requete ->bindParam(':lastIDCommand', $lastIDCommand);
        $requete ->bindParam(':IDProductParam', $IDProductParam);
        $requete ->bindParam(':qteParam', $qteParam);
        $requete->execute();
    }
    else{
        $newQte = $qteParam + getQte($IDProductParam);
        $requete = $bdd->prepare("UPDATE commande SET Qte=:qteParam WHERE id_produit = :IDProductParam");
        $requete ->bindParam(':qteParam', $newQte);
        $requete ->bindParam(':IDProductParam', $IDProductParam);
        $requete->execute();
    }
}

function getItemCommand($table){
    $bdd = connexion::getInstance()->connect();
    $requete = 'SELECT name ,Qte, price FROM commande INNER JOIN '.$table.' WHERE commande.id_produit='.$table.'.id';
    $req = $bdd->prepare($requete);
    $req->execute();
    $result = $req->fetchAll();
    return ($result);

}
function fillBasket($table){
    for ($i=0; $i<count(getItemCommand($table)); $i++){
        echo '<tr><td>'.getItemCommand($table)[$i]['name'].'</td>';
        echo '<td>'.getItemCommand($table)[$i]['Qte'].'</td>';
        echo '<td>'.getItemCommand($table)[$i]['price']*getItemCommand($table)[$i]['Qte'].' €</td>';
        echo '</tr>';
    }


}

function panier(){
    $panier = array();
    for ($i=0; $i<count(getItemCommand('boisson'));$i++){
        $panier[] = array("name"=>getItemCommand('boisson')[$i]['name'], "Qte"=>getItemCommand('boisson')[$i]['Qte'], "price"=>getItemCommand('boisson')[$i]['price']);
    }
    for ($i=0; $i<count(getItemCommand('sandwich'));$i++){
        $panier[] = array("name"=>getItemCommand('sandwich')[$i]['name'], "Qte"=>getItemCommand('sandwich')[$i]['Qte'], "price"=>getItemCommand('sandwich')[$i]['price']);
    }
    for ($i=0; $i<count(getItemCommand('petitefaim'));$i++){
        $panier[] = array("name"=>getItemCommand('petitefaim')[$i]['name'], "Qte"=>getItemCommand('petitefaim')[$i]['Qte'], "price"=>getItemCommand('petitefaim')[$i]['price']);
    }
    for ($i=0; $i<count(getItemCommand('desserts'));$i++){
        $panier[] = array("name"=>getItemCommand('desserts')[$i]['name'], "Qte"=>getItemCommand('desserts')[$i]['Qte'], "price"=>getItemCommand('desserts')[$i]['price']);
    }
    for ($i=0; $i<count(getItemCommand('salade'));$i++){
        $panier[] = array("name"=>getItemCommand('salade')[$i]['name'], "Qte"=>getItemCommand('salade')[$i]['Qte'], "price"=>getItemCommand('salade')[$i]['price']);
    }
    return ($panier);

}

function getTotal(){
    $total=0;
    $table = array("sandwich", "boisson", "petitefaim", "salade", "desserts");
    for ($i=0; $i<count($table); $i++){
        for ($j=0; $j< count(getItemCommand($table[$i]));$j++){
            $total = $total+ getItemCommand($table[$i])[$j]["price"]*getItemCommand($table[$i])[$j]["Qte"];


        }

    }
    return($total);
}

function trashBag(){
    $bdd = connexion::getInstance()->connect();
    $requete = "TRUNCATE TABLE commande";
    $req = $bdd->prepare($requete);
    $req->execute();

}
?>
