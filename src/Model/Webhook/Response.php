<?php

namespace DialogFlow\Model\Webhook;

use DialogFlow\Model\Base;
use DialogFlow\Model\Context;

/**
 * Class Response.
 *
 * Data model for a webhook response.
 *
 * @package DialogFlow\Model\Webhook
 */
class Response extends Base {

  /**
   * Set response speech.
   *
   * @param string $string
   *   The response speech message.
   */
  public function setSpeech($string) {
    $this->add('speech', $string);
  }

  /**
   * Set display text.
   *
   * Set the text displayed on the user device screen.
   *
   * @param string $string
   *   The text copy.
   */
  public function setDisplayText($string) {
    $this->add('displayText', $string);
  }

  /**
   * Add a context to the response.
   *
   * @param \ApiAi\Model\Context $context
   *   The Context to be added.
   */
  public function addContext(Context $context) {
    $contexts = $this->get('contextOut');
    $contexts[] = $context;
    $this->add('contextOut', $contexts);
  }

}
