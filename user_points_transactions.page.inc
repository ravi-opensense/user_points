<?php

/**
 * @file
 * Contains user_points_transactions.page.inc.
 *
 * Page callback for User points transactions entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for User points transactions templates.
 *
 * Default template: user_points_transactions.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_user_points_transactions(array &$variables) {
  // Fetch UserPointsTransactions Entity Object.
  $user_points_transactions = $variables['elements']['#user_points_transactions'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
