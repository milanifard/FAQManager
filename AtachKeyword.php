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
echo("<div>");

echo("<div>");
echo("سوال " . $faq->title);
echo("</div>");

echo("<div>");
echo("جواب " . $faq->answer);
echo("</div>");

echo("<div>");
echo("تعداد کلیک " . $faq->click_count);
echo("</div>");

echo("</div>");

if (isset($_GET["keyword"])) {
    Keyword::atacheToFAQ($faq, $_GET["keyword"]);
}

echo("<form method=\"get\">");
echo("<div>
<label for=\"keyword\">کلمه کلیدی :</label><input type=\"text\" name=\"keyword\" id=\"keyword\">
</div>");
echo("<div>
<input type=\"hidden\" name=\"faq\" id=\"faq\" value=\"" . $faq->id . "\">
</div>");
echo("<div>
<input type=\"submit\" name=\"save\" id=\"save\" value=\"ذخیره\">
</div>");
echo("</form>");


echo("<table style=\"width: 100%\">");

$keywords = Keyword::getAllAcceptedByFAQ($faq);
foreach ($keywords as $k) {
    echo("<tr>");
    echo("<td>" . $k->term . "</td>");
    echo("</tr>");
}

echo("</table>");

FAQHTMLEnds();