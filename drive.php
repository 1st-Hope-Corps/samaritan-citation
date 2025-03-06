<?php
require '/var/www/drupal/sites/all/modules/mystudies/vendor/vendor/autoload.php';

session_start();
ini_set("display_errors", "1");
error_reporting(E_ALL);
$client = new Google_Client();
$client->setAuthConfigFile('/var/www/drupal/sites/all/modules/mystudies/client_id.json');
//$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/drive.php');
$client->addScope(Google_Service_Drive::DRIVE);
  $client->setAccessType("offline");
  $client->setApprovalPrompt('force');

if (! isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $client->authenticate($_GET['code']);
  
  $_SESSION['access_token'] = $client->getAccessToken();
  echo '<pre>';print_r($_SESSION['access_token']);exit;
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
?>