<?php

namespace Drupal\user_points\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for User points transactions edit forms.
 *
 * @ingroup user_points
 */
class UserPointsTransactionsForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\user_points\Entity\UserPointsTransactions */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label User points transactions.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label User points transactions.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.user_points_transactions.canonical', ['user_points_transactions' => $entity->id()]);
  }

}
