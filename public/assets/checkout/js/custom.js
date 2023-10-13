function openCity(evt, cityName) {
  evt.preventDefault();

  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");

  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

$(document).ready(function() {

  $('#form-credito').show();
  $('#form-boleto').hide();
  $('#form-pix').hide();
  $('#form-outros').hide();
  
  $('#credito').on('change', function() {
    if ($(this).is(':checked')) {
      $('#form-credito').show();
      $('#form-boleto').hide();
      $('#form-pix').hide();
      $('#form-outros').hide();
    }
  });
  
  $('#boleto').on('change', function() {
    if ($(this).is(':checked')) {
      $('#form-boleto').show();
      $('#form-credito').hide();
      $('#form-pix').hide();
      $('#form-outros').hide();
    }
  });
  
  $('#pix').on('change', function() {
    if ($(this).is(':checked')) {
      $('#form-pix').show();
      $('#form-boleto').hide();
      $('#form-credito').hide();
      $('#form-outros').hide();
    }
  });
  
  $('#vermais').on('change', function() {
    if ($(this).is(':checked')) {
      $('#form-outros').show();
      $('#form-boleto').hide();
      $('#form-pix').hide();
      $('#form-credito').hide();
    }
  });
});