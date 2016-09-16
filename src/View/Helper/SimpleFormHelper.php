<?php
namespace App\View\Helper;
/**
 * 
 * Render form html
 * @package View.Helper
 * @created 2014-11-29
 * @version 1.0
 * @author thailvn
 * @copyright Oceanize INC
 */
class SimpleFormHelper extends AppHelper {

    /** @var array $helpers Use helpers */
    public $helpers = array('Form', 'Html', 'Common');
        
     /**
     * Render form html
     *     
     * @author thailvn
     * @modified Caolp 215/03/31
     * @param array $form Form information
     * @return string Form html
     */
    public function render($form = null) {
        if (empty($form)) {
            return false;
        }
        $html = "<div class=\"form-body\">";
        $html .= $this->Form->create(null, [
            'type' => $form['attributes']['type']
        ]);
        $btnCount = 0;
        foreach ($form['elements'] as $control) {
            if (!isset($control['type'])) {
                $control['type'] = 'input';
            }
            if (!empty($control['label']) && !empty($control['required'])) {
                $control['label'] = $control['label'] . "<span class=\"input-required\">*</span>";
                unset($control['required']);
            }
            if (!empty($control['image']) && !empty($control['value']) && is_string($control['value'])) {
                $imageUrl = $this->Common->thumb($control['value'], '');
                $image = "<div style=\"margin-top:5px;max-width:120px;\"><a href=\"{$imageUrl}\" class=\"js-thumb\">" . $this->Html->image($imageUrl, array('style' => 'width:120px')) . "</a>";
                if (!empty($control['allowEmpty'])) {
                    $image .= "<br/><input name=\"data[{$form['modelName']}][{$control['id']}][remove]\" type=\"checkbox\" value=\"1\"/>&nbsp;" . __('Remove');
                    unset($control['allowEmpty']);
                }
                if (!empty($control['crop'])) {                   
                    $imageInfo = base64_encode(json_encode($control['crop']));
                    $image .= "<a href=\"{$imageInfo}\" class=\"crop-img\">&nbsp;" . __('Edit') . "</a>";
                    unset($control['allowCrop']);
                }
                $image .= "<div class=\"cls\"></div>";
                $image .= "</div>";
                $control['after'] = $image;
                unset($control['image']);
                unset($control['value']);
            }
            if (!empty($control['video']) && !empty($control['value']) && is_string($control['value'])) {
                if (!empty($control['allowEmpty'])) {
                    $control['value'] .= "<br/><input name=\"data[{$form['modelName']}][{$control['id']}][remove]\" type=\"checkbox\" value=\"1\"/>&nbsp;" . __('Remove');
                    unset($control['allowEmpty']);
                }
                $control['after'] = "<div style=\"margin-top:5px;\">{$control['value']}</div>";
                unset($control['video']);
                unset($control['value']);
            }
            $id = !empty($control['id']) ? $control['id'] : microtime() . rand(1000, 9999);
            $controlType = $control['type'];
            if ($controlType == 'submit') {
                $btnCount++;
                continue;
            }
            //Caolp Edited 2015/03/31
            $unsetArray = array(
                'file', 'hidden', 'password', 'textarea', 'checkbox', 'element'
            );
            if (!in_array($control['type'], $unsetArray)) {
                unset($control['type']);
            }
//            if ($controlType !== 'file' && $controlType !== 'hidden' && $controlType !== 'password') {
//                unset($control['type']);
//            }
            if ($controlType == 'custom') {
                $html .= '<label>'.$control['label'].'</label>';
                $html .= $control['options'];
            } elseif ($controlType == 'label') {
                $html .= $this->Form->label($id, implode(' ', $control));
            } elseif ($controlType == 'submit') {
                $html .= $this->Form->submit($control['value'], $control);
            } elseif ($controlType == 'password') {
                $html .= $this->Form->input($control['id'], $control);
            } elseif ($controlType == 'editor') {
                $html .= $this->Common->editor($control);
            } elseif ($controlType == 'checkbox' && $id == 'place_category_type_ids' && is_array($control['options'])) {// KienNH 2016/03/04 custom checkbox for list spot view
                $html .= '<div class="form-group place_category_type_idsContainer">';
                $html .= $this->Form->label($id, $control['label']);
                $html .= $this->Form->select($id, $control['options'], array(
                    'multiple' => 'checkbox',
                    'hiddenField' => false,
                    'value' => !empty($control['value']) ? $control['value'] : array()
                ));
                $html .= '</div>';
            } elseif ($controlType == 'image_lightbox') {// KienNH 2016/07/14
                $html .= $this->Form->label($id, $control['label']);
                $html .= '<div class="images_lightbox">';
                if (empty($control['images_data'])) {
                    $html .= 'なし';
                } else {
                    foreach ($control['images_data'] as $image) {
                        $html .= '<a class="image_lightbox" href="' . htmlspecialchars($image['image_path']) . '" data-lightbox="image_lightbox" target="_blank">';
                        $html .= '<img src="' . htmlspecialchars($image['thm_image_path']) . '" />';
                        $html .= '</a>';
                    }
                }
                $html .= '</div>';
            } elseif ($controlType == 'calendar_from_to' || $controlType == 'text_from_to') {// KienNH 2016/03/07 add new type for search from - to
                $_from = $id . '_from';
                $_to = $id . '_to';
                $_separator = 'form_from_to_separator';
                $_from_value = !empty($this->request->data[$_from]) ? $this->request->data[$_from] : (!empty($this->request->query[$_from]) ? $this->request->query[$_from] : '');
                $_to_value = !empty($this->request->data[$_to]) ? $this->request->data[$_to] : (!empty($this->request->query[$_to]) ? $this->request->query[$_to] : '');
                
                $html .= '<div class="form-group FormFromToContainer">';
                $html .= $this->Form->label($id, $control['label']);
                
                $html .= $this->Form->input($_from, array(
                    'label' => false,
                    'id' => $_from,
                    'value' => $_from_value
                ));
                $html .= '<span class="' . $_separator . '">〜</span>';
                $html .= $this->Form->input($_to, array(
                    'label' => false,
                    'id' => $_to,
                    'value' => $_to_value
                ));
                
                if ($controlType == 'calendar_from_to') {
                    $html .= "<script>
                    $(function() {    
                        $(\"#{$_from}, #{$_to}\").datepicker({
                            format: 'yyyy-mm-dd',                           
                            clearBtn: true,
                            todayHighlight: true,
                            autoclose: true
                        });                         
                    });
                    </script>";
                }
                
                $html .= '</div>';
            } else {
                if (isset($control['autocomplete']) && !empty($control['options'])) {
                    $v = json_encode(array_values($control['options']));
                    if (isset($control['callback'])) {
                        $control['callback'] = "{$control['callback']}(ui.item)";
                    } else {
                        $control['callback'] = '';
                    }
                    $html .= "
                    <script>
                    $(function() {
                        var js_{$control['id']}={$v};                       
                        $(\"#{$control['id']}\").autocomplete({
                            source: js_{$control['id']},
                            select: function(event, ui) {
                                {$control['callback']}
                            },
                        });
                    });
                    </script>";                    
                    $control['autocomplete'] = 'off';
                    unset($control['options']);
                    unset($control['callback']);
                    if (isset($control['empty']))
                        unset($control['empty']);
                }
                if (isset($control['autocomplete_combobox']) && !empty($control['options'])) {
                    $html .= "<script>
                    $(function() {    
                        $(\"#{$control['id']}\").combobox(); 
                    });
                    </script>";
                    unset($control['autocomplete_combobox']);
                    $control['autocomplete'] = 'off';
                }
                if (isset($control['autocomplete_ajax']) && !empty($control['options'])) {
                    $html .= "<script>
                    $(function() {  
                        autocomplete(\"{$control['id']}\", \"{$control['options']['url']}\", {$control['options']['callback']});                        
                    });
                    </script>";
                    unset($control['autocomplete_ajax']);
                    unset($control['options']);
                    $control['autocomplete'] = 'off';
                }
                if (isset($control['calendar'])) {
                    $html .= "<script>
                    $(function() {    
                        $(\"#{$control['id']}\").datepicker({
                            format: 'yyyy-mm-dd',                           
                            clearBtn: true,
                            todayHighlight: true,
                            autoclose: true
                        });                         
                    });
                    </script>";
                    unset($control['calendar']);
                }
                if (isset($control['timepicker'])) {
                    $html .= "<script>
                    $(function(){
                        $(\"#{$control['id']}\").timepicker({
                            showInputs: false,
                            showMeridian: false,
                            minuteStep: 5,
                        });  
                    });
                    </script>";
                    unset($control['timepicker']);
                }
                if ($controlType == 'element' && isset($control['name'])) {
                    $d['data'] = array();
                    if (isset($control['data']))
                        $d['data'] = $control['data'];
                    $html .= $this->_View->element($control['name'], $d);
                } else {
                    $html .= $this->Form->input($id, $control);
                }
            }
        }
        if ($btnCount > 0) {
            $html .= "<div class=\"form-group button-group\">";
            foreach ($form['elements'] as $control) {
                if (empty($control['type']) || $control['type'] != 'submit') {
                    continue;
                }
                if (isset($control['type'])) {
                    unset($control['type']);
                }
                $html .= $this->Form->button($control['value'], $control);
            }
            $html .= "<div class=\"cls\"></div>";
            $html .= "</div>";
        }
        $html .= $this->Form->end();
        $html .= "<div class=\"cls\"></div>";
        $html .= "</div>";
        return $html;
    }

}
