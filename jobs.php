<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FLC Production & Model Management - Jobs List</title>
    <meta name="author" content="www.flcmodels.com"/>
    <meta name="Description" content="FLC Models & Talents provide you with a range of local & international models according to your needs for Photo-shoots, Film, TVC, Fashion Shows, Music videos and more Dubai , UAE .Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels."/>
    
    <meta name="Keywords" content="Dubai Modeling Agency, UAE Modeling Agency, Model Management, Casting Agency, Talent Management, Fashion Show, Shoot Coordination, Print Shoot, Line Production, TV Commercials, Film Production, Location,Permissions, Artists & Entertainers, Photographers, Hair Stylist, Wardrobe stylist, Make-up artist, Food Stylist, Portfolios, Editorial shoot, Screen test, Actor's in Dubai, Actresses in DubaiModels, Photographers, Stylists, Talents, Artists, Shoot Coordination, modeling agency, Fashion Shows, print shoot, line production, cast, casting, TVC, Hair stylist, Wardrobe stylist, Portfolio, Make-up artist "/>
    <meta name="robots" content="index,follow"/>
    <meta name="rating" content="General"/>

   <?php include_once("includes/head_common.php"); ?>
   
</head>

<body>  
    
  <div class="container">
    	 <?php include_once("includes/header.php"); ?>
        
    </div>
    
    <!-- Page Content -->
    <div class="container inner_content">
			<div class="punch_cont">
        	<div class="text-left">
                <a class="text_none" href="jobs.php"><span class="title-grey">JOBS &gt;</span></a>
               
                <span>
                <?php
					if(isset($_POST['gender'])){
						echo "Search Result";
					}
					else{
						echo "List";
					}
				?>
                </span>
            </div>
        </div>
        <!-- Jumbotron Header -->
         <?php /*?><header class="hero-spacer">
        	<div>
                <a class="text_none" href="cast.php"><span class="title-grey">CAST &gt;</span></a>
                <span class="title-red">
                	<?php
					if(isset($_POST['gender'])){
						echo "Search Result";
					}
					else{
						echo "Search";
					}
				?>
                </span>
                
                <?php include_once("includes/cart_resp.php"); ?>
            </div>
                        
        </header><?php */?>

       <!-- <hr>-->
		
        <!-- Title -->
         <?php
		  require_once("classes/Models.php");
		  $models = new Models();
			  ?>
      
		 <style type="text/css">
		 	.list-cat{ margin-bottom:10px}
         	.list-cat ul{ clear:both; margin:0; padding:0}
			.list-cat ul li{ list-style-type:none}
			.list-cat ul li { display:inline-block; padding:5px 10px; margin-right:8px; border:1px solid #009944; background:whitesmoke; }
			.list-cat ul li.active{ background:#009944;}
			.list-cat ul li.active a{ color:#fff;}
			.list-cat ul li a{ color:#666; font-size:14px}
			@media (min-width: 768px) {
				<?php /*?>.search-cont{ padding-left:40px}<?php */?>
			}
			#job-list-cont{ min-height:350px}
			.job_cont{ background:whitesmoke; margin:0 25px 25px 0;}
			.job_date, .job_title, .job_desc, .job_cat, .job_link{ padding:5px 15px}
			.job_image{ height: 200px; overflow:hidden}
			.job_image img{ min-height:200px}
			.job_link{ padding-bottom:15px}
			.job_link a{background: #009944; color:#fff; padding: 8px 10px; }
         </style>
         
         
        <img src="images/loader.gif" style="display:none" />
        <div class="row content-main">  
         	<div class="list-cat"> 
            	<ul>
                	<li class="active"><a href="javascript:;" rel="all">All</a></li>
                    <li><a href="javascript:;" rel="val">Actor</a></li>
                    <li><a href="javascript:;" rel="val">Cast</a></li>
                    <li><a href="javascript:;" rel="val">Entertainer</a></li>
                </ul>
	
			</div>  
            
             	<div class="col-sm-6">
                <form class="form-horizontal" method="post" action="">
                
                    <div class="form-group search-cont">
                        <label for="inputSearch" class="col-xs-2 col-sm-2 text-left" style="line-height:35px">Search:</label>
                        <div class="col-xs-10 col-sm-8">
                            <input type="text" class="form-control" id="inputSearch" placeholder="Search..." name="search">
                        </div>
                        <div class="col-sm-2 space_search">
                        	&nbsp;
                        </div>
                    </div>
             
				</form>
        	</div>
            <div class="col-sm-6">
            	<div class="form-group">
                        <label for="inputLocation" class="col-xs-2 col-sm-2 text-left" style="line-height:35px">Location</label>
                        <div class="col-xs-10 col-sm-8">
                            <select class="form-control" id="inputLocation" name="location">
                            	<option value="" selected="selected" >All countries</option>
                                <option>Egypt</option>
                                <option>Singapore</option>
                                <option>South Africa</option>
                                <option >Thailand</option>
                                <option>United Arab Emirates</option>
                            </select>
                        </div>
                        <div class="col-sm-2 space_search">
                        	&nbsp;
                        </div>
                    </div>
            </div>

			<div style="clear:both; height:20px"> &nbsp;</div>
            <div id="job-list-cont">
            <div class="col-sm-4">
            	<div class="job_cont">
                    <div class="job_image">
                    	<a href="job.php?job=2">
                    		<img src="app/image.php?img=../uploads/Jean%20Paul%20Gaultier%20Watches%20Launch%20Event_imgA56Y1182.jpg" width="100%" />
                        </a>
                    </div>
                    <div class="job_date">Date</div>
                	<h4 class="job_title">Job title</h4>
                    <div class="job_desc">Desc</div>
                    <div class="job_cat">Tags</div>
                    <div class="job_link"><a href="job.php?job=2">View</a></div>
                </div>
            </div>
            <div class="col-sm-4">
            	<div class="job_cont">
                	
                    <div class="job_image">
                    	<a href="job.php?job=2">
                        	<img src="app/image.php?img=../uploads/David Morris Jewellery Show_imgjpg" width="100%" />
                        </a>
                     </div>
                    <div class="job_date">Date</div>
                	<h4 class="job_title">Job title</h4>
                    <div class="job_desc">Desc</div>
                    <div class="job_cat">Tags</div>
                    <div class="job_link"><a href="job.php?job=2">View</a></div>
                </div>
            </div>
            <div class="col-sm-4">
            	<div class="job_cont">
                    <div class="job_image">
                    	<a href="job.php?job=2">
                    		<img src="app/image.php?img=../uploads/Jean%20Paul%20Gaultier%20Watches%20Launch%20Event_imgA56Y1182.jpg" width="100%" />
                        </a>
                    </div>
                    <div class="job_date">Date</div>
                	<h4 class="job_title">Job title</h4>
                    <div class="job_desc">Desc</div>
                    <div class="job_cat">Tags</div>
                    <div class="job_link"><a href="job.php?job=2">View</a></div>
                </div>
            </div>
            <div class="col-sm-4">
            	<div class="job_cont">
                    <div class="job_image">
                    	<a href="job.php?job=2">
                        	<img src="app/image.php?img=../uploads/David Morris Jewellery Show_imgjpg" width="100%" />
                        </a>
                     </div>
                    <div class="job_date">Date</div>
                	<h4 class="job_title">Job title</h4>
                    <div class="job_desc">Desc</div>
                    <div class="job_cat">Tags</div>
                    <div class="job_link"><a href="job.php?job=2">View</a></div>
                </div>
            </div>
            <div class="col-sm-4">
            	<div class="job_cont">
                    <div class="job_image">
                    	<a href="job.php?job=2">
                    		<img src="app/image.php?img=../uploads/Jean%20Paul%20Gaultier%20Watches%20Launch%20Event_imgA56Y1182.jpg" width="100%" />
                        </a>
                     </div>
                     <div class="job_date">Date</div>
                	<h4 class="job_title">Job title</h4>
                    <div class="job_desc">Desc</div>
                    <div class="job_cat">Tags</div>
                    <div class="job_link"><a href="job.php?job=2">View</a></div>
                </div>
            </div>        
            </div> 
        </div>
        
    </div>
    <footer>
    	<?php include_once("includes/footer_resp.php"); ?>
    </footer>
    <script type="text/javascript">
    	jQuery(function(){
			jQuery(".list-cat a").click( function(){
				jQuery(".list-cat li").removeClass("active");
				jQuery(this).parent().addClass("active");
				jQuery("#job-list-cont").html("<div align='center'><img src='images/loader.gif' /></div>")
				//alert(jQuery(this).attr("rel"))
				jQuery.ajax({

						  url: "job_search.php",

						  type: "post",

						  data:  {getdata: "jobs", q_type:"category", val:jQuery(this).attr("rel") },

						  success: function(message){

							  jQuery("#job-list-cont").html(message)

						  },

						  error:function(){

							alert("Failure")

						  }   

					});
				})

		})
    </script>
</body>

</html>
