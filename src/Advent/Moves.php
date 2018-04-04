<?php

namespace Advent;

class Moves
{

    protected $moves = [];
    protected $movePrefixes = ['s', 'x', 'p'];
    protected $moveCommand;
    protected $movePrograms;

    public function processMove($move, $danceLine)
    {

        //set movePrefixes to key val and use $this->{'func name'} for more condense code?
        $this->setMoveCommand($move);
        $this->setMovePrograms($move);

        switch($this->moveCommand)
        {

            case 's':
                $line = $this->spin($this->movePrograms, $danceLine);
                break;
            case 'x':
                $line = $this->exchange($this->movePrograms, $danceLine);
                break;
            case 'p':
                $line = $this->partner($this->movePrograms, $danceLine);
                break;
            default:
                return false;

        }

        return $line;

    }

    public function setMoveCommand($move)
    {
        $this->moveCommand = substr($move, 0, 1);

    }

    public function setMovePrograms($move)
    {

        $this->movePrograms = explode('/', substr($move, 1));

    }


    public function spin($programAmount, $danceLine)
    {

        //move from end to the front

        for($i = 0; $i < (int)$programAmount; $i++)
        {

            $element = array_pop($danceLine);
            array_unshift($danceLine, $element);

        }

        return $danceLine;

    }

    public function exchange($programs, &$danceLine)
    {

        //$element = array_splice($danceLine, (int)$programs[0], 1);
        //array_splice($danceLine, (int)$programs[1], 0, $element);

        //array_splice($danceLine,max((int)$programs[1],0),0,array_splice($danceLine,max((int)$programs[0],0),1));

        //Only method that seems to fully work by copying then replacing elements separately
        $firstElement = $danceLine[(int)$programs[0]];
        $secondElement = $danceLine[(int)$programs[1]];

        $danceLine[(int)$programs[0]] = $secondElement;
        $danceLine[(int)$programs[1]] = $firstElement;

        return $danceLine;

    }

    public function partner($programs, $danceLine)
    {

        //Does not affect key index only values within
        $firstPosition = array_search($programs[0], $danceLine, true);
        $secondPosition = array_search($programs[1], $danceLine, true);

        $firstElement = $danceLine[$firstPosition];
        $secondElement = $danceLine[$secondPosition];

        $danceLine[$firstPosition] = $secondElement;
        $danceLine[$secondPosition] = $firstElement;

        return $danceLine;

    }

}