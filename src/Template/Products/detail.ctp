<div class="row">
    <div class="col-md-8">    
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('LABEL_PRODUCTS_DETAIL') ?></h3>
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
                    'price' => array(
                        'label' => __('LABEL_PRICE'),
                        'text' => '',
                        'is_number' => 1,
                    ),
                    'stock' => array(
                        'label' => __('LABEL_STOCK'),
                        'text' => '',
                        'is_number' => 1,
                    ),
                );
                
                foreach ($data as $key => $value) {
                    if (!isset($result[$key])) {
                        continue;
                    }
                    if (!empty($value)) {
                        if (!empty($result[$key]['is_number']) && is_numeric($value)) {
                            $result[$key]['text'] = number_format($value);
                        } else {
                            $result[$key]['text'] = $value;
                        }
                    } else {
                        $result[$key]['text'] = '-';
                    }
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
            <a class="btn btn-primary" href="<?php echo $BASE_URL . '/products/update/' . $data['id'] ?>"><?php echo __('LABEL_UPDATE') ?></a>
        </div>
    </div>
</div>
