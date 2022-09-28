const dashBtn = document.getElementById('dashboard');
const dashOpt = document.getElementById('dash_opt');

dashBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if (dashOpt.style.visibility == 'visible') {
        dashOpt.style.visibility = 'hidden';
    } else {
        dashOpt.style.visibility = 'visible';
    }
})




const patientForm = document.getElementById('patient_details');
const patientBtn = document.getElementById('add_patient');
patientBtn.addEventListener("click", (e) => {
    e.preventDefault();
    if (patientForm.style.visibility == 'visible') {
        patientForm.style.visibility = 'hidden';
    } else {
        patientForm.style.visibility = 'visible';
    }
})

const editForm = document.getElementById('edit_patient_div');
 const editBtn = document.getElementById('edit_pat');

editBtn.addEventListener("click", (e) => {
    e.preventDefault();
  //  if (editForm.style.visibility == 'visible') {
        editForm.style.visibility = 'visible';

//     // } else {
//     //     editForm.style.visibility = 'visible';
//     //     // const searchForm = document.getElementById('search_result');
//     //      const searchBtn = document.getElementById('search_btn');

//     //     // searchBtn.addEventListener("click", (e) => {
//     //     //     e.preventDefault();
//     //     //     document.getElementById('edit_form').submit();
//     //     //     //searchForm.style.display = "none";
//     //     //     //fetchdat();
//     //     //     //searchForm.style.display = "block";

//     //     // })
//     // }
 })
const back_btn = document.getElementById("formclose");
back_btn.addEventListener("click", (e) => {
    e.preventDefault();
    editForm.style.visibility = 'hidden';
    
})
var max_fields = 5;
var x = 1; 
const allergyf=document.getElementById('add1');
const addBtn = document.getElementById('add');
const rmBtn = document.getElementById('remove');
addBtn.addEventListener("click",(e)=>{
    e.preventDefault();
    if(x<=5){
        x=x+1;
        var clone=allergyf.cloneNode(true);
        clone.id='add1'+x;
        allergyf.parentNode.appendChild(clone);
    }

})
rmBtn.addEventListener("click",(e)=>{
    e.preventDefault();
    if(x>=1){
        document.getElementById('add1'+x).remove();
        x=x-1;
    }
   
})
var max_fields1 = 5;
var x1 = 1; 
const allergyf1=document.getElementById('addz11');
const addBtn1 = document.getElementById('addb1');
const rmBtn1 = document.getElementById('removez1');
addBtn1.addEventListener("click",(e)=>{
    e.preventDefault();
    if(x1<=5){
        x1=x1+1;
        var clone=allergyf1.cloneNode(true);
        clone.id='addz1'+x1;
        allergyf1.parentNode.appendChild(clone);
    }

})
rmBtn1.addEventListener("click",(e)=>{
    e.preventDefault();
    if(document.getElementById('addz1'+x1)!=null){
        
        document.getElementById('addz1'+x1).remove();
        x1=x1-1;
    }
   
})
