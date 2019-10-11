<?php

namespace App\paypal;

use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\RedirectUrls;

class Refactor extends Paypal
{
    public function create(Request $request)
    {
        $payer = $this->payer();
        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321") // Similar to `item_number` in Classic API
            ->setPrice(2);
        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));
        $details = $this->Details();
        $amount = $this->Amount();
        $transaction = $this->Transaction();
        // $baseUrl = getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://chemist.dev/execute-payment")
            ->setCancelUrl("http://chemist.dev/cancel");
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        // $request = clone $payment;

        // try {
        $payment->create($this->apiContext);
        // } catch (Exception $ex) {
        //     ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
        //     exit(1);
        // }
        return redirect($payment->getApprovalLink());
        // ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

        // return $payment;
    }

    protected function payer()
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        return $payer;
    }

    protected function Details()
    {

        $details = new Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);
        return $details;
    }

    protected function Amount()
    {
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(20)
            ->setDetails($this->Details());
        return $amount;
    }

    protected function Transactions()
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->Amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
        return $transaction;
    }
}
