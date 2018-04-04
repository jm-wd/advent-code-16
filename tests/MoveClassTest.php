<?php

namespace tests;

use Advent\Moves;

class MoveClassTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider testSpinProvider
     */
    public function testSpin($move, $danceLine, $expect)
    {

        $moves = new Moves();

        $updatedDanceLine = $moves->processMove($move, $danceLine);

        $this->assertEquals($expect, $updatedDanceLine);

    }

    public static function testSpinProvider()
    {

        $danceLine = range('a', 'f');

        return[
          ['s2', $danceLine, ['e','f','a','b','c','d']]
        ];


    }

    /**
     * @dataProvider testExchangeProvider
     */
    public function testExchange($move, $danceLine, $expect)
    {

        $moves = new Moves();

        $updatedDanceLine = $moves->processMove($move, $danceLine);

        $this->assertEquals($expect, $updatedDanceLine);

    }

    public static function testExchangeProvider()
    {


        $danceLine = range('a', 'e');

        return[
            ['x3/4', $danceLine, ['a','b','c','e','d']],
            ['x4/1', $danceLine, ['a','e','c','d','b']],
            ['x0/3', $danceLine, ['d','b','c','a','e']]
        ];

    }

    /**
     * @dataProvider testPartnerProvider
     */
    public function testPartner($move, $danceLine, $expect)
    {

        //switch array positions based on alphabetic val
        $moves = new Moves();

        $updatedDanceLine = $moves->processMove($move, $danceLine);

        $this->assertEquals($expect, $updatedDanceLine);

    }

    public static function testPartnerProvider()
    {


        $danceLine = range('a', 'e');

        return[
            ['pd/e', $danceLine, ['a','b','c','e','d']],
            ['pe/b', $danceLine, ['a','e','c','d','b']],
            ['pa/d', $danceLine, ['d','b','c','a','e']]
        ];

    }

}