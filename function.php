<?php

require('function/debug.php');

function createMonster()
{
  d('新しくモンスターを作成します。');
  global $monsters, $monstersNum;
  $monster = $monsters[mt_rand(0, $monstersNum - 1)];
  $_SESSION['monster'] = $monster;
  d('モンスター：' . p($_SESSION['monster']));
  $_SESSION['historyOld'][] = $_SESSION['history'];
  History::clear();
  History::set($monster->getName() . 'が現れた！');
}

function gameOver()
{
  $_SESSION = array();
}

function init()
{
  History::clearAll();
  History::set('ゲームスタート！', '　');
  $_SESSION['knockDownNum'] = 0;
  $_SESSION['playerHP'] = 500;
  createMonster();
}
