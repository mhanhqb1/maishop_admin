<div class="row">
    <div class="col-md-6">
        <form method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data" novalidate="novalidate" action="/orders/update/<?php echo $id; ?>">
            <div class="box box-primary box-update">   
                <div class="box-body">
                    <div class="form-body">
                        <div style="display:none;">
                            <input type="hidden" name="_method" class="form-control" value="POST">
                        </div>
                        <input type="hidden" name="id" class="form-control" id="id" value="7">
                        <div class="form-group text required">
                            <label class="" for="name">Name<span class="input-required">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" required="required" value="Product 3">
                        </div>
                        <div class="form-group text required">
                            <label class="" for="price">Price<span class="input-required">*</span></label>
                            <input type="text" name="price" class="form-control" id="price" required="required" value="200">
                        </div>
                        <div class="form-group text required">
                            <label class="" for="stock">Stock<span class="input-required">*</span></label>
                            <input type="text" name="stock" class="form-control" id="stock" required="required" value="1">
                        </div>
                        <div class="form-group text">
                            <input type="text" class="form-control" id="product_search" value="">
                            <div id="product_result"></div>
                        </div>
                        <div class="form-group button-group">
                            <div class="form-group">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div><div class="form-group">
                                <input type="submit" value="Cancel" class="btn" onclick="return back();">
                            </div>
                            <div class="cls"></div>

                        </div>
                        <div class="cls"></div>
                    </div>            
                </div>
            </div>
        </form>
    </div>
</div>