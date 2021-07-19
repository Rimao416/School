<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/header.php');?>
    <title>Page d'agence</title>
</head>
<body>
    <?php include('includes/navigation.php');?>

    <div class="container-fluid" style="margin-top:10px">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">AGENCE</div>
                        <div class="col-md-3" align="right">
                            <button type="button" id="add_button" class="btn btn-info btn-sm">Ajouter Une agence</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <p id="message_operation"></p>
                    <table class="table table-striped table-bordered" id="grade_table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>AGENCE</th>
                                <th>PAYS</th>
                                <th>VILLE</th>
                                <th>ADDRESSE</th>
                                <th>CONTACT</th>
                                <th>EMAIL</th>
                                <th>NUM. UNIQUE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>

    </div>

</body>
</html>