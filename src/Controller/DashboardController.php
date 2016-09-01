<?php

/* 
 * Dashboard Controller
 */

namespace App\Controller;
use App\Lib\Api;
use Cake\Core\Configure;

class DashboardController extends AppController {
    
    public function index() {
        $this->set('pageHeader', 'Dashboard');
    }
    
}
