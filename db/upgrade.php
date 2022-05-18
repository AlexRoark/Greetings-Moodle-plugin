<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>;.

/**
 * @package     local_greetings
 * @copyright   2022 Alex Roark <your@email>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

function xmldb_local_greetings_upgrade($oldversion)
{
    global $DB;
    $dbman = $DB->get_manager();

            if ($oldversion < 2022051404) {

                // Define field userid to be added to local_greetings_messages.
                $table = new xmldb_table('local_greetings_messages');
                $field = new xmldb_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '1', 'timecreated');

                // Conditionally launch add field userid.
                if (!$dbman->field_exists($table, $field)) {
                    $dbman->add_field($table, $field);
                }

                // Greetings savepoint reached.
                upgrade_plugin_savepoint(true, 2022051404, 'local', 'greetings');
            }


    return true;
}