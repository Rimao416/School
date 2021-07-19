$(function(){
    $('#add_button').click(function(){
    //    $('#formulaire').slideToggle()
    
    if (($("#formulaire" ).first().is( ":hidden"))&&($('#action').val()!='modifier')) {
        $("#formulaire" ).slideDown( "slow" );
        $('#formulaire')[0].reset()
        $('#action').val('send')

    }else if(($("#formulaire" ).first().is( ":visible")) && ($('#action').val()!='modifier')) {
        $('#formulaire').slideUp('slow')
        $('#action').val('send')
    }
    if(($('#formulaire').first().is(":visible"))&&($('#action').val()=='modifier')){
        $('#formulaire').show()
        $('#formulaire')[0].reset()
        $('#action').val('send')
        $('#Button_Envoi').text('Enregistrer')
    }
})
    $(document).on('submit','#formulaire',function(event){
        event.preventDefault()
        var nom_prof=$('#prof_name').val()  
        var postnom_prof=$('#prof_post_name').val()  
        var prenom_prof=$('#prof_surname').val()
        var mail_prof=$('#prof_mail').val()
        var habit_prof=$('#prof_habit').val()
        var sexe_prof=$('#sexe_prof').val()
        var date_prof=$('#date_prof').val()
        var pays_prof=$('#prof_pays').val()
        var image_prof=$('#image_prof').val()
        var extension = image_prof.split('.').pop().toLowerCase();
        //alert(date_prof)
        if(extension != ''){
            if(jQuery.inArray(extension,['png','jpg','jpeg'])==-1)
            {
                image_prof.val('')
            }
        }
        if($.trim(nom_prof) != '' && $.trim(postnom_prof) != '' && $.trim(prenom_prof)!='' && date_prof!='' && pays_prof!=''){
            $.ajax({
                url:"../includes/director_page/teacher/teacher_operation.php",
                method:'POST',
                data:new FormData(this),
                dataType:"json",
                contentType:false,
                processData:false,
                success:function(data)
                {
                if(data.error==false){
                    makepush_message("success",data.message,"Ajout")
                }
                if(data.update==true){
                    makepush_message("info",data.info,"Mise à jour")
                }
                 $('#formulaire')[0].reset();
//                 $('#userModal').modal('hide');
                 dataTable.ajax.reload();
                }
               });
        }else{
            makepush_message("error","Les champs asterisés doivent être remplis","Erreur")
        }
    })
    var dataTable = $('#teacher_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
         url:"../includes/director_page/teacher/teacher_operation.php",
         type:"POST",
         data:{action:'fetch'}
        },
        "columnDefs":[
         {
          "targets":[0, 3, 4],
          "orderable":false,
         },
        ],
      
       });


       
//MODIFICATION D'UN DIRECTEUR
$(document).on('click','.update',function(){
    var identifiant=$(this).attr('id');
    var action='edit_fetch';
    $.ajax({
        url:"../includes/director_page/teacher/teacher_operation.php",
        method:"post",
        dataType:"json",
        data:{action:action,identifiant:identifiant},
        success:function(data){

            $('#prof_name').val(data.nom)
            $('#prof_post_name').val(data.postnom)
            $('#prof_surname').val(data.prenom)
            $('#prof_mail').val(data.mail)
            $('#prof_habit').val(data.addresse)
            $('#date_prof').val(data.date)
            $('#prof_pays').val(data.pays)
            $('#formulaire').slideDown()
//            $('#image_prof').val(data.image)
            $('#teacher_specific').val(data.id)
            $('#action').val('modifier')
            $('#Button_Envoi').text('Modifier')
            
        }
    })

})

//PARTIE SUPPRESSION D'UN PROFESSEUR
$(document).on('click','.delete',function(){
    var identifiant_supprimer=$(this).attr('id')
    $('#exampleModalCenter').modal('show')
//    makepush_message("warning","")

    $('#Annuler').click(function(){
        $('#exampleModalCenter').modal('hide')
    })
    $('#Confirmer').click(function(){

        action='supprimer'
        $.ajax({
            url:"../includes/director_page/teacher/teacher_operation.php",
            method:"post",
          //dataType:"json",
            data:{action:action,identifiant_supprimer:identifiant_supprimer},
            
            success:function(data){
                if(data.delete==true){
                    makepush_message("Error",data.info,"Suppression")   
                }
                dataTable.ajax.reload()
                $('#exampleModalCenter').modal('hide')
            }
        })
    })
})




})