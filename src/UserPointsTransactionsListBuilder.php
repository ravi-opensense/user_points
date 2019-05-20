<?php

namespace Drupal\user_points;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of User points transactions entities.
 *
 * @ingroup user_points
 */
class UserPointsTransactionsListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('User points transactions ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\user_points\Entity\UserPointsTransactions */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.user_points_transactions.edit_form',
      ['user_points_transactions' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
