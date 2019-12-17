<?php
/**
* controleur valider frais
*
* PHP Version 7
*
* @category  PPE
* @package   GSB
* @author   Seneor tsivia
* @author   Beth Sefer, 

*/

$mois = getMois(date('d/m/Y'));
$moisPrecedent=getMoisPrecedent($mois);
$pdo->clotureFiche($moisPrecedent);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);// recupere le contenu de action
switch ($action) {
case 'selectionnerVetM':
   $lesVisiteurs=$pdo->getLesVisiteurs();
   $lesCles = array_keys($lesVisiteurs);//tableau de clés
   $visiteurASelectionner = $lesCles[0];
   $lesMois=getLesMois($mois);
   $lesCles = array_keys($lesMois);//tableau de clés
   $moisASelectionner = $lesCles[0];
   include  'vues/v_listeVisiteur.php';
   break;
case 'afficheFrais':
   $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
   $lesVisiteurs= $pdo->getLesVisiteurs();
   $visiteurASelectionner= $idVisiteur;
   $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
   $lesMois= getLesMois($mois);
   $moisASelectionner =$leMois;
   if(!is_array($mois)){
       ajouterErreur('fiche de frais non existante pour ce mois');
       include 'vues/v_erreurs.php';
   }
   $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
   $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);  
   include 'vues/v_afficheFrais.php';
   
   break;
   }
   





