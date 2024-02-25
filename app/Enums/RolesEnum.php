<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RolesEnum extends Enum
{
    const ADMIN = 'admin';
    const SUPERADMIN = 'super-admin';
    const STAFF = 'staff';
    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::ADMIN => 'Admin',
            static::SUPERADMIN => 'Super Admin',
            static::STAFF => 'Staff',
        };
    }
}
