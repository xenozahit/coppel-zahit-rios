<?php

namespace App\Strategy;

use App\Entity\MonthlyPayment;

interface IsrStrategy
{
    public function calculateIsr(MonthlyPayment $monthlyPayment) :void;
}
