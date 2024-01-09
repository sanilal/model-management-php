<!DOCTYPE html>
<html lang="en">
  <head>
 <title>FLC Production & Model Management PORTFOLIO - Dubai Models , Model Agency Dubai  , FLC Models & Talents</title>
	<?php include_once('md_includes/head.php'); ?>
     
 
<link rel="stylesheet" type="text/css" href="<?php echo MN_url; ?>css/jquery.fancybox.css?v=2.1.4" media="screen" />

</head>

  <body>
    
    <?php include_once('md_includes/header.php'); ?>
        
       
   <section class="aboutWraper">
       	  <img src="assets/images/shortlist.jpg" class="img-fluid" alt=""/>
          <h2 class="white">WISHLIST</h2> 
          
          <div class="container mt-5">
          	<div class="row">
               <div class="col-12 mt-2"> 
                	<table id="wishlist">
                      <tr>
                        <th>SI. No.</th>
                        <th>&nbsp;</th>
                        <th>Model</th>
                        <th>Age</th>
                        <th>&nbsp;</th>
                      </tr>
                      <tr>
                        <td>01.</td>
                        <td><img src="assets/images/models/F2725_01.jpeg" style="width:80px; height: auto;" alt=""/></td>
                        <td>Maria Anders</td>
                        <td>22</td>
                        <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                      </tr>
                        <tr>
                        <td>02.</td>
                        <td><img src="assets/images/models/F9183_01.jpeg" style="width:80px; height: auto;" alt=""/></td>
                        <td>Maria Anders</td>
                        <td>26</td>
                        <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                      </tr>
				</table>
                <div class="enqform">
                	<form>
                    	<input type="text" placeholder="Name" />
                        <input type="email" placeholder="Email" />
                        <input type="text" placeholder="Company" />
                        <input type="text" placeholder="Contact number" />
                        <textarea placeholder="Remarks"></textarea>
                        <textarea placeholder="Address"></textarea>
                        <input type="submit" value="Submit" />
                    </form>
                </div>
                </div>
                
            </div>
          </div>
   </section>

  
  <?php include_once('md_includes/footer.php'); ?>
  <script type="text/javascript" src="<?php echo MN_url; ?>js/jquery.fancybox.js?v=2.1.4"></script>
   <script type="text/javascript">
	$(function(){
		$('.fancybox_v').fancybox({
				width: 500,
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});
		//
		$('.fancybox').fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});
			$('.fancybox_m').fancybox({width: 970});
			//
			$(".work_item a").hover(
				function(){$(this).find(".absl_div").fadeTo( "fast", 1 );},
				function(){$(this).find(".absl_div").fadeTo( "fast", 0 );}
			);
	})
	
</script>
  </body>
</html>