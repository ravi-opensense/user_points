<?php

namespace Drupal\user_points\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining User points transactions entities.
 *
 * @ingroup user_points
 */
interface UserPointsTransactionsInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the User points transactions name.
   *
   * @return string
   *   Name of the User points transactions.
   */
  public function getPointBalance();

  /**
   * Sets the User points transactions Point balance.
   *
   * @param string $points
   *   The User points transactions Point Balance.
   *
   * @return \Drupal\user_points\Entity\UserPointsTransactionsInterface
   *   The called User points transactions entity.
   */
  public function setPointBalance($points);

  /**
   * Gets the User points transactions creation timestamp.
   *
   * @return int
   *   Creation timestamp of the User points transactions.
   */
  public function getPointChange();

  /**
   * Sets the User points transactions creation timestamp.
   *
   * @param int $timestamp
   *   The User points transactions creation timestamp.
   *
   * @return \Drupal\user_points\Entity\UserPointsTransactionsInterface
   *   The called User points transactions entity.
   */
  public function setPointChange($points);

  /**
   * Gets the User points transactions operation.
   *
   * @return int
   *   operation of the User points transactions.
   */
  public function getOperation();

  /**
   * Sets the User points transactions operation.
   *
   * @param int $timestamp
   *   The User points transactions operation.
   *
   * @return \Drupal\user_points\Entity\UserPointsTransactionsInterface
   *   The called User points transactions entity.
   */
  public function setOperation($operation);

}
