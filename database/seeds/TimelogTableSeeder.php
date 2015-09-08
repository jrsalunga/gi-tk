<?php
 
use Illuminate\Database\Seeder;

class TimelogTableSeeder extends Seeder  
{
    public function run()
    {

        DB::table('timelog')->delete();

        DB::table('timelog')->insert(array(
            array(
                'employeeid' => '058FD717BEAE11E39AE474D02BCA8A4B',
                'datetime' => '2014-09-01 06:15:31',
                'txncode' => 'ti',
                'entrytype' => 1,
                'terminal' => 'gi-main',
                'id'=> '69427592A5E111E385D3C0188508F93C'
            ),
            array(
                'employeeid' => '058FD717BEAE11E39AE474D02BCA8A4B',
                'datetime' => '2014-09-01 15:01:31',
                'txncode' => 'to',
                'entrytype' => 1,
                'terminal' => 'gi-main',
                'id'=> '56BCC0BCA66A11E3826AC0188508F93C'
            ),
            array(
                'employeeid' => 'BD589EF4B0D411E3A0ECC0188508F93C',
                'datetime' => '2014-09-01 10:14:51',
                'txncode' => 'ti',
                'entrytype' => 1,
                'terminal' => 'gi-main',
                'id'=> 'E647C96AA66A11E3826AC0188508F93C'
            ),
            array(
                'employeeid' => 'BD589EF4B0D411E3A0ECC0188508F93C',
                'datetime' => '2014-09-01 15:25:01',
                'txncode' => 'to',
                'entrytype' => 1,
                'terminal' => 'gi-main',
                'id'=> '5ECB4E69A66C11E3826AC0188508F93C'
            ),
            array(
                'employeeid' => '058FD717BEAE11E39AE474D02BCA8A4B',
                'datetime' => '2014-09-02 07:01:45',
                'txncode' => 'ti',
                'entrytype' => 1,
                'terminal' => 'gi-main',
                'id'=> '153471A2A66B11E3826AC0188508F93C'
            ),
            array(
                'employeeid' => '058FD717BEAE11E39AE474D02BCA8A4B',
                'datetime' => '2014-09-02 15:06:11',
                'txncode' => 'to',
                'entrytype' => 1,
                'terminal' => 'gi-main',
                'id'=> 'E8E97AE7A66B11E3826AC0188508F93C'
            ),
            array(
                'employeeid' => 'BD589EF4B0D411E3A0ECC0188508F93C',
                'datetime' => '2014-09-02 09:46:01',
                'txncode' => 'ti',
                'entrytype' => 1,
                'terminal' => 'gi-main',
                'id'=> 'C2F8F359A66D11E3826AC0188508F93C'
            ),
            array(
                'employeeid' => 'BD589EF4B0D411E3A0ECC0188508F93C',
                'datetime' => '2014-09-02 15:10:31',
                'txncode' => 'to',
                'entrytype' => 1,
                'terminal' => 'gi-main',
                'id'=> '73EC8DDDA75811E38C16C0188508F93C'
            ))
        );
       
    }
}