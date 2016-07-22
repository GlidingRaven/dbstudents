$(document).on('click',"#buttonforsource", forsource);
$(document).on("click","#buttonforfinalsource", forfinalsource);
$(document).on('click',"#buttonforuz", foruz);
$(document).on('click',"#buttonforcity", forcity);
$(document).on('click',"#buttonregexp", forregexp);

function forsource(){
  var bigtext = $('#bigtext').val();//Содержание сорса
  var name_uz = $('#name_uz').val();
  var url_source = $('#url_source').val();
  var date_day = $('#date_day').val();
  var date_month = $('#date_month').val();
  var date_year = $('#date_year').val();
  
  $.post("transformers/preaddersource.php", { bigtext: bigtext, name_uz: name_uz, date_day: date_day, date_month: date_month, date_year: date_year, url_source: url_source } )
    .done(function(data) {//alert("Data Loaded: " + data);$("#bigtext").val("");$("#url_source").val("");
    $("#source").html(data);
    window.scrollTo(0,0);
                         })
    .fail(function(data) {
    alert("fail");
  });
  }

function forfinalsource(){
  var finalsource = $("#injson").val();
  var finalhelp = $("#helpjson").val();
  $.post("transformers/addersource.php", {finalsource: finalsource, finalhelp: finalhelp} )
    .done(function(data) {
      if(Number(data)==200){alert("ok");location.reload();}
                else{alert("Eror");$("#source").html(data);}
                          })
    .fail(function() {
    alert("fail");
  });
  }

function foruz(){
  var city_code = $('#city_code').val();
  var full_name_uz = $('#full_name_uz').val();
  var abb_name_uz = $('#abb_name_uz').val();
  var url_site = $('#url_site').val();
  $.post("transformers/adderuz.php", { city_code: city_code, full_name_uz: full_name_uz, abb_name_uz: abb_name_uz, url_site: url_site } )
    .done(function(data) {
        if(Number(data)==200){
                alert("ok");$("#city_code").val("");$("#full_name_uz").val("");$("#abb_name_uz").val("");$("#url_site").val("");}
                else{alert("Eror: " + data);}
                          })
    .fail(function() {
    alert("fail");
    $("#city_code").val("");$("#full_name_uz").val("");$("#abb_name_uz").val("");$("#url_site").val("");
  });
  }

function forcity(){
  var city = $('#city_name').val();
  $.post("transformers/addercity.php", {city: city} )
    .done(function(data) {
        if(Number(data)==200){
                alert("ok");
                $("#city").val("");}
                else{alert("Eror: " + data);}
                          })
    .fail(function() {
    alert("fail");
    $("#city").val("");
  });
  }

function forregexp(){
  var regexper = $('#regular_exp').val();
  $.post("transformers/regexper.php", {regexper: regexper} )
    .done(function(data) {
        if(Number(data)==200){
                alert("ok");}
                else{alert("Eror: " + data);}
                          })
    .fail(function() {
    alert("fail");
  });
  }