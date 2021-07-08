<?php
// 非会員ページ
include('functions.php');
$pdo = connect_to_db();

// 参照はSELECT文!
$sql = 'SELECT * FROM fish_list';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// $statusにSQLの実行結果が入る(取得したデータではない点に注意)

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    $output .= "<div class='card shadow-sm'>";
    $output .= "<img class='card-img-top' src='fish/kijihata.jpeg' alt=''>";
    $output .= "<div class='card-body'><strong>{$record["title"]}</strong><br><p class='card-text'>{$record["detail"]}<br>受け渡し場所:{$record["place"]}<br>申込期限:{$record["deadline"]}</p></div>";
    $output .= "<div class='card-footer'>";
    $output .= "<div class='btn-group'>";
    $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'>詳細</button>";
    // $output .= "<button type='button' class='btn btn-sm btn-outline-secondary'>編集</button>";
    $output .= "</div>";
    $output .= "<small class='text-muted'>投稿日時:{$record["updated_at"]}</small>";
    $output .= "</div>";
    $output .= "</div>";
  }
}
?>

<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Fish example · Bootstrap</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">

  <!-- Bootstrap core CSS -->
  <link href="bootstrap.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .top-img {
      background-image: url(img/ship.png);
      background-color: rgba(255, 255, 255, 0.3);
      background-blend-mode: lighten;
      background-size: cover;
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="album.css" rel="stylesheet">
</head>

<body>
  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">About</h4>
            <p class="text-muted">
              釣りって楽しいですよね。ボウズもあるのに、クーラーボックスが溢れることもある。おさかなシェアはクーラーボックスから溢れたお魚を、喜んで貰ってくれる人とシェアできたらいいな、という想いから生まれたサービスです。
            </p>
          </div>
          <div class="col-sm-4 offset-md-1 py-4">
            <h4 class="text-white">Contact</h4>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white">Follow on Twitter</a></li>
              <li><a href="#" class="text-white">Like on Facebook</a></li>
              <li><a href="#" class="text-white">Email me</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="../album/login/login.php" class="navbar-brand d-flex align-items-center">
          <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2"
            viewBox="0 0 24 24" focusable="false">
            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
            <circle cx="12" cy="13" r="4" />
          </svg> -->
          <small id="login">ログイン</small>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
  </header>

  <main role="main">

    <section class="jumbotron text-center top-img">
      <div class="container">
        <h1>おさかなシェア</h1>
        <p class="lead text-muted"><br>たくさん釣れた魚、シェアしたい。<br><br>持ち帰るのも困るほど大漁だった日は、<br>おさかなシェアで魚を貰ってくれる人を見つけましょう</p>
        <p>
          <a href="new_resister/new_register_input.php" class="btn btn-primary my-2">新規会員登録</a><br>
          <a href="give/give_read.php" class="btn btn-secondary my-2">募集中の魚を見る</a>
        </p>
      </div>
    </section>

    <div class="card-columns">

      <?= $output ?>

    </div>

    <!-- <div class="album py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
              </svg>
              <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                  content. This content is a little bit longer.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->

  </main>

  <footer class="text-muted">
    <div class="container">
      <p class="float-right">
        <a href="#login">Back to top</a>
      </p>
      <p>copyrights 2021 OSAKANA SHARE All Rights Reserved.</p>
      </p>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="bootstrap.bundle.js"></script>
</body>

</html>