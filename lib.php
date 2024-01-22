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
 * Localization of pluginname
 *
 * @param [type] $user
 * @return string
 */
function local_greetings_pluginname($user) {
    if ($user == null) {
        return get_string('pluginname', 'local_greetings');
    }

    $language = $user->lang;
    switch ($language) {
        case 'es':
            $langstr = 'pluginnamees';
            break;
        case 'nz':
            $langstr = 'pluginnamenz';
            break;
        case 'fj':
            $langstr = 'pluginnamefj';
            break;
        default :
            $langstr = 'pluginname';
            break;
    }

    return get_string($langstr, 'local_greetings');
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

/**
 * Insert a link to index.php on the site front page navigation menu.
 *
 * @param navigation_node $frontpage Node representing the front page in the navigation tree
 * @param std::class $user
 * @return void
 */
function local_greetings_extend_navigation_frontpage(navigation_node $frontpage, $user) {
    $frontpage->add(
        local_greetings_pluginname($user),
        new moodle_url('/local/greetings/index.php')
    );
}

/**
 * Inserts a link to index.php on the menu
 *
 * @param global_navigation $root
 * @return void
 */
function local_greetings_extend_navigation(global_navigation $root) {
    $node = navigation_node::create(
        get_string('pluginname', 'local_greetings'),
        new moodle_url('/local/greetings/index.php'),
        navigation_node::TYPE_CUSTOM,
        null,
        null,
        new pix_icon('t/message', 'message')
    );

    $root->add_node($node);
}
