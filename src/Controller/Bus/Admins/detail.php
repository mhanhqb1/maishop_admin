<?php

use App\Lib\Api;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

// Load detail
$data = null;
if (!empty($id)) {
    $param['id'] = $id;
    $data = Api::call(Configure::read('API.url_admins_detail'), $param);
    $this->Common->handleException(Api::getError());
    if (empty($data)) {
        AppLog::info("Admin unavailable", __METHOD__, $param);
        throw new NotFoundException("Admin unavailable", __METHOD__, $param);
    }
} else {
    throw new NotFoundException();
}

// Create breadcrumb
$listPageUrl = h($this->BASE_URL . '/admins');
$pageTitle = __('LABEL_ADMIN_DETAIL');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_ADMINS_LIST'),
    ))
    ->add(array(
        'name' => $pageTitle,
    ));

// Set data for view
$searchAdminType = Configure::read('Config.searchAdminType');

$this->set('admin', $data);
$this->set('searchAdminType', $searchAdminType);
