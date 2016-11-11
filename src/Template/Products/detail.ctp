<div class="row">
    <div class="col-md-6">    
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
                    'description' => array(
                        'label' => __('LABEL_DESCRIPTION'),
                        'text' => ''
                    ),
                    'detail' => array(
                        'label' => __('LABEL_DETAIL'),
                        'text' => ''
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
    <div class="col-md-6">    
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-image"></i>
                <h3 class="box-title"><?php echo __('LABEL_PRODUCTS_IMAGES') ?></h3>
            </div>   
            <div class="box-body">
                <div class="row margin-bottom">
                    <div class="col-sm-6">
                        <?php if (!empty($data['image'])): ?>
                        <img class="img-responsive" src="<?php echo $data['image'];?>" alt="Photo">
                        <?php else: ?>
                        No set image
                        <?php endif; ?>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <div class="row">
                            <?php if (!empty($data['images'])): ?>
                            <?php foreach ($data['images'] as $val): ?>
                                <div class="col-sm-6">
                                    <img class="img-responsive" src="<?php echo $val['image'];?>" alt="Photo">
                                </div>
                            <?php endforeach; endif; ?>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="submit">
                    <a class="btn btn-success btn-addnew" href="<?php echo $BASE_URL . '/productimages/update?product_id=' . $data['id'] ?>"><?php echo __('LABEL_ADD_NEW') ?></a>
                    <a class="btn btn-default" href="<?php echo $BASE_URL . '/productimages?product_id=' . $data['id'] ?>"><?php echo __('LABEL_VIEW_ALL') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
