var show = document.getElementById('hidden'),
    hidden_img = document.getElementById('main_photo'),
    exit = document.getElementById('exit'),
    main_src,
    like = document.getElementById('like'),
    xml = new XMLHttpRequest(),
    likes_numb,
    p_like = document.getElementById('how_much'),
    send = document.getElementById('send'),
    comment = document.getElementById('coment'),
    text = "",
    cancel = document.getElementById('cancel'),
    coment_arr = "",
    comment_list = document.getElementById('coment_list');


$(document).ready(function(){
    $('.gallery').on('click', 'a.nav-link', function(e){
        e.preventDefault();
        var page = $(this).data('page');
        $.ajax({
            url: '../php/pagination_ajax.php',
            type: 'GET',
            data: {page: page},
            success: function(res){
                $('.gallery').empty();
                $('.gallery').hide().fadeIn(1000).html(res);
            },
            error: function(){
                alert('Error');
            }
        });
    });
});


exit.onclick = function () {
    show.style.display = "none";
}

cancel.onclick = function cancel_comment() {
    comment.value = "";
}

function show_hidden(src) {
    show.style.display = "block";
    hidden_img.src = src;
    main_src = src;
    get_coment();
}


like.onclick = function make_like() {

    xml.open("POST", "../php/make_like.php", true);
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.send("src=" + main_src);
    xml.onreadystatechange = function () {
        if (xml.readyState == 4 && xml.status == 200) {
            likes_numb = xml.responseText;
            if (likes_numb != -1)
                p_like.innerHTML = likes_numb;
        }
    };
}

send.onclick = function send_comment() {
      text = comment.value;
      text = text.trim();
      if (text != ""){
          xml.open("POST", "../php/sand_comment.php", true);
          xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xml.send("src=" + main_src + "&text=" + text);
      }
    get_coment();
      comment.value = "";
}

function get_coment() {
    comment_list.innerHTML = '';
    xml.open("POST", "../php/get_coment.php", true);
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.send("src=" + main_src);
    xml.onreadystatechange = function () {
        if (xml.readyState == 4 && xml.status == 200) {
            coment_arr = xml.responseText;
            coment_arr = coment_arr.split("±@±");
            p_like.innerHTML = coment_arr[0];
            for(var i = 1; i < coment_arr.length; i += 2 ){

                var p = document.createElement("p"),
                    div = document.createElement("textarea"),
                    hr = document.createElement("hr");

                p.innerHTML =  coment_arr[i + 1] + ":";
                p.style.color = "red";
                p.classList.add('lolo');
                hr.classList.add('lolo');
                div.innerHTML = coment_arr[i];
                div.style.color = "green";
                div.setAttribute("readonly", "readonly");
                div.setAttribute("rows", "6");
                div.style.width = "500px";
                div.classList.add('lolo');
                comment_list.insertBefore(div, comment_list.firstChild);
                comment_list.insertBefore(p, comment_list.firstChild);
                comment_list.insertBefore(hr, comment_list.firstChild);
            }
        }
    };
}

