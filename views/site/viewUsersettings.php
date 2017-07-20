<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./template/css/user_set.css">
    <title>Camagru MAIN</title>
</head>
<body>
<div class="top">
    <div class="p"><p>Account settings</p></div>
    <div class="menu">
        <div>
            <input id="exit" type="submit" name="exit" value="Exit"/>
            <input id="back" type="submit" name="back" value="<< Back"/>
        </div>
    </div>
    <div class="hr">
        <hr>
    </div>
</div>

<div id="form" class="main">
    <p id="massege"> </p>
    <div class="img">
        <div  id="menu" >
            <ul class="man">
                <li>
                    <p>CHANGE YOUR USER NAME</p>
                    <ul class="child1">
                        <li>
                            <input id="change_name" type="text" name="new_name" placeholder="Your new name"/>
                            <input type="submit" name="name" value="Change" onclick="change_user_name()"/>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="man">
                <li>
                    <p>CHANGE YOUR PASSWORD</p>
                    <ul class="child2">
                        <li>
                            <input type="password" id="change_pass" name="new_pass1" placeholder="New password"/>
                            <input type="password" id="change_pass2" name="new_pass2" placeholder="Repeat new password"/>
                            <input type="submit" name="new_pass" value="Change" onclick="change_user_pass()"/>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="man">
                <li>
                    <p>DELETE YOUR ACCOUNT</p>
                    <ul class="child3">
                        <li>
                            <p>Are you sure?</p>
                            <input type="password" id="delete_account" name="conf_pass" placeholder="Your password"/>
                            <input type="submit" name="delete" value="YES" onclick="delete_user_account()"/>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
<script src="./js/user_set.js"></script>
</body>
</html>
