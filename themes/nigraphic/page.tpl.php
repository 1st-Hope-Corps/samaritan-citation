<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>">
<!-- Theme Design by niGraphic.com -->
<head>
  <title>
  <?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>	
  <?php print $scripts ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?> </script>
  </head>
<body>

<div id="pagewidthHead">
	<div id="headerHead">
		<div id="logo">
			<?php if ($logo) : ?>
			<div class="logo">
				<a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><img src="<?php print($logo) ?>" alt="<?php print t('Home') ?>" border="0" /></a>
			</div>
			<?php endif; ?>
			<?php if ($site_name || $site_slogan) : ?>
				<div class="sitename">
					<?php if ($site_name) { ?><h1 class='site-name'><a href="<?php print $base_path ?>" title="<?php print $site_name ?>"><?php print $site_name ?></a></h1><?php } ?>
					<?php if ($site_slogan) { ?><h2 class='site-slogan'><?php print $site_slogan ?></h2><?php } ?>
				</div>
			<?php endif; ?>
		</div>
		<div id="HeaderSearch">
			<?php print $search_box ?>
		</div>
	</div>
	<div id="wrapperHead" class="clearfixHead">
		<div class="headBoxTop">
			<?php if (isset($primary_links)) { ?><?php print theme('links', $primary_links, array('class' =>'linksTop', 'id' => 'navlist')) ?><?php } ?></div>
		<div id="maincolHead" class="banner<?php print rand(1,2); // set number of random banners ?>">
			</div>
		<div id="primaryHead">
			<?php print $topleft ?>
		</div>
		<div class="headBoxBottom">
		</div>
	</div>
</div>
<div id="pagewidth">
	<div id="wrapper" class="clearfix">
		<div class="bodyBoxTop">
		</div>
		<div id="maincolBody">
			<div class="mainColContent">
			<?php if($title) { ?><h1 class="pagetitle"><?php print $title ?></h1><?php } ?>
				<?php print $breadcrumb ?>
				
				<div class="tabs"><?php print $tabs ?></div>
				<?php print $help ?>
				<?php print $messages ?>
				<?php print $content; ?>
				<?php print $feed_icons; ?>
			</div>
			<div class="mainColBottom">
			</div>
		</div>
		<div id="leftCol">
			<div class="leftColContent">
				<?php print $left ?>
			</div>
			<div class="leftColBottom">
			</div>
		</div>
	</div>
	<div class="footer">
		<?php print $footer_message ?> 
		<br/><a href="http://www.nigraphic.com" title="Web Design and Photography"> Design by niGraphic</a><br />
	</div>
</div>
<?php print $closure ?>
</body>

</html>
