<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use App\Models\Record;

class VirtualApiTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testAddRecord()
    {
        $response = $this->json('POST', '/Record.Create', [
            'sub_domain' => 'www',
            'record_type' => 'A',
            'record_line' => '广东电信',
            'value' => '1.1.1.1',
            'ttl' => 30,
            'weight' => 10,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => [
                    'code' => true,
                    'message' => true,
                    'created_at' => true,
                ],
                'record' => [
                    'id' => true,
                    'name' => 'www',
                    'status' => true,
                ]
                
            ]);
    }

    public function testDelRecord()
    { 
        $recordId = $this->createRecord();
                
        $response = $this->json('POST', '/Record.Remove', [
            'record_id' => $recordId
        ]);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => [
                    'code' => true,
                    'message' => true,
                    'created_at' => true
                ]
            ]);
    }

    public function testModifyRecord()
    {
        $recordId = $this->createRecord();

        $response = $this->json('POST', '/Record.Modify', [
            'record_id' => $recordId,
            'sub_domain' => 'www',
            'record_line' => '广西电信',
            'record_type' => 'CNAME',
            'value' => 'baidu.com',
            'ttl' => 666,
            'weight' => 100
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => [
                    'code' => true,
                    'message' => true,
                    'created_at' => true,
                ],
                'record' => [
                    'id' => $recordId,
                    'name' => 'www',
                    'value' => 'baidu.com',
                    'status' => true
                ]
            ]);
        
    }

    public function testListRecord()
    {
        //delete all
        DB::table('records')->delete();

        $sub_domain = 'aa1';
        $recordId = $this->createRecord($sub_domain);
        $record = Record::find($recordId);

        $response = $this->json('POST', '/Record.List', [
            'sub_domain' => $sub_domain
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => [
                    'code' => true,
                    'message' => true,
                    'created_at' => true,
                ],
                'domain' => true,
                'info' => [
                    'sub_domains' => true,
                    'record_total' => 1, 
                ],
                'records' => [
                    0 => [
                        'id' => $record->id,
                        'name' => $record->name,
                        'line' => $record->line,
                        'line_id' => $record->line_id,
                        'type' => $record->type,
                        'ttl' => $record->ttl,
                        'value' => $record->value,
                        'weight' => $record->weight,
                        'mx' => $record->mx,
                        'enabled' => $record->enabled,
                        'status' => $record->status,
                        'monitor_status' => $record->monitor_status,
                        'remark' => $record->remark,
                        'use_aqb' => $record->use_aqb,
                        'updated_at' => $record->updated_at,
                    ],
                ]
            ]);
    }

    public function createRecord($sub_domain='v1')
    {
        $record = new Record();
        $record->name = $sub_domain;
        $record->line = '广东联通';
        $record->type = 'A';
        $record->ttl = '10';
        $record->value = '2.2.2.2';
        $record->weight = 2;
        $record->save();

        return $record->id;
    }
}
