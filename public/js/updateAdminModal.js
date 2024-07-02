document.getElementById('changePasswordCheckbox').addEventListener('change', function() {
  const passwordFields = ['prev_password', 'password', 'repeat'];
  passwordFields.forEach(id => {
      const field = document.getElementById(id);
      if (this.checked) {
          field.disabled = false;
          field.setAttribute('required', 'required');
      } else {
          field.disabled = true;
          field.removeAttribute('required');
      }
  });
});