<?php

require('../vendor/autoload.php');

use Advent\Dance;

$dance = new Dance(12);

$line = $dance->getDanceLine();

$commands = 's1,x6/3,pe/b';

$dance->setDanceCommands($commands);

$dance->validateData();

$dance->processDanceCommands();

print_r($dance->getDanceLine());
