var form = document.getElementById('form');
var email = document.getElementById('inputEmail');
var password = document.getElementById('signinPassword');
var isTrue = [];

function validate() {
  checkInputs();

  var flag = true;
  console.log(isTrue);

  isTrue.forEach((value) => {
    if (value === false) {
      flag = false;
      console.log(value);
    }
  })  

  if(flag === true) {
    console.log('inside if');
    return true;
  } else {
    return false;
  }
}

// if(form){
//   form.addEventListener('submit', (e) => {
//     e.preventDefault();
//     checkInputs();

//     var flag = true;
//     console.log(isTrue);

//     isTrue.forEach((value) => {
//       if (value === false) {
//         flag = false;
//         console.log(value);
//       }
//     })  

//     if(flag === true) {
//       console.log('inside if');
//       return true;
//     } else {
//       return false;
//     }
//   });
// }

function checkInputs(){
  const emailValue = email.value.trim();
  const passwordValue = password.value.trim();

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

  if(passwordValue === '' ) {
    isTrue[1] = false;
    setErrorFor(signinPassword, 'Password cannot be blank');
  } else if (passwordValue.length < 6){
    isTrue[1] = false;
    setErrorFor(signinPassword, 'Password cannot be Small Than 6 character ');
  } else {
    isTrue[1] = true;
    setSuccessFor(signinPassword);
  }
}

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function setErrorFor(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector('small');
  formControl.className = 'form-group col-md-12 error';
  small.innerText = message;
}

function setSuccessFor(input) {
  const formControl = input.parentElement;
  formControl.className = 'form-group col-md-12 success';
}
