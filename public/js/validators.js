
const lang = getCookie('lang') ? getCookie('lang') : 'En';






// Név input validálás

function checkValidators(options, inputValue, targetElement) {
  let errors = [];
  Object.keys(options).forEach(key => {
    let value = options[key];

    switch (key) {
      case "required":
        if (typeof value === "boolean" && value === true) {
          const requiredMessage = {
            En: "This field is required.",
            Hu: "A mező kitöltése kötelező."
          };


          if (inputValue.trim().length === 0) {
            errors.push(requiredMessage[lang]);
            targetElement.setCustomValidity(
              requiredMessage[lang]
            );
            // Itt megteheted az egyéb teendőket, például hibaüzenet megjelenítése
          }
        }
        break;
      case "minLength":
        if (typeof value === 'number' && inputValue.trim().length < value) {
          const minLengthMessage = {
            En: `The length of the field cannot be less than ${value}`,
            Hu: `A mező hossza nem lehet kevesebb mint ${value}.`
          };

          errors.push(minLengthMessage[lang]);
          targetElement.setCustomValidity(
            minLengthMessage[lang]
          );
        }
        break;

      case "maxLength":

        if (typeof value === 'number' && inputValue.trim().length > value) {
          const minLengthMessage = {
            En: `The length of the field cannot be more than ${value}`,
            Hu: `A mező hossza nem lehet több mint ${value}.`
          };

          errors.push(minLengthMessage[lang]);
          targetElement.setCustomValidity(
            minLengthMessage[lang]
          );
        }
        break;
      case "hasNum":
        if (typeof value === 'boolean' && value === true) {
          const hasNumber = /\d/.test(inputValue.trim());

          if (!hasNumber) {
            errors.push("A mezőnek tartalmaznia kell legalább egy számot!");
            targetElement.setCustomValidity("A mezőnek tartalmaznia kell legalább egy számot!");
          } else {
            targetElement.setCustomValidity("");
          }
        }
        break;

      case "hasUppercase":
        if (typeof value === 'boolean' && value === true) {
          const hasUpperCase = /[A-Z]/.test(inputValue.trim());

          if (!hasUpperCase) {
            errors.push("A mezőnek tartalmaznia kell legalább egy nagybetűt!");
            targetElement.setCustomValidity("A mezőnek tartalmaznia kell legalább egy nagybetűt!");
          } else {
            targetElement.setCustomValidity("");
          }
        }
        break;
      case "split":

        if (typeof value === "boolean" && value === true) {
          const nameParts = inputValue.split(" ");


          if (inputValue !== "" && nameParts.length < 2) {
            errors.push(`Az mező értékének minimum 2 szóból kell állnia`);
            targetElement.setCustomValidity(
              `Az mező értékének minimum 2 szóból kell állnia`
            );
            // Itt megteheted az egyéb teendőket, például hibaüzenet megjelenítése
          }
        }
        break;
      case "password":
        if (typeof value === "boolean" && value === true) {
          const passwordValue = inputValue.trim();
          const hasUpperCase = /[A-Z]/.test(passwordValue);
          const hasLowerCase = /[a-z]/.test(passwordValue);
          const hasNumber = /\d/.test(passwordValue);
          const isLengthValid = passwordValue.length >= 8;

          if (inputValue.trim() === "") {
            errors.push("Kérlek add meg a jelszavadat!");
            targetElement.setCustomValidity("Kérlek add meg a jelszavadat!");
          } else {
            targetElement.setCustomValidity("");
          }

          if (!hasUpperCase) {
            errors.push("A jelszónak tartalmaznia kell legalább egy nagybetűt!");
            targetElement.setCustomValidity("A jelszónak tartalmaznia kell legalább egy nagybetűt!");
          } else {
            targetElement.setCustomValidity("");
          }

          if (!hasLowerCase) {
            errors.push("A jelszónak tartalmaznia kell legalább egy kisbetűt!");
            targetElement.setCustomValidity("A jelszónak tartalmaznia kell legalább egy kisbetűt!");
          } else {
            targetElement.setCustomValidity("");
          }

          if (!hasNumber) {
            errors.push("A jelszónak tartalmaznia kell legalább egy számot!");
            targetElement.setCustomValidity("A jelszónak tartalmaznia kell legalább egy számot!");
          } else {
            targetElement.setCustomValidity("");
          }

          if (!isLengthValid) {
            errors.push("A jelszónak legalább 8 karakter hosszúnak kell lennie!");
            targetElement.setCustomValidity("A jelszónak legalább 8 karakter hosszúnak kell lennie!");
          } else {
            targetElement.setCustomValidity("");
          }
        }
        break;

      case "email":
        if (typeof value === "boolean" && value === true) {
          const emailMessage = {
            En: `Please enter a valid e-mail address.`,
            Hu: `Kérem adjon meg érvényes e-mail címet.`
          };
          const emailValue = inputValue.trim();
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

          if (!emailRegex.test(emailValue)) {
            errors.push(emailMessage[lang]);
            targetElement.setCustomValidity(emailMessage[lang]);
          } else {
            targetElement.setCustomValidity("");
          }
        }
        break;
      case "phone":
        if (typeof value === "boolean" && value === true) {

          const phoneValue = inputValue.trim();
          const isLengthValid = phoneValue.length >= 9;
          const isNumeric = /^\d+$/.test(phoneValue);

          if (!isLengthValid) {
            errors.push("A telefonszámnak legalább 9 karakter hosszúnak kell lennie!");
            targetElement.setCustomValidity(
              "A telefonszámnak legalább 9 karakter hosszúnak kell lennie!"
            );
          } else {
            targetElement.setCustomValidity("");
          }

          if (!isNumeric) {
            errors.push("A telefonszámnak csak számokat tartalmazhat!");
            targetElement.setCustomValidity("A telefonszámnak csak számokat tartalmazhat!");
          } else {
            targetElement.setCustomValidity("");
          }
        }
        break;

      default:
        break;
    }

  });

  // Border szín beállítása
  if (errors.length > 0) {
    targetElement.style.border = "2px solid red";
  } else {
    targetElement.style.border = "2px solid green";
  }

  return errors;
}

// A kód többi része változatlan marad
let inputElements = document.querySelectorAll("[data-validators]");

inputElements.forEach(inputElement => {
  let options = JSON.parse(inputElement.getAttribute("data-validators"));
  let name = options.name;
  let targetElement = document.querySelector(`[name="${name}"]`)

  let inputAlert = document.createElement("div");
  inputAlert.id = `${name}Alert`; // Egyedi azonosító generálása
  inputAlert.style.color = "red";
  inputAlert.style.marginTop = ".5rem";
  targetElement.parentNode.insertBefore(inputAlert, inputElement.nextSibling);

  inputElement.addEventListener("input", function (e) {
    let errors = checkValidators(options, e.target.value, targetElement);
    inputAlert.innerHTML = ""; // Töröljük az előző hibaüzeneteket

    errors.forEach(error => {
      let errorElement = document.createElement("div");
      errorElement.textContent = error;
      inputAlert.appendChild(errorElement);
    });
  });
});



function checkCurrentValidility(valid, element) {
  if (valid === false) {
    element.style.border = "2px solid #ec0677";
  } else {
    element.style.border = "2px solid #00a79c";
  }
}








/* 

// E-mail input validálás
let emailInput = document.querySelector("[data-validator='email']");

if (emailInput) {
  let emailInputAlert = document.createElement("div");
  emailInputAlert.id = "emailInputAlert";
  emailInputAlert.style.color = "red";
  emailInput.parentNode.insertBefore(emailInputAlert, emailInput.nextSibling);

  emailInput.addEventListener("input", function () {
    const emailValue = this.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailValue === "") {
      this.setCustomValidity("Kérlek add meg az email címedet!");
      emailInputAlert.innerHTML = "Kérlek add meg az email címedet!";
    } else if (!emailRegex.test(emailValue)) {
      this.setCustomValidity("Kérlek adj meg érvényes email címet!");
      emailInputAlert.innerHTML = "Kérlek adj meg érvényes email címet!";
    } else {
      this.setCustomValidity("");
      emailInputAlert.innerHTML = "";
    }

    checkCurrentValidility(this.checkValidity(), this);
  });
}

// Jelszó input validálás
let pwInput = document.querySelector("[data-validator='password']");

if (pwInput) {
  let pwInputAlert = document.createElement("div");
  pwInputAlert.id = "pwInputAlert";
  pwInputAlert.style.color = "red";
  pwInput.parentNode.insertBefore(pwInputAlert, pwInput.nextSibling);

  pwInput.addEventListener("input", function () {
    const passwordValue = this.value.trim();
    const hasUpperCase = /[A-Z]/.test(passwordValue);
    const hasLowerCase = /[a-z]/.test(passwordValue);
    const hasNumber = /\d/.test(passwordValue);
    const isLengthValid = passwordValue.length >= 8;

    if (
      passwordValue !== "" &&
      (!hasUpperCase || !hasLowerCase || !hasNumber || !isLengthValid)
    ) {
      this.setCustomValidity(
        "A jelszónak legalább 8 karakterből, kis- és nagybetűből, valamint számból kell állnia!"
      );
      pwInputAlert.innerHTML =
        "A jelszónak legalább 8 karakterből, kis- és nagybetűből, valamint számból kell állnia!";
    } else if (passwordValue === "") {
      this.setCustomValidity("Kérlek add meg a jelszavadat!");
      pwInputAlert.innerHTML = "Kérlek add meg a jelszavadat!";
    } else {
      this.setCustomValidity("");
      pwInputAlert.innerHTML = "";
    }

    checkCurrentValidility(this.checkValidity(), this);
  });
}

// Cím input validálás
let addressInput = document.querySelector("[data-validator='address']");

if (addressInput) {
  let addressInputAlert = document.createElement("div");
  addressInputAlert.id = "addressInputAlert";
  addressInputAlert.style.color = "red";
  addressInput.parentNode.insertBefore(addressInputAlert, addressInput.nextSibling);

  addressInput.addEventListener("input", function () {
    const addressValue = this.value.trim();
    const hasUpperCase = /[A-Z]/.test(addressValue);
    const hasNumber = /\d/.test(addressValue);
    const isLengthValid = addressValue.length >= 5;

    if (addressValue === "") {
      this.setCustomValidity("Kérlek add meg a címedet!");
      addressInputAlert.innerHTML = "Kérlek add meg a címedet!";
    } else if (!hasUpperCase || !hasNumber || !isLengthValid) {
      this.setCustomValidity(
        "A címnek legalább 5 karakterből, nagybetűből és számból kell állnia!"
      );
      addressInputAlert.innerHTML =
        "A címnek legalább 5 karakterből, nagybetűből és számból kell állnia!";
    } else {
      this.setCustomValidity("");
      addressInputAlert.innerHTML = "";
    }

    checkCurrentValidility(this.checkValidity(), this);
  });

}
// Telefonszám input validálás
let phoneInput = document.querySelector("[data-validator='phone']");

if (phoneInput) {
  let phoneInputAlert = document.createElement("div");
  phoneInputAlert.id = "phoneInputAlert";
  phoneInputAlert.style.color = "red";
  phoneInput.parentNode.insertBefore(phoneInputAlert, phoneInput.nextSibling);

  phoneInput.addEventListener("input", function () {
    const phoneValue = this.value.trim();
    const isLengthValid = phoneValue.length >= 9;

    if (phoneValue === "") {
      this.setCustomValidity("Kérlek add meg a telefonszámodat!");
      phoneInputAlert.innerHTML = "Kérlek add meg a telefonszámodat!";
    } else if (!isLengthValid) {
      this.setCustomValidity(
        "A telefonszámnak legalább 9 karakter hosszúnak kell lennie!"
      );
      phoneInputAlert.innerHTML =
        "A telefonszámnak legalább 9 karakter hosszúnak kell lennie!";
    } else {
      this.setCustomValidity("");
      phoneInputAlert.innerHTML = "";
    }

    checkCurrentValidility(this.checkValidity(), this);
  });
} */