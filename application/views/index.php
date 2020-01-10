<!DOCTYPE html>
<html>
<head>
	<title>Gestion de stock épicerie</title>
  <link rel="stylesheet" type="text/css" href="<?php echo css_url("style"); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo css_url("bootstrap.min"); ?>">
</head>
<body>
    <section id="liste_produits">
        <h1>Liste des produits</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>IMAGE</th>
                                <th>PRODUITS</th>
                                <th>STOCK (EN KG)</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody id="produits">
                            <?php foreach ($produits as $row) { ?>
                                <tr>
                                    <td><?=$row->ID_PRODUITS; ?></td>
                                    <td><img src="<?php echo img_url($row->IMAGE); ?>" title="<?=$row->NOM; ?>"></td>
                                    <td><?=$row->NOM; ?></td>
                                    <td id="ligne_<?=$row->ID_PRODUITS; ?>" style="text-align:right;"><?=$row->STOCK; ?></td>
                                    <td>
                                        <button class="btn btn-success" onclick="modalAction(<?=$row->ID_PRODUITS; ?>,1);" title="Ravitailler">RAVITAILLER</button>
                                        <button class="btn btn-danger" onclick="modalAction(<?=$row->ID_PRODUITS; ?>,0);" title="Enlever">ENLEVER</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    

    <?php include('include/modalAction.php'); ?>
    
    <script src="<?php echo js_url("jquery-3.4.1.min"); ?>"></script>
    <script src="<?php echo js_url("bootstrap"); ?>"></script>

    <script type="text/javascript">
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
    </script>

    </body>
</html>