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
    $data = Api::call(Configure::read('API.url_products_detail'), $param);
    $this->Common->handleException(Api::getError());
    if (empty($data)) {
        AppLog::info("Item unavailable", __METHOD__, $param);
        throw new NotFoundException("Item unavailable", __METHOD__, $param);
    }
    $pageTitle = __('LABEL_PRODUCTS_UPDATE');
} else {
    // Create new
    $pageTitle = __('LABEL_ADD_NEW');
}

// Create breadcrumb
$listPageUrl = h($this->BASE_URL . '/products');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_PRODUCTS_LIST'),
    ))
    ->add(array(
        'name' => $pageTitle,
    ));

// Create Update form 
$form = new UpdateItemsetForm();
$this->UpdateForm->reset()
    ->setModel($form)
    ->setData($data)
    ->addElement(array(
        'id' => 'id',
        'type' => 'hidden',
        'label' => __('id'),
    ))
    ->addElement(array(
        'id' => 'name',
        'label' => __('LABEL_NAME'),
        'required' => true
    ))
    ->addElement(array(
        'id' => 'price',
        'label' => __('LABEL_PRICE'),
        'required' => true
    ))
    ->addElement(array(
        'id' => 'stock',
        'label' => __('LABEL_STOCK'),
        'required' => true
    ))
    ->addElement(array(
        'id' => 'image',
        'label' => __('LABEL_IMAGE'),
        'type' => 'file',
        'allowEmpty' => true,
        'image' => true,
    ))
    ->addElement(array(
        'id' => 'description',
        'label' => __('LABEL_DESCRIPTION'),
    ))
    ->addElement(array(
        'id' => 'detail',
        'label' => __('LABEL_DETAIL'),
        'type'  => 'editor'
    ))    
    ->addElement(array(
        'type' => 'submit',
        'value' => __('LABEL_SAVE'),
        'class' => 'btn btn-primary',
    ))
    ->addElement(array(
        'type' => 'submit',
        'value' => __('LABEL_CANCEL'),
        'class' => 'btn',
        'onclick' => "return back('{$listPageUrl}');"
    ));

// Valdate and update
if ($this->request->is('post')) {
    // Trim data
    $data = $this->request->data();
    if (!empty($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filetype = $_FILES['image']['type'];
        $filename = $_FILES['image']['name'];
        $filedata = $_FILES['image']['tmp_name'];
        $data['image'] = new CurlFile($filedata, $filetype, $filename);
    }
    foreach ($data as $key => $value) {
        if ($key == 'image') {
            continue;
        }
        $data[$key] = trim($value);
    }
    
    // Validation
    if ($form->validate($data)) {
        // Call API to Login
        $id = Api::call(Configure::read('API.url_products_addupdate'), $data);
        $error = Api::getError();
        if (!empty($id) && !Api::getError()) {
            $this->Flash->success(__('MESSAGE_SAVE_OK'));
            return $this->redirect("/{$this->controller}/update/{$id}");
        } else {
            print_r($error);die();
            return $this->Flash->error(__('MESSAGE_SAVE_NG'));
        }
    }
}
