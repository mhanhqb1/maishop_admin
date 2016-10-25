<?php

use App\Lib\Api;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

// Load detail
$data = null;
if (!empty($id)) {
    $param['id'] = $id;
    $data = Api::call(Configure::read('API.url_items_detail'), $param);
    $this->Common->handleException(Api::getError());
    if (empty($data)) {
        AppLog::info("Item unavailable", __METHOD__, $param);
        throw new NotFoundException("Item unavailable", __METHOD__, $param);
    }
} else {
    throw new NotFoundException();
}

// Create breadcrumb
$listPageUrl = h($this->BASE_URL . '/items');
$pageTitle = __('LABEL_ITEMS_DETAIL');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_ITEMS_LIST'),
    ))
    ->add(array(
        'name' => $pageTitle,
    ));

$this->set('item', $data);
