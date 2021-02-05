<?php
require_once "header.inc.php";
require_once "classes/Keyword.php";
require_once "classes/Helpers.php";

FAQHTMLBegins();

if (isset($_GET["accept"])) {
    $state = 2;
    if ($_GET["accept"] === "true") {
        $state = 1;
    }
    Keyword::changeAssingeState($_GET["faq"], $_GET["keyword"], $state);
}
?>

    <table style="width: 100%;" class="table table-striped">
        <thead>
        <tr>
            <th>سوال</th>
            <th>جواب</th>
            <th>کلمه کلیدی</th>
            <th>عملیات</th>
        </tr>
        </thead>

        <?php
        require_once "classes/Keyword.php";
        $keyword_faqs = Keyword::getSuggestedKeyword();

        foreach ($keyword_faqs as $kf) {
            $keyword = $kf["keyword"];
            $faq = $kf["faq"];
            echo("<tr>");
            echo("<td>" . htmlentities($faq->title) . "</td>");
            echo("<td>" . htmlentities($faq->answer) . "</td>");
            echo("<td>" . htmlentities($keyword->term) . "</td>");
            echo("<td>");
            echo("<a href=\"KeywordManaging.php?faq=" . $faq->id . "&keyword=" . $keyword->id . "&accept=true\">تایید</a>");
            echo("<a href=\"KeywordManaging.php?faq=" . $faq->id . "&keyword=" . $keyword->id . "&accept=false\">رد</a>");
            echo("</td>");
            echo("</tr>");
        }
        ?>

    </table>

<?php
FAQHTMLEnds();