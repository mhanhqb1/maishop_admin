<?php

namespace App\Controller;

use App\Lib\Api;
use Cake\Core\Configure;
/**
 * Show info
 */
class ProductsController extends AppController {
    
    public function index() {
        $pageTitle = 'Products';
        $modelName = 'Products';
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
        
        $result = Api::call(Configure::read('API.url_products_list'), array());
        $total = !empty($result['total']) ? $result['total'] : 0;
        $data = !empty($result['data']) ? $result['data'] : array();
        $this->Common->handleException(Api::getError());
        $this->set('total', $total);
        $this->set('limit', 1);
        $this->SimpleTable       
            ->addcolumn(array(  
                'id' => 'id',
                'title' => __('Type ID'),
                'name' => 'id',
                'value' => '{id}',
                'readonly' => 'readonly'                
            ))
            ->addcolumn(array(  
                'id' => 'cate_id',
                'title' => __('Type ID'),           
            ))
            ->addcolumn(array(  
                'id' => 'price',
                'title' => __('Type ID'),           
            ))
            ->addColumn(array(
                'id' => 'disable',
                'type' => 'checkbox',
                'title' => __('Delete'),
                'toggle' => true,
                'toggle-onstyle' => "danger",
                'toggle-options' => array(
                    "data-on" => __("Delete"),
                ),
                'rules' => array(
                    '0' => '',
                    '1' => 'checked'
                ),
                'empty' => 0,
                'width' => 50,
            ))
            ->setDataset($data)
            ->addButton(array(
                'type' => 'submit',
                'value' => __('Add new'),
                'class' => 'btn btn-primary btn-addnew',
                'onclick' => 'return false;',            
            )
        );

        $this->viewBuilder()->templatePath('Common');
    }
}
