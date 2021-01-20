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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Block to display enrolled, completed, inprogress and undefined courses according to course completion criteria named 'grade' based on login user.
 *
 * @package block_search_course
 * @copyright 3i Logic<lms@3ilogic.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL
 */
require_once ('../../config.php');
require_once ('course_form.php');
require_once ('lib.php');
require_login();
global $DB, $OUTPUT, $PAGE, $CFG, $USER;
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_string('pluginname', 'block_search_course'));
$PAGE->set_heading(get_string('title', 'block_search_course'));
$pageurl = '/blocks/search_course/view.php';
$PAGE->set_url($pageurl);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add(get_string('pluginname', 'block_search_course'));

echo $OUTPUT->header();

$form = new course_search_form();
$search = optional_param('search', null, PARAM_RAW);
$toform['search'] = $search;
$form->set_data($toform);
$form->display();

if ($fromform = $form->get_data()) {
    $searchquery = "Select id from {course} WHERE";
    if ($fromform->search != "")
        $searchquery .= " fullname LIKE '%" . $fromform->search . "%'";
    else {
        $searchquery .= " fullname LIKE '%" . $fromform->search . "%'";
    }
    if ($fromform->description == true)
        $searchquery .= " OR summary LIKE '%" . $fromform->search . "%'";
    if ($fromform->searchfromtime != 0)
        $searchquery .= " AND startdate >= " . $fromform->searchfromtime . "";
    if ($fromform->searchtilltime != 0)
        $searchquery .= " AND enddate  <= " . $fromform->searchtilltime . "";

    $courses = $DB->get_records_sql($searchquery, null);
    echo getCourses($courses);
}

echo $OUTPUT->footer();
