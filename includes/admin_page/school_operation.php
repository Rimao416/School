
<?php
include('../database.php');
if(isset($_POST['action'])){
    if($_POST["action"] == 'fetch')
    {
     $query = "SELECT * FROM ecole ";
     if(isset($_POST["search"]["value"]))
     {
      $query .= 'WHERE nom LIKE "%'.$_POST["search"]["value"].'%" 
         OR addresse LIKE "%'.$_POST["search"]["value"].'%" 
         OR mail LIKE "%'.$_POST["search"]["value"].'%" 
         OR numero LIKE "%'.$_POST["search"]["value"].'%" ';
     }
     if(isset($_POST["order"]))
     {
      $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
     }
     else
     {
      $query .= 'ORDER BY id DESC ';
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
      if($row['status']=='1'){
        $resultat='<p class="text-success">Activé</p>';
      }else{
        $resultat='<p class="text-danger">En attente</p>';
      }
      $sub_array[] = '<img src="../public/images/admin/'.$row["image"].'"  width="80" height="80"  />';
      $sub_array[] = $row["nom"];
      $sub_array[]=$row["addresse"];
      $sub_array[] = $row["mail"];
      $sub_array[]=$row["numero"];
      $sub_array[] = $resultat;
      $sub_array[]='<i class="far fa-edit text-info edit_student" name="edit_student" id="'.$row["id"].'"></i><i class="fas fa-trash text-danger delete_school" name="delete_student" id="'.$row["id"].'"></i>';
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

      $school=$_POST['School_name'];
      $living_address=$_POST['School_ad'];
      $mail_address=$_POST['School_address'];
      $portable=$_POST['School_tel'];
      $activation=$_POST['activation'];
      $school_specific=$_POST['school_specific'];
      $image='';
      if($_POST['action']=='send'){
        if($_FILES["image_school"]["name"] != '')
                {
                 $image = upload_school_image();
            
                }else{
                    $image='default.jpg';
                }
          $inserer=$connect->prepare("INSERT INTO ecole (nom,addresse,mail,image,numero,status) VALUES (?,?,?,?,?,?)");
          $inserer->execute(array($school,$living_address,$mail_address,$image,$portable,intval($activation)));
          $output = array(
            'error'     => false,
            'message' => 'L\'école a bel et bien été ajoutée'
           );

        }elseif($_POST['action']=='modifier'){
          if($_FILES["image_school"]["name"]!=''){
            $image=upload_school_image();

        }else{
            $image=load_school_image($connect,$school_specific);
        }
          $modifier=$connect->prepare("UPDATE ecole SET nom=?, addresse=?, mail=?, image=?, numero=?, status=? WHERE id=?");
          $modifier->execute(array($school,$living_address,$mail_address,$image,$portable,$activation,$school_specific));
          $output = array(
            'update'=>true,
            'info'=>'Mise à jour réussie'
           );
        } 
        echo json_encode($output);
      }
      if($_POST['action']=='edit_fetch'){
        $identifiant=$_POST['identifiant'];
        $id_school=$connect->prepare("SELECT * FROM ecole WHERE id =?");
        $id_school->execute(array(intval($identifiant)));
        $fetch_school=$id_school->fetch();
        $nom_ecole=$fetch_school['nom'];
        $addresse_ecole=$fetch_school['addresse'];
        $mail_ecole=$fetch_school['mail'];
        $numero_ecole=$fetch_school['numero'];
        $output = array(
          'nom'       => $fetch_school['nom'],
          'addresse'    => $fetch_school['addresse'],
          'mail'=>$fetch_school['mail'],
          'numero'=>$fetch_school['numero'],
          'id'=>$fetch_school['id']
         );
         echo json_encode($output);
      }
      if($_POST['action']=='supprimer'){
        $identifiant_suppression=$_POST['identifiant_supprimer'];
        $suppression=$connect->prepare("DELETE FROM ecole WHERE id=?");
        $suppression->execute(array($identifiant_suppression));
        $output = array(
          'delete'=>true,
          'info'=>'La suppression a été effectuée'
         );
         echo json_encode($output);
      }
}
?>