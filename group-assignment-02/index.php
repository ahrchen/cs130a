<!--
Summary:
The follow assignment will have three functions. 

The first function will collect the requisite data from the user.
The second function will validate the requisite date from the user.
The third function will return the data to a new page and confirm the user's information.
-->
<?php
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }
?>

<!--
  Contributors: Ted Herr, Greg Gorlen, Raymond Chen
-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Group assignment 02: functions and forms</title>
    <style>
      body {
        font-family: "helvetica";
        font-size: 15px;
      }
      form input {
        text-align: right;
      }
    </style>
  </head>
  <body>
    <h1>Sign-up for our thing!</h1>

    <?php

      //First Function, Prints a pre-set user registration form to collect requisite data from user
      function displayRegistrationForm() {
        print<<<FORM
        <form method="POST" action="group_assignment02.php">
                <table>
                  <tr>
                    <td>First name:</td>
                    <td>
                      <input name="firstname" type="text"
                        size=15 required autofocus>&nbsp;
                    </td>
                  </tr>
                  <tr>
                    <td>Last name:</td>
                    <td>
                      <input name="lastname" type="text"
                        size=15 required>
                    </td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td>
                      <input name="email" type="text"
                        size=15 required>
                    </td>
                  </tr>
                  <tr>
                    <td>Favorite color:</td>
                    <td>
                      <input name="color" type="text"
                        size=15 required>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="submit">
                      <input type="reset">
                    </td>
                    <td></td>
                  </tr>
                </table>
              </form>
FORM;
      } // end displayRegistration

      // Second Function, Validates a user's form input: All fields must be present with a valid email address
      function validateRegistration($data)  {
        return $data['first'] && $data['last'] &&
               $data['email'] && $data['color'] &&
               filter_var($data['email'], FILTER_VALIDATE_EMAIL);
      } // end validateRegistration

      // Third Function, Prints a user's registration information
      function outputRegistration($data) {
        //cleans the page before output
        ob_end_clean();
        print<<<OUTPUT
        <table>
                <tr>
                  <td>Welcome, $data[first] !</td>
                </tr>
                <tr>
                  <td>
                    Your registration information has been recorded as follows..
                  </td>
                </tr>
              </table>
              <table>
                <tr>
                  <td>First name:</td>
                  <td>$data[first]</td>
                </tr>
                <tr>
                  <td>Last name:</td>
                  <td>$data[last]</td>
                </tr>
                <tr>
                  <td>Email:</td>
                  <td>$data[email]</td>
                </tr>
                <tr>
                  <td>Favorite color:</td>
                  <td>$data[color]</td>
                </tr>
              </table>
OUTPUT;
      } // end outputRegistration

      // Run the first function and Show the user the registration form
      displayRegistrationForm();
      // If a form has been submitted, process it
      if (count($_POST)) {
        // Retrieve data from form
        $data = [];
        $data['first'] = $_POST['firstname'];
        $data['last'] = $_POST['lastname'];
        $data['email'] = $_POST['email'];
        $data['color'] = $_POST['color'];
        // Run the second and third function to display failure page or confirmation page.
        if (validateRegistration($data)) {
          outputRegistration($data);
        }
        else {
          echo '<div><strong>Invalid registration information</strong></div>';
        }
      }
    ?>

  </body>
</html>
