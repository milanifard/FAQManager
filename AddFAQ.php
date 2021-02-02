<?php
require_once "header.inc.php";
require_once "classes/FAQ.php";
require_once "classes/UserGroup.php";

HTMLBegin();

if (isset($_GET["save"])){
    $faq = FAQ::getNewInstance($_GET["title"], $_GET["answer"], $_GET["click_count"]);
    $faq = FAQ::add($faq);

    $userGroups = UserGroup::getAll();
    foreach ($userGroups as $u){
        if (isset($_GET[$u->title])){
            UserGroup::attachToFAQ($faq, $u);
        }
    }
}

?>

    <form method="get">
        <div>
             <label for="title">سوال :</label><input type="text" name="title" id="title">
        </div>
        <div>
             <label for="answer">جواب :</label><input type="text" name="answer" id="answer">
        </div>
        <div>
             <label for="click_count">تعداد کلیک :</label><input type="number" name="click_count" id="click_count">
        </div>

        <div>
        <?php
            require_once "classes/UserGroup.php";

            $userGroups = UserGroup::getAll();
            foreach ($userGroups as $u){
                echo("<label for=\"".$u->title."\">".$u->persionTitle."</label><input type=\"checkbox\" id=\"".$u->title."\" name=\"".$u->title."\" value=\"".$u->title."\" checked>");
            }
        ?>
        </div>

        <div>
            <input type="submit" name="save" id="save" value="ذخیره">
        </div>
    </form>

    <table style="width: 100%">
        <tr>
            <th>شناسه</th>
            <th>سوال</th>
            <th>جواب</th>
            <th>تعداد کلیک</th>
            <th>عملیات</th>
        </tr>
<?php
    $faqs = FAQ::getAll(0);
    foreach ($faqs as $f) {
        echo("<tr>");
        echo("<td>".$f->id."</td>");
        echo("<td>".$f->title."</td>");
        echo("<td>".$f->answer."</td>");
        echo("<td>".$f->click_count."</td>");
        echo("<td><a target=\"_blank\" href=\"AtachKeyword.php?faq=".$f->id."\">کلمات کلیدی</a></td>");
        echo("<td><a target=\"_blank\" href=\"AttachPage.php?faq=".$f->id."\">صفحات</a></td>");
        echo("</tr>");
    }
?>
    </table>
</body>
</html>
