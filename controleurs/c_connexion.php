<?php
/**
* Connexion du projet GSB
*
* PHP Version 7
*
* @category  PPE
* @package   GSB
* @author   Tsivia Seneor
* @author    Beth Sefer
*/
//filtrage de la valeur de action
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
case 'demandeConnexion':
    include 'vues/v_connexion.php';
    break;
case 'valideConnexion'://verifier si login et mdp st remplis et identiques a ceux de l'utiliseur
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);//POST c ce que lutilisateur tape
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);//je recupere les valeurs entrées par le visiteur
    $visiteur = $pdo->getInfosVisiteur($login, $mdp);
    $comptable = $pdo->getInfosComptable($login, $mdp);
     if (!is_array($visiteur)&&!is_array($comptable))  {
       //!is_array veut dire n'est pas dans le tableau
       ajouterErreur('Login ou mot de passe incorrect');
       include 'vues/v_erreurs.php';//affiche
       include 'vues/v_connexion.php';
   } else {
       if (is_array($visiteur)){
       $id = $visiteur['id'];
       $nom = $visiteur['nom'];
       $prenom = $visiteur['prenom'];
       $statut='visiteur';}
       
       elseif (is_array($comptable)){
 
           $id = $comptable['id'];
           $nom = $comptable['nom'];
           $prenom = $comptable['prenom'];
           $statut='comptable';
       }
           connecter($id, $nom, $prenom,$statut);
           header('Location: index.php');
       }
   break;
default:
   include 'vues/v_connexion.php';
   break;
}
