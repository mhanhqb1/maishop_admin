<?php

/* 
 * Dashboard Controller
 */

namespace App\Controller;
use App\Lib\Api;
use Cake\Core\Configure;
use Cake\I18n\I18n;

class DashboardController extends AppController {
    
    public function index() {
        I18n::locale('de');
        $this->set('pageHeader', 'Dashboard');
    }
    
}
