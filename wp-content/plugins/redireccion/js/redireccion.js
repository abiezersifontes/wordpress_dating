jQuery(document).ready(function($){
    var urlab = window.location.protocol + "//" + window.location.host + "/" +  'wp-admin/admin-ajax.php';
    $.ajaxSetup({ cache: false });

  $.get(urlab,{action:'ventana_modal'},function(response){
      var resp = response;
      var urlactual = window.location.href;

      var host = window.location.protocol + "//" + window.location.host + "/";
     if(urlactual != host){
        if(urlactual.indexOf('/inicio') > 0){
          if(resp == 2){
            $('#mostrarmodal').modal("show");
          }
        }
     }
  });

  $( '#edit-feel').click(function() {
      feel_4545();
  });

  function feel_4545(){
    $('#feel_show').modal("show");
  }


  $("#btn_guardar_feel").click(function (e) {
    e.preventDefault();

	   var feel_wc = $("#feel_wc").val();
       $.post(urlab,{ feel_wc : feel_wc, action:'feel'},function(response){
      location.reload();
     		});
        $('#feel_show').modal("hide");
	});

});
