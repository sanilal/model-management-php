<?php
error_reporting(0);
ob_start();
session_start();
if(!isset($_SESSION['user_id'])){
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
else if($_SESSION['user_id']=="" || $_SESSION['user_id']==NULL){
	header("Location: logout.php");
	echo "<script type='text/javascript'>window.top.location='logout.php';</script>";
	exit;
}
include("includes/conn.php"); 
//var_dump($_SESSION['user_id']);
?>

<style type="text/css">
.tab_title{ font-size:18px; font-weight:bold; /*border-bottom:1px solid #333;*/ background:#009944; color:#fff; padding:5px;}
.form-group{ overflow:hidden; font-size:16px; font-weight:bold}
.form-group  label { font-weight:normal; padding-right:10px;}

.multi-item-carousel{
  .carousel-inner{
    > .item{
      transition: 500ms ease-in-out left;
    }
    .active{
      &.left{
        left:-33%;
      }
      &.right{
        left:33%;
      }
    }
    .next{
      left: 33%;
    }
    .prev{
      left: -33%;
    }
    @media all and (transform-3d), (-webkit-transform-3d) {
      > .item{
        // use your favourite prefixer here
        transition: 500ms ease-in-out left;
        transition: 500ms ease-in-out all;
        backface-visibility: visible;
        transform: none!important;
      }
    }
  }
  .carouse-control{
    &.left, &.right{
      background-image: none;
    }
  }
}
</style>
 <?php 
  $model=mysqli_fetch_object(mysqli_query($url,"select * from `Smart_FLC_Resource_Details` WHERE Resource_ID='".$_GET['r_id']."'"));
  //echo "select * from `Smart_FLC_Resource_Details` WHERE Resource_ID=".$_GET['r_id'];
  ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin-left:0">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section>

          <!-- Default box -->
          <div class="box" style="border:0">

      
            
            <div class="box-body">
                  <div class="box-body">
                 
                  
                  	<div class="tab_title">Contact information</div>
              <div class="form-group">
                <label for="inputFname" >Full Name:</label>
                  <?php echo $model->First_Name." ".$model->Middle_Name." ".$model->Last_Name; ?>
                </div>
              
              <div class="form-group">
                <label for="inputEmail3" >Email Address:</label>
                    <?php if($model->Email1!=""){ echo '<a href="mailto:'.$model->Email1.'" >'. $model->Email1.'</a>'; } if($model->Email2!=""){ echo ', <a href="mailto:'.$model->Email2.'" >' .$model->Email2.'</a>';} if($model->Email3!=""){ echo ', <a href="mailto:'.$model->Email3.'" >'.$model->Email3.'</a>';} ?>
                </div>
              <div class="form-group">
                <label for="inputPhone" >Mobile Number:</label>
                
                  <?php echo $model->Cell_phone; if($model->Main_phone!=""){ echo ",".$model->Main_phone;}?>
                </div>
                 <div class="form-group">
                <label for="inputPhone" >Whatsapp Number:</label>
                
                  <a href="https://api.whatsapp.com/send?phone=<?php echo ltrim($model->whatsapp,'+'); ?>" target="_blank"><i class="fa fa-whatsapp"></i><?php echo $model->whatsapp;?></a>
                 
                </div>
                 <div class="form-group">
                <label for="inputPhone" >Fax:</label>
                
                  <?php echo $model->Fax; ?>
                </div>
              <div class="form-group">
                <label for="inputAddress" >Address:</label>
                
                  <?php echo $model->Address; if($model->City!=""){ echo "<br/> City: ".$model->City;} if($model->State!=""){ echo "<br/> State: ".$model->State;} if($model->Zip!=""){ echo "<br/> Zip".$model->Zip;}  ?>
                </div>
              
              <div class="tab_title">Personel information</div>
              
              <div class="form-group">
                <label for="inputDob" >Date of Birth:</label>
                
                   <?php echo $model->DOB; ?>
                </div>
              <div class="form-group">
                <label for="inputGender" >Gender:</label>
                
                  	 <?php echo $model->Gender; ?>
                </div>
              
              <div class="form-group">
                <label for="inputCountry" >Nationality:</label>
                
                  	 <?php echo $model->Nationality; ?>
              </div>
              
               <div class="form-group">
                <label for="inputCountry" >Country:</label>
                
                  	 <?php echo $model->Country; ?>
               </div>
               
               <div class="form-group">
                <label for="inputCountry" >Ethnicity:</label>
                
                  	 <?php echo $model->Ethnicity; ?>
               </div>
               
               <div class="form-group">
                <label for="inputCountry" >Emirates:</label>
                
                  	 <?php echo $model->Emirates; ?>
               </div>
                 
                 <div class="form-group">
                <label for="inputCountry" >In Town Status:</label>
                
                  	 <?php echo $model->In_Town_Status; ?>
               </div>
               
                <div class="form-group">
                <label for="inputCountry" >International Model/talent?</label>
                
                  	 <?php if(strpos($model->Sub_Category,"International")!== false){ echo 'Yes';} else{ echo 'No';} ?>
               </div>
                             
              <div class="form-group" >
                <label for="inputMlang" >Native Language:</label>
                
                  <?php echo $model->Native_Language; ?>
               </div>
              <div class="form-group">
                <label for="inputOlang" >Languages spoken:</label>
                
                  <?php echo $model->Languages_Spoken; ?>
              </div>
              
          <?php /*?>    <div class="form-group">
                <label >In Town Status:</label>
                
                  <?php echo $model->In_Town_Status; ?>
              </div><?php */?>
              
              <div class="tab_title">Measurement information</div>
              
              <div class="form-group">
              	<div class="col-sm-4">
                	<label for="inputHeight" >Height</label>
               
                	<?php echo $model->Height; ?>
                 </div>
                <div class="col-sm-4" style="display:none">
                	<label for="inputWeight" >Weight</label>
                
                <?php echo $model->Weight; ?>
                </div>
              </div>
              
               <div class="form-group">
               <div class="col-sm-4">
                	<label for="inputBust" >Bust</label>
               
                  <?php echo $model->Bust; ?>
                </div>
                <div class="col-sm-4">
                	<label for="inputWaist" >Waist</label>
                
                  <?php echo $model->Waist; ?>
                </div>
              </div>
              
              
              <div class="form-group">
              <div class="col-sm-4">
                <label for="inputHips" >Hips</label>
             
                 <?php echo $model->Hips; ?>
                </div>
                <div class="col-sm-4">
                	<label for="inputEye" >Eyes</label>
                
                 <?php echo $model->EyesColor; ?>
                </div>
              </div>
              
              
              <div class="form-group">
              <div class="col-sm-4">
                <label for="inputSkin" >Skin</label>
              
                 <?php echo $model->SkinColor; ?>
                </div>
                <div class="col-sm-4">
                 	<label for="inputHair" >Hair</label>
                
                  <?php echo $model->HairColor; ?>
                </div>
              </div>
              
              <div class="form-group">
              <div class="col-sm-4">
              	<label for="inputShoe">Shoe</label>
             
               	<?php echo $model->ShoesSize; ?>
                </div>
                <div class="col-sm-4">
                <label for="inputDress" >Dress</label>
                
              <?php echo $model->DressSize; ?>
                </div>
                 
              </div>
              
              <div class="tab_title">General information</div>
              
              <div class="form-group foi_cont">
                <label for="inputFoi" >Category</label>
                 <?php echo $model->Resource_Type." ".$model->Sub_Category; ?>
                 </div>
              
              <div class="form-group">
                <label for="inputPhotos" >Photos </label>
                <div class="row">
                <div class="col-md-12">
                    <?php
					$img=0;
				$sub_folder=getImageFolder($model->Resource_ID);
                define('IMAGEPATH', image_path.$sub_folder."/");
					$all_imgs=glob(IMAGEPATH.$model->Resource_ID.'*.{jpg,png,gif,jpeg}', GLOB_BRACE);
					foreach($all_imgs as $filename){
			?>
                    
                   
                      <div class="item <?php if($img==0){ echo 'active';} ?>">
                        <div class="col-xs-4" style="height:370px; overflow:hidden; margin-bottom:20px;"><img src="<?php echo $filename; ?>"  /></div>
                      </div>
                      
                    <?php
					$img++;
				}
				 ?>                   
                </div>
              </div>
                
                  
              </div>
              
               <?php /*?><div class="form-group">
                <label for="inputPphoto" >Publish photos on website? </label>
                 <?php echo $model->publish_photo; ?>
                  
              </div>
               <div class="form-group">
                <label for="inputStatus" >Catalogue</label>
                <?php if($model->catalogue!=""){ ?>
                  	<a href="<?php echo $model->catalogue; ?>" target="_blank">View</a>
                <?php } ?>
                </div>
                  <div class="form-group">
                <label for="inputPhotos" >Videos</label>
                <?php
				if($model->video1!=""){
					echo '<a href="'.$model->video1.'" target="_blank">View video</a>';
				}
				if($model->video2!=""){
					echo '<a href="'.$model->video2.'" target="_blank">View video</a>';
				}
				if($model->video3!=""){
					echo '<a href="'.$model->video3.'" target="_blank">View video</a>';
				}
				?>
                  
              </div><?php */?>
                  </div><!-- /.box-body -->
                  
                
            </div><!-- /.box-body -->
            
           <?php /*?> <div class="box-footer">
            
            </div><!-- /.box-footer--><?php */?>
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php //include_once('includes/footer.php'); ?>
    <!-- jQuery 2.1.4 -->

    
  <script type="text/javascript">
  // Instantiate the Bootstrap carousel
$('.multi-item-carousel').carousel({
  interval: 3000
});

// for every slide in carousel, copy the next slide's item in the slide.
// Do the same for the next, next item.
$('.multi-item-carousel .item').each(function(){
  var next = $(this).next();
  //alert(next)
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  if (next.next().length>0) {
    next.next().children(':first-child').clone().appendTo($(this));
  } else {
  	$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
  }
});
  </script>
<?php ob_end_flush(); ?>