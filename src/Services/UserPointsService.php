<?php
namespace Drupal\user_points\Services;
use \Drupal\user_points\Entity\UserPoints;
use \Drupal\user_points\Entity\UserPointsTransactions;

/**
 * Class UserPoints.
 */
class UserPointsService {

  /**
   * Add user points.
   */
  public function addPoints($uid, $points) {
    $user_points_id = \Drupal::entityQuery('user_points')->condition('uid',$uid)->execute();
    $user_id = array_values($user_points_id)[0];
    $user_points_details = \Drupal::entityTypeManager()->getStorage('user_points')->load($user_id);
    if(!empty($user_points_details)) {
      $old_point = $user_points_details->get('points')->value;
      if($old_point) {
        $new_point = $old_point + $points;
      }
      else {
        $new_point = $points;
      }
      $entity = UserPoints::load($user_id)->set("points", $new_point)->save();
      if($entity) {
        UserPointsTransactions::create(['uid'=>$user_id, 'point_change'=>$points,
          'point_balance'=>$new_point, 'point_operation'=>'credit'])->save();

        $message = $points.' Points credited successfully.';
      }
      else {
        $message = 'Unable to credit points.';
      }
    } 
    else {
      $message = 'User does not exists in points table.';
    }
    return $message;
  }

  /**
   * Set user points.
   */
  public function setPoints($uid, $points) {
    $user_points_id = \Drupal::entityQuery('user_points')->condition('uid',$uid)->execute();
    $user_id = array_values($user_points_id)[0];
    $user_points_details = \Drupal::entityTypeManager()->getStorage('user_points')->load($user_id);
    if(!empty($user_points_details)) {
      $entity = UserPoints::load($user_id)->set("points", $points)->save();
      if($entity) {
        UserPointsTransactions::create(['uid'=>$user_id, 'point_change'=>$points,
          'point_balance'=>$points, 'point_operation'=>'set'])->save();
        $message = $points.' Points set successfully for user.';
      }
      else {
        $message = 'Unable to set points for user.';
      }
    } 
    else {
      $message = 'User does not exists in points table.';
    }
    return $message;
  }

  /**
   * Get user points.
   */
  public function getPoints($uid) {
    $user_points_id = \Drupal::entityQuery('user_points')->condition('uid',$uid)->execute();
    $user_id = array_values($user_points_id)[0];
    $user_points_details = \Drupal::entityTypeManager()->getStorage('user_points')
                           ->load($user_id);
    if(!empty($user_points_details)) {
      $points = $user_points_details->get('points')->value;
      $message = 'User has '.$points.' points.';
    } 
    else {
      $message = 'User does not exists in points table.';
    }  
    return $message;
  }

  /**
   * Delete user points.
   */
  public function deletePoints($uid, $points) {
    $user_points_id = \Drupal::entityQuery('user_points')->condition('uid',$uid)->execute();
    $user_id = array_values($user_points_id)[0];
    $user_points_details = \Drupal::entityTypeManager()->getStorage('user_points')
                      ->load($user_id);
    if(!empty($user_points_details)) {
      $old_point = $user_points_details->get('points')->value;
      if($old_point >= $points) {
        $new_point = $old_point - $points;
        $entity = UserPoints::load($user_id)->set("points", $new_point)->save();
        if($entity) {
          UserPointsTransactions::create(['uid'=>$user_id, 'point_change'=>$points,
          'point_balance'=>$new_point, 'point_operation'=>'debit'])->save();
          $message = $points.' Points debited successfully.';
        }
        else {
          $message = 'Unable to debit points.';
        }
      }
      else {
        $message = 'User does not have enough points for debit. User have only '.$old_point. ' Points.';
      }
    } 
    else {
      $message = 'User does not exists in points table.';
    }
    return $message;
  }

}