<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SaleTypeEnum extends Enum
{
    const SALE = 'sales';
    const RETURN = 'return';
    const ORDER = 'order';
    const ESTIMATE = 'estimate';
}
