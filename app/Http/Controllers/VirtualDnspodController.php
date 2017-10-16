<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Domain;
use App\Models\Record;

class VirtualDnspodController extends Controller
{
    Const RECORD_CREATE_URL = "https://dnsapi.cn/Record.Create";
    Const RECORD_LIST_URL = "https://dnsapi.cn/Record.List";
    Const RECORD_MODIFY_URL = "https://dnsapi.cn/Record.Modify";
    Const RECORD_DELETE_URL = "https://dnsapi.cn/Record.Remove";
    //
    public function addRecord(Request $request)
    {
        $clientIp = $request->getClientIp();
        Log::info("clientIp:" . $clientIp . ", operation:addRecord.");

        $input = $request->all();

        $loginToken = isset($input['login_token']) == true ? $input['login_token'] : '';
        $format = isset($input['format']) == true ? $input['format'] : '';
        $domain = isset($input['domain']) == true ? $input['domain'] : '';
        $domain_id = isset($input['domain_id']) == true ? $input['domain_id'] : '';

        $record = new Record();

        $record->name  = isset($input['sub_domain']) == true ? $input['sub_domain'] : '@';
        $record->type = isset($input['record_type']) == true ? $input['record_type'] : '';
        $record->line = isset($input['record_line']) == true ? $input['record_line'] : '';
        $record->line_id = 0;
        $record->value = isset($input['value']) == true ? $input['value'] : '';
        $record->mx = isset($input['mx']) == true ? $input['mx'] : '0';
        $record->ttl = isset($input['ttl']) == true ? $input['ttl'] : '600';
        $record->status = isset($input['status']) == true ? $input['status'] : 'enabled';
        $record->enabled = 1;
        $record->weight = isset($input['weight']) == true ? $input['weight'] : 0;

        $record->save();        

        return '{"status":{"code":"1","message":"Action completed successful","created_at":"'
            . date("Y-m-d H:i:s", time())
            . '"},"record": {"id":"' . $record->id  . '","name":"'
            . $record->name . '","status":"enable"}}';
    }

    public function delRecord(Request $request)
    {
        $clientIp = $request->getClientIp();
        Log::info("clientIp:" . $clientIp . ", operation:delRecord");

        $input = $request->all();
        $recordId = $input['record_id'];
       
        $record = Record::find($recordId);
        $record->delete();   
       
        return '{"status":{"code":"1","message":"Action completed successful","created_at":"'
            . date("Y-m-d H:i:s", time())
            . '"}}';
    }

    public function modifyRecord(Request $request)
    {
        $clientIp = $request->getClientIp();
        Log::info("clientIp:" . $clientIp . ", operation:modifyRecord");

        $input = $request->all();        

        $loginToken = isset($input['login_token']) == true ? $input['login_token'] : '';
        $format = isset($input['format']) == true ? $input['format'] : '';
        $domain = isset($input['domain']) == true ? $input['domain'] : '';
        $domain_id = isset($input['domain_id']) == true ? $input['domain_id'] : '';
        $recordId =$input['record_id'];        

        $record = Record::find($recordId);

        $record->name  = isset($input['sub_domain']) == true ? $input['sub_domain'] : '@';
        $record->type = isset($input['record_type']) == true ? $input['record_type'] : $record->type;
        $record->line = isset($input['record_line']) == true ? $input['record_line'] : $record->line;
        $record->line_id = isset($input['line_id']) == true ? $input['line_id'] : $record->line_id;
        $record->value = isset($input['value']) == true ? $input['value'] : '';
        $record->mx = isset($input['mx']) == true ? $input['mx'] : '0';
        $record->ttl = isset($input['ttl']) == true ? $input['ttl'] : $record->ttl;
        $record->status = isset($input['status']) == true ? $input['status'] : 'enabled';
        $record->enabled = 1;
        $record->weight = isset($input['weight']) == true ? $input['weight'] : 0;

        $record->save(); 

        $result = [
            "status" => [
                "code"       => "1",
                "message"    => "Action completed successful",
                "created_at" => date("Y-m-d H:i:s", time()),
            ],
            "record" => [
                "id" => $record->id,
                "name" => $record->name,
                "value" => $record->value,
                "status" => $record->status
            ]
        ];
        return json_encode($result);
    }

    public function listRecord(Request $request)
    {
        $clientIp = $request->getClientIp();
        Log::info("clientIp:" . $clientIp . ", operation:listRecord");

        $input = $request->all();
        $loginToken = isset($input['login_token']) == true ? $input['login_token'] : '';
        $format = isset($input['format']) == true ? $input['format'] : '';
        $domain = isset($input['domain']) == true ? $input['domain'] : '';
        $domain_id = isset($input['domain_id']) == true ? $input['domain_id'] : '';
        $sub_domain = isset($input['sub_domain']) == true ? $input['sub_domain'] : '';
       
            
        if ($sub_domain == '') {
            $records = Record::all()->toArray();
        } else {
            $records = Record::where("name", $sub_domain)
                ->get();
        } 
        //$records = Record::all()->toArray();
        $list = [
            'status'  => [
                'code' => '1',
                'message' => 'Action completed successful',
                'created_at' => date("Y-m-d H:i:s", time())
            ],
            'domain'  => true,
            'info'    => [
                'sub_domains' => true,
                'record_total' => count($records)
            ],
            'records' => $records,
        ];

        return json_encode($list); 

        //return '{"status":{"code":"10","message":"No records","created_at":"2017-09-18 15:45:52"}}';
        #return '{"status":{"code":"1","message":"Action completed successful","created_at":"2017-09-19 16:10:16"},"domain":{"id":"60768206","name":"issaccherry.com","punycode":"issaccherry.com","grade":"DP_Free","owner":"372621191@qq.com","ext_status":"","ttl":600,"min_ttl":600,"dnspod_ns":["f1g1ns1.dnspod.net","f1g1ns2.dnspod.net"],"status":"enable"},"info":{"sub_domains":"60","record_total":"5"},"records":[{"id":"317222956","ttl":"30","value":"106.120.176.24","enabled":"1","status":"enabled","updated_on":"2017-09-05 10:52:23","name":"v5","line":"\u9ed8\u8ba4","line_id":"3=0","type":"A","weight":null,"monitor_status":"","remark":"","use_aqb":"no","mx":"0"},{"id":"315616301","ttl":"600","value":"106.120.176.25.","enabled":"1","status":"enabled","updated_on":"2017-08-25 10:53:06","name":"v5","line":"\u9ed8\u8ba4","line_id":"0","type":"A","weight":null,"monitor_status":"","remark":"","use_aqb":"no","mx":"0"},{"id":"315616484","ttl":"30","value":"106.120.176.26","enabled":"1","status":"enabled","updated_on":"2017-08-25 10:54:23","name":"v5","line":"\u9ed8\u8ba4","line_id":"10=0","type":"A","weight":10,"monitor_status":"","remark":"","use_aqb":"no","mx":"0"},{"id":"317222868","ttl":"30","value":"106.120.176.19","enabled":"1","status":"enabled","updated_on":"2017-09-05 10:51:26","name":"v5","line":"\u79FB\u52A8","line_id":"10=1","type":"A","weight":null,"monitor_status":"","remark":"","use_aqb":"no","mx":"0"},{"id":"316595287","ttl":"30","value":"106.120.176.111","enabled":"1","status":"enabled","updated_on":"2017-08-31 17:12:40","name":"v5","line":"\u7535\u4fe1","line_id":"90=1","type":"A","weight":null,"monitor_status":"","remark":"","use_aqb":"no","mx":"0"}]}';
        
    }

    public function getUserDetail(Request $request)
    {
        $clientIp = $request->getClientIp();
        Log::info("clientIp:" . $clientIp . ", operation:getUserDetail");

        $input = $request->all();
        $loginToken = isset($input['login_token']) == true ? $input['login_token'] : '';
        $format = isset($input['format']) == true ? $input['format'] : '';
        $domain = isset($input['domain']) == true ? $input['domain'] : '';
        $domain_id = isset($input['domain_id']) == true ? $input['domain_id'] : '';
        $sub_domain = isset($input['sub_domain']) == true ? $input['sub_domain'] : ''; 

        $records = Record::all()->toArray();
        $list = [
            'status'  => [
                'code' => '1',
                'message' => 'Action completed successful',
                'created_at' => date("Y-m-d H:i:s", time())
            ],
            'domain'  => 'null',
            'info'    => [
                'sub_domains' => '0',
                'record_total' => count($records)
            ],
            'records' => $records,
        ];
        echo json_encode($list) . "\n";
        echo $loginToken . "\n";
        return '{"virtual":"UserDetail"}';
    }
}
