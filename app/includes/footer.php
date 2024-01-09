<script type="text/javascript">
    // Fancybox specific
    // To make images pretty. Not important
	function cart_check(){
		$.ajax({
				url: "../ajax.php",
				type: "post",
				data:  {getdata: "cart_size"},
				success: function(message){
					
					//$("#cart_size").html("("+message+")")
					$(".badge1").attr("data-badge",message);
				},
				error:function(){
					//alert("failure");
				}
			})
	}
    $(document).ready(function(){
       cart_check();
    });
    </script>
	<style type="text/css">
    	<?php /*?>.shopping-cart{ color:#F3F3F3;}<?php */?>
		.shopping-cart{ padding-left:0px; height:25px;}
		.footer{ color:#615f5f; padding:10px;}
		.proceed-text{ margin-left: 45px; position:absolute; display: inline-block; margin-top: 5px; color:whitesmoke; padding:5px; border:1px solid#ddd; border-radius:5px; background:#E3E3E3; font-size:14px; -webkit-background-clip: text;
-webkit-animation-name: shining;
-webkit-animation-duration: 3s;
-webkit-animation-iteration-count: infinite;}
@-webkit-keyframes shining
{
0%
{
background-position: left top;
}
100%
{
background: right bottom;
}
}
.badge1[data-badge]:after { top:-3px; right:-10px; width:17px; height:16px;}
    </style>
<?php
 ob_start();
 session_start();
 $cart_disp=0;
 if(isset($_SESSION['models'])){
	if(sizeof($_SESSION['models']) > 0){
		$cart_disp=1;
	}
	
}
?>  
<div class="footer navbar-fixed-bottom navbar-inverse">
<div class="row">
<div class="col-xs-3">
        <a href="index.php">
            <?php /*?><i class="fa fa-home " ></i><?php */?> HOME
        </a>
    </div>
<div class="col-xs-7">
<div class="row">
	<div class="col-xs-6"> <a href="talents.php"> <?php /*?><i class="fa fa-adjust" ></i><?php */?> TALENTS</a></div>
    <div class="col-xs-6"> <a href="works.php"> <?php /*?><i class="fa fa-adjust" ></i><?php */?> WORK</a></div>
</div>
</div>
<div class="col-xs-2">
	<div class="cart_content">
    <a href="cart.php?v=1.1">
    	<?php
			   if($cart_disp > 0){
                    $cart_val= sizeof($_SESSION['models']);
			   }
                else
                    $cart_val=0;
        ?>
        <span class="shopping-cart"> <span class="badge1" data-badge="<?php echo $cart_val; ?>"> <?php /*?><img src="images/cart-white.png" /><?php */?>
        <i class="fa fa-shopping-cart fa-2x" ></i> </span> <?php /*?><span class="proceed-text">Proceed to request</span><?php */?>
            	
      </span> 
    </a>
</div>
</div>
</div>
</div>
