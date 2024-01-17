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
 * TODO describe file index
 *
 * @package    local_greetings
 * @copyright  2024 Mauricio Fuentes <mauriciofb@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require_once($CFG->dirroot.'/local/greetings/lib.php');

require_login();

$url = new moodle_url('/local/greetings/index.php', []);
$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('pluginname', 'local_greetings'));

echo $OUTPUT->header();

// Custom greeting message if loggedin.
if (isloggedin()) {
    echo local_greetings_get_greeting($USER);
} else {
    echo get_string('greetinguser', 'local_greetings');
}

echo '<br />';

echo html_writer::tag('input', '', [
  'type' => 'text',
  'name' => 'username',
  'placeholder' => local_greetings_type_your_name($USER),
]);

echo html_writer::tag('h4', get_string('thecurrenttimeis', 'local_greetings'));
echo userdate(time(), get_string('strftimedaydate', 'core_langconfig'));

echo $OUTPUT->footer();
