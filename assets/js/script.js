function init(){
  $("#quantite").css("border-color","");
  $('#quantite').val(0);
  $('#erreurQuantite').html('');
}

function modalAction(id,type){
  init();
  var tab = ['ENLEVER','RAVITAILLER'];
    $.ajax({
       type:"POST",
           url      : "<?php echo base_url(); ?>Produit_Controller/getProduit", 
           data     : {
             idProduit: id
           },
           cache    : false,
           dataType : "json",
           success  : function(data) { 
            $('#myModalLabel').text(tab[type]);
            $('#idProduit').val(id);
            $('#produit').val(data[0].NOM);
            
            if(type === 1){
              $('#ravitailler').show();
              $('#enlever').hide();
            }
            else{
              $('#ravitailler').hide();
              $('#enlever').show();
            }

            $('#modalAction').modal();   
           },
           error : function(status, diso){
             
           }       
      }); 
}

$('#ravitailler').click(function(){
    var idProduit = $('#idProduit').val();
    var quantite = $('#quantite').val();
    $.ajax({
       type:"POST",
           url      : "<?php echo base_url(); ?>Produit_Controller/ravitailler", 
           data     : {
             idProduit: idProduit,
             quantite: quantite
           },
           cache    : false,
           dataType : "json",
           success  : function(data) { 
            if (data.success) {
              $('#ligne_'+idProduit).html(data.stock);
              $('#modalAction').modal('hide');  
            }
            else{
              $("#quantite").css("border-color","red");
              $('#erreurQuantite').html(data.erreur);
            } 
           },
           error : function(status, diso){
             
           }       
      }); 
});

$('#enlever').click(function(){
    var idProduit = $('#idProduit').val();
    var quantite = $('#quantite').val();
    $.ajax({
       type:"POST",
           url      : "<?php echo base_url(); ?>Produit_Controller/enlever", 
           data     : {
             idProduit: idProduit,
             quantite: quantite
           },
           cache    : false,
           dataType : "json",
           success  : function(data) { 
            if (data.success) {
              $('#ligne_'+idProduit).html(data.stock);
              $('#modalAction').modal('hide');  
            }
            else{
              $("#quantite").css("border-color","red");
              $('#erreurQuantite').html(data.erreur);
            } 
           },
           error : function(status, diso){
             
           }       
      }); 
});