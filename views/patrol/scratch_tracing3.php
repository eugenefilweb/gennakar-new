    public function getUserFullname()
    {
        return App::if($this->user, fn ($user) => $user->fullname);
    }

      public function getFullname()
    {
        return $this->profile->fullname ?: $this->username;
    }
    
    public function getProfile()
    {
        return new ProfileForm(['user_id' => $this->id]);
    }