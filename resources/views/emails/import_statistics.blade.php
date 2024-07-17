@include('emails.header')
    Fitness - Client Migration  
  <br><br>
  <strong>Total Rows:</strong> {{ $totalRows }}<br>
  <strong>Successful Rows:</strong>{{ $successfulRows }}<br>
  <strong>Skipped Rows:</strong> {{ $skippedRows }}<br>
  <strong>Failed Rows:</strong>{{ $failedRows }}
@include('emails.footer')