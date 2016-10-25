<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Validation\Validator;

class ExportForm extends Form {

    /**
     * Build Validator
     * 
     * @param Validator $validator
     * @return Validator object
     */
    protected function _buildValidator(Validator $validator) {
        return $validator
            ->allowEmpty('date_from')
            ->date('date_from', 'ymd', sprintf(__('MESSAGE_FORMAT_INVALID'), __('LABEL_DATE_FROM')))
            
            ->allowEmpty('date_to')
            ->date('date_to', 'ymd', sprintf(__('MESSAGE_FORMAT_INVALID'), __('LABEL_DATE_TO')))
            
            ->add('date_to', 'custom', [
                'rule' => function ($value, $context) {
                    if (!empty($value) && !empty($context['data']['date_from']) && $value < $context['data']['date_from']) {
                        return false;
                    }
                    return true;
                },
                'message' => __('MESSAGE_INVALID_DATE_FROM_TO'),
                'last' => true,
            ])
        ;
    }

}
