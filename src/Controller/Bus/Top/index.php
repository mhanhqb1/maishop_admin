<?php

use App\Lib\Api;
use Cake\Core\Configure;
$param = array(
    'get_new_products' => 1,
    'get_new_orders' => 1,
);
$url = Configure::read('API.url_reports_general');
$data = Api::call($url, $param);
$this->set('data', $data);
