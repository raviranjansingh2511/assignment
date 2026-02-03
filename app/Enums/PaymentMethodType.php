<?php

namespace App\Enums;

enum PaymentMethodType: string
{
    case STRIPE = 'stripe';
    case RUNAPAYMENT = 'runa-payment';
    case ONELATE = "onePay";
    // case PAYOUTS = 'payouts';
    // case CARD = 'card';
    // case FINIX = 'finix';
    // case PLAID = 'plaid';
    // case LOCKNPAY = 'locknpay';

    // case CHECKBOOK = 'checkbook';

    // case ONLINECHECKWRITER = 'onlinecheckwriter';

    // case MASSPAY = 'masspay';
    // case TABAPAY = 'tabapay';
    case PAYPAL = 'paypal';
    // case EMS = 'ems';
    // case LUMINO = 'lumino';
    // case IPAYOUTS = 'i-payouts';
    // case BEYOND = 'beyond';
    // case SILAMONEY = 'silamoney';

    // case NOWPAYMENT = 'NOWPAYMENT';
    // case NEWSTRIPE = 'newstripe';

    // case DOTSPAYMENT = 'dots-payment';

    // case CYBERSOURCE = 'cybersource-payment';
    // case CASHAPP = 'cash-app';
    // case TAILOREDAY = 'tailoreday';
    // case TRANSAK = 'transak';

    // case  BLOKKO = 'blokko';
    // case CLIQ = 'cliq';
    case TAILOERDAYHUBPAY = 'tailoreday-hubpay-deposit';

    case  EMSHUB = 'emshub';
     case CLIQPAYHUB = 'cliqpayhub';
    case BEYONDHUB = 'beyondhub';
    case LUMINOHUB = 'luminohub';
    // case OTHER = 'other';
}
