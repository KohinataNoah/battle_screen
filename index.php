<?php

ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');

session_start();

const PLAYER_HP = 500;

require('class.php');
require('function.php');

$monsters[] = new Monsters('スライム', 'img/slime.png', 100, 10, 20);
$monsters[] = new Monsters('ゴーレム', 'img/golem.png', 300, 30, 60);
$monsters[] = new Monsters('オーク', 'img/orc.png', 200, 20, 40);
$monsters[] = new Monsters('ゴブリン', 'img/goblin.png', 150, 10, 30);

$monstersNum = count($monsters);

if (!empty($_POST)) {
  $attack_flg = (!empty($_POST['attack'])) ? true : false;
  $escape_flg = (!empty($_POST['escape'])) ? true : false;
  $stert_flg = (!empty($_POST['stert'])) ? true : false;

  // こうげきしたとき
  if ($attack_flg) {;
  }

  // にげたとき
  if ($escape_flg) {
    $_SESSION['history'] .= 'にげた！<br>';
  }

  // ゲームリスタートしたとき
  if ($restert_flg) {
    init();
  }

  if ($_SESSION['playerHP'] <= 0) {
    gameOver();
  } elseif ($_SESSION['monster']->getHP() <= 0) {
    $_SESSION['history'] .= $_SESSION['monster']->name . 'を倒した！';
    createMonster();
    $_SESSION['knockDownNum']++;
  }
}

$_POST = array();

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
      <?php if (empty($_SESSION)) : ?>
        <h2>GAME START</h2>
        <form action="" method="post">
          <input type="submit" value="ゲームスタート！" name="start">
        </form>
      <?php else : ?>
        <section class="b_monster">
          <h2 class="b_monsterName"><?= $_SESSION['monster']->getName() ?></h2><!-- /.b_monsterName -->
          <div class="e_img_wrapper">
            <img src="<?= $_SESSION['monster']->getImg() ?>" alt="モンスター画像">
          </div><!-- /.e_img_wrapper -->
        </section><!-- /.b_monster -->
        <section class="b_player">
          <p class="b_playerHp">HP:
            <? $_SESSION['playerHP'] ?>
          </p><!-- /.b_playerHp -->
        </section><!-- /.b_player -->
        <form action="" method="post" class="b_commandUnit">
          <label class="b_command">
            <input type="submit" value="こうげき" name="attack">
          </label><!-- /.b_command -->
          <label class="b_command">
            <input type="submit" value="にげる" name="runaway">
          </label><!-- /.b_command -->
          <label class="b_command">
            <input type="submit" value="ゲームリスタート" name="stert">
          </label><!-- /.b_command -->
        </form><!-- /.b_commandUnit -->
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