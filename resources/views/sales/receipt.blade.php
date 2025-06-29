<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT HUB - Sale Receipt #{{ $sale->id }}</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            background: #f8f8f8;
            font-family: 'DejaVu Sans', sans-serif;
        }

        .receipt-container {
            width: 80mm;
           
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 13px;
            margin-bottom: 5px;
        }

        .contact {
            font-size: 12px;
        }

        .receipt-info {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin: 15px 0;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 5px;
        }

        .items-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .totals {
            font-size: 13px;
            margin-top: 10px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 11px;
        }

        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-group button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-print {
            background-color: #4CAF50;
            color: white;
        }

        .btn-close {
            background-color: #f44336;
            color: white;
        }

        @media print {
            @page {
                size: 80mm;
                margin: 0;
                margin-left: 0;
                padding: 0;
            }
            
            body, html {
                width: 80mm;
                height: auto;
                background: none;
                margin: 0 !important;
                padding: 0 !important;
                display: block;
            }

            .receipt-container {
                width: 80mm !important;
                margin: 0 !important;
                padding: 20px !important;
                box-shadow: none;
                page-break-after: always;
                border: 1px solid black;
                position: absolute;
                left: 0;
                top: 0;
            }

            .no-print {
                display: none !important;
            }
            
            /* Force print background colors */
            .items-table th {
                background-color: #f5f5f5 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <div class="title">IT HUB</div>
            <div class="subtitle">Technology Solutions & Services</div>
            <div class="contact">123 Business Street, City</div>
            <div class="contact">Phone: (123) 456-7890</div>
        </div>

        <div class="receipt-info">
            <div><strong>Receipt #:</strong> {{ $sale->id }}</div>
            <div><strong>Date:</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</div>
        </div>

        <div class="divider"></div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                <tr>
                    <td>{{ $item->item->name }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">{{ number_format($item->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="divider"></div>

        <div class="totals">
            <div class="totals-row">
                <span>Subtotal:</span>
                <span>{{ number_format($sale->total_amount, 2) }}</span>
            </div>
            @if($sale->discount > 0)
            <div class="totals-row">
                <span>Discount:</span>
                <span>-{{ number_format($sale->discount, 2) }}</span>
            </div>
            @endif
            <div class="totals-row" style="font-weight: bold;">
                <span>Grand Total:</span>
                <span>{{ number_format($sale->grand_total, 2) }}</span>
            </div>
        </div>

        @if($sale->customer_name)
        <div style="margin-top: 10px; font-size: 13px;">
            <strong>Customer:</strong> {{ $sale->customer_name }}
        </div>
        @endif

        <div class="footer">
            <div>Thank you for your purchase!</div>
            <div>www.ithub.example.com</div>
        </div>

        <div class="btn-group no-print">
            <button class="btn-print" onclick="window.print()">Print Receipt</button>
            <button class="btn-close" onclick="window.close()">Close Window</button>
        </div>
    </div>

    
</body>
</html>