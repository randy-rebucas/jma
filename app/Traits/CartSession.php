<?php

namespace App\Traits;

trait CartSession
{

    public function setModeValue($key, $value)
    {
        session()->put($key, $value);
    }

    public function getModeValue($key, $module)
    {
        switch ($module) {
            case 'job':
                $base_mode_value = config('settings.job_register_mode');
                break;
            case 'sale':
                $base_mode_value = config('settings.sale_register_mode');
                break;
            case 'receiving':
                $base_mode_value = config('settings.receiving_register_mode');
                break;
            default:
                $base_mode_value = '';
                break;
        }
        if (!session($key)) {
            $this->setModeValue($key, $base_mode_value);
        }

        return session($key);
    }

    public function setTypeValue($key, $value)
    {
        session()->put($key, $value);
    }

    public function getTypeValue($key)
    {
        if (!session($key)) {
            $this->setTypeValue($key, '');
        }

        return session($key);
    }
}