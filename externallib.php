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
 * External User Info
 *
 * @package    userinfo
 * @copyright  2013 Erik Lundberg
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . "/enrol/externallib.php");

class local_userinfo_external extends external_api {
    public static function get_userinfo_by_idnumber_parameters() {
        return new external_function_parameters(
            array('idnumber' => new external_value(PARAM_INT, 'The idnumber'))
        );
    }

    public static function get_enrolments_by_idnumber_parameters() {
            return new external_function_parameters(
                    array('idnumber' => new external_value(PARAM_INT, 'The idnumber'))
            );
    }

    public static function get_userinfo_by_idnumber_returns() {
        return new external_multiple_structure(
            new external_single_structure(
              array(
                'id'          => new external_value(PARAM_INT,  'The ID local for the Moodle instance.'),
                'auth'        => new external_value(PARAM_TEXT, 'The authorization method for the user.'),
                'deleted'     => new external_value(PARAM_BOOL, 'Is this a deleted account?'),
                'suspended'   => new external_value(PARAM_BOOL, 'Is this a suspended account?'),
                'username'    => new external_value(PARAM_TEXT, 'The username of the account.'),
                'firstaccess' => new external_value(PARAM_INT,  'The first time this user accessed Moodle'),
                'lastaccess'  => new external_value(PARAM_INT,  'The last time this user accessed Moodle')
              )
            )
        );
    }

    public static function get_enrolments_by_idnumber_returns() {
        return core_enrol_external::get_users_courses_returns();
    }

    public static function get_enrolments_by_idnumber($idnumber = 0) {
        $matchingusers = self::get_userinfo_by_idnumber($idnumber);
        $result        = array();
        foreach ($matchingusers as $user) {
                $result = moodle_enrol_external::get_users_courses($user['id']);
        }
        return $result;
    }

    public static function get_userinfo_by_idnumber($idnumber = 0) {
        global $DB;
        $results = array();
        foreach ($DB->get_records('user', array('idnumber' => $idnumber)) as $user) {
                $results[] = (array)$user;
        }
        return $results;
    }
}
