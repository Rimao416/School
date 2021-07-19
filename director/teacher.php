<?php
    session_start();
    if(!isset($_SESSION['id_directeur'])){
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('../includes/header.php');?>
    <title>Page d'accueil</title>
</head>
<body>
         <?php include('../includes/navigation_director.php'); ?>
        <div class="container-fluid">

            <form id="formulaire" method="post">
            <i class="text-danger small">Les informations suivies d'un astériste sont obligatoires</i>
            <div class="form-row">
            <div class="row">
                <div class="form-group col-md-3">
                <label id="erreur_nom_prof" style="font-size: small;font-weight:bold;">Nom du professeur <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" id="prof_name" placeholder="e.g Kayumba" name="prof_name">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_post_nom" style="font-size: small;font-weight:bold;">Post Nom du prof <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="prof_post_name" placeholder="e.g Babo" name="prof_post_name">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_prenom" style="font-size: small;font-weight:bold;">Prenom du Prof <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="prof_surname" name="prof_surname" placeholder="e.g Junior">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_mail" style="font-size: small;font-weight:bold;">Mail du prof</label>
                    <input type="text" class="form-control" id="prof_mail" name="prof_mail" placeholder="e.g Bukasa@gmail.com">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_habitation" style="font-size: small;font-weight:bold;">Adresse du Prof</label>
                    <input type="text" class="form-control" id="prof_habit" name="prof_habit" placeholder="e.g Bukasa@gmail.com">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_sexe" style="font-size: small;font-weight:bold;">Sexe du professeur <span class="text-danger">*</span></label>
                <select class="form-select" aria-label="Activation select" name="sexe_prof" id="sexe_prof">
                        <option value="Masculin">----------Masculin---------</option>
                        <option value="Feminin">----------Feminin---------</option>
                </select>
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_date" style="font-size: small;font-weight:bold;">Date de Naissance <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="date_prof" name="date_prof" placeholder="27/06/2000">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_nationalite" style="font-size: small;font-weight:bold;">Nationalité du Prof <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="prof_pays" name="prof_pays" placeholder="e.g Congolaise">
                </div>
                </div>
            <div class="row">
            <div class="form-group col-md-3">
            <label for="image_prof" class="form-label" style="font-size: small;font-weight:bold;">Image</label>
            <input class="form-control form-control-sm" id="image_prof" name="image_prof" type="file" />
                </div>
                <div class="form-group col-md-3">
                    <label for=""></label>
                    <input type="hidden" value="send" name="action" id="action">
                    <input type="hidden" value="0" name="teacher_specific" id="teacher_specific">
                    <button type="submit" class="btn btn-primary form-control" id="Button_Envoi">Enregistrer</button>
                </div>
                
            </div>
            </div>

            </form>

<!-- Modal -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Operation de suppression</h5>
      </div>
      <div class="modal-body">
        <h4>VOULEZ VOUS SUPPRIMER CET ENSEIGNANT ?</h4>
        <h6>La suppression d'un enseignant entrainera la suppression de tous les acteurs et actions liés à cet enseignant</h6>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="Annuler">J'annule</button>
        <button type="button" class="btn btn-danger" id="Confirmer">Je Confirme</button>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL DE SUPPRESSION-->

        <div class="container box">   
   <div class="table-responsive">

    <br />
    <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">Zone d'ajout</div>
                        <div class="col-md-3" align="right">
                            <button type="button" id="add_button" class="btn btn-info btn-sm">Ajouter un enseignant</button>
                        </div>
                    </div>
                </div>
            </div>

    <br /><br />
    <table id="teacher_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Photo</th>
       <th>Nom</th>
       <th>Post Nom</th>
       <th>Prenom</th>
       <th>Sexe</th>
       <th>Mail</th>
       <th>Habitation</th>
       <th>Edit</th>
       <th>Delete</th>
       <th>Voir plus</th>
      </tr>
     </thead>
    </table>
    
   </div>
  </div>
 </body>
</html>

        </div>
        <!-- /.container-fluid -->

      </div> 
    </div>
<!--<script src="../public/js/dashboard.init.js"></script>-->
<?php include('../includes/admin_page/pages.php');?>
<script src="../public/js/director/teacher.js"></script>
</body>
</html>