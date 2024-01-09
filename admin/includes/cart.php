	<style type="text/css">
        .shopping-cart {
            display: inline-block;
            background: url('../image/cart.png') no-repeat 0 0;
            padding-left:29px;
            height: 24px;
            color:#666; font-size:14px;
        }
    </style>
    <script type="text/javascript">
    // Fancybox specific
    // To make images pretty. Not important
    $(document).ready(function(){
       $.ajax({
				url: "ajax.php",
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
<div style="float:right; margin-top:-2px; overflow:auto">
	<div class="cart_content">
    <a href="cart.php">
            <span class="shopping-cart"> SHORTLIST 
                <span id="cart_size">
                <?php
                ob_start();
                session_start();
                if(isset($_SESSION['models_man'])){
                    echo "(".sizeof($_SESSION['models_man']).")";
                }
                else
                    echo "(0)";
                ?>
                </span> 
          </span> 
        </a>
        </div>
</div>