<?php declare(strict_types = 1);

/**
 * @file
 * Theme settings form for My adminal theme.
 */

use Drupal\Core\Form\FormState;

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function my_adminal_form_system_theme_settings_alter(array &$form, FormState $form_state): void {

  $form['my_adminal'] = [
    '#type' => 'details',
    '#title' => t('My adminal'),
    '#open' => TRUE,
  ];

  $form['my_adminal']['example'] = [
    '#type' => 'textfield',
    '#title' => t('Example'),
    '#default_value' => theme_get_setting('example'),
  ];

}
