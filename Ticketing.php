<?php
require_once "header.inc.php";
require_once "classes/FAQ.php";
require_once "classes/Page.php";
require_once "classes/UserGroup.php";
require_once "classes/Ticket.php";
require_once "classes/Helpers.php";

FAQHTMLBegins();

$showTickForm = true;

function saveTicket()
{
    echo("درخواست شما با موفقیت ارسال شد.");
    echo($_GET["page"]);
    Ticket::save($_GET["title"], $_GET["description"], $_GET["group"], $_GET["page"]);
}

if (isset($_GET["save"])) {
    saveTicket();
}

if (isset($_GET["send"])) {

    $faqs = FAQ::getRelatedFAQ($_GET["title"], $_GET["description"], $_GET["page"], $_GET["group"]);

    if (count($faqs) > 0) {
        echo("<div>");
        echo("<div>" . htmlentities($_GET["title"]) . "</div>");
        echo("<div>" . htmlentities($_GET["description"]) . "</div>");
        echo("</div>");

        echo("<div>");
        foreach ($faqs as $f) {
            echo("<div><a href=\"ShowFAQ.php?id=" . $f->id . "&description=" . $_GET["description"] . "&title=" . $_GET["title"] . "\">" . htmlentities($f->title) . "</a></div>");
        }
        echo("</div>");

        echo("<form method=\"get\">");
        echo("<input type=\"submit\" name=\"save\" id=\"save\" value=\"جواب ها مفید نبود\">");
        echo("<input type=\"hidden\" name=\"group\" id=\"group\" value=\"" . $_GET["group"] . "\">");
        echo("<input type=\"hidden\" name=\"title\" id=\"title\" value=\"" . $_GET["title"] . "\">");
        echo("<input type=\"hidden\" name=\"description\" id=\"description\" value=\"" . $_GET["description"] . "\">");
        echo("<input type=\"hidden\" name=\"page\" id=\"page\" value=\"" . $_GET["page"] . "\">");
        echo("</form>");

        $showTickForm = false;
    } else {
        saveTicket();
    }


}

if ($showTickForm) {
    ?>
    <div class="container">
    <form method="GET" class="ticketing-form">
        <div class="form-group">
            <label for="title">
                عنوان:
            </label>
            <input type="text" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="description">
                توضیحات:
            </label>
            <br>
            <textarea name="description" id="description" cols="50" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="group">
                گروه کاربران:
            </label>
            <select name="group" id="group" class="form-control col-md-3 col-6">
                <?php
                $userGroups = UserGroup::getAll();
                foreach ($userGroups as $u) {
                    $out_string = htmlentities($u->persionTitle);
                    echo("<option value='{$u->id}'>{$out_string}</option>");
                }
                ?>
            </select>
            <?php
            $pages = Page::getAll();
            if (count($pages)>0):
                ?>
                <select name="page" id="page" class="form-control col-md-3 col-6">
                    <?php
                    foreach ($pages as $p) {
                        $out_string = htmlentities($p->title);
                        echo("<option value='{$p->id}'>{$out_string}</option>");
                    }
                    ?>
                </select>
            <?php
            endif;
            ?>

        </div>
        <input type="hidden" name="send" value="">

        <input type="submit" class="btn btn-primary" value="ارسال">
    </form>
    </div>
    <?php

}

FAQHTMLEnds();