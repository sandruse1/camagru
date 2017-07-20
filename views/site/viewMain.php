<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./template/css/main.css">
    <title>Camagru MAIN</title>
</head>
<body>
<div class="top">
    <div class="p"> <p>CAMAGRU</p></div>
    <div class="menu">
        <div id="menu">
            <input id="go_to_gallery" type="submit" name="gallery" value="Gallery"/>
            <input id="do_exit" type="submit" name="exit" value="Exit"/>
        </div>
    </div>
    <div class="hr">
        <hr>
    </div>
</div>
<div id="fom" class="main">
    <div class="all">

        <div class="frame">
            <img id="frame1" src="./img/frame/frame1.png" alt="">
            <img id="color" src="./img/frame/color.png" alt="">
            <img id="girl" src="./img/frame/girl.png" alt="">
        </div>

        <div class="center">
            <div class="booth">
                <video  id="video" width="400" height="400" autoplay></video>
            </div>

            <div class="else">
                <a href="#" id="capture" class="booth-capture-button"  methods="POST">Take photo</a>

                <form enctype="multipart/form-data" method="post" action="../php/upload.php" >
                    <div  class="file-upload">
                        <label>
                            <input type="file" name="photo_file">
                            <span>Виберіть файл</span>
                        </label>
                    </div>
                    <div id="load_photo" class="file-upload">
                        <label>
                            <input type="submit" name="Download">
                            <span>Загрузити фото</span>
                        </label>
                    </div>
                </form>

                <canvas id="canvas" width="400" height="400"></canvas>

                <div id="photo_div" >
                    <img width="400" height="300" class="photo_divka" src="./img/css_img/sandruse.png" name="img" id="photo" alt="Ваша фотография">
                </div>

                <div id="save_to_g">
                    <p>SAVE PHOTO TO GALLERY?</p>
                    <input id="yes" type="button" value="Yes">
                    <input id="no" type="button" value="No">
                </div>

                <img id="frame1_v" width="" height="" src="" alt="">
                <img id="frame1_v2" width="" height="" src="" alt="">
            </div>
        </div>

        <div id="groop">
            <div class="user_g" id="user_g"></div>
            <div id="delete_from_g">
                <p>DELETE THIS PHOTO?</p>
                <input id="yes_g" type="button" value="Yes">
                <input id="no_g" type="button" value="No">
            </div>
        </div>
    </div>
</div>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
<script src="./js/main.js"></script>
</body>
</html>
