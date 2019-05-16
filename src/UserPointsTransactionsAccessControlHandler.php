<?php

namespace Drupal\user_points;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the User points transactions entity.
 *
 * @see \Drupal\user_points\Entity\UserPointsTransactions.
 */
class UserPointsTransactionsAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\user_points\Entity\UserPointsTransactionsInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished user points transactions entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published user points transactions entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit user points transactions entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete user points transactions entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add user points transactions entities');
  }

}
