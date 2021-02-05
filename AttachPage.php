<?php
require_once "header.inc.php";
require_once "classes/FAQ.php";
require_once "classes/Page.php";
require_once "classes/Helpers.php";

FAQHTMLBegins();

$faq = null;
if (isset($_GET["faq"])) {
    $faq = FAQ::getById($_GET["faq"]);
}

if ($faq === null) {
    return;
}

?>
    <div class="attach-keyword-container col-10 col-md-6">
        <table class="table table-striped text-center">
            <tr>
                <td>
                    سوال
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $faq->title; ?>
                </td>
            </tr>
            <tr>
                <td>
                    جواب
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $faq->answer; ?>
                </td>
            </tr>
            <tr>
                <td>
                    تعداد کلیک
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $faq->click_count; ?>
                </td>
            </tr>
        </table>
    </div>

<?php


if (isset($_GET["title"]) && isset($_GET["url"])) {
    Page::attachPageToFAQ($faq, $_GET["title"], $_GET["url"]);
}

?>
    <form method="GET" class="col-12 text-center">
        <div class="container">
            <div class="form-group">
                <label for="title">
                    عنوان صفحه:
                </label>
                <input type="text" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="url">
                    عنوان صفحه:
                </label>
                <input type="text" name="url" id="url">
            </div>
            <input type="hidden" name="faq" id="faq" value="<?php echo $faq->id ?>">
            <input type="submit" class="btn btn-primary " value="ذخیره">
        </div>
    </form>

    <br>
    <div class="container col-6 col-md-4">
        <table class="table table-compact text-sm-center table-striped">
            <thead class="font-weight-bold">
            <tr>
                <td>#</td>
                <td>
                    عنوان
                </td>
                <td>
                    آدرس
                </td>
            </tr>
            </thead>
            <?php


            $pages = Page::getAllPagesByFAQ($faq);
            $counter = 1;
            foreach ($pages as $p) {
                echo("<tr>");
                echo "<td>{$counter}</td>";
                echo("<td>" . $p->title . "</td>");
                echo("<td>" . $p->url . "</td>");
                echo("</tr>");
                $counter++;
            }
            ?>
        </table>
    </div>

<?php
FAQHTMLEnds();