<?php

use App\Lib\Api;
use Cake\Core\Configure;

$this->doGeneralAction();

// Create breadcrumb
$pageTitle = __('LABEL_ITEMS_LIST');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'name' => $pageTitle,
    ));

// Create search form
$this->SearchForm
    ->setAttribute('type', 'get')
    ->addElement(array(
        'id' => 'name',
        'label' => __('LABEL_NAME'),
    ))
    ->addElement(array(
        'id' => 'sort',
        'label' => __('LABEL_SORT'),
        'options' => array(
            'id-asc' => __('LABEL_SORT_ID_ASC'),
            'id-desc' => __('LABEL_SORT_ID_DESC'),
            'name-asc' => __('LABEL_SORT_NAME_ASC'),
            'name-desc' => __('LABEL_SORT_NAME_DESC'),
        ),
        'empty' => Configure::read('Config.StrChooseOne'),
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
$result = Api::call(Configure::read('API.url_items_list'), $param);
$total = !empty($result['total']) ? $result['total'] : 0;
$data = !empty($result['data']) ? $result['data'] : array();
//var_dump($result);die;
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
        'type' => 'link',
        'value' => '{id}',
        'href'  => $this->BASE_URL . '/' . $this->controller . '/detail/{id}',
        'width' => 80,
    ))
    ->addColumn(array(
        'id'    => 'image',
        'type'  => 'image',
            'image_type' => 'user',
        'title' => __('LABEL_IMAGE'),
        'src'   => '{image}',
        'width' => '60'
    ))
    ->addColumn(array(
        'id' => 'name',
        'title' => __('LABEL_NAME'),
        'empty' => '',
    ))
    ->addColumn(array(
        'id' => 'name_sub',
        'title' => __('LABEL_NAME_SUB'),
        'empty' => '',
    ))
    ->addColumn(array(
        'id' => 'name_eng',
        'title' => __('LABEL_NAME_ENG'),
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
