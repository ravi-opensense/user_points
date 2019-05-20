<?php

namespace Drupal\user_points\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the User points entity.
 *
 * @ingroup user_points
 *
 * @ContentEntityType(
 *   id = "user_points",
 *   label = @Translation("User points"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\user_points\UserPointsListBuilder",
 *     "views_data" = "Drupal\user_points\Entity\UserPointsViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\user_points\Form\UserPointsForm",
 *       "add" = "Drupal\user_points\Form\UserPointsForm",
 *       "edit" = "Drupal\user_points\Form\UserPointsForm",
 *       "delete" = "Drupal\user_points\Form\UserPointsDeleteForm",
 *     },
 *     "access" = "Drupal\user_points\UserPointsAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\user_points\UserPointsHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "user_points",
 *   admin_permission = "administer user points entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "Points",
 *     "uuid" = "uuid",
 *     "uid" = "uid",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/user_points/{user_points}",
 *     "add-form" = "/admin/structure/user_points/add",
 *     "edit-form" = "/admin/structure/user_points/{user_points}/edit",
 *     "delete-form" = "/admin/structure/user_points/{user_points}/delete",
 *     "collection" = "/admin/structure/user_points",
 *   },
 *   field_ui_base_route = "user_points.settings"
 * )
 */
class UserPoints extends ContentEntityBase implements UserPointsInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'uid' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getPoints() {
    return $this->get('points')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setPoints($points) {
    $this->set('points', $points);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('uid')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('uid', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('User ID'))
      ->setDescription(t('The user id of the User.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'type' => 'author',
        'weight' => 0,
      ]);

    $fields['points'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Points'))
      ->setDescription(t('The Points of the User.'))
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -4,
      ]);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
