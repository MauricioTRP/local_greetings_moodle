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

// Custom greeting message if loggedin
// e.g. "Hola, {name} Usuario.
if (isloggedin()) {
    echo local_greetings_get_greeting($USER);
} else {
    echo get_string('greetinguser', 'local_greetings');
}

echo '<br />';

$messageform = new \local_greetings\form\message_form();

$messageform->display();

// Message display.
$messages = $DB->get_records('local_greetings_messages');

echo $OUTPUT->box_start('card-columns');

foreach ($messages as $m) {
    echo html_writer::start_tag('div', array('class' => 'card-body'));
    echo html_writer::start_tag('div', array('class' => 'card'));
    echo html_writer::tag('p', $m->message, array('class' => 'card-text'));
    echo html_writer::start_tag('p', array('class' => 'card-text'));
    echo html_writer::tag('small', userdate($m->createdtime), array('class' => 'text-muted'));
    echo html_writer::end_tag('p');
    echo html_writer::end_tag('div');
    echo html_writer::end_tag('div');
}

echo $OUTPUT->box_end();


// Form retrive info and saving into DB.
if ($data = $messageform->get_data()) {
    $message = required_param('message', PARAM_TEXT);

    if (!empty($message)) {
        $record = new stdClass;
        $record->message = $message;
        $record->createdtime = time();

        $DB->insert_record('local_greetings_messages', $record);
    }
}

echo $OUTPUT->footer();
