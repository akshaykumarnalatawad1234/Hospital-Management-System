const dashBtn1 = document.getElementById('dashboard');
const dashOpt1 = document.getElementById('dash_opt1');

dashBtn1.addEventListener("click", (e) => {
    e.preventDefault();
    if (dashOpt1.style.visibility == 'visible') {
        dashOpt1.style.visibility = 'hidden';
    } else {
        dashOpt1.style.visibility = 'visible';
    }
})

const docBtn = document.getElementById('add_doctor');
const docForm = document.getElementById('doctor_div');

docBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if (docForm.style.visibility == 'visible') {
        docForm.style.visibility = 'hidden';
    } else {
        docForm.style.visibility = 'visible';
    }
})



const fdBtn = document.getElementById('add_fd');
const fdForm = document.getElementById('fd_div');

fdBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if (fdForm.style.visibility == 'visible') {
        fdForm.style.visibility = 'hidden';
    } else {
        fdForm.style.visibility = 'visible';
    }
})