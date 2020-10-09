<?php

function createMonster()
{
  global $monsters, $monsterNum;
  $monster = $monsters[mt_rand(0, $monsterNum - 1)];
  $_SESSION['monster'] = $monster;
}
