<?php

use App\Form\UpdateAdminForm;
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
$pageTitle = __('LABEL_CHANGE_PASSWORD');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_ADMINS_LIST'),
    ))
    ->add(array(
        'name' => $pageTitle,
    ));

// Create Update form user
$form = new UpdateAdminForm();
$this->UpdateForm->reset()
        ->setModel($form)
        //Create form for addupdate user
        ->addElement(array(
            'id' => 'password',
            'type' => 'password',
            'label' => __('LABEL_NEW_PASSWORD'),
            'autocomplete' => 'off'
        ))
        ->addElement(array(
            'id' => 'password_confirm',
            'type' => 'password',
            'label' => __('LABEL_CONFIRM_PASSWORD'),
            'autocomplete' => 'off'
        ))
        ->addElement(array(
            'type' => 'submit',
            'value' => __('LABEL_SAVE'),
            'class' => 'btn btn-primary pull-left',
        ))
        ->addElement(array(
            'type' => 'submit',
            'value' => __('LABEL_CANCEL'),
            'class' => 'btn pull-left',
            'onclick' => 'return back();'
        ));

// Process update password
if ($this->request->is('post')) {
    $request_data = $this->request->data();
    
    if ($form->validate($request_data)) {
        $param = array(
            'id' => $id,
            'password' => $request_data['password']
        );
        Api::call(Configure::read('API.url_admins_updatepassword'), $param);
        if (!Api::getError()) {
            $this->Flash->success(__('MESSAGE_SAVE_OK'));
            return $this->redirect("/{$this->controller}/password/{$id}");
        } else {
            return $this->Flash->error(__('MESSAGE_SAVE_NG'));
        }
    }
}

// Set data for view
$searchAdminType = Configure::read('Config.searchAdminType');
$this->set('admin', $data);
$this->set('searchAdminType', $searchAdminType);
