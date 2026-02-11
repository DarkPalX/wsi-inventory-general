<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Barcode Example</title>
  <!-- Include JsBarcode library -->
  <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
  <style>
    .barcode-container {
      text-align: center;
      margin-top: 50px;
    }
    .barcode {
      margin-top: 20px;
      width: 300px;
      height: 100px;
    }
  </style>
</head>
<body>

  <!-- Barcode Container -->
  <div class="barcode-container">

    <div id="barcode">{!! \App\Models\Custom\Item::generateQrCode($code, 250) !!}</div> <!-- This will hold the barcode -->

  </div>

  <script>
    

    function printBarcode() {
      var printContents = document.getElementById("barcode").innerHTML;
      var originalContents = document.body.innerHTML;

      // Replace the body content with the barcode content
      document.body.innerHTML = printContents;

      // Call the print function
      window.print();

      // Restore the original body content
      document.body.innerHTML = originalContents;
    }
  </script>

</body>
</html>

<div class="wrapper p-5">
    
    <div class="text-center">
        {!! \App\Models\Custom\Item::generateQrCode($code, 250) !!}
    </div>
                    
</div>



    <script>
        // $( document ).ready(function() {
        //     window.print();
        // });
        function fitTextToWidth(el, maxWidth) {
            let fontSize = 32; // Starting size
            const minFontSize = 10; // Don't go below this
            el.style.fontSize = fontSize + 'px';

            while (el.scrollWidth > maxWidth && fontSize > minFontSize) {
                fontSize--;
                el.style.fontSize = fontSize + 'px';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const barcode = document.getElementById('barcode-text');
            fitTextToWidth(barcode, 250);
        });
    </script>

