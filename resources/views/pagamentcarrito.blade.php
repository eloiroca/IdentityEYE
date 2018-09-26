<html lang="{{ app()->getLocale() }}">
  <head>
      <title>IdentityEYE</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <!-- jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src='https://unpkg.com/spritespin@4.0.3/release/spritespin.js'></script>
      <!--Favicon -->
      <link rel="icon" href="{{ URL::asset('img/favicon.ico') }}" type="image/gif" sizes="16x16">
  </head>

  <body>
    <form id="form_paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="business" value="eloi.roca20@gmail.com">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="currency_code" value="EUR">
<?php
        for ($i=0; $i<count($dades['data']); $i++){
            echo '<input type="hidden" name="item_name_'.($i+1).'" value="'.$dades['data'][$i][1].'">';

            $arr_preu = str_split($dades['data'][$i][3]);

            $preu = "";
            for($j=0;$j<count($arr_preu);$j++){
                if ($arr_preu[$j] == '0' || $arr_preu[$j] == '1' || $arr_preu[$j] == '2' || $arr_preu[$j] == '3' || $arr_preu[$j] == '4' || $arr_preu[$j] == '5' || $arr_preu[$j] == '6' || $arr_preu[$j] == '7' || $arr_preu[$j] == '8' || $arr_preu[$j] == '9' || $arr_preu[$j] == '.'){
                    $preu .= $arr_preu[$j];
                }
            }
            echo '<input type="hidden" name="amount_'.($i+1).'" value="'.$preu/$dades['data'][$i][2].'">';
            echo '<input type="hidden" name="quantity_'.($i+1).'" value="'.$dades['data'][$i][2].'">';
        }
?>
    </form>
    <script>
      $('#form_paypal').submit();
    </script>
  </body>
</html>
