<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Validation\Validator;

class UpdateAdminForm extends Form {

    /**
     * Build Validator
     * 
     * @param Validator $validator
     * @return Validator object
     */
    protected function _buildValidator(Validator $validator) {
        return $validator
            ->notEmpty('login', __('MESSAGE_REQUIRED_LOGIN_ID'))
            ->notEmpty('name', __('MESSAGE_REQUIRED_NAME'))
            ->notEmpty('admin_type', __('MESSAGE_REQUIRED_ADMIN_TYPE'))
            ->notEmpty('password', __('MESSAGE_REQUIRED_LOGIN_PASSWORD'))
            ->notEmpty('password_confirm', __('MESSAGE_REQUIRED_LOGIN_PASSWORD_CONFIRM'))
            ->sameAs('password_confirm', 'password', __('MESSAGE_PASSWORD_CONFIRM_NOT_MATCH'))
        ;
    }

}
