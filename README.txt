CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * How to use
 * Maintainers


INTRODUCTION
------------

User Points module provides an entity to store the points accumulated by a user.
It provides API functions for storing/removing points for various scenarios such as
Login, Register, Posting Comment or Creating an Article. Points can be easily retrieved
using API functions and use for various promotional stuff in the website.

 * For a full description of the module, visit the project page:
   https://www.drupal.org/project/user_points

 * To submit bug reports and feature suggestions, or to track changes:
   https://www.drupal.org/project/issues/user_points


REQUIREMENTS
------------

No special requirements. Only a working installation of Drupal 8 is required.


INSTALLATION
------------

 * Install the User Points module as you would normally install a
   contributed Drupal module. Visit
   https://www.drupal.org/node/1897420 for further information.


HOW TO USE
-------------

    1. To set points for user we just need to call the service 'user_points.point_service'
       and call a method "setPoints($uid,$points)".
       ex- \Drupal::Service('user_points.point_service')->setPoints($uid,$points);

    2. To get points for user we just need to call the service 'user_points.point_service'
       and call a method "getPoints($uid)".
       ex- \Drupal::Service('user_points.point_service')->getPoints($uid);

    3. To add points for user we just need to call the service 'user_points.point_service'
       and call a method "addPoints($id,$points)".
       ex- \Drupal::Service('user_points.point_service')->addPoints($uid,$points);

    4. To delete points for user we just need to call the service 'user_points.point_service'
       and call a method "deletePoints($uid,$points)".
       ex- \Drupal::Service('user_points.point_service')->deletePoints($uid,$points);


MAINTAINERS
-----------

 * Gaurav Kapoor (gaurav.kapoor) - https://www.drupal.org/u/gauravkapoor

Supporting organizations:

 * OpenSense Labs - https://www.drupal.org/opensense-labs
