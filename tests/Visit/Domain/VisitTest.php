<?php

namespace App\Tests\Visit\Domain;

use App\Visit\Domain\Visit;
use PHPUnit\Framework\TestCase;

class VisitTest extends TestCase
{
    public function testClassConstructor()
    {
        $today = new \DateTime('today');
        $hour = $today->format('H:i:s');

        $visit = new Visit(
            1,
            25,
            'Tienda Test',
            'Ruben Prol',
            $today,
            'Pruebas',
            $hour,
            $hour,
            true
        );

        $this->assertSame(1, $visit->getId());
        $this->assertSame(25, $visit->getShopId());
        $this->assertSame('Tienda Test', $visit->getShop());
        $this->assertSame('Ruben Prol', $visit->getEmployee());
        $this->assertSame($today, $visit->getDate());
        $this->assertSame('Pruebas', $visit->getComments());
        $this->assertSame($hour, $visit->getTimeStart());
        $this->assertSame($hour, $visit->getTimeEnd());
    }
}
