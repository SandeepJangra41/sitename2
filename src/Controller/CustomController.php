<?php
/**
 * @file
 * Contains \Drupal\custom\Controller\CustomController.
 */

namespace Drupal\custom\Controller;

use Drupal\Core\Controller\ControllerBase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller routines for test_api routes.
 */
class CustomController extends ControllerBase {

  /**
   * Callback for `my-api/post.json` API method.
   */
  public function post_custom( Request $request ) {

    // This condition checks the `Content-type` and makes sure to 
    // decode JSON string from the request body into array.
    if ( 0 === strpos( $request->headers->get( 'Content-Type' ), 'application/json' ) ) {
      $data = json_decode( $request->getContent(), TRUE );
    }
    $config = \Drupal::service('config.factory')->getEditable('system.site');

    $config->set('name', $data['sites_name'])->save();
    $response['data'] = $data['sites_name'];
    $response['method'] = 'POST';

    return new JsonResponse( $response );
  }



}