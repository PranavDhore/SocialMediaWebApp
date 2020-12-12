
var fileInput = document.getElementById('inputFile');
var form = document.getElementById('form')
var description = document.getElementById('inputDescription');
var title = document.getElementById('inputTitle'); 

// if(form){
//     form.addEventListener('submit', e => {
//         e.preventDefault();

//         checkInputs();
//     })
// }

function checkInputs() {
    var filePath1 = fileInput.value;
    if (filePath1 == ''){
        // alert('Please Select a File To Upload');
        setErrorFor(fileInput, 'Please select A file!!!')
        return false;
    }

    if(title.value === '') {
        setErrorFor(title, 'Please Add Title To Your The Post!!!')
        return false;
    } else {
        setSuccessFor(title)
    }

    if(description.value == ''){
        setErrorFor(description, 'Please Enter The Description Ablout The Post!!!')
        return false;
    } else {
        setSuccessFor(description)
        // setInterval(() => {
        //     document.getElementsByClassName("popup")[0].classList.add("active");
        // },2000)
        return true;
    }
}

function fileValidation() {
    var filePath = fileInput.value;
        // console.log(fileInput);
        //Allowing file type
        // console.log(filePath);

    var allowedFileExtensions =  /(\.jpg|\.jpeg|\.png|\.gif|\.mp4)$/i;
    var videoExtension = /(\.mp4)$/i;

    // console.log(filePath.value);
    if(filePath.value == ''){
        setErrorFor(fileInput, 'Please select A file!!!')
        return false;
    }
    if(!allowedFileExtensions.exec(filePath)) {
        // alert('Invalid File Type!!');
        setErrorFor(fileInput, 'Please Select A Photo or Video Only!!!')
        fileInput.value = '';
        document.getElementById('imagePreview').innerHTML = ''
        return false;
    } else {
        //Image Preview
        setSuccessFor(fileInput)
        if(fileInput.files && fileInput.files[0]) {
            // alert(fileInput.files[0]);
            var reader = new FileReader(); 
            reader.onload = function(e) { 
                if(videoExtension.exec(filePath)){
                    document.getElementById('imagePreview').innerHTML = '<video controls class="video-player post_video"  width="80%" height="80%"><source src="'+ e.target.result +'" type="video/mp4"> </video>';
                    document.getElementById('inputCategory').innerHTML = '<option selected>Video</option>'
                } else {
                    document.getElementById('imagePreview').innerHTML = '<img src="'+ e.target.result + '" height="50%" width="60%"/>';
                    document.getElementById('inputCategory').innerHTML = '<option selected>Photo</option>'
                }
            };
            reader.readAsDataURL(fileInput.files[0]); 
        }
    }
}


function setErrorFor(input, message) {
    const formControl = input.parentElement;
    // console.log(formControl);
    const small = formControl.querySelector('small');
    formControl.className = 'form-group error';
    small.innerText = message;
  }
  
  function setSuccessFor(input) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'form-group success';
    small.innerText = '';
  }