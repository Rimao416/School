<?php
    include('../../database.php');
    session_start();
    if(isset($_POST['action'])){
        if($_POST['action']=='send' || $_POST['action']=='modifier'){
            $nom_prof=$_POST['prof_name'];
            $postnom_prof=$_POST['prof_post_name'];
            $prenom_prof=$_POST['prof_surname'];
            $mail_prof=$_POST['prof_mail'];
            $habit_prof=$_POST['prof_habit'];
            $sexe_prof=$_POST['sexe_prof'];
            $date_prof=$_POST['date_prof'];
            $pays_prof=$_POST['prof_pays'];
            $teacher_specific=$_POST['teacher_specific'];
            //Addresse de connexion
            $addresse=$nom_prof.$postnom_prof.get_school_name_with_id($connect,$_SESSION['id_ecole']).'@ecole.com';
            //Mot de passe
            $mot_de_passe=$nom_prof.$postnom_prof.get_school_name_with_id($connect,$_SESSION['id_ecole']).'+'.date('Y');
            $image = '';
            
            if($_POST['action']=='send'){
                if($_FILES["image_prof"]["name"] != '')
                {
                $image = upload_image();
                echo $image;
                }else{
                    $image='defaut.jpg';
                }
                if(!empty($mail_prof)){
                    send_teacher_mail('university@gmail.com',$mail_prof,$nom_prof,$addresse,$mot_de_passe);
                }

                $statement = $connect->prepare("INSERT INTO professeur (nom_professeur, postnom_professeur, prenom_professeur,sexe,habit_professeur,mail_professeur,pays_professeur,date_professeur,professeur_image,connexion_professeur,motdepasse_professeur,id_ecole) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?)
               ");
               $result = $statement->execute(array($nom_prof,$postnom_prof,$prenom_prof,$sexe_prof,$habit_prof,$mail_prof,$pays_prof,$date_prof,$image,$addresse,password_hash($mot_de_passe,PASSWORD_DEFAULT),$_SESSION['id_ecole']));
               $output = array(
                'error'     => false,
                'message' => 'Le professeur a bel et bien été ajouté'
               );

            }elseif($_POST['action']=='modifier'){
                if($_FILES["image_prof"]["name"]!=''){
                    $image=upload_image();
                }else{
                    $image=load_teacher_image($connect,$teacher_specific);
                }
                if(!empty($mail_prof)){
                    send_teacher_mail('university@gmail.com',$mail_prof,$nom_prof,$addresse,$mot_de_passe);
                }
                $statement=$connect->prepare("UPDATE professeur SET nom_professeur=?, postnom_professeur=?, prenom_professeur=?,sexe=?,habit_professeur=?,mail_professeur=?,pays_professeur=?,date_professeur=?,professeur_image=?,connexion_professeur=?,motdepasse_professeur=? WHERE professeur_id=?");
                $statement->execute(array($nom_prof,$postnom_prof,$prenom_prof,$sexe_prof,$habit_prof,$mail_prof,$pays_prof,$date_prof,$image,$addresse,password_hash($mot_de_passe,PASSWORD_DEFAULT),$teacher_specific));
                $output = array(
            'update'=>true,
            'info'=>'Mise à jour réussie'
           );
        
            }
            echo json_encode($output);

        }
        if($_POST['action']=='fetch'){
                $query = '';
                $output = array();
                $query .= "SELECT * FROM professeur ";
                if(isset($_POST["search"]["value"]))
                {
                    $query .= 'WHERE id_ecole='.$_SESSION["id_ecole"].' AND (nom_professeur LIKE "%'.$_POST["search"]["value"].'%" 
                    OR postnom_professeur LIKE "%'.$_POST["search"]["value"].'%" 
                    OR prenom_professeur LIKE "%'.$_POST["search"]["value"].'%"
                    OR sexe LIKE "%'.$_POST["search"]["value"].'%"
                    OR habit_professeur LIKE "%'.$_POST["search"]["value"].'%"
                    OR mail_professeur LIKE "%'.$_POST["search"]["value"].'%"
                    OR date_professeur LIKE "%'.$_POST["search"]["value"].'%") ';
                }
                if(isset($_POST["order"]))
                {
                    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
                }
                else
                {
                    $query .= 'ORDER BY professeur_id DESC ';
                }
                if($_POST["length"] != -1)
                {
                    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
                }
                $statement = $connect->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                $data = array();
                $filtered_rows = $statement->rowCount();
                foreach($result as $row)
                {
                    $image = '';
                    $image = '<img src="../public/images/teacher/'.$row["professeur_image"].'" class="img-thumbnail" width="50" height="35" />';
                    $sub_array = array();
                    $sub_array[] = $image;
                    $sub_array[] = $row["nom_professeur"];
                    $sub_array[] = $row["postnom_professeur"];
                    $sub_array[] = $row["prenom_professeur"];
                    $sub_array[] = $row["sexe"];
                    $sub_array[] = $row["mail_professeur"];
                    $sub_array[]=$row['habit_professeur'];
                    $sub_array[]='voir';
                    $sub_array[] = '<button type="button" name="update" id="'.$row["professeur_id"].'" class="btn btn-warning btn-xs update">Update</button>';
                    $sub_array[] = '<button type="button" name="delete" id="'.$row["professeur_id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
                    $data[] = $sub_array;
                }
                $output = array(
                "draw"    => intval($_POST["draw"]),
                "recordsTotal"  =>  $filtered_rows,
                "recordsFiltered" => get_total_records($connect,'professeur'),
                "data"    => $data
                );
                echo json_encode($output);
        }
        //PREND TOUTES LES DONNEES DE L'UTILISATEUR
        if($_POST['action']=='edit_fetch'){
            $identifiant=$_POST['identifiant'];
            $id_professeur=$connect->prepare("SELECT * FROM professeur WHERE professeur_id =?");
            $id_professeur->execute(array(intval($identifiant)));
            $fetch_professeur=$id_professeur->fetch();
            $nom_professeur=$fetch_professeur['nom_professeur'];
            $postnom_professeur=$fetch_professeur['postnom_professeur'];
            $prenom_professeur=$fetch_professeur['prenom_professeur'];
            //$sexe_professeur=$fetch_professeur['sexe'];
            $mail_professeur=$fetch_professeur['mail_professeur'];
            $addresse_professeur=$fetch_professeur['habit_professeur'];
            $pays_professeur=$fetch_professeur['pays_professeur'];
            $date_professeur=$fetch_professeur['date_professeur'];
            $output = array(
              'nom'       => $fetch_professeur['nom_professeur'],
              'postnom'       => $fetch_professeur['postnom_professeur'],
              'prenom'    => $fetch_professeur['prenom_professeur'],
              'mail'       => $fetch_professeur['mail_professeur'],
              'addresse'=>$fetch_professeur['habit_professeur'],
              'date'=>$fetch_professeur['date_professeur'],
              'pays'=>$fetch_professeur['pays_professeur'],
              'image'=>$fetch_professeur['professeur_image'],
              'id'=>$fetch_professeur['professeur_id']
             );
             echo json_encode($output);
          }
          if($_POST['action']=='supprimer'){
            $identifiant_suppression=$_POST['identifiant_supprimer'];
            $suppression=$connect->prepare("DELETE FROM professeur WHERE professeur_id=?");
            $suppression->execute(array($identifiant_suppression));
            $output = array(
              'delete'=>true,
              'info'=>'La suppression a été effectuée'
             );
             echo json_encode($output);
          }

    }


?>