function load_courses(){

    var school_eleve=$('#school_eleve').val()
            $.ajax({
                url:"../includes/director_page/calendar/calendar_action.php",
                method:'POST',
                data:{school_eleve:school_eleve},
                success:function(data){
                    $('#charger').html(data)
                }
            })                    
}
$(function(){
    $('#form').submit(function(event){
        event.preventDefault()
        
        //var directed = $('select[name=school_eleve0]').val();
        var valeur=$('.school_eleve0').val()
        console.log(valeur[1])
//        console.log(valeur[0])
        //console.log(directed)
    })
})