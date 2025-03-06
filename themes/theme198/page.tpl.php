<?php
// $Id: page.tpl.php,v 1.25 2008/01/24 09:42:53 goba Exp $

function in_array_like($sNeedle, $aHaystack){
	if (!in_array($sNeedle, array("mystudies/getinvolved","mystudies/getinvolved/guides","mystudies/getinvolved/guides/enroll"))){
		foreach ($aHaystack as $sReference){
			if (stristr($sNeedle, $sReference)) return true;
		}
	}
	
	return false;
}

$sHomeLink = ($user->uid > 0) ? "user/".$user->uid:"";

$aChildPortal = array(
					"menu-127" => array("attributes" => array("title" => ""), "href" => "<front>", "title" => "Visitor's Portal"),
					"menu-123" => array("attributes" => array("title" => ""), "href" => "node/20", "title" => "Children's Portal"),
					"menu-124" => array("attributes" => array("title" => ""), "href" => "socialgo", "title" => "My Community"),
					"menu-125" => array("attributes" => array("title" => ""), "href" => "node/196", "title" => "Get Help"),
					"menu-126" => array("attributes" => array("title" => ""), "href" => "mystudies", "title" => "My Studies"),
					"menu-128" => array("attributes" => array("title" => ""), "href" => "store", "title" => "My Livelihood"),
				);

$aPageToCheck = array("mystudies","askeet","socialgo","store","hopebank","civicrm","node/20");

$primary_links = (in_array_like($_REQUEST["q"], $aPageToCheck)) ? $aChildPortal:$primary_links;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
  <title><?php print $head_title ?></title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta name="keywords" content="SEO,Hope Cybrary,Cybrary,hope,children's portal,child,Science,Math,English,Social Studies,Health,Entertainment,Technology,Peace Studies,Productivity,General Reference,Livelihood" />
  <meta name="description" content="The Hope Cybrary (Cyber Library) is a link to a past we can no longer see and a bridge to a future we have yet to address. Libraries represent the most democratic of our institutions, giving the greatest and the least of us alike access to the information they need to build the future of their choice." />
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
  
  <!--[if IE]>
   <script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/ie_png.js"></script>
   <script type="text/javascript">
       ie_png.fix('.png');
   </script>
<![endif]-->
  
</head>
  
<body id="body">
	<div id="TimerBlockAvailable" style="display:none; position:absolute; z-index:9500; font-size:1.5em; color:#BC5500; padding: 4px 8px; background-color:#E5E5E5; border: 1px solid #B5B5B5;" align="center">
		<div style="text-align:left; font-size:0.8em;">Time Left <sup id="time_tracker_More" style="font-size:0.7em; padding-left:175px;">more</sup></div>
		<div id="time_tracker_TimeAvailable"></div>
	</div>
	<div id="TimerBlockSpent" style="display:none; position:absolute; z-index:9500; font-size:1.5em; color:#BC5500; padding: 4px 8px; background-color:#E5E5E5; border: 1px solid #B5B5B5; top:60px;" align="center">
		<div style="text-align:left; font-size:0.8em">This Session <sup id="time_tracker_Less" style="font-size:0.7em; padding-left:159px;">less</sup></div>
		<div id="time_tracker_TimeSpent"></div>
	</div>
	
	<div class="min-width">
    	<div id="main">
            <div id="header">
                <div class="head-row1">
                    <div class="col1">
                    	<?php if ($logo) : ?>
                            <a href="<?php print $front_page.$sHomeLink ?>" title="<?php print t('Home') ?>"><img src="<?php print($logo) ?>" alt="<?php print t('Home') ?>" class="logo" /></a>
							<div style="font-size:2em; color:#FFFFFF; font-weight:bold; position:absolute; top:7px; left:90px;">
							Hope Cybrary<br />
							hopeNET
							</div>
                        <?php endif; ?>
                        <?php if ($site_name) : ?>
                            <h1 class="site-name"><a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1>
                        <?php endif; ?>
                        
                        <?php if ($mission != ""): ?>
                            <div id="mission"><?php print $mission ?></div>
                        <?php endif; ?>
                        <?php if ($site_slogan) : ?>
                            <div class="slogan"><div><?php print($site_slogan) ?></div></div>
                        <?php endif;?>
                    </div>
					<div class="col2">
                    	<div class="search-box">
							<?php if ($search_box): print $search_box;  endif; ?>
                        </div>
                    </div>
						
					<img src="<?php print base_path() ?>misc/under_construction_site.png" border="0" style="position:relative; top:75px; left:90px; z-index:3000;" title="Site Under Construction" />
					
					<!--
					<div style="width:396px; position:relative; top:-132px; left:290px; z-index:3000; font-weight:bold;">
						<div style="float:left; width:132px;"><a href="<?php print base_path() ?>node/20" style="color:#9F9F88; font-size:10px; text-decoration:none; text-transform:uppercase;">Children's Portal</a></div>
						<div style="float:left; width:132px;"><a href="<?php print base_path() ?>" style="color:#9F9F88; font-size:10px; text-decoration:none; text-transform:uppercase;">Sponsor's Portal</a></div>
						<div style="float:right; width:132px;"><a href="<?php print base_path() ?>volunteer" style="color:#9F9F88; font-size:10px; text-decoration:none; text-transform:uppercase;">Volunteer's Portal</a></div>
					</div>
					-->
					
					<div style="width:264px; position:relative; top:-135px/* -152px */; left:690px; z-index:3000; font-weight:bold; color:#76DC17;">
						<div style="float:left; width:200px;">
							<div style="text-align:right; padding-right:5px; font-size:1.5em;">the power of hope</div>
							<div style="text-align:right; padding-top:5px; padding-right:5px; font-size:0.9em;">
								"and a little child will lead them."<br />
								- the prophecy
							</div>
						</div>
						<div style="float:right; width:64px;"><img src="<?php echo base_path().drupal_get_path("theme", "theme198") ?>/images/theme198_upper_right.jpg" border="0" /></div>
					</div>
				</div>
					
                <div class="head-row2">
                	<?php if (isset($primary_links)) : ?>
                        <div class="pr-menu">
                            <?php print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="head-row3">
                	<?php if ($breadcrumb != ""): ?>
						<?php print $breadcrumb ?>
                    <?php endif; ?>
                </div>
            </div>
        
        
            <div id="cont">
            	<div class="border-left">
                	<div class="border-right">
                    	<div class="border-top">
                        	<div class="border-bot">
                            	<div class="corner-top-left">
                                	<div class="corner-top-right">
                                    	<div class="corner-bot-left">
                                        	<div class="corner-bot-right">
                                            	<div class="inner">
                                                
                                                    <div id="cont-col">
                                                        <div class="ind">
                                                            
                                                            <?php if ($is_front != ""): ?>
                                                                <div id="custom">
                                                                    <?php print $custom?>
                                                                </div>
                                                            <?php endif; ?>
                                                            
                                                            <?php if ($tabs): print '<div id="tabs-wrapper" class="clear-block">'; endif; ?>
                                                            <?php if ($title): print '
                                                                <h2'. ($tabs ? ' class="with-tabs title"' : '') .'>'. $title .'</h2>
                                                            '; endif; ?>
                                                            <?php if ($tabs): print '<ul class="tabs primary">'. $tabs .'</ul></div>'; endif; ?>
                                                            <?php if ($tabs2): print '<ul class="tabs secondary">'. $tabs2 .'</ul>'; endif; ?>
                                                                             
                                                            <?php if ($show_messages && $messages != ""): ?>
                                                                <?php print $messages ?>
                                                            <?php endif; ?>
                                                        
                                                            <?php if ($help != ""): ?>
                                                                <div id="help"><?php print $help ?></div>
                                                            <?php endif; ?>
                                                        
                                                              <!-- start main content -->
                                                            <?php print $content; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($right != ""): ?>
                                                        <div id="right-col">
                                                            <div class="ind">
                                                                <?php print $right?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<div id="footer">
	<div id="bottom_ad">
		<script type="text/javascript"><!--
		google_ad_client = "pub-2114077817725080";
		/* Hope Cybrary 728x90 */
		google_ad_slot = "1597925796";
		google_ad_width = 728;
		google_ad_height = 90;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</div>
    <div class="foot">
        <?php if ($footer_message || $footer) : ?>
            <span><?php print $footer_message;?></span>
        <?php endif; ?>
    </div>
</div>
<?php print $closure;?>
</body>
</html>