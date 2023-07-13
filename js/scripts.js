document.getElementById("download").addEventListener("click",function(){

    var url = "../views/img/179662_104059769669882_100001975771947_26300_772872_n.jpg";
    var a = document.createElement("a");
    a.href = url;
    a.download = "archivo";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});