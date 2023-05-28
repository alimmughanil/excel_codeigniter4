<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExcelMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
            ],
            'barcode' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
            ],
            'amount' => [
                'type'       => 'INTEGER',
                'constraint' => '50',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('excel');
    }

    public function down()
    {
        $this->forge->dropTable('excel');
    }
}