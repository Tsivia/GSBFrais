<?php
/**
 * Index du projet GSB
 *
 * PHP Version 7
*
* @category  PPE
* @package   GSB
* @author   Tsivia Seneor
* @author    Beth Sefer
*/

// ce qu'on a besoin en préliminaire et une seule fois sur la page.
require_once 'includes/fct.inc.php';// reference au dossier includes page de requete
require_once 'includes/class.pdogsb.inc.php';

session_start(); // session=variable pouvant contenir plusieurs variables de types differents(variable super global)
$pdo = PdoGsb::getPdoGsb();//appel de la methode de la classe getpdogsb
$estConnecte = estConnecte();//appel de la methode de la classe fct.inc,verifie si un client est connecté ds la session et on rentre le return de la fonction
$estVisiteurConnecte= estVisiteurConnecte();
$estComptableConnecte= estComptableConnecte();
require 'vues/v_entete.php';//logo
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
if ($uc && !$estConnecte) {
    $uc = 'connexion';
} elseif (empty($uc)) {
    $uc = 'accueil';
}
switch ($uc) {
case 'connexion':
    include 'controleurs/c_connexion.php';
    break;
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'gererFrais':
    include 'controleurs/c_gererFrais.php';
    break;
case 'etatFrais':
    include 'controleurs/c_etatFrais.php';
    break;
case 'validerFrais':
    include 'controleurs/c_validerFrais.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
case 'suivrePaiement':
    include 'controleurs/c_suivrePaiement.php';
    break;
}
require 'vues/v_pied.php';
