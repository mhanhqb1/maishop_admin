<div class="row">
    <div class="col-md-8">    
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('LABEL_ADMIN_DETAIL') ?></h3>
            </div>   
            <div class="box-body"> 
                <?php
                $result = array(
                    'id' => array(
                        'label' => __('ID'),
                        'text' => '',
                    ),
                    'login_id' => array(
                        'label' => __('LABEL_ADMIN_LOGIN_ID'),
                        'text' => '',
                    ),
                    'name' => array(
                        'label' => __('LABEL_NAME'),
                        'text' => '',
                    ),
                    'admin_type' => array(
                        'label' => __('LABEL_ADMIN_TYPE'),
                        'text' => '',
                    ),
                );
                
                foreach ($admin as $key => $value) {
                    if (!isset($result[$key])) {
                        continue;
                    }
                    if ($value === null || $value === '') {
                        $result[$key]['text'] = '-';
                        continue;
                    }
                    
                    if ($key == 'admin_type') {
                        if (isset($searchAdminType[$value])) {
                            $result[$key]['text'] = $searchAdminType[$value];
                        } else {
                            $result[$key]['text'] = $value;
                        }
                    } else if (!empty($result[$key]['is_number']) && is_numeric($value)) {
                        $result[$key]['text'] = number_format($value);
                    } else {
                        $result[$key]['text'] = $value;
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
            <a class="btn btn-primary" href="<?php echo $BASE_URL . '/admins/update/' . $admin['id'] ?>"><?php echo __('LABEL_UPDATE') ?></a>
            <a class="btn btn-primary" href="<?php echo $BASE_URL . '/admins/password/' . $admin['id'] ?>"><?php echo __('LABEL_PASSWORD') ?></a>
        </div>
    </div>
</div>
