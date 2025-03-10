<?php

/**
 * Field handler to allow linking to a seller's name
 *
 * @ingroup views_field_handlers
 */
class views_handler_field_requack_count extends views_handler_field {
  /**
   * Override init function to add uid
   */
  function init(&$view, &$data) {
    parent::init($view, $data);
  }

  function render($values) {
    return intval($values->cc_requack_count_count);
  }
}
