<?php

require('function/debug.php');

function createMonster()
{
  global $monsters, $monstersNum;
  $_SESSION['monster'] = '';
  $monster = $monsters[mt_rand(0, $monstersNum - 1)];
  $_SESSION['monster'] = $monster;
  $_SESSION['history'] = $monster->getName() . 'が現れた！';
}

function gameOver()
{
  $_SESSION = array();
}

function init()
{
  $_SESSION['history'] = 'ゲームスタート！';
  $_SESSION['knockDownNum'] = 0;
  $_SESSION['playerHP'] = PLAYER_HP;
  createMonster();
}
