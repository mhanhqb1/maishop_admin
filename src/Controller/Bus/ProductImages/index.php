<?php

use App\Lib\Api;
use Cake\Core\Configure;

$this->doGeneralAction();

// Create breadcrumb
$pageTitle = __('LABEL_PRODUCTIMAGES_LIST');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'name' => $pageTitle,
    ));

// Create search form
$this->SearchForm
    ->setAttribute('type', 'get')
    ->addElement(array(
        'id' => 'name',
        'label' => __('LABEL_PRODUCT_NAME'),
    ))
    ->addElement(array(
        'id' => 'limit',
        'label' => __('LABEL_LIMIT'),
        'options' => Configure::read('Config.searchPageSize'),
    ))
    ->addElement(array(
        'type' => 'submit',
        'value' => __('LABEL_SEARCH'),
        'class' => 'btn btn-primary',
    ));

// Load data
$param = $this->getParams(
    array(
        'page' => 1,
        'limit' => Configure::read('Config.PageSize')
    )
);
$result = Api::call(Configure::read('API.url_productimages_list'), $param);
$total = !empty($result['total']) ? $result['total'] : 0;
$data = !empty($result['data']) ? $result['data'] : array();

$this->set('total', $total);
$this->set('limit', $param['limit']);

// Show data
$this->SimpleTable->addColumn(array(
        'id' => 'item',
        'name' => 'items[]',
        'type' => 'checkbox',
        'value' => '{id}',
        'width' => 20
    ))
    ->addColumn(array(
        'id' => 'id',
        'title' => __('LABEL_ID'),
        'width' => 10,
    ))
    ->addColumn(array(
        'id' => 'image',
        'title' => __('LABEL_IMAGE'),
        'type' => 'image',
        'src' => '{image}',
        'width' => '150'
    ))
    ->addColumn(array(
        'id' => 'name',
        'title' => __('LABEL_PRODUCT_NAME'),
        'empty' => '',
    ))
    ->addColumn(array(
        'id' => 'created',
        'title' => __('LABEL_CREATED'),
        'type' => 'date',
        'width' => 140
    ))
    ->addColumn(array(
        'id' => 'disable',
        'type' => 'checkbox',
        'title' => __('LABEL_DELETE'),
        'toggle' => true,
        'toggle-onstyle' => "danger",
        'toggle-options' => array(
            "data-on" => __("LABEL_DELETE"),
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
        'value' => __('LABEL_ADD_NEW'),
        'class' => 'btn btn-success btn-addnew',
    ))
    ->addButton(array(
        'type' => 'submit',
        'value' => __('LABEL_DISABLE'),
        'class' => 'btn btn-danger btn-disable',
    ))
    ->addButton(array(
        'type' => 'submit',
        'value' => __('LABEL_ENABLE'),
        'class' => 'btn btn-primary btn-enable',
    ));
