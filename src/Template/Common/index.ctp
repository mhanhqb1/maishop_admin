<div class="row">
    <div class="col-xs-120">    
        <div class="box box-primary collapsed-box">
            <div class="box-header" data-toggle="tooltip" title="" data-original-title="Search condition">
            <h3 class="box-title"><?php echo __('Search') ?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-primary btn-xs search-collapse" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
            </div>  
            <div class="box-body search-body" style="display: none">
                <?php    
                    echo $this->SimpleForm->render($searchForm);            
                ?>
            </div>   
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">       
        <div class="box">
        <?php        
            echo $this->SimpleTable->render($table);
            echo $this->Paginate->render($total, $limit);   
        ?>
        </div>
    </div>
</div>