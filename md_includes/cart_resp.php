<style type="text/css">					
					img.grayscale {
						filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+ */
						filter: gray; /* IE6-9 */
						-webkit-filter: grayscale(100%); /* Chrome 19+ & Safari 6+ */
						-webkit-transition: all .6s ease; /* Fade to color for Chrome and Safari */
						-webkit-backface-visibility: hidden; /* Fix for transition flickering */
					}
					
					a.bwWrapper:hover img.grayscale {
						filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 1 0\'/></filter></svg>#grayscale");
						-webkit-filter: grayscale(0%);
					}
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
    <a href="#cart.php">
        <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span id="cart_text">SHORTLIST</span> 
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