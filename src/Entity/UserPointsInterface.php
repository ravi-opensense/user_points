<?php

namespace Drupal\user_points\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining User points entities.
 *
 * @ingroup user_points
 */
interface UserPointsInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the User points.
   *
   * @return string
   *   User points.
   */
  public function getPoints();

  /**
   * Sets the User points.
   *
   * @param integer $points
   *   The User points.
   *
   * @return \Drupal\user_points\Entity\UserPointsInterface
   *   The called User points entity.
   */
  public function setPoints($points);

  /**
   * Returns the User points published status indicator.
   *
   * Unpublished User points are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the User points is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a User points.
   *
   * @param bool $published
   *   TRUE to set this User points to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\user_points\Entity\UserPointsInterface
   *   The called User points entity.
   */
  public function setPublished($published);

}
