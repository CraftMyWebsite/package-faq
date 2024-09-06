<?php

namespace CMW\Entity\Faq;

use CMW\Entity\Users\UserEntity;

class FaqEntity
{
    private int $faqId;
    private string $question;
    private string $response;
    private UserEntity $author;

    /**
     * @param int $faqId
     * @param string $question
     * @param string $response
     * @param UserEntity $author
     */
    public function __construct(int $faqId, string $question, string $response, UserEntity $author)
    {
        $this->faqId = $faqId;
        $this->question = $question;
        $this->response = $response;
        $this->author = $author;
    }

    /**
     * @return int
     */
    public function getFaqId(): int
    {
        return $this->faqId;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @return UserEntity
     */
    public function getAuthor(): UserEntity
    {
        return $this->author;
    }
}
