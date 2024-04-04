<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "Article",
 *   label = @Translation("Article api resource"),
 *   uri_paths = {
 *     "canonical" = "/article/node"
 *   }
 * )
 */
class article_node extends ResourceBase {

   /**
   * Responds to entity GET requests.
   *
   * @return \Drupal\rest\ResourceResponse
   */
  public function get() {
    $response = [];
    $nids = \Drupal::entityQuery('node')
      ->condition('type', 'article')
      ->accessCheck(FALSE)
      ->execute();
  
    foreach ($nids as $nid) {
      $node = \Drupal\node\Entity\Node::load($nid);
      $title = $node->get('title')->value;
      $paragraph_field_items = $node->get('field_user_data')->getValue();
      foreach ($paragraph_field_items as $paragraph_item) {
        $paragraph = \Drupal\paragraphs\Entity\Paragraph::load($paragraph_item['target_id']);
        $description  = strip_tags($paragraph->get('field_description')->value);
        $image = \Drupal::service('file_url_generator')->generateAbsoluteString($paragraph->field_image->entity->getFileUri());
        $name = $paragraph->get('field_name')->value;
        $dob = $paragraph->get('field_date_of_birth')->value;
        $response[] = [
          'title' => $title,
          'description' => $description,
          'image' => $image,
          'name' => $name,
          'dob' => $dob,
        ];
      }
    }
    return new ResourceResponse($response);
  }
  }





