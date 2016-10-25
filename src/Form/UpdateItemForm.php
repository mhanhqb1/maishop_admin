<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Validation\Validator;

class UpdateItemForm extends Form {

    /**
     * Build Validator
     * 
     * @param Validator $validator
     * @return Validator object
     */
    protected function _buildValidator(Validator $validator) {
        return $validator
            ->notEmpty('name', __('MESSAGE_REQUIRED_NAME'))
            ->allowEmpty('image')
            
            ->add('image', [
                'fileSize' => [
                    'rule' => [
                        'fileSize', '<=', '10MB'
                    ],
                    'message' => sprintf(__('MESSAGE_UPLOAD_FILE_SIZE'), '10MB')
                ],
                'mimeType' => [
                    'rule' => [
                        'mimeType', ['image/png', 'image/jpg', 'image/jpeg']
                    ],
                    'message' => __('MESSAGE_UPLOAD_FILE_TYPE')
                ]
            ])
        ;
    }

}
