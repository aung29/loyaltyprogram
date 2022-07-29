$(document).ready(function () {

    $('.customers').click(function(){
        $('.customers').addClass('active');
        $('.sales').removeClass('active');

        $('.customertable').addClass('open');
        $('.customertable').removeClass('close');


        $('.saletable').addClass('close');
        $('.saletable').removeClass('open');
    })

    $('.sales').click(function(){

        $('.customers').removeClass('active');
        $('.sales').addClass('active');

        $('.customertable').addClass('close');
        $('.customertable').removeClass('open');
        

        $('.saletable').addClass('open');
        $('.saletable').removeClass('close');
    })
});