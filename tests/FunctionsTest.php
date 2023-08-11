<?php

use PHPUnit\Framework\TestCase;
require 'functions.php';
class FunctionsTest extends TestCase
{
    public function test_sonlarni_qoshsa_bolyapti()
    {
        $result = addNumbers(25, 35);
        $this->assertSame(60, $result, "test muvaffaqiyatli o'tmadi");
        $this->assertNotSame(50, $result, "test muvaffaqiyatli o'tmadi  l");
    }

    /**
     * @test
     */
    public function array_qaytaryapti()
    {
        $this->assertIsArray(returnCars(), 'Array qaytaryapti');
    }
}