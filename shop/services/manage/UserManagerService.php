<?php

namespace shop\services\manage;

use common\models\User;
use shop\forms\manage\User\UserCreateForm;
use shop\forms\manage\User\UserEditForm;
use shop\repositories\UserRepository;

class UserManagerService
{
    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password,
        );
        $this->repository->save($user);
        return $user;
    }

    public function edit($id, UserEditForm $form)
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email
        );
        $this->repository->save($user);
    }

    public function remove($id)
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
    }

}