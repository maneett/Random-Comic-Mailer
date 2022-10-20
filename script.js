// Below Function Executes On Form Submit

const emailContainer = document.getElementById("email_container");
const otpContainer = document.getElementById("otp_container");
const msgContainer = document.getElementById("msg_container");
const submitEmail = document.getElementById("submit-email");
const submitOtp = document.getElementById("submit-otp");
const email = document.getElementById("email_tf");
const otp = document.getElementById("otp_tf");
const title = document.querySelector(".title");

// sending post request on button click.
submitEmail.addEventListener("click", (e) => {
  e.preventDefault();
  if (!validateEmail(email.value)) {
    console.log("invadil email");
  } else {
    const formData = saveData();
    fetch("registerEmail.php", {
      method: "POST",
      body: formData,
    }).then((res) => {
      console.log(res);
      switch (res.status) {
        case 200:
          // code block
          emailContainer.style.display = "none";
          otpContainer.style.display = "block";
          title.textContent = "Please Check Your Email";
          break;
        case 409:
          // code block
          alert(res.statusText);
          break;
        default:
        // code block
      }
      // if ((res.status = 49)) {
      //   console.log(res.status);
      //   emailContainer.style.display = "none";
      //   otpContainer.style.display = "block";
      //   title.textContent = "Please Check Your Email";
      // }
    });
  }
});

submitOtp.addEventListener("click", (e) => {
  e.preventDefault();
  if (otp.value.length == 0 || otp.value.length < 6 || otp.value.length > 6) {
    alert("Enter valid Otp");
    return;
  } else {
    const formData = saveData();
    fetch("verifyOtp.php", {
      method: "POST",
      body: formData,
    }).then((res) => {
      console.log(res);
      switch (res.status) {
        case 200:
          // code block
          msgContainer.style.display = "block";
          otpContainer.style.display = "none";
          break;
        case 401:
          // code block
          alert(res.statusText);
          break;
        default:
        // code block
      }
    });
  }
});

// validating email
const validateEmail = (email) => {
  return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};
// preparing form data for post request
function saveData() {
  const formElement = document.getElementsByClassName("form_data");
  console.log(formElement);
  const formData = new FormData();
  for (let count = 0; count < formElement.length; count++) {
    formData.append(formElement[count].name, formElement[count].value);
  }
  return formData;
}
