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
 * Block to display enrolled, completed, inprogress and undefined courses.
 *
 * @package block_search_course
 * @copyright 3i Logic<lms@3ilogic.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL
 */
defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once ("{$CFG->libdir}/formslib.php");
require_once ("lib.php");

/**
 * Display list of courses based on login user.
 *
 * @copyright 3i Logic<lms@3ilogic.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class course_search_form extends moodleform
{
    public function definition()
    {
        global $CFG, $PAGE;

        $mform = $this->_form;

        // textbox
        $mform->addElement('text', 'search', get_string('searchcourses', 'block_search_course'));
        $mform->setType('search', PARAM_TEXT);

        // header, expanded
        $mform->addElement('header', 'filterresults', get_string('filterresults', 'block_search_course'));
        $mform->setExpanded('filterresults', true);

        // start date
        $mform->addElement('date_time_selector', 'coursestartdate', get_string('searchfromtime', 'block_search_course'),
            array('optional' => true));
        $mform->setDefault('coursestartdate', 0);

        // end date
        $mform->addElement('date_time_selector', 'courseenddate', get_string('searchtilltime', 'block_search_course'),
            array('optional' => true));
        $mform->setDefault('courseenddate', 0);

        // checkbox
        $mform->addElement('checkbox', 'description', get_string('description', 'block_search_course'));

        // button
        $this->add_action_buttons(false, get_string('search', 'block_search_course'));
    }
}
