
var form = document.getElementById("menu"),
    input = document.createElement("input"),
    login,
    video = document.getElementById('video'),
    canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    photo = document.getElementById('photo'),
    vendorUrl = window.URL || window.webkitURL,
    mini_frame = document.getElementById('frame1'),
    mini_color = document.getElementById('color'),
    mini_girl = document.getElementById('girl'),
    video_frame = document.getElementById('frame1_v'),
    photo_frame = document.getElementById('frame1_v2'),
    do_yes = document.getElementById('yes'),
    do_no = document.getElementById('no'),
    do_yes_g = document.getElementById('yes_g'),
    do_no_g = document.getElementById('no_g'),
    photo_div = document.getElementById('photo_div'),
    what_frame,
    make_photo = document.getElementById('capture'),
    load_photo = document.getElementById('load_photo'),
    user_g = document.getElementById('user_g'),
    src_to_delete,
    to_save = document.getElementById('save_to_g'),
    delete_ph_gall = document.getElementById('delete_from_g');
var xmlgallery = new XMLHttpRequest(),
    xxx = new XMLHttpRequest(),
    xmlhttp = new XMLHttpRequest();


xxx.open("POST", "loged_user", true);
xxx.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xxx.send();
xxx.onreadystatechange = function () {
    if (xxx.readyState == 4 && xxx.status == 200) {
        var result = xxx.responseText;
        if (result != "!!!PPP") {
            login = result;
            input.className = "error";
            input.name = "user";
            input.type = "submit";
            input.value = login;
            form.insertBefore(input, form.firstChild);
            make_gallery(login);
            stream_go();
        }
        else
            location.href= ' http://localhost:8080/camagru/';
    }
};

function stream_go() {
    navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.
            mozGetUserMedia || navigator.msGetUserMedia;
    navigator.getMedia({ video: true, audio: false },
        function(stream) {
            video.src = vendorUrl.createObjectURL(stream);
            video.play();
        },
        function(error) {
            alert('Ошибка! Что-то пошло не так, попробуйте позже.');
        });
    context.translate(canvas.width, 0);
    context.scale(-1, 1);
}

make_photo.onclick = function()
{
    console.log("take");
    photo_div.className = "photo_div";
    context.drawImage(video, 0, 0, 400, 400);
    photo.setAttribute('src', canvas.toDataURL('image/png'));
    to_save.style.display = "block";
    make_photo.style.display = "none";
    load_photo.style.display = "none";
    video_frame.style.display = "none";
    photo_frame.style.display = "block";
}

do_yes.onclick = function ()
{
    console.log("do_yes");
    console.log(login);
    console.log(what_frame);
    xmlhttp.open("POST", "http://localhost:8080/camagru/img_plus_img", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("sr=" + photo.src + "&user_name=" + login + "&fr_src=" + what_frame);

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var result = xmlhttp.responseText;
            console.log(result);
            var div = document.getElementById("user_g");
            var img = document.createElement("img")
            img.setAttribute('src', result);
            img.setAttribute('onclick', "delete_img(this.src)");
            div.insertBefore(img, div.firstChild);
            to_none();
        }
    };
}

// load_photo.onclick = function() {
//     console.log("ddd");
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.open("POST", "../php/../php/upload.php", true);
//     xmlhttp.setRequestHeader("Content-Type", "multipart/form-data");
//     xmlhttp.send("sr=1");
//     xmlhttp.onreadystatechange = function () {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//             var result = xmlhttp.responseText;
//             console.log(result);
//         }
//     };
// }

function to_none() {
    photo_frame.style.display = "none";
    make_photo.style.display = "block";
    load_photo.style.display = "block";
    photo.src = "./img/css_img/sandruse.png";
    photo_div.className = "none";
    to_save.style.display = "none";
    video_frame.style.display = "none";
    mini_girl.style.boxShadow = "none";
    mini_frame.style.boxShadow = "none";
    mini_color.style.boxShadow = "none";
    delete_ph_gall.style.display = "none";

}

function set_atributes(src , wid, heig) {
    photo_frame.src = src;
    video_frame.src = src;
    video_frame.style.width = wid;
    video_frame.style.height = heig;
    photo_frame.style.width = wid;
    photo_frame.style.height = heig;
    what_frame = src;
    what_frame = what_frame.split("/frame/");
    what_frame = what_frame[1];
}

do_no.onclick = function ()
{
    to_none();
    make_photo.style.display = "none";
}

do_yes_g.onclick = function ()
{

    xmlhttp.open("POST", "delete_from_gallery", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("sr=" + src_to_delete);
    // var new_src = "http://localhost:8080/camagru/gallery/" + src_to_delete;
    // console.log(new_src);
    // var img_i_want_delete = getAllElementsWithAttribute("src", new_src);
    // console.log(img_i_want_delete);
    // if (img_i_want_delete != "0"){
    //
    //     img_i_want_delete.style.visibility = "hidden";
    // }
    // to_none();
    window.location.reload();
}

function getAllElementsWithAttribute(attribute, value)
{
    var allElements = document.getElementsByTagName('img');
    for (var i = 0, n = allElements.length; i < n; i++)
    {
        if ( allElements[i].src == value)
        {
            return allElements[i];
        }
    }
    return "0";
}

do_no_g.onclick = function ()
{
    delete_ph_gall.style.display = "none";
}

mini_frame.onclick = function ()
{
    to_none();
    video_frame.style.display = "block";
    mini_frame.style.boxShadow = "0 0 20px yellow";
    set_atributes("./img/frame/frame1.png", "400px", "300px");
}

mini_color.onclick = function ()
{
    to_none();
    video_frame.style.display = "block";
    mini_color.style.boxShadow = "0 0px 20px yellow";
    set_atributes("./img/frame/color.png", "350px", "300px");
}

mini_girl.onclick = function ()
{
    to_none();
    video_frame.style.display = "block";
    mini_girl.style.boxShadow = "0 0px 20px yellow";
    set_atributes("./img/frame/girl.png", "200px", "300px");
}

function delete_img(src) {
    delete_ph_gall.style.display = "block";
    src_to_delete = src;
    src_to_delete = src_to_delete.split('gallery/');
    src_to_delete = src_to_delete[1];
}

function make_gallery(login1) {

    xmlgallery.open("POST", "gallery_in_main", true);
    xmlgallery.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlgallery.send("user_name=" + login1);
    xmlgallery.onreadystatechange = function () {
        if (xmlgallery.readyState == 4 && xmlgallery.status == 200) {
            var result = xmlgallery.responseText;
            var div = document.getElementById("user_g");
            if (result != '') {
                result = result.split(',');
                for (var i = 0; i < result.length; i++) {
                    var img = document.createElement("img")
                    img.setAttribute('src', result[i]);
                    img.setAttribute('onclick', "delete_img(this.src)");
                    img.setAttribute('visibility', "visible");
                    div.insertBefore(img, div.firstChild);
                }
            }
            else{
                var p = document.createElement("p")
                p.innerHTML = "Your photos";
                div.insertBefore(p, div.firstChild);
            }
        }
    };
}




