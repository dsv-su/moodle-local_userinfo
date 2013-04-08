<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Web service local plugin template external functions and service definitions.
 *
 * @package    userinfo
 * @copyright  2013 Erik Lundberg
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// We defined the web service functions to install.
$functions = array(
        'local_userinfo_get_userinfo_by_idnumber' => array(
                'classname'   => 'local_userinfo_external',
                'methodname'  => 'get_userinfo_by_idnumber',
                'classpath'   => 'local/userinfo/externallib.php',
                'description' => 'Returns info about the user specified by the idnumber',
                'type'        => 'read'
        ),
        'local_userinfo_get_enrolments_by_idnumber' => array(
                'classname'   => 'local_userinfo_external',
                'methodname'  => 'get_enrolments_by_idnumber',
                'classpath'   => 'local/userinfo/externallib.php',
                'description' => 'Returns enrolled courses for a user identified by the idnumber',
                'type'        => 'read'
        )
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
        'User information' => array(
                'functions' => array(
                        'local_userinfo_get_userinfo_by_idnumber',
                        'local_userinfo_get_enrolments_by_idnumber'
                ),
                'restrictedusers' => 0,
                'enabled'=>1,
        )
);
