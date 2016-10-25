<?php

use App\Lib\Api;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use App\Lib\Log\AppLog;

// Load detail
$data = null;
if (!empty($id)) {
    $param['id'] = $id;
    $data = Api::call(Configure::read('API.url_products_detail'), $param);
    $this->Common->handleException(Api::getError());
    if (empty($data)) {
        AppLog::info("Item unavailable", __METHOD__, $param);
        throw new NotFoundException("Item unavailable", __METHOD__, $param);
    }
} else {
    throw new NotFoundException();
}
// Create breadcrumb
$listPageUrl = h($this->BASE_URL . '/products');
$pageTitle = __('LABEL_PRODUCTS_DETAIL');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_PRODUCTS_LIST'),
    ))
    ->add(array(
        'name' => $pageTitle,
    ));

$this->set('data', $data);
