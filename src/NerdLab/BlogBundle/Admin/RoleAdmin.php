<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NerdLab\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Description of RoleAdmin
 *
 * @author Paweł Winiecki
 */
class RoleAdmin extends Admin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('roleName', null, array('label' => 'Role Name'))
                ->add('user', 'sonata_type_model', array('expanded' => true, 'by_reference' => false, 'multiple' => true))
                ->add('createdOn', null, array('label' => 'Created on', 'required' => false))
                ->add('updatedOn', null, array('label' => 'Updated on', 'required' => false))
                ->add('isActive', null, array('label' => 'Active', 'required' => false))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('roleName', null, array('label' => 'Role name'))
                ->add('createdOn', null, array('label' => 'Created on'))
                ->add('updatedOn', null, array('label' => 'Updated on'))
                ->add('isActive', null, array('label' => 'Active'))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'view' => array(),
                        'edit' => array(),
                    ),
                    'label' => 'Actions'
                ))
        ;
    }
}
