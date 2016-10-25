<div class="row">
    <div class="col-md-8">    
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('LABEL_ITEMS_DETAIL') ?></h3>
            </div>   
            <div class="box-body"> 
                <?php
                $result = array(
                    'id' => array(
                        'label' => __('ID'),
                        'text' => '',
                    ),
                    'name' => array(
                        'label' => __('LABEL_NAME'),
                        'text' => '',
                    ),
                    'name_sub' => array(
                        'label' => __('LABEL_NAME_SUB'),
                        'text' => '',
                    ),
                    'name_eng' => array(
                        'label' => __('LABEL_NAME_ENG'),
                        'text' => '',
                    ),
                );
                
                foreach ($item as $key => $value) {
                    if (!isset($result[$key])) {
                        continue;
                    }
                    $result[$key]['text'] = !empty($value) ? $value : '-';
                }
                ?>
                <dl class="dl-horizontal">
                    <?php foreach ($result as $key => $value) : ?>
                        <dt><?php echo $value['label'] ?></dt>
                        <dd><?php echo $value['text']; ?></dd>
                    <?php endforeach; ?>                                       
                </dl>
            </div>
        </div>

        <div class="submit">
            <a class="btn btn-primary" href="<?php echo $BASE_URL . '/items/update/' . $item['id'] ?>"><?php echo __('LABEL_UPDATE') ?></a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box padding10">
            <?php echo $this->Html->image($item['image']); ?>
        </div>
    </div>
</div>
