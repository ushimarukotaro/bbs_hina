<?php
require_once(__DIR__ . '/header.php');

?>
<h1 class="page__ttl">ユーザー新規登録画面</h1>
<?php if ($_SESSION['me']->authority != 99) { ?>
  <p class="err">このページを表示する権限がありません</p>
<?php  } else { ?>
  <form method="post" action="" class="">
    <table class="admin_table">
      <tr class="create_users_tr">
        <th>ユーザー名</th>
        <th>パスワード</th>
        <th>メールアドレス</th>
        <th>ユーザー画像</th>
        <th>権限</th>
        <th>削除フラグ</th>
      </tr>
      <tr class="create_users_row">
        <td><input type="text" name="username" value=""></td>
        <td><input type="password" name="password" value=""></td>
        <td><input type="text" name="email" value=""></td>
        <td><input type="text" name="image" value=""></td>
        <td><input type="text" name="authority" value="0"></td>
        <td><input type="text" name="delflag" value="1"></td>
      </tr>
    </table>
    <button class="btn btn-primary new-btn">登録</button>
    <input type="hidden" name="token" value="<?= h($_SESSION["token"]); ?>">
  </form>
<?php } ?>

<?php
require_once(__DIR__ . '/footer.php');
