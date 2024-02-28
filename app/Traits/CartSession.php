<?php

namespace App\Traits;

trait CartSession
{

    public function setModeValue($key, $value)
    {
        session()->put($key, $value);
    }

    public function getModeValue($key)
    {
        if (!session($key)) {
            $this->setModeValue($key, '');
        }

        return session($key);
    }
}