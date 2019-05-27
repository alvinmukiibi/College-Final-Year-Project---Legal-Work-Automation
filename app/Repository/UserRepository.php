<?php
/**
 * Created by PhpStorm.
 * User: Julius M Ceaser
 * Date: 4/4/2019
 * Time: 4:35 PM
 */
namespace App\Repository;


use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{


    public function getUserById($id){
        return User::find((int)$id);
    }

    /**
     * @param $username
     * @return Collection
     */
    public function getUserByUsername($username){
        return User::where('username', 'like', '%' . $username . '%')->get();
    }

    /**
     * @param array $data
     * @param Role $role
     * @return User
     */
    public function createUser(array $data, Role $role){
        $user = User::create($data);
        $user->roles()->attach([$role->id]);
        return $user;
    }


    /**
     * @param User $user
     * @param array $user_data
     */
    public function update(User $user, array $user_data)
    {
        if (!key_exists('is_active', $user_data))
            $user_data = array_merge($user_data, ['is_active' => 0]);

        if ($user_data){
            foreach ($user_data as $key => $value){
                $user->{$key} = $value;
            }

            $user->save();
        }
    }

    /**
     * returns paginated Users
     *
     * @param int $pager
     * @return Collection|static[]
     */
    public function paginate($pager=15)
    {
        return User::paginate($pager);
    }
}
