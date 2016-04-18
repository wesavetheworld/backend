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



class DeleteObsoleteTargets extends ApiV3
{
    public function mainLoop()
    {
        $targetModel = $this->getTargetModel();
        $imageModel = $this->getImageModel();

        try {
            $collection = new MongoCollection($this->getMongoDB(), Settings::getMongoCollectionTargets());
            $td = new DateTime();
            $td->modify('-7 months');

            $query = array(
                Settings::getMongoKeyTargetAttrTsLastRequested() => array(
                    '$lt' => new MongoTimestamp($td->getTimestamp())
                )
            );

            $fields = array(
                Settings::getMongoKeyTargetAttrId() => true
            );

            $cursor = $collection->find($query, $fields);
            $stopLoop = false;

            foreach ($cursor as $doc) {
                $t = $targetModel->getById($doc[Settings::getMongoKeyTargetAttrId()]);

                if ($t instanceof Target) {
                    echo "target " . $t->getId() . "\n";
                    $images = $imageModel->getImages($t->getId());

                    if(!empty($images)) {
                        $tnExists = false;

                        /** @var Image $image */
                        foreach($images as $image)
                        {
                            if($image->getTsLastUpdated()) {
                                $tnExists = true;
                                print_r($image);
                                $stopLoop = true;

//                                if($imageModel->deleteImageFile($t, $image))
//                                {
//                                    $imageModel->delete($t, $image);
//                                }
                                break;
                            }
                        }

//                        if($tnExists) {
//                            print_r($t);
//                            print_r($images);
//                        }
                    }
                    echo "\n=======================\n";
                }

                if($stopLoop) {
                    break;
                }
            }

        } catch (Exception $e) {
            echo "exception while searching for targets: " . $e->getMessage() . "\n";
            return false;
        }

        return true;
    }

}


$main = new DeleteObsoleteTargets(true);
$main->mainLoop();
