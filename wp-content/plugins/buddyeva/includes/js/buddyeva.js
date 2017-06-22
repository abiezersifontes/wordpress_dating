jQuery(document).ready(function($){

    $( '#regalo').click(function() {
        regalo();
    });

    function regalo(){
      $('#ventana-regalo').modal("show");
    }

});
