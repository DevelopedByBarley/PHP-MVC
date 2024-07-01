axios.get('/feedback').then(res => {
    const feedback = res.data.isExist;
    localStorage.removeItem('counter');

    if (!feedback) {
        let counter = localStorage.getItem('counter') ? Number(localStorage.getItem('counter')) : 0;
        const max = 1000  * 5; // 5 mins

        const interval = setInterval(() => {

            if (counter < max) {
                counter += 1000;
                localStorage.setItem('counter', counter);
            } else {
                var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                myModal.show();
                clearInterval(interval)
            }

        }, 1000)

    }
});