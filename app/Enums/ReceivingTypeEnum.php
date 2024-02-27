<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ReceivingTypeEnum extends Enum
{
    const RECEIVE = 'receive';

    const RETURN = 'return';
}
