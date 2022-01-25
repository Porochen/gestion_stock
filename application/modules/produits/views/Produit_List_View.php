<?php include VIEWPATH.'includes/header.php' ;?>
<?php include VIEWPATH.'includes/menu_principale.php' ;?>
<?php include VIEWPATH.'includes/menu_header.php' ;?>


<style type="text/css">
body{
    /*background: -webkit-linear-gradient(left, #3931af, #00c6ff);*/
}









</style>

 <div class="content-page">
    <div class="container-fluid">
      <div class="row">


    


<div class="card col-md-12" style="background-color:#f4f5f8;">
  <div class="card-body">

<div class="row">
  <?php 

      if(!empty($this->session->flashdata('sms')))
        echo $this->session->flashdata('sms');
   ?>
</div>
<div class="row">

<div class="col-sm-12">
  <div class="panel">
    <div class="panel-body p-t-10">
      <div class="media-main">

      <div class="row mb-3">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body p-t-0">
                    <div class="input-group">
                        <input type="text" onkeyup="getList(this.value)" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Recherche">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row" id="get_liste"></div>
     </div>
  </div>
</div>


</div>
</div>
</div>
</div> 





      </div>
    </div>
</div>





<?php include VIEWPATH.'includes/footer.php' ;?>



<script>
  $(document).ready(function(){
   // $('#msg').delay('slow').fadeOut(5000);
   getList(critere="")
 });
</script>
<script>
function getList(critere=""){
          
         $.ajax({
            url: "<?=base_url('produits/Produits/listing/');?>"+critere,
            type: "POST",
            dataType: 'JSON',
            processData: false,  
            contentType: false,
            beforeSend:function () { 
              $('#get_liste').html("<br><div class='col-lg-12'><center><font style='font-size:46px'><i class='fa fa-46px fa-spin fa-spinner'></i><span class='sr-only'>Loading...</span></font></center></div>");
            },
            error:function() {
              $('#get_liste').html('<div class="alert alert-danger col-md-12"><h6 classtext-center>Erreur : Veuillez réessayer ! </h6></div>');
            },
            success: function(data){

              $('#get_liste').html(data);
              // alert('yes')
          }
      }); 
   }

</script> 