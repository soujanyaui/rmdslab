<?php
// displaying errors
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once('connection.php'); //requiring the database connection

$errors = array('name' => '', 'password' => ''); // declaring errors array

if(isset($_POST['submit'])){ // making sure on submit variables are set?
      if(empty($_POST['name']) ){ // checking for if name is empty
        $errors['name'] = 'username cannot be empty <br />'; // error message for name
      }
      if(empty($_POST['password'])){ // checking for if password is empty
        $errors['password'] = 'password cannot be empty <br />'; // error message for password
      }
      // declaring variables
      $name = $_POST['name'];
      $password = $_POST['password'];
      $password_enc = md5($password);// encrypting to md5 hash for security purpose.
      if($name != '' && $password_enc !=''){
        // database query for slecting the username and password
        $query = "select * from user where username = '".$name."' and password =  '".$password_enc."'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_num_rows($result);// checking for how many rows we got
        //print($row);
        if($row > 0){ //  checking for match in our database with fetch assoc
          header('Location: home.php');  // after successful record found redirecting to home page
        }else{
          header('Location: login.php');// other wise login page
        }
    }

}
 ?>

<?php include('templates/header.php');?>
<div class="login-page">
  <div class="form">
    <form class="login-form" name="myForm" action="login.php"  method="POST">
      <!-- if we wnat to use javascript validation we should use this line, since i did validation through php this is not required-->
      <!-- <form class="login-form" name="myForm" action="login.php" onsubmit="return validateForm()" method="POST">-->
      <input type="text" name='name' placeholder="username"/>
      <p class="red"><?php echo $errors['name']?></p>
      <input type="password"  name='password' id='myInput' placeholder="password"/>
      <p class="red"><?php echo $errors['password']?></p>
      <label for="a"><input type="checkbox" onclick="myFunction()" style="width:14%">Show Password</label>
      <button type="submit" name='submit'>login</button>
    </form>
  </div>
</div>
<?php include('templates/footer.php');  ?>
