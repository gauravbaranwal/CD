


$( document ).ready(function() {
    console.log( "ready!!" );

    var offset ;
    var matchedcouponcount ;
 console.log('defined offset');
    $('#coupontype option[value=-1]').attr('selected', 'selected');
    document.getElementById("store").value = "";
    $('#category option[value=-1]').attr('selected', 'selected');
    $('#nextPrevious').hide();
    



/*$(function(){
  $('#gobtn').on('click', function(e){
    e.preventDefault();
    $('#nextPrevious').show();
    var coupontype= $("#coupontype").val();
    var store = document.getElementById("store").value ;
    var category = $("#category").val();
    //alert("coupontype : " +  coupontype + "store :"+ store + "category :" + category );
    $.ajax({
      url: 'http://localhost/task/php/ajax.php' ,
      type: 'get',
      data: {'action':'filter','coupontype':coupontype , 'store': store ,'category':category,'offset':offset},
      datatype: "json",
      success: function(data) {
       var result = data['result'];
      var count = data['count'];
      console.log(count + "coupons found!!");
      var newhtml = '<table><th>Couponcode</th><th>Website</th><th>Description</th>';
      $('#result').empty();
      $('#result').append('<h2>'+count+ ' coupons found !! </h2>');
       $.each(result, function(i) {
        newhtml = newhtml + '<tr><td>'+ result[i]['couponcode'] + '</td> <td>' +result[i]['websitename']+'</td><td>'+ result[i]['description'] + '</td></tr>' ;
      });
       newhtml=newhtml+ '</table>'  ;
      $('#result').append(newhtml);
        
      },
      error: function(xhr, desc, err) {
        alert(err);
        //console.log(xhr);
        //console.log("Details: " + desc + "\nError:" + err);
      }
    }); 

     });
}); */


  $('#gobtn').on('click', function(e){
    ajaxfunction(e,'gobtn');
  });

   $('#nextbtn').on('click', function(e){
    ajaxfunction(e,'nextbtn');
  });

    $('#previousbtn').on('click', function(e){
    ajaxfunction(e,'previousbtn');
  });


function ajaxfunction(e, buttonName){
   //alert("fsffr "+buttonName);
    matchedcouponcount = matchedcouponcount ||0 ;
   offset = offset  || 0;
   var couponToShowPerPage = 30 ;

     if(buttonName=='gobtn'){
       offset=0;
       console.log('offset set to 0 in gobtn');
    }
     else if(buttonName=='nextbtn'){
        if((offset+ couponToShowPerPage )<matchedcouponcount){
        offset = offset + couponToShowPerPage;
       console.log('offset set to +'+couponToShowPerPage+' in nextbtn');
    }

     }
     else if(buttonName=='previousbtn'){
       if(offset>couponToShowPerPage){
        //offset = offset -30 ;
        offset = offset - couponToShowPerPage;
        console.log('offset set to -'+couponToShowPerPage+' in prevbtn');
       }
       else{
        offset = 0;
        console.log('offset set to 0 in prevbtn');
       }
     }
    e.preventDefault();
    $('#nextPrevious').show();
    var coupontype= $("#coupontype").val();
    var store = document.getElementById("store").value ;
    var category = $("#category").val();
    //alert("coupontype : " +  coupontype + "store :"+ store + "category :" + category );
    $.ajax({
      url: 'http://localhost/task/php/ajax.php' ,
      type: 'get',
      data: {'action':'filter','coupontype':coupontype , 'store': store ,'category':category,'offset':offset},
      datatype: "json",
      success: function(data) {
       var result = data['result'];
      var count = data['count'];
      console.log(count + "coupons found!!");
      matchedcouponcount = count ;
      var newhtml = '<table><th>Couponcode</th><th>Website</th><th>Description</th>';
      $('#result').empty();
      $('#result').append('<h2>'+count+ ' coupons found !! </h2>');
       $.each(result, function(i) {
        newhtml = newhtml + '<tr><td>'+ result[i]['couponcode'] + '</td> <td>' +result[i]['websitename']+'</td><td>'+ result[i]['description'] + '</td></tr>' ;
      });
       newhtml=newhtml+ '</table>'  ;
      $('#result').append(newhtml);
        
      },
      error: function(xhr, desc, err) {
        alert(err);
        //console.log(xhr);
        //console.log("Details: " + desc + "\nError:" + err);
      }
    }); 

     };



});



 