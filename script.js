function verif(){
    id=document.getElementById("task").value;
    if(id.trim()==""||id.length>8||id.length>1&&id.length<9){
        alert("Invalid id");
        return true;
    }
    list=document.getElementById("select").selectedIndex==0;
    if(list){
        alert("Select a list");
        return true;
        }
}