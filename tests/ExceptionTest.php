<?php

namespace tests;

use Advent\Dance;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Line size must be a integer.
     */
    public function testIntLineSize()
    {

        $dance = new Dance('test');

    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Line size cannot exceed alphabet.
     */
    public function testExceededLineSize()
    {

        $dance = new Dance(27);

    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Dance moves must be in format of array or comma delimited string.
     */
    public function testInvalidDanceCommandFormat()
    {

        $dance = new Dance(16);
        $dance->setDanceCommands(false);

    }

    //test spin move involving larger number than line or equal to line

}