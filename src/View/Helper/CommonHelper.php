<?php

namespace App\View\Helper;

/**
 * 
 * Some common helper
 * @package View.Helper
 * @created 2014-11-30
 * @version 1.0
 * @author thailvn
 * @copyright Oceanize INC
 */
class CommonHelper extends AppHelper {

    /** @var array $helpers Use helpers */
    public $helpers = array('Text', 'Form');
    
    /**
     * Get thumb image url
     *     
     * @author thailvn
     * @param string $fileName File name
     * @param string $size Thumb size     
     * @return string Thumb image url  
     */
    function thumb($fileName, $size = null, $type = null) {
        return $this->getCommonComponent()->thumb($fileName, $size, $type);
    }
    
    /**
     * search backwards starting from haystack length characters from the end
     */
    function startsWith($haystack, $needle) {
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
    
    /**
     * search forward starting from end minus needle length characters
     */
    function endsWith($haystack, $needle) {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }
    
}
