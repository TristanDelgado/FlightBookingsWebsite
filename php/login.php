<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JetSetGo!</title>
    <link rel="icon" type="image/x-icon" href="../images/faviconPlane.svg">
    <link rel="stylesheet" href="../css/forms.css">
    <script type="text/javascript" src="../javascript/forms.js"></script>
  </head>
  <body>
    <form id="loginform" class="loginsignupforms" method="post" action="loginUser.php">
        <div>
            <h2>Sign in</h2>
            <h4>and save flights for later retrieval</h4>
            <img class="formExitButton" src="../images/xicon.png" onclick="document.location.href='../index.php'">
            <input type="username" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <button>Sign in</button>
            <h4 id="noaccountdiv">&nbspor&nbsp</h4>
            <button type="button" onclick="signup()">Sign up</button>
        </div>
        </form>
        <form id="signupform" class="loginsignupforms" method="post" action="addUser.php">
          <div>
              <img class="formExitButton" src="../images/xicon.png" onclick="document.location.href='../index.php'">
              <h2>Sign up</h2>
              <h4>and save your flights</h4>
              <input type="text" name="firstname" placeholder="Firstname">
              <input type="text" name="lastname" placeholder="Lastname">
              <input type="text" name="username" placeholder="Username">
              <input type="email" name="signupemail" placeholder="email">
              <input type="pass" name="signuppass" placeholder="password">
              <input type="text" name="address" placeholder="address">
              <input id="signupSubmit" type="submit" name="submit">
          </div>
        </form>
    <body>
<html>
