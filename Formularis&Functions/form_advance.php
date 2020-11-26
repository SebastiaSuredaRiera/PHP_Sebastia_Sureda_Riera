<?php
//Variables definition
$fullName=$fullNameSplit=$email=$emailValidationMessage=$pwd=$pwdConfirm=$pwdValidationMessage=$encryptedPass=null;

//Include statement
//type below the php file name where your validation functions are
include 'form_advance_validation.php';

//add the global variable to retrieve values from the form according to the method
if ($_GET){
  //fullName format
  $fullName=$_GET['fullName'];
  if(isset($fullName))
     $fullNameSplit = fullNameSplit($fullName);
     //call your function to split the fullName in parts
       //email validation
  $email=$_GET['email'];
  if(isset($email)){
    if(!emailvalidation($email))
    //call your function to validate the email format)
      $emailValidationMessage = "El correu $email no es valid ";
      //type the message will be shown to the user
  }
  //password validation
  $pwd=$_GET['pwd'];
  $pwdConfirm=$_GET['pwdConfirm'];

  if((isset($pwd))&&(isset($pwdConfirm))){
    if(!pwdValidation($pwd,$pwdConfirm)){
    //call your function to validate both passwords are equal){
      $pwdValidationMessage="<b>Les contrasenyes no coincideixen </ b> Torneu-les a escriure, si us plau.<br>";
    }else{
      $pwdValidationMessage="<b>Les contrasenyes coincideixen,tot es correcte<br>";
      //type the message will be shown to the user
}
}

  //password hash encryption
  if(isset($pwd))
     $encryptedPass = encryptPass($pwd);
      //call your validation function to encrypt the password

}//end GET
?>
<HTML>
<head>
    <title>Advance Form</title>
</head>
<body>
    <H2>Advance Form</H2>
    <h3>Fill the form with the required information, please.</h3>
  <FORM ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD="GET">
        <!--nom-->
        <b>Type your full name:</b> name, middle name, first surname nad second surname.
        <br>* Use the space character to separate them:<br><br>
        <INPUT TYPE="text" NAME="fullName" value="<?php echo $fullName;?>" Required>
        <!--email-->
        <br><br><b> Email account:</b><br><br>
       <input type="text" name="email" value="<?php echo $email;//show the variable value?>" Required>
       <!--password-->
          <br><br><b> Password:</b><br><br>
       <input type="password" name="pwd" value="<?php echo $pwd;//show the variable value?>" Required>
       <!--password confirmation-->
          <br><br> <b>Password confirmation:</b><br><br>
       <input type="password" name="pwdConfirm" value="<?php echo $pwdConfirm;//show the variable value?>" Required>
      <br><br>
      <INPUT TYPE="submit" VALUE="Enviar">
    </FORM>

    <?php
    if ((isset($fullName))||(isset($pwdValidationMessage)))
        echo "<p><b>Validation Form output</b></p>";
    //isset function check if a variable is has been defined and is not null
    if (isset($fullName)){
        echo "<b>The full name</b> is made of the sections below:<br>";
      foreach($fullNameSplit as $Val_10){//complete the foreach loop to show the split fullName in parts
        echo "$Val_10<br>";
      }
    }

    if (isset($emailValidationMessage))
      echo "$emailValidationMessage</br>";

    //show the encrypted password
    if (isset($encryptedPass))
      echo "$encryptedPass<br>";
      //show the encypted password value

    //show the pwdValidation message. If pass are equal
    if (isset($pwdValidationMessage))
      echo "$pwdValidationMessage<br>";
      //show the message about whether the passwords are equal or not


  ?>
</body>
</HTML>
