<?php

namespace App\Traits;

trait WithLazyLoad
{
    public $ready_to_load = false;

    public function fetch()
    {
        $this->ready_to_load = true;
    }
}
