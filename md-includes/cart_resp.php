<style type="text/css">
.cart_content{ text-align:right;}
.cart_content a{ text-decoration:none;}	
.shopping-cart{  background:#094; color: #fff; padding:8px 5px; font-size: 16px}
.shopping-cart .fa-shopping-cart{border-radius: 6px; background:#fff; color:#094; padding:3px;}
#cart_text,#cart_size{ font-size:16px;}	
</style>
<script type="text/javascript">
    // Fancybox specific
    // To make images pretty. Not important
    $(document).ready(function(){
       $.ajax({
				url: "<?php echo MN_url; ?>ajax.php",
				type: "post",
				data:  {getdata: "cart_size"},
				success: function(message){
					$("#cart_size").html("("+message+")")
				},
				error:function(){
					//alert("failure");
				}
			})
    });
    </script>
<div class="cart_content">
    <a href="cart.php">
        <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp;<span id="cart_text">Shortlist</span> 
            <span id="cart_size">
            	<?php
                ob_start();
                session_start();
                if(isset($_SESSION['models'])){
                    echo "(".sizeof($_SESSION['models']).")";
                }
                else
                    echo "(0)";
                ?>
            </span> 
      </span> 
    </a>
</div>