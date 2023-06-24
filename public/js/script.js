/**
 * Function make button active.
 * It will change text color and button background color.
 * 
 *  @param string nameId
 *    Holds element id of the field need to be validate.
 * 
 *  @param string msgId
 *    Holds element id of the field in which error message will be shown.
 * 
 *  @param string btnId
 *    Holds element id of the submit button.
 */
function validInput(nameId, msgId, btnId) {
  document.getElementById(nameId).style.color = 'green';
  document.getElementById(msgId).innerHTML = "";
  document.getElementById(btnId).disabled = false;
  document.getElementById(btnId).style.backgroundColor = '';
}

/**
 * Function make button inactive.
 * It will change text color and button background color.
 * 
 *  @param string nameId
 *    Holds element id of the field need to be validate.
 * 
 *  @param string btnId
 *    Holds element id of the submit button.
 */
function invalidInput(nameId, btnId) {
  document.getElementById(nameId).style.color = 'red';
  document.getElementById(btnId).disabled = true;
  document.getElementById(btnId).style.backgroundColor = 'lightgrey';
}

/**
 * Function to check store message for empty field
 * and make button disable.
 * 
 *  @param string msgId
 *    Holds element id of the field in which error message will be shown.
 * 
 *  @param string btnId
 *    Holds element id of the submit button.
 */
function emptyField(msgId, btnId) {
  document.getElementById(msgId).innerHTML = "Field cannot be empty";
  document.getElementById(btnId).disabled = true;
  document.getElementById(btnId).style.backgroundColor = 'lightgrey';
}

/**
 * Function to validate name.
 */
function validateName() {
  var pattern = /^[A-Za-z\s]+$/;

  if(!document.getElementById("name").value == "") {
    if(document.getElementById("name").value.match(pattern)) {
      validInput("name", "checkName", "submit-btn");
    }
    else {
      document.getElementById("checkName").innerHTML = "Only characters are allowed!";
      invalidInput("name", "submit-btn");
    }
  }
  else {
    emptyField("checkName", "submit-btn");
  }
}

/**
 * Function to validate phone number.
 */
function validatePhone() {
  var pattern = /^(\+91)[0-9]{10}$/;

  if(!document.getElementById("phone").value == "") {
    if(document.getElementById("phone").value.match(pattern)) {
      validInput("phone", "checkPhone", "submit-btn");
    }
    else {
      document.getElementById("checkPhone").innerHTML = "Invalid contact number!";
      invalidInput("phone", "submit-btn");
    }
  }
  else {
    emptyField("checkPhone", "submit-btn");
  }
}

/**
 * Function to validate email format.
 */
function validateEmail() {
  var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/;

  if(!document.getElementById("email").value == "") {
    if(document.getElementById("email").value.match(pattern)) {
      validInput("email", "checkEmail", "submit-btn");
    }
    else {
      document.getElementById("checkEmail").innerHTML = "Invalid email format!";
      invalidInput("email", "submit-btn");
    }
  }
  else {
    emptyField("checkEmail", "submit-btn");
  }
}

/**
 * Function to check password pattern.
 */
function validatePassword() {
  var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
  
  if(!document.getElementById("password").value == "") {
    if(document.getElementById("password").value.length < 8) {
      document.getElementById("checkPass").innerHTML = "Password length must be greater than 8 characters.";
      invalidInput("password", "submit-btn");
    }
    else {
      if(document.getElementById("password").value.match(pattern)) {
        validInput("password", "checkPass", "submit-btn");
      }
      else {
        document.getElementById("checkPass").innerHTML = "Password must contain at least one lower, one upper, one numeric and one special character";
        invalidInput("password", "submit-btn");
      }
    }
  }
  else {
    emptyField("checkPass", "submit-btn");
  }
}

/**
 * Function to match password and confirm password.
 */
function matchPassword() {
  var password = document.getElementById("password").value;
  var cnfpassword = document.getElementById("cnfpassword").value;

  if(!document.getElementById("cnfpassword").value == "") {
    if(password != cnfpassword) {
      document.getElementById("checkCnfPass").innerHTML = "Password do not match.";
      invalidInput("cnfpassword", "submit-btn");
    }
    else {
      validInput("cnfpassword", "checkCnfPass", "submit-btn");
    }
  }
  else {
    emptyField("checkCnfPass", "submit-btn");
  }
}
