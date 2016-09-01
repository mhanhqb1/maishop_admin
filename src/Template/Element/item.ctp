<?php if(!empty($item)): ?>
<div class="item display_table">
    <div class="display_row">
        <div class="display_cell">
            <div class="item_title" onclick="javascript: window.location.href = '<?php echo BASE_URL ?>/search/detail'">
                <div class="item_absolute jtextfill kerning"><span><?php if (!empty($item['title'])) echo h(trim($item['title'])) ?></span></div>
            </div>
            <div class="item_time_station">
                <div class="item_absolute">
                    <div class="item_time_station_icon_1 crisp"></div>
                    <div class="item_time_station_text_1 dotdotdot"><?php if (!empty($item['price'])) echo trim($item['price']) ?></div>
                    <div class="item_time_station_icon_2 crisp"></div>
                    <div class="item_time_station_text_2 kerning dotdotdot"><?php if (!empty($item['train'])) echo trim($item['train']) ?></div>
                </div>
            </div>
            <div class="item_stock">
                <div class="item_absolute">
                    <div class="item_stock_left">
                        <div class="item_stock_txt">(株) <?php if (!empty($item['stock'])) echo h(trim($item['stock'])) ?></div>
                        <div class="item_stock_tags">
                            <?php if (!empty($item['tags'])): ?>
                            <?php foreach ($item['tags'] as $tag): ?>
                            <div class="item_stock_tag"><?php echo h(trim($tag)) ?></div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="item_favorite crisp"></div>
                </div>
            </div>
        </div>
        <div class="display_cell">
            <div class="item_applicants">
                <div class="item_absolute">
                    応募者在籍大学
                </div>
            </div>
            <div class="item_university_count">
                <div class="item_absolute">
                    <div class="item_university_count_name">
                        <p><?php
                        if (!empty($item['university_count_1']['name'])) {
                            echo trim($item['university_count_1']['name']);
                        } else {
                            echo '-';
                        }
                        ?></p>
                    </div>
                    <div class="item_university_count_num">
                        <p><?php
                        if (isset($item['university_count_1']['num'])) {
                            echo $item['university_count_1']['num'];
                        } else {
                            echo '-';
                        }
                        ?></p>
                    </div>
                </div>
            </div>
            <div class="item_university_count w">
                <div class="item_absolute">
                    <div class="item_university_count_name">
                        <p><?php
                        if (!empty($item['university_count_2']['name'])) {
                            echo trim($item['university_count_2']['name']);
                        } else {
                            echo '-';
                        }
                        ?></p>
                    </div>
                    <div class="item_university_count_num">
                        <p><?php
                        if (isset($item['university_count_2']['num'])) {
                            echo $item['university_count_2']['num'];
                        } else {
                            echo '-';
                        }
                        ?></p>
                    </div>
                </div>
            </div>
            <div class="item_meter">
                <div class="item_absolute">
                    <div class="item_meter_value"><div style="<?php if(!empty($item['rate'])) echo 'width: ' . $item['rate'] . '%' ?>"></div></div>
                </div>
            </div>
            <div class="item_users_title">
                <div class="item_absolute">この募集を見ているユーザー</div>
            </div>
            <div class="item_users">
                <?php if(!empty($item['users'])): ?>
                <?php foreach ($item['users'] as $user): ?>
                <a class="item_user" href="javascript:;" style="background-image: url(<?php echo h($user['avatar']) ?>)"></a>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>