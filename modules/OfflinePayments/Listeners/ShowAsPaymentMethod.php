<?php

namespace Modules\OfflinePayments\Listeners;

use App\Utilities\Modules;
use App\Events\Module\PaymentMethodShowing as Event;

class ShowAsPaymentMethod
{
    /**
     * Handle the event.
     *
     * @param  Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        $methods = json_decode(setting('offline-payments.methods'), true);

        try {
            foreach ($methods as $method) {
                $event->modules->payment_methods[] = $method;
            }
        } catch (\Throwable $th) {

            $payment_method = [
                'code' => 'offline-payments.cash.1',
                'name' => 'Cash',
                'customer' => 1,
                'order' => 1,
                'description' => 'Cash Payments',
            ];

            $methods[] = $payment_method;

            setting()->set('offline-payments.methods', json_encode($methods));

            setting()->save();

            Modules::clearPaymentMethodsCache();
        }

    }
}
