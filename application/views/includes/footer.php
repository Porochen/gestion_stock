    </div>

    <!-- Wrapper End-->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="javascript:void(0)">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright <?= date('Y')?> <a href="#">UYC</a> All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <!-- <script data-cfasync="false" src="<?php echo base_url() ?>assets/cloudflare-static/email-decode.min.js"></script> -->
    <!-- <script src="http://iqonic.design/themes/prox/html/assets/js/backend-bundle.min.js"></script> -->
    <script src="<?php echo base_url() ?>assets/js/backend-bundle.min.js"></script>
    
    <!-- Flextree Javascript-->
    <script src="<?php echo base_url() ?>assets/js/flex-tree.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/tree.js"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/table-treeview.js"></script>
    
    <!-- Masonary Gallery Javascript -->
    <script src="<?php echo base_url() ?>assets/js/masonry.pkgd.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/imagesloaded.pkgd.min.js"></script>
    
    <!-- Mapbox Javascript -->
    <script src="<?php echo base_url() ?>assets/js/mapbox-gl.js"></script>
    <script src="<?php echo base_url() ?>assets/js/mapbox.js"></script>
    
    <!-- Fullcalender Javascript -->
    <script src='<?php echo base_url() ?>assets/fullcalendar/core/main.js'></script>
    <script src='<?php echo base_url() ?>assets/fullcalendar/daygrid/main.js'></script>
    <script src='<?php echo base_url() ?>assets/fullcalendar/timegrid/main.js'></script>
    <script src='<?php echo base_url() ?>assets/fullcalendar/list/main.js'></script>
    
    <!-- SweetAlert JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/sweetalert.js"></script>
    
    <!-- Vectoe Map JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/vector-map-custom.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/customizer.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/chart-custom.js"></script>
    
    <!-- slider JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/slider.js"></script>
    
    <!-- app JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/app.js"></script>
    <script src="<?php echo base_url() ?>assets/font/fa-solid-900.woff2"></script>
    <script src="<?php echo base_url() ?>assets/font/remixicon.woff2?t=1590207869815"></script>
    <script src="<?php echo base_url() ?>assets/font/la-solid-900.woff2"></script>
    <script src="<?php echo base_url() ?>assets/font/la-solid-900.woff2"></script>
    
    <script src="<?php echo base_url() ?>assets/font/remixicon.woff2?t=1590207869815"></script>


    
    <script type="text/javascript">
        function list_on_load(){
            $.ajax({
                   type:'post',
                   url:'<?=base_url()?>produits/Produits/listing_to_card',
                   data:{},
                   dataType:'json',
                   // processData: false,
                   success:function(data){
                     if (data.total!=0) {
                      $('.total_cart').html(data.total);
                      $('#cart_detail_header').html(data.output);
                     }else{
                      $('.total_cart').html(data.total);
                      $('#cart_detail_header').html('<h6 class="text-center text-danger">no data found</h6>');
                     }
                   }
                }); 
       }



    </script>






</body>

</html>