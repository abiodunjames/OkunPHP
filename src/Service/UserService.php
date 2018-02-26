<?php
declare(strict_types = 1);

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository('App\Entities\User');
    }

    /**
     *  Find and return ArrayCollection of all users
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->findAll();
    }

    /**
     *  Find and return user that matches the given Id
     *
     * @param $id
     * @return null|object
     */
    public function findById($id)
    {
        return $this->repository->find($id);
    }
}
