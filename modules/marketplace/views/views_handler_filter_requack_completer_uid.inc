<?php

/**
 * Filter for requacks which are completed or not
 *
 */

class views_handler_filter_requack_completer_uid extends views_handler_filter_boolean_operator{

  function value_form(&$form, &$form_state) {
    $form['value'] = array(
      '#type' => 'checkbox',
      '#title' => "Need has been met?",
      '#options' => array(1 => t('Completed'), 0 => t('Open')),
      '#default_value' => $this->value,
    );
  }

  function admin_summary() {
    $vars = variable_get('cc_requack', array('Request', 'Acknowledgement'));
    if ($this->value == FALSE) return $vars[0];
    else return $vars[1];
  }
}
