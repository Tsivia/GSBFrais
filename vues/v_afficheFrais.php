<?php

/**
* controleur affiche frais
*
* PHP Version 7
*
* @category  PPE
* @package   GSB
* @author   Seneor tsivia
* @author   Beth Sefer, 

*/

?>

<form method="post"
             action="index.php?uc=gererFrais&action=validerMajFraisForfait"
             role="form">
   
<div class="col-md-4">
       <form action="index.php?uc=validFrais&action=afficheFrais"
             method="post" role="form">
           
           <?php//liste déroulante des visiteurs?>
           
           <div class="form-group" style="display: inline-block">
               <label for="lstVisiteurs" accesskey="n">Choisir le visiteur : </label>
               <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                   <?php
                   foreach ($lesVisiteurs as $unVisiteur) {
                       $id = $unVisiteur['id'];
                       $nom = $unVisiteur['nom'];
                       $prenom = $unVisiteur['prenom'];
                       if ($id == $visiteurASelectionner) {
                           ?>
                           <option selected value="<?php echo $id ?>">
                               <?php echo $nom . ' ' . $prenom ?> </option>
                           <?php
                       } else {
                           ?>
                           <option value="<?php echo $id ?>">
                               <?php echo $nom . ' ' . $prenom ?> </option>
                           <?php
                       }
                   }
                   ?>    

               </select>
           </div>
           
           <?php//liste déroulante des mois?>
           
           &nbsp;<div class="form-group" style="display: inline-block">
               <label for="lstMois" accesskey="n">Mois : </label>
               <select id="lstMois" name="lstMois" class="form-control">
                   <?php
                   foreach ($lesMois as $unMois) {
                       $mois = $unMois['mois'];
                       $numAnnee = $unMois['numAnnee'];
                       $numMois = $unMois['numMois'];
                       if ($unMois == $moisASelectionner) {
                           ?>
                           <option selected value="<?php echo $mois ?>">
                               <?php echo $numMois . '/' . $numAnnee ?> </option>
                           <?php
                       } else {
                           ?>
                           <option value="<?php echo $mois ?>">
                               <?php echo $numMois . '/' . $numAnnee ?> </option>
                           <?php
                       }
                   }
                   ?>    

               </select>
           </div>      
</div> <br><br><br><br>

<div class="row">    
   <h2 style="color:orange">&nbsp;Valider la fiche de frais</h2>
   <h3>&nbsp;&nbsp;Eléments forfaitisés</h3>
   <div class="col-md-4">
           <fieldset>      
               <?php
               foreach ($lesFraisForfait as $unFrais) {
                   $idFrais = $unFrais['idfrais'];
                   $libelle = htmlspecialchars($unFrais['libelle']);
                   $quantite = $unFrais['quantite']; ?>
                   <div class="form-group">
                       <label for="idFrais"><?php echo $libelle ?></label>
                       <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                              size="10" maxlength="5"
                              value="<?php echo $quantite ?>"
                              class="form-control">
                   </div>
                   <?php
               }
               ?>
               <button class="btn btn-success" type="edit">Corriger</button>
               <button class="btn btn-danger" type="reset">Reinitialiser</button>
           </fieldset>
   </div>
</div>
</form>


<hr>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                    <td> <?php echo $date ?></td>
                    <td> <?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
                           onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
                </tr>
                <?php
            }
            ?>
           