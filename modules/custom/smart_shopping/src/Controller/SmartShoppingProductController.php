<?php 
namespace Drupal\smart_shopping\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Returns responses for Smart shopping routes.
 */
final class SmartShoppingProductController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function productPage(Request $request) {
    $route_params = $request->attributes->get('_route_params');
    $product_name = $route_params['product_name'];
    $product_varaion = reset(\Drupal::entityTypeManager()->getStorage('commerce_product_variation')->loadByProperties([
      'sku' => $product_name,
      'status' => 1
    ]));
    
    $item = [];
    $item[$product_varaion->sku->value] = [
      "product_title" => $product_varaion->sku->value,
      "product_price" => number_format($product_varaion->price->number,2,'.',''),
      "variation_id" => $product_varaion->id(),
      "Product_conent" => $product_varaion->field_product_content->entity->body->value
    ];
    
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $product_varaion->field_product_content->entity->body->value,
    ];

    return $build;
  }

}
