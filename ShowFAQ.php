<?php
require_once "header.inc.php";
require_once "classes/FAQ.php";
HTMLBegin();

if (!isset($_GET["id"])){
    return;
}

$faq = FAQ::getById($_GET["id"]);

if ($faq == null){
    return;
}

$faq->increaseClickCount();

echo("<div>");
echo("<div>".htmlentities($faq->title)."</div>");
echo("<div>".htmlentities($faq->answer)."</div>");
echo("</div>");

if (isset($_GET["description"]) && isset($_GET["title"]) && !isset($_GET["usefull"])){
    echo("<div>");
    echo("<form method=\"get\">");
    echo("<input type=\"hidden\" name=\"description\" id=\"description\" value=\"".htmlentities($_GET["description"])."\">");
    echo("<input type=\"hidden\" name=\"title\" id=\"title\" value=\"".htmlentities($_GET["title"])."\">");
    echo("<input type=\"hidden\" name=\"id\" id=\"id\" value=\"".htmlentities($_GET["id"])."\">");
    echo("<input type=\"submit\" name=\"usefull\" id=\"usefull\" value=\"کاربردی بود\">");
    echo("</form>");
    echo("</div>");
}

if (isset($_GET["usefull"])){
    $faq->addUsefullKeyword($_GET["description"], $_GET["title"]);
}

?>

</body>
</html>