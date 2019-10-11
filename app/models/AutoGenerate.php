<?php

namespace App\models;

use App\Order;

class AutoGenerate
{
    public function randomSku()
    {
        $product = Product::select('id')->orderBy('id', 'Desc')->first();
        // $id = ''.str_pad($product->id + 1, 8, "0", STR_PAD_LEFT);
        $product = ($product) ? 'SKU_' . str_pad($product->id + 1, 8, "0", STR_PAD_LEFT) : 'SKU_' . str_pad(1, 8, "0", STR_PAD_LEFT);
        $validator = \Validator::make(['sku_no' => $product], ['sku_no' => 'unique:products,sku_no']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $product;
    }

    public function randomPaymentId()
    {
        $product = Order::select('id')->orderBy('id', 'Desc')->first();
        // $id = ''.str_pad($product->id + 1, 8, "0", STR_PAD_LEFT);
        $product = ($product) ? 'PAYID-' . str_pad($product->id + 1, 8, "0", STR_PAD_LEFT) : 'DEL_' . str_pad(1, 8, "0", STR_PAD_LEFT);
        $validator = \Validator::make(['payment_id' => $product], ['payment_id' => 'unique:orders,payment_id']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $product;
    }

    public function randomClientId()
    {
        $client = Client::select('id')->orderBy('id', 'Desc')->first();
        // $id = ''.str_pad($product->id + 1, 8, "0", STR_PAD_LEFT);
        $client = ($client) ? 'CL_' . str_pad($client->id + 1, 8, "0", STR_PAD_LEFT) : 'CL_' . str_pad(1, 8, "0", STR_PAD_LEFT);
        $validator = \Validator::make(['client_id' => $client], ['client_id' => 'unique:clients,client_id']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $client;
    }
    public function randomReturnId()
    {
        $returns = ReturnOrder::select('id')->orderBy('id', 'Desc')->first();
        // $id = ''.str_pad($product->id + 1, 8, "0", STR_PAD_LEFT);
        $returns = ($returns) ? 'RTN_' . str_pad($returns->id + 1, 8, "0", STR_PAD_LEFT) : 'DEL_' . str_pad(1, 8, "0", STR_PAD_LEFT);
        // dd($returns);
        $validator = \Validator::make(['return_id' => $returns], ['return_id' => 'unique:return_orders,return_id']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $returns;
    }

    public function randomInvoiceNo()
    {
        $invoices = Invoice::select('id')->orderBy('id', 'Desc')->first();
        // $id = ''.str_pad($product->id + 1, 8, "0", STR_PAD_LEFT);
        $invoices = ($invoices) ? 'INV_' . str_pad($invoices->id + 1, 8, "0", STR_PAD_LEFT) : 'DEL_' . str_pad(1, 8, "0", STR_PAD_LEFT);
        $validator = \Validator::make(['return_id' => $invoices], ['return_id' => 'unique:invoices,return_id']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $invoices;
    }

    public function randomReferenceNo()
    {
        $history = History::select('id')->orderBy('id', 'Desc')->first();
        // $id = ''.str_pad($product->id + 1, 8, "0", STR_PAD_LEFT);
        $history = ($history) ? 'REF_' . str_pad($history->id + 1, 8, "0", STR_PAD_LEFT) : 'REF_' . str_pad(1, 8, "0", STR_PAD_LEFT);
        $validator = \Validator::make(['reference_no' => $history], ['reference_no' => 'unique:histories,reference_no']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $history;
    }

    public function randomId()
    {
        $id = str_random(10);
        $validator = \Validator::make(['sku_no' => $id], ['sku_no' => 'unique:products,sku_no']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $id;
    }
}
