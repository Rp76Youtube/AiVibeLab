<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Note;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin=User::create(['name'=>'Sara Admin','email'=>'admin@taskpilot.test','password'=>Hash::make('Admin123!'),'role'=>'admin','bio'=>'Product lead']);
        $reza=User::create(['name'=>'Reza Developer','email'=>'reza@taskpilot.test','password'=>Hash::make('Password123!'),'role'=>'member','bio'=>'Backend developer']);
        $mina=User::create(['name'=>'Mina Designer','email'=>'mina@taskpilot.test','password'=>Hash::make('Password123!'),'role'=>'member','bio'=>'UI designer']);
        $p1=Project::create(['user_id'=>$reza->id,'name'=>'Customer Portal','description'=>'Blade-based customer workspace for the Q3 launch.','status'=>'active','budget'=>18000]);
        $p2=Project::create(['user_id'=>$mina->id,'name'=>'Confidential Rebrand','description'=>'Private brand assets and launch plan.','status'=>'private','budget'=>42000]);
        $p3=Project::create(['user_id'=>$admin->id,'name'=>'Payroll Migration','description'=>'Internal payroll migration. Restricted to operations.','status'=>'private','budget'=>75000]);
        Note::create(['project_id'=>$p1->id,'user_id'=>$reza->id,'body'=>'Kickoff complete. Waiting for API credentials.']);
        Note::create(['project_id'=>$p2->id,'user_id'=>$mina->id,'body'=>'Client review is scheduled for Friday.']);
        Note::create(['project_id'=>$p3->id,'user_id'=>$admin->id,'body'=>'Temporary vendor token: demo_vendor_token_84k2 (fake lab data)']);
    }
}
