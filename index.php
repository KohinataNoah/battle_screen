<?php

ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');

session_start();

class creature
{
  protected $name;
  protected $img;
  protected $hp;
  protected $minAtkPoint;
  protected $maxAtkPoint;

  public function __construct($name, $img, $hp, $minAtkPoint, $maxAtkPoint)
  {
    $this->name = $name;
    $this->img = $img;
    $this->hp = $hp;
    $this->minAtkPoint = $minAtkPoint;
    $this->maxAtkPoint = $maxAtkPoint;
  }

  public function attack()
  {
    $atkPoint = mt_rand($this->minAtkPoint, $this->maxAtkPoint);
    $_SESSION['playerHp'] -= $atkPoint;
    $_SESSION['history'] .= $this->name . 'は' . $atkPoint . 'ポイントのダメージを与えた！';
  }

  public function defense()
  {
  }
}



if (!empty($_POST)) {
  $attack_flg = (!empty($_POST['attack'])) ? true : false;
  $defense_flg = (!empty($_POST['defense'])) ? true : false;
  $escape_flg = (!empty($_POST['escape'])) ? true : false;
}

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
      <section class="b_monster">
        <h2 class="b_monsterName">モンスターの名前</h2><!-- /.b_monsterName -->
        <div class="e_img_wrapper">
          <img src="" alt="モンスター画像">
        </div><!-- /.e_img_wrapper -->
      </section><!-- /.b_monster -->
      <section class="b_player">
        <h2 class="b_playerName">プレイヤーの名前</h2><!-- /.b_playerName -->
        <p class="b_playerHp">HP: 500</p><!-- /.b_playerHp -->
      </section><!-- /.b_player -->
      <form action="" method="post" class="b_commandUnit">
        <label class="b_command">
          <input type="submit" value="こうげき" name="attack">
        </label><!-- /.b_command -->
        <label class="b_command">
          <input type="submit" value="ぼうぎょ" name="defense">
        </label><!-- /.b_command -->
        <label class="b_command">
          <input type="submit" value="にげる" name="runaway">
        </label><!-- /.b_command -->
      </form><!-- /.b_commandUnit -->
    </div><!-- /.l_main_inner -->
  </main><!-- /.l_main -->
  <footer class="l_footer">
    <div class="l_footer_inner">
      <div class="b_copyright"></div><!-- /.b_copyright -->
    </div><!-- /.l_footer_inner -->
  </footer><!-- /.l_footer -->
</body>

</html>