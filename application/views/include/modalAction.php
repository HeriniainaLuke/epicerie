<!-- Modal add new modal -->
<div class="modal fade" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-content" role="document">
        <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="myModalLabel"></h4>
             </div>
             <form id="form_payer">
             <input type="hidden" id="idProduit" class="form-control">
             <div class="modal-body">
                <div class="row" style=" padding: 15px;">
                  <div class="form-group col-xs-6">
                    <span> Produit :</span>
                    <input type="text" id="produit" value="" class="form-control" disabled>
                  </div>
                  
                  <div class="form-group col-xs-6">
                    <span> Quantité (en kg) :</span>
                    <input type="number" id="quantite" style="text-align: right;" value="0" class="form-control champs">
                    <div id="erreurQuantite" class="erreur" style="color:red;"></div>
                  </div>
              </div>
        </div>
             <div class="modal-footer">
              <input type="button" class="btn btn-primary" id="ravitailler" value="Valider" style="display: none;">
              <input type="button" class="btn btn-primary" id="enlever" value="Valider" style="display: none;">
              <button type="button" onclick="" class="btn btn-default" data-dismiss="modal">Annuler</button>               
             </div>
             </form>
        </div>
    </div>
</div>