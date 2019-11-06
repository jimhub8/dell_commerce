<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Skyline Invoice Email</title>
  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Lato:400);

    /* Take care of image borders and formatting */

    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    a {
      text-decoration: none;
      border: 0;
      outline: none;
    }

    a img {
      border: none;
    }

    /* General styling */

    td, h1, h2, h3  {
      font-family: Helvetica, Arial, sans-serif;
      font-weight: 400;
    }

    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #ffffff;
    }

     table {
      border-collapse: collapse !important;
    }


    h1, h2, h3 {
      padding: 0;
      margin: 0;
      color: #ffffff;
      font-weight: 400;
    }

    h3 {
      color: #21c5ba;
      font-size: 24px;
    }

    .important-font {
      color: #21BEB4;
      font-weight: bold;
    }

    .hide {
      display: none !important;
    }

    .force-full-width {
      width: 100% !important;
    }
  </style>

  <style type="text/css" media="screen">
    @media screen {
       /* Thanks Outlook 2013! http://goo.gl/XLxpyl*/
      td, h1, h2, h3 {
        font-family: 'Lato', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {
      table[class="w320"] {
        width: 320px !important;
      }

      table[class="w300"] {
        width: 300px !important;
      }

      table[class="w290"] {
        width: 290px !important;
      }

      td[class="w320"] {
        width: 320px !important;
      }

      td[class="mobile-center"] {
        text-align: center !important;
      }

      td[class="mobile-padding"] {
        padding-left: 20px !important;
        padding-right: 20px !important;
        padding-bottom: 20px !important;
      }

      td[class="mobile-block"] {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        padding-bottom: 20px !important;
      }

      td[class="mobile-border"] {
        border: 0 !important;
      }

      td[class*="reveal"] {
        display: block !important;
      }
    }
  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center" valign="top" bgcolor="#ffffff" width="100%">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="border-bottom: 3px solid #3bcdc3;" width="100%"><center><a href="../../../storage/logo.png">
    <img src="{{ $logo }}" alt="" width="300" height="135" /></a></center></td>
</tr>
<tr>
<td style="background: url('https://www.filepicker.io/api/file/kmlo6MonRpWsVuuM47EG') no-repeat center; background-color: #8b8284; background-position: center;" valign="top" bgcolor="#8b8284"><!-- [if gte mso 9]>
          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:303px;">
            <v:fill type="tile" src="https://www.filepicker.io/api/file/kmlo6MonRpWsVuuM47EG" color="#8b8284" />
            <v:textbox inset="0,0,0,0">
          <![endif]-->
<div><center>
<table class="w320" width="530" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="vertical-align: middle; padding-right: 15px; padding-left: 15px; text-align: left;" valign="middle" height="303">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<h1>THANK YOU FOR YOUR PURCHASE</h1>
<br />
<h2>Please review your email below or click the button to review your account.</h2>
</td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="hide reveal">&nbsp;</td>
<td style="width: 150px; height: 33px; background-color: #3bcdc3;">
<div><a style="background-color: #3bcdc3; border-radius: 4px; color: #ffffff; display: inline-block; font-family: sans-serif; font-size: 13px; font-weight: bold; line-height: 40px; text-align: center; text-decoration: none; width: 150px; -webkit-text-size-adjust: none;" href="#">My Account</a></div>
</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</center></div>
<!-- [if gte mso 9]>
            </v:textbox>
          </v:rect>
          <![endif]--></td>
</tr>
<tr>
<td valign="top"><center>
<table class="w320" width="500" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="border-bottom: 1px solid #a1a1a1;" valign="top">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mobile-padding" style="padding: 30px 0;">
<table class="force-full-width" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="text-align: left;"><span class="important-font"> Bob Erlicious <br /></span> 123 Flower Drive <br />Victoria, BC <br />V9P 2E8 <br />1(250)222-2232</td>
<td style="text-align: right; vertical-align: top;"><span class="important-font"> Invoice: {{ $data['invoice_no'] }}<br /></span> April 3, 2014</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td class="mobile-padding" style="padding-bottom: 30px;">
<table class="force-full-width" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mobile-block" width="33%">
<table class="force-full-width" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mobile-border" style="background-color: #3bcdc3; color: #ffffff; padding: 5px; border-right: 3px solid #ffffff;">ITEM</td>
</tr>
@foreach ($data['product'] as $product)
<tr>
<td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;">{{ $product['product_name'] }}</td>
</tr>
@endforeach
</tbody>
</table>
</td>
<td class="mobile-block" width="33%">
<table class="force-full-width" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mobile-border" style="background-color: #3bcdc3; color: #ffffff; padding: 5px; border-right: 3px solid #ffffff;">QUANTITY</td>
</tr>
@foreach ($data['product'] as $product)
<tr>
<td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;">{{ $product['order_qty'] }}</td>
</tr>
@endforeach
</tbody>
</table>
</td>
<td class="mobile-block" width="34%">
<table class="force-full-width" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="background-color: #3bcdc3; color: #ffffff; padding: 5px;">Amount</td>
</tr>
@foreach ($data['product'] as $product)
<tr>
<td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;">{{ $product['price'] *$product['order_qty'] }}</td>
</tr>
@endforeach
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td class="mobile-padding">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="text-align: left;">The amount of KSH50.00 CAD has been charged on the credit card ending with 0123. <br /><br /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table class="w320" width="500" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mobile-padding" style="text-align: left;"><br />Thank you for your business. Please <a href="{{ env('APP_URL') }}">contact us</a> with any questions regarding this invoice. <br /><br />Awesome Inc <br /><br /><br /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</center></td>
</tr>
<tr>
<td style="background-color: #c2c2c2;"><center>
<table class="w320" width="500" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<table style="height: 54px; width: 100%;" width="100%" cellspacing="0" cellpadding="30">
<tbody>
<tr style="height: 54px;">
<td style="text-align: center; height: 54px;"><a href="#"> <img src="https://www.filepicker.io/api/file/vkoOlof0QX6YCDF9cCFV" alt="twitter" width="61" height="51" /> </a> <a href="#"> <img src="https://www.filepicker.io/api/file/fZaNDx7cSPaE23OX2LbB" alt="google plus" width="61" height="51" /> </a> <a href="#"> <img src="https://www.filepicker.io/api/file/b3iHzECrTvCPEAcpRKPp" alt="facebook" width="61" height="51" /> </a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td><center>
<table style="margin: 0 auto;" width="100%" cellspacing="0" cellpadding="5">
<tbody>
<tr>
<td style="text-align: center; margin: 0 auto;" width="100%"><a style="text-align: center;" href="#"> <img style="margin: 0 auto;" src="{{ $logo }}" alt="logo link" width="187" height="84" /> </a></td>
</tr>
</tbody>
</table>
</center></td>
</tr>
</tbody>
</table>
</center></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</body>
</html>
