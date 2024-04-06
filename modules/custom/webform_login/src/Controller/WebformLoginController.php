<?php

namespace Drupal\webform_login\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for webform_login routes.
 */
final class WebformLoginController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
