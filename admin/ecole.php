<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../includes/header.php');?>
    <title>Page d'agence</title>
</head>
<body>
    <?php include('../includes/navigation.php');?>
    <div class="container-fluid" style="margin-top:10px">
    <form id="formulaire" method="post" enctype="multipart/form-data">
  <div class="form-row">
  <div class="row">
    <div class="form-group col-md-3">
      <label id="erreur_school" style="font-size: small;font-weight:bold;">Entrez le nom de l'école</label>
      <input type="text" class="form-control" id="School_name" placeholder="Entrez le nom de l'école" name="School_name">
    </div>
    <div class="form-group col-md-3">
      <label id="erreur_ad" style="font-size: small;font-weight:bold;">Addresse de l'école</label>
      <input type="text" class="form-control" id="School_ad" placeholder="Entrez l'addresse de l'école" name="School_ad">
    </div>
    <div class="form-group col-md-3">
      <label id="erreur_mail" style="font-size: small;font-weight:bold;">Entrez un mail valide</label>
      <input type="text" class="form-control" id="School_address" name="School_address" placeholder="Mail de l'école">
    </div>
    <div class="form-group col-md-3">
    <label id="erreur_contact" style="font-size: small;font-weight:bold;">Entrez le numero</label>
        <input type="text" class="form-control" id="School_tel" name="School_tel" placeholder="Numero de l'école">
    </div>
    
  </div>

    

  <div class="row">
<!--    <div class="form-group col-md-3">
        <label for="" id="erreur_image" style="font-size: small;font-weight:bold;">Photo(jpg, png, jpeg)</label>
        <p id="imagePreview"></p>
        <input type="file" name="image_file" id="image_file">
    </div>-->
    <div class="form-group col-md-3">
        <label id="erreur_contact" style="font-size: small;font-weight:bold;">Activation</label>
        <select class="form-select" aria-label="Activation select" name="activation" id="activation">
            <option value="1">-- Oui --</option>
            <option value="0">-- Non --</option>
        </select>
    </div>
    <div class="form-group col-md-3">
            <label for="image_school" class="form-label" style="font-size: small;font-weight:bold;">Image</label>
            <input class="form-control form-control-sm" id="image_school" name="image_school" type="file" />
    </div>
    <div class="form-group col-md-3">
        <p></p> <br>
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
                        <div class="col-md-9">Ecole</div>
                        <div class="col-md-3" align="right">
                            <button type="button" id="add_button" class="btn btn-info btn-sm">Ajouter Une Ecole</button>
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
        <h4>VOULEZ VOUS SUPPRIMER CETTE ECOLE ?</h4>
        <h6>La suppression d'une école entrainera la suppression de tous les acteurs liés à cette école</h6>
        
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
                    <table class="table table-striped table-bordered" id="ecole_fetch">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom de l'école</th>
                                <th>Localisation</th>
                                <th>Addresse Mail</th>
                                <th>Numéro</th>
                                <th>Status</th>
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
<script src="../public/js/script_s.js"></script>
</body>
</html>