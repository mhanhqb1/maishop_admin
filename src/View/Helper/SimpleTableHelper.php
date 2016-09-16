<?php
namespace App\View\Helper;
/**
 * Render table html
 * 
 * @package View.Helper
 * @created 2014-11-17
 * @updated 2015-04-09
 * @version 1.0.1
 * @author thailh
 * @copyright Oceanize INC
 */
class SimpleTableHelper extends AppHelper {

    /** @var array $helpers Use helpers */
    public $helpers = array('Form', 'Html', 'Common');

    /**
     * Create input text/textarea/select/file    
     * @param array $item   
     * @param int $option (0: normail; 1: generate dynamic input base on data type)  
     * @return string Html
     */
    function input($item, $option = 0) {
        $attr = array();
        if (!isset($item['name'])) {
            $item['name'] = $item['id'];
        }
        $attr[] = "name=\"{$item['name']}\"";
        if (in_array($item['type'], array('text', 'checkbox'))) {
            $attr[] = "value=\"{$item['value']}\"";
            if ($item['type'] == 'checkbox' && $item['value'] == 1 && $option == 1) {
                $attr[] = "checked=\"checked\"";
            }
        }
        if (in_array($item['type'], array('image', 'video'))) {
            $attr[] = "type=\"file\"";
        } else {
            $attr[] = "type=\"{$item['type']}\"";
        }
        foreach ($item as $k => $v) {
            if (is_string($v) && in_array($k, array('readonly', 'id', 'name', 'value', 'class', 'style', 'width', 'height', 'rows', 'cols'))) {
                $attr[] = "{$k}=\"{$v}\"";
            }
        }
        $attr = implode(' ', $attr);
        if ($item['type'] == 'text') {
            return "<div class=\"td_input_text\"><input {$attr}/></div>";
        } elseif ($item['type'] == 'textarea') {
            return "<div class=\"td_textarea\"><textarea {$attr}>{$item['value']}</textarea></div>";
        } elseif ($item['type'] == 'checkbox') {
            return "<div class=\"td_input_checkbox\"><input {$attr} /></div>";
        } elseif ($item['type'] == 'image') {
            $html = "<div class=\"td_file\"><input {$attr} /></div>";
            if (!empty($item['value'])) {
                $html .= "<div class=\"td_img\"><img style=\"margin-top:5px;width:100px;\" src=\"{$this->Common->thumb($item['value'], '100x100')}\" /></div>";
            }
            return $html;
        } elseif ($item['type'] == 'select') {
            $select = "<div class=\"td_select\"><select {$attr}>";
            foreach ($item['options'] as $optionVal => $optionTxt) {
                $selected = '';
                if ($optionVal == $item['value']) {
                    $selected = "selected=\"selected\"";
                }
                $select .= "<option {$selected} value=\"{$optionVal}\">{$optionTxt}</option>";
            }
            return "{$select}</select></div>";
        }
        return '';
    }

    /**
     * Render table html    
     * @author thailh 
     * @param array $table Table information   
     * @return string Html
     */
    function render($table) {
        //$controller = $this->request->params['controller'];
        $modelName = $table['modelName'];
        $columns = $table['columns'];
        $dataset = $table['dataset'];
        if (empty($columns)) {
            return false;
        }
        $html = "<div class=\"form-body\">";
        $html .= $this->Form->create($modelName, array(
            'class' => 'form-table',
            'enctype' => 'multipart/form-data',
            'id' => 'dataForm',
        ));
        $html .= "<table class=\"table table-hover\">";
        foreach ($columns as $i => $item) {
            if (empty($item['id'])) {
                $columns[$i]['id'] = 'ID' . time() . rand(1000, 9999);
            }
            if (empty($item['type'])) {
                $columns[$i]['type'] = '';
            }
            if (empty($item['title'])) {
                $columns[$i]['title'] = '';
            }
            if (empty($item['value'])) {
                $columns[$i]['value'] = '';
            }
            if ($columns[$i]['type'] == 'link' && !isset($item['href'])) {
                $columns[$i]['href'] = '#';
            }
            if (empty($item['link'])) {
                $columns[$i]['link'] = '';
            }
            if (!empty($item['href'])) {
                $columns[$i]['href'] = $item['href'];
            }
        }       
        
        $hidden = array();
        foreach ($columns as &$item) {
            $value = "";
            if ($item['type'] == 'hidden') {
                continue;
            }
            if ($item['type'] == 'checkbox' && empty($item['title'])) {
                $value .= "<th class=\"checkbox_{$item['id']}\"><input type=\"checkbox\" onclick=\"checkAll('{$item['name']}', this.checked ? 1 : 0)\" /></th>";
                $html .= $value;
                continue;
            }
            $options = array();
            $td_options = array();
            foreach ($item as $attrKey => $attrVal) {
                if ($attrKey == 'width') {
                    $options[] = "{$attrKey}=\"{$attrVal}\"";
                }
                if (in_array($attrKey, array('align'))) {
                    $td_options[] = "{$attrKey}=\"{$attrVal}\"";
                    unset($item[$attrKey]);
                }
            }
            $options = !empty($options) ? implode(' ', $options) : '';
            $item['td_options'] = !empty($td_options) ? implode(' ', $td_options) : '';
            $thTitle = $item['title'];
            if (isset($item['th_title'])) {
                $thTitle = $item['th_title'];
                unset($item['th_title']);
            }
            $value .= "<th {$options} {$item['td_options']}>{$thTitle}</th>";
            if (!empty($item['hidden'])) {
                $hidden[$item['id']] = true;
            } else {
                $html .= $value;
            }
        }       
        unset($item);
        $rows = array();      
        foreach ($dataset as $data) {
            $row = array();
            foreach ($columns as $item) {        
                if (isset($item['empty']) && empty($data[$item['id']])) {
                    if ($item['type'] != 'checkbox' && empty($item['toggle'])) {
                        $data[$item['id']] = $item['empty'];
                    }
                }
                $search = $replace = array();
                foreach ($data as $fld => $val) {
                    if (is_array($val)) {
                        continue;
                    }
                    $search[] = '{' . $fld . '}';
                    $replace[] = $val;
                }
                if ($item['type'] == 'hidden') {
                    continue;
                }
                $options = array();
                foreach ($item as $attrKey => $attrVal) {
                    if (!in_array($attrKey, array(
                                'id',
                                'title',
                                'type',
                                'link',
                                'rules',
                                'options',
                                'td_options',
                                'hidden',
                            ))) {
                        $attrVal = str_replace($search, $replace, $attrVal);
                        if (is_scalar($attrVal)) {
                            if ($attrKey == 'src') {
                                $attrVal = $this->Common->thumb($attrVal, '60x60');
                            }
                            if (!empty($attrVal)) {
                                $options[] = "{$attrKey}=\"{$attrVal}\"";
                            }
                        }
                    }
                }
                if (!empty($item['name'])) {
                    $item['name'] = str_replace($search, $replace, $item['name']);
                }
                if (!empty($item['value'])) {
                    $item['value'] = str_replace($search, $replace, $item['value']);
                }
                if (!empty($item['style'])) {
                    $item['style'] = str_replace($search, $replace, $item['style']);
                }
                if (!isset($data[$item['id']])) {
                    $data[$item['id']] = !empty($item['empty']) ? $item['empty'] : $item['title'];
                }
                if (!empty($item['rules']) && is_array($item['rules'])) {
                    // support for setting, generate dynamic inputs     
                    foreach ($item['rules'] as $ruleKey => $ruleValue) {
                        if (is_array($ruleValue)) {
                            $ruleValue['name'] = $item['name'];
                            $ruleValue['value'] = $data[$item['id']];
                            $item['rules'][$ruleKey] = $this->input($ruleValue, 1);
                        }
                    }
                    
                    // KienNH 2016/05/13 begin
                    //$data[$item['id']] = str_replace(array_keys($item['rules']), array_values($item['rules']), $tmp);// Old code
                    $tmp = $data[!empty($item['value']) ? $item['value'] : $item['id']];
                    $data[$item['id']] = $tmp;
                    if (!empty($item['rules'])) {
                        foreach ($item['rules'] as $_rule_key => $_rule_value) {
                            if ($_rule_key == $tmp) {
                                $data[$item['id']] = $_rule_value;
                                break;
                            }
                        }
                    }
                    // KienNH end
                }
                $value = $data[$item['id']];
                if ($item['type'] == 'url' && $value != '' && Validation::url($value)) {
                    $item['type'] = 'link';
                    $options['href'] = "href=\"{$value}\"";
                }
                $options = !empty($options) ? implode(' ', $options) : '';
                if ($item['type'] == 'link') {
                    if ($data[$item['id']] != '') {
                        // KienNH 2016/04/24 begin custom
                        if (isset($item['custom_link']) && $item['custom_link']) {
                            if ((isset($item['empty']) && $item['empty'] == $data[$item['id']]) || empty($data[$item['id']])) {
                                $value = !empty($item['empty']) ? $item['empty'] : $item['title'];
                            } else {
                                if (isset($item['button']) && $item['button']) {
                                    $value = "<a {$options}><span class=\"label label-primary\">{$item['title']}</span></a>";
                                } else {
                                    $value = "<a {$options}>{$item['title']}</a>";
                                }
                            }
                        } else {
                            // Old code
                            if (isset($item['button'])) {
                                $value = "<a {$options}><span class=\"label label-primary\">{$data[$item['id']]}</span></a>";
                            } else {
                                $value = "<a {$options}>{$data[$item['id']]}</a>";
                            }
                        }
                        // KienNH end
                    }
                }
                if ($item['type'] == 'image') {
                    $value = "<img {$options} />";
                }
                // KienNH 2016/05/13 begin
                if ($item['type'] == 'image_lightbox') {
                    // Get big image for popup
                    $lb_src = !empty($item['src_big']) && !empty($data[$item['src_big']]) ? $data[$item['src_big']] : '';
                    if (empty($lb_src)) {
                        if (!empty($item['src'])) {
                            $lb_src = str_replace(array('{', '}'), array('', ''), $item['src']);
                            $lb_src = !empty($data[$lb_src]) ? $data[$lb_src] : '';
                        }
                    }
                    
                    // Build html
                    if (empty($lb_src)) {
                        // Normal image
                        $value = "<img {$options} />";
                    } else {
                        // Lightbox
                        $data_lightbox = !empty($item['data-lightbox']) ? $item['data-lightbox'] : microtime(true);
                        $value  = '<a href="' . htmlspecialchars($lb_src) . '" data-lightbox="' . htmlspecialchars($data_lightbox) . '" target="_blank">';
                        $value .= "<img {$options} />";
                        $value .= '</a>';
                    }
                }
                // KienNH end
                if ($item['type'] == 'date') {
                    $value = self::getCommonComponent()->dateFormat($value);
                }
                if ($item['type'] == 'datetime') {
                    $value = self::getCommonComponent()->dateTimeFormat($value);
                }
                if (in_array($item['type'], array('text', 'checkbox', 'select', 'video'))) {
                    if ($item['type'] == 'checkbox' && !empty($item['toggle'])) {
                        $toggle_options ='';
                        if (!isset($data['id'])) {
                            $data['id'] = '0';
                        }
                        if (!isset($item['class'])) {
                            $item['class'] = "toggle-event";
                        }
                        if (!isset($item['toggle-onstyle'])) {
                            $item['toggle-onstyle'] = "primary";
                        }
                        if (isset($item['toggle-options']) ){
                            foreach($item['toggle-options'] as $toggle_key =>$toggle_val ){
                                $toggle_options .= " {$toggle_key} = \"$toggle_val\"";
                            }
                        }
                        $checked = $data[$item['id']];
                        $value = "<input value=\"{$data['id']}\" class=\"{$item['class']}\" {$checked} type=\"checkbox\" data-toggle=\"toggle\" data-onstyle=\"{$item['toggle-onstyle']}\" data-style=\"ios\" data-size=\"mini\" {$toggle_options}>";
                    } else {
                        $value = $this->input($item);
                    }
                }
                if ($item['type'] == 'has_media') {
                    if(isset($item['media_options'])){
                        if(isset($item['media_options']['element'])){
                            $element_data = array('key'=>$item['id'],'data'=>$data);
                            $value = $this->_View->element($item['media_options']['element'], $element_data);
                        }
                    }
                }
                $icon_class="";
                if ($item['type'] == 'icon') {                    
                    if(isset($item["icon_prefix"])){
                        $icon_class .= $item["icon_prefix"];
                    }
                    if(isset($item["icon_valiations"])){
                        $icon_class .= $item["icon_valiations"][$data[$item["id"]]];
                    }else{
                        $icon_class .= $data[$item['id']];
                    }
                    $value = "<i class=\"{$icon_class}\"></i> ";
                }
                $row[$item['id']] = array(
                    'options' => !empty($item['td_options']) ? $item['td_options'] : '',
                    'value' => $value
                );
            }
            $rows[] = $row;
        }

        foreach ($rows as $i => $row) {
            $html .= "<tr>";
            foreach ($row as $field => $rowItem) {               
                if (!empty($hidden[$field])) {
                    continue;
                }
                $value = $rowItem['value'];               
                if (isset($table['merges'][$field])) {
                    foreach ($table['merges'][$field] as $merge) {  
                        if (empty($row[$merge['field']]['value'])) continue;
                        //$value .= '<div class="mt5">';
                        $value .= '<div class="">';

                        if (is_string($merge)) {
                            $value .= $row[$merge];
                        } else {
                            if (!empty($merge['before'])) {
                                $value .= $merge['before'];
                            }
                            $value .= $row[$merge['field']]['value'];
                            if (!empty($merge['after'])) {
                                $value .= $merge['after'];
                            }
                        }
                        $value .= '</div>';
                    }
                }
                $html .= "<td {$rowItem['options']}>{$value}</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        unset($row);
        unset($rows);
        unset($hidden);
        if (!empty($table['buttons'])) {
            $html .= "<div class=\"form-group button-group\">";
            foreach ($table['buttons'] as $control) {
                if (empty($control['type']) || $control['type'] != 'submit') {
                    continue;
                }
                if (isset($control['type'])) {
                    unset($control['type']);
                }
                $html .= $this->Form->submit($control['value'], $control);
            }
            $html .= "</div>";
        }
        if (!empty($table['hiddens'])) {
            foreach ($table['hiddens'] as $control) {
                if (empty($control['name'])) {
                    $control['name'] = $control['id'];
                }
                if (empty($control['type'])) {
                    $control['type'] = 'hidden';
                }
                $html .= $this->Form->input($control['id'], $control);
            }
        }
        unset($table);
        $html .= $this->Form->input('action', array(
            'type' => 'hidden',
            'name' => 'action',
            'id' => 'action',
        ));
        $html .= $this->Form->input('action', array(
            'type' => 'hidden',
            'name' => 'actionId',
            'id' => 'actionId',
        ));
        $html .= $this->Form->end();
        $html .= "</div>";        
        return $html;
    }

}
