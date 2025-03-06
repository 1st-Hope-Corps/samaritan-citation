<?php
global $sAuthURL;

$sAuthLinkOptions = array(
  'attributes' => array(
    'class' => 'button',
    'target' => '_top'
    )
  );

$sAuthLink = l( 'Connect', $sAuthURL, $sAuthLinkOptions )
?>

<div id="welcome" class="content-box">
  <h1>HopeGames</h1>
  <h2>Instant Mentoring App</h2>
  <p>Instant eMentoring is a powerful way to bring hope to a child.</p>
  <p>To get started, simply click the button below to log in using your Facebook account.</p>
  <p class="fb-login"><?php echo $sAuthLink; ?></p>
</div>

<?php // echo instant_about_box(); ?>
