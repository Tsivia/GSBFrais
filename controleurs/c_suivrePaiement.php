<?php

/**
* controleur SuivrePaiement
*
* PHP Version 7
*
* @category  PPE
* @package   GSB
* @author   Seneor tsivia
* @author   Beth Sefer, 

*/



$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);// recupere le contenu de action
$mois = getMois(date('d/m/Y'));
switch ($action) {
case 'selectionnerVetM':
    $lesVisiteurs= $pdo->getLesVisiteurs();
    $lesCles1=array_keys($lesVisiteurs);
    $visiteurASelectionner= $lesCles1[0];
    $lesMois= $pdo->getLesMoisVA();
    $lesCles = array_keys($lesMois);
    $moisASelectionner = $lesCles[0];
    include  'vues/v_listeVisiteur.php';
    break;

case 'afficheFrais':
    $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
    $lesVisiteurs= $pdo->getLesVisiteurs();
    $visiteurASelectionner= $idVisiteur;
    $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
    $lesMois= $pdo->getLesMoisVA();
    $moisASelectionner= $leMois;

    $lesInfosFicheFrais=$pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
    
    if (!is_array($pdo->getLesInfosFicheFrais($idVisiteur, $leMois))) { 
        ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
        include 'vues/v_erreurs.php';
        include 'vues/v_listeVisiteur.php';
    } else {
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois); 
    $numAnnee = substr($leMois, 0, 4);
    $numMois = substr($leMois, 4, 2);
    $libEtat = $lesInfosFicheFrais['libEtat'];
    $montantValide = $lesInfosFicheFrais['montantValide'];
    $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
    $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
    include 'vues/v_paiement.php';
    }
    break;
    
case 'mettreEnPaiement':
  $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
  $lesVisiteurs= $pdo->getLesVisiteurs();
  $visiteurASelectionner= $idVisiteur;
  $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
  $lesMois= getLesMois($mois);
  $moisASelectionner =$leMois;
  $etat="RB";
  $pdo->majEtatFicheFrais($idVisiteur, $leMois, $etat);
   ?>
   <div class="alert alert-info" role="alert">
   <p>La fiche a bien été mise en paiement!</p>
   </div>
   <?php
  include 'vues/v_listeVisiteur.php';
  break;
 }


