<?php
require_once "header.inc.php";
require_once "classes/FAQ.php";
require_once "classes/UserGroup.php";

HTMLBegin();

//todo add page


$userGroups = UserGroup::getAll();

if (isset($_GET["send"])){

    $userGroup = null;
    foreach ($userGroups as $u){
        if ($u->title === $_GET["group"]){
            $userGroup = $u;
            break;
        }
    }

    
    $faqs = FAQ::getRelatedFAQ($_GET["title"], $_GET["description"], null, $userGroup);
    echo(count($faqs));

}else{
    echo("<form method=\"get\">
    <div>
        <label for=\"title\">عنوان: </label>
        <input type=\"text\" name=\"title\" id=\"title\">
    </div>
    <div>
        <label for=\"description\">توضیحات :</label>
        <input type=\"text\" name=\"description\" id=\"description\">
    </div>
    <div>
        <label for=\"group\">گروه کاربر: </label>
        <select name=\"group\" id=\"group\">");

    
    foreach ($userGroups as $u){
        echo("<option value=\"".$u->title."\">".$u->persionTitle."</option>");
    }
    echo("</select>
    </div>

    <div>
        <input type=\"submit\" name=\"send\" id=\"send\" value=\"ارسال\">
    </div>
</form>");
}

?>
</body>
</html>