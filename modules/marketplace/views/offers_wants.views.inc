<?php
/**
 * @file
 * Contains default views to supplement the offers/wants modules
 */

/**
 * Implementation of hook views_default_views().
 */
function offers_wants_views_default_views() {

$view = new view;
$view->name = 'directory_onepage';
$view->description = 'printable directory';
$view->tag = 'offers/wants';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE;
$handler = $view->new_display('default', 'Printable', 'default');
$handler->override_option('fields', array(
  'type' => array(
    'label' => 'Type',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
  ),
  'name_1' => array(
    'label' => 'Term',
    'link_to_taxonomy' => 0,
    'exclude' => 1,
    'id' => 'name_1',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'name' => array(
    'label' => 'Member',
    'link_to_user' => 0,
    'exclude' => 0,
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'title' => array(
    'label' => 'Skill or service',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'uid' => array(
    'order' => 'ASC',
    'id' => 'uid',
    'table' => 'users',
    'field' => 'uid',
    'relationship' => 'none',
  ),
));
$handler->override_option('arguments', array(
  'type' => array(
    'default_action' => 'ignore',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => '%1 Categories',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'image' => 0,
      'offer' => 0,
      'want' => 0,
      'transaction' => 0,
      'favour' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'offer' => 'offer',
      'want' => 'want',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
  ),
));
$handler->override_option('access', array(
  'type' => 'none',
  'role' => array(),
  'perm' => '',
));
$handler->override_option('items_per_page', 0);
$handler->override_option('style_plugin', 'table');
$handler->override_option('style_options', array(
  'grouping' => 'name_1',
  'override' => 0,
  'sticky' => 0,
  'order' => 'asc',
  'columns' => array(
    'name_1' => 'name_1',
    'title' => 'title',
    'value' => 'value',
    'name' => 'value',
    'uid' => 'uid',
  ),
  'info' => array(
    'name_1' => array(
      'sortable' => 0,
      'separator' => '',
    ),
    'title' => array(
      'sortable' => 0,
      'separator' => '',
    ),
    'value' => array(
      'sortable' => 0,
      'separator' => ' ',
    ),
    'name' => array(
      'sortable' => 0,
      'separator' => '',
    ),
    'uid' => array(
      'sortable' => 0,
      'separator' => '',
    ),
  ),
  'default' => '-1',
));
$handler->override_option('row_plugin', 'node');
$handler = $view->new_display('page', 'Page', 'page_2');
$handler->override_option('path', 'directory/print');
$handler->override_option('menu', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
  'name' => 'navigation',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));
$handler = $view->new_display('page', '1 col wants', 'page_3');
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'want' => 'want',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('title', 'Want Categories');
$handler->override_option('style_options', array(
  'grouping' => 'name_1',
  'override' => 1,
  'sticky' => 0,
  'order' => 'asc',
  'columns' => array(
    'title' => 'title',
    'name' => 'name',
    'name_1' => 'name_1',
  ),
  'info' => array(
    'title' => array(
      'sortable' => 0,
      'separator' => '',
    ),
    'name' => array(
      'sortable' => 0,
      'separator' => '',
    ),
    'name_1' => array(
      'sortable' => 0,
      'separator' => '',
    ),
  ),
  'default' => '-1',
));
$handler->override_option('path', 'directory/print/want');
$handler->override_option('menu', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
  'name' => 'navigation',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));


$views[$view->name] = $view; 


$view = new view;
$view->name = 'user_directory';
$view->description = 'Shows all my offers/wants in a user\'s directory';
$view->tag = 'offers/wants';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; 
$handler = $view->new_display('default', 'My offers/wants', 'default');
$handler->override_option('fields', array(
  'name' => array(
    'label' => 'Category',
    'link_to_taxonomy' => 0,
    'exclude' => 0,
    'id' => 'name',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'title' => array(
    'label' => '',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'override' => array(
      'button' => 'Override',
    ),
    'relationship' => 'none',
  ),
  'edit_node' => array(
    'label' => '',
    'text' => 'edit',
    'exclude' => 0,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'override' => array(
      'button' => 'Override',
    ),
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'name' => array(
    'order' => 'ASC',
    'id' => 'name',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
  ),
));
$handler->override_option('arguments', array(
  'type' => array(
    'default_action' => 'ignore',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => '%1 %2s',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'offer' => 0,
      'want' => 0,
      'transaction' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
    'override' => array(
      'button' => 'Override',
    ),
  ),
  'uid' => array(
    'default_action' => 'default',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => 'User %2s',
    'default_argument_type' => 'user',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'break_phrase' => 0,
    'not' => 0,
    'id' => 'uid',
    'table' => 'users',
    'field' => 'uid',
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'offer' => 0,
      'want' => 0,
      'transaction' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
    'override' => array(
      'button' => 'Override',
    ),
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'offer' => 'offer',
      'want' => 'want',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Override',
    ),
  ),
));
$handler->override_option('access', array(
  'type' => 'none',
  'role' => array(),
  'perm' => '',
));
$handler->override_option('title', 'User directory');
$handler->override_option('header', '<? return t(\'This user will pay for the following...\'); ?>');
$handler->override_option('header_format', '1');
$handler->override_option('header_empty', 0);
$handler->override_option('footer_format', '3');
$handler->override_option('footer_empty', 0);
$handler->override_option('items_per_page', 100);
$handler->override_option('style_plugin', 'table');
$handler->override_option('style_options', array(
  'grouping' => '',
  'override' => 1,
  'sticky' => 0,
  'order' => 'asc',
  'columns' => array(
    'name' => 'name',
    'title' => 'title',
    'edit_node' => 'title',
  ),
  'info' => array(
    'name' => array(
      'sortable' => 0,
      'separator' => '',
    ),
    'title' => array(
      'sortable' => 0,
      'separator' => ' ',
    ),
    'edit_node' => array(
      'separator' => '',
    ),
  ),
  'default' => '-1',
));
$handler->override_option('row_options', array(
  'inline' => array(
    'title' => 'title',
  ),
  'separator' => '',
));
$handler = $view->new_display('page', 'user offers page', 'page_1');
$handler->override_option('arguments', array(
  'uid' => array(
    'default_action' => 'default',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => 'User %2s',
    'default_argument_type' => 'user',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'break_phrase' => 0,
    'not' => 0,
    'id' => 'uid',
    'table' => 'users',
    'field' => 'uid',
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'offer' => 0,
      'want' => 0,
      'transaction' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
    'override' => array(
      'button' => 'Override',
    ),
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'offer' => 'offer',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('header', '<? return t(\'This user is looking to sell the following...\'); ?>');
$handler->override_option('items_per_page', 25);
$handler->override_option('path', 'user/directory/offer/%');
$handler->override_option('menu', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
  'name' => 'navigation',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));
$handler = $view->new_display('block', 'User directory entries', 'block_1');
$handler->override_option('items_per_page', 4);
$handler->override_option('block_description', '');
$handler->override_option('block_caching', -1);

$handler = $view->new_display('page', 'user wants page', 'page_2');
$handler->override_option('arguments', array(
  'uid' => array(
    'default_action' => 'default',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => 'User %2s',
    'default_argument_type' => 'user',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'break_phrase' => 0,
    'not' => 0,
    'id' => 'uid',
    'table' => 'users',
    'field' => 'uid',
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'offer' => 0,
      'want' => 0,
      'transaction' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
    'override' => array(
      'button' => 'Override',
    ),
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'want' => 'want',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('path', 'user/directory/want');
$handler->override_option('menu', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
  'name' => 'navigation',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));

$views[$view->name] = $view;  


$view = new view;
$view->name = 'directory_recent';
$view->description = 'Directory Entries by published date';
$view->tag = 'offers/wants';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('fields', array(
  'type' => array(
    'label' => 'Type',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
  ),
  'name_1' => array(
    'label' => 'Category',
    'link_to_taxonomy' => 0,
    'exclude' => 0,
    'id' => 'name_1',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'title' => array(
    'label' => 'Description',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
  ),
  'name' => array(
    'label' => 'Member',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'edit_node' => array(
    'label' => '',
    'text' => 'Edit',
    'exclude' => 0,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'name' => array(
    'order' => 'ASC',
    'id' => 'name',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'changed' => array(
    'order' => 'DESC',
    'granularity' => 'hour',
    'id' => 'changed',
    'table' => 'node',
    'field' => 'changed',
    'relationship' => 'none',
  ),
));
$handler->override_option('arguments', array(
  'name' => array(
    'default_action' => 'ignore',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => 'Latest %1 offers',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'glossary' => 0,
    'limit' => '0',
    'case' => 'none',
    'path_case' => 'none',
    'transform_dash' => 1,
    'add_table' => 0,
    'require_value' => 0,
    'id' => 'name',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'offer' => 0,
      'want' => 0,
      'requack' => 0,
      'transaction' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
    'override' => array(
      'button' => 'Override',
    ),
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'offer' => 'offer',
      'want' => 'want',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
  ),
));
$handler->override_option('access', array(
  'type' => 'none',
));
$handler->override_option('title', 'Latest directory entries');
$handler->override_option('header', 'Directory entries, newest first');
$handler->override_option('header_format', '1');
$handler->override_option('header_empty', 0);
$handler->override_option('footer', 'Click here to <a href="node/add/offerzxcfvsdfg">add a new offer</a> to the directory.

Click here to <a href="node/add/want">add a new want</a> to the directory.

Click here for a <a href="directory/print">printable directory</a>.
<!-- if print module is installed link to \'/print/directory/print\'-->');
$handler->override_option('footer_format', '1');
$handler->override_option('footer_empty', 1);
$handler->override_option('empty', 'There are no entries in this category');
$handler->override_option('empty_format', '1');
$handler->override_option('items_per_page', 0);
$handler->override_option('use_more', 1);
$handler->override_option('distinct', 1);
$handler->override_option('style_plugin', 'table');
$handler->override_option('style_options', array(
  'grouping' => '',
  'override' => 1,
  'sticky' => 0,
  'order' => 'asc',
  'columns' => array(
    'title_1' => 'title_1',
    'name' => 'name',
    'created' => 'created',
    'edit_node' => 'edit_node',
  ),
  'info' => array(
    'title_1' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'name' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'created' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'edit_node' => array(
      'separator' => '',
    ),
  ),
  'default' => '-1',
));
$handler = $view->new_display('feed', 'Feed', 'feed_1');
$handler->override_option('access', array(
  'type' => 'role',
  'role' => array(
    '2' => 2,
  ),
));
$handler->override_option('items_per_page', 25);
$handler->override_option('style_plugin', 'rss');
$handler->override_option('style_options', array(
  'mission_description' => FALSE,
  'description' => '',
));
$handler->override_option('row_plugin', 'node_rss');
$handler->override_option('row_options', array(
  'item_length' => 'title',
));
$handler->override_option('path', 'directory/recent/rss/offers/%1');
$handler->override_option('menu', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
  'name' => 'navigation',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));
$handler->override_option('displays', array(
  'default' => 'default',
  'page_1' => 'page_1',
  'block_1' => 'block_1',
));
$handler->override_option('sitename_title', FALSE);
$handler = $view->new_display('page', 'Latest directory entries', 'page_1');
$handler->override_option('fields', array(
  'title_1' => array(
    'label' => 'Description',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title_1',
    'table' => 'node',
    'field' => 'title',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
  'name' => array(
    'label' => 'Member',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'created' => array(
    'label' => 'Posted on',
    'date_format' => 'custom',
    'custom_date_format' => 'd/m/y',
    'exclude' => 0,
    'id' => 'created',
    'table' => 'node',
    'field' => 'created',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'edit_node' => array(
    'label' => '',
    'text' => 'Edit',
    'exclude' => 1,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('arguments', array(
  'type' => array(
    'default_action' => 'ignore',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => '',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'override' => array(
      'button' => 'Override',
    ),
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'offer' => 0,
      'want' => 0,
      'transaction' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
  ),
  'name' => array(
    'default_action' => 'ignore',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => 'Latest %1 offers',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'glossary' => 0,
    'limit' => '0',
    'case' => 'none',
    'path_case' => 'none',
    'transform_dash' => 1,
    'add_table' => 0,
    'require_value' => 0,
    'id' => 'name',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'offer' => 0,
      'want' => 0,
      'transaction' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('items_per_page', 20);
$handler->override_option('path', 'directory/recent');
$handler->override_option('menu', array(
  'type' => 'normal',
  'title' => 'Latest offers/wants',
  'weight' => '0',
  'name' => 'complementary-currencies',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));
$handler = $view->new_display('block', 'latest offers block', 'block_1');
$handler->override_option('fields', array(
  'title' => array(
    'label' => '',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'uid' => array(
    'label' => '',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'uid',
    'table' => 'users',
    'field' => 'uid',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
));
$handler->override_option('header', '');
$handler->override_option('use_ajax', TRUE);
$handler->override_option('items_per_page', 5);
$handler->override_option('use_pager', 'mini');
$handler->override_option('use_more', 0);
$handler->override_option('style_plugin', 'list');
$handler->override_option('style_options', array());
$handler->override_option('row_options', array(
  'inline' => array(
    'title' => 'title',
    'uid' => 'uid',
  ),
  'separator' => '>',
));
$handler->override_option('block_description', '');
$handler->override_option('block_caching', -1);

$views[$view->name] = $view;



$view = new view;
$view->name = 'directory_recent_offers';
$view->description = 'Offers by published date';
$view->tag = 'offers/wants';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('fields', array(
  'name_1' => array(
    'label' => 'Category',
    'link_to_taxonomy' => 0,
    'exclude' => 0,
    'id' => 'name_1',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'title' => array(
    'label' => 'Description',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
  ),
  'name' => array(
    'label' => 'Member',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'edit_node' => array(
    'label' => '',
    'text' => 'Edit',
    'exclude' => 0,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'name' => array(
    'order' => 'ASC',
    'id' => 'name',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'changed' => array(
    'order' => 'DESC',
    'granularity' => 'hour',
    'id' => 'changed',
    'table' => 'node',
    'field' => 'changed',
    'relationship' => 'none',
  ),
));
$handler->override_option('arguments', array(
  'name' => array(
    'default_action' => 'ignore',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => 'Latest %1 offers',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'glossary' => 0,
    'limit' => '0',
    'case' => 'none',
    'path_case' => 'none',
    'transform_dash' => 1,
    'add_table' => 0,
    'require_value' => 0,
    'id' => 'name',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'offer' => 0,
      'want' => 0,
      'requack' => 0,
      'transaction' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
    'override' => array(
      'button' => 'Override',
    ),
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'offer' => 'offer',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
  ),
));
$handler->override_option('access', array(
  'type' => 'none',
));
$handler->override_option('title', 'Latest Offers');
$handler->override_option('header', 'Offers, newest first');
$handler->override_option('header_format', '1');
$handler->override_option('header_empty', 0);
$handler->override_option('footer', 'Click here to <a href="node/add/offer">add a new offer</a> to the directory.

Click here for a <a href="directory/print/offer">printable directory</a>.
<!-- if print module is installed link to \'/print/directory/print/offer\'-->');
$handler->override_option('footer_format', '1');
$handler->override_option('footer_empty', 1);
$handler->override_option('empty', 'There are no offers in this category');
$handler->override_option('empty_format', '1');
$handler->override_option('items_per_page', 0);
$handler->override_option('use_more', 1);
$handler->override_option('distinct', 1);
$handler->override_option('style_plugin', 'table');
$handler->override_option('style_options', array(
  'grouping' => '',
  'override' => 1,
  'sticky' => 0,
  'order' => 'asc',
  'columns' => array(
    'title_1' => 'title_1',
    'name' => 'name',
    'created' => 'created',
    'edit_node' => 'edit_node',
  ),
  'info' => array(
    'title_1' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'name' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'created' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'edit_node' => array(
      'separator' => '',
    ),
  ),
  'default' => '-1',
));
$handler = $view->new_display('feed', 'Feed', 'feed_1');
$handler->override_option('access', array(
  'type' => 'role',
  'role' => array(
    '2' => 2,
  ),
));
$handler->override_option('items_per_page', 25);
$handler->override_option('style_plugin', 'rss');
$handler->override_option('style_options', array(
  'mission_description' => FALSE,
  'description' => '',
));
$handler->override_option('row_plugin', 'node_rss');
$handler->override_option('row_options', array(
  'item_length' => 'title',
));
$handler->override_option('path', 'directory/recent/rss/offers/%1');
$handler->override_option('menu', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
  'name' => 'navigation',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));
$handler->override_option('displays', array(
  'default' => 'default',
  'page_1' => 'page_1',
  'block_1' => 'block_1',
));
$handler->override_option('sitename_title', FALSE);
$handler = $view->new_display('page', 'Latest offers page', 'page_1');
$handler->override_option('fields', array(
  'title_1' => array(
    'label' => 'Description',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title_1',
    'table' => 'node',
    'field' => 'title',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
  'name' => array(
    'label' => 'Member',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'created' => array(
    'label' => 'Posted on',
    'date_format' => 'custom',
    'custom_date_format' => 'd/m/y',
    'exclude' => 0,
    'id' => 'created',
    'table' => 'node',
    'field' => 'created',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'edit_node' => array(
    'label' => '',
    'text' => 'Edit',
    'exclude' => 1,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('items_per_page', 20);
$handler->override_option('path', 'directory/recent/offer');
$handler->override_option('menu', array(
  'type' => 'normal',
  'title' => 'Latest offers',
  'weight' => '0',
  'name' => 'complementary-currencies',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));
$handler = $view->new_display('block', 'latest offers block', 'block_1');
$handler->override_option('fields', array(
  'title' => array(
    'label' => '',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'uid' => array(
    'label' => '',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'uid',
    'table' => 'users',
    'field' => 'uid',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
));
$handler->override_option('header', '');
$handler->override_option('use_ajax', TRUE);
$handler->override_option('items_per_page', 5);
$handler->override_option('use_pager', 'mini');
$handler->override_option('use_more', 0);
$handler->override_option('style_plugin', 'list');
$handler->override_option('style_options', array());
$handler->override_option('row_options', array(
  'inline' => array(
    'title' => 'title',
    'uid' => 'uid',
  ),
  'separator' => '>',
));
$handler->override_option('block_description', '');
$handler->override_option('block_caching', -1);

$views[$view->name] = $view;


$view = new view;
$view->name = 'directory_recent_wants';
$view->description = 'Wants by published date';
$view->tag = 'offers/wants';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('fields', array(
  'name_1' => array(
    'label' => 'Category',
    'link_to_taxonomy' => 0,
    'exclude' => 0,
    'id' => 'name_1',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'title' => array(
    'label' => 'Description',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
  ),
  'name' => array(
    'label' => 'Member',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'edit_node' => array(
    'label' => '',
    'text' => 'Edit',
    'exclude' => 0,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'name' => array(
    'order' => 'ASC',
    'id' => 'name',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'changed' => array(
    'order' => 'DESC',
    'granularity' => 'hour',
    'id' => 'changed',
    'table' => 'node',
    'field' => 'changed',
    'relationship' => 'none',
  ),
));
$handler->override_option('arguments', array(
  'name' => array(
    'default_action' => 'ignore',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => 'Latest %1 wants',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'glossary' => 0,
    'limit' => '0',
    'case' => 'none',
    'path_case' => 'none',
    'transform_dash' => 1,
    'add_table' => 0,
    'require_value' => 0,
    'id' => 'name',
    'table' => 'term_data',
    'field' => 'name',
    'relationship' => 'none',
    'default_options_div_prefix' => '',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'offer' => 0,
      'want' => 0,
      'requack' => 0,
      'transaction' => 0,
      'page' => 0,
      'story' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '1' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_php' => '',
    'override' => array(
      'button' => 'Override',
    ),
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'want' => 'want',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
  ),
));
$handler->override_option('access', array(
  'type' => 'none',
));
$handler->override_option('title', 'Latest Wants');
$handler->override_option('header', 'Wants, newest first');
$handler->override_option('header_format', '1');
$handler->override_option('header_empty', 0);
$handler->override_option('footer', 'Click here to <a href="node/add/want">add a new want</a> to the directory.

Click here for a <a href="directory/print/want">printable directory</a>.
<!-- if print module is installed link to \'/print/directory/print/want\'-->');
$handler->override_option('footer_format', '1');
$handler->override_option('footer_empty', 1);
$handler->override_option('empty', 'There are no wants in this category');
$handler->override_option('empty_format', '1');
$handler->override_option('items_per_page', 0);
$handler->override_option('use_more', 1);
$handler->override_option('distinct', 1);
$handler->override_option('style_plugin', 'table');
$handler->override_option('style_options', array(
  'grouping' => '',
  'override' => 1,
  'sticky' => 0,
  'order' => 'asc',
  'columns' => array(
    'title_1' => 'title_1',
    'name' => 'name',
    'created' => 'created',
    'edit_node' => 'edit_node',
  ),
  'info' => array(
    'title_1' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'name' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'created' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'edit_node' => array(
      'separator' => '',
    ),
  ),
  'default' => '-1',
));
$handler = $view->new_display('feed', 'Feed', 'feed_1');
$handler->override_option('access', array(
  'type' => 'role',
  'role' => array(
    '2' => 2,
  ),
));
$handler->override_option('items_per_page', 25);
$handler->override_option('style_plugin', 'rss');
$handler->override_option('style_options', array(
  'mission_description' => FALSE,
  'description' => '',
));
$handler->override_option('row_plugin', 'node_rss');
$handler->override_option('row_options', array(
  'item_length' => 'title',
));
$handler->override_option('path', 'directory/recent/rss/wants/%1');
$handler->override_option('menu', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
  'name' => 'navigation',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));
$handler->override_option('displays', array(
  'default' => 'default',
  'page_1' => 'page_1',
  'block_1' => 'block_1',
));
$handler->override_option('sitename_title', FALSE);
$handler = $view->new_display('page', 'Latest wants page', 'page_1');
$handler->override_option('fields', array(
  'title_1' => array(
    'label' => 'Description',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title_1',
    'table' => 'node',
    'field' => 'title',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
  'name' => array(
    'label' => 'Member',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'created' => array(
    'label' => 'Posted on',
    'date_format' => 'custom',
    'custom_date_format' => 'd/m/y',
    'exclude' => 0,
    'id' => 'created',
    'table' => 'node',
    'field' => 'created',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'edit_node' => array(
    'label' => '',
    'text' => 'Edit',
    'exclude' => 1,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('items_per_page', 20);
$handler->override_option('path', 'directory/recent/want');
$handler->override_option('menu', array(
  'type' => 'normal',
  'title' => 'Latest wants',
  'weight' => '0',
  'name' => 'complementary-currencies',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'weight' => 0,
));
$handler = $view->new_display('block', 'latest wants block', 'block_1');
$handler->override_option('fields', array(
  'title' => array(
    'label' => '',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'uid' => array(
    'label' => '',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'uid',
    'table' => 'users',
    'field' => 'uid',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
));
$handler->override_option('header', '');
$handler->override_option('use_ajax', TRUE);
$handler->override_option('items_per_page', 5);
$handler->override_option('use_pager', 'mini');
$handler->override_option('use_more', 0);
$handler->override_option('style_plugin', 'list');
$handler->override_option('style_options', array());
$handler->override_option('row_options', array(
  'inline' => array(
    'title' => 'title',
    'uid' => 'uid',
  ),
  'separator' => '>',
));
$handler->override_option('block_description', '');
$handler->override_option('block_caching', -1);

$views[$view->name] = $view;


return $views;
}
