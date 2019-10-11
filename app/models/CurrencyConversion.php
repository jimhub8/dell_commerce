<?php

namespace App\models;


class CurrencyConversion
{
    public function convert($amount)
    {
        // set API Endpoint and access key (and any options of your choice)
        $endpoint = 'live';
        $access_key = '88f11addc6ab4eb5820ee7373100cec2';

        $to = 'USD';
        $from = 'KES';

        // initialize CURL:
        $ch = curl_init('http://apilayer.net/api/' . $endpoint . '?access_key=' . $access_key . '&from=' . $from . '&to=' . $to . '&amount=' . $amount . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // get the (still encoded) JSON data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $conversionResult = json_decode($json, true);
        // return ($conversionResult['quotes']['USDKES']);
        if ($amount / $conversionResult['quotes']['USDKES']) {
            return $amount / $conversionResult['quotes']['USDKES'];
        } else {
            $this->fixerCurrency($amount);
        }

        // return $conversionResult['USDKES'];
        // foreach ($conversionResult as $value) { }
        // // access the conversion result
        // echo $conversionResult['result'];
        // return;
    }

    public function fixerCurrency($amount)
    {
        $api = '48e2b624373fae6f33b18715bf6c6bfc';
        $string = file_get_contents("http://data.fixer.io/api/latest?access_key=$api&format=1");
        $json = json_decode($string, true);
        $i = 0;
        foreach ($json['rates'] as $key => $value) {
            $currency[$i] = $key;
            $rate[$i] = $value;
            $i = $i + 1;
        }
        $kes = $rate['KES'];
        $usd = $rate['USD'];
        return $amount * $usd/$kes;
    }
}
