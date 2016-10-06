<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'=>'Google',
                'description'=>'最好的搜索引擎',
                'url' => 'https://www.google.com/ncr',
                'order' => 1,
            ],
            [
                'name'=>'Facebook',
                'description'=>'黑客的公司',
                'url' => 'https://www.facebook.com',
                'order' => 2,
            ],
            [
                'name'=>'Cuteshell',
                'description'=>'我的个人博客',
                'url' => 'https://blog.cuteshell.com',
                'order' => 3,
            ],
        ];
        DB::table('links')->insert($data);
    }
}
