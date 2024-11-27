<?php

namespace App\Observers;

use App\Jobs\SendEmailJob;
use App\Models\Agent;

class AgentObserver
{
    /**
     * Handle the Agent "created" event.
     */
    public function created(Agent $agent): void
    {
        $data['string'] = 'Agent yaratildi!' . "\n" .
            'Ismi: ' . $agent->name . "\n" .
            'Tel: ' . $agent->tel . "\n";
        $data['color'] = 'green';
        SendEmailJob::dispatch($data);
    }

    /**
     * Handle the Agent "updated" event.
     */
    public function updated(Agent $agent): void
    {
        $data['string'] = 'Agent yangilandi!' . "\n" .
            'Ismi: ' . $agent->name . "\n" .
            'Tel: ' . $agent->tel . "\n";
        $data['color'] = 'blue';
        SendEmailJob::dispatch($data);
    }

    /**
     * Handle the Agent "deleted" event.
     */
    public function deleted(Agent $agent): void
    {
        $data['string'] = 'Agent o\'chirildi!' . "\n" .
            'Ismi: ' . $agent->name . "\n" .
            'Tel: ' . $agent->tel . "\n";
        $data['color'] = 'red';
        SendEmailJob::dispatch($data);
    }

    /**
     * Handle the Agent "restored" event.
     */
    public function restored(Agent $agent): void
    {
        //
    }

    /**
     * Handle the Agent "force deleted" event.
     */
    public function forceDeleted(Agent $agent): void
    {
        //
    }
}
