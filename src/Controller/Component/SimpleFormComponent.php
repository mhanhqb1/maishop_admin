<?php

namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\Network\Request;

/**
 * 
 * Parent form for search form and update form
 * @package Controller
 * @created 2014-11-27 
 * @version 1.0
 * @author thailvn
 * @copyright Oceanize INC
 */
class SimpleFormComponent extends AppComponent {

    /** @var string $_modelName Model name */
    protected $_modelName = null;

    /** @var array $_data Form data */
    protected $_data = null;

    /** @var array $_attributes Default attributes */
    protected $_attributes = array(
        'role' => 'form',
        'type' => 'post',
        'enctype' => 'multipart/form-data',
        'inputDefaults' => array(
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => array('class' => 'form-group'),
            'label' => array(),
            'between' => false,
            'after' => false,
            'class' => 'form-control',
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')),
        )
    );

    /** @var array $_form Form information */
    protected $_form = array();

    /**
     * Set model name
     *     
     * @author thailvn   
     * @param string $name Name     
     * @return self 
     */
    public function setModelName($name) {
        $this->_modelName = $name;
        return $this;
    }

    /**
     * Get model name
     *    
     * @author thailvn        
     * @return string Model name
     */
    public function getModelName() {
        return $this->_modelName;
    }

    /**
     * Set form data
     *    
     * @author thailvn  
     * @param array $data Data to set to form
     * @return self
     */
    public function setData($data) {
        $this->_data = $data;
        return $this;
    }

    /**
     * Get form data
     *   
     * @author thailvn        
     * @return array Form data
     */
    public function getData() {
        if (empty($this->_data[$this->_modelName]))
            return array();
        return $this->_data[$this->_modelName];
    }

    /**
     * Set attribute
     *    
     * @author thailvn        
     * @param string $name Attribute name       
     * @param string $value Attribute value       
     * @param boolean $inputDefaults If true set inputDefaults else set normal      
     * @return self
     */
    public function setAttribute($name, $value, $inputDefaults = false) {
        if ($inputDefaults == false) {
            $this->_attributes[$name] = $value;
        } else {
            $this->_attributes['inputDefaults'][$name] = $value;
        }
        return $this;
    }

    /**
     * Get list attribute
     *     
     * @author thailvn
     * @return array List attributes
     */
    public function getAttributes() {
        return $this->_attributes;
    }

    /**
     * Add a element to form
     *     
     * @author thailvn
     * @param array $item Element information
     * @return self
     */
    public function addElement($item) {
        $request = $this->request;
        $data = $this->getData();
        if ($request->is('get')) {
            $data = array_merge($data, $request->query);
        }
        if ($request->is('post') && isset($request->data[$this->_modelName])) {
            foreach ($request->data[$this->_modelName] as $key => $value) {
                if (is_scalar($value)) {
                    $data[$key] = $value;
                }
            }
        }
        if (isset($item['id']) && isset($data[$item['id']])) {
            $item['value'] = $data[$item['id']];
        }
        if (isset($item['id']) && isset($item['type']) && $item['type'] != 'hidden' && preg_match('/_id$/', $item['id'])) {
            $item['id'] = str_replace('_id', '_customid', $item['id']);
        }
        if (!empty($item['calendar']) && !empty($item['value']) && is_numeric($item['value'])) {
            $item['value'] = date('Y-m-d', $item['value']);
        }
        $this->_form[] = $item;
        return $this;
    }

    /**
     * Get information of a form
     *    
     * @author thailvn     
     * @return array Form information
     */
    public function get() {
        return array(
            'modelName' => $this->_modelName,
            'attributes' => $this->_attributes,
            'elements' => $this->_form
        );
    }

    /**
     * Reset a form (for create muiltiple forms on a page) 
     *    
     * @author thailvn     
     * @return self
     */
    public function reset() {
        $this->_form = array();
        return $this;
    }

    /**
     * Remove a element
     *     
     * @author thailvn     
     * @param string $id Element ID
     * @return self
     */
    public function removeElement($id) {
        foreach ($this->_form as $i => $element) {
            if (isset($element['id']) && $element['id'] == $id) {
                unset($this->_form[$i]);
            }
        }
        return $this;
    }

}
