<?php

namespace Bbs\Controller;

class UserEditDone extends \Bbs\Controller
{
  public function run()
  {
    //$this->showUser();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->updateUser();
    }
  }

  // protected function showUser() {
  //   $user = new \Bbs\Model\User();
  //   $userData = $user->find($_SESSION['me']->id);
  //   $this->setValues('username', $userData->username);
  //   $this->setValues('email', $userData->email);
  //   $this->setValues('image', $userData->image);
  // }

  protected function updateUser() {
    try {
      $this->validate();
    } catch (\Bbs\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch (\Bbs\Exception\InvalidName $e) {
      $this->setErrors('username', $e->getMessage());
    }
    $this->setValues('id', $_POST['id']);
    $this->setValues('username', $_POST['username' . $_POST['id']]);
    $this->setValues('email', $_POST['email' . $_POST['id']]);
    $this->setValues('image', $_POST['image' . $_POST['id']]);
    $this->setValues('authority', $_POST['authority' . $_POST['id']]);
    $this->setValues('delfalg', $_POST['delflag' . $_POST['id']]);

    if ($this->hasError()) {
      return;
    } else {
      // $user_img = $_FILES['image'];
      // $old_img = $_POST['old_image'];
      // $ext = substr($user_img['name'], strrpos($user_img['name'], '.') + 1);
      // $user_img['name'] = uniqid("img_") . '.' . $ext;
      try {
        $userModel = new \Bbs\Model\User();
        $userModel->userUpdate([
          'username' => $_POST['username' . $_POST['id']],
          'email' => $_POST['email' . $_POST['id']],
          'image' => $_POST['image' . $_POST['id']],
          'authority' => $_POST['authority' . $_POST['id']],
          'delflag' => $_POST['delflag' . $_POST['id']],
          'id' => $_POST['id'],
        ]);
      } catch (\Bbs\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }
    }
    
    //$_SESSION['me']->username = $_POST['username'];
    header('Location: ' . SITE_URL . '/users_list.php');
    exit();
  }

  private function validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "不正なトークンです!";
      exit();
    }
    if (!filter_var($_POST['email' . $_POST['id']], FILTER_VALIDATE_EMAIL)) {
      throw new \Bbs\Exception\InvalidEmail("メールアドレスが不正です!");
    }
    if ($_POST['username' . $_POST['id']] === '') {
      throw new \Bbs\Exception\InvalidName("ユーザー名が入力されていません!");
    }
  }
}
