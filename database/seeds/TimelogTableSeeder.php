<?php
 
use Illuminate\Database\Seeder;

class TimelogTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('timelog')->delete();

        DB::table('timelog')->insert(array(
            array(
                'employeeid' => '37AC2D1C675011E5A0C600FF59FBB323',
                'rfid' => '0002352398',
                'datetime' => '2015-11-13 08:10:46',
                'txncode' => 1,
                'entrytype' => 1,
                'terminalid' => 'gi-main',
                'createdate' => '2015-11-12 14:34:47',
                'id'=> '69427592A5E111E385D3C0188508F93C'
            ),
            array(
                'employeeid' => '37AC2D1C675011E5A0C600FF59FBB323',
                'rfid' => '0002352398',
                'datetime' => '2015-11-13 08:10:33',
                'txncode' => 1,
                'entrytype' => 1,
                'terminalid' => 'gi-main',
                'createdate' => '2015-11-12 14:34:48',
                'id'=> '56BCC0BCA66A11E3826AC0188508F93C'
            ),
            array(
                'employeeid' => '37AC2D1C675011E5A0C600FF59FBB323',
                'rfid' => '0002352398',
                'datetime' => '2015-11-13 12:00:54',
                'txncode' => 2,
                'entrytype' => 1,
                'terminalid' => 'gi-main',
                'createdate' => '2015-11-12 14:34:49',
                'id'=> 'E647C96AA66A11E3826AC0188508F93C'
            ),
            array(
                'employeeid' => '37AC2D1C675011E5A0C600FF59FBB323',
                'rfid' => '0002352398',
                'datetime' => '2015-11-13 13:00:56',
                'txncode' => 3,
                'entrytype' => 1,
                'terminalid' => 'gi-main',
                'createdate' => '2015-11-12 14:34:50',
                'id'=> '5ECB4E69A66C11E3826AC0188508F93C'
            ),
            array(
                'employeeid' => '37AC2D1C675011E5A0C600FF59FBB323',
                'rfid' => '0002352398',
                'datetime' => '2015-11-14 02:00:00',
                'txncode' => 4,
                'entrytype' => 1,
                'terminalid' => 'gi-main',
                'createdate' => '2015-11-12 14:34:51',
                'id'=> '153471A2A66B11E3826AC0188508F93C'
            ))
        );
       
    }
}