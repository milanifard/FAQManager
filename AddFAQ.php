<?php
require_once "header.inc.php";
require_once "classes/FAQ.php";
require_once "classes/UserGroup.php";
require_once "classes/Helpers.php";

FAQHTMLBegins();


if (isset($_GET["save"])) {
    $faq = FAQ::getNewInstance($_GET["title"], $_GET["answer"], $_GET["click_count"]);
    $faq = FAQ::add($faq);

    $userGroups = UserGroup::getAll();
    foreach ($userGroups as $u) {
        if (isset($_GET[$u->title])) {
            UserGroup::attachToFAQ($faq, $u);
        }
    }
}

?>

    <form method="get" class="add-faq-form col-6 col-md-4">
        <div class="text-center">
            <label for="title">سوال :</label>
            <br>
            <input type="text" name="title" id="title" class="col-10">
        </div>
        <div class="text-center">
            <label for="answer">جواب :</label>
            <br>
            <textarea name="answer" id="answer" rows="5" class="col-10"></textarea>
        </div>
        <div class="text-center">
            <label for="click_count">تعداد کلیک :</label>
            <br>
            <input type="number" name="click_count" id="click_count" value="0" class="col-10">
        </div>

        <div class="add-faq-target-choose">
            <?php
            require_once "classes/UserGroup.php";

            $userGroups = UserGroup::getAll();
            foreach ($userGroups as $u) {
                echo("<label for=\"" . $u->title . "\">" . $u->persionTitle . "</label><input type=\"checkbox\" id=\"" . $u->title . "\" name=\"" . $u->title . "\" value=\"" . $u->title . "\" checked>");
            }
            ?>
        </div>

        <div>
            <input type="submit" name="save" class="btn btn-primary" id="save" value="ذخیره">
        </div>
    </form>

    <table style="width: 100%" class="table table-striped">
        <thead>
        <tr>
            <th>شناسه</th>
            <th>سوال</th>
            <th>جواب</th>
            <th>تعداد کلیک</th>
            <th>عملیات</th>
            <th></th>
        </tr>
        </thead>
        <?php
        $faqs = FAQ::getAll(0);
        foreach ($faqs as $f) {
            echo("<tr>");
            echo("<td>" . $f->id . "</td>");
            echo("<td>" . $f->title . "</td>");
            echo("<td>" . $f->answer . "</td>");
            echo("<td>" . $f->click_count . "</td>");
            echo("<td><a target=\"_blank\" href=\"AtachKeyword.php?faq=" . $f->id . "\">کلمات کلیدی</a></td>");
            echo("<td><a target=\"_blank\" href=\"AttachPage.php?faq=" . $f->id . "\">صفحات</a></td>");
            echo("</tr>");
        }
        ?>
    </table>

<?php

FAQHTMLEnds();