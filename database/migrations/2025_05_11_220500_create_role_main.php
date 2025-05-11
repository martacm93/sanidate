<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'doctor']);
        $role3 = Role::create(['name' => 'patient']);

        $admin = User::find(1);

        $admin->assignRole($role1);

        $doctors=Doctor::all();

        foreach ($doctors as $doctor) {
            $doctor->user->assignRole($role2);
        }

        $patients=Patient::all();
        
        foreach ($patients as $patient) {
            $patient->user->assignRole($role3);
        }



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
