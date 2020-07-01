<?php

namespace App\Traits;

use Artisan;
use App\Abstracts\Job;
use App\Models\Auth\User;
use App\Models\Common\Company;
use Illuminate\Support\Facades\DB;

trait CompanyCreation {

      /**
     * Execute the job.
     *
     * @return Company
     */
    public function handle()
    {
        \DB::transaction(function () {
            $this->company = Company::create($this->request->all());

            session(['company_id' => $this->company->id]);

            // Clear settings
            setting()->setExtraColumns(['company_id' => $this->company->id]);
            setting()->forgetAll();

            $this->callSeeds();

            $this->updateSettings();
        });

        return $this->company;
    }


}
