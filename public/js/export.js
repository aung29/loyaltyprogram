$(document).ready(function () {

    $('.customers').click(function(){
        $('.customers').addClass('active');
        $('.sales').removeClass('active');

        $('.customertable').addClass('open');
        $('.customertable').removeClass('close');


        

        $('.saletable').addClass('close');
        $('.saletable').removeClass('open');
    })

    $('.rotate').click(function(){
        location.reload();
    })

    $('.sales').click(function(){

        $('.customers').removeClass('active');
        $('.sales').addClass('active');

        $('.customertable').addClass('close');
        $('.customertable').removeClass('open');
        

        $('.saletable').addClass('open');
        $('.saletable').removeClass('close');
    })



    $('#username1').change(function(e){
        e.preventDefault();
     
        
        $.ajaxSetup({
           headers: {
               "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                   "content"
               ),
           },
       })


       if($('#username1').val() == 0){
           location.reload();
       }else{
           let formdata = {cusname : $('#username1').val()};
           console.log(formdata);
   
           $.ajax({
               type: "POST",
               url: "searchCustomer",
               data: formdata,
               dataType: "json",
               beforeSend: function(){
                   $('.confirmdata').hide();
                   $('.confirmdata').empty();
                 
           },  
               success:function(data){
                   console.log(data);
   
                   $('.confirmdata').show();
                   $('.confirmdata').append(`
                               <tr class="blank_row">
                               <td class="norow" colspan="7"></td>
                               </tr>
                               `);
                   let count = 1;
                   if(data.length >0 ){
                       for (const list of data) {
                       
                           let  stringData = list.amount.toString();
                           let amount = numberWithCommas(stringData);
                           let invoice = "";
                           if(list.invoice == null){
                               invoice = "-";
                           }else{
                               invoice = list.invoice;
                           }
                               $('.confirmdata').append(`
                              
                               <tr>
                               <td class='text-center'>${count}</td>
                               <td>${list.customer_name}</td>
                               <td>${list.card_id}</td>
                               <td>${invoice}</td>
                               <td>${amount} Ks</td>
                               <td>${list.program_name}</td>
                               <td>${list.transaction_date}</td>
                               </tr>
                               `)
                               count++
                       }
                       $('.sale-count').text(data.length);
                       $('.links').empty();
                   }else{
   
                       $('.confirmdata').append(`
                       <tr class="blank_row">
                       <td class="norow text-center" colspan="7">There is no sale for this customer</td>
                       </tr>`);
                       $('.sale-count').text('0');
                       $('.links').hide();
                   }
   
               },
               error:function(err){
                   console.log(err);
               }
   
           });
       }

      

    })


    $('#username2').change(function(e){
            e.preventDefault();
         
   
            $.ajaxSetup({
               headers: {
                   "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                       "content"
                   ),
               },
           })

           if($('#username2').val() == 0){
                location.reload();
           }else{

            let formdata = {cusname : $('#username2').val()};
       
   
            $.ajax({
                type: "POST",
                url: "changeCustomer",
                data: formdata,
                dataType: "json",
                beforeSend: function(){
                    $('.confirmdata').hide();
                    $('.confirmdata').empty();
                  
            },  
                success:function(data){
                    console.log(data);
    
                    $('.confirmdata').show();
                    $('.confirmdata').append(`
                                <tr class="blank_row">
                                <td class="norow" colspan="7"></td>
                                </tr>
                                `);
                    let count = 1;
                    if(data.length >0 ){
                        for (const list of data) {
                        
                           
                                $('.confirmdata').append(`
                               
                                <tr>
                                 <td class='text-center'>${count}</td>
                                 <td>${list.customer_name}</td>
                                 <td>${list.card_id}</td>
                                 <td>${list.phone}</td>
                                 <td>${list.dob}</td>
                                 <td>${list.address}</td>
                                
                                `)
                                count++
                        }
                        $('.cards').text(data.length);
                        $('.links').empty();
                    }else{
    
                        $('.confirmdata').append(`
                        <tr class="blank_row">
                        <td class="norow text-center" colspan="7">There is no customer!</td>
                        </tr>`);
                        $('.cards').text(data.length);
                        $('.links').hide();
                    }
    
                },
                error:function(err){
                    console.log(err);
                }
    
            });
           }
   
         
   
        })



        $('#reference1').change(function(e){
            e.preventDefault();
  
            $.ajaxSetup({
              headers: {
                  "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                      "content"
                  ),
              },
          })
  
          
          if($('#reference1').val() == 0){
              location.reload();
          }else{
  
              let formdata = {id : $('#reference1').val()};
          
          $.ajax({
              type: "POST",
              url: "searchReference",
              data: formdata,
              dataType: "json",
              beforeSend: function(){
                  $('.confirmdata').hide();
                  $('.confirmdata').empty();
                
              },
              success:function(data){
                  console.log(data);
  
                  
                  $('.confirmdata').show();
                  $('.confirmdata').append(`
                              <tr class="blank_row">
                              <td class="norow" colspan="7"></td>
                              </tr>
                              `);
                  let count = 1;
                  if(data.length >0 ){
                      for (const list of data) {
                      
                          let  stringData = list.amount.toString();
                          let amount = numberWithCommas(stringData);
                          let invoice = "";
                          if(list.invoice == null){
                              invoice = "-";
                          }else{
                              invoice = list.invoice;
                          }
                              $('.confirmdata').append(`
                             
                              <tr>
                              <td class='text-center'>${count}</td>
                              <td>${list.customer_name}</td>
                              <td>${list.card_id}</td>
                              <td>${invoice}</td>
                              <td>${amount} Ks</td>
                              <td>${list.program_name}</td>
                              <td>${list.transaction_date}</td>
                              </tr>
                              `)
                              count++
                      }
                      $('.sale-count').text(data.length);
                      $('.links').empty();
                  }else{
  
                      $('.confirmdata').append(`
                      <tr class="blank_row">
                  <td class="norow text-center" colspan="7">There is no customer transaction for this membership</td>
                      </tr>`);
                      $('.sale-count').text('0');
                      $('.links').hide();
                  }
  
              },
              error:function(err){
                  console.log(err);
              }
          })
          }
  
          
            
        })



        $('#reference2').change(function(e){
            e.preventDefault();
  
            $.ajaxSetup({
              headers: {
                  "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                      "content"
                  ),
              },
          })

          if($('#reference2').val() == 0){
                location.reload();
          }else{
            let formdata = {id : $('#reference2').val()};
          console.log(formdata);
  
          $.ajax({
              type: "POST",
              url: "changeReference",
              data: formdata,
              dataType: "json",
              beforeSend: function(){
                  $('.confirmdata').hide();
                  $('.confirmdata').empty();
                
              },
              success:function(data){
                  console.log(data);
  
                  
                  $('.confirmdata').show();
                  $('.confirmdata').append(`
                              <tr class="blank_row">
                              <td class="norow" colspan="7"></td>
                              </tr>
                              `);
                  let count = 1;
                  if(data.length >0 ){
                      for (const list of data) {
                      
                      
                              $('.confirmdata').append(`
                             
                              <tr>
                              <td>${count}</td>
                              <td>${list.customer_name}</td>
                              <td>${list.card_id}</td>
                              <td>${list.phone}</td>
                              <td>${list.dob}</td>
                              <td>${list.address}</td>
                            
                              `)
                              count++
                      }
                      $('.cards').text(data.length);
                      $('.links').empty();
                  }else{
  
                      $('.confirmdata').append(`
                      <tr class="blank_row">
                  <td class="norow text-center" colspan="7">There is no customer for this membership</td>
                      </tr>`);
                      $('.cards').text('0');
                      $('.links').hide();
                  }
  
              },
              error:function(err){
                  console.log(err);
              }
          })
          }
  
          
            
        })
  
});


function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}