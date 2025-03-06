<?php
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$id = $_GET['id'];

$query_team_photo = db_result(db_query("select photo from invest_team where team_id = '".$id."'"));

if($query_team_photo !== ''){
header("Content-type: image/jpeg");
echo base64_decode($query_team_photo);
}
?>