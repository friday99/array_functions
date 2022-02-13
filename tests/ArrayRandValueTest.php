<?php


namespace Friday\Test;

use PHPUnit\Framework\TestCase;
use function Friday\array_rand_value;

class ArrayRandValueTest extends TestCase
{

    protected $array = [
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five'
    ];
    /**
     * @test
     */
    public function empty_array()
    {
        $this->assertNull( array_rand_value([]));
    }

    /**
     * @test
     */
    public function get_one_value()
    {
        $oneRandomValue = array_rand_value($this->array);
        $this->assertContains($oneRandomValue, $this->array);
    }

    /**
     * @test
     */
    public function get_multiple_value()
    {
        $testArrayValues = array_values($this->array);
        $num = rand(2, count($this->array));
        $randomArrayValues = array_rand_value($this->array, $num);
        $this->assertCount($num, $randomArrayValues);

        foreach ($randomArrayValues as $randomArrayValue) {
            $this->assertContains($randomArrayValue, $testArrayValues);
        }

    }
}