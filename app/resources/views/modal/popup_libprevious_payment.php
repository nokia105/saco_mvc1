       <!-- 
       -->

                      
    
      <!-- Select2 -->

 
    <script type="text/javascript">
    
    function showAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'false'});
    
        
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
            
                jQuery('#modal_ajax .modal-body').html(response);
                closeOnEscape: false;
            
            dialogClass: "noclose";
            }
        });
    }
</script>

    
    <!-- (Ajax Modal)-->
          
     
          
    
    <script type="text/javascript">
    function confirm_modal(delete_url)
    {
        jQuery('#modal-4').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
      function confirm_post(delete_url)
    {
        jQuery('#modal-post').modal('show', {backdrop: 'static'});
        /*document.getElementById('delete_link').setAttribute('href' , delete_url);*/
    }
    </script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog" >
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo 'delete';?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'cancel';?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-post">
        <div class="modal-dialog" >
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">The posted amount cannot be edited! Do you want to post this?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo 'delete';?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'cancel';?></button>
                </div>
            </div>
        </div>
    </div>


              <div   class="modal fade" id="modal_ajax" data-keyboard="false" data-backdrop="static" >
        <div class="modal-dialog" style="width:60%;">
            <div class="modal-content" ">
                
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; z-index:1000;">X</button>
                    <h1></h1>
                </div>
                
                <div class="modal-body" style="margin:0px;"  >
                
                       
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



   