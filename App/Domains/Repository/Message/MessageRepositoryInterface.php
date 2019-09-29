<?php


namespace App\Domains\Repository\Message;

use App\Domains\Entities\Message\MessageInterface;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface MessageRepositoryInterface
 * @package App\Domains\Entities\Message
 */
interface MessageRepositoryInterface extends ObjectRepository
{

    /**
     * @param $id
     * @return MessageInterface|null
     */
    public function find($id);

    /**
     * @param array $criteria
     * @return MessageInterface|null
     */
    public function findOneBy(array $criteria);

    /**
     * @param MessageInterface $message
     * @return void
     */
    public function save(MessageInterface $message);

}