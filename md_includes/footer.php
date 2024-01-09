  
  <section class="footerWraper">
	<div class="newsletter">
        	<div class="footer-logo">
   	    <img src="assets/images/flc-logo_green.png" alt=""/> 
        	<div class="greenBrdr"></div>
        </div>
        <h3>Sign Up for Our Newsletter</h3>
        <div class="whiteBrdr"></div>
        <form id="newsletterForm" method="post" onSubmit="return subscribe();">
        	<input type="email" required  placeholder="Enter your Email" name="email" id="newsletter"/>
            <input type="hidden" name="mn_url" value="<?php echo MN_url; ?>" />
            <button type="submit" value="SUBMIT" class="has-spinner btn" >SUBMIT</button>
        </form>
    </div>
    <div class="clearfix"></div>
    <footer class="footer">
    	<div class="container">
            <div class="row">
                <div class="col-4">
                	<h3>ABOUT</h3>
                    <p>We are a Dubai Based Production &amp; Model Management Agency servicing national and international clients on Print &amp; Video Productions, Fashion Shows and providing a range of local and international Models, Casts, Kids, Photographers &amp; Stylists for Shoots</p>
                    <div class="footer_social_icons" style="margin-top: 20px;">
                        <a href="https://www.facebook.com/FLCMODELSDUBAI/" target="_blank"><i class="fa fa-facebook"></i></a>
                        <?php /*?><a href="https://twitter.com/username" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="https://plus.google.com/username" target="_blank"><i class="fa fa-google-plus"></i></a><?php */?>
                        <a href="https://www.linkedin.com/showcase/flc-models-&-talents/" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="https://www.youtube.com/channel/UCeER1LUHOuCea0bcNOkpfRw" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="https://www.instagram.com/flcmodels/" target="_blank"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
        
        
            <div class="col-4">
                <div class="footerNav">
                    <h3>INFORMATION</h3>
                    <ul class="footer-link">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="privacy.php">Privacy Policy</a></li>
                        <li><a href="men.php">Men</a></li>
                        <li><a href="women.php">Women</a></li>
                        <li><a href="cast.php">Cast</a></li>
                        
                    </ul>
                   <ul class="footer-link">
                        <li><a href="stylist.php">Stylist</a></li>
                        <li><a href="teens.php">Teens</a></li>
                        <li><a href="kids.php">Kids</a></li>
                        <li><a href="hostess.php">Hostess</a></li>
                        <li><a href="work.php?cat-id=1">Print Campaigns</a></li>
                        <li><a href="work.php?cat-id=2">TVCs &amp; Videos</a></li>
                        <li><a href="work.php?cat-id=4">Catalogue Shoots</a></li>
                        <li><a href="work.php?cat-id=5">Fashion Shows</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-4">
            	<h3>CONTACT</h3>
            	<address>
                	<i class="fa fa-map-marker" aria-hidden="true"></i> 1501 Concord Tower,
Media City, Dubai. <br>

<i class="fa fa-mobile" aria-hidden="true"></i> +971 4 4548684<br>

<i class="fa fa-fax" aria-hidden="true"></i> +971 4 4548654 <br>

<a href="mailto:talk2us@flcmodels.com" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i> talk2us@flcmodels.com </a>
                </address>
            	
            </div>
          </div>
          <?php
		  if (basename($_SERVER['PHP_SELF']) == 'index.php') {
				?>
                <p>&nbsp;  </p>
                <div class="row">
                	<div class="col-4">
                    <div class="fb-page" data-href="https://www.facebook.com/FLCMODELSDUBAI" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-height="324" ><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/FLCMODELSDUBAI/"><a href="https://www.facebook.com/FLCMODELSDUBAI">FLC Production & Model Management</a></blockquote></div></div>
                    </div>
                    <div class="col-4">
                    <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/CompanyProfile" data-id="1895404" data-format="inline"></script>
                    </div>
                    <div class="col-4">
                    	<script src="https://apis.google.com/js/platform.js"></script>

<div class="g-ytsubscribe" data-channelid="UCeER1LUHOuCea0bcNOkpfRw" data-layout="full" data-count="default"></div>
                    </div>
                </div>
				<?php
				
			}
		  ?>
        </div>
        
    </footer>
    <div class="copyright">
        	<i class="fa fa-icon-copyright"></i> 2017 FLC. Powered by <a href="http://iconceptme.com/">iconcept llc</a>
        </div>
  </section>
  
 

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/script.js"></script>
    <script src="https://use.fontawesome.com/515b63365d.js"></script>
    
        
        
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-77111478-2', 'auto');
  ga('send', 'pageview');

</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5955f688e9c6d324a4738135/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();

function subscribe(){
				if(isValidEmailAddress(jQuery('#newsletter').val())){
					jQuery(".has-spinner").toggleClass('active_sub');
					jQuery.ajax({
                        url: 'subscribe.php',
                        data: jQuery("#newsletterForm").serialize(),
                        type: 'POST',
                       
                        success: function (data) {
							jQuery(".has-spinner").toggleClass('active_sub');
                            alert(data);
                        }
                    });
				}
				else{
					alert("Please add your email id")
				}
				return false;
			}
			
			
			
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

</script>
<style type="text/css">
    .spinner {
  display: inline-block;
  opacity: 0;
  max-width: 0;

  -webkit-transition: opacity 0.25s, max-width 0.45s; 
  -moz-transition: opacity 0.25s, max-width 0.45s;
  -o-transition: opacity 0.25s, max-width 0.45s;
  transition: opacity 0.25s, max-width 0.45s; /* Duration fixed since we animate additional hidden width */
}

.has-spinner.active_sub {
  cursor:progress;
}

.has-spinner.active_sub .spinner {
  opacity: 1;
  max-width: 50px; /* More than it will ever come, notice that this affects on animation duration */
}
form#newsletterForm button.has-spinner {
    width: 100px;
    display: block;
    padding: 5px 0;
	border-top-right-radius: 10px;
	border-bottom-right-radius:10px;
    right: 0;
    position: absolute;
    top: 0;
    background: #094;
    color: #fff;
    border: none;
    outline: none;
    height: 40px;
}
form#newsletterForm input[type="email"]{ color:#fff;}
    </style>  
<!--End of Tawk.to Script-->

   <script type="text/javascript">
   var cur_model="";
   jQuery(function(){
	  	jQuery(".models-thumb a").on('click',function(e){
			e.preventDefault();
			view_profile(this);
		})
	  })
   function view_profile(obj){
	   //event.preventDefault();
	   window.scrollTo(0,0);
	   $("#pop_profile").html('<div><div style="text-align:center;">LOADING...<br/><img src="<?php echo MN_url; ?>images/loader.gif"  /></div></div>');
	   cur_model=obj;
		var id_url=$(obj).attr('href');
		var match = RegExp('[?&]res_id=([^&]*)').exec(id_url);
    	var id = match && decodeURIComponent(match[1].replace(/\+/g, ' '));
		$( "#pop_profile" ).show();
		$(".modelsWraper").hide();
		//alert(id_val);
		$( "#pop_profile" ).load( 'profile_min.php?res_id='+id+'&type=<?php echo $type_var; ?>', function( response, status, xhr ) {
		  //alert(status)
		});
	}
	function close_pop(){
		$( "#pop_profile" ).hide();
		$("#pop_profile").html('<div><div style="text-align:center;">LOADING...<br/><img src="<?php echo MN_url; ?>images/loader.gif"  /></div></div>');
		$(".modelsWraper").show();
	}
	function prev_model(){
		if($(cur_model).parent().parent().prev().children().hasClass("models-thumb")){
			var next_md=$(cur_model).parent().parent().prev().children(".models-thumb").children("a");
			view_profile(next_md);
		}
		else{ close_pop() }
	}
	function next_model(){
		
		if($(cur_model).parent().parent().next().children().hasClass("models-thumb")){
			var next_md=$(cur_model).parent().parent().next().children(".models-thumb").children("a");
			view_profile(next_md);
		}
		else{ close_pop() }
	}
   </script>
<?php /*?><script data-cfasync='false' type='text/javascript' src='//p67136.clksite.com/adServe/banners?tid=67136_423352_1&type=slider&size=17'></script><?php */?>
