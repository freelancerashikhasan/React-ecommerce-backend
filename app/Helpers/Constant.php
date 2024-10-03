<?php
namespace App\Helpers;
class Constant{
    const PRODUCT_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];
    const POLICY_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];
    const TERMS_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];
    const USER_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];

    const USER_TYPE = [
        'user' => 0, // user means user
        'agent' => 1, //agent means branch
        'pharmacy' => 2, //pharmacy means pharmacy
        'customer' => 3 //customer means customer
    ];

    const PHARMACY_TYPE = [
        'A' => 0,
        'B' => 1,
        'C' => 2,
    ];

    const USER_APPROVAL_PERMISSION = [
        'yes' => 0,
        'no' => 1
    ];
    const GENERATION_STATUS = [
        'active' => 1,
        'deactive' => 0
    ];
    const BANNER_TYPE = [
        'home' => 0,
        'ads_banner_1' => 1,
        'ads_banner_2' => 2,
        'ads_banner_3' => 3,
        'ads_banner_4' => 4,
        'ads_banner_5' => 5,
    ];
    const METHOD = [
        'card' => 2,
        'bank' => 1,
    ];

    const WALLET_TYPE = [
        'active_balance' => 1,
        'trading_balance' => 2,
        'DTP_balance' => 3,
        'affiliate_comission' => 4,
        'team_business' => 5,
        'total_earn' => 6
    ];

    const TRANSACTION_TYPE = [
        'add_fund' => 1,
        'withdraw' => 2,
        'product_sell' => 3,
        'sell_commission' => 4,
        'product_purchase' => 5,
        'package_purchase' => 6,
        'transfer' => 7,
        'receive' => 8,
        'deposit' => 9,
        'generation_income' => 10,
        'package_sell' => 11,
        'self_entry_commission' => 12,
        'group_entry_commission' => 13,
        'customer_purchase' => 14,
        'pharmacy_purchase' => 15,
        'customer_order_commission' => 16,
        'pharmacy_order_commission' => 17,
    ];
    const WITHDRAW_STATUS = [
        'pending' => 1,
        'processing' => 2,
        'confirmed' => 3,
        'approved' => 4,
        'rejected' => 5,
    ];
    const STATUS = [
        'approved' => 1,
        'pending' => 2,
        'rejected' => 3,
        'cancel' => 4
    ];
    const IN_STATUS=[
        'active' => 1,
        'deactive' => 0,
    ];

    const INVOICE_COMMISSION_STATUS=[
        'no' => 0,
        'yes' => 1,
    ];

    const MINIMUM_AMOUNT = [
        'deposit' => 100,
        'withdraw' => 20,
    ];

    const CURRENCY = [
        'name' => 'BDT',
        'symble' => '৳',
    ];

    const ORDER_STATUS = [
        'pending' => 1,
        'placed' => 2,
        'logistic' => 3,
        'deliverd' => 4,
        'rejected' => 5,
    ];
    const ORDER_TYPE = [
        'customer' => 1,
        'pharmacy_a' => 2,
        'pharmacy_b' => 3,
        'pharmacy_c' => 4,
        'customer_repurchase' => 5,
    ];

    const GENDER = [
        'male' => 1,
        'female' => 2,
        'others' => 3,
    ];
    const MIN_YEAR = [
        'old' => 18,
    ];
    const PACKAGE_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];

    const MERCHANT_DATA_TYPE = [
        'with_trade_license' => 1,
        'without_trade_license' => 2,
    ];

    const DATA_APPROVAL_PERMISSION_WITH_LICENSE = [
        'yes' => 0,
        'no' => 1
    ];

    const DATA_APPROVAL_PERMISSION_WITHOUT_LICENSE = [
        'yes' => 0,
        'no' => 1
    ];

    const PAYMENT_METHOD = [
        'cod' => 0,
        'bkash' => 1,
        'ssl' => 1
    ];

    const PAYMENT_STATUS = [
        'unpaid' => 0,
        'paid' => 1,
    ];
}
