<?php

namespace Drupal\custom_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "Blogs",
 *   label = @Translation("Blog api Resource"),
 *   uri_paths = {
 *     "canonical" = "/blog/node"
 *   }
 * )
 */
class blog_node extends ResourceBase {

   /**
   * Responds to entity GET requests.
   *
   * @return \Drupal\rest\ResourceResponse
   */
  public function get() {
    $response = [];
    $nid = \Drupal::entityQuery('node')
    ->condition('type', 'blog')
    ->accessCheck(FALSE)
    ->execute();
    $node_id = reset($nid);

    if($node_id) {
      $node = \Drupal\node\Entity\Node::load($node_id);
      $title = $node->get('title')->value;
      $paragraph_field_items = $node->get('field_blog_details')->getValue();
      foreach ($paragraph_field_items as $paragraph_item) {
        $paragraph = \Drupal\paragraphs\Entity\Paragraph::load($paragraph_item['target_id']);
        $blog_heading = strip_tags($paragraph->get('field_blog_headline')->value);
        $blog_description  = strip_tags($paragraph->get('field_blog_description')->value);
        $image = \Drupal::service('file_url_generator')->generateAbsoluteString($paragraph->field_image->entity->getFileUri());
        
        $response[] = [
          'title' => $title,
          'blog_heading' => $blog_heading,
          'blog_desc' => $blog_description,
          'image' => $image,
        ];
      }
    }
    return new ResourceResponse($response);
  }
  }





