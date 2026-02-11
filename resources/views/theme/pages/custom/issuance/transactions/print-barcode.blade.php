<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>QR & Barcode List</title>
    <style>
      body {
        font-family: Arial, sans-serif;
      }

      .barcode-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
        justify-content: center;
      }

      .barcode-item {
        border: 1px solid #ccc;
        padding: 15px;
        text-align: center;
        width: 200px;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
      }

      .barcode-item .qr {
        margin-bottom: 10px;
      }

      .barcode-item .text {
        font-size: 14px;
        margin-top: 5px;
      }

      .barcode-label {
        font-weight: bold;
      }
    </style>
  </head>
  <body>

    <div class="barcode-list">
      
      @foreach ($par_headers as $par_header)
        @php
          $items = App\Models\Custom\ParDetail::where('par_header_id', $par_header->id)->get();
        @endphp
        
        @foreach ($items as $item)
          <div class="barcode-item">
            <div class="qr">
              {!! \App\Models\Custom\Item::generateQrCode(strtoupper($item->barcode)."\nOwner: ".$item->par_header->employee->name, 150) !!}
            </div>
            <div class="text">
              <div class="barcode-label">Barcode #:</div>
              <div>{{ $item->barcode }}</div>

              <div class="barcode-label">Owner:</div>
              <div>{{ $item->par_header->employee->name }}</div>
            </div>
          </div>
        @endforeach
      @endforeach
    </div>
    
    <script>
      window.onload = function () {
        window.print();
      };
    </script>
    
  </body>

</html>
