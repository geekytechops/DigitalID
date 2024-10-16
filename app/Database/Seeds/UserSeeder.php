<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Password hashing for security
        $password = password_hash('digital_admin@123', PASSWORD_DEFAULT);

        // Insert Superadmin data
        $data = [
            'username'      => 'digital_admin',
            'email'         => 'digi_admin@gmail.com',
            'password'      => $password,
            'first_name'    => 'Digital',
            'last_name'     => 'Admin',
            'gender'        => 'male',
            'role'          => 'superadmin',
            'status'        => 'active',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Insert into the users table
        $this->db->table('users')->insert($data);
    }
}
