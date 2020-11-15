<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $lead = Role::where('name', 'lead')->first();
        $techCore = Role::where('name', 'techcore')->first();
        $nonTechCore = Role::where('name', 'nontechcore')->first();
        $member = Role::where('name', 'member')->first();


        // DB::table('users')->insert([
        //     'name' => 'Admin Admin',
        //     'email' => 'admin@argon.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        $userLead = User::create([
            'name' => 'DSC Lead',
            'email' => 'lead@dsc.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $userLead->attachRole($lead);


        $userTechCore = User::create([
            'name' => 'DSC Tech Core',
            'email' => 'core@dsc.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
          ]);
        $userTechCore->attachRole($techCore);

        $userNonTechCore = User::create([
            'name' => 'DSC Non Tech Core',
            'email' => 'noncore@dsc.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
          ]);
        $userNonTechCore->attachRole($nonTechCore);


        $userMember = User::create([
            'name' => 'DSC Member',
            'email' => 'member@dsc.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
          ]);
        $userMember->attachRole($member);
    }
}
