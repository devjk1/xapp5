<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $appointments = \App\Models\Appointment::factory(30)->create();

        $complaints = [
            'shortness of breath',
            'feeling feverish',
            'sweats and/or chills',
            'nausea and/or vomiting',
            'back pain',
            'headaches',
            'stiff or painful neck',
            'muscle aches or pains',
            'join pain or swelling',
            'muscle weakness',
            'feeling fatigued or having low energy',
            'feeling worse after normal physical exertion',
            'trouble falling or staying asleep',
            'needing more sleep than usual',
            'not feeling rested on awakening',
            'numbness or tingling',
            'shooting, stabbing, or burning pain',
            'skin or muscle twitching',
            'discomfort with normal light or sound',
            'balance problems or sense of room-spinning',
            'change in visual clarity or trouble focusing',
            'bladder discomfort or change in urination',
            'light-headed or uncomfortable on standing',
            'hot or cold sensations in extremities',
            'irregular or rapid heart beats',
            'feeling irritable, sad, or decreased pleasure',
            'feeling panicky, anxious, or worried',
            'trouble finding words or retrieving names',
            'trouble with memory',
            'slower speed of thinking',
        ];

        foreach ($complaints as $complaint) {
            \App\Models\Complaint::factory()->create([
                'name' => $complaint,
            ]);
        }
    }
}
