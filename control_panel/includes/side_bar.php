   <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          
           <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/profile-dummy.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><a href="profile.php" ><?php echo $_SESSION['user_name']; ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-green"></i> Online</a>
              
            </div>
            
          </div>
          
          
          <ul class="sidebar-menu">
          	
            <li class="header"> <a href="logout.php" ><i class="fa fa-power-off"></i> &nbsp;Sign out</a></li>
            
            <li class="header">MAIN NAVIGATION</li>
            <?php if($_SESSION['user_id']==1){ ?>
            <li class="treeview <?php if($active=="super_dash"){ echo "active";} ?>">
              <a href="super-dashboard.php">
                <i class="fa fa-dashboard"></i>
                <span>Reports</span>
              </a>
            </li>
            
             <li class="treeview <?php if($active=="token"){ echo "active";} ?>">
              <a href="token.php">
                <i class="fa fa-key"></i>
                <span>Security Token</span>
              </a>
            </li>
            <li class="treeview <?php if($active=="bookers"){ echo "active";} ?>">
              <a href="bookers.php">
                <i class="fa fa-users"></i>
                <span>Bookers</span>
                <i class="fa fa-user pull-right"></i>
              </a>
               	<ul class="treeview-menu">
                    <li><a href="bookers.php"><i class="fa fa-folder-open"></i> View</a></li>
                    <li><a href="add-booker.php"><i class="fa fa-plus-circle"></i> Add</a></li>
				</ul>
             </li>
            
            <?php } else{ ?>
            <li class="treeview <?php if($active=="dash"){ echo "active";} ?>">
              <a href="dashboard.php">
                <i class="fa fa-dashboard"></i>
                <span>Reports</span>
              </a>
            </li>
             <li class="treeview <?php if($active=="model"){ echo "active";} ?>">
              <a href="models.php">
                <i class="fa fa-picture-o"></i>
                <span>Models & Talents</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
               	<ul class="treeview-menu">
                    <li><a href="models.php"><i class="fa fa-folder-open"></i> View</a></li>
                    <li><a href="add-model.php"><i class="fa fa-plus-circle"></i> Add</a></li>
                    <li><a href="mail_models.php"><i class="fa fa-folder"></i>Requests from Website</a></li>
                    <li><a href="search_advanced.php"><i class="fa fa-search"></i>Advanced Search</a></li>
				</ul>
             </li>
             <?php /*?>
             <li class="treeview <?php if($active=="pages"){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-newspaper-o"></i>
                <span>Pages</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
               	<ul class="treeview-menu">
                    <li><a href="edit-page.php?page_id=1"><i class="fa fa-plus-circle"></i> About Page</a></li>
                    <li><a href="edit-page.php?page_id=2"><i class="fa fa-plus-circle"></i> Contact Page</a></li>
				</ul>
             </li>
             <li class="treeview <?php if($active=="sections"){ echo "active";} ?>">
              <a href="#">
                <i class="fa fa-newspaper-o"></i>
                <span>Sections</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li>
                        <a href="edit-section.php?section_id=1">
                            <i class="fa fa-braille"></i>
                            <span>Home Section</span>
                        </a>
                  </li>
                  <li>
                      <a href="edit-section.php?section_id=2">
                        <i class="fa fa-braille"></i>
                        <span>About Section</span>
                      </a>
                   </li>
                 </ul>
           
             </li><?php */?>
             <li class="treeview <?php if($active=="job"){ echo "active";} ?>">
              <a href="jobs.php">
                <i class="fa fa-shopping-bag"></i>
                <span>Jobs</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="jobs.php"><i class="fa fa-folder-open"></i> View jobs</a></li>
                <li><a href="add-job.php"><i class="fa fa-plus-circle"></i> Add Job</a></li>
<?php /*?>                <li><a href="categories.php"><i class="fa fa-folder-open"></i>View Categories</a></li>
                <li><a href="add-category.php"><i class="fa fa-plus-circle"></i>Add category</a></li>
<?php */?>              </ul>
            </li>
             <li class="treeview <?php if($active=="sheets"){ echo "active";} ?>">
              <a href="call-sheets.php">
                <i class="fa fa-shopping-basket"></i>
                <span>Call Sheets</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="call-sheets.php"><i class="fa fa-folder-open"></i> View Call Sheets</a></li>
                </ul>
              </li>
               <li class="treeview <?php if($active=="subscribers"){ echo "active";} ?>">
              <a href="subscribers.php">
                <i class="fa fa-file-text"></i>
                <span>Subscribers</span>
              </a>
            </li>
            <?php } ?>
           <?php /*?> <li class="treeview <?php if($active=="enquiries"){ echo "active";} ?>">
              <a href="enquiries.php">
                <i class="fa fa-paper-plane"></i>
                <span>Product Enquiries</span>
              </a>
             </li><?php */?>
             <?php /*?><li class="treeview <?php if($active=="brands"){ echo "active";} ?>">
              <a href="products.php">
                <i class="fa fa-shopping-bag"></i>
                <span>Brands</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="brands.php"><i class="fa fa-folder-open"></i> View Brands</a></li>
                <li><a href="add-brand.php"><i class="fa fa-plus-circle"></i> Add Brand</a></li>
              </ul>
            </li><?php */?>
            <?php /*?><li class="treeview <?php if($active=="events"){ echo "active";} ?>">
              <a href="events.php">
                <i class="fa fa-file-text"></i>
                <span>Events</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="events.php"><i class="fa fa-folder-open"></i>View Events</a></li>
                <li><a href="add-event.php"><i class="fa fa-plus-circle"></i>Add Event</a></li>
              </ul>
            </li><?php */?>
       		<?php /*?>
             <li class="treeview <?php if($active=="project"){ echo "active";} ?>">
              <a href="projects.php">
                <i class="fa fa-file-text"></i>
                <span>Projects</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="projects.php"><i class="fa fa-folder-open"></i>View Projects</a></li>
                <li><a href="add-project.php"><i class="fa fa-plus-circle"></i>Add Project</a></li>
              </ul>
            </li><?php */?>
            
          <?php /*?>  <li class="treeview <?php if($active=="certificate"){ echo "active";} ?>">
              <a href="projects.php">
                <i class="fa fa-file-text"></i>
                <span>Certificates</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="certificates.php"><i class="fa fa-folder-open"></i>View Certificates</a></li>
                <li><a href="add-certificate.php"><i class="fa fa-plus-circle"></i>Add Certificate</a></li>
              </ul>
            </li>
            
            <li class="treeview <?php if($active=="gallery"){ echo "active";} ?>">
              <a href="projects.php">
                <i class="fa fa-file-text"></i>
                <span>Gallery</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="gallery.php"><i class="fa fa-folder-open"></i>View gallery</a></li>
                <li><a href="add-gallery.php"><i class="fa fa-plus-circle"></i>Add Gallery images</a></li>
              </ul>
            </li><?php */?>
            
          </ul>
        </section>
        <!-- /.sidebar -->
   </aside>