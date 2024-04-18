<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/print.css">

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/muuri@0.9.4/dist/muuri.min.css">

    <title>Document</title>
</head>
<body>
    <div id="zz" class="contr">
        
    </div>


   <script>
    

        const c=document.getElementsByClassName('contr');
        print(c)

    
   </script>


<script>
    const code = `

    <div class="contf">
        <h1>JAMMEECO WAYN SPARE PARTS</h1>
        <div class="tel">Tel:  538497/0634412762/0634500028</div>
        <div class="loc">Hargeisa - Somaliland</div>
    </div>
    <div class="dd">
        <span class="Date">Date:</span>
        <span class="Date1"></span>
        <span class="Inv">Invoice voucher</span>
        <span class="No">NO:</span>
        <span class="No1"></span>
        <span class="Mr">Mr.Mrs:</span>
        <span class="Mr1"></span>
    </div>
    <div class="prod">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>QTY</th>
                    <th>U.Price</th>
                    <th>T.Amount</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
    <span class="Total">TOTAL</span>
    <span class="Total1"></span>
    <span class="prixL">Prix-lettre: ......................</span>
    <span class="sig">Signature: ......................</span>

`;
const div = document.getElementById("zz");
div.innerHTML = code;


const inputs = div.querySelectorAll('input');
for (const input of inputs) {
  input.setAttribute('readonly', true);
}

</script>
</body>
</html>