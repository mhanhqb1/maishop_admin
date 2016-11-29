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
    $data = Api::call(Configure::read('API.url_categories_detail'), $param);
    $this->Common->handleException(Api::getError());
    if (empty($data)) {
        AppLog::info("Item unavailable", __METHOD__, $param);
        throw new NotFoundException("Item unavailable", __METHOD__, $param);
    }
    $pageTitle = __('LABEL_CATEGORIES_UPDATE');
} else {
    // Create new
    $pageTitle = __('LABEL_ADD_NEW');
}

// Create breadcrumb
$listPageUrl = h($this->BASE_URL . '/categories');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_CATEGORIES_LIST'),
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
        'id' => 'image_path',
        'label' => __('LABEL_IMAGE'),
        'type' => 'file',
        'required' => true
    ));
if (!empty($data['image_path'])) {
    $this->UpdateForm->addElement(array(
        'id' => 'old_image',
        'label' => __('LABEL_IMAGE'),
        'type' => 'image',
        'value' => "{$data['image_path']}"
    ));
}
$this->UpdateForm->addElement(array(
        'id' => 'position',
        'label' => __('LABEL_POSITION'),
        'required' => true
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
    if (!empty($_FILES['image_path']) && $_FILES['image_path']['error'] === 0) {
        $filetype = $_FILES['image_path']['type'];
        $filename = $_FILES['image_path']['name'];
        $filedata = $_FILES['image_path']['tmp_name'];
        $data['image_path'] = new CurlFile($filedata, $filetype, $filename);
    }
    
    foreach ($data as $key => $value) {
        if ($key == 'image_path') {
            continue;
        }
        $data[$key] = trim($value);
    }
    // Validation
    if ($form->validate($data)) {
        // Call API to Login
        $id = Api::call(Configure::read('API.url_categories_addupdate'), $data);
        if (!empty($id) && !Api::getError()) {
            $this->Flash->success(__('MESSAGE_SAVE_OK'));
            return $this->redirect("/{$this->controller}/update/{$id}");
        } else {
            return $this->Flash->error(__('MESSAGE_SAVE_NG'));
        }
    }
}
