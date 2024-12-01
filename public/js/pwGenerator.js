(() => {


    const pwGenerators = document.querySelectorAll('.pw-generator');

    pwGenerators.forEach(generator => {
        if (generator) {
            generator.addEventListener('click', (e) => {
                e.preventDefault();
                const newPw = generatePassword();
                const password = e.target.parentElement.querySelector('.password');

                if (newPw && newPw !== '') {
                    password.value = newPw;
                    const event = new Event('input', { bubbles: true });
                    password.dispatchEvent(event);
                }

            })
        }
    })

    function generatePassword(length = 12) {
        if (length < 8) {
            throw new Error("A jelszó hossza nem lehet kevesebb mint 8 karakter!");
        }

        const lowerCase = "abcdefghijklmnopqrstuvwxyz";
        const upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const numbers = "0123456789";
        const specialChars = "!@#$%^&*(),.?\":{}|<>";
        const allChars = lowerCase + upperCase + numbers + specialChars;

        let password = "";

        // Garantáljuk, hogy minden kategóriából legyen legalább egy karakter
        password += lowerCase[Math.floor(Math.random() * lowerCase.length)];
        password += upperCase[Math.floor(Math.random() * upperCase.length)];
        password += numbers[Math.floor(Math.random() * numbers.length)];
        password += specialChars[Math.floor(Math.random() * specialChars.length)];

        // A maradék karakterek véletlenszerűen kerülnek be
        for (let i = password.length; i < length; i++) {
            password += allChars[Math.floor(Math.random() * allChars.length)];
        }

        // Véletlenszerű sorrendbe keverjük a karaktereket
        password = password.split('').sort(() => 0.5 - Math.random()).join('');

        return password;
    }

})();