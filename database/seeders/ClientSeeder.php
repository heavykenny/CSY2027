<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create default admin user
        Client::create([
            "name" => "Sample Super-Admin",
            "email" => "superadmin@eshopsales.co.uk",
            "password" => bcrypt("superadmin12345"),
            "role_id" => 1,
        ]);

        // create default client
        Client::create([
            "name" => "Sample Client",
            "email" => "client@eshopsales.co.uk",
            "password" => bcrypt("client12345"),
            "role_id" => 2,
            "vendor_id" => 1,
        ]);
    }
}
