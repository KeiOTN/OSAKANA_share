<?php
include('functions.php');
include("header.php");
include("footer.php");
?>

<?= $header ?>
<main role="main">

    <section class="jumbotron text-center top-img" id="top-img">
        <div class="container">
            <h1>おさかなシェア</h1>
            <p class="lead text-muted"><br>たくさん釣れた魚、シェアしたい。<br><br>持ち帰るのも困るほど大漁だった日は、<br>おさかなシェアで魚を貰ってくれる人を見つけましょう。</p>
            <p>
                <a href="give/give_input.php" class="btn btn-primary my-2">魚の貰い手を募集する</a><br>
                <a href="give/give_read.php" class="btn btn-secondary my-2">魚一覧を見る</a>
            </p>
        </div>
    </section>

    <div class="card-columns">
        <div class="card shadow-sm">
            <img class="card-img-top" src="img/ship.png" alt="">
            <div class="card-body">文章を入力</div>
            <div class="card-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
            </div>
        </div>

        <div class="card shadow-sm">
            <img class="card-img-top" src="img/ship.png" alt="">
            <div class="card-body">文章を入力</div>
            <div class="card-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
            </div>
        </div>

        <div class="card shadow-sm">
            <img class="card-img-top" src="img/ship.png" alt="">
            <div class="card-body">文章を入力</div>
            <div class="card-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
            </div>
        </div>

        <div class="card shadow-sm">
            <img class="card-img-top" src="img/ship.png" alt="">
            <div class="card-body">文章を入力</div>
            <div class="card-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
            </div>
        </div>

        <div class="card shadow-sm">
            <img class="card-img-top" src="img/ship.png" alt="">
            <div class="card-body">文章を入力</div>
            <div class="card-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
            </div>
        </div>
    </div>




</main>
<?= $footer ?>