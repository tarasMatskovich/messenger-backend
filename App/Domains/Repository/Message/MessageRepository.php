<?php


namespace App\Domains\Repository\Message;

use App\Domains\Entities\Message\MessageInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class MessageRepository
 * @package App\Domains\Entities\Message
 */
class MessageRepository extends EntityRepository implements MessageRepositoryInterface
{

    /**
     * @param MessageInterface $session
     * @return void
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(MessageInterface $session)
    {
        $this->_em->persist($session);
        $this->_em->flush();
    }

}