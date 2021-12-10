$(document).on('click',"#buttonforsource", forsource);
$(document).on("click","#buttonforfinalsource", forfinalsource);
$(document).on('click',"#buttonforuz", foruz);
$(document).on('click',"#buttonforcity", forcity);
$(document).on('click',"#buttonregexp", forregexp);
$(document).on('click',"#buttonforback", forback);

function forsource(){
  var bigtext = $('#bigtext').val();//Содержание сорса
  var name_uz = $('#name_uz').val();
  var url_source = $('#url_source').val();
  var date_day = $('#date_day').val();
  var date_month = $('#date_month').val();
  var date_year = $('#date_year').val();
  var comment = $('#comment').val();
  var readmode = $('#readmode').is(':checked');
  var token = $('#_token').val();
  
  $.post("newsource", { bigtext: bigtext, name_uz: name_uz, date_day: date_day, date_month: date_month, date_year: date_year, url_source: url_source, comment: comment, readmode: readmode, _token: token } )
    .done(function(data) {//alert("Data Loaded: " + data);$("#bigtext").val("");$("#url_source").val("");
    sessionStorage.nameuz = name_uz;
    sessionStorage.dateday = date_day;
    sessionStorage.datemonth = date_month;
    sessionStorage.dateyear = date_year;
    sessionStorage.url = url_source;
    sessionStorage.bigtext = bigtext;
    sessionStorage.comment = comment;
    sessionStorage.readmode = readmode;
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
  $.post("transformers/addersource.php", {finalsource: finalsource, finalhelp: finalhelp, _token: token} )
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
  var token = $('#_token').val();
  $.post("/newcampuse", { city_code: city_code, full_name_uz: full_name_uz, abb_name_uz: abb_name_uz, url_site: url_site, _token: token } )
    .done(function(data) {
        if(Number(data)==200){
                alert("ok");$("#city_code").val("");$("#full_name_uz").val("");$("#abb_name_uz").val("");$("#url_site").val("");}
                else{alert(data);}
                          })
    .fail(function() {
    alert("fail");
    $("#city_code").val("");$("#full_name_uz").val("");$("#abb_name_uz").val("");$("#url_site").val("");
  });
  }

function forcity(){
  var city = $('#city_name').val();
  var token = $('#_token').val();
  $.post("/newcity", {city: city, _token: token} )
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
  var token = $('#_token').val();
  $.post("/newregex", {regexper: regexper, _token: token} )
    .done(function(data) {
        if(Number(data)==200){
                alert("ok");}
                else{alert(data);}
                          })
    .fail(function() {
    alert("fail");
  });
  }

function forback(){
  $.post("transformers/preaddersource.php", { back: "100", _token: token } )
    .done(function(data) {
    $("#source").html(data);
    window.scrollTo(0,0);
                         })
    .fail(function(data) {
    alert("fail");
  });
  }