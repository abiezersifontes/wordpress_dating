jQuery(document).ready(function($){
  var s = $('div.info_model').height();
  var g = $('div.gallerywoo').height();
  var zoom = window.innerWidth;

  $( function() {
    $( "#datepicker-md" ).datepicker();
  });

  $.ajaxSetup({ cache: false });
        var urlab = window.location.protocol + "//" + window.location.host + "/" +  'wp-admin/admin-ajax.php';

      $('#guardar').click(function(event){
        val(event);
      });


      function val(event){
        event.preventDefault();
        var reg_username = $('#reg_username').val();
        var reg_password = $('#reg_password').val();
        var reg_email = $('#reg_email').val();
        var reg_preference = $('#reg_preference').val();
        var url = window.location+'wp-admin/admin-ajax.php';
        var url2 = window.location+'inicio';

        var data = {
            email : reg_email,
            username : reg_username,
            preference : reg_preference,
            password : reg_password
        };

        $.post(url,{ data , action:'imprimir'},function(response){

            var json = JSON.parse(response);

            do{
            if(json['cod']==1){
            $('#mensaje3').fadeOut();
            $('#mensaje4').fadeOut();

            if(!$('.mensaje2').length > 0){
                    $('#mensaje2').append("<p class='mensaje2'>"+json['mensaje']+"</p>");
                    $('#mensaje2').fadeIn();
                    $('input#reg_username').addClass('input_error');
                }else{
                    $('#mensaje2').fadeIn();
                }
            }


            if(json['cod']==2){
                $('#mensaje2').fadeOut();
                $('#mensaje4').fadeOut();
                if(!$('.mensaje3').length > 0){
                    $('#mensaje3').append("<p class='mensaje3'>"+json['mensaje']+"</p>");
                    $('#mensaje3').fadeIn();

                }else{
                    $('#mensaje3').fadeIn();
                }
            }

            if(json['cod']==3){
                $('#mensaje2').fadeOut();
                $('#mensaje3').fadeOut();
                if(!$('.mensaje4').length > 0){
                    $('#mensaje4').append("<p class='mensaje4'>"+json['mensaje']+"</p>");
                    $('#mensaje4').fadeIn();

                }else{
                    $('#mensaje4').fadeIn();
                }
            }

            if(json['cod']==4){
                $('#mensaje2').fadeOut();
                $('#mensaje3').fadeOut();
                if(!$('.mensaje1').length > 0){
                    $('#mensaje1').append("<p class='mensaje4'>"+json['mensaje']+"</p>");
                    $('#mensaje1').fadeIn();

                }else{
                    $('#mensaje1').fadeIn();
                }
            }

            if(json['cod']==5){
            $('#mensaje3').fadeOut();
            $('#mensaje4').fadeOut();

            if(!$('.mensaje2').length > 0){
                    $('#mensaje2').append("<p class='mensaje2'>"+json['mensaje']+"</p>");
                    $('#mensaje2').fadeIn();
                }else{
                    $('.mensaje2').remove();
                    $('#mensaje2').fadeIn();
                    $('#mensaje2').append("<p class='mensaje2'>"+json['mensaje']+"</p>");
                }
            }

            if(json['cod']==6){
                $('#mensaje2').fadeOut();
                $('#mensaje4').fadeOut();
                if(!$('.mensaje3').length > 0){
                    $('#mensaje3').append("<p class='mensaje3'>"+json['mensaje']+"</p>");
                    $('#mensaje3').fadeIn();

                }else{
                    $('.mensaje3').remove();
                    $('#mensaje3').fadeIn();
                    $('#mensaje3').append("<p class='mensaje3'>"+json['mensaje']+"</p>");
                }
            }

            if(json['cod']==8){
                $('#mensaje2').fadeOut();
                $('#mensaje4').fadeOut();
                if(!$('.mensaje3').length > 0){
                    $('#mensaje3').append("<p class='mensaje3'>"+json['mensaje']+"</p>");
                    $('#mensaje3').fadeIn();

                }else{
                    $('.mensaje3').remove();
                    $('#mensaje3').fadeIn();
                    $('#mensaje3').append("<p class='mensaje3'>"+json['mensaje']+"</p>");
                }
            }

            if(json['cod']==9){
            $('#mensaje3').fadeOut();
            $('#mensaje4').fadeOut();

            if(!$('.mensaje2').length > 0){
                    $('#mensaje2').append("<p class='mensaje2'>"+json['mensaje']+"</p>");
                    $('#mensaje2').fadeIn();
                    $('input#reg_username').addClass('input_error');
                }else{
                    $('#mensaje2').fadeIn();
                }
            }

            }while(!json['cod']==7)

                if(json['cod']==7){
                    window.location.href = url2;
                }
        });
      }

  $("input.search-field1").keyup(function(){
    var valor = $("input.search-field1").val();
    if(valor != ''){
    $.get(urlab, {nombre: valor, action: 'busq_ajax'}, function(response){
      var resp = response.substring(0,response.length-1);
        $('.submit-button1').addClass('loading');
        $('div.autocomplete-suggestions').fadeIn();
        $('div#autocompletar').html("<p id='resp'>"+resp+"</p>");
    });
  }else{
    $('.submit-button1').removeClass('loading');
    $('p#resp').remove();
    }
  });

    $(window).scroll(function() {
      posicionar();
});

    function posicionar() {
    var scrolltop = $(document).scrollTop() +900;
    var zoom = window.innerWidth;
    var documento = $(document).scrollTop();
    var xx = (s - g);
    var str = "translateY("+documento+"px)"

    if (screen.width>= 850){
        if(zoom >850){
            if ($(window).scrollTop() >= 0 && $(window).scrollTop()<xx){
                $('div.elemento_fijo').css({
                  "-webkit-transform" : str})
                  $('div.gallerywoo').css({
                    "-webkit-transform" : str})
            }

            if (scrolltop > xx){
                $('div.elemento_fijo').css({
                  "-webkit-transform" : "translateY(none)"})
                $('div.gallerywoo').css({
                  "-webkit-transform" : "translateY(none)"})
          }
        }
      }
}

     function actualizarTama() {
       $("div.principal_profile").css("zoom", window.innerWidth / 1300);
   }

     $( window ).resize(function() {
           actualizarTama();
      });
});
