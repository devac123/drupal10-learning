<?php 
declare(strict_types = 1);

namespace Drupal\example_route_subscriber\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Route subscriber.
 */
final class ExampleRouteSubscriberRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection): void {
    // @see https://www.drupal.org/node/2187643
    if ($route = $collection->get('user.login')) {
      $route->setPath('/login');
    }
  }

}
