<?php

use App\Form\UpdateItemForm;
use App\Lib\Api;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

// Load detail
$data = null;
if (!empty($id)) {
    // Edit
    $param['id'] = $id;
    $data = Api::call(Configure::read('API.url_items_detail'), $param);
    $this->Common->handleException(Api::getError());
    if (empty($data)) {
        AppLog::info("Item unavailable", __METHOD__, $param);
        throw new NotFoundException("Item unavailable", __METHOD__, $param);
    }
    $pageTitle = __('LABEL_ITEMS_UPDATE');
} else {
    // Create new
    $pageTitle = __('LABEL_ADD_NEW');
}

// Create breadcrumb
$listPageUrl = h($this->BASE_URL . '/items');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_ITEMS_LIST'),
    ))
    ->add(array(
        'name' => $pageTitle,
    ));

// Create Update form 
$form = new UpdateItemForm();
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
        'id' => 'name_sub',
        'label' => __('LABEL_NAME_SUB'),
    ))
    ->addElement(array(
        'id' => 'name_eng',
        'label' => __('LABEL_NAME_ENG'),
    ))
    ->addElement(array(
        'id' => 'image',
        'type' => 'file',
        'image' => true,
        'class' => 'upload',
        'label' => __('LABEL_IMAGE'),
        'class' => 'resize_button_upload',
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
    foreach ($data as $key => $value) {
        if (is_scalar($value)) {
            $data[$key] = trim($value);
        }
    }
    
    // Validation
    if ($form->validate($data)) {
        if (!empty($data['image'])) {
            $filetype = $data['image']['type'];
            $filename = $data['image']['name'];
            $filedata = $data['image']['tmp_name'];
            $data['image'] = new CurlFile($filedata, $filetype, $filename);
        }
        
        // Call API to Login
        $id = Api::call(Configure::read('API.url_items_addupdate'), $data);
        if (!empty($id) && !Api::getError()) {
            $this->Flash->success(__('MESSAGE_SAVE_OK'));
            return $this->redirect("/{$this->controller}/update/{$id}");
        } else {
            return $this->Flash->error(__('MESSAGE_SAVE_NG'));
        }
    }
}
