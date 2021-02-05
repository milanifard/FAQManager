<?php
require_once "header.inc.php";
require_once "classes/Ticket.php";
require_once "classes/Helpers.php";

FAQHTMLBegins();
?>

    <div>
        <form method="get" class="col-10 col-md-4 text-center search-form">
            <div class="form-group">
                <label for="term">عنوان </label>
                <input type="text" name="term" id="term" class="form-control" placeholder="عنوان">
            </div>
            <input type="submit" class="btn btn-primary" name="search" id="search" value="جستجو">
        </form>
    </div>

    <table class="table table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th>شناسه</th>
                <th>عنوان</th>
                <th>توضیحات</th>
                <th>تاریخ</th>
            </tr>
        </thead>

<?php

$tickets = null;

if (isset($_GET["search"])) {
    $tickets = Ticket::getAllByContainsTerm($_GET["term"]);
} else {
    $tickets = Ticket::getAll();
}

foreach ($tickets as $t) {
    echo("<tr>");
    echo("<td>" . htmlentities($t->id) . "</td>");
    echo("<td>" . htmlentities($t->title) . "</td>");
    echo("<td>" . htmlentities($t->description) . "</td>");
    echo("<td>" . htmlentities($t->time) . "</td>");
    echo("</tr>");
}
FAQHTMLEnds();