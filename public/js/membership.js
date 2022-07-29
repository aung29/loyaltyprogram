$(document).ready(function () {

    $('.program').click(function(){
        $('.program').addClass('active');
        $('.new').removeClass('active');

        $('.tablemember').addClass('open');
        $('.tablemember').removeClass('close');

        
        $('.formmember').addClass('close');
        $('.formmember').removeClass('open');
    })

    $('.new').click(function(){

        $('.program').removeClass('active');
        $('.new').addClass('active');

        $('.tablemember').addClass('close');
        $('.tablemember').removeClass('open');
        

        $('.formmember').addClass('open');
        $('.formmember').removeClass('close');
    })


    $('.btnedit').click(function(e){
        e.preventDefault();
    })


    $('#search').keyup(function(e){

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        })
        if($('#search').val() == ""){
            location.reload(true);
        }
        var searchName = {name : $('#search').val()};
        if(e.keyCode == 13)
        {
            $.ajax({
                type : "POST",
                url : "searchMembership",
                data: searchName,
                dataType: "json",
                beforeSend: function(){
                        $('.confirmdata').hide();
                        $('.confirmdata').empty();
                      
                },  
                success:function(data){
                    // console.log(data[0].amount.toString());
                    // console.log(data.responseJSON.errors);
                    $('.confirmdata').show();
                    $('.confirmdata').append(`
                                <tr class="blank_row">
                                <td class="norow" colspan="7"></td>
                                </tr>
                                `);
                    let count = 1;
                    if(data.length >0 ){
                        for (const list of data) {
                            let note = "";
                            let  stringData = list.kyat_from.toString();
                            let kyatF = numberWithCommas(stringData);
                            let  stringData2 = list.kyat_to.toString();
                            let kyatt = numberWithCommas(stringData2);
                            if(list.note == null){
                                note = "empty";
                            }else{
                                note = list.note;
                            }
                                $('.confirmdata').append(`
                               
                                <tr>
                                <td>${list.program_name}</td>
                                <td>${list.discount} %</td>
                                <td>${kyatF} Ks</td>
                                <td>${kyatt} Ks</td>
                               
                                <td>${note}</td>
                                <td>${list.start_date}</td>
                               
                                </tr>
                                `)
                                count++
                        }
                        $('.members').text(data.length);
                        $('.links').empty();
                    }else{

                        $('.confirmdata').append(`
                        <tr class="blank_row">
                        <td class="norow text-center" colspan="7">There is no membership name in this table</td>
                        </tr>`);
                        $('.members').text('0');
                        $('.links').hide();
                    }

                  

                 

                },
                error: function(err){
                    console.log(err);
                }
        });
        }

    });
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}