<?php

/* 
 * Top page
 */

namespace App\Controller;
use App\Lib\Api;
use Cake\Core\Configure;

class TopController extends AppController {
    
    public function index() {
        $data = array(
            'name' => 'sadasd'
        );
        $this->SimpleTable
            ->addColumn(array(
                'id' => 'name',
                'title' => __('Name'),
                'type' => 'link',
                'href' => '/' . $this->controller . '/update/{id}',
                'width' => '300',
                'empty' => ''
            ))
            ->setDataset($data)
            ->addButton(array(
                'type' => 'submit',
                'id' => 'btnSaveDataTable',
                'onclick' => 'return $(\'#dataForm\').submit();',
                'value' => __('Save setting'),
                'class' => 'btn btn-primary btn-saveTable',
            ))
            ->addButton(array(
                'type' => 'submit',
                'value' => __('Add new'),
                'class' => 'btn btn-primary btn-addnew',
            ))
            ->addButton(array(
                'type' => 'submit',
                'value' => __('Disable'),
                'class' => 'btn btn-primary btn-disable',
            ))
            ->addButton(array(
                'type' => 'submit',
                'value' => __('Enable'),
                'class' => 'btn btn-primary btn-enable',
            ));
    }
    
}
