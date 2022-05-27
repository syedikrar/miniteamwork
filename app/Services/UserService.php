<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUsers()
    {
      return User::all();
    }

    public function deleteUser($id)
    {
      return User::find($id)->delete();
    }
}
