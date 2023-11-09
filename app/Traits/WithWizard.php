<?php

namespace App\Traits;

trait WithWizard
{
    public $step = 1;

    public $max_step = 3;

    public function nextStep()
    {
        if ($this->step < $this->max_step) {
            $this->step = $this->step + 1;
        }
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step = $this->step - 1;
        }
    }
}
