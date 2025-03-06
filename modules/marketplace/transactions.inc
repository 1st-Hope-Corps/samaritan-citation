<?php

/*
 * This file handles all the non-hook functions and stuff that isn't needed in other areas of the site
 * Although statistics are kept in another file, for now
 * Contains the config pages, most of the functions referred to in hook_menu and a load of other helper functions
 */
//builds the form for configuring transactions.
function default_currency_config(){
  $currencies = variable_get('cc_currencies', array());
  $default_currency= $currencies[0];
  $form['#prefix'] = t("If there is more than one currency on the system, this currency, known as currency-0 will never be seen or used.");
  $form['unit_type'] = array(
    '#type' => 'radios',
    '#title' => t('Currency subdivision'),
    '#default_value' => $default_currency->unit_type,
    '#options' => array(
      'integer' => t('integer'),
      'quarters' => t('quarters (of an hour)'),
      'decimal' => t('hundredths (two decimal places)'),
    ),
    '#description' => t('Many LETS currencies are not divisible, while hours might be divisible into quarters.'),
  );
  $form['max_balance'] = array(
    '#type' => 'textfield',
    '#title' => t('Maximum Balance'),
    '#default_value' => $default_currency->max_balance,
    '#size' => 4,
    '#maxlength' => 6,
    '#description' => t("Transactions will be declined by the system if the balance of the seller would go above this number. Up to six digits. Leave blank for no limit(not reccomended). (This feature works independently of the maximum balance for each additional currency defined by the currencies module.)")
  );
  $form['min_balance'] = array(
    '#type' => 'textfield',
    '#title' => t('Minimum Balance'),
    '#default_value' => $default_currency->min_balance,
    '#size' => 4,
    '#maxlength' => 6,
    '#description' => t("Transactions will be declined by the system if the balance of the payer would go below this number. Up to seven digits, including minus sign. Leave blank for no limit (not reccomended). (This feature works independently of the minimum balance for each additional currency defined by the currencies module.)")
  );
  $form['cc_description_min_words'] = array(
    '#type' => 'textfield',
    '#title' => t('Minimum number of words to describe a transaction'),
    '#default_value' => variable_get('cc_description_min_words', 4),
    '#size' => 2,
    '#maxlength' => 3,
    '#description' => t("Your community will be richer if users take a few seconds more to describe the transaction in more detail. It will also make the transaction easier to categorise, and easier for the participants to remember. Suggested value is 4.")
);
  $form['cc_exempt'] = array(
    '#type' => 'textfield',
    '#title' => t('These accounts are not subject to balance limits '),
    '#default_value' => implode(',',variable_get('cc_exempt', array(1))),
    '#size' => 6,
    '#maxlength' => 100,
    '#description' => t("A list of account numbers separated by commas")
);
  $form['cc_default_currency']['cid'] = array(
    '#type' => 'hidden',
    '#value'=>0
  );
  $form['#redirect'] = 'admin/settings';
  return system_settings_form($form);
}

function default_currency_config_validate($form, &$form_state) {
  $form_state['values']['cc_currencies'][0] = (object)array();
  
  if ($form_state['values']['max_balance'] < 0 || $form_state['values']['max_balance'] < $form_state['values']['min_balance']){
    form_set_error('max_balance', t('Maximum balance must be an integer larger than zero and minimum balance'));
  }
  $form_state['values']['cc_currencies'][0]->max_balance = $form_state['values']['max_balance'];
  unset($form_state['values']['max_balance']);

  if ($form_state['values']['min_balance'] > 0 ) {
    form_set_error('min_balance', t('Minimum balance must not be larger than 0'));
  }
  $form_state['values']['cc_currencies'][0]->min_balance = $form_state['values']['min_balance'];
  unset($form_state['values']['min_balance']);

  $form_state['values']['cc_currencies'][0]->unit_type = $form_state['values']['unit_type'];
  unset($form_state['values']['unit_type']);
  $form_state['values']['cc_currencies'][0]->cid = 0;


  if (intval($form_state['values']['cc_description_min_words']) < 1) {
    form_set_error('description_min_words', t('Minimum number of words must be a positive integer'));
  }
  $form_state['values']['cc_exempt'] = explode (',',$form_state['values']['cc_exempt']);
  foreach ($form_state['values']['cc_exempt'] as $exempt) {
    if (!is_numeric($exempt)) {
      form_set_error('exempt', 'Exempt accounts must be a list of comma separated numbers');
    }
  }
  
  //change the the db quantity field between integer and floating point
  $currencies = variable_get('cc_currencies', array());
  //TODO instead of checking against the currencies variable need to check against the db schema
  if ($form_state['values']['cc_currencies'][0]->unit_type == 'integer' && $currencies[0]->unit_type != 'integer') {
  	db_change_field($ret, 'cc_transactions', 'quantity', 'quantity', array(
  	  'description' =>'number of units transacted (integer)',
  	  'type'=>'int',
  	  'not null' => TRUE,
  	  )
  	);
  	db_change_field($ret, 'cc_balance_cache', 'balance', 'balance', array(
  	  'description' =>'sum of all completed transactions for this user in this currency (integer)',
  	  'type'=>'int',
  	  'not null' => TRUE,
  	  )
  	);
  	db_change_field($ret, 'cc_balance_cache', 'pending', 'pending', array(
  	  'description' =>'the sum of all incomplete transactions for this user in this currency (integer)',
  	  'type'=>'int',
  	  'not null' => TRUE,
  	  ));
  	db_change_field($ret, 'cc_balance_cache', 'turnover', 'turnover', array(
  	  'description' => "the sum of all this user's income in this currency (integer)",
  	  'type'=>'int',
  	  'not null' => TRUE,
  	  )
  	);
  } elseif ($form_state['values']['cc_currencies'][0]->unit_type != 'integer' && $currencies[0]->unit_type == 'integer') {
  	db_change_field($ret, 'cc_transactions', 'quantity', 'quantity', array(
  	  'description' =>'number of units transacted (float)',
  	  'type'=>'real',
  	  'not null' => TRUE,
  	  )
    );
    db_change_field($ret, 'cc_balance_cache', 'balance', 'balance', array(
  	  'description' =>'sum of all completed transactions for this user in this currency (float)',
  	  'type'=>'real',
  	  'not null' => TRUE,
  	  ));
  	db_change_field($ret, 'cc_balance_cache', 'pending', 'pending', array(
  	  'description' =>'the sum of all incomplete transactions for this user in this currency (float)',
  	  'type'=>'real',
  	  'not null' => TRUE,
  	  ));
  	db_change_field($ret, 'cc_balance_cache', 'turnover', 'turnover', array(
  	  'description' => "the sum of all this user's income in this currency (float)",
  	  'type'=>'real',
  	  'not null' => TRUE,
  	  )
  	);
  }
}


function transaction_quality_config(){
  $already=variable_get('cc_transaction_qualities', array());
  $form['cc_transaction_qualities'] = array(
    '#type' => 'textarea',
    '#default_value' => implode("\n", $already),
    '#title' => 'Possible ratings',
    '#description' => t('Traders can earn a reputation when their customers rate them highly. Use this field to list the words used to describe the quality of transactions, from worst to best, one on each line. Example:<br />Bad<br />As expected<br />Great<br />Note that changing the number of rating options after transactions have been entered will distort the averages. I wonder if there is a drupal ratings module which could do this more effectively? Probably not because only buyers can rate. This feature therefore needs a lot more work to make it attractive and interesting.')
  );
  $form['#redirect'] = 'admin/settings/marketplace';
  return system_settings_form($form);
}

function transaction_quality_config_validate($form, &$form_state) {
  $qualities = array();
  if (strlen(trim($form_state['values']['cc_transaction_qualities']))) {
    $qualities = explode("\n", $form_state['values']['cc_transaction_qualities']);
    if (count($qualities) == 1) {
      form_set_error('cc_transaction_qualities', t('You must have more than one rating, or leave the field blank to disable the rating system'));
    }
    //trim each value
    foreach ($qualities as $index=>$rating) {
      $qualities[$index] = trim($rating);
    }
  }
  $form_state['values']['cc_transaction_qualities']=$qualities;
}

function transaction_types_config(){ 
  $form['#prefix'] = t('Please put here the names of each payment_type (provided by modules). Leave blank to ignore the payment type. A confirmed transaction is one which must be approved by both parties, a direct transaction goes through when created by either party.');
  $grouped_transaction_types = module_invoke_all('transaction_types');
  $names = variable_get ('cc_transaction_types', array());
  foreach($grouped_transaction_types as $module => $transaction_types){
  	$form[$module] = array(
  	  '#type' => 'fieldset',
  	  '#title' => t('Transaction types from module: %module', array('%module' => $module)),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
  	);
    foreach ($transaction_types as $key=>$description) {
      $form[$module][$module.'__'.$key] = array(
  	    '#type' => 'textfield',
    	  '#title' => $description,
        '#size' => 15,
  	    '#default_value' => $names[$module][$key],
        '#weight' => $weight++,
  	  );
    }
  }
return system_settings_form($form);
}

function transaction_types_config_validate($form, &$form_state){
  $values = $form_state['values'];
  //all the values need to be be in a nested array, so we need to to do a bit of jiggery pokery
  foreach(array('submit', 'reset', 'form_id', 'op', 'form_token', 'form_build_id') as $key){
    unset($values[$key]);
  }
  foreach($values as $key => $value){
    //the module names was preserved as a prefix in the field name
    $parts = explode('__', $key);
    $nestedvalues[$parts[0]][$parts[1]] = $value;
  }
  $form_state['values']['cc_transaction_types'] = $nestedvalues;
}

//checks a transaction to see if it will put either of the users outside the currency limits.
function out_of_limits($transaction) {
  if ($transaction->starter_uid == $transaction->payee_uid) {
    $from_user = $transaction->completer_obj;
    $to_user = $transaction->starter_obj;
  } else {
    $from_user = $transaction->starter_obj;
    $to_user = $transaction->completer_obj;
  }
  // get all the balances of participants
  $cid = $transaction ->cid;
  $balances = get_balances(array ($transaction->payer_uid, $transaction->payee_uid), array($cid));
  if ($balances[$from_user->uid][$cid]['balance'] - $transaction->quantity < $transaction->currency->min_balance) {
    return t('Transaction has been rejected as it would take !username below the minimum balance of !quantity', 
      array('!username' => friendly_name($from_user),
        '!quantity' => theme('money', $transaction->currency->min_balance, $transaction->currency)
      )
    );
  } elseif ($balances[$to_user->uid][$cid]['balance'] + $transaction->quantity > $transaction->currency->max_balance) {
    return t('Transaction has been rejected as it would take !username above the maximum balance of !quantity', 
      array('!username' => friendly_name($to_user),
        '!quantity' => theme('money', $transaction->currency->max_balance, $transaction->currency)
      )
    );
  }
}

//for each user id passed, go through all their transactions and calculate balance, turnover and pending amounts in their profile
function recalculate_balances($ids=array(), $cid=0){
  if (!count($ids)){
    drupal_set_message('recalculate_balance not given a user to recaluclate the balance for...');
    return;
  }
  foreach ($ids as $uid){
    $turnover=0;
    $outgoings=0;
    $pending=0;
    $transactions=NULL;
    $transactions = _get_transactions_for_user($uid, array($cid), array(1,0));
    if (count($transactions)){
     foreach($transactions as $t) {
        if ($t->status){ //completed transactions
          if ($t->payer_uid == $uid){
            $outgoings += $t->quantity;
          } else {
            $turnover += $t->quantity;
          }
        } else { //unpublished transactions are pending
          if ($t->payer_uid == $uid){
            $pending -= $t->quantity;
          } else {
            $pending += $t->quantity;
          }
        }
      }
    }
    $balance = $turnover-$outgoings;

    //turnover must not be affected by the carried forward
    if ($transactions[0]->title == t("Carried forward") && $transactions[0]->payer_uid ==0) {
      $turnover -= $transactions[0]->quantity;
    }
    //write balances. This is two queries because it's more likely to work accross different databases than doing 'ON DUPLICATE KEY INSERT'
    db_query("DELETE FROM {cc_balance_cache} WHERE uid = '%d' AND cid = '%d'", $uid, $cid);
    db_query("INSERT INTO {cc_balance_cache} (uid, cid, balance, pending, turnover) VALUES (%d, %d, %d, %d, %d)",
      $uid, $cid, $balance, $pending, $turnover);
  }
}

//FUNCTIONS WHICH RETURN A LUMP OF CONTENT

//this function would be a view except views can't yet do "WHERE field1 = $x OR field2 = $x"
function show_statement($uid = NULL, $rows=20, $statuses = array(0,1)) {
  global $user;
  if (!$uid){
    $uid = $user->uid;
  }
  $currencies = variable_get('cc_currencies', NULL);
  $transactions = _get_transactions_for_user($uid, array_keys($currencies), $statuses, TRUE);

  if (count($transactions)) {
    foreach($transactions as $key => $transaction) {
      //add edit and complete links to each transaction if the user has permission
      if (!$transaction->status) {
        if ($uid==$user->uid && $uid == $transaction->starter_obj->uid) {
          $transactions[$key]->actions['edit'] = l(t('Edit'), 'node/' . $transaction->nid .'/edit');
        } elseif ($uid==$user->uid && $uid == $transaction->completer_obj->uid) {
          $transactions[$key]->actions['complete'] = drupal_get_form('complete_transaction_form', $transaction);
        }
      } elseif (user_access('edit all transactions')) {
        $transactions[$key]->actions['edit'] = l(t('Edit'), 'node/' . $transaction->nid .'/edit');
      }
      //add a field to identify the user who isn't me
      if ($transaction->starter_obj->uid == $uid) {
        $transactions[$key]->notme = $transaction->completer_obj->uid;
      } else {
        $transactions[$key]->notme = $transaction->starter_obj->uid;   
      }
      //change the sign on the money to negative
      if ($transaction->payer_uid == $uid){
        $transactions[$key]->quantity = - $transaction->quantity;
      }
    }
  }
  return theme('statement_table', $transactions, $uid);
}

//$data is a mysql result containing with each row showing a transaction
function theme_statement_table($transactions, $uid) {
  if (!count($transactions)) return "\n<p>".t('This user has no completed transactions')."</p>\n";
  global $user;
  if ($user -> uid == $uid) { //this code is used elsewhere and could be put into a function
    drupal_set_title(t('My Statement'));
  } else {
    $that_user = user_load(array('uid'=>$uid));
    drupal_set_title(t("@username's Statement", array('@username' => $that_user-> name)));
  }
  if (!count($transactions)) {
    return t("There are no transactions to display");
  }
  //need to delare the column headings, their order, and associated fields
  //array keys must correspond to the keys in the transaction objects
  $columns = array(
    'created' => t('Date'), 
    'category' => t('Category'),
    'title' => t('Description'), 
    'notme' => t('With Whom?'),
    'quantity' => t('Amount'),
    'quality' => t('Rating'),
    'income' => t('Income'),
    'receipt' => t('Receipts'),
    'balance' => t('Running Total'),
    'status' => t('Completed?'),
    'actions' => t(''),
  );
  //put the given array into the columns declared to make a table
  foreach($transactions as $key => $transaction) {
    foreach ($columns as $field => $title){
      $rows[$key][$field] = $transaction->$field;
    }
  }
  //Put transactions into a multidimensional array, reformating many of the fields
  $currencies = variable_get('cc_currencies', NULL);
  foreach($transactions as $key=>$transaction) {
    $rows[$key]['notme'] = friendly_name(user_load($transaction->notme), 'profile');
    $rows[$key]['created'] = date('d/m/y', $transaction->created);
    $rows[$key]['quantity'] = theme('money', $transaction->quantity, $currencies[$transaction->cid]);
    $rows[$key]['balance'] = theme('money', $transaction->balance, $currencies[$transaction->cid]);
    if ($transaction->quantity > 0) {
      $rows[$key]['income'] = theme('money', $transaction->quantity, $currencies[$transaction->cid]);
    } else {
      $rows[$key]['receipt'] = theme('money', abs($transaction->quantity), $currencies[$transaction->cid]);
    }
    if (count($rows[$key]['actions'])) {
      $columns['actions']='';
      $rows[$key]['actions'] = implode($transactions[$key]->actions);
    }
    if ($rows[$key]['status'] == 1) {
      $rows[$key]['status'] = '<div style="font-size:2.5em;color:green">&#x2713;</div>';//tick
    } elseif ($row[$key]['actions'][complete]) {
      $rows[$key]['status'] = '-&gt;';
    } else {
      $rows[$key]['status'] = '<div style="color:orange">to confirm</div>';//hourglass
    } //there may also be a contested status one day, or others
  }
  $footer = '<p>Start a <a href="'.url('transaction/add').'">new transaction...</a></p>';
  return theme('table', $columns, $rows) . "\n" . $footer;
}


//returns rendered views for purchases and sales for a given user
function show_purchases_sales($uid = NULL, $rows=10) {
  if (!$uid){
    global $user;
    $uid = $user->uid;
  }
  $purchases_html=  _get_view_transactions_by_user(array('field' => 'payer_uid', 'uid' => $uid));
  $sales_html= _get_view_transactions_by_user(array('field' => 'payee_uid', 'uid' => $uid));

  return "<h3>".t("Purchases")."</h3>
  $purchases_html
  <h3>".t("Sales")."</h3>
  $sales_html";
}

function _get_view_transactions_by_user($where) {
  $view = views_get_view('transactions_by_user');
  //need to remove the field which is also the argument, i.e. payer_uid or payee_uid
  foreach ($view->display['default']->display_options['fields'] as $i => $field) {
    if ($field['relationship'] == $where['field']) {
      unset ($view->display['default']->display_options['fields'][$i]);
      break;
    }
  }
  //Change the column heading of 'amount' to be Income or Expenditure
  //and render the view with the right parameter
  if ($where['field'] == 'payer_uid') {
    $view->display['default']->display_options['fields']['quantity']['label'] = t('Expenditure');
    return $view->execute_display('default', array($where['uid']));
  } elseif ($where['field'] == 'payee_uid') {
    $view->display['default']->display_options['fields']['quantity']['label']=t('Income');
    return $view->execute_display('default', array('all', $where['uid']));
  } else{
    drupal_set_message('wrong parameter sent to _get_view_transactions_by_user');
  }
}

/*
 * takes a uid and returns all the transactions which they need to complete, themed.
 * Or just returns the count
 * Would be nice if this could be done with views, but it requires two queries
 */
function pending_transactions($uid, $theme_func = '') {
  //get incomplete transactions in which the user is involved.
  $result = db_query("SELECT n.nid 
    FROM {cc_transactions} t LEFT JOIN node n on n.nid = t.nid 
    WHERE n.status = 0 AND ( t.payee_uid = %d OR t.payer_uid = %d)", 
    $uid, $uid);
  $transactions = array();
  while ($trans = db_fetch_array($result)) {
    $transactions[] = node_load(array('nid' => $trans['nid']));
  }
  if ($theme_func){
    return theme($theme_func, $transactions, $uid);
  }else{
  	return $transactions;
  }
}

function theme_pending_transactions($transactions, $uid) {
  if (!count($transactions)){
    return '<p>' . t("There are no pending transactions") . '</p>';
  }
  global $user;
  $incompletes  = array('incoming_action'=>array(), 'outgoing_action'=>array(), 'incoming_wait'=>array(), 'outgoing_wait'=>array());
  foreach ($transactions as $transaction) {
    if ($transaction->payee_uid == $transaction->completer_uid &&  $transaction->completer_uid == $uid) {
      $incompletes['incoming_action'][] = $transaction;
    } elseif ($transaction->payer_uid == $transaction->completer_uid &&  $transaction->completer_uid == $uid) {
      $incompletes['outgoing_action'][] = $transaction;
    } elseif  ($transaction->payer_uid == $transaction->starter_uid && $transaction->starter_uid== $uid) {
      $incompletes['outgoing_wait'][] = $transaction;
    } elseif  ($transaction->payee_uid == $transaction->payee_uid && $transaction->starter_uid == $uid) {
      $incompletes['incoming_wait'][] = $transaction;
    }
  }
  foreach (array_merge($incompletes['incoming_action'], $incompletes['outgoing_action']) as $transaction) { 
    $buttons = array();
    if ($transaction->completer_uid == $user->uid  || user_access('edit all transactions')) {
      $buttons[] = drupal_get_form('complete_transaction_form', $transaction);
    }
    if ($transaction->starter_uid == $user->uid || user_access('edit all transactions')) {
      //$buttons[] = drupal_get_form('transaction_confirm_delete', $transaction);
    }
    if (!count($buttons)) {
      $buttons[] =  t('This transaction is yet to be confirmed by !other_person', 
        array('!other_person'=>friendly_name($transaction->completer_obj, 'contact')));
    }      
    $for_this_user_html.= theme('verbal_transaction_summary', $transaction, $buttons);
  }
  //prefix these with a title
  if (strlen($for_this_user_html)) {
    $heading = t('Transactions for !who to complete', 
      array('!who' => friendly_name($transaction->completer_obj))
      );
    $summary = '<h4>'.$heading."</h4>\n".$for_this_user_html;
  }

  foreach (array_merge($incompletes['incoming_wait'], $incompletes['outgoing_wait']) as $transaction) {
    $buttons = array();
    if ($user->uid == arg(1) || user_access('edit all transactions')) {
      //this needs testing because it didn't work on the Sel du lac site
      //$buttons[]= drupal_get_form('modify_transaction_form', $transaction);
    }
    //this now needs an edit button, leading to the node edit form
    $from_this_user_html .= theme('verbal_transaction_summary', $transaction, $buttons);
  }
  //prefix these with a title
  if (strlen($from_this_user_html)) {
    $heading = t('Transactions !who started',
      array('!who'=>friendly_name($transaction->starter_obj))
      );
    $summary .= '<h4>'.$heading."</h4>\n".$from_this_user_html;
  }
  return $summary;
}

//this is used in a block
function theme_pending_short($transactions = array(), $uid) {
  if (!count($transactions)) {
  	return t('There are no transactions to complete');
  }
  //sort out only the transactions waiting for the for the user
  foreach ($transactions as $key=>$transaction) {
  	if ($transaction->completer_uid != $uid) {
  	  unset ($transactions[$key]);
  	}
  }
  if (!count($transactions)){
  	return t('There are no transactions to complete');
  }
  foreach ($transactions as $transaction) {
    if ($transaction -> payee_uid == $uid) {
	  $html .= t('!name is paying you !amount', array(
	    '!name' => friendly_name($transaction->starter_obj), 
		'!amount' => theme('money', $transaction->quantity)
	  ));
	}
  }
  return $html;
}

//this function expects the full transaction object
function theme_verbal_transaction_summary($transaction, $buttons=array()) {
  if ($transaction->payer_uid == $transaction->starter_uid) {
    $payer = $transaction->starter_obj;
    $payee = $transaction->completer_obj;
  } elseif ($transaction->payer_uid == $transaction->completer_uid) {
    $payer = $transaction->completer_obj;
    $payee = $transaction->starter_obj;
  }
  if (!$transaction->created) { //put the current date if the transaction is not in the db yet
   $transaction->created = time(); 
  }
  if ($transaction->status) {
    $description= t('On @date, !payer gave !payee !amount for \'@transaction\'', array(
	  '@date' => date('d-m-y', $transaction->created),
      '!payer' => friendly_name($payer, 'contact'),
      '!payee'=> friendly_name($payee, 'contact'),
      '!amount'=> theme('money', $transaction->quantity, $transaction->currency),
      '@transaction'=>$transaction->title,
    ));
  } else {
  	$description= t('!payer will pay !payee !amount for \'@transaction\'', array(
  	  '!payer' => friendly_name($payer, 'contact'),
      '!payee'=> friendly_name($payee, 'contact'),
      '!amount'=> theme('money', $transaction->quantity, $transaction->currency),
      '@transaction'=>$transaction->title,
    ));
  }
  if ($transaction->quality) {
    $quality.=t("The sale was graded '@quality'.", array('@quality'=>$transaction->quality));
  }
  if (count($buttons)) {
    $actions = implode("\n\t", $buttons);
  }
  return "\n<div class=\"summarytransaction\"> $description $quality ".$actions." $contact_link</div>" ;
}

function show_user_balances($uid=NULL, $columns = TRUE) {
  require_once(drupal_get_path('module', 'transactions').'/transactions.stats.inc');
  if (!$uid){
    global $user;
    $uid = $user->uid;
  }
  //foreach currency the user is using, show the balances
  $balances = get_balances(array($uid));
  $cids = array_keys($balances[$uid]);
  return theme('user_balances', $balances[$uid], $columns);
}

function theme_user_balances ($balances=array(), $columns = TRUE) {
  if (!$balances){ //if the user hasn't transacted yet
    $balances = array('0'=>array('balance'=>0, 'pending'=>0, 'turnover'=>0));
  }
  $headings = array(t('Balance'), t('Pending'), t('Turnover'));
  $currencies = variable_get('cc_currencies', NULL);
  if ($columns)  {
  	$html .= "\n<table class = \"profile-balances\">\n";
  	foreach ($balances as $cid=>$bals) {
  	  $html .='<thead><tr><td></td>';
  	  foreach ($currencies as $currency){
  	    $html .= '<th>'.$currency-> name.'</th>';
  	  }
  	  $html .='</tr></thead>';
  	}
  	$html .= "\n<tbody><tr><th>".t('Balance').'</th>';
  	foreach ($balances as $cid=>$bals) {
  	  $html .= "\n\t\t<td>".theme('money', $bals['balance'], $currencies[$cid]).'</td>';
  	}
  	$html .='</tr>';
  	if (pending_enabled()){
  	  $html .= "\n\t<tr><th>".t('Pending').'</th>';
  	  foreach ($balances as $cid=>$bals) {
  	    $html .= "\n\t\t<td>".theme('money', $bals['pending'], $currencies[$cid]).'</td>';
  	  }
  	  $html .='</tr>';
  	}
  	$html .= "\n\t<tr><th>".t('Turnover').'</th>';
  	foreach ($balances as $cid=>$bals) {
  	  $html .= "\n\t\t<td>".theme('money', $bals['turnover'], $currencies[$cid]).'</td>';
  	}
    $html .='</tr></tbody></table>';
    return $html;
  } else { // to make a table going the the other way
    foreach ($balances as $cid => $bals) {
      foreach ($bals as $type => $bal) {
        $balances[$cid][$type] = theme('money', $bal, $cid);
      }
    }
  	return theme('table', array(), $balances);
  }
}


function theme_money($quantity, $currency=NULL) {
  $numbers = split_float($quantity, $currency->unit_type);
  //now we have an array(sign=>'-','integer'=>NUM, 'fraction'=>PADDED NUM);
  //this copes with an optional negative sign, putting it outside the span tag, so it appears before any preceding styled symbol
  $str= $numbers['sign'].'<span class="currency-'.$currency->cid.'">'.$numbers['integer'];
  if ($numbers['decimal']) $str .= ':'.$numbers['decimal'];
  $str .= '</span>';
  return $str;
}

//DOESN'T SEEM TO BE WORKING.
//This function is named after phptemplate because it doesn't work when called as a theme_ function.
function phptemplate_views_view_field__default__quantity($view, $field, $row) {
  $currencies = variable_get('cc_currencies', NULL);
  return theme('money', $row->cc_transactions_quantity, $currencies[intval($row->cc_transactions_cid)]);
}

//gets the cached balances from their own db table and returns an array 
function get_balances ($uids = array(), $cids=array(0)) {
  global $user;
  static $balances;
  if (!count($uids)) $uids = array($user->uid);

  //make a query asking for the details of each required user for each required currency
  foreach ($uids as $key => $uid) {
    if (!$balances[$key]){
      $need_uids[$key]= 'uid = '.$uid;
      $balances[$uid]=array();
    }
  }
  if (count($need_uids)){
    $whereuid = implode (" OR ", $need_uids);
    $query = "SELECT uid, cid, balance, pending, turnover FROM {cc_balance_cache} WHERE ". $whereuid;
    $result = db_query($query);
    while ($row = db_fetch_array($result)) {
      $balances[$row['uid']][$row['cid']]= array(
        'balance'=>$row['balance'], 
        'pending'=>$row['pending'], 
        'turnover'=>$row['turnover']
      );
    }
  }
  return $balances;
}

function cc_balances_refresh(){
  //get a list of all the users 
  $result = db_query('SELECT uid FROM {users}');
  while ($account = db_fetch_array($result)) {
    $members[] = $account['uid'];
  }
  recalculate_balances($members, 0);
}


//-----------------------------------
//TRANSACTION FORM HANDLING

//builds a generic transaction form, for use in creating or editing. Takes a transaction node if editing.
function transaction_base_form($transaction=NULL, $visible = FALSE) {
  global $user;
  $form=array();
  $allowed_transactions = _active_transaction_types();
  switch(count($allowed_transactions)){
    case 1: 
      $form['transaction_type']=array(
        //use the only transaction type available and hide the field
       '#type' => 'hidden',
       '#value' => array_pop(array_keys($allowed_transactions))
      );
      break;  
    default: 
      $form['transaction_type']=array(
        '#type' => 'select',
        '#title' => t('Transaction type'),
        '#default_value' => $transaction->transaction_type,
        '#weight'=> -5,
        '#options'=> $allowed_transactions
      );
  }
  $form['title']= array(
    '#type'=>'textfield',
    '#title'=> t('What is being paid for?'),
    '#size' => 20,
    '#required' => TRUE, 
    '#default_value' => $transaction->title,
    '#weight'=> -3,
    '#description' => t('Minimum @int words', array('@int' => variable_get('cc_description_min_words', 3))),
  );
  $accounts = get_all_trading_accounts();
  //if we are editing, then we show the to and from fields, if creating anew, we use the me and other fields
  if ($transaction){ //to and from fields
    $form['payee_uid']=array(
      '#type'=>'select',
      '#title'=> t('Who is being paid?'),
      '#default_value' => $transaction->payee_uid,
      '#weight'=> -4,
      '#options'=>$accounts,
      '#required' => TRUE
    );
    //special users can pretend the transaction was started by someone else
    if (user_access('edit all transactions')) {
      $form['payer_uid'] = array(
        '#type' => 'select',
        '#title' => t('Who is paying?'),
        '#default_value' => $transaction->payer_uid,
        '#weight' => -5,
        '#required' => TRUE,
        '#options' => $accounts
      );
    } else { //most users don't get the choice
      $form['payer_uid']=array(
        '#type' => 'hidden',
        '#value' => $transaction->payer_uid,
      );
    }
  }
  if (user_access('edit all transactions') && !$transaction) {  //me and other fields
    //special users can pretend the transaction was started by someone else
    $form['starter_uid']=array(
      '#type' => 'select',
      '#title' => t('Initiator, if not you'),
      '#default_value' => $user->uid,
      '#weight' => -5,
      '#required' => TRUE,
      '#options' => $accounts
    );
  } elseif ($transaction) {
    //most users don't get the choice
    $form['starter_uid']=array(
      '#type' => 'hidden',
      '#value' => $transaction->starter_uid,
    ); 
  } else {
    $form['starter_uid']=array( //first time around
      '#type' => 'hidden',
      '#value' => $user->uid,
    );
  }
  //if we are on a user page, we presume the completer is that user
  if (!($default_completer = $transaction->completer_uid) && arg(0)=='user'){
    $default_completer = arg(1);
  }
  if ((user_access('edit all transactions') || arg(0) != 'user') && !$transaction) {
    if (!user_access('edit all transactions')) {
      //if there's no permission, remove the user's own uid so they can't trade with themselves
      $user_uid = $user->uid; //it seems that you can't reference objects inside square backets
      unset($accounts[$user_uid]);
    }
    $form['completer_uid']=array(
      '#type'=>'select',
      '#title'=> t('With whom did you transact?'),
      '#default_value' => $default_completer,
      '#weight'=> -3,
      '#options'=>$accounts,
      '#required' => TRUE
    );
  } else {
    $form['completer_uid'] =array (
      '#type' => 'hidden',
      '#default_value' => $default_completer
    );
  }
  
  $currencies = variable_get('cc_currencies', NULL);
  $division = $transaction->quantity - intval($transaction->quantity);
  $form['quantity']=array(
    '#type'=>'textfield',
    '#title'=> t('Quantity'),
    '#weight'=> -1,
    '#default_value' => intval($transaction->quantity),
  	'#maxlength'=> 4,
    '#required' => TRUE,
  );
  
  switch($currencies[0]->unit_type) {
	  case 'quarters': 
	    $form['division'] = array (
	      '#type' => 'select',
	      '#title' => t('Quarters'),
	      '#weight' => -0,
	      '#default_value' => $division,
		    '#options' => array('0' => '00 hours', '0.25' => '15 minutes', '0.5' => '30 minutes', '0.75' => '45 minutes'),
  	  ); 
      break;
    case 'decimal':
      $form['division'] = array (
        '#type' => 'textfield',
        '#title' => t('Centiles'),
        '#maxlength'=> 2,
        '#weight' => 0,
        '#default_value' => $division,
	    );
  }
  
  if (count($currencies)>1) { 
    $currency_options = array(0=>'default'); //this variable yet to be defined
    $form['cid'] = array (
      '#type' => 'select',
      '#title' => t('Currency'),
      '#options' => $currency_options
    );
  } else { //if there is one currency
    $form['cid'] = array(
      '#type' => 'hidden',
      '#value' => 0,
    );
  }
  //the payer has to grade the transaction
  if (count($options=variable_get('cc_transaction_qualities', array()))) {
    $form['quality']=array( 
      '#type'=>'value',
      '#title'=> t('Rate the quality of what was paid for'),
      '#required' => TRUE, 
      '#weight'=> 3,
      '#default_value' => 2,
      '#options'=> $options,
    );
  }
  $form['status']=array(
    '#type' => 'checkbox',
    '#title'=> t('Transaction is completed (not awaiting confirmation).'),
    '#default_value' => $transaction->status,
    '#weight' => 9
  );
  if (!$visible){
    foreach ($form as $key=>$element) {
      if ($element['#type'] != 'value') {
        $form[$key]['#type'] = 'hidden';
      }
    }
    $form['quantity']['#type'] = 'value';
  }
  return $form;
}

function complete_transaction_form($form_state, $transaction) {
  //get the filled in form, hide it's values, add a button
  $form=transaction_base_form($transaction, FALSE);
  $form['submit']=array (
    '#type'=>'submit',
    '#value'=> t('Confirm'),
    '#attributes' => array('class' => 'complete_button')
  );
   $form ['#action'] = url('node/'.$transaction->nid.'/edit');
  return $form;
}

//HELPER FUNCTIONS
/*
 * Returns an array of transaction_types belonging to this module which have been named
 */
function _active_transaction_types() {
  $valid_types = array();
  $all_types = variable_get('cc_transaction_types', array());
  $type_names=$all_types['transactions'];
  if (!count($type_names)) drupal_set_message('no default transactions types set up. Please go to admin/settings/marketplace/transaction_types');
  //remove the types without names
  foreach ($type_names as $machine_name => $name) {
  	if (!strlen($name)) {
  	  unset ($type_names[$machine_name]);
  	}
  }
  return $type_names;
}

//gets all the transactions and calculates the running balance, returning a full transaction node if required
//can filter according to node.status, currencies
function _get_transactions_for_user($uid, $cids=array(0), $statuses=array(1,0), $full = 0) {
  foreach ($statuses as $status) {
    $stati[] = ' n.status = ' . $status;
  }
  foreach ($cids as $cid) {
    $currencyIDs[] = ' t.cid = ' . intval($cid);
  }
  $transactions = array();

  $results = db_query("
    SELECT DISTINCT n.title, n.nid, t.payer_uid, t.payee_uid, t.starter_uid, t.completer_uid, t.cid, t.quantity, t.quality, n.status, td.name as category, td.tid, td.vid, n.created
      FROM {node} n
      LEFT JOIN {cc_transactions} t ON t.nid = n.nid
      LEFT JOIN {term_node} tn ON n.vid = tn.vid
      LEFT JOIN {term_data} td ON tn.tid = td.tid
      WHERE (payee_uid = '%d' OR payer_uid = '%d')
      AND n.type = 'transaction'
      AND ( %s )
      AND ( %s )
      ORDER BY n.created ASC
    ",
    array($uid, $uid, implode(' OR ', $stati), implode(' OR ', $currencyIDs))
  );
  $running_balance = array();
  while ($transaction = db_fetch_object($results)) {
    $nid = $transaction->nid;
    if (isset($transactions[$nid])) continue;
    if ($full) {
      $transactions[$nid] = transaction_load_objects($transaction);
    } else {
      $transactions[$nid] = $transaction; 
    }
    //calculate the running balance
    //need to make sure the transactions have unique keys because this query was based on views which returns one version of each node for each tag
    if ($transaction->payer_uid == $uid) {
      $running_balance[$transaction->cid] -= $transaction->quantity;
    } else {
      $running_balance[$transaction->cid] += $transaction->quantity;
    }
    $transactions[$nid]->balance = $running_balance[$cid];
  }
  return $transactions;
}


//This function converts the array from the pre-transaction form, 
//or the node/add/transaction error form, into something like a node,
//so we can use it as such even though it didn't come from the database.
//Function requires starter_uid and completer_uid to be present in the array.
//Otherwise see node_load()
//TODO this should be combined into one function which handles all eventualities and loads all the objects, taking an array or object and completing all the missing fields.
function infer_transaction_from_array($array) {
  $transaction = (object)array();
  if (substr($array['transaction_type'], 0, 9) == 'incoming_') {
    //this is for flows towards the starter user
    $transaction->payer_uid  = $array['completer_uid'];
    $transaction->payee_uid = $array['starter_uid'];
  } elseif (substr($array['transaction_type'], 0, 9) == 'outgoing_') {
    //flows away from the starter user
    $transaction->payer_uid = $array['starter_uid'];
    $transaction->payee_uid = $array['completer_uid'];
  } else {
    //if it came from the error form or edit node form, in which case we don't have a transaction type, we have just payer_uid and payee_uid instead
    $transaction->payer_uid = $array['payer_uid'];
    $transaction->payee_uid = $array['payee_uid'];
  }
  $transaction->transaction_type = $array['transaction_type'];
  $transaction->starter_uid = $array['starter_uid'];
  $transaction->completer_uid = $array['completer_uid'];
  $transaction->nid = $array['nid'];
  $transaction->title = $array['title'];
  $transaction->quantity = $array['quantity'];
  $transaction->cid = intval($array['cid']);
  $transaction->quality = $array['quality'];
  $transaction->status = $array['status'];
  if (substr($array['transaction_type'], -7) == '_direct') {
    $transaction->status=TRUE;
  }
  
  //convert division into a decimal fraction
  $currencies = variable_get('cc_currencies', array());
  if ($array['division'] > 0) {
  	if ($currencies[0]->unit_type == 'decimal'){
  	  $array['division']=$array['division']/100.0;
  	}
    $transaction->quantity += $array['division'];
  }
  return transaction_load_objects($transaction);
}

//some elements of the transaction are objects in themselves, This process completes loading the transaction
//whether derived from a POSTed array, or from the node_load process.
function transaction_load_objects($transaction){
  if (is_numeric($transaction->starter_uid)){//used only when validating a pre_transaction
    if (substr($array['transaction_type'], 0, 9) == 'incoming_') {//this is for flows towards the starter user
      $transaction->payer_uid  = $transaction->completer_uid;
      $transaction->payee_uid = $transaction->starter_uid;
    } elseif (substr($array['transaction_type'], 0, 9) == 'outgoing_') { //flows away from the starter user
      $transaction->payer_uid = $transaction->starter_uid;
      $transaction->payee_uid = $transaction->completer_uid;
    }
  } elseif (is_numeric($transaction->payer_uid)) {
    //unfortunately not all transactions passing this point can remember their vectors
    if (substr($array['transaction_type'], 0, 9) == 'incoming_') {//this is for flows towards the starter user
      $transaction->completer_uid =$transaction->payer_uid;
      $transaction->starter_uid = $transaction->payee_uid;
    } elseif (substr($array['transaction_type'], 0, 9) == 'outgoing_') { //flows towards the completer user
      $transaction->completer_uid = $transaction->payee_uid;
      $transaction->starter_uid = $transaction->payer_uid;
    }
  }
  $transaction->completer_obj =  user_load(array('uid' => $transaction->completer_uid));
  $transaction->starter_obj = user_load(array('uid' => $transaction->starter_uid));

  $currencies = variable_get('cc_currencies', array());
  $cid = $transaction->cid;
  $transaction->currency = $currencies[$cid];
  return $transaction;
}


//OTHER FUNCTIONS WHICH OPERATE ON TRANSACTION NODES

//all transactions should be started with this form. transaction_node_form expects this in the post.
function pre_transaction_form() {
  require_once(drupal_get_path('module', 'transactions').'/transactions.inc');
  $form = transaction_base_form(NULL, TRUE);
  $form['quality']['#type']='value';
  $form['submit']= array (
    '#type' => 'submit',
    '#value' => t('submit'),
  );
  $form['status']['#type'] = 'value';
  $form['status']['#default_value'] = FALSE;
  $form['#action']=url('node/add/transaction');
  return $form;
}

function modify_transaction_form($form_state, $transaction){
  $form['nid']=array (
    '#type'=>'hidden',
    '#value'=> $transaction->nid,
  );
  $form['edit']=array (
    '#type'=>'submit',
    '#value'=> t('Edit'),
    '#access' => TRUE,
    '#attributes' => array('class' => 'complete_button'),
  );
  $form['#action'] = url('node/'. $transaction->nid . '/edit');
  return $form;
}

function transaction_confirm_delete($form_state){
  $form['nid'] = array(
    '#type' => 'hidden', 
    '#value' => $form_state['post']['nid']
  );
  $f= confirm_form($form, 
    t('Are you sure you want to delete this transaction?'),
    'user',
    'This action cannot be undone',
    'Delete',
    'Not so sure',
    'delete_trans'
  );
  return $f;
}

//This function is currently being called from it's parent page, pending_transactions. That's the only way
//I could get it to work because confirm_form is causing me problems. But it shouldn't be that way
//function transaction_confirm_delete_submit($form, $form_state){
function transaction_confirm_delete_submit($nid){
  $transaction = node_load(array('nid'=>$nid));
  //if the current user is either the completer, or has permission 
  if ($user->uid == $transaction->completer_uid || user_access('edit all transactions')) {
    node_delete($transaction->nid);
  }
  recalculate_balances(array($transaction->to_id, $transaction->payer_uid), 0);
  drupal_set_message(t("Transaction '%description' has been deleted. Balances have been recalculated", array('%description'=>$transaction->title))); 
}
 
/*
 * email notification
*/
function transactions_email_completer_action($transaction, $context = array()) {
  if ($transaction->type != 'transaction' || $transaction->status == TRUE) return;
  //load the user and continue only if the completer wants notification
  $recipient = user_load(array('uid'=>$transaction->completer_uid));
  if ($recipient->pending_notification = FALSE) return;
  drupal_mail(
    'transactions',
    'transaction_completer',
    $recipient->mail,
    user_preferred_language($recipient),
    array(
      'transaction' => $transaction, 
      'template' => $context['template'],
    )
  );
}

//generates an email message telling the user that that they have a pending transaction to complete
//params needs to be array($transaction)
function transactions_mail($key, &$message, $params){
  $transaction = transaction_load_objects($params['transaction']);
  $starter = $transaction->starter_obj;
  $recipient = $transaction->completer_obj;
  $message['subject'] = t('You have a transaction to confirm');
  $message_template = $params['template'];
  $message_template = str_replace('%completer', $recipient->name, $message_template);
  $message_template = str_replace('%starter', $starter->name, $message_template);
  $message_template = str_replace('%summary', strip_tags(theme('verbal_transaction_summary', $transaction)), $message_template);
  $message_template = str_replace('%reason', $transaction->title, $message_template);
  $message_template = str_replace('%home', url('user/'.$transaction->completer_uid, array('absolute'=>TRUE)), $message_template);
  $message_template = str_replace('%transaction', url('node/' . $transaction->nid . '/edit', array('absolute'=>TRUE)), $message_template);
  $message_template = str_replace('%statement', url('user/' . $recipient->uid . '/statement', array('absolute'=>TRUE)), $message_template);
  $message_template = str_replace('%unsubscribe', url('user/' . $recipient->uid . '/edit', array('fragment'=>'notifications', 'absolute'=>TRUE)), $message_template);
  $message['body'][] = $message_template;
}

//this takes a floating point number and returns an array, with the sign, integer and decimal, it's a theming helper
function split_float($float_num, $unit_type) {
  if (substr($float_num,0,1) == '-') {
  	$sign = '-';
  	$float_num = substr($float_num,1);
  }
  $integer = strtok($float_num, '.');
  $decimal = strtok('.');
  if ($unit_type == 'quarters') {
  	$division  = str_pad(0.6*$decimal, 2, '0');//returns minutes
  } elseif ($unit_type == 'decimal') {
  	$division = str_pad($decimal, 2, '0');//returns cents
  }
  return array('sign'=>$sign, 'integer'=>$integer, 'decimal'=>$division);
}

