<?php

namespace Drupal\front_page_by_role;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\PathProcessor\PathProcessorFront;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Defines the class for a override path processor front class.
 */
class PathProcessorManager extends PathProcessorFront {

  /**
   * A config factory for retrieving required config settings.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $config;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $account;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a PathProcessorCustom object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config
   *   A config factory for retrieving the site front page configuration.
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The current user.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager.
   */
  public function __construct(ConfigFactoryInterface $config, AccountInterface $account, EntityTypeManagerInterface $entityTypeManager) {
    $this->config = $config;
    $this->account = $account;
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public function processInbound($path, Request $request) {
    $userRoles = $this->account->getRoles();
    $config = $this->config->get('system.site');
    if ($path == '/node' || $path == '/') {
      $roleWeight = NULL;
      $selectedNode = '';
      for ($item = 0; $item < count($userRoles); $item++) {
        if ($item == 0) {
          $roleWeight = $config->get($userRoles[$item])['weight'];
        }
        if ($config->get($userRoles[$item])['weight'] <= $roleWeight) {
          $roleWeight = $config->get($userRoles[$item])['weight'];
          $selectedNode = $config->get($userRoles[$item])['node'];
        }
      }
      if ($selectedNode != '') {
        return $selectedNode;
      }
    }

    return $path;
  }

}
