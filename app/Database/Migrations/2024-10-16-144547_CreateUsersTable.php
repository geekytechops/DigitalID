<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
                'null'       => false
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
                'null'       => false
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'unique'     => true,
                'null'       => true
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['male', 'female', 'other'],
                'null'       => true
            ],
            'date_of_birth' => [
                'type' => 'DATE',
                'null' => true
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'user', 'superadmin'],
                'null'       => false
            ],
            'profile_picture' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true
            ],
            'state' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true
            ],
            'city' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true
            ],
            'zip_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'banned', 'deleted'],
                'default'    => 'active',
                'null'       => false
            ],
            'email_verified_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'phone_verified_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'last_login_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' =>new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Define primary key
        $this->forge->addKey('id', true);

        // Add unique index for email and phone number
        $this->forge->addUniqueKey(['email', 'phone_number']);

        // Create the users table
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        // Drop the users table if it exists
        $this->forge->dropTable('users', true);
    }
}
