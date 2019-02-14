$(document).on('click',"#buttonsubmit", submit);
$(document).on("click","#buttonfullsubmit", fullsubmit);

function autokey(event){
  if(event.keyCode == 13){
        submit();
    }
}

function fullautokey(event){
  if(event.keyCode == 13){
        fullsubmit();
    }
}

function submit(){
  var surname = $('#surname').val();
  var name = $('#name').val();
  var patronymic = $('#patronymic').val();
  var count_input_data = 0;

  surname = surname.replace(/[^А-Яа-яЁё]/g, "");
  name = name.replace(/[^А-Яа-яЁё]/g, "");
  patronymic = patronymic.replace(/[^А-Яа-яЁё]/g, "");

  if (surname.length > 0) {count_input_data++;}
  if (name.length > 0) {count_input_data++;}
  if (patronymic.length > 0) {count_input_data++;}

  if (count_input_data == 0) {alert("Введите хоть что-то адекватное!");return;}
  
  $.get("/finder", { surname: surname, name: name, patronymic: patronymic } )
    .done
    (
         function(data) 
         {
              if (data.length < 12) { alert(data);} 
              else 
              { 
                   $("#page_content").html(data); 
                   window.scrollTo(0,0); 
              }
         }
    )

    .fail(function() {alert("fail");});


  }


function fullsubmit(){
  var surname = $('#surname').val();
  var name = $('#name').val();
  var patronymic = $('#patronymic').val();
  var city = $('#city').val();
  var vuz = $('#vuz').val();
  var specialization = $('#specialization').val();
  var from = $('#from').val();
  var to = $('#to').val();

  var count_input_data = 0;

  surname = surname.replace(/[^А-Яа-яЁё]/g, "");
  name = name.replace(/[^А-Яа-яЁё]/g, "");
  patronymic = patronymic.replace(/[^А-Яа-яЁё]/g, "");
  city = city.replace(/[^А-Яа-яЁё]/g, "");
  vuz = vuz.replace(/[^А-Яа-яЁё]/g, "");
  specialization = specialization.replace(/[^\d\.]/g, "");
  from = from.replace(/[^\d]/g, "");
  to = to.replace(/[^\d]/g, "");

  if (surname.length > 0) {count_input_data++;}
  if (name.length > 0) {count_input_data++;}
  if (patronymic.length > 0) {count_input_data++;}
  if (city.length > 0) {count_input_data++;}
  if (vuz.length > 0) {count_input_data++;}
  if (specialization.length > 0) {count_input_data++;}
  if (from.length > 0) {count_input_data++;}
  if (to.length > 0) {count_input_data++;}

  if (count_input_data == 0) {alert("Введите хоть что-то адекватное!");return;}
  
  $.get("/finder", { surname: surname, name: name, patronymic: patronymic, city: city, vuz: vuz, specialization: specialization, from: from, to: to } )
    .done(function(data) {
    if (data.length < 64) {alert(data);} else {
    $("#page_content").html(data);
                         }})
    .fail(function() {
    alert("fail");
  });
  }