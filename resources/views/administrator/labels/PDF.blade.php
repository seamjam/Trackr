<!DOCTYPE html>
<html>
<head>
    <title>Shipping Label</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .label-container {
            width: 500px;
            padding: 20px;
            border: 1px solid #000;
            display: inline-block;
            margin: 10px;
        }
        .label-row {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .label-row div {
            width: 48%;
        }

        .label-details {
            border: 1px solid #000;
            padding: 5px;
            margin-bottom: 10px;
        }

        .barcode-container {
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .barcode-text {
            font-size: 12px;
            margin-top: 5px;
            margin-right: 3px;
        }
    </style>
</head>
<body>
<div class="label-container">
    {{ $label->post_company->name }}
    <div class="label-row">
        <div class="label-details">
            <div>
                <div><strong>Webshop:</strong></div>
                <div>{{ $label->webshop->name }}</div>
            </div>
            <div>
                <div><strong>Customer:</strong></div>
                <div>{{ $label->receiver_firstname }} {{ $label->receiver_lastname }}</div>
            </div>
            <div><strong>Address:</strong></div>
            <div>{{ $label->receiver_postal_code }} {{ $label->receiver_house_number }}</div>
        </div>
    </div>
    <div class="barcode-container">
        {!! $barcode !!}
        <div class="barcode-text">{{ $label->tracking_number }}</div>
    </div>
</div>
</body>
</html>
