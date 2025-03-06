<?php
// Copied from /modules/user/user-profile.tpl.php

/**
 * @file user-profile.tpl.php
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * By default, all user profile data is printed out with the $user_profile
 * variable. If there is a need to break it up you can use $profile instead.
 * It is keyed to the name of each category or other data attached to the
 * account. If it is a category it will contain all the profile items. By
 * default $profile['summary'] is provided which contains data on the user's
 * history. Other data can be included by modules. $profile['user_picture'] is
 * available by default showing the account picture.
 *
 * Also keep in mind that profile items and their categories can be defined by
 * site administrators. They are also available within $profile. For example,
 * if a site is configured with a category of "contact" with
 * fields for of addresses, phone numbers and other related info, then doing a
 * straight print of $profile['contact'] will output everything in the
 * category. This is useful for altering source order and adding custom
 * markup for the group.
 *
 * To check for all available data within $profile, use the code below.
 * @code
 *   print '<pre>'. check_plain(print_r($profile, 1)) .'</pre>';
 * @endcode
 *
 * Available variables:
 *   - $user_profile: All user profile data. Ready for print.
 *   - $profile: Keyed array of profile categories and their items or other data
 *     provided by modules.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 */


global $user;

$iUID = $account->uid;


$dtmNow = new DateTime();


// Calculate age from birth date
if ( $account->profile_dob ) {
  $dtmBirthday = new DateTime( $account->profile_dob['year'] . '-' . $account->profile_dob['month'] . '-' . $account->profile_dob['day'] );
  $oInterval = $dtmNow->diff( $dtmBirthday );
  $sAge = $oInterval->format( '%y' );
}


// Calculate length of membership
if ( $account->created ) {
  $sJoined = format_interval( time() - $account->created );
}


// Calculate time since last login
if ( $account->access ) {
  $dtmAccessDate = new DateTime( date( 'Ymd', $account->access ) );
  $oInterval = $dtmNow->diff( $dtmAccessDate );
  $sAccessed = ( '0' == $oInterval->format( '%d' ) ? 'Today' : $oInterval->format( '%d days ago' ) );
}


// Google Maps
$sGmapsEmbedHtml = '';
if ( $account->profile_city || $account->profile_country ) {
  $sUserLocation = ucwords( implode( ', ', array( $account->profile_city, $account->profile_country ) ) );
  // Setup Google Maps
  $sGmapsParams = array(
    'q' => $sUserLocation,
    'mrt' => 'loc',
    'iwloc' => '',
    'z' => '10'
  );
  $sGmapsUrl = url( 'https://maps.google.com', $options = array( 'query' => $sGmapsParams ) );
  $sGmapsEmbedUrl = url( 'https://maps.google.com', $options = array( 'query' => array_merge( $sGmapsParams, array( 'output' => 'embed' ) ) ) );
  $sGmapsEmbedHtml = '<iframe src="' . $sGmapsEmbedUrl . '" frameborder="0" style="width:540px; height:280px;"></iframe>';
}


// Aid Status
$iMentorCount = 0;
$aMentors = array();
$sqlMentorName = "SELECT A.uid, B.name
        FROM user_hierarchy_mentor A
        INNER JOIN users B ON B.uid = A.uid
        WHERE A.child_id = %d";
$oMentorNameResult = db_query($sqlMentorName, $iUID);

while ($oMentorName = db_fetch_object($oMentorNameResult)){
  $iMentorCount++;
  $aMentors[] = $oMentorName->name;
}
mysqli_free_result($oMentorNameResult);


// Kindness Workz
$iKindnessHours = _kindness_get_hours($iUID);
$iCovertedHours = _kindness_get_hours($iUID, true);

$iTotalHours = $iKindnessHours + $iCovertedHours;
$iTotalTimeHour = intval($iTotalHours);
$iTotalTimeMin = ($iTotalHours - floor($iTotalHours)) * 60;

$sHourUnit = ($iTotalTimeHour > 1) ? 'hours':'hour';
$sMinUnit = ($iTotalTimeMin > 1) ? 'mins':'min';
$sComboMin = ($iTotalTimeMin > 0) ? ' and '.$iTotalTimeMin.' '.$sMinUnit:'';

$sKindessWorkz = $iTotalTimeHour.' '.$sHourUnit.$sComboMin;

?>


<?php if ( user_is_logged_in() && $user->uid == $account->uid ) : ?>

<?php endif; ?>

<div class="profile clearfix">

  <div id="user-menu" class="clearfix">
    User Menu
  </div>

  <div class="col left clearfix">

    <div id="profile-intro" class="box">
      <div class="content clearfix">
        <p class="profile-intro-hello">Hello, I&apos;m <?php echo $account->name; ?></p>
        <?php echo theme_image( $account->picture, $alt = '', $title = '', $attributes = array( 'class' => 'profile-picture' ), $getsize = FALSE ); ?>
        <dl class="fields">
          <dt>Age:</dt>
          <dd><?php echo $sAge; ?></dd>
          <dt>Grade:</dt>
          <dd><?php echo $account->profile_grade; ?></dd>
          <dt>Gender:</dt>
          <dd><?php echo $account->profile_gender; ?></dd>
          <dt>Views:</span></dd>
          <dt>Fans:</span></dd>
          <dt>Last Logged In:</dt>
          <dd><?php echo $sAccessed; ?></dd>
          <dt>Joined:</dt>
          <dd><?php echo $sJoined; ?></dd>
        </dl>
      </div>
    </div>

    <div id="profile-kindess-workz-summary" class="box">
      <h3 class="title">Kindess Workz</h3>

      <div id='dialog_KindnessWorkz' style='display:none;'>
        <div style='float: right;'>
          <a onmouseover='this.style.cursor="pointer"' style='font-size: 12px;' onfocus='this.blur();' onclick="document.getElementById('dialog_KindnessWorkz').style.display='none'; document.getElementById('dialog_KindnessWorkz').style.display='none'; " >
          [X]
          </a>
        </div>
        <div class="kindness-txt">
          <center>
            <h3 id="KindnessWorkz_Title">Kindness Workz Details</h3>
          </center>
        </div>
        <div style='text-align: left;padding-top:5px;padding-left:5px;overflow-y:auto;overflow-x:hidden;height:360px;'>
          <div id="KindnessWorkz_Text1" class="clearfix">
            <div id="KindnessWorkz_Text1Sub" class="kindness-txt kindness-dashboard-box" style="margin-left: auto; margin-right: auto;">
              loading..
            </div>
          </div>
          
          <div style="margin-top:10px;" class="kindness-txt">
            <h3>Kindness Workz Hours : Approved</h3>
            <div class="pending_top_txt">
              <div class="pending_top_title">Title</div>
              <div class="pending_top_duration">Duration</div>
              <div class="pending_top_date">Date Reported</div>
              <div class="pending_top_monitor">Mentor</div>
              <!--<div class="pending_top_admin">Admin</div>-->
            </div>
            <div class="pending-strip"></div>
            <div id="KindnessWorkz_Text2">loading...</div>
          </div>
        </div>
      </div>
      
      <div id='dialog_KindnessWorkz_Details' style='display:none;'>
        <div style='text-align: right;'><a onmouseover='this.style.cursor="pointer"' style='font-size: 12px;' onfocus='this.blur();' onclick="document.getElementById('dialog_KindnessWorkz_Details').style.display='none'; document.getElementById('dialog_KindnessWorkz_Details').style.display='none'; " >[X]</a></div>
        <div class="kindness-txt"><center><h3 id="KindnessWorkz_Details_Title">Kindness Workz Details</h3></center></div>
        <div style='text-align: left;padding-top:5px;padding-left:5px;overflow-y:auto;overflow-x:hidden;height:360px;'>
          <div id="KindnessWorkz_Details" class="clearfix">
            loading..
          </div>
        </div>
      </div>
    
      <div class="content clearfix">
        <?php echo theme_image( 'hud_files/images/kindness_ima01.jpg', $alt = '', $title = '', $attributes = array( 'class' => 'sidebar-icon-small' ), $getsize = FALSE ); ?>
        I&apos;ve performed <?php echo $sKindessWorkz; ?> of Kindness Workz.
        <a href="#" data-uid="<?php echo $iUID; ?>">Click here for details.</a>
      </div>
    </div>

    <div id="profile-aid-status" class="box">
      <h3 class="title">Aid Status</h3>
      <div class="content clearfix">
        <dl>
          <dt>eTutors:</dt>
          <dd>xx</dd>
          <dt>eMentors:</dt>
          <dd><?php echo $iMentorCount; ?></dd>
          <dt>Sponsors:</dt>
          <dd>xx</dd>
        </dl>
      </div>
    </div>

    <div id="profile-status" class="box">
      <h3 class="title">Status</h3>
      <div class="content clearfix">

      </div>
    </div>

  </div> <!-- .col.left -->


  <div class="col right">

    <div id="profile-about-me" class="box">
      <h3 class="title">About Me</h3>
      <div class="content clearfix">
        <dl>
          <dt>Languages:</dt>
          <dd><?php echo $account->profile_language; ?></dd>
          <dt>Talents:</dt>
          <dd><?php echo $account->profile_talents; ?></dd>
          <dt>Favorite Things:</dt>
          <dd><?php echo $account->profile_favorites; ?></dd>
        </dl>
      </div>
    </div>

    <div id="profile-location" class="box">
      <h3 class="title">Location</h3>
      <div class="content clearfix">
        <p><?php echo $sUserLocation; ?></p>
        <div class="google-map-embed">
          <?php echo $sGmapsEmbedHtml; ?>
          <p><a href="<?php echo $sGmapsUrl; ?>" target="_blank">View in Google Maps</a></p>
        </div>
      </div>
    </div>

    <div id="profile-wall" class="box">
      <h3 class="title">Kindness Workz Wall</h3>
      <div class="content clearfix">
        <?php echo user_ext_profile_wall_display( $user, $account ); ?>
      </div>
    </div>

    <div id="profile-friends" class="box">
      <h3 class="title">Friends</h3>
      <div class="content clearfix">

      </div>
    </div>

    <div id="profile-fans" class="box">
      <h3 class="title">I'm a fan of</h3>
      <div class="content clearfix">

      </div>
    </div>

    <div id="profile-photos" class="box">
      <h3 class="title">Photos</h3>
      <div class="content clearfix">

      </div>
    </div>

  </div> <!-- .col.right -->

</div>
