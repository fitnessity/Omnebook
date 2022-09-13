<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Contracts\Provider;
use App\User;
use App\UserProfessionalDetail;

class SocialAccountService {

    public function getUser(Provider $provider) {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        return $account = User::join('social_accounts', 'social_accounts.user_id', '=', 'users.id')
                ->where('users.is_social_login', '1')
                ->where('provider_user_id', $providerUser->getId())
                ->where('provider', $providerName)
                ->first();
    }

    public function createUser(Provider $provider, $user_type) {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        $account = new SocialAccount([
            'provider_user_id' => $providerUser->getId(),
            'provider' => $providerName
        ]);

        $userObj = New User();
        $userObj->role = $user_type;
        $userObj->firstname = $providerUser->getName();
        $userObj->email = $providerUser->getEmail();
        $userObj->is_social_login = '1';
        $userObj->country = 'US';
        if ($user_type == "customer") {
            // $userObj->status = "email_activation_pending";
            $userObj->status = "approved";
        } else if ($user_type == "business") {
            $userObj->status = "draft";
        }

        $userObj->save();

        //save user professional detail
        $profileObj = New UserProfessionalDetail();
        $profileObj->user_id = $userObj->id;
        $profileObj->save();

        // associate social record with user record
        $account->user()->associate($userObj);
        $account->save();

        return $userObj;
    }

    public function createOrGetUser(ProviderUser $providerUser) {
        $account = User::where('is_social_login', '1')
                ->where('social_id', $providerUser->getId())
                ->where('provider', 'facebook')
                ->first();

        $account = SocialAccount::whereProvider('facebook')
                ->whereProviderUserId($providerUser->getId())
                ->first();
        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $userObj = New User();
            $userObj->role = 'customer';
            $userObj->firstname = $providerUser->getName();
            $userObj->email = $providerUser->getEmail();
            $userObj->is_social_login = '1';
            $userObj->save();

            //associate social record with user record
            $account->user()->associate($userObj);
            $account->save();

            return $userObj;
        }
    }

}
