<?php
ob_start();
		
	
	if(isset($_POST['getdata'])){
		if($_POST['getdata']=="jobs"){
			if($_POST['q_type']=="category"){
				//echo sizeof($_SESSION['models']);
				if($_POST['val']=="all"){
				?>
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
				<?php		
				}
				else{
					?>
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
                <?php
                }
			}
		}
	}
	
	?>