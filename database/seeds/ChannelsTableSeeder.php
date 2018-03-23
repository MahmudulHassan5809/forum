<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $channel1 = ['title'=>'Laravel','slug'=>str_slug('Laravel')];
        $channel2 = ['title'=>'Node.js','slug'=>str_slug('Node.js')];

        $channel3 = ['title'=>'PHP','slug'=>str_slug('PHP')];
        $channel4 = ['title'=>'Python','slug'=>str_slug('Python')];

        \App\Channel::create($channel1);
        \App\Channel::create($channel2);
        \App\Channel::create($channel3);
        \App\Channel::create($channel4);

    }
}
