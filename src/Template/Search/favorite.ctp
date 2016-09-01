

<div class="list_title">お気に入り</div>

<div class="list_item_container">
    <?php
        $items = array(
            array(
                'title' => '(1)ホールスタッフ (2)キッチンスタッフ 大募集【大学生大歓迎】',
                'price' => '時給1,000円〜',
                'train' => '「渋谷駅」<br/>より徒歩00分',
                'stock' => '◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯',
                'tags' => array(
                    'アルバイト',
                    'インターン'
                ),
                'is_favorite' => 0,
                'university_count_1' => array(
                    'name' => '東京理科大',
                    'num' => 10
                ),
                'university_count_2' => array(
                    'name' => '中央',
                    'num' => 5
                ),
                'rate' => 55,
                'users' => array(
                    array(
                        'id' => 0,
                        'avatar' => BASE_URL . '/img/tmp/user_1.jpg'
                    ),
                    array(
                        'id' => 0,
                        'avatar' => BASE_URL . '/img/tmp/user_2.jpg'
                    ),
                    array(
                        'id' => 0,
                        'avatar' => BASE_URL . '/img/tmp/user_3.jpg'
                    ),
                    array(
                        'id' => 0,
                        'avatar' => BASE_URL . '/img/tmp/user_4.jpg'
                    )
                )
            ),
            array(
                'title' => '【大学生就職活動支援有!週1日～OK】完全1対1の個別指導塾講師',
                'price' => '時給1,300円〜<br/>1,500円',
                'train' => '「学芸大前駅」<br/>より徒歩00分',
                'stock' => '◯◯◯◯◯◯◯◯◯',
                'tags' => array(
                    'アルバイト',
                ),
                'is_favorite' => 0,
                'university_count_1' => array(
                    'name' => '慶應',
                    'num' => 15
                ),
                'university_count_2' => array(
                    'name' => '早稲田',
                    'num' => 8
                ),
                'rate' => 40,
                'users' => array(
                    array(
                        'id' => 0,
                        'avatar' => BASE_URL . '/img/tmp/user_5.jpg'
                    ),
                    array(
                        'id' => 0,
                        'avatar' => BASE_URL . '/img/tmp/user_6.jpg'
                    ),
                    array(
                        'id' => 0,
                        'avatar' => BASE_URL . '/img/tmp/user_7.jpg'
                    ),
                    array(
                        'id' => 0,
                        'avatar' => BASE_URL . '/img/tmp/user_8.jpg'
                    )
                )
            ),
        );
        
        foreach ($items as $item) {
            echo $this->element('item', array(
                'item' => $item
            ));
        }
        
        foreach ($items as $item) {
            echo $this->element('item', array(
                'item' => $item
            ));
        }
    ?>
</div>