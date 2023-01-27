<?php

namespace App\Tests\Product\Domain;

use App\Product\Domain\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    public function testClassConstructor()
    {
        $product = new Product(
            1,
            'Pañales',
            'Bebes',
            'Dodotos',
            'Pañales de bebé',
            '123456',
            12.80,
            2.0,
            true
        );

        $this->assertSame(1, $product->getId());
        $this->assertSame('Pañales', $product->getCategory());
        $this->assertSame('Bebes', $product->getGroup());
        $this->assertSame('Dodotos', $product->getBrand());
        $this->assertSame('123456', $product->getEan());
        $this->assertSame(12.80, $product->getPrice());
        $this->assertSame(2.0, $product->getCapacity());
        $this->assertSame(true, $product->isActive());
    }

}
