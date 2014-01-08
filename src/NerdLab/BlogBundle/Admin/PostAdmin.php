<?php
 
namespace NerdLab\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends Admin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('postsCategory', 'sonata_type_model', array('label' => 'Category'), array('edit' => 'standard', 'modal' => true))
                ->add('user', 'sonata_type_model', array('label' => 'Author'), array('edit' => 'standard', 'modal' => true))
                ->add('link', null, array('label' => 'Link'))
                ->add('title', null, array('label' => 'Title'))
                ->add('shortContent', null, array('label' => 'Short Content'))
                ->add('longContent', null, array('label' => 'Long Content'))
                ->add('createdOn', null, array('label' => 'Created on', 'required' => false))
                ->add('updatedOn', null, array('label' => 'Updated on', 'required' => false))
                ->add('isActive', null, array('label' => 'Active', 'required' => false))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('title', null, array('label' => 'Title'))
                ->add('link', null, array('label' => 'Link'))
                ->add('postsCategory.link', null, array('label' => 'Category'))
                ->add('user.login', null, array('label' => 'Author'))
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

