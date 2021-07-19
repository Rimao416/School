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
        <form action="" method="post" id="form">
            <div class="container-fluid">


                <br />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Heures & Jours</th>
                        <th scope="col">Lundi</th>
                        <th scope="col">Mardi</th>
                        <th scope="col">Mercredi</th>
                        <th scope="col">Jeudi</th>
                        <th scope="col">Vendredi</th>
                        <th scope="col">Samedi</th>
                        <th scope="col">Dimanche</th>
                        </tr>
                    </thead>
                    <tbody  id="charger">
                        <tr>
                    
                    </tbody>
                </table>


                <div class="row">
                    <div class="form-group col-md-6">
                        <label id="erreur_classe" style="font-size: small;font-weight:bold;">Classe de l'élève <span class="text-danger">*</span></label>
                        <select class="form-select" aria-label="Activation select" onchange="load_courses()" name="school_eleve" id="school_eleve">
                                <option value="0">------------Choisissez une salle------------</option>
                                <?php echo load_classe_list($connect,$_SESSION['id_ecole']); ?>
                            </select>

                    </div>

                    <div class="form-group col-md-6">
                        <label id="erreur_classe" style="font-size: small;font-weight:bold;">Soumettre l'emploi du Temps <span class="text-danger">*</span></label>
                        <input type="submit" class="form-control">
                    </div>
                </div>
            </div>
        </form>
 
  
    </div>

   
  </div>
  </div>
    </div>
        <!-- /.container-fluid -->

     
<!--<script src="../public/js/dashboard.init.js"></script>-->
<?php include('../includes/admin_page/pages.php');?>
<script src="../public/js/director/calendar_a.js"></script>
</body>
</html>