<?php
require_once "header.inc.php";
require_once "classes/FAQ.php";
require_once "classes/Keyword.php";
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

if (isset($_GET["keyword"])) {
    Keyword::atacheToFAQ($faq, $_GET["keyword"]);
}
?>

    <form method="GET" class="col-12 text-center">
        <div class="container">
            <div class="form-group">
                <label for="keyword">
                    کلمات کلیدی:
                </label>
                <input type="text" name="keyword" id="keyword">
            </div>
            <input type="hidden" name="faq" id="faq" value="<?php echo $faq->id ?>">
            <input type="submit" class="btn btn-primary " value="ذخیره">
        </div>
    </form>


    <br>
    <div class="container col-6 col-md-4">
        <table class="table table-compact text-sm-center table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>
                    کلمات کلیدی
                </td>
            </tr>
            </thead>
            <?php

            $keywords = Keyword::getAllAcceptedByFAQ($faq);
            $counter = 1;
            foreach ($keywords as $k) {
                echo("<tr>");
                echo "<td>{$counter}</td>";
                echo("<td>" . $k->term . "</td>");
                echo("</tr>");
                $counter++;
            }
            ?>
        </table>
    </div>

<?php

FAQHTMLEnds();