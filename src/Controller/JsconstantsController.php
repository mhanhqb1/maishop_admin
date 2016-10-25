<?php

/*
 * Description : Class contain constants value for Javascript
 * User        : KienNH
 * Date created: 2016/09/08
 */

namespace App\Controller;

use Cake\Event\Event;

class JsconstantsController extends AppController {

    /**
     * Load library
     */
    function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
        $this->autoRender = FALSE;
    }

    /**
     * Define constant for Javascript
     */
    function index() {
        Header("content-type: application/x-javascript; charset=utf-8");
        echo "var BASE_URL = '" . $this->BASE_URL . "';" . PHP_EOL;
        echo "var DEFAULT_SITE_TITLE = '" . DEFAULT_SITE_TITLE . "';" . PHP_EOL;
        echo "var LABEL_CHOOSE_ONE = '" . h(__('LABEL_CHOOSE_ONE')) . "';";
    }

}
