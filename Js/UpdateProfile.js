

var form = document.getElementById('form');
var firstName = document.getElementById('inputFirstname');
var lastName = document.getElementById('inputLastname');
var userName = document.getElementById('inputUsername');
var email = document.getElementById('inputEmail');
var collegeName = document.getElementById('inputCollegeName');
var collegeYear = document.getElementById('inputCollegeYear');
var password = document.getElementById('inputSignupPassword');
var confirmPassword = document.getElementById('inputSignupConfirmPassword');
var isTrue = [];


function validate() {
  checkInputs();

  var flag = true;
  // console.log(isTrue);

  isTrue.forEach((value) => {
    if (value === false) {
      flag = false;
      // console.log(value);
    }
  })  

  if(flag === true) {
    // console.log('inside if');
    return true;
  } else {
    return false;
  }
}
// if(form){
//   form.addEventListener('submit', (e) => {
//     e.preventDefault();
//     checkInputs();
//   });
// }

function checkInputs() {
  const firstNameValue= firstName.value.trim();
  const lastNameValue = lastName.value.trim();
  const userNameValue = userName.value.trim();
  const emailValue = email.value.trim();
  const collegeNameValue = collegeName.value.trim();
  const collegeYearValue = collegeYear.value.trim();
  const passwordValue = password.value.trim();
  const confirmPasswordValue = confirmPassword.value.trim();

  var letters = /^[A-Za-z]+$/;
  var passwordLetters = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s)$/;



  if( (firstNameValue.length < 3) || (firstNameValue.length > 15) ) {
      isTrue[0] = false;
    setErrorFor(inputFirstname, 'First Name cannot be small than 3 and greater than 15');
  } else if(!firstNameValue.match(letters)) {
      isTrue[0] = false;
    setErrorFor(inputFirstname, 'First Name Must Be Characters');
  } else {
      isTrue[0] = true;
    setSuccessFor(inputFirstname);
  }

  if((lastNameValue.length < 3) || (lastNameValue.length > 15)) {
      isTrue[0] = false;
    setErrorFor(inputLastname, 'Last Name cannot be blank');
  } else if(!lastNameValue.match(letters)) {
      isTrue[0] = false;
    setErrorFor(inputLastname, 'Last Name Must Be Characters');
  } else {
      isTrue[0] = true;
    setSuccessFor(inputLastname);
  }


  if(userNameValue === '') {
      isTrue[0] = false;
    setErrorFor(inputUsername, 'Username cannot be blank');
  } else {
      isTrue[0] = true;
    setSuccessFor(inputUsername);
  }
  

  if(emailValue === '') {
      isTrue[0] = false;
    setErrorFor(inputEmail, 'Email cannot be blank');
  } else if (!isEmail(emailValue)) {
      isTrue[0] = false;
    setErrorFor(inputEmail, 'Not a valid email');
  } else {
      isTrue[0] = true;
    setSuccessFor(inputEmail);
  }
  

  if(collegeNameValue === 'Choose...') {
      isTrue[0] = false;
    setErrorFor(inputCollegeName, 'Please Select Your College');
  } else {
      isTrue[0] = true;
    setSuccessFor(inputCollegeName);
  }
  
  if(collegeYearValue === 'Choose...') {
     isTrue[0] = false;
    setErrorFor(inputCollegeYear, 'Please Select Your Year');
  } else {
     isTrue[0] = true;
    setSuccessFor(inputCollegeYear);
  }
  

  if(passwordValue === '' ) {
     isTrue[0] = false;
    setErrorFor(inputSignupPassword, 'Password cannot be blank');
  }  else if (passwordValue.length < 6 || passwordValue.length >18 ){
     isTrue[0] = false;
    setErrorFor(inputSignupPassword, 'Password cannot be Less Than 6 character And Greater than 18 ');
  } else if( passwordValue === '123456' || passwordValue === 'qwerty' || passwordValue === 'abcdef'){
     isTrue[0] = false;
    setErrorFor(inputSignupPassword, 'Password cannot be '+passwordValue);
  } else if(!isPasswordCorrect(passwordValue)){
     isTrue[0] = false;
    setErrorFor(inputSignupPassword, 'Password Must Contain a Lower case and Upper case, an Aplhabet, and a Special Symbol');
  } else {
     isTrue[0] = true;
    setSuccessFor(inputSignupPassword);
  }
  
  if(confirmPasswordValue === '') {
     isTrue[0] = false;
    setErrorFor(inputSignupConfirmPassword, 'Confirm Password cannot be blank');
  } else if(passwordValue !== confirmPasswordValue) {
     isTrue[0] = false;
    setErrorFor(inputSignupConfirmPassword, 'Passwords does not match');
  } else{
     isTrue[0] = true;
    setSuccessFor(inputSignupConfirmPassword);
  }

}

function setErrorFor(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector('small');
  formControl.className = 'form-group col-md-12 error';
  small.innerText = message;
}

function setSuccessFor(input) {
  const formControl = input.parentElement;
  const small = formControl.querySelector('small');
  formControl.className = 'form-group col-md-12 success';
  small.innerText = '';
}

  
function isEmail(email) {
  return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function isPasswordCorrect(pass){
  re = /[0-9]/;
  if(!re.test(pass)) {
    return false;
  }
  re = /[a-z]/;
  if(!re.test(pass)) {
    return false;
  }
  re = /[A-Z]/;
  if(!re.test(pass)) {
    return false;
  }

  re = /[!@#\$%\^&\*]/;
  if(!re.test(pass)) {
    return false;
  }
  return true;
}