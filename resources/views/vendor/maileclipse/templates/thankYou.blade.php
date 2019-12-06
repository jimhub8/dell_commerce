<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Oxygen Confirm</title>

    <style type="text/css">
        /* Take care of image borders and formatting, client hacks */
        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        table {
            border-collapse: collapse !important;
        }

        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .backgroundTable {
            margin: 0 auto;
            padding: 0;
            width: 100% !important;
        }

        table td {
            border-collapse: collapse;
        }

        .ExternalClass * {
            line-height: 115%;
        }

        .container-for-gmail-android {
            min-width: 600px;
        }


        /* General styling */
        * {
            font-family: Helvetica, Arial, sans-serif;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            margin: 0 !important;
            height: 100%;
            color: #676767;
        }

        td {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #777777;
            text-align: center;
            line-height: 21px;
        }

        a {
            color: #676767;
            text-decoration: none !important;
        }

        .pull-left {
            text-align: left;
        }

        .pull-right {
            text-align: right;
        }

        .header-lg,
        .header-md,
        .header-sm {
            font-size: 32px;
            font-weight: 700;
            line-height: normal;
            padding: 35px 0 0;
            color: #4d4d4d;
        }

        .header-md {
            font-size: 24px;
        }

        .header-sm {
            padding: 5px 0;
            font-size: 18px;
            line-height: 1.3;
        }

        .content-padding {
            padding: 20px 0 5px;
        }

        .mobile-header-padding-right {
            width: 290px;
            text-align: right;
            padding-left: 10px;
        }

        .mobile-header-padding-left {
            width: 290px;
            text-align: left;
            padding-left: 10px;
        }

        .free-text {
            width: 100% !important;
            padding: 10px 60px 0px;
        }

        .button {
            padding: 30px 0;
        }


        .mini-block {
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            background-color: #ffffff;
            padding: 12px 15px 15px;
            text-align: left;
            width: 253px;
        }

        .mini-container-left {
            width: 278px;
            padding: 10px 0 10px 15px;
        }

        .mini-container-right {
            width: 278px;
            padding: 10px 14px 10px 15px;
        }

        .product {
            text-align: left;
            vertical-align: top;
            width: 175px;
        }

        .total-space {
            padding-bottom: 8px;
            display: inline-block;
        }

        .item-table {
            padding: 50px 20px;
            width: 560px;
        }

        .item {
            width: 300px;
        }

        .mobile-hide-img {
            text-align: left;
            width: 125px;
        }

        .mobile-hide-img img {
            border: 1px solid #e6e6e6;
            border-radius: 4px;
        }

        .title-dark {
            text-align: left;
            border-bottom: 1px solid #cccccc;
            color: #4d4d4d;
            font-weight: 700;
            padding-bottom: 5px;
        }

        .item-col {
            padding-top: 20px;
            text-align: left;
            vertical-align: top;
        }

        .force-width-gmail {
            min-width: 600px;
            height: 0px !important;
            line-height: 1px !important;
            font-size: 1px !important;
        }
    </style>

    <style type="text/css" media="screen">
        @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
    </style>

    <style type="text/css" media="screen">
        @media screen {

            /* Thanks Outlook 2013! */
            * {
                font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
            }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 480px)">
        /* Mobile styles */
        @media only screen and (max-width: 480px) {

            table[class*="container-for-gmail-android"] {
                min-width: 290px !important;
                width: 100% !important;
            }

            img[class="force-width-gmail"] {
                display: none !important;
                width: 0 !important;
                height: 0 !important;
            }

            table[class="w320"] {
                width: 320px !important;
            }


            td[class*="mobile-header-padding-left"] {
                width: 160px !important;
                padding-left: 0 !important;
            }

            td[class*="mobile-header-padding-right"] {
                width: 160px !important;
                padding-right: 0 !important;
            }

            td[class="header-lg"] {
                font-size: 24px !important;
                padding-bottom: 5px !important;
            }

            td[class="content-padding"] {
                padding: 5px 0 5px !important;
            }

            td[class="button"] {
                padding: 5px 5px 30px !important;
            }

            td[class*="free-text"] {
                padding: 10px 18px 30px !important;
            }

            td[class~="mobile-hide-img"] {
                display: none !important;
                height: 0 !important;
                width: 0 !important;
                line-height: 0 !important;
            }

            td[class~="item"] {
                width: 140px !important;
                vertical-align: top !important;
            }

            td[class~="quantity"] {
                width: 50px !important;
            }

            td[class~="price"] {
                width: 90px !important;
            }

            td[class="item-table"] {
                padding: 30px 20px !important;
            }

            td[class="mini-container-left"],
            td[class="mini-container-right"] {
                padding: 0 15px 15px !important;
                display: block !important;
                width: 290px !important;
            }
        }
    </style>
</head>

<body bgcolor="#f7f7f7">
<p>&nbsp;</p>
<table class="container-for-gmail-android" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="background: repeat-x url('http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg') #ffffff;" align="left" valign="top" width="100%"><center><img class="force-width-gmail" src="http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png" />
<table style="background-color: transparent;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tbody>
<tr>
<td style="text-align: center; vertical-align: middle;" valign="top" width="100%" height="80"><!-- [if gte mso 9]>
            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:80px; v-text-anchor:middle;">
              <v:fill type="tile" src="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" color="#ffffff" />
              <v:textbox inset="0,0,0,0">
            <![endif]--><center>
<table class="w320" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="pull-left mobile-header-padding-left" style="vertical-align: middle;"><a><img src="../../../../storage/logo/logo.png" alt="logo" width="140" height="99" /></a></td>
<td class="pull-right mobile-header-padding-right" style="color: #4d4d4d;"><a><img src="http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif" alt="twitter" width="44" height="47" /></a> <a><img src="http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif" alt="facebook" width="38" height="47" /></a> <a><img src="http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif" alt="rss" width="40" height="47" /></a></td>
</tr>
</tbody>
</table>
</center><!-- [if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]--></td>
</tr>
</tbody>
</table>
</center></td>
</tr>
<tr>
<td class="content-padding" style="background-color: #f7f7f7;" align="center" valign="top" width="100%"><center>
<table class="w320" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="header-lg">Your order has received!</td>
</tr>
<tr>
<td class="free-text">We wanted to let you know that we just received your order <a>#23141</a>. You'll find all the details below.</td>
</tr>
<tr>
<td class="button">
<div><!-- [if mso]>
                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:155px;" arcsize="15%" strokecolor="#ffffff" fillcolor="#ff6f6f">
                  <w:anchorlock/>
                  <center style="color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;">Track Order</center>
                </v:roundrect>
              <![endif]--><a style="background-color: #ff6f6f; border-radius: 5px; color: #ffffff; display: inline-block; font-family: 'Cabin', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: regular; line-height: 45px; text-align: center; text-decoration: none; width: 155px; -webkit-text-size-adjust: none; mso-hide: all;" href="http://127.0.0.1">Track Order</a></div>
</td>
</tr>
<tr>
<td class="w320">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mini-container-left">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mini-block-padding">
<table style="border-collapse: separate !important;" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mini-block"><span class="header-sm">Shipping Address</span><br />Jane Doe <br />123 Street <br />Victoria, BC <br />Canada</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
<td class="mini-container-right">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mini-block-padding">
<table style="border-collapse: separate !important;" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mini-block"><span class="header-sm">Date Shipped</span><br />January 12, 2015 <br /><br /><span class="header-sm">Order</span> <br />#12342</td>
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
</td>
</tr>
</tbody>
</table>
</center></td>
</tr>
<tr>
<td style="background-color: #ffffff; border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;" align="center" valign="top" width="100%"><center>
<table class="w320" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="item-table">@foreach ($order->sales as $item)<br />
<table style="width: 100%;" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="title-dark" style="width: 53.5714%;" width="300">Item</td>
<td class="title-dark" style="width: 30.1786%;" width="163">Qty</td>
<td class="title-dark" style="width: 16.25%;" width="97">Total</td>
</tr>
<tr>
<td class="item-col item" style="width: 53.5714%;">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="mobile-hide-img"><img src="http://s3.amazonaws.com/swu-filepicker/RPezUIwPRv8pjatAAH1E_item_images_19.jpg" alt="item1" width="110" height="92" /></td>
<td class="product"><span style="color: #4d4d4d; font-weight: bold;">{{ $item->product->product_name }}</span> {{-- <br />{{ $item->product->description }} --}}</td>
</tr>
</tbody>
</table>
</td>
<td class="item-col quantity" style="width: 30.1786%;">{{ $item->quantity }}</td>
<td class="item-col" style="width: 16.25%;">KSH{{ $item->price }}</td>
</tr>
<tr>
<td class="item-col item mobile-row-padding" style="width: 53.5714%;">@endforeach</td>
<td class="item-col quantity" style="width: 30.1786%;">&nbsp;</td>
<td class="item-col price" style="width: 16.25%;">&nbsp;</td>
</tr>
<tr>
<td class="item-col item" style="width: 53.5714%;">&nbsp;</td>
<td class="item-col quantity" style="text-align: right; padding-right: 10px; border-top: 1px solid #cccccc; width: 30.1786%;">{{-- <span class="total-space">Subtotal</span> <br /><span class="total-space">Tax</span> <br /><span class="total-space">Shipping</span> <br /><span class="total-space" style="font-weight: bold; color: #4d4d4d;">Total</span>--}}</td>
<td class="item-col price" style="text-align: left; border-top: 1px solid #cccccc; width: 16.25%;">{{-- <span class="total-space">KSH{{ $cart_total }}</span>&nbsp;<br /><span class="total-space">KSH 75</span> <br /><span class="total-space">KSH 30</span>&nbsp;<br />--}} <span class="total-space" style="font-weight: bold; color: #4d4d4d;">KSH {{ $cart_total }}</span></td>
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
<td style="background-color: #f7f7f7; height: 100px;" align="center" valign="top" width="100%"><center>
<table class="w320" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding: 25px 0 25px;"><strong>Awesome Inc</strong><br />1234 Awesome St <br />Wonderland <br /><br /></td>
</tr>
</tbody>
</table>
</center></td>
</tr>
</tbody>
</table>
</body>

</html>
