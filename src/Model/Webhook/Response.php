<?php

namespace ApiAi\Model\Webhook;

use ApiAi\Model\Base;
use ApiAi\Model\Context;

/**
 * Class Response.
 *
 * Data model for a webhook response.
 *
 * @package ApiAi\Model\Webhook
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
