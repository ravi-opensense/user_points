<?php

namespace Drupal\user_points\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the User points transactions entity.
 *
 * @ingroup user_points
 *
 * @ContentEntityType(
 *   id = "user_points_transactions",
 *   label = @Translation("User points transactions"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\user_points\UserPointsTransactionsListBuilder",
 *     "views_data" = "Drupal\user_points\Entity\UserPointsTransactionsViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\user_points\Form\UserPointsTransactionsForm",
 *       "add" = "Drupal\user_points\Form\UserPointsTransactionsForm",
 *       "edit" = "Drupal\user_points\Form\UserPointsTransactionsForm",
 *       "delete" = "Drupal\user_points\Form\UserPointsTransactionsDeleteForm",
 *     },
 *     "access" = "Drupal\user_points\UserPointsTransactionsAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\user_points\UserPointsTransactionsHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "user_points_transactions",
 *   admin_permission = "administer user points transactions entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "point_balance" = "point_balance",
       "point_change" = "point_change", 
       "operation" = "operation",
 *     "uid" = "uid",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "status" = "status", 
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/user_points_transactions/{user_points_transactions}",
 *     "add-form" = "/admin/structure/user_points_transactions/add",
 *     "edit-form" = "/admin/structure/user_points_transactions/{user_points_transactions}/edit",
 *     "delete-form" = "/admin/structure/user_points_transactions/{user_points_transactions}/delete",
 *     "collection" = "/admin/structure/user_points_transactions",
 *   },
 *   field_ui_base_route = "user_points_transactions.settings"
 * )
 */
class UserPointsTransactions extends ContentEntityBase implements UserPointsTransactionsInterface {

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
  public function getPointChange() {
    return $this->get('point_change')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setPointChange($points) {
    $this->set('point_balance', $points);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getPointBalance() {
    return $this->get('point_balance')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setPointBalance($point) {
    $this->set('point_balance', $points);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOperation() {
    return $this->get('point_operation')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setOperation($operation) {
    $this->set('point_operation', $operation);
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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('User'))
      ->setDescription(t('The user id of the User.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default');

    $fields['point_change'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Point Change'))
      ->setDescription(t('The Change Points of the User.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
      ]);  

      $fields['point_balance'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Point Balance'))
      ->setDescription(t('The Balance Points of the User.'))
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
      ]);

      $fields['point_operation'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Operation'))
      ->setDescription(t('The Balance Points of the User.'))
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
      ]);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));  

    return $fields;
  }

}
