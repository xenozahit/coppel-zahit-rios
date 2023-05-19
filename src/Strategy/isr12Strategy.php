<?php

namespace App\Strategy;

use App\Entity\MonthlyPayment;

class isr12Strategy implements IsrStrategy{

    const ISR = 12;

    public function calculateIsr(MonthlyPayment $monthlyPayment) :void{        
        $isrTaxRetentionMoney = $monthlyPayment->getTotalBeforeTaxes() * self::ISR / 100;
        $monthlyPayment->setIsrTaxRetentionPercentage(self::ISR)->setIsrTaxRetentionMoney($isrTaxRetentionMoney);
    }
}
