<?php

namespace Advent;

class Dance extends Moves
{

    private $danceLine = [];
    private $danceCommands = [];
    private $alphabet;

    /**
     * @param int $lineSize
     * @throws \Exception
     */
    public function __construct($lineSize)
    {

        $this->alphabet = range('a', 'z');

        if(!is_int($lineSize))
            throw new \Exception('Line size must be a integer.');

        if($lineSize > count($this->alphabet))
            throw new \Exception('Line size cannot exceed alphabet.');

        for($i = 0; $i < $lineSize;$i++)
        {

            $this->danceLine[] = $this->alphabet[$i];

        }

    }

    public function getDanceLine()
    {

        return $this->danceLine;

    }

    public function setDanceCommands($danceCommands)
    {

        if(!is_array($danceCommands) && !is_string($danceCommands))
            throw new \Exception('Dance moves must be in format of array or comma delimited string.');

        if(is_string($danceCommands))
            $this->danceCommands = explode(',', $danceCommands);
        else
            $this->danceCommands = $danceCommands;

        //$this->validateDanceCommands();
        //$this->validateDancePrograms();

    }

    public function getDanceCommands()
    {

        return $this->danceCommands;

    }

    public function validateDanceCommands()
    {

        foreach($this->danceCommands as $key => $val)
        {

            //get initial char for dance move prefix check
            $danceType = substr($val, 0, 1);

            if(!in_array($danceType, $this->movePrefixes))
                unset($this->danceCommands[$key]);

        }

        //Rebase array
        $this->danceCommands = array_values($this->danceCommands);

    }

    public function validateDancePrograms()
    {

        foreach($this->danceCommands as $key => $val)
        {

            //check for position elements
            if(strpos($val, '/') !== false)
            {
                //get initial char for dance move prefix check
                $dancePrograms = explode('/', substr($val, 1));

                //split on / check both exist in dance list
                $existingPrograms = true;

                foreach($dancePrograms as $programPosition)
                {

                    //var_dump($programPosition);

                    //check for index position (exchange) and val (partner)
                    $existingKey = array_search($programPosition, $this->danceLine, true);
                    $existingVal = $this->danceLine[(int)$programPosition];
                    //if(array_search($programPosition, $this->danceLine, true) === false)

                    if($existingKey === false && !isset($existingVal))
                        $existingPrograms = false;

                }

                if(!$existingPrograms)
                    unset($this->danceCommands[$key]);

            }
            else
            {
                //check valid numeric command against line size

                //get initial char for dance move prefix check
                $dancePrograms = (int)substr($val, 1);

                if($dancePrograms > count($this->danceLine))
                    unset($this->danceCommands[$key]);

            }


        }

        //Rebase array
        $this->danceCommands = array_values($this->danceCommands);

    }

    public function validateData()
    {

        $this->validateDanceCommands();
        $this->validateDancePrograms();

    }

    public function processDanceCommands()
    {

        foreach($this->danceCommands as $move)
        {

            $this->danceLine = $this->processMove($move, $this->danceLine);

        }

    }


}