<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Validation\Validator;

class UpdateItemsetForm extends Form {

    /**
     * Build Validator
     * 
     * @param Validator $validator
     * @return Validator object
     */
    protected function _buildValidator(Validator $validator) {
        return $validator
            ->notEmpty('name', __('MESSAGE_REQUIRED_NAME'))
            
            ->notEmpty('price', __('MESSAGE_REQUIRED_PRICE'))
            ->numeric('price', __('MESSAGE_REQUIRED_NUMERIC_INPUT'))
            
            ->notEmpty('stock', __('MESSAGE_REQUIRED_STOCK'))
            ->numeric('stock', __('MESSAGE_REQUIRED_NUMERIC_INPUT'))
        ;
    }

}
