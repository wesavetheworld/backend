<?php
/**
 *  Copyright (C) 2015  Thomas Schulte <thomas@cupracer.de>
 *  
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *  
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

ini_set('include_path', ".:/usr/share/php5:/usr/share/php5/PEAR:/opt/thumbsniper");

define('DIRECTORY_ROOT', dirname(__DIR__));

require_once(DIRECTORY_ROOT . '/config/backend-config.inc.php');

use ThumbSniper\common\Settings;
use ThumbSniper\api\ApiV3;
use ThumbSniper\shared\Target;
use ThumbSniper\shared\Image;



class TestDns extends ApiV3
{
    public function mainLoop()
    {
//        $dnsRecords2 = null;
//
//        $r = new Net_DNS2_Resolver(array(
//            'nameservers' => array('8.8.8.8')
//        ));
//        $dnsRecords2 = $r->query('google.de', 'A');
//
//        //print_r($dnsRecords2);
//
//        echo $dnsRecords2->answer[0];
        
        $targetModel = $this->getTargetModel();
        echo "HOER:" . $targetModel->isBlacklistedIpAddress('gosdfogle.dasde', 'IPv4');
    }
}


$main = new TestDns(true);
$main->mainLoop();
