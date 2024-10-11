@include('emails.header')
<tr>
    <td style="text-align: center; background-color: #fff;">
      <div style="padding: 35px 0;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td style="text-align: center; padding: 0px 30px;" align="center">
              <h6 style="font-weight: 500; font-size: 19px; color: #000; margin-bottom: 15px; margin-top: 15px;">  Fitness - Client Migration   </h6>
              <div style="display: inline-block; margin-bottom: 15px;">
                <div style="width: 165px; padding: 15px; display: grid; border-radius: 10px; line-height: 25px; border: 1px solid #000;">
                  <label>Total Rows </label>
                  <span>{{ $totalRows }}</span>
                </div>
              </div>
              <div style="display: inline-block; margin-bottom: 15px;">
                <div style="width: 165px; padding: 15px; display: grid; border: 1px solid #000; border-radius: 10px; line-height: 25px;">
                  <label>Successful Rows</label>
                  <span>{{ $successfulRows }}</span>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td style="text-align: center; padding: 0px 30px;" align="center">
              <div style="display: inline-block; margin-bottom: 15px;">
                <div style="width: 165px; padding: 15px; display: grid; border-radius: 10px; line-height: 25px; border: 1px solid #000;">
                  <label>Skipped Rows</label>
                  <span>{{ $skippedRows }}</span>
                </div>
              </div>
              <div style="display: inline-block; margin-bottom: 15px;">
                <div style="width: 165px; padding: 15px; display: grid; border: 1px solid #000; border-radius: 10px; line-height: 25px;">
                  <label>Failed Rows</label>
                  <span>{{ $failedRows }}</span>
                </div>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>

    <!-- Fitness - Client Migration  
  <br><br>
  <strong>Total Rows:</strong> {{ $totalRows }}<br>
  <strong>Successful Rows:</strong>{{ $successfulRows }}<br>
  <strong>Skipped Rows:</strong> {{ $skippedRows }}<br>
  <strong>Failed Rows:</strong>{{ $failedRows }} -->
@include('emails.footer')