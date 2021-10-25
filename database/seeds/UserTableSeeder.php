<?php
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= new User();
        $user->name = 'pasquale';
        $user->email = 'pasquale.raso@hotmail.it';
        $user->password = bcrypt('12345678');
        $user->save();



    }
}
