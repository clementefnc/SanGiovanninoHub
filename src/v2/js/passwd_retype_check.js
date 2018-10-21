function passwd_retype_check(){
    if(document.getElementById("pwd").value!=document.getElementById("retype").value){
        document.getElementById("retype").style.border = "2px solid #f00";
        document.getElementById('reg').disabled = true;
    }
    else{ 
        document.getElementById("retype").style.border = "2px solid #0f0";
        document.getElementById('reg').disabled = false;
    }
}