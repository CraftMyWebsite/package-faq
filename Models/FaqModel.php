<?php

namespace CMW\Model\Faq;

use CMW\Entity\Faq\FaqEntity;
use CMW\Manager\Database\DatabaseManager;
use CMW\Manager\Package\AbstractModel;
use CMW\Model\Users\UsersModel;

/**
 * Class @FaqModel
 * @package faq
 * @author Teyir
 * @version 1.0
 */
class FaqModel extends AbstractModel
{
    /**
     * @param string $question
     * @param string $response
     * @param int $authorId
     * @return \CMW\Entity\Faq\FaqEntity|null
     */
    public function createFaq(string $question, string $response, int $authorId): ?FaqEntity
    {
        $var = array(
            'question' => $question,
            'response' => $response,
            'author' => $authorId
        );

        $sql = 'INSERT INTO cmw_faq (faq_question, faq_response, faq_author) VALUES (:question, :response, :author)';

        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        if ($req->execute($var)) {
            $id = $db->lastInsertId();
            return $this->getFaqById($id);
        }

        return null;
    }

    /**
     * @return FaqEntity[]
     */
    public function getFaqs(): array
    {
        $sql = 'SELECT faq_id FROM cmw_faq';
        $db = DatabaseManager::getInstance();

        $res = $db->prepare($sql);

        if (!$res->execute()) {
            return array();
        }

        $toReturn = array();

        while ($faq = $res->fetch()) {
            $toReturn[] = $this->getFaqById($faq['faq_id']);
        }

        return $toReturn;
    }

    /**
     * @param $faqId
     * @return \CMW\Entity\Faq\FaqEntity|null
     */
    public function getFaqById($faqId): ?FaqEntity
    {
        $sql = 'SELECT * FROM cmw_faq WHERE faq_id=:faq_id';

        $db = DatabaseManager::getInstance();
        $res = $db->prepare($sql);

        if (!$res->execute(array('faq_id' => $faqId))) {
            return null;
        }

        $res = $res->fetch();

        $user = (new UsersModel())->getUserById($res['faq_author']);

        return new FaqEntity(
            $res['faq_id'],
            $res['faq_question'],
            $res['faq_response'],
            $user
        );
    }

    /**
     * @param int $faqId
     * @param string $question
     * @param string $response
     * @return \CMW\Entity\Faq\FaqEntity|null
     */
    public function updateFaq(int $faqId, string $question, string $response): ?FaqEntity
    {
        $info = array(
            'faq_id' => $faqId,
            'question' => $question,
            'response' => $response
        );

        $sql = 'UPDATE cmw_faq SET faq_question=:question, faq_response=:response WHERE faq_id=:faq_id';

        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);
        if ($req->execute($info)) {
            return $this->getFaqById($faqId);
        }

        return null;
    }

    /**
     * @param int $faqId
     * @return void
     */
    public function deleteFaq(int $faqId): void
    {
        $sql = 'DELETE FROM cmw_faq WHERE faq_id=:faq_id';

        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array('faq_id' => $faqId));
    }
}
