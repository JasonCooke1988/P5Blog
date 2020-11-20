<?php

namespace App\Core;

trait Hydrator
{
    public function hydrate($data)
    {

        foreach ($data as $key => $val) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->method($val);
            }
        }
    }
}