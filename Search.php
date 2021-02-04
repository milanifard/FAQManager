<?php
require_once "header.inc.php";
require_once "classes/Ticket.php";

HTMLBegin();

?>

<div>
    <form method="get">
        <label for="term">عنوان </label><input type="text" name="term" id="term">
        <input type="submit" name="search" id="search" value="جستجو">
    </form>
</div>

<table style="width: 100%;">
<tr>
<th>شناسه</th>
<th>عنوان</th>
<th>توضیحات</th>
<th>تاریخ</th>
</tr>

<?php
 
$tickets = null;

if (isset($_GET["search"])){
    $tickets = Ticket::getAllByContainsTerm($_GET["term"]);
}else{
    $tickets = Ticket::getAll();
}

foreach ($tickets as $t){
    echo("<tr>");
    echo("<td>".htmlentities($t->id)."</td>");
    echo("<td>".htmlentities($t->title)."</td>");
    echo("<td>".htmlentities($t->description)."</td>");
    echo("<td>".htmlentities($t->time)."</td>");
    echo("</tr>");
}

?>

</table>

</body>
</html>