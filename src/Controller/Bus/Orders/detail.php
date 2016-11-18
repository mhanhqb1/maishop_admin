<?php

use App\Form\UpdateItemsetForm;
use App\Lib\Api;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

$data = array();
// Load detail
if (!empty($id)) {
    // Edit
    $param['id'] = $id;
    $param['get_products'] = 1;
    $data = Api::call(Configure::read('API.url_orders_detail'), $param);
    $this->Common->handleException(Api::getError());
    if (empty($data)) {
        AppLog::info("Order unavailable", __METHOD__, $param);
        throw new NotFoundException("Order unavailable", __METHOD__, $param);
    }
    $pageTitle = __('LABEL_ORDER_DETAIL');
} else {
    // Create new
    $pageTitle = __('LABEL_ADD_NEW');
}
// Create breadcrumb
$listPageUrl = h($this->BASE_URL . '/orders');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_ORDER_LIST'),
    ))
    ->add(array(
        'name' => $pageTitle,
    ));
// Valdate and update
if ($this->request->is('post')) {
    // Trim data
    $data = $this->request->data();
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
    }
    
    // Validation
    if ($form->validate($data)) {
        // Call API to Login
        $id = Api::call(Configure::read('API.url_products_addupdate'), $data);
        if (!empty($id) && !Api::getError()) {
            $this->Flash->success(__('MESSAGE_SAVE_OK'));
            return $this->redirect("/{$this->controller}/update/{$id}");
        } else {
            return $this->Flash->error(__('MESSAGE_SAVE_NG'));
        }
    }
}

// Set data for view
$this->set('id', $id);
$this->set('data', $data);