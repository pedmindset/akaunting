<?php

namespace App\Jobs\Common;

use App\Abstracts\Job;
use App\Models\Auth\User;
use App\Models\Common\Dashboard;
use App\Models\Common\Widget;
use App\Utilities\Widgets;

class CreateDashboard extends Job
{
    protected $dashboard;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request)
    {
        $this->request = $this->getRequestInstance($request);
    }

    /**
     * Execute the job.
     *
     * @return Item
     */
    public function handle()
    {
        $this->request['enabled'] = $this->request['enabled'] ?? 1;

        \DB::transaction(function () {


            if ($this->request->has('users')) {
                $user = $this->request->get('users');
                $user = User::find($user);
            } else {
                $user = user();
            }

            if (empty($user)) {
                return;
            }

            $dashboards = $user->dashboard()->count();
            if($dashboards > 1){
                return;
            }
            $this->dashboard = Dashboard::create($this->request->only(['company_id', 'name', 'enabled']));

            $this->attachToUser();

            if ($this->request->has('with_widgets')) {
                $this->createWidgets();
            }
        });

        return $this->dashboard;
    }

    protected function attachToUser()
    {
        if ($this->request->has('users')) {
            $user = $this->request->get('users');
        } else {
            $user = user();
        }

        if (empty($user)) {
            return;
        }

        $this->dashboard->users()->attach($user);
    }

    protected function createWidgets()
    {
        $widgets = Widgets::getClasses(false);

        $sort = 1;

        foreach ($widgets as $class => $name) {
            Widget::create([
                'company_id' => $this->dashboard->company_id,
                'dashboard_id' => $this->dashboard->id,
                'class' => $class,
                'name' => $name,
                'sort' => $sort,
                'settings' => (new $class())->getDefaultSettings(),
            ]);

            $sort++;
        }
    }
}
