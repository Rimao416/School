
<?php
include('../database.php');
if(isset($_POST['action'])){
    if($_POST["action"] == 'fetch')
    {
     $query = "SELECT * FROM directeurs ";
     if(isset($_POST["search"]["value"]))
     {
      $query .= 'WHERE nom LIKE "%'.$_POST["search"]["value"].'%" 
         OR postnom LIKE "%'.$_POST["search"]["value"].'%" 
         OR prenom LIKE "%'.$_POST["search"]["value"].'%"
         OR mail LIKE "%'.$_POST["search"]["value"].'%"
         OR adresse_connexion LIKE "%'.$_POST["search"]["value"].'%" 
         OR ecole LIKE "%'.$_POST["search"]["value"].'%" ';
     }
     if(isset($_POST["order"]))
     {
      $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
     }
     else
     {
      $query .= 'ORDER BY id_directeur DESC ';
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
     $resultat='';
     foreach($result as $row)
     {
      $sub_array = array();
      $nom_ecole=get_school_name_with_id($connect,intval($row['ecole']));


      $sub_array[] = $row["nom"];
      $sub_array[] = $row["postnom"];
      $sub_array[] = $row["prenom"];
//      $sub_array[]=$row["addresse"];
      $sub_array[] = $row["mail"];
      $sub_array[] = $row["adresse_connexion"];
      $sub_array[] = $nom_ecole;
      $sub_array[]='<i class="far fa-edit text-info edit_directeur" name="edit_directeur" id="'.$row['id_directeur'].'"></i><i class="fas fa-trash text-danger delete_directeur" name="delete_directeur" id="'.$row['id_directeur'].'"></i>';
      $data[] = $sub_array;
     }
   
     $output = array(
      "draw"    => intval($_POST["draw"]),
      "recordsTotal"  =>  $filtered_rows,
      "recordsFiltered" => get_total_records($connect, 'ecole'),
      "data"    => $data
     );
     echo json_encode($output);
    }

    //PARTIE AJOUT ECOLE

    if($_POST['action']=='send' || $_POST['action']=='modifier'){

      $direcor_name=$_POST['directeur_name'];
      $director_post=$_POST['directeur_post_name'];
      $director_surname=$_POST['directeur_surname'];
      $director_mail=$_POST['directeur_mail'];
      $director_school=$_POST['school_director'];
      $school_specific=$_POST['school_specific'];
      $addresse_de_connexion='';
      //motdepasse=nomdudirecteur+idscholl+2021
      $addresse_de_connexion=$direcor_name.get_school_name_with_id($connect,intval($director_school)).'@university.com';
      $password=$direcor_name.$director_school.date('Y');
      //ENVOI DANS LA DATABASE
      if($_POST['action']=='send'){
        $action=$_POST['action'];
        $data = array(
            ':director_nom'    => $direcor_name,
            ':director_postnom'   => $director_post,
            ':director_prenom'   => $director_surname,
            ':director_mail'   => $director_mail,
            ':director_mail_connexion' => $addresse_de_connexion,
            ':director_password'    => password_hash($password, PASSWORD_DEFAULT),
            ':director_ecole'   => intval($director_school)
           );
           $query = "INSERT INTO directeurs (nom, postnom, prenom, mail, adresse_connexion, password, ecole) 
           SELECT * FROM (SELECT :director_nom, :director_postnom, :director_prenom, :director_mail, :director_mail_connexion, :director_password, :director_ecole) as temp 
           WHERE NOT EXISTS (SELECT ecole FROM directeurs WHERE ecole = :director_ecole) LIMIT 1";
           $statement = $connect->prepare($query);
           if($statement->execute($data))
           {
            if($statement->rowCount() > 0)
            {
             //sendmail_teacher_register("university@gmail.com",$teacher_emailid,$teacher_name,$teacher_qualification,$teacher_emailid,$mot_de_passe);
             $output = array(
            'error'=>false,
              'success'  => 'Data Added Successfully',
              'action'=>$_POST['action']
             );

           }
            else
            {
             $output = array(
              'error'     => true,
              'error_school' => 'Un directeur est déjà attribué à cette école',
              'action'=>$action
             );
            }
           } 
           // FIN D'ENVOI DANS LA DATABASE
            
        }
        elseif($_POST['action']=='modifier'){
          $modifier=$connect->prepare("UPDATE directeurs SET nom=?, postnom=?, prenom=?, mail=?, adresse_connexion=?, password=?, ecole=? WHERE id_directeur=?");
          $modifier->execute(array($direcor_name,$director_post,$director_surname,$director_mail,$addresse_de_connexion, password_hash($password, PASSWORD_DEFAULT),intval($director_school),$school_specific));
          $output = array(
            'error'=>false,
              'success'  => 'Data Edited Successfully',
              'action'=>$_POST['action']
             );
        } 
        echo json_encode($output);

      }
      if($_POST['action']=='edit_fetch'){
        $identifiant=$_POST['identifiant'];
        $id_directeur=$connect->prepare("SELECT * FROM directeurs WHERE id_directeur =?");
        $id_directeur->execute(array(intval($identifiant)));
        $fetch_directeur=$id_directeur->fetch();
        $nom_directeur=$fetch_directeur['nom'];
        $postnom_directeur=$fetch_directeur['postnom'];
        $prenom_directeur=$fetch_directeur['prenom'];
        $mail_directeur=$fetch_directeur['mail'];
        $addresse_directeur=$fetch_directeur['adresse_connexion'];
        $output = array(
          'nom'       => $fetch_directeur['nom'],
          'postnom'       => $fetch_directeur['postnom'],
          'prenom'    => $fetch_directeur['prenom'],
          'mail'       => $fetch_directeur['mail'],
          'addresse'=>$fetch_directeur['adresse_connexion'],
          'id'=>$fetch_directeur['id_directeur']
         );
         echo json_encode($output);
      }
      
      if($_POST['action']=='supprimer'){
        $identifiant_suppression=$_POST['identifiant_supprimer'];
        $suppression=$connect->prepare("DELETE FROM directeurs WHERE id_directeur=?");
        $suppression->execute(array($identifiant_suppression));
      }
}
?>