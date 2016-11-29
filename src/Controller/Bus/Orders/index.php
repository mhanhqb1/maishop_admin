<?php

use App\Lib\Api;
use Cake\Core\Configure;

$this->doGeneralAction();

// Create breadcrumb
$pageTitle = __('LABEL_ORDERS_LIST');
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
        'id' => 'price',
        'type' => 'text_from_to',
        'label' => __('LABEL_PRICE'),
    ))
    ->addElement(array(
        'id' => 'sort',
        'label' => __('LABEL_SORT'),
        'options' => array(
            'id-asc' => __('LABEL_SORT_ID_ASC'),
            'id-desc' => __('LABEL_SORT_ID_DESC'),
            'name-asc' => __('LABEL_SORT_NAME_ASC'),
            'name-desc' => __('LABEL_SORT_NAME_DESC'),
            'price-asc' => __('LABEL_SORT_PRICE_ASC'),
            'price-desc' => __('LABEL_SORT_PRICE_DESC'),
            'stock-asc' => __('LABEL_SORT_STOCK_ASC'),
            'stock-desc' => __('LABEL_SORT_STOCK_DESC'),
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
$result = Api::call(Configure::read('API.url_orders_list'), $param);
$total = !empty($result['total']) ? $result['total'] : 0;
$data = !empty($result['data']) ? $result['data'] : array();

$this->set('total', $total);
$this->set('limit', $param['limit']);

if (!empty($data)) {
    foreach ($data as $key => &$value) {
        if (!empty($value['is_paid'])) {
            $value['status'] = '<span class="label label-primary">'.__('LABEL_ORDER_IS_PAID').'</span>';
        } else if (!empty($value['is_deposit'])) {
            $value['status'] = '<span class="label label-warning">'.__('LABEL_ORDER_IS_DEPOSIT').'</span>';
        } else if (!empty($value['is_cancel'])) {
            $value['status'] = '<span class="label label-danger">'.__('LABEL_ORDER_IS_CANCEL').'</span>';
        } 
    }
}
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
        'width' => 10,
    ))
    ->addColumn(array(
        'id' => 'user_name',
        'title' => __('LABEL_USER_NAME'),
        'empty' => '',
        'width' => 150,
    ))
    ->addColumn(array(
        'id' => 'address',
        'title' => __('LABEL_ADDRESS'),
        'empty' => '',
    ))
    ->addColumn(array(
        'id' => 'total_price',
        'title' => __('LABEL_PRICE'),
        'type' => 'number',
        'empty' => 0,
        'width' => 80,
    ))
    ->addColumn(array(
        'id' => 'status',
        'title' => __('LABEL_ORDER_STATUS'),
        'width' => 80,
    ))
    ->addColumn(array(
        'type' => 'link',
        'title' => __('Edit'),
        'href' => '/'.$this->controller.'/update/{id}',
        'button' => true,
        'width' => '80'
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
