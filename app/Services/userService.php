<?php


namespace App\Services;


use App\Models\User;
use Webpatser\Uuid\Uuid;

class userService
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = app(User::class);
    }

    public function createMember($params, $provider)
    {

        $user = $this->userModel->where('provider_id', $params['id'])->where('provider', $provider)->first();
        if (!$user) {
            $email = 'vietmix_'. Uuid::generate(1)->node . "_$provider@vietmix.vn";
            $user = $this->userModel->create([
                'email' => $email,
                'name' => $params['name'],
                'provider_id' => $params['id'],
                'provider' => $provider,
                'role' => User::$roles['member'],
                'password' => bcrypt('vietmix.vn')
            ]);
        }
        return $user;
    }
}
