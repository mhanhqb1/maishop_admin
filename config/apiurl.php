<?php

/**
 * API's Url
 */
use Cake\Core\Configure;

Configure::write('API.Timeout', 30);
Configure::write('API.secretKey', 'maishop');
Configure::write('API.rewriteUrl', array());
Configure::write('API.url_versions_check', 'versions/check');
Configure::write('API.url_products_list', 'products/list');