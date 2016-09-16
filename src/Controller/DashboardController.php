<?php

/* 
 * Dashboard Controller
 */

namespace App\Controller;
use App\Lib\Api;
use Cake\Core\Configure;

class DashboardController extends AppController {
    
    public function index() {
        $pageTitle = 'asdasda';
        $modelName = 'Dashboard';
        $this->Breadcrumb->setTitle($pageTitle)
            ->add(array(
                'name' => $pageTitle,
        ));
        $this->SearchForm->setModelName($modelName)
            ->setAttribute('type', 'get')
            ->addElement(array(
                'id' => 'language_type',
                'label' => __('Language'),
                'options' => Configure::read('Config.LanguageTypes'),          
                'selected' => '1'
            ))
            ->addElement(array(
                'id' => 'name',
                'label' => __('Name'),
            ))
            ->addElement(array(
                'id' => 'sort',
                'label' => __('Sort'),
                'options' => array(
                    'id-asc' => __('ID Asc'),
                    'id-desc' => __('ID Desc'),
                    'name-asc' => __('Name Asc'),
                    'name-desc' => __('Name Desc'),
                ),
                'empty' => '',
            ))
            ->addElement(array(
                'type' => 'submit',
                'value' => __('Search'),
                'class' => 'btn btn-primary pull-left',
            )
        );
        $this->viewBuilder()->templatePath('Common');
    }
    
}
