<?php

namespace App\Policies;

use App\Todo;
use App\User;;

use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function update(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    /**
     * Determine whether the user can delete the Todo.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function delete(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}
