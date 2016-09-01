<div class="popup_wrap" id="popup_wrap_filter">
    <div id="filter_form">
        <div class="popup_title">条件絞り込み</div>
        <div class="filter_panel">
            <ul id="filter_list">
                <li class="panel" data-key="area" data-value="">
                    <div class="display_table" data-toggle="collapse" data-parent="#filter_list" href="#filter_select_area">
                        <div class="display_row">
                            <div class="display_cell filter_label">エリア</div>
                            <div class="display_cell filter_value_text"><div>新宿区</div></div>
                            <div class="display_cell filter_arrow"></div>
                        </div>
                    </div>
                    
                    <ul id="filter_select_area" class="filter_select collapse">
                        <li data-value="1">新宿区</li>
                        <li data-value="2">Area 1</li>
                        <li data-value="3">Area 2</li>
                        <li data-value="4">Area 3</li>
                    </ul>
                </li>
                <li class="panel" data-key="category" data-value="">
                    <div class="display_table" data-toggle="collapse" data-parent="#filter_list" href="#filter_select_category">
                        <div class="display_row">
                            <div class="display_cell filter_label">職種</div>
                            <div class="display_cell filter_value_text"><div>接客</div></div>
                            <div class="display_cell filter_arrow"></div>
                        </div>
                    </div>
                    
                    <ul id="filter_select_category" class="filter_select collapse">
                        <li data-value="1">接客</li>
                        <li data-value="2">Category 1</li>
                        <li data-value="3">Category 2</li>
                        <li data-value="4">Category 3</li>
                    </ul>
                </li>
                
                <li class="panel" data-key="treatment" data-value="">
                    <div class="display_table" data-toggle="collapse" data-parent="#filter_list" href="#filter_select_treatment">
                        <div class="display_row">
                            <div class="display_cell filter_label">条件・待遇</div>
                            <div class="display_cell filter_value_text"><div>駅ちか</div></div>
                            <div class="display_cell filter_arrow"></div>
                        </div>
                    </div>
                    
                    <ul id="filter_select_treatment" class="filter_select collapse">
                        <li data-value="1">駅ちか</li>
                        <li data-value="2">Treatment 1</li>
                        <li data-value="3">Treatment 2</li>
                        <li data-value="4">Treatment 3</li>
                    </ul>
                </li>
                
                <li class="panel" data-key="service" data-value="">
                    <div class="display_table" data-toggle="collapse" data-parent="#filter_list" href="#filter_select_service">
                        <div class="display_row">
                            <div class="display_cell filter_label">勤務期間</div>
                            <div class="display_cell filter_value_text"><div>長期</div></div>
                            <div class="display_cell filter_arrow"></div>
                        </div>
                    </div>
                    
                    <ul id="filter_select_service" class="filter_select collapse">
                        <li data-value="1">長期</li>
                        <li data-value="2">Service 1</li>
                        <li data-value="3">Service 2</li>
                        <li data-value="4">Service 3</li>
                    </ul>
                </li>
                
                <li class="panel" data-key="payroll" data-value="">
                    <div class="display_table" data-toggle="collapse" data-parent="#filter_list" href="#filter_select_payroll">
                        <div class="display_row">
                            <div class="display_cell filter_label">給与</div>
                            <div class="display_cell filter_value_text"><div>￥1000〜</div></div>
                            <div class="display_cell filter_arrow"></div>
                        </div>
                    </div>
                    
                    <ul id="filter_select_payroll" class="filter_select collapse">
                        <li data-value="1">￥1000〜</li>
                        <li data-value="2">Payroll 1</li>
                        <li data-value="3">Payroll 2</li>
                        <li data-value="4">Payroll 3</li>
                    </ul>
                </li>
                
                <li class="panel" data-key="employment" data-value="">
                    <div class="display_table" data-toggle="collapse" data-parent="#filter_list" href="#filter_select_employment">
                        <div class="display_row">
                            <div class="display_cell filter_label">雇用形態</div>
                            <div class="display_cell filter_value_text"><div>アルバイト</div></div>
                            <div class="display_cell filter_arrow"></div>
                        </div>
                    </div>
                    
                    <ul id="filter_select_employment" class="filter_select collapse">
                        <li data-value="1">アルバイト</li>
                        <li data-value="2">Employment 1</li>
                        <li data-value="3">Employment 2</li>
                        <li data-value="4">Employment 3</li>
                    </ul>
                </li>
            </ul>
        </div>
        
        <div class="filter_keyword">
            <div class="filter_keyword_label">フリーワードで探す</div>
            <input id="filter_keyword_txt" type="text" name="data[Search][p]" value="" placeholder="ワードを入力してください"/>
        </div>
        
        <div class="filter_btns overflow_hidden">
            <div id="btn_filter_clear"></div>
            <div id="btn_filter_search"></div>
        </div>
        
        <div class="popup_close" id="filter_form_close">
            <img src="<?php echo BASE_URL ?>/img/icon_close.png" title="" alt=""/>
        </div>
    </div>
</div>