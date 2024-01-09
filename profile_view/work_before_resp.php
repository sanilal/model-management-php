<?php
require_once("config/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLC MODELS PORTFOLIO - Dubai Models | Model Agency Dubai  | FLC Models & Talents</title>

<meta name="Description" content=" Models Portfolio - Model Agency Dubai,FLC Models, FLC Talents, International Models,Casting & Production Agency, Dubai,Cast & crew, Model Management"/>

<meta name="Keywords" content="Dubai models Portfolio,FLC Models,FLC Talents, modeling agencies Dubai, models in Dubai, Kids models UAE ,Middle east models, promoters in Dubai, promoters UAE, Product Shoot, Casting Agency, hostesses in Dubai, Promotions in Dubai,Print Campaigns, Make-up artist,portfolio for models in Dubai, photographers in Dubai, photo shoot  in Dubai, make up artist in Dubai, stylist in  Dubai, Cast & Crew in Dubai,Events & Exhibitions"/>

<META NAME="author" CONTENT="FLC MODELS">

<link rel="icon" href="favicon.ico" type="image/x-icon" />

<link href="css/flc.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.content{ min-height:591px;}
.contenter a{ text-decoration:none}
.cat_title{ background:#1D1D1D; color:#FFF; font-weight:bold; border-radius:4px; width:96%; padding:3px 0px; padding-left:10px; cursor:pointer; font-size:12px}
.work_item{
    float: left;  margin-right: 13px;   margin-bottom: 15px; width: 235px; height:150px; overflow:hidden
}
.work_item a img{ min-width:235px; max-width:280px; min-height:150px; max-height:300px}
.media_title{ position:absolute; width:235px; height:40px; overflow:hidden; margin-top:110px; font-size:13px font-weight:bold; color:#fff; text-align:center; background:#666;opacity:0.8;filter:alpha(opacity=80); }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.4" media="screen" />
</head>

<body>
<?php include_once("includes/top.php"); ?>

<div class="content_main">

	<div class="content">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
         
          <tr>
            <td>
            	<?php /*?><?php
							require_once("classes/Article.php");
							$article= new Article();
							//$articles=$article->getArticle(1);
						
							//$row=$articles->fetch_object();
				?><?php */?>
            	<a href="#" style="text-decoration:none" ><span class="title-grey">Our Works &gt;</span></a>
                <span class="title-red">
                <?php 
					require_once("classes/Media.php");
					$media= new Media();
					$cat_res=$media->getCategory($_REQUEST['cat-id']);
					$cat_row=$cat_res->fetch_object();
				?>
            		<?php
					if(isset($_REQUEST['cat-name'])){
						echo $_REQUEST['cat-name'];
					}
					else echo $cat_row->category_name; ?>
            	</span>
            </td>
          </tr>
          <tr>
          	<td height="10">&nbsp;</td>
          </tr>
          <tr>
            <td>
              <?php
			 	if(isset($_REQUEST['cat-name'])){
					$media_res=$media->getMedia(NULL,NULL,$_REQUEST['cat-name']);
				}
				else{
			  		$media_res=$media->getMedia(NULL,$_REQUEST['cat-id'],NULL);
				}
				$i=1;
				while($row=$media_res->fetch_object()){ ?>
				<div class="work_item"  <?php if($i%4==0){ echo "style='margin-right:0px;'";} $i++;?>>
                	<?php if($row->work_type=="Video"){ ?>
                    	<a class="fancybox_v fancybox.iframe" href="ajax.php?media_id=<?php echo $row->work_id; ?>"  title="<?php echo $row->work_title; ?>">
                        	<div class="media_title"><?php echo $row->work_title; ?> </div>
                        <?php
							$step1=explode('v=', $row->work_link);
							$step2 =explode('&amp;',$step1[1]);
							$vedio_id = $step2[0];
						?>
                  			<img src='http://img.youtube.com/vi/<?php echo $vedio_id; ?>/0.jpg' style="max-height:150px" alt="FLC Models & Talents -<?php echo $cat_row->category_name." - ".$row->work_title; ?> " />
                            
                        </a> 
                    <?php } else{ ?>
                    	<?php if($row->work_image2!="" || $row->work_image3!="" || $row->work_image4!=""){ 
                        	echo '<a class="fancybox_m fancybox.iframe" href="media_ldata.php?id='.$row->work_id.'"  >';
                       } else{ ?>
                  		<a class="fancybox" href="uploads/<?php echo $row->work_image; ?>"  title="<?php echo $row->work_title; ?>">
                        <?php } ?>
                        	<div class="media_title"><?php echo $row->work_title; ?></div>
                  			<img src='uploads/<?php echo $row->work_image; ?>' alt="FLC Models & Talents - <?php echo $cat_row->category_name." - ".$row->work_title; ?>"  />
                            
                        </a> 
                     <?php } ?>
                   </div>
					
				<?php
				}
			  
			  ?>

                               
            </td>
          </tr>
        </table>
    
    </div>


</div>

<div class="footer_main">
	 <?php include_once("includes/bottom.php"); ?>

</div>

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
	})
	
</script>
</body>
</html>
