<?php
/**
 * Created by PhpStorm.
 * User: smairi_med
 * Date: 16/12/2016
 * Time: 11:38 PM
 */

namespace AppBundle\Controller;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateEntity($entity)
    {
        if (method_exists($entity, 'setUpdateAt')) {
            $entity->setUpdateAt(new \DateTime());
        }
    }




}