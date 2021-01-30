<?php
include "header.inc.php";

HTMLBegin();

if (isset($_GET["save"])){
    echo($_GET["title"]);
    echo("<br>");
    echo($_GET["answer"]);
    echo("<br>");
    echo($_GET["click_count"]);
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
</body>
</html>