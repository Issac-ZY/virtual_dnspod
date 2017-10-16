<?php

use Illuminate\Database\Seeder;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('records')->insert([
            [
                "id"             => "317222956",
                "ttl"            => "30",
                "value"          => "106.120.176.24",
                "enabled"        => "1",
                "status"         => "enabled",
                "name"           => "v5",
                "line"           => "默认",
                "line_id"        => "0",
                "type"           => "A",
                "weight"         => null,
                "monitor_status" => "",
                "remark"         => "",
                "use_aqb"        => "no",
                "mx"             => "0",
                "created_at"      => date("Y-m-d H:i:s", time()),
                "updated_at"      => date("Y-m-d H:i:s", time()),
            ],
            [
                "id"             => "315616301",
                "ttl"            => "600",
                "value"          => "106.120.176.25",
                "enabled"        => "1",
                "status"         => "enabled",
                "name"           => "v5",
                "line"           => "默认",
                "line_id"        => "0",
                "type"           => "A",
                "weight"         => null,
                "monitor_status" => "",
                "remark"         => "",
                "use_aqb"        => "no",
                "mx"             => "0",
                "created_at"      => date("Y-m-d H:i:s", time()),
                "updated_at"      => date("Y-m-d H:i:s", time()),
            ],
            [
                "id"             => "315616484",
                "ttl"            => "30",
                "value"          => "106.120.176.26",
                "enabled"        => "1",
                "status"         => "enabled",
                "name"           => "v5",
                "line"           => "默认",
                "line_id"        => "0",
                "type"           => "A",
                "weight"         => 10,
                "monitor_status" => "",
                "remark"         => "",
                "use_aqb"        => "no",
                "mx"             => "0",
                "created_at"      => date("Y-m-d H:i:s", time()),
                "updated_at"      => date("Y-m-d H:i:s", time()),
            ],
            [
                "id"             => "317222868",
                "ttl"            => "30",
                "value"          => "106.120.176.19",
                "enabled"        => "1",
                "status"         => "enabled",
                "name"           => "v5",
                "line"           => "移动",
                "line_id"        => "10=1",
                "type"           => "A",
                "weight"         => null,
                "monitor_status" => "",
                "remark"         => "",
                "use_aqb"        => "no",
                "mx"             => "0",
                "created_at"      => date("Y-m-d H:i:s", time()),
                "updated_at"      => date("Y-m-d H:i:s", time()),
            ],
            [
                "id"             => "316595287",
                "ttl"            => "30",
                "value"          => "106.120.176.111",
                "enabled"        => "1",
                "status"         => "enabled",
                "name"           => "v5",
                "line"           => "电信",
                "line_id"        => "90=1",
                "type"           => "A",
                "weight"         => null,
                "monitor_status" => "",
                "remark"         => "",
                "use_aqb"        => "no",
                "mx"             => "0",
                "created_at"      => date("Y-m-d H:i:s", time()),
                "updated_at"      => date("Y-m-d H:i:s", time()),
            ],
        ]);
    }
}
