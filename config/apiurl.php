<?php

/**
 * API's Url
 */
use Cake\Core\Configure;

Configure::write('API.Host', '');
Configure::write('API.Timeout', 60);
Configure::write('API.secretKey', 'maishop');
Configure::write('API.rewriteUrl', array());

Configure::write('API.url_admins_login', 'admins/login');
Configure::write('API.url_admins_list', 'admins/list');
Configure::write('API.url_admins_detail', 'admins/detail');
Configure::write('API.url_admins_addupdate', 'admins/addUpdate');
Configure::write('API.url_admins_updatepassword', 'admins/updatePassword');

Configure::write('API.url_reports_general', 'reports/general');
Configure::write('API.url_reports_export', 'reports/export');

Configure::write('API.url_itemsets_list', 'itemsets/list');
Configure::write('API.url_itemsets_detail', 'itemsets/detail');
Configure::write('API.url_itemsets_addupdate', 'itemsets/addupdate');

Configure::write('API.url_items_list', 'items/list');
Configure::write('API.url_items_detail', 'items/detail');
Configure::write('API.url_items_addupdate', 'items/addupdate');

Configure::write('API.url_products_list', 'products/list');
Configure::write('API.url_products_addupdate', 'products/addupdate');
Configure::write('API.url_products_detail', 'products/detail');
Configure::write('API.url_products_all', 'products/all');
Configure::write('API.url_products_autocomplete', 'products/autocomplete');

Configure::write('API.url_productimages_list', 'productimages/list');
Configure::write('API.url_productimages_addupdate', 'productimages/addupdate');

Configure::write('API.url_orders_list', 'orders/list');
Configure::write('API.url_orders_addupdate', 'orders/addupdate');
Configure::write('API.url_orders_detail', 'orders/detail');
Configure::write('API.url_orders_all', 'orders/all');

Configure::write('API.url_categories_list', 'categories/list');
Configure::write('API.url_categories_detail', 'categories/detail');
Configure::write('API.url_categories_addupdate', 'categories/addupdate');
