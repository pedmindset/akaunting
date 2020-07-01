<?php

namespace App\Traits;

use App\Abstracts\Job;
use App\Models\Auth\User;
use Artisan;

trait UserCreation {

   /**
     * Execute the job.
     *
     * @return Permission
     */
    public function handle()
    {
        \DB::transaction(function () {
            $this->user = User::create($this->request->input());

            // Upload picture
            if ($this->request->file('picture')) {
                $media = $this->getMedia($this->request->file('picture'), 'users');

                $this->user->attachMedia($media, 'picture');
            }

            if ($this->request->has('dashboards')) {
                $this->user->dashboards()->attach($this->request->get('dashboards'));
            }

            if ($this->request->has('permissions')) {
                $this->user->permissions()->attach($this->request->get('permissions'));
            }

            if ($this->request->has('roles')) {
                $this->user->roles()->attach($this->request->get('roles'));
            }

            if ($this->request->has('companies')) {
                $this->user->companies()->attach($this->request->get('companies'));
            }else
            {
                
            }

            if (empty($this->user->companies)) {
                return;
            }

            foreach ($this->user->companies as $company) {
                Artisan::call('user:seed', [
                    'user' => $this->user->id,
                    'company' => $company->id,
                ]);
            }
        });

        return $this->user;
    }


}
