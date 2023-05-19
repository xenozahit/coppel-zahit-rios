<?php

namespace App\Strategy;

use App\Entity\MonthlyPayment;

class isr9Strategy implements IsrStrategy{

    const ISR = 9;

    public function calculateIsr(MonthlyPayment $monthlyPayment) :void{        
        $isrTaxRetentionMoney = $monthlyPayment->getTotalBeforeTaxes() * self::ISR / 100;
        $monthlyPayment->setIsrTaxRetentionPercentage(self::ISR)->setIsrTaxRetentionMoney($isrTaxRetentionMoney);
    }
}
