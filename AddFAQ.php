<?php
require_once "header.inc.php";
require_once "classes/FAQ.php";

HTMLBegin();

if (isset($_GET["save"])){
    echo($_GET["title"]);
    echo("<br>");
    echo($_GET["answer"]);
    echo("<br>");
    echo($_GET["click_count"]);

    $faq = FAQ::getNewInstance($_GET["title"], $_GET["answer"], $_GET["click_count"]);
    FAQ::add($faq);
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
            <input type="submit" name="save" id="save" value="ذخیره">
        </div>
    </form>

    <table style="width: 100%">
        <tr>
            <th>شناسه</th>
            <th>سوال</th>
            <th>جواب</th>
            <th>تعداد کلیک</th>
        </tr>
<?php
    $faqs = FAQ::getAll(0);
    foreach ($faqs as $f) {
        echo("<tr>");
        echo("<td>".$f->id."</td>");
        echo("<td>".$f->title."</td>");
        echo("<td>".$f->answer."</td>");
        echo("<td>".$f->click_count."</td>");
        echo("</tr>");
    }
?>
    </table>
</body>
</html>
