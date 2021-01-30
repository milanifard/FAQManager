<?php


class FAQ
{
    public $id;
    public $title;
    public $answer;
    public $click_count;

    static function getNewInstance($title, $answer, $click_count) {
        $faq = new FAQ();
        $faq->title = $title;
        $faq->answer = $answer;
        $faq->click_count = $click_count;
        return $faq;
    }

    static function add($faq){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("insert into faqs (title, answer, click_count) values (?, ?, ?);");
        $mysql->ExecuteStatement(array($faq->title, $faq->answer, $faq->click_count));
    }

    static function toFAQ($row){
        $faq = new FAQ();
        $faq->id = $row["id"];
        $faq->title = $row["title"];
        $faq->answer = $row["answer"];
        $faq->click_count = $row["click_count"];
        return $faq;
    }

    static function getAll($page_number){
        $mysql = pdodb::getInstance();
        $offset = $page_number * 10;
        $mysql->Prepare("select * from faqs order by id desc limit 10;");
        $result = $mysql->ExecuteStatement(array());

        $faqs = array();

        while($row = $result->fetch()){
            array_push($faqs, self::toFAQ($row));
        }
        return $faqs;
    }
}