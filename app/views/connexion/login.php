<?php
   session_start();
   // On a notre nouvelle contrainte sur la valeur du champ "csrf"
   if(
      isset($_POST['login'], $_POST['password'], $_POST['csrf'])
      && $_POST['login'] == 'toto'
      && $_POST['password'] == 'toto123'
      && $_POST['csrf'] == $_SESSION['csrf']
   )
   {
      $_SESSION['connecte'] = 1;
   }
   // On génère une nouvelle valeur pour $csrf que l'on stocke en $_SESSION
   $csrf = base64_encode(uniqid(rand(), true));
   $_SESSION['csrf'] = $csrf;
?>
<form action="#" method="POST">
   <input type="text" name="login" />
   <input type="password" name="password" />
   <input type="hidden" name="csrf" value="<?php echo $csrf; ?>" />
   <input type="submit" value="Connexion" />
</form>