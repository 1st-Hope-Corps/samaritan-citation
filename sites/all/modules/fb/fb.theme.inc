<?php
/**
 * @file
 * Implementation of theme functions.
 *
 * XFBML markup will only work on canvas pages and facebook connect pages.
 */

drupal_add_css(drupal_get_path('module', 'fb') . '/fb.theme.css');


function theme_fb_markup($not_connected_markup, $connected_markup, $options = array()) {
  if ($not_connected_markup == $connected_markup) {
    return $not_connected_markup;
  }

  // Merge in defaults
  $options += array(
    'wrapper' => 'div',
  );

  $output = '';
  if ($not_connected_markup) {
    $output .= '<' . $options['wrapper'] . ' class=fb_not_connected>' . $not_connected_markup . '</' . $options['wrapper'] . '>';
  }
  if ($connected_markup) {
    $output .= '<' . $options['wrapper'] . ' class=fb_connected>' . $connected_markup . '</' . $options['wrapper'] . '>';
  }
  return $output;
}

/**
 * Theme a Facebook Connect button.
 *
 * Uses a link with onclick="FB.login()", because this works much better
 * than fb:login-button on Firefox when third-party cookies disabled.
 *
 */
function theme_fb_login_button($text = NULL, $options = array()) {
  // Merge in defaults
  $options += array(
    'attributes' => array(),
    'connected_markup' => NULL,
  );

  $options['attributes'] += array(
    'class' => 'fb_login_button_wrapper fb_button_style',
  );

  if ($text === NULL) {
    $text = t('Connect');
  }


  // For compatibility, pass in scope as an attribute.
  if (!isset($options['attributes']['scope'])) {
    // Which permissions to prompt for?
    $perms = array();
    drupal_alter('fb_required_perms', $perms);
    if (count($perms)) {
      $options['attributes']['scope'] = implode(',', $perms);
    }
  }
  $scope = $options['attributes']['scope'];
  unset($options['attributes']['scope']); // New markup does not need this attr.

  $markup = '<div ' . drupal_attributes($options['attributes']) . '><a href="#" onclick="FB.login(function(){}, {scope : \'' . $scope . '\'}); return false;"><div><span>' . $text . '</span></div></a></div>';

  if ($options['connected_markup']) {
    $markup = '<div class=fb_not_connected>' . $markup . '</div>' .
      '<div class=fb_connected>' . $options['connected_markup'] . '</div>';
  }
  return $markup;
}

// This is the old way, using facebook social plugin markup
// Replaced by theme_fb_login_button() above to better support Firefox with third-party cookies disabled.
function theme_fb_login_buttonXXX($text = '', $options = array()) {
  // Merge in defaults
  $options += array(
    'attributes' => array(),
    'connected_markup' => NULL,
  );
  $options['attributes'] += array(
    'class' => 'fb-login-button', // important
    'data-show-faces' => 'false',
    'data-max-rows' => 1,
  );

  if (!isset($options['attributes']['scope'])) {
    // Which permissions to prompt for?
    $perms = array();
    drupal_alter('fb_required_perms', $perms);
    if (count($perms)) {
      $options['attributes']['scope'] = implode(',', $perms);
    }
  }

  $button = '<div ' . drupal_attributes($options['attributes']) . '>' .
    ($text ? check_plain($text) : '') . '</div>';

  // Show picture instead of button when user is connected.
  if ($options['connected_markup']) {
    $button = '<div class=fb_not_connected>' . $button . '</div>' .
      '<div class=fb_connected>' . $options['connected_markup'] . '</div>';
  }
  return $button;
}


function theme_fb_username($fbu, $object, $orig) {
  if (!$fbu || arg(0) == 'admin') {
    return $orig;
  }

  $wrap_pre = "<span class=fb_hide>$orig</span><span class=fb_show>";
  $wrap_post = "</span>\n";
  $ifcantsee = '';
  if ($object->uid && user_access('access user profiles')) {
    // Provide link if local account.
    $wrap_pre = $wrap_pre . '<a href="' . url('user/' . $object->uid) . '">';
    $wrap_post = '</a>' . $wrap_post;
    $ifcantsee = 'ifcantsee="' . addslashes(check_plain($object->name)) . '"';
  }

  $fbml = "<fb:name linked=false useyou=false uid=\"$fbu\" $ifcantsee></fb:name>";  $output =  $wrap_pre . $fbml . $wrap_post;

  return $output;
}

function theme_fb_user_picture($fbu, $object, $orig) {
  if (!$fbu)
    return $orig;

  // http://developers.facebook.com/docs/reference/fbml/profile-pic
  $fbml = "<fb:profile-pic linked=false uid=\"$fbu\"></fb:profile-pic>";
  $wrap_pre = '<span class=fb_hide>' . $orig . '</span><span class="fb_show"><div class="picture">';
  $wrap_post = '</div></span>';
  if ($object->uid && user_access('access user profiles')) {
    // Provide link to local account.
    $wrap_pre = $wrap_pre . '<a href="' . url('user/' . $object->uid) . '">';
    $wrap_post = '</a>' . $wrap_post;
  }
  return $wrap_pre . $fbml . $wrap_post;
}


function theme_fb_fbml_popup($elem) {
  // Hide this markup until javascript shows it.
  $t = '<div class="fb_fbml_popup_wrap" ' . ">\n";

  $t .= '<a href="#" title="' . check_plain($elem['#title']) . '" ' .
    (isset($elem['#link_attributes']) ? drupal_attributes($elem['#link_attributes']) : '') .
    '>' . check_plain($elem['#link_text']) .'</a>';
  $t .= '<div class="fb_fbml_popup" ' . drupal_attributes($elem['#attributes']) . '>';
  $t .= $elem['#children'];
  $t .= "</div></div>\n";
  return $t;
}
