<?php

/*
 * Copyright (C) 2015  Thomas Schulte <thomas@cupracer.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace ThumbSniper\objective;


class UserAgent
{
    private $id;
    private $description;
    private $tsAdded;
    private $tsLastSeen;
    private $tsLastUpdated;
    private $blacklisted;
    private $numRequests;



    function __construct()
    {
    } // function



    static function cmp_id($a, $b)
    {
        /**
         * @var UserAgent $a
         * @var UserAgent $b
         */

        if ($a->id == $b->id)
        {
            return 0;
        }
        return ($a->id < $b->id) ? -1 : 1;
    }



    static function cmp_description($a, $b)
    {
        /**
         * @var UserAgent $a
         * @var UserAgent $b
         */

        $al = strtolower($a->description);
        $bl = strtolower($b->description);

        if ($al == $bl) {
            return 0;
        }
        return ($al > $bl) ? +1 : -1;
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function isBlacklisted()
    {
        return $this->blacklisted;
    }


    public function setBlacklisted($blacklisted)
    {
        $this->blacklisted = $blacklisted;
    }


    public function getTsAdded()
    {
        return $this->tsAdded;
    }


    public function setTsAdded($tsAdded)
    {
        $this->tsAdded = $tsAdded;
    }


    public function getTsLastUpdated()
    {
        return $this->tsLastUpdated;
    }


    public function setTsLastUpdated($tsLastUpdated)
    {
        $this->tsLastUpdated = $tsLastUpdated;
    }


    /**
     * @return mixed
     */
    public function getTsLastSeen()
    {
        return $this->tsLastSeen;
    }

    /**
     * @param mixed $tsLastSeen
     */
    public function setTsLastSeen($tsLastSeen)
    {
        $this->tsLastSeen = $tsLastSeen;
    }

    /**
     * @return mixed
     */
    public function getNumRequests()
    {
        return $this->numRequests;
    }

    /**
     * @param mixed $numRequests
     */
    public function setNumRequests($numRequests)
    {
        $this->numRequests = $numRequests;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
