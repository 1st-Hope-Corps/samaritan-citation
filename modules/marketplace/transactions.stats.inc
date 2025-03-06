<?
/*
 * Generates a query string for a google chart showing a member's balance(s)
 * Should be called from the theme layer
*/

require_once(drupal_get_path('module', 'transactions').'/transactions.inc');
 
 /*
  * Stats generator
  * returns an array of common stats which can be themed by a function of your choosing
  * $timestring is a positive number of days or months e.g. '3 months'
  * $theme_func is a string
  */
//TODO make a hook for collecting stats from other modules, e.g. requack
function stats($timestring, $theme_func='stats'){
  //this excludes transactions with the balancing account
  //will also need to exclude leakage, when we've programmed it
  $all_transactions=array();
  $result = db_query("SELECT * FROM {cc_transactions} AS t 
    LEFT JOIN {node} AS n ON t.nid = n.nid
	  WHERE n.created > '%d'
    AND t.payer_uid > 0 AND t.payee_uid > 0", strtotime('-'.$timestring));
  while ($row = db_fetch_object($result)){
    $all_transactions[] = $row;
  }
  $stats=array();
  if ($c = count($all_transactions)) {
  	$stats['transaction_count'] = $c;
    //iterate through the transactions, adding stuff up
    foreach ($all_transactions as $t){
      $stats['system_turnover'] += $t->quantity;
  	  $earned[$t->payee_uid] = $earned[$t->payee_uid] + $t->quantity;
  	  $spent[$t->payer_uid] = $spent[$t->payer_uid] + $t->quantity;
  	  $trades[$t->payee_uid] = $trades[$t->payee_uid]+1;
  	  $trades[$t->payer_uid] = $trades[$t->payer_uid]+1;
    }
    $stats['active_member_count']= count ($trades);
    rsort($earned); //need to preserve keys
    rsort($spent);  //need to preserve keys
    rsort($trades);  //need to preserve keys
    $stats['highest_incomes'] = $earned;
    $stats['highest_expenditure'] = $spent;
    $stats['trades_per_user'] = $trades;
  }
  return theme($theme_func, $stats);
}
/*
Expects data something like:
Array(
    [transaction_count] => 33 //number of transactions on system
    [system_turnover] => 1474 //total amount exchanged
    [active_member_count] => 16 //number of unique traders
    [trades_per_user] => Array  ( uid => transaction count ) sorted by num of transactions descending
    [highest_incomes] => array (uid => income)  sorted by income descending
    [highest_expenditures] => array (uid => expenditure) sorted by expenditure descending
)
//array values may have more than one.
 */

function theme_stats($stats) {
  if ($stats['transaction_count']) {
    $html = '<div class="stat">Number of transactions: ' . $stats['transaction_count'] . '</div>';
    $html .= '<div class="stat">Total volume traded: ' . $stats['system_turnover'] . '</div>';
    $html .= '<div class="stat">Transacting members: ' . $stats['active_member_count'] . '</div>';
    foreach ($stats['trades_per_user'] as $count=>$uid){
      $best_traders[] = friendly_name($uid, 'profile').' ('.$count.')';
    }
    $html .= '<div class="stat">Most trades:<ul><li>' . implode('</li><li>',$best_traders) . '</li></ul></div>';
    foreach ($stats['highest_incomes'] as $count=>$uid){
      $highest_incomes[] = friendly_name($uid, 'profile').' ('.$count.')';
    }
    $html .= '<div class="stat">Largest incomes:<ol><li>' . implode('</li><li>',$highest_incomes) . '</li></ol></div>';
    foreach ($stats['highest_expenditure'] as $count=>$uid){
      $highest_expenditure[] = friendly_name($uid, 'profile').' ('.$count.')';
    }
    $html .= '<div class="stat">Largest expenditure:<ol><li>' . implode('</li><li>',$highest_expenditure) . '</li></ol></div>';
  } else {
    $html = 'No statistics will be available until some transactions have happened';
  }
  return '<div class="stats">'.$html.'</div>';
}


function balance_history_chart($uid=NULL, $dimensions = array('width'=>250, 'height'=>200), $cids=array(0)) {
  if (!$uid){
    global $user;
    $uid = $user->uid;
  }
  //do we need to include transactions.inc? Maybe, if this is called from the theming layer
  //TODO Make a setings page for colors and size

  foreach ($cids as $cid){  //this loop draws one line for one currency
    $transactions = _get_transactions_for_user($uid, $cids, array(1));
    //we need to correct for the first transaction, if it was an import, and in so doing, we'll set the first point and get the baseline time
    $first = array_shift($transactions);
    if (substr($first->title, 0, 4) == "Gross") {
      //removed the first two transactions and returns the balance from after the import
      echo "adjusting for transaction imported with turnover\n";
      echo "Please test.. this have never been done before!";
      $second = array_shift($transactions);
      $ys[] = $first->quantity -= $second->quantity;
    } elseif ($first->title == t('Carried forward')) {
      $ys[] = $first->balance;
    } else {
      array_unshift($transactions, $first);
      $ys[] = 0;
    }
    $start_time = $first->created;
    $xs[] = $start_time;
    
    //add all the other points, one per transaction
    foreach ($transactions as $transaction){
      $xs[] = $transaction->created;
      $ys[] = $transaction->balance;
		}
    //add a point showing the balance constant from the last transaction until now
    $xs[] = time();
    $ys[] = $transaction->balance;

    $max = max($ys);
    $min= min($ys);
    $lines['mainline'] = implode(',',$xs).'|'.implode(',',$ys);
    $line_styles['mainline'] = 2;
    $line_colors['mainline'] = 'ff0000';

    //need to indicate where zerobalance is, with a horizontal line
    $lines['zeroline'] = '-1|0,0';
    //google omits lines with either end off the scale
    $line_styles['zeroline'] = 1;
    $line_colors['zeroline'] = '888888';

    $scale = array($start_time-1, time() ,$min-1, $max+1);

    //there are two ways to render this line
    //THE EASY WAY, where we draw a diagonal line from point to point
    $chd = 'chd=t:'.implode('|', $lines);
    $cht = 'cht=lxy';
    $chs = 'chs='.implode('x',$dimensions);
    $chds = "chds=".implode(',',$scale);
    $chls = 'chls='.implode('|',$line_styles);
    $chco = 'chco='.implode(',',$line_colors);
    $axes = 'chxt=x,y&chxl=0:|'.date('M y', $start_time).'|'.t('Now').'|1:|'.$min.'|'.$max;
    $chtt = 'chtt='.t('Account balance over time');

    //or THE TRUE WAY where we use only horizontals and verticals. This means we have to insert a set of intermediate points
  }
  $src = 'http://chart.apis.google.com/chart?'.$chtt.'&'.$cht.'&'.$chs.'&'.$chd.'&'.$chds.'&'.$chls.'&'.$chco.'&'.$axes;
  $text = t("@user's balance over time", array('@user' => friendly_name($uid)));
  return '<img src="'.$src.'" alt="'.$text.'" title="'.$text.'" />';
}

/* Google Maps example

// multiple line chart. Three lines: red with blue square point, turqoise with turquoise square points, blue dashed with red square points
http://chart.apis.google.com/chart?
cht=lxy& //chart type
chs=200x125& //size
chd=t:0,30,60,70,90,95,100|20,30,40,50,60,70,80|10,30,40,45,52|100,90,40,20,10|-1|5,33,50,55,7& //coordinates x|y|x|y|x|y
chco=3072F3,ff0000,00aaaa& //colours of lines
chls=2,4,1& //line styles http://code.google.com/apis/chart/styles.html#line_styles 
chm=s,FF0000,0,-1,5|s,0000ff,1,-1,5|s,00aa00,2,-1,5 //markers http://code.google.com/apis/chart/styles.html#shape_markers2

*/
