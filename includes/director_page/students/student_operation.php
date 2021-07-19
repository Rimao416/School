<?php
    include('../../database.php');
    session_start();
    if(isset($_POST['action'])){
        if($_POST['action']=='send' || $_POST['action']=='modifier'){
            $nom_student=$_POST['student_name'];
            $id_unique=0;
            $postnom_student=$_POST['student_post_name'];
            $prenom_student=$_POST['student_surname'];
            $mail_student=$_POST['student_mail'];
            $classe_eleve=intval($_POST['school_eleve']);
            $habit_student=$_POST['student_habit'];
            $sexe_student=$_POST['sexe_eleve'];
            $date_student=$_POST['date_eleve'];
            $pays_student=$_POST['student_pays'];
            $eleve_specific=intval($_POST['eleve_specific']);
            //Addresse de connexion
            $addresse=$nom_student.$postnom_student.get_school_name_with_id($connect,$_SESSION['id_ecole']).'@ecole.com';
            //Mot de passe
            $mot_de_passe='';
            $image = '';
           
            if($_POST['action']=='send'){
                if($_FILES["image_eleve"]["name"] != '')
                {
                 $image = upload_student_image();
            
                }else{
                    $image='default.jpg';
                }
                $id_unique=rand(1000,9999999);
                $mot_de_passe=$nom_student.$postnom_student.get_school_name_with_id($connect,$_SESSION['id_ecole']).$id_unique.'+'.date('Y');
                if(!empty($mail_student)){
                    send_student_mail('university@gmail.com',$mail_student,$nom_student,$id_unique,$mot_de_passe);
                }
                $statement = $connect->prepare("INSERT INTO eleve (nom, postnom, prenom,sexe,nationalite,classe,mail,naissance,adresse,adresse_connexion,motdepasse,id_unique,photo,id_ecole) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)
               ");
               $result = $statement->execute(array($nom_student,$postnom_student,$prenom_student,$sexe_student,$pays_student,$classe_eleve,$mail_student,$date_student,$habit_student,$addresse,password_hash($mot_de_passe,PASSWORD_DEFAULT),$id_unique,$image,$_SESSION['id_ecole']));
               $output = array(
                'error'     => false,
                'message' => 'L\'élève a bel et bien été ajouté'
               );

            }elseif($_POST['action']=='modifier'){
                $id_unique=get_roll_number($connect,$eleve_specific);
                $mot_de_passe=$nom_student.$postnom_student.get_school_name_with_id($connect,$_SESSION['id_ecole']).$id_unique.'+'.date('Y');
                if(!empty($mail_student)){
                    send_student_mail('university@gmail.com',$mail_student,$nom_student,$id_unique,$mot_de_passe);
                }
                if($_FILES["image_eleve"]["name"]!=''){
                    $image=upload_student_image();

                }else{
                    $image=load_student_image($connect,$eleve_specific);
                }
                $statement=$connect->prepare("UPDATE eleve SET nom=?, postnom=?, prenom=?,sexe=?,nationalite=?,classe=?,mail=?,naissance=?,adresse=?,adresse_connexion=?,motdepasse=?,id_unique=?,photo=? WHERE id_eleve=?");
                $statement->execute(array($nom_student,$postnom_student,$prenom_student,$sexe_student,$pays_student,$classe_eleve,$mail_student,$date_student,$habit_student,$addresse,password_hash($mot_de_passe,PASSWORD_DEFAULT),$id_unique,$image,$eleve_specific));
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
                $query .= "SELECT * FROM eleve ";
                if(isset($_POST["search"]["value"]))
                {
                    $query .= 'WHERE id_ecole='.$_SESSION["id_ecole"].' AND (nom LIKE "%'.$_POST["search"]["value"].'%" 
                    OR postnom LIKE "%'.$_POST["search"]["value"].'%" 
                    OR prenom LIKE "%'.$_POST["search"]["value"].'%"
                    OR sexe LIKE "%'.$_POST["search"]["value"].'%"
                    OR nationalite LIKE "%'.$_POST["search"]["value"].'%"
                    OR mail LIKE "%'.$_POST["search"]["value"].'%") ';
                }
                if(isset($_POST["order"]))
                {
                    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
                }
                else
                {
                    $query .= 'ORDER BY id_eleve DESC ';
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
                    $image = '<img src="../public/images/student/'.$row["photo"].'" class="img-thumbnail" width="50" height="35" />';
                    $sub_array = array();
                    $sub_array[] = $image;
                    $sub_array[] = $row["nom"];
                    $sub_array[] = $row["postnom"];
                    $sub_array[] = $row["prenom"];
                    $sub_array[] = $row["sexe"];
                    $sub_array[] = $row["nationalite"];
                    $sub_array[]=load_classe_with_id($connect,$row["id_ecole"]);
                    $sub_array[] = '<button type="button" name="update" id="'.$row["id_eleve"].'" class="btn btn-warning btn-xs update">Modifier</button>';
                    $sub_array[] = '<button type="button" name="delete" id="'.$row["id_eleve"].'" class="btn btn-danger btn-xs delete">Supprimer</button>';
                    $sub_array[]='voir';
                    $data[] = $sub_array;
                }
                $output = array(
                "draw"    => intval($_POST["draw"]),
                "recordsTotal"  =>  $filtered_rows,
                "recordsFiltered" => get_total_records($connect,'eleve'),
                "data"    => $data
                );
                echo json_encode($output);
        }


        if($_POST['action']=='edit_fetch'){
            $identifiant=$_POST['identifiant'];
            $id_eleve=$connect->prepare("SELECT * FROM eleve WHERE id_eleve =?");
            $id_eleve->execute(array(intval($identifiant)));
            $fetch_eleve=$id_eleve->fetch();
            $nom=$fetch_eleve['nom'];
            $postnom=$fetch_eleve['postnom'];
            $prenom=$fetch_eleve['prenom'];
            $pays_eleve=$fetch_eleve['nationalite'];
            //$sexe_professeur=$fetch_professeur['sexe'];
            $mail_eleve=$fetch_eleve['mail'];
            $addresse_eleve=$fetch_eleve['adresse'];
            $date_eleve=$fetch_eleve['naissance'];
            $output = array(
              'nom'       => $fetch_eleve['nom'],
              'postnom'       => $fetch_eleve['postnom'],
              'prenom'    => $fetch_eleve['prenom'],
              'mail'       => $fetch_eleve['mail'],
              'addresse'=>$fetch_eleve['adresse'],
              'date'=>$fetch_eleve['naissance'],
              'pays'=>$fetch_eleve['nationalite'],
//              'image'=>$fetch_eleve['professeur_image'],
              'id'=>$fetch_eleve['id_eleve']
             );
             echo json_encode($output);
          }
          if($_POST['action']=='supprimer'){
            $identifiant_suppression=$_POST['identifiant_supprimer'];
            $suppression=$connect->prepare("DELETE FROM eleve WHERE id_eleve=?");
            $suppression->execute(array($identifiant_suppression));
            $output = array(
              'delete'=>true,
              'info'=>'La suppression a été effectuée'
             );
             echo json_encode($output);
          }

    }


?>