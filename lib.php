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
 * @package block_course_status_tracker
 * @copyright 3i Logic<lms@3ilogic.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL
 */

/**
 * This function return courses list based on courses id.
 *
 * @param int $id
 *            course id
 * @return String category id.
 */
function getCourses($courses)
{
    global $CFG, $DB, $USER;
    $content = "";
    if (sizeof($courses) > 0) {
        $i = 1;
        $content .= "<h2>Search results: " . sizeof($courses) . "</h2>";
        $content .= '<div class="courses course-search-result course-search-result-search">';
        foreach ($courses as $singlecourse) {
            $course = get_course($singlecourse->id);
            $title = $course->fullname;
            $summary = $course->sumgetCoursesmary;
            if ($course instanceof stdClass) {
                require_once ($CFG->libdir . '/coursecatlib.php');
                $course = new course_in_list($course);
            }

            if (strlen($summary) > 130) {
                // truncate string
                $summaryCut = substr($summary, 0, 130);

                // make sure it ends in a word so assassinate doesn't become ass...
                $summary = substr($summaryCut, 0, strrpos($summaryCut, ' ')) . '...';
            }
            $courselink = $CFG->wwwroot . '/course/view.php?id=' . $course->id;
            if ($i % 2 == 0)
                $classoddeven = "even";
            else
                $classoddeven = "odd";
            $i ++;
            $content .= '<div class="coursebox clearfix ' . $classoddeven . '" data-courseid="' . $course->id . '" data-type="1">' . '<div class="info"><h3 class="coursename"><a class="" href="' . $courselink . '">' . $title . '</a></h3>' . '<div class="moreinfo"></div></div>' . '<div class="content">' . $summary . '<div class="coursecat">Category: <a class="" href="' . $CFG->wwwroot . '/course/index.php?categoryid=' . $course->category . '">' . get_categoryname($course->category) . '</a>' . '</div></div></div>';
        }
        $content .= '</div>';
    }
    if ($content == '') {
        $content .= '<div class="msg msg-warning"> No course(s) found. </div>'; // String changed.
    }

    return $content;
}

/**
 * This function return category name based on category id.
 *
 * @param int $id
 *            category id
 * @return String category name.
 */
function get_categoryname($id)
{
    global $DB;
    $result = $DB->get_record_sql("SELECT name FROM {course_categories} WHERE id = ?", array(
        $id
    ));
    return $result->name;
}
