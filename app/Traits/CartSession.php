<?php

namespace App\Traits;

trait CartSession {
    
    protected $mode_key;
    protected $mode_value;

    protected function initModeKey($key, $value = '')
    {
        $this->mode_key = $key;
        $this->mode_value = $value;
    }

    public function setModeValue($value) {
        session()->put($this->mode_key, $value);
    }

    public function getModeValue() {
        if (!session($this->mode_key)) {
            $this->set($this->mode_value);
        }

        return session($this->mode_key);
    }
}