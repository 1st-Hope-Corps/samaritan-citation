<?php
/**
 * @file
 * Contains default views on behalf of the transactions  module.
 */


function transactions_views_handlers() {
  $handlers= array(
    'info' => array(
      'path' => drupal_get_path('module', 'transactions') .'/views',
    ),
    'handlers' => array(
      'views_handler_field_transactions_payer_uid' => array(
        'parent'=> 'views_handler_field'
      ),
      'views_handler_field_transactions_payee_uid' => array(
       'parent'=> 'views_handler_field'
      )
    )
  );
  return $handlers;
}

function transactions_views_data() {
  $data = array();
  $data['cc_transactions']['table']['group']  = t('Transactions');
  $data['cc_transactions']['table']['base'] = array(
    'field' => 'nid',
    'title' => t('Transaction'),
    'help' => t('Money flows between users.'),
  );
  $data['cc_transactions']['table']['join'] = array(
    'node' => array(
      'left_field' => 'nid',
      'field' => 'nid',
    ),
  );

  $data['cc_transactions']['payer_uid'] = array(
    'title' => t('Purchaser'), // The item it appears as on the UI,
    'field' => array(
      'help' => t('The user id who spent currency in the transaction.'),
      'handler' => 'views_handler_field_transactions_payer_uid'
    ),
    'filter' => array(
      'help' => t('Show only transactions where the current user paid'),
      'handler' => 'views_handler_filter_trader_current'
    ),
    'argument' => array(
      'help' => t('The user who spent currency in the transaction.'),
      'handler' => 'views_handler_argument'
    ),
    'relationship' => array(
      'help' => t('The user who spent currency in the transaction.'),
      'base' => 'users',
      'field' => 'payer_uid',
      'handler' => 'views_handler_relationship',
      'label' => t('Purchaser')
    ),
  );
  $data['cc_transactions']['payee_uid'] = array(
    'title' => t('Seller'), // The item it appears as on the UI,
    'field' => array(
      'help' => t('The user id who received currency in the transaction.'),
      'handler' => 'views_handler_field_transactions_payee_uid'
    ),
    'filter' => array(
      'help' => t('Show only transactions where the current user was paid'),
      'handler' => 'views_handler_filter_trader_current'
    ),
    'argument' => array(
      'help' => t('The user who received currency in the transaction.'),
      'handler' => 'views_handler_argument'
    ),
    'relationship' => array(
      'help' => t('The user who received currency in the transaction.'),
      'base' => 'users',
      'field' => 'payee_uid',
      'handler' => 'views_handler_relationship',
      'label' => t('Seller')
    ),
  );
  $data['cc_transactions']['quality'] = array(
    'title' => t('Rating'), // The item it appears as on the UI,
    'field' => array(
      'help' => t('Quality of the transaction according to the payer'),
      'handler' => 'views_handler_field'
    ),
  );
  $data['cc_transactions']['quantity'] = array(
    'title' => t('Amount'), // The item it appears as on the UI,
    'field' => array(
      'help' => t('Number of units of currency transferred'),
      'handler' => 'views_handler_field'
    ),
  );
  $data['cc_transactions']['cid'] = array(
    'title' => t('Currency'), // The item it appears as on the UI,
    'field' => array(
      'help' => t('The currency that the transaction was conducted in'),
      'handler' => 'views_handler_field'
    ),
  );

  $data['cc_balance_cache']['table']['group'] = 'Balances';
  $data['cc_balance_cache']['table']['base'] = array(
    'field' => 'uid',
    'title' => t('User Balance'),
    'help' => t('Balances of users.'),
  );
  $data['cc_balance_cache']['table']['join'] = array(
    'users' => array(
      'left_field' => 'uid',
      'field' => 'uid',
    ),
  );
  $data['cc_balance_cache']['balance']=array(
    'title' => t('Balance'),
    'field' => array(
      'help' => t("The user's total cleared income minus total cleared expenditure"),
      'handler' => 'views_handler_field',
    )
  );
  $data['cc_balance_cache']['pending']=array(
    'title' => t('Pending Balance'),
    'field' => array(
      'help' => t("The sum of the user's incomplete transactions"),
      'handler' => 'views_handler_field',
    )
  );
  $data['cc_balance_cache']['turnover']=array(
    'title' => t('Turnover'),
    'field' => array(
      'help' => t("The user's total cleared income ever"),
      'handler' => 'views_handler_field',
    )
  );
  return $data;
}

function transactions_views_data_alter(&$data){
  //print_r($data);
  $data['node']['status']['argument'] = array(
    'handler'=>'views_handler_argument'
  );

} 
 

function transactions_views_default_views() {
$view = new view;
$view->name = 'transactions_by_user';
$view->description = 'show transaction from or to a user';
$view->tag = 'transactions';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; 
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('relationships', array(
  'payer_uid' => array(
    'label' => t('Purchaser'),
    'required' => 1,
    'id' => 'payer_uid',
    'table' => 'cc_transactions',
    'field' => 'payer_uid',
    'relationship' => 'none',
  ),
  'payee_uid' => array(
    'id' => 'payee_uid',
    'table' => 'cc_transactions',
    'field' => 'payee_uid',
  ),
));
$handler->override_option('fields', array(
  'name_1' => array(
    'label' => t('Purchaser'),
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name_1',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'payer_uid',
  ),
  'name_2' => array(
    'label' => t('Seller'),
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name_2',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'payee_uid',
  ),
  'title' => array(
    'label' => t('Trade'),
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
  ),
  'quantity' => array(
    'label' => t('Amount'),
    'exclude' => 0,
    'id' => 'quantity',
    'table' => 'cc_transactions',
    'field' => 'quantity',
    'relationship' => 'none',
  ),
  'cid' => array(
    'label' => t('Currency'),
    'exclude' => 1,
    'id' => 'cid',
    'table' => 'cc_transactions',
    'field' => 'cid',
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'created' => array(
    'order' => 'DESC',
    'granularity' => 'minute',
    'id' => 'created',
    'table' => 'node',
    'field' => 'created',
    'relationship' => 'none',
  ),
));
$handler->override_option('arguments', array(
  'payer_uid' => array(
    'default_action' => 'empty',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => '',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'id' => 'payer_uid',
    'table' => 'cc_transactions',
    'field' => 'payer_uid',
    'relationship' => 'none',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'transaction' => 0,
      'offer' => 0,
      'want' => 0,
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
  'payee_uid' => array(
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
    'id' => 'payee_uid',
    'table' => 'cc_transactions',
    'field' => 'payee_uid',
    'relationship' => 'none',
    'default_argument_user' => 0,
    'default_argument_fixed' => '',
    'default_argument_php' => '',
    'validate_argument_node_type' => array(
      'transaction' => 0,
      'offer' => 0,
      'want' => 0,
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
      'transaction' => 'transaction',
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
  'status' => array(
    'operator' => '=',
    'value' => 1,
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'status',
    'table' => 'node',
    'field' => 'status',
    'relationship' => 'none',
  ),
));

$handler->override_option('title', t('Transactions by user'));
$handler->override_option('footer_format', '1');
$handler->override_option('empty', t("You haven't completed any transactions yet"));
$handler->override_option('empty_format', '1');
$handler->override_option('items_per_page', 5);
$handler->override_option('use_pager', 'mini');
$handler->override_option('distinct', 1);
$handler->override_option('style_plugin', 'table');

  $views[$view->name] = $view;


$view = new view;
$view->name = 'transaction_list';
$view->description = 'transactions from all users';
$view->tag = 'transactions';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; 
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('relationships', array(
  'payer_uid' => array(
    'label' => 'Purchaser',
    'required' => 1,
    'id' => 'payer_uid',
    'table' => 'cc_transactions',
    'field' => 'payer_uid',
    'relationship' => 'none',
  ),
  'payee_uid' => array(
    'id' => 'payee_uid',
    'table' => 'cc_transactions',
    'field' => 'payee_uid',
  ),
));
$handler->override_option('fields', array(
  'changed' => array(
    'label' => 'Date',
    'date_format' => 'custom',
    'custom_date_format' => 'd-m-y',
    'exclude' => 0,
    'id' => 'changed',
    'table' => 'node',
    'field' => 'changed',
    'relationship' => 'none',
  ),
  'name_1' => array(
    'label' => 'Purchaser',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name_1',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'payer_uid',
  ),
  'name_2' => array(
    'label' => 'Seller',
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name_2',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'payee_uid',
  ),
  'title' => array(
    'label' => 'Trade',
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
  ),
  'quantity' => array(
    'label' => 'Amount',
    'exclude' => 0,
    'id' => 'quantity',
    'table' => 'cc_transactions',
    'field' => 'quantity',
    'relationship' => 'none',
  ),
  'status' => array(
    'label' => 'Completed',
    'type' => 'yes-no',
    'not' => 0,
    'exclude' => 0,
    'id' => 'status',
    'table' => 'node',
    'field' => 'status',
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'created' => array(
    'order' => 'DESC',
    'granularity' => 'minute',
    'id' => 'created',
    'table' => 'node',
    'field' => 'created',
    'relationship' => 'none',
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'transaction' => 'transaction',
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
  'status' => array(
    'operator' => '=',
    'value' => '1',
    'group' => '0',
    'exposed' => TRUE,
    'expose' => array(
      'operator' => '',
      'identifier' => 'status',
      'label' => 'Completed',
      'optional' => 0,
      'remember' => 1,
    ),
    'id' => 'status',
    'table' => 'node',
    'field' => 'status',
    'relationship' => 'none',
  ),
));
$handler->override_option('access', array(
  'type' => 'none',
));
$handler->override_option('title', 'Transaction list');
$handler->override_option('footer_format', '1');
$handler->override_option('empty', 'There are no transactions in the system yet');
$handler->override_option('empty_format', '1');
$handler->override_option('use_pager', 'mini');
$handler->override_option('distinct', 1);
$handler->override_option('style_plugin', 'table');
$handler->override_option('style_options', array(
  'grouping' => '',
  'override' => 1,
  'sticky' => 0,
  'order' => 'asc',
  'columns' => array(
    'changed' => 'changed',
    'name_1' => 'name_1',
    'name_2' => 'name_2',
    'title' => 'title',
    'quantity' => 'quantity',
    'cid' => 'cid',
    'quality' => 'quality',
    'status' => 'status',
  ),
  'info' => array(
    'changed' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'name_1' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'name_2' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'title' => array(
      'sortable' => 0,
      'separator' => '',
    ),
    'quantity' => array(
      'separator' => '',
    ),
    'cid' => array(
      'separator' => '',
    ),
    'quality' => array(
      'separator' => '',
    ),
    'status' => array(
      'sortable' => 0,
      'separator' => '',
    ),
  ),
  'default' => 'changed',
));
  $views[$view->name] = $view;
  return $views;
}

/** 
 / Implementation of hook_views_query_alter
*/
function transactions_views_query_alter($view, &$query) {
  if ($view->name == 'statement') {
    $query->where[0]['clauses'][] = "cc_transactions.payee_uid = ".$query->where[0]['args'][0];
    $query->where[0]['type']= 'OR';
  }
}

/** 
 * Implementation of hook_views_pre_render
*/
function transactions_views_pre_render(&$view) { 
  if ($view->name == 'statement') {
    foreach ($view->result as $key=>$transaction){
      if ($transaction->cc_transactions_payer_uid == $view->payer_uid->argument) {
        $running_balance -= $transaction->cc_transactions_quantity;
        $view->result[$key]->expenditure = $transaction->cc_transactions_quantity;
        $view->result[$key]->income = NULL;
      } else {
        $running_balance += $transaction->cc_transactions_quantity;
        //we are repurposing the field payer_uid to mean other_person
        $view->result[$key]->cc_transactions_payer_uid = $transaction->cc_transactions_payer_uid;
        $view->result[$key]->income = $transaction->cc_transactions_quantity;
        $view->result[$key]->expenditure = NULL;
      }
    $view->result[$key]->running_balance = $running_balance;
    }
  print_r($view->result);
  }
}

//this seems to be expected if pre_render is present
function transactions_views_pre_view(){
}
