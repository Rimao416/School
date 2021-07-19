//Ceci est la fonction permettant de faire le systeme de push
function makepush_message(type,message,entete){
    Command: toastr[type](message, entete)

    toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
}
$(function(){
    $('#sidebarCollapse').on('click',function(){
        $('#sidebar, #content, #right').toggleClass('active')
    }) 
    $("link[title='page']").attr('href','../public/css/style.css')
})
/*
var pageURL = $(location).attr("href");
if(pageURL.indexOf("admin")>=0){
    
}else{
    alert('non')
}*/