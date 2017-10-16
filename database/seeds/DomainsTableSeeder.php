<?php

use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('domains')->insert([
            [
                'id'                => 60768206,
                "status"            => "enable",
                "grade"             => "DP_Free",
                "group_id"          => "1",
                "searchengine_push" => "no",
                "is_mark"           => "no",
                "ttl"               => "600",
                "cname_speedup"     => "disable",
                "remark"            => "",
                "created_at"        => date("Y-m-d H:i:s", time()),
                "updated_at"        => date("Y-m-d H:i:s", time()),
                "punycode"          => "issaccherry.com",
                "ext_status"        => "",
                "src_flag"          => "QCLOUD",
                "name"              => "issaccherry.com",
                "grade_title"       => "新免费套餐",
                "is_vip"            => "no",
                "owner"             => "372621191@qq.com",
                "records"           => "61"
            ],
        ]);
    }
}
