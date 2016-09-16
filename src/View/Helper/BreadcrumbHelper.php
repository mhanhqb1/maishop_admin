<?php
namespace App\View\Helper;
/**
 * 
 * Breadcrumb Helper - render breadcrumb html
 * @package View.Helper
 * @created 2014-11-30
 * @version 1.0
 * @author thailvn
 * @copyright Oceanize INC
 */
class BreadcrumbHelper extends AppHelper {

    /** @var array $helpers Use helpers */
    public $helpers = array('Html');

    /**
     * Render breadcrumb html
     *     
     * @author thailvn   
     * @param array $breadcrumb List breadcrumb     
     * @param string $title Page title     
     * @return string Html 
     */
    function render($breadcrumb = array(), $title = '') {

        if (empty($breadcrumb)) {
            return false;
        }
        if (empty($title)) {
            $title = __('Dashboard');
        }
        $homeUrl = BASE_URL.'/';
        $html = "<h1>{$title} <!-- <small>...</small> --></h1>";
        $html .= "<ol class=\"breadcrumb\">";
        $html .= "<li><a href=\"{$homeUrl}\"fa fa-dashboard\"></i> " . __('Home') . "</a></li>";
        foreach ($breadcrumb as $item) {
            if (!isset($item['link'])) {
                $item['link'] = $this->request->here;
            }
            if (empty($item['link'])) {
                $item['link'] = '#';
            }
            if (!empty($item['name'])) {
                $html .= "<li><a href=\"{$item['link']}\">{$item['name']}</a></li>";
            }
        }
        $html .= "</ol>";
        return $html;
    }

}
