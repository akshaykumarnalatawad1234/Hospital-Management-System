//<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

const doctor_log = document.getElementById("doctor_log");
const btn = document.getElementById("doctor");
const admin_log = document.getElementById("admin_log");
const btn1 = document.getElementById("Admin");
const Fd_log = document.getElementById("Fd_log");
const btn2 = document.getElementById("FD");
const patient_log = document.getElementById("patient_log");
const btn3 = document.getElementById("Patient");
window.onload = function() {
    var reloading = sessionStorage.getItem("reloading");
    if (reloading) {
        sessionStorage.removeItem("reloading");
        doctor_log.style.visibility="hidden";
    admin_log.style.visibility="hidden";
    Fd_log.style.visibility="hidden";
    patient_log.style.visibility="hidden";
    }
}

btn.addEventListener("click", (e) => {
    e.preventDefault();
    doctor_log.style.visibility="visible";
    const loginForm = document.getElementById("dr_login-form");
    const loginButton=document.getElementById("login_submit1");
    loginButton.addEventListener("click", (e) => {
        
        //e.preventDefault();
        
        const username = loginForm.username.value;
        const password = loginForm.password.value;
        var verify=0;
        if (username=="")
        loginForm.username.innerHTML="Enter ID";
       else if(isNaN(username))
        {loginForm.username.innerHTML="ID should be integer number";}
        
       else   if (password=="")
        loginForm.innerHTML="Enter password";
        
        else
        {
     $.ajax({
          
                url:'login.php',
                type:'POST',
                data:{method:"testpassword",table:"doctor",username:username,passwd:password},
                async:true,

                success:function(){
                    
                   
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                  },
                complete:function(res){
                    verify= JSON.parse(JSON.stringify(res));;
                    
                    console.log(verify);
                   // alert("verified"+verify);
                    if (verify.responseText=='1') {
                        alert("You have successfully logged in.");
                        localStorage.setItem("DoctorID", username);
                        location.href = "doctor.php";
                    } else {
                        alert("Incorrect user name or password")
                    }
                }

                
            });
        
          

        
}})
    doctor_log.style.visibility="visible";
    
})
btn1.addEventListener("click", (e) => {
    e.preventDefault();
    admin_log.style.visibility="visible";
    const loginForm = document.getElementById("admin_login-form");
    const loginButton=document.getElementById("login_submit2");
    loginButton.addEventListener("click", (e) => {
        //e.preventDefault();
        const username = loginForm.username.value;
        const password = loginForm.password.value;
        var verify=0;
     $.ajax({
          
                url:'login.php',
                type:'POST',
                data:{method:"testpassword",table:"admin",username:username,passwd:password},
                async:true,

                success:function(){
                    
                   
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                  },
                complete:function(res){
                    verify= JSON.parse(JSON.stringify(res));;
                    
                    console.log(verify);
                    //alert("verified"+verify);
                    if (verify.responseText=='1') {
                        alert("You have successfully logged in.");
                        location.href = "admin.html";
                    } else {
                        alert("Incorrect user name or password")
                    }
                }

                
            });
            e.preventDefault();
        
          

    })
    admin_log.style.visibility="visible";
})
btn2.addEventListener("click", (e) => {
    e.preventDefault();
    Fd_log.style.visibility="visible";
    const loginForm = document.getElementById("Fd_login-form");
    const loginButton=document.getElementById("login_submit3");
    loginButton.addEventListener("click", (e) => {
       // e.preventDefault();
        const username = loginForm.username.value;
        //if username==
        const password = loginForm.password.value;
        var verify=0;
     $.ajax({
          
                url:'login.php',
                type:'POST',
                data:{method:"testpassword",table:"FD",username:username,passwd:password},
                async:true,

                success:function(){
                    
                   
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                  },
                complete:function(res){
                    verify= JSON.parse(JSON.stringify(res));;
                    
                    console.log(verify);
                    //alert("verified"+verify);
                    if (verify.responseText=='1') {
                        alert("You have successfully logged in.");
                        location.href = "fd1.php";
                    } else {
                        alert("Incorrect user name or password")
                    }
                }

                
            });
        
    })
    Fd_log.style.visibility="visible";
})
btn3.addEventListener("click", (e) => {
    e.preventDefault();
    patient_log.style.visibility="visible";
    const loginForm = document.getElementById("patient_login-form");
    const loginButton=document.getElementById("login_submit4");
    loginButton.addEventListener("click", (e) => {
       // e.preventDefault();
        const username = loginForm.username.value;
        const password = loginForm.password.value;
        var verify=0;
        $.ajax({
             
                   url:'login.php',
                   type:'POST',
                   data:{method:"testpassword",table:"patient",username:username,passwd:password},
                   async:true,
   
                   success:function(){
                       
                      
                   },
                   error: function(xhr, status, error) {
                       var err = eval("(" + xhr.responseText + ")");
                       alert(err.Message);
                     },
                   complete:function(res){
                       verify= JSON.parse(JSON.stringify(res));;
                       
                       console.log(verify);
                       //alert("verified"+verify);
                       if (verify.responseText=='1') {
                           alert("You have successfully logged in.");
                           
                           location.href = "patient.php";
                           const patient_option=document.getElementById("patient_option");
                           const closebtn=document.getElementById("patient_back");
                           patient_option.style.visibility="visible";
                           closebtn.addEventListener("click", (e) => {
                               e.preventDefault();
                               patient_option.style.visibility="hidden";
                               patient_log.style.visibility="hidden";
                               location.href = "index.html";
                           })
                       } else {
                           alert("Incorrect user name or password")
                       }
                   }
   
                   
               });
           
    

    })
   
})
const back_btn = document.getElementById("back_btn");
back_btn.addEventListener("click", (e) => {
    e.preventDefault();
   doctor_log.style.visibility="hidden";
    admin_log.style.visibility="hidden";
    Fd_log.style.visibility="hidden";
    patient_log.style.visibility="hidden";
    
})


