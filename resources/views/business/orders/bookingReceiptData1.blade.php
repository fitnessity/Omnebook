<div class="row"> 
    <div class="col-lg-4 bg-sidebar">
        <div class="your-booking-page side-part">
            <div class="booking-page-meta">
                <a href="#" title="" class="underline"></a>
            </div>
            <div class="box-subtitle">
                <h4>Transaction Complete</h4>
                <div class="modal-inner-box">
                    <h3>Email Receipt</h3>
                    <div class="form-group">
                        <input type="text" name="email" id="receipt_email"  placeholder="youremail@abc.com" class="form-control" value="{{$email}}">
                    </div>
                    <button class="btn btn-red mt-10 width-100 mb-25" onclick="sendemail();">Send Email Receipt</button>
                    <div class="reviewerro" id="reviewerro"></div>

                    <h3>Notes</h3>
                    <div class="form-group">
                        <textarea id="notes" name="notes" rows="4" cols="50" class="form-control">Thank you for doing business with us</textarea>
                    </div>
                </div>
            </div>
            <div class="powered-img">
                <label>Powered By</label>
                <div class="booking-modal-logo">
                    <img src="{{url('/public/images/fitnessity_logo1.png')}}" loading="lazy" alt="fitnessity">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="modal-booking-info">