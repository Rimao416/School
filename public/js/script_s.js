$(function(){

    function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
} 
function hasNumber(myString) {
    return /\d/.test(myString);
  }

$('#add_button').click(function(){
    $('#formulaire').slideToggle()
})
//OPERATION D'AJOUT ECOLE



$('#formulaire').on('submit',function(event){
    event.preventDefault();
    var send=true;
    var school=$('#School_name').val();
    var addresse=$('#School_ad').val();
    var ad_mail=$('#School_address').val();
    var tel=$('#School_tel').val()
    //var img=$('#image_file').val()
    var image_school=$('#image_school').val()
    var extension = image_school.split('.').pop().toLowerCase();
    
    //alert(date_prof)
    if(extension != ''){
        if(jQuery.inArray(extension,['png','jpg','jpeg'])==-1)
        {
            send=false
            image_student.val('')
        }else if(jQuery.inArray(extension, ['png','jpg','jpeg']) !== -1){
            send=true
        }
    }else{
        send=true
    }
    if(school.length==0){
        $('#erreur_school').attr('class','text-danger')
        send=false
    }else{
        $('#erreur_school').attr('class','text-success')
        send=true
    }
    if(addresse.length==0){
        $('#erreur_ad').attr('class','text-danger')
        send=false
    }else{
        send=true
        $('#erreur_ad').attr('class','text-success')
    }
    if(ad_mail.length==0){
        $('#erreur_mail').attr('class','text-danger')
        send=false
    }else{
        if(validateEmail(ad_mail)==false){
            $('#erreur_mail').attr('class','text-danger')
            send=false
        }else{
            send=true
            $('#erreur_mail').attr('class','text-success')
        }
    }
    if(tel.length==0){
        $('#erreur_contact').attr('class','text-danger')
        send=false
    }else{
        let isnum = /^\d+$/.test(tel);
        if(isnum==false){
            $('#erreur_contact').attr('class','text-danger')
            send=false    
        }else{
            send=true
            $('#erreur_contact').attr('class','text-success')
        }
    }   
   // image=fileValidation()
    if(send==true){
        $.ajax({
            url:"../includes/admin_page/school_operation.php",
            method:"post",
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
             dataTable.ajax.reload();
            }
        })
    }
})
//FIN OPERATION

//OPERATION AJAX DATATABLES
var dataTable = $('#ecole_fetch').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
     url:"../includes/admin_page/school_operation.php",
     type:"POST",
     data:{action:'fetch'}
    },
    "columnDefs":[
     {
      "targets":[0,1,2,3,4],
      "orderable":false,
     },
    ],
   });
   



   $(document).on('click','.edit_student',function(){
       var identifiant=$(this).attr('id');
       var action='edit_fetch';
       $.ajax({
           url:"../includes/admin_page/school_operation.php",
           method:"post",
           dataType:"json",
           data:{action:action,identifiant:identifiant},
           success:function(data){
               $('#School_name').val(data.nom)
               $('#School_ad').val(data.addresse)
               $('#School_address').val(data.mail)
               $('#School_tel').val(data.numero)
               $('#school_specific').val(data.id)
               $('#action').val('modifier')
               $('#Button_Envoi').text('Modifier')

//               $('#School_name').val('salut')
                $('#formulaire').slideDown()
           }
       })
   })
       $(document).on('click','.delete_school',function(){
            var identifiant_supprimer=$(this).attr('id')
            $('#exampleModalCenter').modal('show')

            $('#Annuler').click(function(){
                $('#exampleModalCenter').modal('hide')
            })
            $('#Confirmer').click(function(){

                action='supprimer'
                $.ajax({
                    url:"../includes/admin_page/school_operation.php",
                    method:"post",
                  //  dataType:"json",
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
        //PARTIE VOIR ECOLE
        //FIN ECOLE


/////////////////////////////////////////////////////////////////////////PARTIE DIRECTEUR////////////////////////////////////////////////



})

/*function add_school(){





    alert('Ajout d\'une école')
}*/