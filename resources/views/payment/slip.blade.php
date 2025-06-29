<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <title>Payment Slip</title>
  <style>
    @page {
      size: A4;
      margin: 0;
    }

    body {
      font-family: "Poppins", sans-serif;
      padding: 0;
      background: #fff;
      width: 210mm;
      height: 295mm;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }

    .container {
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .payment-slip {
      border: 2px solid #0f3d77;
      padding: 10px;
      box-sizing: border-box;
      position: relative;
      height: 49%;
      margin-top: 15px;
    }

    .header {
      text-align: center;
      margin-bottom: 10px;
    }

    .institute-name {
      color: #0f3d77;
      font-weight: bold;
      font-size: 22px;
      margin: 5px 0;
      line-height: 1.2;
    }

    .sub-title {
      font-weight: 600;
      margin-top: -10px;
      font-size: 14px;
    }

    .established-info {
      font-weight: 400;
      margin-top: -4px;
      font-size: 10px;
      color: #252525;
    }

    .certification {
      font-size: 12px;
      margin: 3px 0;
    }

    .slip-title {
      background: #0f3d77;
      color: white;
      padding: 5px;
      text-align: center;
      font-weight: bold;
      width: 200px;
      border-radius: 20px;
      margin: auto;
      margin: 10px auto;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }

    .copy-label {
      position: absolute;
      top: 10px;
      right: 20px;
      background: #0f3d77;
      color: white;
      padding: 3px 10px;
      font-weight: bold;
      border-radius: 20px;
      font-size: 9px;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }

    .student-info {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      font-size: 13px;
    }

    .info-item {
      display: flex;
      margin-right: 15px;
    }

    .info-label {
      font-weight: bold;
      min-width: 80px;
    }

    .info-value {
      margin-left: 5px;
    }

    .payment-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
      height: 120px;
    }

    .payment-table th {
      background: #0f3d77;
      color: white;
      padding: 5px;
      text-align: left;
      font-size: 13px;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }

    .payment-table td {
      border: 1px solid #ddd;
      padding: 5px;
      font-size: 13px;
    }

    .amount-section {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
      font-size: 13px;
    }

    .amount-box {
      border: 1px solid #0f3d77;
      padding: 5px;
      width: 48%;
    }

    .amount-row {
      display: flex;
      margin-bottom: 5px;
    }

    .amount-label {
      font-weight: bold;
      width: 100px;
    }

    .signature-section {
      display: flex;
      justify-content: space-between;
      margin-top: 15px;
      font-size: 12px;
    }

    .signature-box {
      width: 30%;
      text-align: center;
    }

    .signature-line {
      border-top: 1px solid #000;
      margin-top: 30px;
      font-weight: bold;
    }

    .footer {
      text-align: center;
      font-size: 11px;
      margin-top: 5px;
      color: #555;
    }

    @media print {
      body {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }

      .slip-title,
      .copy-label,
      .payment-table th {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Office Copy -->
    <div class="payment-slip">
      <div class="copy-label">OFFICE COPY</div>
      <div class="header">
        <div class="institute-name">INFORMATION TECHNOLOGY HUB (IT HUB)</div>
        <div class="sub-title">COMPUTER TRAINING CENTER</div>
        <div class="established-info">125, Alongker Shopping Complex, Alongker Circle, Chittagong &nbsp; | &nbsp;
          Established: 2020</div>
        <div class="established-info">Mail: mdammasum@gmail.com &nbsp; | &nbsp; Web: ithub.youthskill.com.bd</div>
      </div>

      <div class="slip-title">STUDENT PAYMENT SLIP</div>

      <div class="student-info">
        <div class="info-item">
          <div class="info-label">Student Name:</div>
          <div class="info-value">{{ $student->name }}</div>
        </div>
        <div class="info-item">
          <div class="info-label">Phone:</div>
          <div class="info-value">{{ $student->phone }}</div>
        </div>
        <div class="info-item">
          <div class="info-label">Course Fee:</div>
          <div class="info-value">{{ number_format($payment->total_payable, 2) }} BDT</div>
        </div>
      </div>

      <table class="payment-table">
        <thead>
          <tr>
            <th>SL No.</th>
            <th>Fee Details</th>
            <th>Paid Amount</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach($paymentHistory as $index => $history)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $history->description ?? 'Payment' }}</td>
            <td>{{ number_format($history->paid_amount, 2) }} BDT</td>
            <td>{{ $history->created_at->format('d/m/Y') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="amount-section">
        <div class="amount-box">
          <div class="amount-row">
            <div class="amount-label">Total Fee:</div>
            <div>{{ number_format($payment->total_payable, 2) }} BDT</div>
          </div>
          <div class="amount-row">
            <div class="amount-label">Total Paid:</div>
            <div>{{ number_format($payment->total_paid, 2) }} BDT</div>
          </div>
        </div>
        <div class="amount-box">
          <div class="amount-row">
            <div class="amount-label">Total Due:</div>
            <div>{{ number_format($payment->total_due, 2) }} BDT</div>
          </div>
          <div class="amount-row">
            <div class="amount-label">Payment Status:</div>
            <div>
              @if($payment->total_due <= 0)
                Paid
              @elseif($payment->total_paid <= 0)
                Unpaid
              @else
                Partial
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="signature-section">
        <div class="signature-box">
          <div class="signature-line">Student Signature</div>
        </div>
        <div class="signature-box">
          <div class="signature-line">Cashier Signature</div>
        </div>
        <div class="signature-box">
          <div class="signature-line">Authorized Signature</div>
        </div>
      </div>

      <div class="footer">
        <div>For any query contact: +88 01814053166</div>
      </div>
    </div>

    <!-- Student Copy -->
    <div class="payment-slip">
      <div class="copy-label">STUDENT COPY</div>
      <div class="header">
        <div class="institute-name">INFORMATION TECHNOLOGY HUB (IT HUB)</div>
        <div class="sub-title">COMPUTER TRAINING CENTER</div>
        <div class="established-info">125, Alongker Shopping Complex, Alongker Circle, Chittagong &nbsp; | &nbsp;
          Established: 2020</div>
        <div class="established-info">Mail: mdammasum@gmail.com &nbsp; | &nbsp; Web: ithub.youthskill.com.bd</div>
      </div>

      <div class="slip-title">STUDENT PAYMENT SLIP</div>

      <div class="student-info">
        <div class="info-item">
          <div class="info-label">Student Name:</div>
          <div class="info-value">{{ $student->name }}</div>
        </div>
        <div class="info-item">
          <div class="info-label">Phone:</div>
          <div class="info-value">{{ $student->phone }}</div>
        </div>
        <div class="info-item">
          <div class="info-label">Course Fee:</div>
          <div class="info-value">{{ number_format($payment->total_payable, 2) }} BDT</div>
        </div>
      </div>

      <table class="payment-table">
        <thead>
          <tr>
            <th>SL No.</th>
            <th>Fee Details</th>
            <th>Paid Amount</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach($paymentHistory as $index => $history)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $history->description ?? 'Payment' }}</td>
            <td>{{ number_format($history->paid_amount, 2) }} BDT</td>
            <td>{{ $history->created_at->format('d/m/Y') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="amount-section">
        <div class="amount-box">
          <div class="amount-row">
            <div class="amount-label">Total Fee:</div>
            <div>{{ number_format($payment->total_payable, 2) }} BDT</div>
          </div>
          <div class="amount-row">
            <div class="amount-label">Total Paid:</div>
            <div>{{ number_format($payment->total_paid, 2) }} BDT</div>
          </div>
        </div>
        <div class="amount-box">
          <div class="amount-row">
            <div class="amount-label">Total Due:</div>
            <div>{{ number_format($payment->total_due, 2) }} BDT</div>
          </div>
          <div class="amount-row">
            <div class="amount-label">Payment Status:</div>
            <div>
              @if($payment->total_due <= 0)
                Paid
              @elseif($payment->total_paid <= 0)
                Unpaid
              @else
                Partial
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="signature-section">
        <div class="signature-box">
          <div class="signature-line">Student Signature</div>
        </div>
        <div class="signature-box">
          <div class="signature-line">Cashier Signature</div>
        </div>
        <div class="signature-box">
          <div class="signature-line">Authorized Signature</div>
        </div>
      </div>

      <div class="footer">
        <div>For any query contact: +88 01814053166</div>
      </div>
    </div>
  </div>

  <script>
    // Auto print and close
    document.addEventListener('DOMContentLoaded', function() {
        // Try to print immediately
        setTimeout(function() {
            window.print();
            
            // Attempt to close after printing
            // Some browsers block window.close() unless it was opened by script
            setTimeout(function() {
                try {
                    window.close();
                } catch (e) {
                    // Fallback for browsers that block window.close()
                    console.log('Could not close window automatically. Please close manually.');
                }
            }, 500);
        }, 500);
        
        // Alternative approach for browsers that block immediate close
        window.onafterprint = function() {
            setTimeout(function() {
                try {
                    window.close();
                } catch (e) {
                    console.log('Could not close window automatically. Please close manually.');
                }
            }, 100);
        };
    });
  </script>
</body>
</html>