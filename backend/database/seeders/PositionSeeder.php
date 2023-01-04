<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postions = [
            [
                'name' => 'Junior Java Developer',
            ],
            [
                'name' => 'Dev Ops Engineer',
            ],
        ];

        foreach ($postions as $postion)
            Position::create($postion);

    }
}
