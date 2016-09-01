<div class="popup_wrap" id="popup_wrap_search">
    <div id="search_form">
        <div id="search_form_container">
            <div class="search_form_line">
                <a class="search_form_item" id="search_form_item_opposite_sex" href="<?php echo BASE_URL ?>/search">
                    <div class="search_form_item_txt">異性から探す</div>
                </a>

                <a class="search_form_item" id="search_form_item_classmates" href="<?php echo BASE_URL ?>/search">
                    <div class="search_form_item_txt">同級生から探す</div>
                </a>
            </div>

            <div class="search_form_line">
                <a class="search_form_item" id="search_form_item_university" href="<?php echo BASE_URL ?>/search">
                    <div class="search_form_item_txt">大学から探す</div>
                </a>

                <a class="search_form_item" id="search_form_item_faculty" href="<?php echo BASE_URL ?>/search">
                    <div class="search_form_item_txt">学部から探す</div>
                </a>
            </div>

            <div class="search_form_line">
                <a class="search_form_item" id="search_form_item_year" href="<?php echo BASE_URL ?>/search">
                    <div class="search_form_item_txt">学年から探す</div>
                </a>

                <a class="search_form_item" id="search_form_item_area" href="<?php echo BASE_URL ?>/search">
                    <div class="search_form_item_txt">エリアから探す</div>
                </a>
            </div>

            <div class="search_form_line" id="search_form_line_favorite">
                <a class="search_form_item" id="search_form_item_favorite" href="<?php echo BASE_URL ?>/search/favorite"></a>
            </div>

            <div class="search_form_line" id="search_form_line_keyword">
                <div class="search_form_item_label">フリーワードで探す</div>
                <div class="search_form_item" id="search_form_item_keyword"></div>
            </div>
        </div>
        
        <div id="search_form_keyword">
            <div class="search_form_line">
                <div class="search_form_item_label">フリーワードで探す</div>
                <form action="<?php echo BASE_URL ?>/search" method="POST">
                    <input id="search_form_keyword_txt" type="text" name="data[Search][p]" value="" placeholder="ワードを入力してください"/>
                </form>
            </div>
        </div>
        
        <div class="popup_close" id="search_form_close">
            <img src="<?php echo BASE_URL ?>/img/icon_close.png" title="" alt=""/>
        </div>
    </div>
</div>