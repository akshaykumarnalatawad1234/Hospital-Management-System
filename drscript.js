const patient_log = document.getElementById("patient_table");
const btn = document.getElementById("view_patient");
btn.addEventListener("click", (e) => {
    e.preventDefault();
    patient_log.style.display="block";
//     const btn2 = document.getElementsByClassName("view_rep");
//     alert(btn2);
//    // let id=btn2.value;
//     //alert(id);
    
//     btn2[0].addEventListener("click", (e) => {e.preventDefault();
//         let id=btn2[0].value;
//         alert(id);
//         sessionStorage.setItem("PatientID", id);
//     location.href="report.php";})
})

// function my(){
//     //e.preventDefault();
//     let id=btn2.value;
//     alert(id);
//     sessionStorage.setItem("PatientID", id);
// location.href="report.php";

// }
       