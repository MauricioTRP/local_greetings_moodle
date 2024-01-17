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
 * Callback implementations for Greetings
 *
 * @package    local_greetings
 * @copyright  2024 Mauricio Fuentes <mauriciofb@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Local Greetings localization
 *
 * @param std::Class $user
 * @return string
 */
function local_greetings_get_greeting( $user ) {
    if ($user == null) {
        return get_string('greetinguser', 'local_greetings');
    }

    $language = $user->lang;
    switch ($language) {
        case 'es':
            $langstr = 'greetinguseres';
            break;
        case 'nz':
            $langstr = 'greetingusernz';
            break;
        case 'fj':
            $langstr = 'greetinguserfj';
            break;
        default:
            $langstr = 'greetingloggedinuser';
            break;
    }

    return get_string($langstr, 'local_greetings', fullname($user));
}

/**
 * Type your name localization
 *
 * @param std::Class $user
 * @return string
 */
function local_greetings_type_your_name($user) {
    if ($user == null) {
        return get_string('typeyourname', 'local_greetings');
    }

    $language = $user->lang;
    switch ($language) {
        case 'es':
            $langstr = 'typeyournamees';
            break;
        default:
            $langstr = 'typeyourname';
            break;
    }

    return get_string($langstr, 'local_greetings');
}
