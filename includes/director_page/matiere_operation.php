<?php
    include('../database.php');
    //"../includes/director_page/teacher/teacher_operation.php",
    session_start();
    if(isset($_POST['action'])){
        if($_POST['action']=='send'){
                $matiere_name=$_POST['matiere_name'];
                $matiere_professeur=$_POST['matiere_professeur'];
                $classe_matiere=$_POST['classe_matiere'];


                    $query="INSERT INTO matiere (nom_matiere, id_professeur,id_classe, id_ecole) VALUES (?,?,?,?)";
                    $statement=$connect->prepare($query);
                    if($statement->execute(array($matiere_name,$matiere_professeur,$classe_matiere,$_SESSION['id_ecole']))){
                        if($statement->rowCount() > 0)
                        {
                        $output = array(
                        'error'=>false,
                        'success'  => 'La matiere a été ajoutée avec Succès',
                        );
                        }else{
                            $output = array(
                                'error'     => true,
                                'error_ajout' => 'Vérifiez toutes vos entrées'
                                );
                        }
                            
                    }
                    echo json_encode($output);
                }
    
        if($_POST['action']=='fetch'){
            $query = '';
            $output = array();
            $query .= 'SELECT * FROM matiere INNER JOIN classe ON matiere.id_classe=classe.id_classe INNER JOIN professeur ON matiere.id_professeur=professeur.professeur_id ';
            if(isset($_POST["search"]["value"]))
            {
                $query .= 'WHERE id_ecole='.$_SESSION["id_ecole"].' AND (nom_matiere LIKE "%'.$_POST["search"]["value"].'%") ';
            }
            if(isset($_POST["order"]))
            {
                $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
            }
            else
            {
                $query .= 'ORDER BY id_matiere DESC ';
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
                $sub_array[] = $row["nom_matiere"];
                $sub_array[] = $row["nom_professeur"];
                $sub_array[] = $row["nom_classe"];
                $sub_array[] = '<button type="button" name="update" id="'.$row["id_matiere"].'" class="btn btn-warning btn-xs update">Update</button>';
                $sub_array[] = '<button type="button" name="delete" id="'.$row["id_matiere"].'" class="btn btn-danger btn-xs delete">Delete</button>';
                $sub_array[]='voir';
                $data[] = $sub_array;
            }
            $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  $filtered_rows,
            "recordsFiltered" => get_total_records($connect,'matiere'),
            "data"    => $data
            );
            echo json_encode($output);
    }

    }
?>