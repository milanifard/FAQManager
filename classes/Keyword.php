<?php
require_once "FAQ.php";

class Keyword
{
    public $id;
    public $term;

    static function toKeyword($row){
        $keyword = new Keyword();
        $keyword->id = $row["id"];
        $keyword->term = $row["term"];
        return $keyword;
    }

    static function getAllAcceptedByFAQ($faq){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select k.* from faqs_keywords inner join keywords k on faqs_keywords.keyword_id = k.id where state = 1 and faq_id = ?;");
        $result = $mysql->ExecuteStatement(array($faq->id));

        $keywords = array();
        while($row = $result->fetch()){
            array_push($keywords, self::toKeyword($row));
        }
        return $keywords;
    }


    static function atacheToFAQ($faq, $term){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select * from keywords where term = ?;");
        $result = $mysql->ExecuteStatement(array($term));
        
        $keyword = null;
        if ($row = $result->fetch()){
            $keyword = self::toKeyword($row);
        } else{
            $mysql->Prepare("insert into keywords (term) values (?);");
            $result = $mysql->ExecuteStatement(array($term));
            
            $mysql->Prepare("select * from keywords where term = ?;");
            $result = $mysql->ExecuteStatement(array($term));
            $row = $result->fetch();
            $keyword = self::toKeyword($row);
        }
        
        //todo: check not assigned before

        $mysql->Prepare("insert into faqs_keywords (faq_id, keyword_id, state) values (?,?,1);");
        $result = $mysql->ExecuteStatement(array($faq->id, $keyword->id));
    
    }

    static function changeAssingeState($faqId, $keywordId, $newState){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("update faqs_keywords 
        set state = ?
        where faq_id = ?
        and keyword_id = ?");
        $mysql->ExecuteStatement(array($newState, $faqId, $keywordId));
    }

    static function getSuggestedKeyword(){
        $mysql = pdodb::getInstance();
        $mysql->Prepare("select k.id as keyword_id,
                        k.term,
                        f.*
                        from keywords k
                        inner join faqs_keywords fk on k.id = fk.keyword_id
                        inner join faqs f on fk.faq_id = f.id
                        where fk.state = 0;");
        $result = $mysql->ExecuteStatement(array());

        $keyword_faq = array();
        while($row = $result->fetch()){
            $keyword = new Keyword();
            $keyword->id = $row["keyword_id"];
            $keyword->term = $row["term"];

            $faq = FAQ::toFAQ($row);

            $o["keyword"] = $keyword;
            $o["faq"] = $faq;

            array_push($keyword_faq, $o);
        }
        return $keyword_faq;
    }
}
?>