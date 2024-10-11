<div id="successAddCart" class="successAddCart modal successaddcart-block" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title hide" id="exampleModalLabel">SUCCESSFULLY ADD TO YOUR CART</h3>
            </div>
            
            <div class="modal-body">
                                
                <div class="col-md-12 hide">
                    <h4 style="margin-left:10px">Shopping Cart</h4>
                    @include('layouts.shopping-cart')
                </div>
                
                
                <div class="discover-block">
                    <h3 class="distitle">DISCOVER MORE BELOW</h3>
                    <h5 class="sldertitle">View Other Activities <a href="/instant-hire">View All</a> </h5>
                    <div id="carousel-reviews" class="carousel kickboxing-slider slide" data-ride="carousel">
                        <div class="carousel-inner">
                        <?php
                        $companyid = $companylogo = $companyname = $companyaddress = "";
                        $pay_session = $pay_price = $pay_setduration = $pay_discount = $languages = "";
                        if(isset($serviceData)) {
                        $divId=1;
                        foreach($serviceData as $key => $service) {
                        $company = $price = $businessSp = [];
                        if(isset($companyData)) {
                            if(isset($companyData[$service['cid']]) && !empty($companyData[$service['cid']])) {
                                $company = $companyData[$service['cid']];
                                $company = isset($company[0]) ? $company[0] : [];
                                if(!empty($company)) {
                                    $companyid = $company['id'];
                                    $companylogo = $company['logo'];
                                    $companyname = $company['company_name'];
                                    $companyaddress = $company['address'];
                                }
                                $price = $servicePrice[$service['cid']];
                                $price = isset($price[0]) ? $price[0] : [];
                                if(!empty($price)) {
                                    $pay_session = $price['pay_session'];
                                    $pay_price = $price['pay_price'];
                                    $pay_setduration = $price['pay_setduration'];
                                    $pay_discount = $price['pay_discount'];
                                }
                                $businessSp = $businessSpec[$service['cid']];
                                $businessSp = isset($businessSp[0]) ? $businessSp[0] : [];
                                if(!empty($businessSp)) {
                                    $languages = $businessSp['languages'];
                                }
                            }
                        }
                        
                        if($divId==1) {
                            echo ($divId%3 == 1)?'<div class="item active">':'';
                        } else {
                            echo ($divId%3 == 1)?'<div class="item">':'';
                        }
                        ?>
  
                            <div class="col-md-4 col-sm-6">
                                <div class="kickboxing-slider-block item">
                                    <div class="kickboxing-block1">
                                        <div class="topimg-content">
                                            <?php
                                            if (File::exists(public_path("/uploads/profile_pic/thumb/" . $service['profile_pic']))) {
                                                $profilePic = url('/public/uploads/profile_pic/thumb/' . $service['profile_pic']);
                                            } else {
                                                $profilePic = '/public/images/default-avatar.png';
                                            }
                                            ?>
                                            <img src="{{ $profilePic }}">
                                            <div class="sorttext">
                                                <div class="fromtxt">From #25 - #3000</div>
                                                <div class="claimedtxt">CLAIMED</div>
                                                <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                            </div>
                                        </div>
                                        <?php
                                        if (File::exists(public_path("/uploads/profile_pic/thumb/" . $companylogo))) {
                                            $companyLogo = url('/public/uploads/profile_pic/thumb/' . $companylogo);
                                        } else {
                                            $companyLogo = '/public/images/default-avatar.png';
                                        }
                                        ?>
                                        <div class="bottom-content">
                                            <div class="ratset-img">
                                                <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                <div class="volarimg"><img src="{{ $companyLogo }}"></div>
                                                <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                            </div>
                                            <h3><?= $service['program_name'] ?></h3>
                                            <h6><?= $companyname ?></h6>
                                            <p><?= $companyaddress ?></p>
                                            <h5><?= $service['sport_activity'] ?> <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                                            <hr>
                                            <a href="#" class="moredetails-btn" data-toggle="modal" data-target="#mykickboxing<?= $companyid ?>">More Details</a>
                                            <p>COMPARE SIMILAR OPTION +</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?=($divId%3 == 0)?'</div>':''?>
                        <?php $divId++;} ?>
                        <?=($divId%3 != 1)?'</div>':''?>
                        <?php } ?>
                        
                        </div>
                        <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>

                    <h5 class="sldertitle">Explore Products <a href="/instant-hire">View All</a> </h5>
                    <div id="carousel-reviews" class="carousel kickboxing-slider slide" data-ride="carousel">
                        <div class="carousel-inner">
                        <?php
                        $companyid = $companylogo = $companyname = $companyaddress = "";
                        $pay_session = $pay_price = $pay_setduration = $pay_discount = $languages = "";
                        if(isset($serviceData)) {
                        foreach($serviceData as $key => $service) {
                        $company = $price = $businessSp = [];
                        if(isset($companyData)) {
                            if(isset($companyData[$service['cid']]) && !empty($companyData[$service['cid']])) {
                                $company = $companyData[$service['cid']];
                                $company = isset($company[0]) ? $company[0] : [];
                                if(!empty($company)) {
                                    $companyid = $company['id'];
                                    $companylogo = $company['logo'];
                                    $companyname = $company['company_name'];
                                    $companyaddress = $company['address'];
                                }
                                $price = $servicePrice[$service['cid']];
                                $price = isset($price[0]) ? $price[0] : [];
                                if(!empty($price)) {
                                    $pay_session = $price['pay_session'];
                                    $pay_price = $price['pay_price'];
                                    $pay_setduration = $price['pay_setduration'];
                                    $pay_discount = $price['pay_discount'];
                                }
                                $businessSp = $businessSpec[$service['cid']];
                                $businessSp = isset($businessSp[0]) ? $businessSp[0] : [];
                                if(!empty($businessSp)) {
                                    $languages = $businessSp['languages'];
                                }
                            }
                        }
                        ?>
                        <div class="item <?= ($key==0)?'active':'' ?>">
                            <div class="col-md-4 col-sm-6">
                                <div class="kickboxing-slider-block item">
                                    <div class="kickboxing-block1">
                                        <div class="topimg-content">
                                            <?php
                                            if (File::exists(public_path("/uploads/profile_pic/thumb/" . $service['profile_pic']))) {
                                                $profilePic = url('/public/uploads/profile_pic/thumb/' . $service['profile_pic']);
                                            } else {
                                                $profilePic = '/public/images/default-avatar.png';
                                            }
                                            ?>
                                            <img src="{{ $profilePic }}">
                                            <div class="sorttext">
                                                <div class="fromtxt">From #25 - #3000</div>
                                                <div class="claimedtxt">CLAIMED</div>
                                                <div class="favoritetxt"><i class="fa fa-heart-o"></i>FAVORITE</div>
                                            </div>
                                        </div>
                                        <?php
                                        if (File::exists(public_path("/uploads/profile_pic/thumb/" . $companylogo))) {
                                            $companyLogo = url('/public/uploads/profile_pic/thumb/' . $companylogo);
                                        } else {
                                            $companyLogo = '/public/images/default-avatar.png';
                                        }
                                        ?>
                                        <div class="bottom-content">
                                            <div class="ratset-img">
                                                <div class="rattxt"><i class="fa fa-star" aria-hidden="true"></i> 4.6 (146)</div>
                                                <div class="volarimg"><img src="{{ $companyLogo }}"></div>
                                                <div class="verifiedimg"><img src="/public/images/verified-logo.png"></div>
                                            </div>
                                            <h3><?= $service['program_name'] ?></h3>
                                            <h6><?= $companyname ?></h6>
                                            <p><?= $companyaddress ?></p>
                                            <h5><?= $service['sport_activity'] ?> <img src="{{ url('public/img/arrow-down.png') }}"></h5>
                                            <hr>
                                            <a href="#" class="moredetails-btn">More Details</a>
                                            <p>COMPARE SIMILAR OPTION +</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                        </div>
                        <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>

                    <h5 class="sldertitle">Booking History: Book item again <a href="#">View All</a> </h5>
                    <div class="kickboxing-slider kickboxing-slider1">
                        <h4>No History</h4>
                    </div>
                    <h5 class="sldertitle">Your Save For Later Items <a href="#">View All</a> </h5>
                    <div class="kickboxing-slider kickboxing-slider1">
                        <h4>No History</h4>
                    </div>
                    <hr style="border-bottom:1px solid #000;">
                    <h5 class="sldertitle">Your Recently View Items <a href="#">View All</a> </h5>
                    <div class="kickboxing-slider kickboxing-slider1">
                        <h4>No History</h4>
                    </div>
                    <h5 class="sldertitle">View Similar Items from other providers <a href="#">View All</a> </h5>
                    <div class="kickboxing-slider kickboxing-slider1">
                        <h4>No History</h4>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div> 