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
    <title>Gestion des parents</title>
</head>
<body>
         <?php include('../includes/navigation_director.php'); ?>
        <div class="container-fluid">

            <form id="formulaire" method="post">
            <i class="text-danger small">Les informations suivies d'un astériste sont obligatoires</i>
            <div class="form-row">
            <div class="row">
                <div class="form-group col-md-3">
                <label id="erreur_nom_parent" style="font-size: small;font-weight:bold;">Nom Parent <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" id="parent_name" placeholder="e.g Kayumba" name="parent_name">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_post_nom" style="font-size: small;font-weight:bold;">Post Nom Parent <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="parent_post_name" placeholder="e.g Babo" name="parent_post_name">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_prenom" style="font-size: small;font-weight:bold;">Prenom Parent <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="parent_surname" name="parent_surname" placeholder="e.g Junior">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_mail" style="font-size: small;font-weight:bold;">Mail Parent</label>
                    <input type="text" class="form-control" id="parent_mail" name="parent_mail" placeholder="e.g Bukasa@gmail.com">
                </div>
                <div class="form-group col-md-3">
                <label id="erreur_tel" style="font-size: small;font-weight:bold;">Tel Parent</label>
                    <input type="text" class="form-control" id="parent_tel" name="parent_tel" placeholder="+243 89456231">
                </div>


                
                <div class="form-group col-md-3" id="next">
                <label id="erreur_eleve" style="font-size: small;font-weight:bold;">Classe de l'élève <span class="text-danger">*</span></label>
                <select class="form-select" aria-label="Activation select" onchange="myChildren()" name="parent_eleve" id="parent_eleve">
                        <option value="NULL">---Choisissez la salle de votre élève---</option>
                        <?php echo load_classe_list($connect,$_SESSION['id_ecole']); ?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                <input type="checkbox" class="form-check-input" name="validation" value="yes" id="validation">
                <label class="form-check-label" id="message_valid" for="validation">J'accepte de recevoir toutes les informations concernant mon enfant</label>
                </div>
                </div>
                <div class="form-group col-md-6">   
                    <label for=""></label>
                    <input type="hidden" value="send" name="action" id="action">
                    <input type="hidden" value="0" name="parent_specific" id="parent_specific">
                    <button type="submit" class="btn btn-primary form-control" id="Button_Envoi">Enregistrer</button>
                </div>

            </div>

            </form>
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
    <table id="parent_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Nom</th>
       <th>Post Nom</th>
       <th>Prenom</th>
        <th>Mail</th>
       <th>Modifier</th>
       <th>Supprimer</th>
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
<script src="../public/js/director/parent_a.js"></script>
</body>
</html>