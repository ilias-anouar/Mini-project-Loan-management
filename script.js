let signup_form = document.getElementById("signup_form");
signup_form.addEventListener("submit", (ev) => {
  let Term_conditions = document.getElementsByName("agree");
  let confirmation_pass = document.getElementById("cpassword");
  let password = document.getElementById("password");
  let check = true;
  while (check) {
    if (password.value != confirmation_pass.value) {
      ev.preventDefault();
      console.log(password.value);
      console.log(confirmation_pass.value);
      let pass_error = "Password confirmation in incorrect";
      let pass_error_holder = document.getElementById("pass_error");
      pass_error_holder.innerHTML = pass_error;
    }
    if (Term_conditions.checked == false) {
      ev.preventDefault();
      let error = "Please can you check the terms and conditions of user";
      let check_error = document.getElementById("check_error");
      check_error.innerHTML = error;
    } else {
      check_error.innerHTML = "";
    }
    check = false;
  }
  let box = document.getElementsByName("reg-log");
  box.checked=true

});

const togglePassword = document.querySelectorAll(".togglePassword");
// const password = document.querySelectorAll(".pass");
for (let i = 0; i < togglePassword.length; i++) {
  togglePassword[i].addEventListener("click", function (e) {
    // toggle the type attribute
    let input = togglePassword[i].closest("div").firstElementChild;
    const type =
      input.getAttribute("type") === "password" ? "text" : "password";
    input.setAttribute("type", type);
    // toggle the eye slash icon
    this.classList.toggle("fa-eye-slash");
  });
}
