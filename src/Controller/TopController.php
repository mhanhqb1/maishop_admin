<?php

/* 
 * Top page
 */

namespace App\Controller;
use App\Lib\Api;
use Cake\Core\Configure;

class TopController extends AppController {
    
    public function index() {
        $data = Api::call(Configure::read('API.url_versions_check'), array());
        print_r($data);
        exit();
    }
    
}
