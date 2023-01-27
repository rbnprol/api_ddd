<?php

namespace App\Tests\Shop\Domain;

use App\Shop\Domain\Shop;
use PHPUnit\Framework\TestCase;

class ShopTest extends TestCase
{
    public function testClassConstructor()
    {
        $shop = new Shop(
            1,
            'Supermercado',
            'Condis',
            'Tienda Test',
            'Calle unit test, 3',
            '08208',
            'España',
            'Catalunya',
            'Barcelona',
            'Sabadell',
            true,
        );

        $this->assertSame(1, $shop->getId());
        $this->assertSame('Supermercado', $shop->getShopType());
        $this->assertSame('Condis', $shop->getLabel());
        $this->assertSame('Tienda Test', $shop->getName());
        $this->assertSame('Calle unit test, 3', $shop->getAddress());
        $this->assertSame('08208', $shop->getPostalCode());
        $this->assertSame('España', $shop->getCountry());
        $this->assertSame('Catalunya', $shop->getAutonomy());
        $this->assertSame('Barcelona', $shop->getProvince());
        $this->assertSame('Sabadell', $shop->getPopulation());
        $this->assertSame(true, $shop->isActive());
    }
}
