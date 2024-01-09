<style type="text/css">
	.eth_div{ float:left; width:110px; font-family:Tahoma,Geneva,sans-serif; font-size:12px; color:#666666}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="14%" height="124"><img src="image/finda-model-img.jpg" width="380" height="124" /></td>
            <td bac background="image/models-bg1.jpg"width="86%">
            <form method="post" action="search.php">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="34%"><table width="100%" height="92" border="0" cellpadding="0" cellspacing="4">
                  <tr>
                    <td colspan="2"><img src="image/find-title.jpg" width="124" height="22" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="image/hidden.gif" width="5" height="5" /></td>
                  </tr>
                  <tr>
                    <td width="25%" class="bodyfont">Gender:</td>
                    <td width="75%"><label for="select"></label>
                      <select name="gender" class="bodyfont" id="select">
                      	<?php
							require_once("classes/Models.php");
							$models = new Models();
							$gnd_res = $models->getallGender();
							while($row=$gnd_res->fetch_object()){
								if($row->Gender!=""){
									if(isset($_REQUEST['gender'])){
										if($row->Gender==$_REQUEST['gender']){
											?>
											<option value="<?php echo $row->Gender; ?>" selected="selected"><?php echo $row->Gender; ?></option>
									<?php	}
										else{ ?>
											<option value="<?php echo $row->Gender; ?>"><?php echo $row->Gender; ?></option>
										<?php }
									}
									else{
						?>
                        	
                        			<option value="<?php echo $row->Gender; ?>"><?php echo $row->Gender; ?></option>
                        <?php
									}
								} 
							} 
						?>
                      </select></td>
                  </tr>
                  <tr>
                    <td height="20" class="bodyfont">Age:</td>
                    <td><select name="age" class="bodyfont" id="select2">
                      <?php
							
							
							$gnd_res = $models->getallAge();
							while($row=$gnd_res->fetch_object()){
								if($row->Age!=""){
									if(isset($_REQUEST['age'])){
										if($row->Age==$_REQUEST['age']){ ?>
                                        
										<option value="<?php echo $row->Age; ?>" selected="selected"><?php echo $row->Age; ?></option>

									<?php
										}
										else{ ?>
											<option value="<?php echo $row->Age; ?>"><?php echo $row->Age; ?></option>
									<?php
										}
									}
									else{
						?>
                        			<option value="<?php echo $row->Age; ?>"><?php echo $row->Age; ?></option>
                        <?php 	
									}
								} 
							} 
						?>
                    </select></td>
                  </tr>
                </table></td>
                <td width="4%"><img src="image/find-line-bit.jpg" width="25" height="124" /></td>
                <td width="62%"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                  <tr>
                    <td colspan="6"><img src="image/find-title.jpg" width="124" height="22" /></td>
                    <td colspan="2" align="center">
                    	<div class="eth_div">
                    		<input type="image" src="image/find-b1.gif" width="41" height="21"  />
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="8"><img src="image/hidden.gif" width="5" height="5" /></td>
                  </tr>
                  <tr>
                  	<td width="100%" colspan="8">
                    	<div style="height:55px; overflow:auto">
                  	<?php
							
							$gnd_res = $models->getallEthnicity();
							$k=1;
							while($row=$gnd_res->fetch_object()){
								
								if($row->Ethnicity!=""){
						?>
                        	<div class="eth_div">
                            		<?php 
										if(isset($_REQUEST['ethnicity'])){
											if(in_array($row->Ethnicity,$_REQUEST['ethnicity'])){ ?>
											<input type="checkbox" value="<?php echo $row->Ethnicity; ?>" id="check_<?php echo $row->Ethnicity; ?>" name="ethnicity[]" checked="checked"  />
											<?php
                                            }
											else{ ?>
 												<input type="checkbox" value="<?php echo $row->Ethnicity; ?>" id="check_<?php echo $row->Ethnicity; ?>" name="ethnicity[]"  />
									<?php	}
										}
										else{
									?>
                        			<input type="checkbox" value="<?php echo $row->Ethnicity; ?>" id="check_<?php echo $row->Ethnicity; ?>" name="ethnicity[]"  />
									<?php } ?>
                                    <label for="check_<?php echo $row->Ethnicity; ?>" style="float: right; width: 80px; overflow: hidden;"><?php echo $row->Ethnicity; ?></label>
                        	</div>
                            	
						<?php 	
								if($k%3==0){
									echo "<br/>";
								}
								$k++;
								} 
							} 
						?>
                        </div>
                    </td>
                  </tr>
                </table></td>
              </tr>
            </table>
            </form>
            </td>
          </tr>
        </table>