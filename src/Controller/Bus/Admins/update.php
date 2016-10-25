<?php

use App\Form\UpdateAdminForm;
use App\Lib\Api;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

// Load detail
$data = null;
if (!empty($id)) {
    // Edit
    $param['id'] = $id;
    $data = Api::call(Configure::read('API.url_admins_detail'), $param);
    $this->Common->handleException(Api::getError());
    if (empty($data)) {
        AppLog::info("Admin unavailable", __METHOD__, $param);
        throw new NotFoundException("Admin unavailable", __METHOD__, $param);
    }
    $pageTitle = __('LABEL_ADMINS_UPDATE');
} else {
    // Create new
    $pageTitle = __('LABEL_ADD_NEW');
}

// Create breadcrumb
$listPageUrl = h($this->BASE_URL . '/admins');
$this->Breadcrumb->setTitle($pageTitle)
    ->add(array(
        'link' => $listPageUrl,
        'name' => __('LABEL_ADMINS_LIST'),
    ))
    ->add(array(
        'name' => $pageTitle,
    ));

// Create Update form 
$form = new UpdateAdminForm();
$this->UpdateForm->reset()
    ->setModel($form)
    ->setData($data)
    ->setAttribute('autocomplete', 'off')
    ->addElement(array(
        'id' => 'id',
        'type' => 'hidden',
        'label' => __('id'),
    ))
    ->addElement(array(
        'id' => 'login',
        'label' => __('LABEL_ADMIN_LOGIN_ID'),
        'required' => true,
        'readonly' => !empty($id),
    ))
    ->addElement(array(
        'id' => 'name',
        'label' => __('LABEL_NAME'),
        'autocomplete' => 'off',
        'required' => true,
    ))
    ->addElement(array(
        'id' => 'admin_type',
        'label' => __('LABEL_ADMIN_TYPE'),
        'options' => Configure::read('Config.searchAdminType'),
        'empty' => Configure::read('Config.StrChooseOne'),
        'required' => true
    ));
    // case add new admin
    if (empty($id)) {
        $this->UpdateForm
            ->addElement(array(
                'id' => 'password',
                'type' => 'password',
                'autocomplete' => 'off',
                'label' => __('LABEL_PASSWORD')
            ))
            ->addElement(array(
                'id' => 'password_confirm',
                'type' => 'password',
                'label' => __('LABEL_CONFIRM_PASSWORD')
            ));
    }
    $this->UpdateForm
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
        // Call API to Login
        $data['login_id'] = !empty($data['login']) ? $data['login'] : '';
        $id = Api::call(Configure::read('API.url_admins_addupdate'), $data);
        if (!empty($id) && !Api::getError()) {
            // Update current logged-in
            $user = $this->Auth->user();
            if ($id == $user['id']) {
                $user['login_id'] = $data['login_id'];
                $user['name'] = $data['name'];
                $user['admin_type'] = $data['admin_type'];
                $user['display_name'] = !empty($data['name']) ? $data['name'] : $data['login_id'];
                
                $this->Auth->setUser($user);
                $this->AppUI = $user;
            }
            
            $this->Flash->success(__('MESSAGE_SAVE_OK'));
            return $this->redirect("/{$this->controller}/update/{$id}");
        } else {
            return $this->Flash->error(__('MESSAGE_SAVE_NG'));
        }
    }
}
