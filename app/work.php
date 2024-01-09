<!DOCTYPE html>
<html lang="en">

<head>
     <link rel="stylesheet" type="text/css" href="../css/jquery.fancybox.css?v=2.1.4" media="screen" />
   <?php include_once("includes/head_common.php");  ?>
   <title>FLC - Media Works </title>
   
</head>

<body>

    
    
    	 <?php include_once("includes/header.php"); ?> 
         <script type="text/javascript" src="../js/jquery.fancybox.js?v=2.1.4"></script>
       
        <style type="text/css">
            .work_item{ margin-bottom:10px;}
            .work_item img{ min-height:120px; width:100%}
            .work_item .absl_name{ width:100%; font-size:10px; height:28px}
			.work_item > a{ position:relative; display:inline-block; width:100%; background: #303030 center no-repeat url('images/loading.gif'); height:120px; overflow:hidden;}
			.absl_div{ width:100%;}
        </style>           
    <!-- Page Content -->
    <div class="container inner_content">

        <header class="hero-spacer" style="margin:15px 0px">
        	<div class="main_title">
                <a class="text_none" href="works.php"><span class="main_title">Our Works</span></a>
            </div>
            <div class="title-grey">
			 <?php 
            require_once("../classes/Media.php");
            $media= new Media();
            $cat_res=$media->getCategory($_REQUEST['cat-id']);
            $cat_row=$cat_res->fetch_object();
            echo $cat_row->category_name; ?>
        </div>
        </header>
        
        
 <div class="row content-main">
           
           	 <?php
			 	if(isset($_REQUEST['cat-name'])){
					$media_res=$media->getMedia(NULL,NULL,$_REQUEST['cat-name']);
				}
				else{
			  		$media_res=$media->getMedia(NULL,$_REQUEST['cat-id'],NULL);
				}
				$i=1;
				while($row=$media_res->fetch_object()){ ?>
				<div class="col-sm-3 col-xs-4 work_item" style="overflow:hidden;" >
                	
                	<?php if($row->work_type=="Video"){ ?>
                    	<a class="fancybox_v fancybox.iframe" href="../ajax.php?media_id=<?php echo $row->work_id; ?>"  title="<?php echo stripslashes($row->work_title); ?>">
                        <?php
							$step1=explode('v=', $row->work_link);
							$step2 =explode('&amp;',$step1[1]);
							$vedio_id = $step2[0];
						?>
                  			<img src='http://img.youtube.com/vi/<?php echo $vedio_id; ?>/0.jpg' class="img-responsive" alt="FLC Models & Talents -<?php echo $cat_row->category_name." - ".stripslashes($row->work_title); ?> " />
                            <div class="absl_div"> 
                                <div class="absl_name">
                                    <?php echo stripslashes($row->work_title);?>  
                                </div>
                            </div>
                        </a> 
                    <?php } else{ ?>
                    	<?php if($row->work_image2!="" || $row->work_image3!="" || $row->work_image4!=""){ 
                        	echo '<a class="catalog_link" ref="work_data.php?id='.$row->work_id.'" href="javascript:;" title="'.stripslashes($row->work_title).'"  >';
                      		 } else{ ?>
                  			<a class="fancybox" href="image.php?img=<?php echo urlencode("../uploads/".$row->work_image) ?>"  title="<?php echo stripslashes($row->work_title); ?>">
                        	<?php } ?>
                  			<img src='image.php?img=<?php echo urlencode("../uploads/".$row->work_image) ?>' alt="FLC Models & Talents - <?php echo $cat_row->category_name." - ".stripslashes($row->work_title); ?>" class="img-responsive" />
                            <div class="absl_div"> 
                                <div class="absl_name">
                                    <?php echo stripslashes($row->work_title);?>  
                                </div>
                            </div>
                        	</a> 
                     <?php } ?>
                   </div>
					
				<?php
				}
			  
			  ?>
            
        </div>
         
    </div>
    <footer>
    	<?php include_once("includes/footer.php"); ?>
    </footer>
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
				},
				afterShow : function() {
						$(".fancybox-close").html("Close");
				}	
			});
		//
		$('.fancybox').fancybox({
				type        : 'image',
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
				},
				afterShow : function() {
						$(".fancybox-close").html("Close");
				}	
			});
			$('.fancybox_m').fancybox({width: 970,afterShow : function() {
						$(".fancybox-close").html("Close");
				}
			 });
	})
	
</script>
<link href="css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
		<script src="js/bootstrap-dialog.min.js"></script>
        <script type="text/javascript">
		$(function (){
			$(".catalog_link").click( function(){
				 BootstrapDialog.show({
					type:'type-default',
					title: $(this).attr('title'),
					message: '<iframe width="100%" src="'+$(this).attr('ref')+'" frameborder="0" scrolling="no" id="iframe" onload="javascript:resizeIframe(this);" ></iframe>',
					buttons: [{
						label: 'Close',
						action: function(dialogItself){
							dialogItself.close();
						}
					}]
				});
			})
		})
        function resizeIframe(obj) {
			obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		  }
        </script>
</body>

</html>
