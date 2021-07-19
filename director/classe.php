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
    <title>Classe</title>
</head>
<body>
         <?php include('../includes/navigation_director.php'); ?>
        <div class="container-fluid">

            <form id="formulaire" method="post">
            <i class="text-danger small">Les informations suivies d'un astériste sont obligatoires</i>
            <div class="form-row">
            <div class="row">
                <div class="form-group col-md-3">
                <label id="erreur_nom_classe" style="font-size: small;font-weight:bold;">Nom de la classe <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" id="classe_name" placeholder="e.g 1ière G" name="classe_name">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_titulaire" style="font-size: small;font-weight:bold;">Titulaire de la Salle <span class="text-danger">*</span></label>
                <select class="form-select" aria-label="Activation select" name="classe_titulaire" id="classe_titulaire">
                        <option value="0">-------Aucun---------</option>
                        <?= load_teacher_list($connect,$_SESSION['id_ecole']) ?>
                </select>
                </div>
                <div class="form-group col-md-3">
                    <label for=""></label>
                    <input type="hidden" value="send" name="action" id="action">
                    <input type="hidden" value="0" name="classe_specific" id="classe_specific">
                    <button type="submit" class="btn btn-primary form-control" id="Button_Envoi">Enregistrer</button>
                </div>
                </div>
            </div>

            </form>
        <div class="container box">   
   <div class="table-responsive">

    <br />
    <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">Zone de classe</div>
                        <div class="col-md-3" align="right">
                            <button type="button" id="add_button" class="btn btn-info btn-sm">Classe</button>
                        </div>
                    </div>
                </div>
            </div>

    <br /><br />
    <table id="classe_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Classe</th>
       <th>Titulaire</th>
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
<script src="../public/js/director/classe_a.js"></script>
</body>
</html>