<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PaymentMethodEnum extends Enum
{
    const CREDITCARD = 'credit-card';
    const DEBITCARD = 'debit-card';
    const ACH = 'automated-clearing-house';
    const CASH = 'cash';
    const PAPERCHECK = 'paper-check';
    const ECHECK = 'e-check';
    const DIGITALPAYMENT = 'digital-payment';
    const MONEYORDER = 'money-order';
    const PARTIAL = 'partial';
}

