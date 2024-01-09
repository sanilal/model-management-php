<?php ob_start(); ?>
    
<div class="nav_container">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"> <img alt="FLC Logo" title="FLC Models" src="images/flc-logo-cl.png" class="img-responsive" /></a>
            <?php 
			require_once("../config/db.php");
			 $db_connection=db_connect();
			 session_start();
			 $check_sql="";
			  if(isset($_SESSION['deviceid'])){
				 $res_not_dev=$db_connection->query("SELECT * FROM device_notes WHERE device_id = '".$_SESSION['deviceid']."' ORDER BY id DESC");
					$row_not_dev=$res_not_dev->fetch_object();
					if($row_not_dev->id){
						$check_sql=" && id > ".$row_not_dev->last_note_id;
					}
			  }
			 $notes_cnt = $db_connection->query("SELECT count(id) as not_count FROM notification WHERE status = 1 ".$check_sql);
			 $n_cnt = $notes_cnt->fetch_object();
			?>
             <a href="notification.php?v=1.1" style="float:right" class="badge2" <?php if($n_cnt->not_count > 0){ echo 'data-badge="'.$n_cnt->not_count.'"';} ?> ><img src="images/notification_ico_grey.png" /></a>
        </div>
        
        <div class="collapse navbar-collapse nav-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="index.php"  title="FLC MODELS">HOME</a></li>
                <li><a href="men.php" title="FLC MEN MODELS">MEN</a></li>
                <li><a href="women.php" title="FLC WOMEN MODELS">WOMEN</a></li>
                <li class="dropdown"><a href="#" title="FLC MODELS TALENTS" class="dropdown-toggle" data-toggle="dropdown">TALENTS<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="cast.php" title="FLC MODELS CAST">CAST</a></li>
                        <li><a href="teens.php" title="FLC TEEN MODELS">TEENS</a> </li>
                        <li><a href="kids.php" title="FLC KIDS MODEL">KIDS</a> </li>
                        <li><a href="hostess.php" title="FLC HOSTESS MODEL">HOSTESS</a> </li>
                        <li><a href="stylist.php" title="FLC MODELS">STYLIST</a></li>	
                        <li><a href="photographer.php" title="FLC MODELS">PHOTOGRAPHER</a> </li>
                    </ul>
                </li>
                 <li class="dropdown"><a href="#" title="FLC MODELS PORTFOLIO" class="dropdown-toggle" data-toggle="dropdown">OUR WORK<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                            require_once("../classes/Media.php");
                            $media_top= new Media();
                            $cat_res=$media_top->getCategory();
							$cat_res_back=$cat_res;
                            while($cat_row=$cat_res->fetch_object()){
                                ?>
                                <li ><a title="FLC MODELS <?php echo $cat_row->category_name ?>" href="work.php?cat-id=<?php echo $cat_row->category_id ?>"><?php echo $cat_row->category_name ?></a> </li>
                                <?php
                            }
                         ?>
                    </ul>
                </li>
                <li><a href="about.php" title="FLC MODELS">ABOUT US</a></li>
                <li><a href="contact.php" title="FLC MODELS">CONTACT US</a></li>
                <li><a href="privacy.php" title="FLC MODELS">PRIVACY POLICY</a></li>
            </ul>
        </div>
       
    </nav>
</div>
<script type="text/javascript">
    // Fancybox specific
    // To make images pretty. Not important
    $(document).ready(function(){
		function note_check(){
			//alert("ss")
			$.ajax({
					url: "ajax.php",
					type: "post",
					data:  {getdata: "note_count"},
					success: function(message){
						if(message > 0){
							$(".badge2").attr("data-badge",message);
						}
					},
					error:function(){
						//alert("failure");
					}
				})
		}
       //note_check();
	   setInterval(note_check, 15000);
    });
	
	
    </script>