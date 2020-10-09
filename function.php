<?php

require('function/debug.php');

function createMonster()
{
  global $monsters, $monstersNum;
  unset($_SESSION['name']);
  unset($_SESSION['hp']);
  unset($_SESSION['img']);
  $monster = $monsters[mt_rand(0, $monstersNum - 1)];
  $_SESSION['monster'] = $monster;
  $_SESSION['history'] = $monster->getName . 'が現れた！';
}

function gameOver()
{
  $_SESSION = array();
}
