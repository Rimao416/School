<?php
    include('../../database.php');
    session_start();
    if(isset($_POST['salle'])){
        $output='<select class="form-select" aria-label="Activation select" name="list_eleve" id="list_eleve">';
        $salle=$_POST["salle"];
        $list_salle=$connect->prepare("SELECT * FROM eleve WHERE classe = ?");
        $list_salle->execute(array($salle));
        $fetch_list_salle=$list_salle->fetchAll();
        foreach($fetch_list_salle as $row){
            $output .='<option value="'.$row['id_eleve'].'">'.$row['nom']. ' '.$row['postnom'].'</option>';
        }
        $output.='</select>';
        echo $output;
    }   
    if(isset($_POST['action'])){
        if($_POST['action']=='send'){
            $nom_parent=$_POST['parent_name'];
            $postnom_parent=$_POST['parent_post_name'];
            $prenom_parent=$_POST['parent_surname'];
            $mail_parent=$_POST['parent_mail'];
            $tel_parent=$_POST['parent_tel'];
            $nom_enfant=$_POST['list_eleve'];
            $message_enfant='';
            $addresse=$nom_parent.$nom_enfant.'@ecole.com';
            $motdepasse=$nom_parent.'_'.$nom_enfant;
            if(!(empty($_POST['validation']))){
                $message_enfant='1';
            }else{
                $message_enfant='0';
            }
            send_parent_mail('university@gmail.com',$mail_parent,$nom_parent,$addresse,$motdepasse);

            $insert=$connect->prepare("INSERT INTO parent(nom, postnom, prenom, mail, addresse_connexion, motdepasse, id_fils, notification, id_ecole) VALUES (?,?,?,?,?,?,?,?,?)");
            $insert->execute(array($nom_parent,$postnom_parent,$prenom_parent,$mail_parent,$addresse,password_hash($motdepasse,PASSWORD_DEFAULT),$nom_enfant,$message_enfant,$_SESSION['id_ecole']));

        }
        if($_POST['action']=='fetch'){
            $query = '';
            $output = array();
            $query .= "SELECT * FROM parent ";
            if(isset($_POST["search"]["value"]))
            {
                $query .= 'WHERE id_ecole='.$_SESSION["id_ecole"].' AND (nom LIKE "%'.$_POST["search"]["value"].'%" 
                OR postnom LIKE "%'.$_POST["search"]["value"].'%" 
                OR prenom LIKE "%'.$_POST["search"]["value"].'%"
                OR mail LIKE "%'.$_POST["search"]["value"].'%") ';
            }
            if(isset($_POST["order"]))
            {
                $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
            }
            else
            {
                $query .= 'ORDER BY parent_id DESC ';
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
                $sub_array = array();
                $sub_array[] = $row["nom"];
                $sub_array[] = $row["postnom"];
                $sub_array[] = $row["prenom"];
                $sub_array[] = $row["mail"];
                $sub_array[] = '<button type="button" name="update" id="'.$row["parent_id"].'" class="btn btn-warning btn-xs update">Update</button>';
                $sub_array[] = '<button type="button" name="delete" id="'.$row["parent_id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
                $sub_array[]='voir';
                $data[] = $sub_array;
            }
            $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  $filtered_rows,
            "recordsFiltered" => get_total_records($connect,'parent'),
            "data"    => $data
            );
            echo json_encode($output);
    }

    }
    
?>