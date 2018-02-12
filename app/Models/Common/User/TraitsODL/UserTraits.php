<?php

namespace App\Models\Common\User\Traits;

trait UserTraits
{

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */


    /**
    * @param $token
    * @return bool
    * @throws GeneralException
    */
    public function confirmAccount($token)
    {
       $user = $this->findByToken($token);

       if ($user->confirmed == 1) {
          throw new GeneralException(trans('auth.exception.confirmation.already_confirmed'));
       }

       if ($user->confirmation_code == $token) {
          $user->confirmed = 1;

          event(new UserConfirmed($user));
          return parent::save($user);
       }

       throw new GeneralException(trans('auth.exception.confirmation.mismatch'));
    }



    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */




    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }

    /**
     * @return bool
     */
    public function isVerified()
    {
        return $this->verified == 1;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed == 1;
    }

    /**
     * @param $username
     * @return mixed
     * @throws GeneralException
     */
    public function isNameSlugAvailable($username)
    {
        return $this->query()->where('name_slug', $username)->count() === 0;
    }

    /**
     * @param $email
     * @return mixed
     * @throws GeneralException
     */
    public function isEmailAvailable($email)
    {
        return $this->query()->where('email', $email)->count() === 0;
    }


    /**
     * @param $email
     * @return bool
     */
    public function findByEmail($email)
    {
        return $this->query()->where('email', $email)->first();
    }

    /**
     * @param $token
     * @return mixed
     * @throws GeneralException
     */
    public function findByToken($token)
    {
        return $this->query()->where('confirmation_code', $token)->first();
    }

}
