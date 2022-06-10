<?php

namespace CMW\Model\Faq;

use CMW\Model\manager;

use PDO;
use stdClass;

/**
 * Class @faqModel
 * @package faq
 * @author Teyir
 * @version 1.0
 */
class faqModel extends manager
{
    public string $question;
    public string $response;
    public string $author;
    public int $faqId;

    // Create a new faq
    public function faqCreate(): void
    {
        $var = array(
            'question' => $this->question,
            'response' => $this->response,
            'author' => $this->author
        );

        $sql = "INSERT INTO cmw_faq (question, response, author) VALUES (:question, :response, :author)";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $req->execute($var);
    }

    // Get faq list
    public function fetchAll(): array
    {
        $sql = "SELECT * FROM cmw_faq";
        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $res = $req->execute();

        if ($res) {
            return $req->fetchAll();
        }
        return [];
    }

    //Fetch an FAQ
    public function fetch($faqId): array
    {
        $var = array(
            "faq_id" => $faqId
        );

        $sql = "SELECT * FROM cmw_faq WHERE faq_id=:faq_id";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);

        if ($req->execute($var)) {
            $result = $req->fetch();
            foreach ($result as $key => $property) {

                //to camel case all keys
                $key = explode('_', $key);
                $firstElement = array_shift($key);
                $key = array_map('ucfirst', $key);
                array_unshift($key, $firstElement);
                $key = implode('', $key);

                if (property_exists(faqModel::class, $key)) {
                    $this->$key = $property;
                }
            }
        }
        return [];
    }

    //Edit an FAQ
    public function update(): void
    {
        $info = array(
            "faq_id" => $this->faqId,
            "question" => $this->question,
            "response" => $this->response
        );

        $sql = "UPDATE cmw_faq SET question=:question, response=:response WHERE faq_id=:faq_id";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $req->execute($info);
    }

    //Delete an FAQ
    public function delete(): void
    {
        $info = array(
            "faq_id" => $this->faqId
        );

        $sql = "DELETE FROM cmw_faq WHERE faq_id=:faq_id";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $req->execute($info);
    }

}
