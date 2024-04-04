<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "Basic_page",
 *   label = @Translation("Page api resource"),
 *   uri_paths = {
 *     "canonical" = "/basic_page/node"
 *   }
 * )
 */
class basic_page_node extends ResourceBase {

   /**
   * Responds to entity GET requests.
   *
   * @return \Drupal\rest\ResourceResponse
   */
  public function get() {
    $response = [];
    $nid = \Drupal::entityQuery('node')
      ->condition('type', 'page')
      ->accessCheck(FALSE)
      ->execute();
    //load first node
    $node_id = reset($nid);
  
    if ($node_id) {
      $node = \Drupal\node\Entity\Node::load($node_id);
      $title = $node->get('title')->value;
      $additional_data = [
        'title' => $title,
      ];
      $paragraph_field_items = $node->get('field_content_details')->getValue();
      foreach ($paragraph_field_items as $paragraph_item) {
        $paragraph = \Drupal\paragraphs\Entity\Paragraph::load($paragraph_item['target_id']);
        $content_title = $paragraph->get('field_content_title')->value;
        $description  = strip_tags($paragraph->get('field_description')->value);
        $image = \Drupal::service('file_url_generator')->generateAbsoluteString($paragraph->field_image->entity->getFileUri());
        
        $response[] = [
          'content_title' => $content_title,
          'description' => $description,
          'image' => $image,
        ];
      }

     $response = array_merge($additional_data,$response);
    }
  
    return new ResourceResponse($response);
  }
}  



