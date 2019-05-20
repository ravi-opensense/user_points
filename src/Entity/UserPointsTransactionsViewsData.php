<?php

namespace Drupal\user_points\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for User points transactions entities.
 */
class UserPointsTransactionsViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
