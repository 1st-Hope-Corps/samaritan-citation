<?php

/**
 * Field handler to allow linking to a seller's name
 *
 * @ingroup views_field_handlers
 */
class views_handler_field_requack_completer_uid extends views_handler_field {
  /**
   * Override init function to add uid
   */
  function init(&$view, &$data) {
    parent::init($view, $data);
  }

  function options(&$options) {
    parent::options($options);
    $options['link_to_completer'] = TRUE;
  }

  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    $form['link_to_completer'] = array(
      '#title' => t("Link this field to its user, the completer's profile"),
      '#type' => 'checkbox',
      '#default_value' => $this->options['link_to_completer'],
    );
  }

  function render_link($data, $values) {
    if( $this -> options['link_to_completer']) $link = 'profile';
    $account = user_load(array('uid' => $values -> cc_requack_completer_uid));
    return friendly_name($account, $link);
  }

  function render($values) {
    return $this->render_link(check_plain($values->{$this->field_alias}), $values);
  }
}
