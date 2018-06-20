function callback_gallery(data){
    
    if (data[0]  ==  "profile")
    {
        var profile_login = document.getElementById("profile_login");
        var profile_bio = document.getElementById("profile_bio");
        var count_picture = document.getElementById("count_picture");
        var count_like = document.getElementById("count_like");
        var count_com = document.getElementById("count_com");

        profile_login.innerHTML = data[2].login;
        if (data[2].bio != null)
            profile_bio.innerHTML = "<i>"+data[2].bio+"</i>";
        count_picture.innerHTML = "<b>"+data[2].picture+"</b> Publications</td>";
        count_like.innerHTML = "<b>"+data[2].like+"</b> Likes</td>";
        count_com.innerHTML = "<b>"+data[2].comment+"</b> Commentaires</td>";
    }

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