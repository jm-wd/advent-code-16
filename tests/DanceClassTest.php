<?php

namespace tests;

use Advent\Dance;

class DanceClassTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider testDanceLineGenerationProvider
     */
    public function testDanceLineGenerationTest($lineSize, $expect)
    {

        $dance = new Dance($lineSize);

        $this->assertEquals($expect, $dance->getDanceLine());

    }

    public static function testDanceLineGenerationProvider()
    {

        return[
            [5,['a','b','c','d','e']],
            [10,['a','b','c','d','e','f','g','h','i','j']],
            [14,['a','b','c','d','e','f','g','h','i','j','k','l','m','n']],
            [20,['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t']],
            [26,['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z']],
        ];

    }

    /**
     * @dataProvider testDanceCommandListProvider
     */
    public function testDanceCommandList($danceLineSize, $danceCommands, $expect)
    {

        $dance = new Dance($danceLineSize);

        $dance->setDanceCommands($danceCommands);
        $dance->validateDanceCommands();

        $this->assertEquals($expect, $dance->getDanceCommands());

    }

    public static function testDanceCommandListProvider()
    {

        return[
            [26, 's1', ['s1']],
            [26, ['s1','xa/b', 'pc/f'], ['s1','xa/b', 'pc/f']],
            [26, 's3,xb/f,pg/f', ['s3','xb/f', 'pg/f']],
            [26, 'q3,db/f,pg/f', ['pg/f']],
        ];

    }

    /**
     * @dataProvider testDanceProgramValidationProvider
     */
    public function testDanceProgramValidation($danceCommands, $expect)
    {

        $dance = new Dance(26);

        $dance->setDanceCommands($danceCommands);

        $dance->validateDancePrograms();

        $this->assertEquals($expect, $dance->getDanceCommands());

    }

    public static function testDanceProgramValidationProvider()
    {

        return[
            ['s1', ['s1']],
            [['s14','xa/b', 'pc/ff'], ['s14','xa/b']],
            [['s27','xe/y', 'pc/ff', 'pd/v'], ['xe/y', 'pd/v']],
            [['s14','xa/c', 'pc/ff', 'pd/v'], ['s14', 'xa/c', 'pd/v']]
        ];

    }

}