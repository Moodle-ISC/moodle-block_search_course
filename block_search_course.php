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
 * Block to search courses by filter out course name and description.
 *
 * @package block_search_course
 * @copyright 3i Logic<lms@3ilogic.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL
 */

/**
 * Display text box in block
 *
 * @return string
 */
class block_search_course extends block_base
{

    /**
     * Initialize title
     *
     * @return null
     */
    public function init()
    {
        $this->title = get_string('title', 'block_search_course');
    }

    /**
     * Initialize content which will display on block
     *
     * @return string
     */
    public function get_content()
    {
        global $CFG, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }
        // Block Variable.

        // Body of Block.
        $this->content = new stdClass();
        $this->content->text = '';
        $this->content->text .= '<form action="' . $CFG->wwwroot . '/blocks/search_course/view.php">';
        $this->content->text .= '<input id="searchform_search" name="search" class="form-control" type="text" size="30" />';
        $this->content->text .= '<button id="searchform_button" type="submit" class="btn-secondary" title="Search">' . get_string('search', 'block_search_course') . '</button><br />';
        $this->content->text .= '<a href="' . $CFG->wwwroot . '/blocks/search_course/view.php" title="Search">' . get_string('advanced', 'block_search_course') . '</button><br />';
        $this->content->text .= '</form>';
        return $this->content;
    }
}
