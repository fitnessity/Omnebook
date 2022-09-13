@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">

        @include('business.leftNavigation')

        <div class="col-md-10">

            <form id="termset" name="termset" action="{{route('addbusinessterms')}}" method="post">
                @csrf
                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <div class="container-fluid p-0" id="detail-form3">
                    <div class="tab-hed">Set Your Terms</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <section class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        Give your customers THINGS TO KNOW and information on how and what to prepare before they book.
                                    </p>
                                    <br><br>
                                    <div class="form-group">
                                        <label for="">House Rules</label>
                                        <textarea required name="houserules" id="house_rules" cols="30" rows="4" class="form-control"></textarea>
                                        <div class="text-right">500 Characters Left</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Cancelation Policy</label>
                                        <textarea required name="cancelation" id="cancelation_policy" cols="30" rows="4" class="form-control"></textarea>
                                        <div class="text-right">500 Characters Left</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Safety and Cleaning Procedures</label>
                                        <textarea required name="cleaning" id="safety_cleaning" cols="30" rows="4" class="form-control"></textarea>
                                        <div class="text-right">500 Characters Left</div>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <p class="text-center"> Select the section you require your clients to agree to upon completing registration.</p>

                                    <div class="setyour_block">

                                        <div class="col-md-12">
                                            <label for="terms_1" class="col-md-6 terms-check1">
                                                <input type="checkbox" value="1" class="chkdy" name="termcondfaq" autocomplete="off"> Terms, Conditions, FAQ
                                            </label>
                                            <div class="col-md-6 textsam" id="termfaq" style="display: none;">
                                                <textarea type="number" class="form-control" id="termcondfaqtext" name="termcondfaqtext"> </textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="terms_2" class="col-md-6 terms-check2">
                                                <input type="checkbox" value="1" class="chkdy" name="contractterms" autocomplete="off"> Contract Terms ?
                                            </label>
                                            <div class="col-md-6 textsam" id="contractterms" style="display: none;">
                                                <textarea type="number" class="form-control" id="contracttermstext" name="contracttermstext"> </textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="terms_3" class="col-md-6 terms-check3">
                                                <input type="checkbox" value="1" class="chkdy" name="liability" autocomplete="off"> Liability Waiver
                                            </label>
                                            <div class="col-md-6 textsam" id="liability" style="display: none;">
                                                <textarea type="number" class="form-control" id="liabilitytext" name="liabilitytext"> </textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="terms_4" class="col-md-6 terms-check4">
                                                <input type="checkbox" value="1" class="chkdy" name="covid" autocomplete="off"> Covid – 19 Protocols
                                            </label>
                                            <div class="col-md-6 textsam" id="covid" style="display: none;">
                                                <textarea type="number" class="form-control" id="covidtext" name="covidtext"> </textarea>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12">
                                <br>

                                <div class="row">

                                    <div class="col-md-6">
                                        <button type="button" class="btn-bck" onclick="location.href='{{route('specificationBusinessProfile')}}'"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>

                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn-nxt" id="btn-nxt4">Continue <i class="fa fa-arrow-right"></i></button>
                                    </div>

                                </div>
                                <br>

                            </div>

                        </div>

                    </section>

                </div>
            </form>

        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
