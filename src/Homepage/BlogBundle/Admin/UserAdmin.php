<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Homepage\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Description of UserAdmin
 *
 * @author Paweł Winiecki
 */
class UserAdmin extends Admin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('login', null, array('label' => 'Login'))
        ;
    }
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('login', null, array('label' => 'Login'))
        ;
    }
}
