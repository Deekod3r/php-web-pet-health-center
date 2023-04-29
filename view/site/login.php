<?php 
  if (isset($_SESSION['login']) && $_SESSION['login']) {
    header('Location: ?controler=home&action=homepage');
  }
?>
<form action="?controller=home&action=login_action" method=post>
  <input type="text" name=phone>
  <input type="text" name=password>
  <button>Login</button>
</form>