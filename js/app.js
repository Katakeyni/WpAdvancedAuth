jQuery(document).ready(function($){

  jQuery('ul.tabs').tabs();
  jQuery('.modal-trigger').leanModal();


 jQuery("#form_create_group").on('submit', function(e){
     e.preventDefault();
    var fd = new FormData(document.getElementById("form_create_group"));
    fd.append("action", "create_new_groupe_action");
    
    jQuery.ajax({
      url: ajaxurl,
      type: "POST",
      data: fd,
      processData: false,  // indique à jQuery de ne pas traiter les données
      contentType: false,   // indique à jQuery de ne pas configurer le contentType
      success: function(data){
        var response = JSON.parse(data);
          Materialize.toast("<span class='toast_inscription'>"+response.message+" </span>", 5000);     
          window.location.relaod();
      }
    });

  });
});