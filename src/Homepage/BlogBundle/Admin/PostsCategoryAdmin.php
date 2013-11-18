<?php

namespace Homepage\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Description of PostsCategoryAdmin
 *
 * @author Paweł Winiecki
 */
class PostsCategoryAdmin extends Admin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('categoryName', null, array('label' => 'Category name'))
                ->add('link', null, array('label' => 'Link'))
                ->add('description', null, array('label' => 'Description', 'required' => false))
                ->add('createdOn', null, array('label' => 'Created on', 'required' => false))
                ->add('updatedOn', null, array('label' => 'Updated on', 'required' => false))
                ->add('isActive', null, array('label' => 'Active', 'required' => false))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('categoryName', null, array('label' => 'Category name'))
                ->add('description', null, array('label' => 'Description'))
                ->add('createdOn', null, array('label' => 'Created on', 'required' => false))
                ->add('updatedOn', null, array('label' => 'Updated on', 'required' => false))
                ->add('isActive', null, array('label' => 'Active', 'required' => false))
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
