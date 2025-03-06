<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to zen_hopegames_fb_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: zen_hopegames_fb_breadcrumb()
 *
 *   where zen_hopegames_fb is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Implementation of HOOK_theme().
 */
function zen_hopegames_fb_theme(&$existing, $type, $theme, $path) {


  $hooks = zen_theme($existing, $type, $theme, $path);
  // drupal_set_message('<pre>' . print_r($user,1) . '</pre>', 'status', FALSE);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function zen_hopegames_fb_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function zen_hopegames_fb_preprocess_page(&$vars, $hook) {

  global $user;
  global $base_url;

  if ( module_exists( 'fb' ) ) {
    // set $fb_app, $fb, and $fbu
    extract( fb_vars() );
    $vars['fb_app'] = $fb_app; // Configuration info about the current FB app
    $vars['fb']     = $fb; // Facebook object
    $vars['fbu']    = $fbu; // The FB user id (0 if app is not authorized)
  }

  zen_hopegames_fb_setup( $vars );

  // Insert a top bar into the header region
  // Place it above any other content
  $header = '<div id="top-bar">';
  if ( $vars['top_bar'] ) {
    $header .= $vars['top_bar'];
  }
  $header .= '</div>';
  $vars['header'] .= $header . $vars['header'];

  $vars['messages'] .= theme_status_messages();

  // Load the theme2010 stylesheet for a base
  // @TODO Create a new stylesheet with only what's needed
  $vars['styles'] .= '<link '. drupal_attributes(array(
    'rel' => 'stylesheet',
    'type' => 'text/css',
    'href' => base_path() . drupal_get_path( 'theme', 'theme2010') . '/style.css' )
  ) ." />\n";

  // Load the overrides
  $vars['styles'] .= '<link '. drupal_attributes(array(
    'rel' => 'stylesheet',
    'type' => 'text/css',
    'href' => base_path() . drupal_get_path( 'theme', 'zen_hopegames_fb') . '/css/custom.css' )
  ) ." />\n";


  // Load any JS scripts that are needed
  drupal_add_js('misc/jquery.cookie.js');
  drupal_add_js('misc/jqueryui/jquery-ui.min.js');
  $vars['scripts'] = drupal_get_js(); // necessary in D7?

  // Add a class to the body so we know we're in Facebook
  $vars['classes_array'][] = 'fb-iframe';
  
  // To remove a class from $classes_array, use array_diff().
  //$vars['classes_array'] = array_diff($vars['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function zen_hopegames_fb_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // zen_hopegames_fb_preprocess_node_page() or zen_hopegames_fb_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function zen_hopegames_fb_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function zen_hopegames_fb_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

function zen_hopegames_fb_setup ( &$vars ) {

  $fb = $vars['fb'];
  $fbu = $vars['fbu'];
  $fb_app = $vars['fb_app'];

  global $base_url;
  $drupal_sPath = $base_url;

  $vars['top_bar'] = '<div class="section clearfix">';

  if ( $fb && module_exists( 'fb_canvas' ) && fb_is_canvas() ) {

    if ( $fbu ) {
      // We have an authenticated FB user (Checked by Drupal for Facebook Module)
      
      $oUserProfile = fb_api('/me');

      $fb_sUserName = $oUserProfile['username'];
      $fb_sEmail = $oUserProfile['email'];
      
      // Check for a matching Drupal user
      if ( $drupal_id = fboauth_uid_load( $fbu ) ) {
        // Found a match
        
        // The global $user variable should have been correctly set by fb_ext.module
        global $user;

        if ( '0' == $user->status ) {
          // $vars['messages'] .= 'Your account has not yet been approved by an administrator. Please wait for the approval.';
          drupal_set_message( 'Your account has not yet been approved by an administrator. Please wait for the approval.', 'status' );
        }

        $vars['top_bar'] .= $user->name;

      } else {
        // This FB ID isn't mapped in the DB, so create a new mapping
        
        // Before setting a new Facebook ID for an account, make sure no other
        // Drupal account is connected with this Facebook ID.
        $drupal_sqlDeleteQuery = "DELETE FROM {fboauth_users} WHERE fbid = '%d'";
        $drupal_aDeleteArgs = array($fbu);

        db_query($drupal_sqlDeleteQuery, $drupal_aDeleteArgs);
        
        
        $drupal_iRandomId = mt_rand();
        $drupal_sUserName = $drupal_iRandomId . '_' . $fb_sUserName;
        $drupal_sPass = 'default';
        $drupal_sEmail = $drupal_iRandomId . '_' . $fb_sEmail;

        $new_user_data = array(
          'name' => $drupal_sUserName,
          'pass' => MD5($drupal_sPass),
          'mail' => $drupal_sEmail,
          'created' => 'UNIX_TIMESTAMP()',
          'timezone' => '28880',
          'picture' => 'sites/default/files/pictures/none.png',
          'init' => $drupal_sEmail,
          'data' => NULL,
          'inactive' => '5'
        );
        drupal_write_record( 'users', $new_user_data );

        $drupal_id = $new_user_data['uid'];
    
        db_query('INSERT INTO {fboauth_users} (uid, fbid) VALUES (%d, %d)', $drupal_id, $fbu);
        db_query("INSERT INTO {users_roles} (uid, rid) VALUES ('{$drupal_id}', '2')");

        // drupal_set_message( 'Created new user map for uid: ' . $drupal_id, 'status' );

        $redirect = $drupal_sPath . '/?q=fboauth/fbchangeinfo/' . $drupal_id;

        // drupal_goto( $redirect );
        ?>
        <script>
        self.location.href = '<?php echo $redirect; ?>';
        </script>
        <?php
        exit;
      }

      
      // $output .= 'Welcome, ' . $fb_profile['first_name'];

    } else {
      // The user hasn't authorized our app yet
      // The Drupal for Facebook app will redirect them to a specified page

      $fb_canvas_url = fb_protocol() . '://apps.facebook.com/' . $fb_app->canvas;
      $fb_oauth_url = "https://www.facebook.com/dialog/oauth?client_id=" . $fb_app->id . "&redirect_uri=" . urlencode($fb_canvas_url) . "&scope=email";

      // fb_canvas_redirect( $fb_oauth_url );
      
      $vars['content'] .= theme_fb_login_button( 'Connect', $options = array( 
                                                'attributes' => array(
                                                  'scope' => 'email',
                                                  'redirect' => $fb_canvas_url
                                                )));
      
      // $vars['top_bar'] .= l( 'Login', $fb_oauth_url );
      // echo fboauth_action_display( 'connect', $redirect = $fb_canvas_url, $app_id = $fb_app->id );
      //       
    }
    
    // $output .= '<pre>';
    // $output .= '$fb_app: ' . print_r($fb_app,1) . "\n";
    // $output .= '$fb_profile: ' . print_r($fb_profile,1) . "\n";
    // $output .= '$fb: ' . print_r($fb,1) . "\n";
    // $output .= '$fbu: ' . print_r($fbu,1) . "\n";
    // $output .= '</pre>';

    // $vars['top_bar'] .= '<pre>$user: ' . print_r($user,1) . '</pre>';

  }

  // Override the breadcrumbs
  unset( $vars['breadcrumb'] );
  drupal_set_breadcrumb( array(
    l("Dashboard", "instant/mentor/dashboard")
  ) );
  // Put the breadcrumbs into the top-bar
  // $vars['top_bar'] .= zen_breadcrumb( drupal_get_breadcrumb() );

  $vars['top_bar'] .= '</div>';

}

function zen_hopegames_fb_setup_top_bar ( &$vars ) {


}
