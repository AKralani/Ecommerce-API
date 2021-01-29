<?php

namespace App\Exceptions;

use Exception;

class SaleNotBelongToUser extends Exception
{
    public function render()
    {
        return ['errors' => 'Sale Not Belongs to You'];
    }
}
