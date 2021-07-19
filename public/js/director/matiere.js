$(function(){
    $('#add_button').click(function(){
        $('#formulaire').slideToggle()
    })
    $('#formulaire').on('submit',function(event){
        event.preventDefault()
        var send=true
        var name=$('#matiere_name').val()
        var prof_matiere=$('#matiere_professeur').val()
        var classe_matiere=$('#classe_matiere').val()
        $('#erreur_nom_matiere').attr('class','text-success')
        if($.trim(name).length==0){
            $('#erreur_nom_matiere').attr('class','text-danger')
            send=false
        }else{
            $('#erreur_nom_matiere').attr('class','text-success')
            send=true
        }
        if(send==true){
            $.ajax({
                url:"../includes/director_page/matiere_operation.php",
                method:'POST',
                data:$(this).serialize(),
                dataType:"json",
                success:function(data)
                {
                    if(data.error==false){
                        makepush_message("success",data.success,"Ajout Matière")
                    }
                    if(data.error==true){
                        makepush_message("error",data.error_ajout,"Erreur Ajout")
                    }
                    $('#formulaire')[0].reset();
//                 $('#userModal').modal('hide');
                     dataTable.ajax.reload();
                }
               });
        }

    })
    var dataTable = $('#matiere_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
         url:"../includes/director_page/matiere_operation.php",
         type:"POST",
         data:{action:'fetch'}
        },
        "columnDefs":[
         {
          "targets":[0, 1, 2,3,4,5],
          "orderable":false,
         },
        ],
      
       });
})