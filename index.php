<?php

ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');

const PLAYER_HP = 500;
$monsters = array();

require('class/monster_class.php');
require('class/history_class.php');
require('function.php');

session_start();

$monsters[] = new Monster('スライム', 'img/slime.png', 100, 10, 20);
$monsters[] = new Monster('ゴーレム', 'img/golem.png', 300, 30, 60);
$monsters[] = new Monster('オーク', 'img/orc.png', 200, 20, 40);
$monsters[] = new Monster('ゴブリン', 'img/goblin.png', 150, 10, 30);
$monsters[] = new MagicMonster('ドラキュラ', 'img/dracula.png', 200, 20, 30, 50);

$monstersNum = count($monsters);


d('SESSION:' . p($_SESSION));
$start_flg = (!empty($_POST['start'])) ? true : false;

// ゲームリスタートしたとき
if ($start_flg) {
  init();
}

if (!empty($_POST) && !empty($_SESSION)) {
  $attack_flg = (!empty($_POST['attack'])) ? true : false;
  $escape_flg = (!empty($_POST['escape'])) ? true : false;

  // こうげきしたとき
  if ($attack_flg) {
    $playerAtkPoint = mt_rand(0, 100);
    if (!mt_rand(0, 7)) {
      History::set('かいしんのいちげき！');
      $playerAtkPoint *= 2;
    }
    $_SESSION['monster']->setHP($_SESSION['monster']->getHP() - $playerAtkPoint);
    History::set($playerAtkPoint . 'ポイントのダメージを与えた！');

    $_SESSION['monster']->attack();
  }

  // にげたとき
  if ($escape_flg) {
    History::set('にげた！');
    createMonster();
  }


  if ($_SESSION['playerHP'] <= 0) {
    gameOver();
  } elseif ($_SESSION['monster']->getHP() <= 0) {
    history::set($_SESSION['monster']->getName() . 'を倒した！', '　');
    createMonster();
    $_SESSION['knockDownNum']++;
  }
}

$firstPage_flg = (empty($_SESSION)) ? true : false;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ロールプレイング！</title>
</head>

<body>
  <header class="l_header">
    <div class="l_header_inner">
      <h1 class="b_siteTtl">
        <span>ロールプレイング！</span>
      </h1><!-- /.b_siteTtl -->
    </div><!-- /.l_header_inner -->
  </header><!-- /.l_header -->
  <main class="l_main">
    <div class="l_main_inner">
      <?php if ($firstPage_flg) : ?>
        <h2>GAME START</h2>
        <form action="" method="post">
          <input type="submit" value="ゲームスタート！" name="start">
        </form>
      <?php else : ?>
        <section class="b_monster">
          <h2 class="b_monsterName"><?= $_SESSION['monster']->getName() ?>が現れた！</h2><!-- /.b_monsterName -->
          <div class="e_img_wrapper">
            <img src="<?= $_SESSION['monster']->getImg() ?>" alt="モンスター画像">
          </div><!-- /.e_img_wrapper -->
          <p><?= $_SESSION['monster']->getHP() ?></p>
        </section><!-- /.b_monster -->
        <section class="b_player">
          <p class="b_playerHp">HP:
            <?= $_SESSION['playerHP'] ?>
          </p><!-- /.b_playerHp -->
          <p class="b_playerKnockDownNum"><?= $_SESSION['knockDownNum'] ?></p><!-- /.b_playerKnockDownNum -->
        </section><!-- /.b_player -->
        <form action="" method="post" class="b_commandUnit">
          <label class="b_command">
            <input type="submit" value="こうげき" name="attack">
          </label><!-- /.b_command -->
          <label class="b_command">
            <input type="submit" value="にげる" name="escape">
          </label><!-- /.b_command -->
          <label class="b_command">
            <input type="submit" value="ゲームリスタート" name="start">
          </label><!-- /.b_command -->
        </form><!-- /.b_commandUnit -->
      <?php endif; ?>
      <?php if (!empty($_SESSION['history'])) : ?>
        <div style="position:absolute; left: 400px; top: 0; color: black; width: 500px; line-height: 150%; overflow: scroll; height: 900px;">
          <?php
          foreach ($_SESSION['history'] as $key => $val) :
          ?>
            <p><?= $val ?></p>
          <?php
          endforeach; ?>
        </div>
        <div style="position:absolute; left: 920px; top: 0; color: black; width: 500px; line-height: 150%; overflow: scroll; height: 900px;">
          <?php
          foreach ($_SESSION['historyOld'] as $key => $val) :
            foreach ($val as $key2 => $val2) :
          ?>
              <p><?= $val2 ?></p>
          <?php
            endforeach;
          endforeach; ?>
        </div>
      <?php endif; ?>
    </div><!-- /.l_main_inner -->
  </main><!-- /.l_main -->
  <footer class="l_footer">
    <div class="l_footer_inner">
      <div class="b_copyright"></div><!-- /.b_copyright -->
    </div><!-- /.l_footer_inner -->
  </footer><!-- /.l_footer -->
</body>

</html>