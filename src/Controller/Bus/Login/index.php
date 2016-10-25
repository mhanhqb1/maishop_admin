<?php

use App\Form\LoginForm;
use App\Lib\Api;
use Cake\Core\Configure;

// Check remember userName and password
$rememberAdminCookie = 'remember_admin_cookie';
if (empty($this->AppUI->id)) {
    if ($this->Cookie->read($rememberAdminCookie)) {
        $loginCookie = $this->Cookie->read($rememberAdminCookie);
    }
}

// Login form
$form = new LoginForm();
$loginForm = $this->SimpleForm->reset();
$loginForm->setModel($form)
    ->setAttribute('type', 'post')
    ->addElement(array(
        'id' => 'login',
        'label' => false,
        'value' => empty($loginCookie['login']) ? '' : $loginCookie['login'],
        'placeholder' => __('LABEL_LOGIN_ID'),
        'error' => ['Not long enough' => __('This is not long enough')]
    ))
    ->addElement(array(
        'id' => 'password',
        'type' => 'password',
        'label' => false,
        'value' => empty($loginCookie['admin_password']) ? '' : $loginCookie['admin_password'],
        'placeholder' => __('LABEL_PASSWORD')
    ))
    ->addElement(array(
        'id' => 'remembera',
        'type' => 'checkbox',
        'value' => '1',
        'checked' => empty($loginCookie['remembera']) ? false : $loginCookie['remembera'] == 1,
        'label' => __('LABEL_REMEMBER_ME'),
    ))
    ->addElement(array(
        'type' => 'submit',
        'value' => __('LABEL_LOGIN'),
        'class' => 'btn bg-capture-red btn-block',
        'style' => 'width:320px;',
    ));

// Valdate and login
if ($this->request->is('post')) {
    // Trim data
    $data = $this->request->data();
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
    }
    
    // Validation
    if ($form->validate($data)) {
        // Call API to Login
        $param = array(
            'login_id' => $data['login'],
            'password' => $data['password']
        );
        $user = Api::call(Configure::read('API.url_admins_login'), $param);
        if (Api::getError() || empty($user)) {
            $this->Flash->error(__('MESSAGE_LOGIN_FAIL'));
        } else {
            // Auth
            unset($user['password']);
            
            $user['is_admin'] = !empty($user['admin_type']) ? 1 : 0;
            $user['display_name'] = !empty($user['name']) ? $user['name'] : $user['login_id'];
            $this->Auth->setUser($user);
            
            // Did they select the remember me checkbox?
            if (!empty($data['remembera'])) {
                $data['admin_password'] = $data['password'];
                unset($data['password']);
                $this->Cookie->write($rememberAdminCookie, $data, true, '2 weeks');
            }
            
            return $this->redirect($this->Auth->redirectUrl());
        }
    }
}

// Set data for view
$this->set('loginForm', $loginForm->get());
