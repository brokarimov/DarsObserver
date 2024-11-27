<?php

namespace App\Observers;

use App\Jobs\SendEmailJob;
use App\Models\Student;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        $data['string'] = 'Student yaratildi!' . "\n" .
            'Ismi: ' . $student->name . "\n" .
            'Tel: ' . $student->tel . "\n" .
            'Adress: ' . $student->adress;
        $data['color'] = 'green';
        SendEmailJob::dispatch($data);
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        $data['string'] = 'Student yangilandi!' . "\n" .
            'Ismi: ' . $student->name . "\n" .
            'Tel: ' . $student->tel . "\n" .
            'Adress: ' . $student->adress;
        $data['color'] = 'blue';
        SendEmailJob::dispatch($data);
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        $data['string'] = 'Student o\'chirildi!' . "\n" .
            'Ismi: ' . $student->name . "\n" .
            'Tel: ' . $student->tel . "\n" .
            'Adress: ' . $student->adress;
        $data['color'] = 'red';

        SendEmailJob::dispatch($data);
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
