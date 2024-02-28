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