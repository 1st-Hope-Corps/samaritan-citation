<?php
/**
 * @file
 * Contains default views on behalf of the transactions  module.
 */

 /**
 * Implementation of hook_views_data()
 */

function requack_views_data() {
  $data = array();
  $data['cc_requack']['table']['group']  = t('Requests/acknowledgements');
  $data['cc_requack']['table']['base'] = array(
    'title' => t('Requests/acknowledgements'),
    'field' => 'nid',
    'help' => t('Things requested done for free, and counted'),
  );
  $data['cc_requack']['table']['join'] = array(
    'node' => array(
      'left_field' => 'nid',
      'field' => 'nid',
    ),
  );

  $data['cc_requack']['completer_uid'] = array(
    'title' => t('Completer'), // The item it appears as on the UI,
    'field' => array(
      'help' => t('The user id who met the request'),
      'handler' => 'views_handler_field_requack_completer_uid'
    ),
    'filter' => array(
      'help' => t('The user id who met the request'),
      'handler' => 'views_handler_filter_requack_completer_uid'
    ),
  );
  $words = variable_get('cc_requack', array(t('Request'), t('Acknowledgement')));
  $data['cc_requack_count']['table']['group'] = 'Acknowledgements';
  
  $data['cc_requack_count']['table']['base'] = array(
    'field' => 'count',
    'title' => t('Number of @acknowledgements', array('@acknowledgement' => $words[1])),
  );
  $data['cc_requack_count']['table']['join'] = array(
    'users' => array(
      'left_field' => 'uid',
      'field' => 'uid',
    ),
  );
  $data['cc_requack_count']['count']=array(
    'title' => t('Total'),
    'field' => array(
      'help' => t("The total number of @acknowledgements received by the user", array('@acknowledgement' => $word[1])),
      'handler' => 'views_handler_field_requack_count',
    )
  );
  return $data;
}

function requack_views_handlers() {
  $handlers= array(
    'info' => array(
      'path' => drupal_get_path('module', 'transactions') .'/views',
    ),
    'handlers' => array(
      'views_handler_field_requack_completer_uid' => array(
        'parent' => 'views_handler_field'
      ),
      'views_handler_filter_requack_completer_uid' => array(
       'parent' => 'views_handler_filter_boolean_operator'
      ),
      'views_handler_field_requack_count' => array (
        'parent' => 'views_handler_field'
      )
    )
  );
  return $handlers;
}


function requack_views_default_views() {
$view = new view;
$view->name = 'request_acknowledgement';
$view->description = 'lists and blocks of requacks';
$view->tag = 'transactions';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('fields', array(
  'title' => array(
    'label' => '',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
  ),
  'edit_node' => array(
    'label' => '',
    'text' => 'complete this',
    'exclude' => 0,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'changed' => array(
    'order' => 'DESC',
    'granularity' => 'day',
    'id' => 'changed',
    'table' => 'node',
    'field' => 'changed',
    'relationship' => 'none',
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'requack' => 'requack',
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
  'completer_uid' => array(
    'operator' => '=',
    'value' => 0,
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'completer_uid',
    'table' => 'cc_requack',
    'field' => 'completer_uid',
    'relationship' => 'none',
  ),
));
$handler->override_option('access', array(
  'type' => 'none',
));
$handler->override_option('title', 'Requests');
$handler->override_option('items_per_page', 5);
$handler->override_option('style_plugin', 'list');
$handler->override_option('style_options', array(
  'grouping' => '',
  'type' => 'ul',
));
$handler = $view->new_display('page', 'Requests page', 'page_1');
$handler->override_option('items_per_page', 100);
$handler->override_option('path', 'requests');
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
$handler = $view->new_display('block', 'requests block', 'block_1');
$handler->override_option('use_ajax', TRUE);
$handler->override_option('items_per_page', 100);
$handler->override_option('block_description', 'outstanding Requests');
$handler->override_option('block_caching', -1);
$handler = $view->new_display('page', 'Acknowledgements page', 'page_2');
$handler->override_option('fields', array(
  'completer_uid_2' => array(
    'label' => 'Thanks',
    'link_to_completer' => 1,
    'exclude' => 0,
    'id' => 'completer_uid_2',
    'table' => 'cc_requack',
    'field' => 'completer_uid',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
  'title' => array(
    'label' => 'for',
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
  'edit_node' => array(
    'label' => '',
    'text' => 'edit',
    'exclude' => 0,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'requack' => 'requack',
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
  'completer_uid' => array(
    'operator' => '=',
    'value' => 1,
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'completer_uid',
    'table' => 'cc_requack',
    'field' => 'completer_uid',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('title', 'Acknowledgements');
$handler->override_option('path', 'acknowledgements');
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
$handler = $view->new_display('block', 'acknowledgements block', 'block_2');
$handler->override_option('fields', array(
  'title' => array(
    'label' => '',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
  ),
  'completer_uid_2' => array(
    'label' => 'Completer',
    'link_to_completer' => 0,
    'exclude' => 0,
    'id' => 'completer_uid_2',
    'table' => 'cc_requack',
    'field' => 'completer_uid',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
  'edit_node' => array(
    'label' => '',
    'text' => 'complete',
    'exclude' => 0,
    'id' => 'edit_node',
    'table' => 'node',
    'field' => 'edit_node',
    'relationship' => 'none',
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'requack' => 'requack',
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
  'completer_uid' => array(
    'operator' => '=',
    'value' => 1,
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'completer_uid',
    'table' => 'cc_requack',
    'field' => 'completer_uid',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('title', 'Acknowledgements');
$handler->override_option('use_ajax', TRUE);
$handler->override_option('use_more', 1);
$handler->override_option('block_description', 'recent acknowledgements');
$handler->override_option('block_caching', -1);

  $views[$view->name] = $view;
  return $views;
}
