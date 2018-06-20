function callback_gallery(data){
    
    var gallery = document.getElementById("gallery");
    
    for (i=0 ; i < data[1].length ; i++)
    {
        var div = document.createElement('div');
        div.setAttribute("id", "img");
        div.setAttribute("class", "img");
        div.setAttribute("title", data[1][i].id_img);
        div.innerHTML = "<div id='info'> <p>"+data[1][i].count_like+" <img style='width:30px;height:30px' src='"+data[1][i].like_src+"'/> "+data[1][i].count_com+" <img style='width:38px;height:38px' src='public/icons/comment.png'/> </p> </div><img src='"+data[1][i].img+"' /> ";
        gallery.appendChild(div);
    }

    var btn = document.getElementsByClassName("img");

    var i;
    for(i = 0 ; i < btn.length ; i++)
    {
        var modalImg = document.getElementById("imgModal");
    
        btn[i].onclick = function() {
            modal.style.display = "block";
            var id = this.title;
            ajax("model/getmodal.php?img="+id, 'modal');		
        }
    }
}

var exit = document.getElementsByClassName("close")[0];
var modal = document.getElementById('myModal');

exit.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
           modal.style.display = "none";
    }
}