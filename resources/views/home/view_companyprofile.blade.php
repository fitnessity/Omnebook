@if(@$value['business_name']!="" && @$value['business_name']!= 'undefined')
    <div id="mykickboxing<?= $companyid ?>" class="mykickboxing modal kickboxing-moredetails" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-right" style="margin-bottom:10px; margin-right:25px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    if (isset($value['company_images'][0]) && ($value['company_images'][0]!="") && File::exists(public_path("/uploads/profile_pic/thumb/" . $value['company_images'][0]))) {
                        $profilePic = url('/public/uploads/profile_pic/thumb/' . $value['company_images'][0]);
                    } else {
                        $profilePic = '/public/images/claim-bg.jpeg';
                    }
                    ?>
                    <img src="{{ $profilePic }}" class="kickboximg-big">
                    <div class="col-md-12">
                        <h3><?= $value['business_name'] ?></h3>
                        <p><?= $value['location'] ?></p>
                        <h5><?= $value['service_name'] ?></h5>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@else
	<div id="mykickboxing<?= $companyid ?>" class="mykickboxing modal kickboxing-moredetails" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-right" style="margin-bottom:10px; margin-right:25px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    if (isset($value['cover_photo'][0]) && ($value['cover_photo'][0]!="") && File::exists(public_path("/uploads/profile_pic/thumb/" . $value['cover_photo'][0]))) {
                        $profilePic = url('/public/uploads/profile_pic/thumb/' . $value['cover_photo'][0]);
                    } else {
                        $profilePic = '/public/images/claim-bg.jpeg';
                    }
                    ?>
                    <img src="{{ $profilePic }}" class="kickboximg-big">
                    <div class="col-md-12">
                        <h3><?= $value['username'] ?></h3>
                        <p><?php echo $value['location'] ?></p>
                        <h5><?= $value['service_name'] ?></h5>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endif