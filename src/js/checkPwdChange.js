function checkChange(){
    if(document.getElementById("new_pwd").value!=document.getElementById("new_pwd_retype").value){
        document.getElementById("new_pwd_retype").style.border = "2px solid #f00";
        document.getElementById('change').disabled = true;
    }
    else{ 
        document.getElementById("new_pwd_retype").style.border = "1px solid #ced4da";
        document.getElementById('change').disabled = false;
    }
}