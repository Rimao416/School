<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../includes/header.php');?>
    <title>Zone Directeur</title>
</head>
<body>
    <?php include('../includes/navigation.php');?>
    <div class="container-fluid" style="margin-top:10px">
    <form id="formulaire" method="post">
  <div class="form-row">
  <div class="row">
    <div class="form-group col-md-3">
      <label id="erreur_nom_director" style="font-size: small;font-weight:bold;">Nom du directeur</label>
      <input type="text" class="form-control" id="directeur_name" placeholder="e.g Kayumba" name="directeur_name">
    </div>
    <div class="form-group col-md-3">
      <label id="erreur_post_nom" style="font-size: small;font-weight:bold;">Post Nom du Directeur</label>
      <input type="text" class="form-control" id="directeur_post_name" placeholder="e.g Babo" name="directeur_post_name">
    </div>
    <div class="form-group col-md-3">
      <label id="erreur_prenom" style="font-size: small;font-weight:bold;">Prenom du Directeur</label>
      <input type="text" class="form-control" id="directeur_surname" name="directeur_surname" placeholder="e.g Junior">
    </div>
    <div class="form-group col-md-3">
    <label id="erreur_mail" style="font-size: small;font-weight:bold;">Mail du Directeur</label>
        <input type="text" class="form-control" id="directeur_mail" name="directeur_mail" placeholder="e.g Bukasa@gmail.com">
    </div>
  </div>
  <div class="row">
  <div class="form-group col-md-3">
        <label id="erreur_ecole" style="font-size: small;font-weight:bold;">Ecole Directeur</label>
        <select class="form-select" aria-label="Activation select" name="school_director" id="school_director">
            <?php echo load_school_list($connect); ?>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for=""></label>
        <input type="hidden" value="send" name="action" id="action">
        <input type="hidden" value="0" name="school_specific" id="school_specific">
        <button type="submit" class="btn btn-primary form-control" id="Button_Envoi">Enregistrer</button>
    </div>
    
  </div>
  </div>

</form>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">Directeurs</div>
                        <div class="col-md-3" align="right">
                            <button type="button" id="add_button" class="btn btn-info btn-sm">Ajouter un directeur</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->

                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Operation de suppression</h5>
                    </div>
                    <div class="modal-body">
                        <h5>VOULEZ VOUS SUPPRIMER CE DIRECTEUR ?</h5>
                        <h6>La suppression d'un directeur entrainera la suppression de tous les acteurs liés à ce directeur</h6>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="Annuler">J'annule</button>
                        <button type="button" class="btn btn-danger" id="Confirmer">Je Confirme</button>
                    </div>
                    </div>
                </div>
                </div>
            <!--FIN MODAL DE SUPPRESSION-->
            <div class="card-body">
                <div class="table-responsive">
                <p id="message_operation"></p>
                    <table class="table table-striped table-bordered" id="directeur_fetch">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Post-nom</th>
                                <th>Prenom</th>
                                <th>Mail</th>
                                <th>Addresse de Connexion</th>
                                <th>Ecole</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
<?php include('../includes/admin_page/pages.php');?>
<script src="../public/js/directo.js"></script>
</body>
</html>