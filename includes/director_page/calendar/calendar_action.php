<?php
    include('../../database.php');
    session_start();
    if(isset($_POST['school_eleve'])){
        $matiere=$_POST["school_eleve"];
        $output='';
        /*$fetch_list_matiere=$list_matiere->fetchAll();
        foreach($fetch_list_matiere as $row){
            $output .='<option value="'.$row['id_eleve'].'">'.$row['nom']. ' '.$row['postnom'].'</option>';
        }
        $output.='</select>';*/
        $i=0;
        $debut=8;
        $fin=9;
        while($i<11){
            $output.='
            <tr>
            <th scope="row">'.$debut++.'h à '.$fin++.'h</th>
            <td><select class="form-select school_eleve'.$i.' " aria-label="Activation select" name="school_eleve'.$i.'" id="school_eleve" style="font-size:small;">'.get_matiere_by_id($connect,$matiere,$_SESSION['id_ecole']).'</td>
            <td><select class="form-select school_eleve'.$i.' " aria-label="Activation select" name="school_eleve'.$i.'" id="school_eleve" style="font-size:small;">'.get_matiere_by_id($connect,$matiere,$_SESSION['id_ecole']).'</td>
            <td><select class="form-select school_eleve'.$i.' " aria-label="Activation select" name="school_eleve'.$i.'" id="school_eleve" style="font-size:small;">'.get_matiere_by_id($connect,$matiere,$_SESSION['id_ecole']).'</td>
            <td><select class="form-select school_eleve'.$i.' " aria-label="Activation select" name="school_eleve'.$i.'" id="school_eleve" style="font-size:small;">'.get_matiere_by_id($connect,$matiere,$_SESSION['id_ecole']).'</td>
            <td><select class="form-select school_eleve'.$i.' " aria-label="Activation select" name="school_eleve'.$i.'" id="school_eleve" style="font-size:small;">'.get_matiere_by_id($connect,$matiere,$_SESSION['id_ecole']).'</td>
            <td><select class="form-select school_eleve'.$i.' " aria-label="Activation select" name="school_eleve'.$i.'" id="school_eleve" style="font-size:small;">'.get_matiere_by_id($connect,$matiere,$_SESSION['id_ecole']).'</td>
            <td><select class="form-select school_eleve'.$i.' " aria-label="Activation select" name="school_eleve'.$i.'" id="school_eleve" style="font-size:small;"><option value="0"></option></td>
            </tr>            
            ';
            $i++;
        }

        echo $output;
    }
?>