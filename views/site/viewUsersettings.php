<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 10.07.17
 * Time: 11:41
 */
?>

<div class="top">
    <div class="p"><p>Account settings</p></div>
    <div class="menu">
        <form  method="POST" action="../php/user_set.php">
            <input type="submit" name="exit" value="Exit"/>
            <input type="submit" name="back" value="<< Back"/>
        </form>
    </div>
    <div class="hr">
        <hr>
    </div>



</div>
<div id="form" class="main">
    <div class="img">
        <form  id="menu" class="form" method="POST" action="../php/user_set.php">
            <ul class="man">
                <li>
                    <p>CHANGE YOUR USER NAME</p>
                    <ul class="child1">
                        <li>
                            <input type="text" name="new_name" placeholder="Your new name"/>
                            <input type="submit" name="name" value="Change"/>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="man">
                <li>
                    <p>CHANGE YOUR PASSWORD</p>
                    <ul class="child2">
                        <li>
                            <input type="password" name="new_pass1" placeholder="New password"/>
                            <input type="password" name="new_pass2" placeholder="Repeat new password"/>
                            <input type="submit" name="new_pass" value="Change"/>
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
                            <input type="password" name="conf_pass" placeholder="Your password"/>
                            <input type="submit" name="delete" value="YES"/>
                        </li>
                    </ul>
                </li>
            </ul>
        </form>
    </div>
</div>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
<script src="../js/massage.js"></script>
