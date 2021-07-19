<?php
    include('../database.php');
    //"../includes/director_page/teacher/teacher_operation.php",
    session_start();
    if(isset($_POST['action'])){
        if($_POST['action']=='send'){
                $classe_name=$_POST['classe_name'];
                $classe_titulaire=$_POST['classe_titulaire'];

                $data = array(
                    ':classe_name'    => $classe_name,
                    ':classe_titulaire'   => $classe_titulaire,
                    ':ecole'=>$_SESSION['id_ecole']);
                $query = "INSERT INTO classe (nom_classe, id_teacher, id_ecole) 
                SELECT * FROM (SELECT :classe_name, :classe_titulaire, :ecole) as temp 
                WHERE NOT EXISTS (SELECT id_teacher FROM classe WHERE id_teacher = :classe_titulaire) LIMIT 1";
                $statement = $connect->prepare($query);
                if($statement->execute($data))
                {
                    if($statement->rowCount() > 0)
                    {
                    $output = array(
                    'error'=>false,
                    'success'  => 'La classe a été ajoutée avec Succès',
                    );
                }
                    else
                    {
                    $output = array(
                    'error'     => true,
                    'error_ajout' => 'Un enseignant est déjà assigné à cette salle'
                    );
                    }
                }
                echo json_encode($output);
            }
    
        if($_POST['action']=='fetch'){
            $query = '';
            $output = array();
            $query .= "SELECT * FROM classe ";
            if(isset($_POST["search"]["value"]))
            {
                $query .= 'WHERE id_ecole='.$_SESSION["id_ecole"].' AND (nom_classe LIKE "%'.$_POST["search"]["value"].'%") ';
            }
            if(isset($_POST["order"]))
            {
                $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
            }
            else
            {
                $query .= 'ORDER BY id_classe DESC ';
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
                $sub_array[] = $row["nom_classe"];
                $sub_array[] = load_titutailre_with_id($connect,$row["id_classe"]);
                $sub_array[] = '<button type="button" name="update" id="'.$row["id_classe"].'" class="btn btn-warning btn-xs update">Update</button>';
                $sub_array[] = '<button type="button" name="delete" id="'.$row["id_classe"].'" class="btn btn-danger btn-xs delete">Delete</button>';
                $sub_array[]='voir';
                $data[] = $sub_array;
            }
            $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  $filtered_rows,
            "recordsFiltered" => get_total_records($connect,'classe'),
            "data"    => $data
            );
            echo json_encode($output);
    }

    }
?>