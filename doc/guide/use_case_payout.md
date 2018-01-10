## Example of payout (interest or repayments for crowdfunding)

With the payment type Payout (interest or repayments for crowdfunding), all required information is contained directly in the response to the init request and no iFrame is used.

With this payment method, unlike Refund, the original transactions are not affected. For payout a payment must be made. The transaction value can not be taken from the existing project credit.

```php
// Initialize the SecucardConnect client
$secucard = new SecucardConnect($config, $logger, $store, $store, $cred);

/**
 * @var \SecucardConnect\Product\Payment\SecupayPayoutService $service
 */
$service = $secucard->payment->secupaypayout;
$payout = new \SecucardConnect\Product\Payment\Model\SecupayPayout();
$payout->currency = 'EUR';
$payout->amount = 100;
$payout->purpose = 'Payout Purpose #1';
$payout->transaction_list = [];

// Add the transactions for the payout
$transaction = new \SecucardConnect\Product\Payment\Model\PayoutTransaction();
$transaction->name = 'Payout Purpose #1 - Trx #1';
$transaction->total = 100;
$transaction->transaction_hash = 'abcdefghi123456';
$payout->transaction_list[] = $transaction;
// It's possible to add up to 200 transactions

$payout = $service->save($payout);
```

In the response, the bank details and the purpose of use, which must be used for the transfer of the payout amount (for the assignment to work smoothly) are returned:

```js
        "purpose": "TA 10900020",
        "payment_data": {
            "accountowner": "secupay AG",
            "accountnumber": "1747013",
            "bankcode": "30050000",
            "iban": "DE88 3005 0000 0001 7470 13",
            "bic": "WELADEDDXXX",
            "bankname": "Landesbank Hessen-Thüringen Girozentrale NL. Düsseldorf"
        }
```
