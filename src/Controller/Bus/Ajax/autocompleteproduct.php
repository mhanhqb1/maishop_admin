<?php

use App\Lib\Api;
use App\Lib\Log\AppLog;
use Cake\Core\Configure;

$param = $this->request->data;
$data = Api::call(Configure::read('API.url_products_autocomplete'), $param);
if (empty($data) || Api::getError()) {
    echo 'a';
    exit();
} else {
    echo 'sadasd';
    print_r($data);
    $this->set('data', $data);
}
