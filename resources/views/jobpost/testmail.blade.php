@extends('layouts.profile')

@section('content')


    Hello {!! $user->firstname !!} {!! $user->lastname !!},<br><br>

  We have recieved a new booking request from you.
  <br><br>

  @if($booking['booking_type'] == "direct")
      <a href="#"> {{ $booking['UserBookingDetail'] -> sport}} </a> <br>
      {{ $booking['UserBookingDetail'] -> booking_detail}}<br><br>
      Your request has been sent to <a href="{!! url('/') !!}">{{ $professional -> firstname}} {{ $professional -> lastname}}</a><br>
      Please wait for professional's confirmation on this.
      <br><br>
    @else
      <a href="#"> {{ $booking['UserBookingDetail'] -> sport}} </a> <br>
      Zipcode: {{ $booking['UserBookingDetail'] -> zipcode}}<br>
      @if(count($booking['Jobpostquestions']) > 0)
        <?php $Jobpostquestions = $booking['Jobpostquestions']->toarray(); $i=0;?>
        @forach($Jobpostquestions as $question)
          @if(@question['question_id'] == 'qoutes')
              Quotes you requested are: 
          @elseif(@question['question_id'] == 'train_wants')
              Training request for: 
          @endif
          {{ $question['answer'] }}
          <?php $i++; ?>
          @if($i == 1) break; @endif
        @endforeach
      @endif
    @endif

    <br>
  <a href="{!! url('/viewBoking/'.$booking['booking_id']) !!}">Click here</a> to know more about this request after <a href="{!! url('/') !!}">login</a> to Fitnessity.<br>
  <a href="{!! url('/mypostedjobs') !!}">Click here</a> to see your all bookings after login.
    <br><br><br><br>

    <font style="font-size:14px">Regards,<br></font>
    <font style="font-size:16px">Fitnessity<br></font>
    <font style="font-size:13px"><i><b>Because Fitness=Necessity.</b></i></font>
@endsection