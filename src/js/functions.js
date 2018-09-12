function check(){
    if(document.getElementById("pwd").value!=document.getElementById("retype").value){
        document.getElementById("retype").style.border = "2px solid #f00";
        document.getElementById('reg').disabled = true;
    }
    else{ 
        document.getElementById("retype").style.border = "1px solid #000";
        document.getElementById('reg').disabled = false;
    }
}