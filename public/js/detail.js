$(document).ready(function () {

    $('.rotate').click(function(){
        location.reload();
    })

    if($(window).width() < 960){
        console.log('width');
        $('.pre').before('<br>');
       
    }else{

    }
});