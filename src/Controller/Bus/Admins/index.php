<?php

use App\Lib\Api;
use Cake\Core\Configure;

$this->doGeneralAction();

// Create breadcrumb
$pageTitle = __('LABEL_ADMIN_LIST');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'name' => $pageTitle,
    ));

// Create search form
$this->SearchForm
    ->setAttribute('type', 'get')
    ->addElement(array(
        'id' => 'login',
        'label' => __('LABEL_ADMIN_LOGIN_ID')
    ))
    ->addElement(array(
        'id' => 'name',
        'label' => __('LABEL_NAME')
    ))
    ->addElement(array(
        'id' => 'sort',
        'label' => __('LABEL_SORT'),
        'options' => array(
            'created-asc' => __('LABEL_CREATED_ASC'),
            'created-desc' => __('LABEL_CREATED_DESC'),
            'updated-asc' => __('LABEL_UPDATED_ASC'),
            'updated-desc' => __('LABEL_UPDATED_DESC'),
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
$param['login_id'] = !empty($param['login']) ? $param['login'] : '';
list($total, $data) = Api::call(Configure::read('API.url_admins_list'), $param);

$this->set('total', $total);
$this->set('limit', 10);

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
        'id' => 'login_id',
        'type' => 'link',
        'title' => __('LABEL_ADMIN_LOGIN_ID'),
        'href' => $this->BASE_URL . '/' . $this->controller . '/detail/{id}',
        'width' => 150,
        'empty' => ''
    ))
    ->addColumn(array(
        'id' => 'name',
        'type' => 'link',
        'href' => $this->BASE_URL . '/' . $this->controller . '/detail/{id}',
        'title' => __('LABEL_NAME'),
        'empty' => ''
    ))
    ->addColumn(array(
        'id' => 'admin_type',
        'title' => __('LABEL_ADMIN_TYPE'),
        'rules' => Configure::read('Config.searchAdminType')
    ))
    ->addColumn(array(
        'id' => 'created',
        'title' => __('LABEL_CREATED'),
        'type' => 'date',
        'width' => 140
    ))
    ->addColumn(array(
        'type' => 'link',
        'th_title' => __('LABEL_PASSWORD'),
        'title' => __('LABEL_CHANGE'),
        'href' => $this->BASE_URL . '/' . $this->controller . '/password/{id}',
        'button' => true,
        'width' => 100,
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
