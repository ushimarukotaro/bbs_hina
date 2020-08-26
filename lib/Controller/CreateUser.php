<?php
namespace Bbs\Controller;
// Controllerクラスの継承
class CreateUser extends \Bbs\Controller {
  public function run() {
    // POSTメソッドがリクエストされていればpostProcessメソッド実行
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }
  protected function postProcess() {
    try {
      $this->validate();
    } catch (\Bbs\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch (\Bbs\Exception\InvalidName $e) {
      $this->setErrors('username', $e->getMessage());
    } catch (\Bbs\Exception\InvalidPassword $e) {
      $this->setErrors('password', $e->getMessage());
    }
    $this->setValues('username', $_POST['username']);
    $this->setValues('email', $_POST['email']);
    $this->setValues('password', $_POST['password']);
    $this->setValues('image', $_POST['image']);
    $this->setValues('authority', $_POST['authority']);
    $this->setValues('delflag', $_POST['delflag']);
    if ($this->hasError()) {
      return;
    } else {
      try {
        $userModel = new \Bbs\Model\User();
        $user = $userModel->adminCreate([
          'username' => $_POST['username'],
          'email' => $_POST['email'],
          'password' => $_POST['password'],
          'image' => $_POST['image'],
          'authority' => $_POST['authority'],
          'delflag' => $_POST['delflag'],
        ]);
      }
      catch (\Bbs\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }

      header('Location: '. SITE_URL . '/users_list.php');
      exit();
    }
    // ToDo:ユーザー登録後、ログイン処理を行う
  }
  // バリデーションメソッド
  private function validate() {
    // トークンが空またはPOST送信とセッションに格納された値が異なるとエラー
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "不正なトークンです!";
      exit();
    }
    if (!isset($_POST['email']) || !isset($_POST['username']) || !isset($_POST['password'])) {
      echo "不正なフォームから登録されています!";
      exit();
    }
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
      throw new \Bbs\Exception\InvalidEmail("メールアドレスが不正です!");
    }
    if ($_POST['username'] === '') {
      throw new \Bbs\Exception\InvalidName("ユーザー名が入力されていません!");
    }
    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password']) || $_POST['password'] === '') {
      throw new \Bbs\Exception\InvalidPassword("パスワードが不正です!");
    }
  }
}