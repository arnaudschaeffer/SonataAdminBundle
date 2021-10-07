<?php

namespace Aschaeffer\SonataAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

trait GetSonataMapperProxyTrait
{
    /**
     * Assign default label for added field without label
     * @param ListMapper $list
     * @return ListMapperProxy|ListMapper
     */
    public function getListMapper(ListMapper $list)
    {
        return new ListMapperProxy($list, $this->classnameLabel);
    }

    /**
     * @param FormMapper $form
     * @return FormMapperProxy|FormMapper
     */
    public function getFormMapper(FormMapper $form)
    {
        return new FormMapperProxy($form, $this->classnameLabel);
    }

    /**
     * @param ShowMapper $show
     * @return ShowMapperProxy|ShowMapper
     */
    public function getShowMapper(ShowMapper $show)
    {
        return new ShowMapperProxy($show, $this->classnameLabel);
    }

    /**
     * @param DatagridMapper $filter
     * @return DatagridMapperProxy|DatagridMapper
     */
    public function getDatagridMapper(DatagridMapper $filter)
    {
        return new DatagridMapperProxy($filter, $this->classnameLabel);
    }
}