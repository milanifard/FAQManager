<?php
require_once "header.inc.php";
require_once "classes/FAQ.php";
require_once "classes/Page.php";

HTMLBegin();

$faq = null;
if (isset($_GET["faq"])){
    $faq = FAQ::getById($_GET["faq"]);
}

if ($faq === null){
    return;
}

echo("<div>");

echo("<div>");
echo("سوال ".$faq->title);
echo("</div>");

echo("<div>");
echo("جواب ".$faq->answer);
echo("</div>");

echo("<div>");
echo("تعداد کلیک ".$faq->click_count);
echo("</div>");

echo("</div>");

if (isset($_GET["title"]) && isset($_GET["url"])){
    Page::attachPageToFAQ($faq, $_GET["title"], $_GET["url"]);
}

echo("<form method=\"get\">");
echo("<div>
<label for=\"title\">عنوان صفحه :</label><input type=\"text\" name=\"title\" id=\"title\">
<label for=\"url\">آدرس صفحه :</label><input type=\"text\" name=\"url\" id=\"url\">
</div>");
echo("<div>
<input type=\"hidden\" name=\"faq\" id=\"faq\" value=\"".$faq->id."\">
</div>");
echo("<div>
<input type=\"submit\" name=\"save\" id=\"save\" value=\"ذخیره\">
</div>");
echo("</form>");


echo("<table style=\"width: 100%\">");

$pages = Page::getAllPagesByFAQ($faq);
foreach ($pages as $p){
    echo("<tr>");
    // print_r($p);
    echo("<td>".$p->title."</td>");
    echo("<td>".$p->url."</td>");
    echo("</tr>");
}

echo("</table>");
?>
</body>
</html>