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
                <label id="erreur_nom_student" style="font-size: small;font-weight:bold;">Nom de l'élève <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" id="student_name" placeholder="e.g Kayumba" name="student_name">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_post_nom" style="font-size: small;font-weight:bold;">Post Nom de l'élève <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="student_post_name" placeholder="e.g Babo" name="student_post_name">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_prenom" style="font-size: small;font-weight:bold;">Prenom de l'élève <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="student_surname" name="student_surname" placeholder="e.g Junior">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_mail" style="font-size: small;font-weight:bold;">Mail de l'élève</label>
                    <input type="text" class="form-control" id="student_mail" name="student_mail" placeholder="e.g Bukasa@gmail.com">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_classe" style="font-size: small;font-weight:bold;">Classe de l'élève <span class="text-danger">*</span></label>
                <select class="form-select" aria-label="Activation select" name="school_eleve" id="school_eleve">
                        <?php echo load_classe_list($connect,$_SESSION['id_ecole']); ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_habit" style="font-size: small;font-weight:bold;">Adresse Eleve</label>
                    <input type="text" class="form-control" id="student_habit" name="student_habit" placeholder="e.g Bukasa@gmail.com">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_sexe" style="font-size: small;font-weight:bold;">Sexe de l'élève <span class="text-danger">*</span></label>
                <select class="form-select" aria-label="Activation select" name="sexe_eleve" id="sexe_eleve">
                        <option value="Masculin">----------Masculin---------</option>
                        <option value="Feminin">----------Feminin---------</option>
                </select>
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_date" style="font-size: small;font-weight:bold;">Date de Naissance <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="date_eleve" name="date_eleve" placeholder="27/06/2000">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_nationalite" style="font-size: small;font-weight:bold;">Nationalité de l'élève <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="student_pays" name="student_pays" placeholder="e.g Congolaise">
                </div>
                </div>
            <div class="row">
            <div class="form-group col-md-3">
            <label for="image_eleve" class="form-label" style="font-size: small;font-weight:bold;">Image</label>
            <input class="form-control form-control-sm" id="image_eleve" name="image_eleve" type="file" />
                </div>
                <div class="form-group col-md-3">
                    <label for=""></label>
                    <input type="hidden" value="send" name="action" id="action">
                    <input type="hidden" value="0" name="eleve_specific" id="eleve_specific">
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
        <h4>VOULEZ VOUS SUPPRIMER CET ETUDIANT ?</h4>
        <h6>La suppression d'un étudiant entrainera la suppression de toutes les actions liées à cet étudiant</h6>
        
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
                        <div class="col-md-9">Zone d'inscription</div>
                        <div class="col-md-3" align="right">
                            <button type="button" id="add_button" class="btn btn-info btn-sm">Inscription</button>
                        </div>
                    </div>
                </div>
            </div>

    <br /><br />
    <table id="student_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Photo</th>
       <th>Nom</th>
       <th>Post Nom</th>
       <th>Prenom</th>
       <th>Sexe</th>
       <th>Nationalité</th>
       <th>Classe</th>
       <th>Modifier</th>
       <th>Supprimer</th>
       <th>Voir plus</th>
      </tr>
     </thead>
    </table>
    
   </div>
  </div>
    </div>
        <!-- /.container-fluid -->

     
<!--<script src="../public/js/dashboard.init.js"></script>-->
<?php include('../includes/admin_page/pages.php');?>
<script src="../public/js/director/student_a.js"></script>
</body>
</html>