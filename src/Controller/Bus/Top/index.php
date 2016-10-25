<?php

use App\Lib\Api;
use Cake\Core\Configure;

$url = Configure::read('API.url_reports_general');
$data = Api::call($url, array());
$this->set('data', $data);
