<?php

namespace Coursework\View\StudentsWorksList;

use Coursework\View\StudentsWorksList\Page as p;
use Coursework\Lib\Getters\CommonGetter as cg;
use Coursework\Lib\Notifications;
use Coursework\Lib\Enums as enum;
use ViewMain as m;

class StudentsTable 
{
    const MORE = 'more_';
    const MORE_POINTER = 'more_pointer_';

    private $d;

    function __construct(MainGetter $d) 
    {
        $this->d = $d;
    }

    public function get_students_table() : string 
    {
        $attr = array('class' => 'studentsWorksList');
        $tbl = \html_writer::start_tag('table', $attr);
        $tbl.= $this->get_table_header();
        $tbl.= $this->get_table_body();
        $tbl.= \html_writer::end_tag('table');

        return $tbl;
    }

    private function get_table_header() : string 
    {
        $head = \html_writer::start_tag('thead');
        $head.= \html_writer::start_tag('tr');

        $attr = array('title' => get_string('notifications', 'coursework'));
        $text = '<i class="fa fa-exclamation-triangle"></i>';
        $head.= \html_writer::tag('td', $text, $attr);

        $attr = array('title' => get_string('more_details', 'coursework'));
        $text = '<i class="fa fa-arrow-down"></i>';
        $head.= \html_writer::tag('td', $text, $attr);

        $attr = array('title' => get_string('go_to_student_work', 'coursework'));
        $text = get_string('work', 'coursework');
        $head.= \html_writer::tag('td', $text, $attr);

        $text = get_string('student', 'coursework');
        $head.= \html_writer::tag('td', $text);

        $text = get_string('state', 'coursework');
        $head.= \html_writer::tag('td', $text);

        $text = get_string('theme', 'coursework');
        $head.= \html_writer::tag('td', $text);

        $text = get_string('grade_short', 'coursework');
        $head.= \html_writer::tag('td', $text);

        $head.= \html_writer::end_tag('tr');
        $head.= \html_writer::end_tag('thead');

        return $head;
    }

    private function get_table_body() : string 
    {
        $body = \html_writer::start_tag('tbody');

        foreach($this->d->get_students() as $student)
        {
            $ntfs = $this->get_notifications($student);

            $body.= $this->get_main_row($student, $ntfs);
            $body.= $this->get_notification_row($student, $ntfs);
        }

        $body.= \html_writer::end_tag('tbody');

        return $body;
    }

    private function get_main_row(\stdClass $student, Notifications $ntfs) : string 
    {
        $row = \html_writer::start_tag('tr');
        $row.= $this->get_notification_cell($student, $ntfs);
        $row.= $this->get_more_button($student);
        $row.= $this->get_work_cell($student);
        $row.= $this->get_student_cell($student);
        $row.= $this->get_state_cell($student);
        $row.= $this->get_theme_cell($student);
        $row.= $this->get_grade_cell($student);
        $row.= \html_writer::end_tag('tr');

        return $row;
    }

    private function get_notifications(\stdClass $student) : Notifications
    {
        return new Notifications(
            $this->d->get_cm()->instance,
            $student,
            $this->d->get_selected_teacher_id()
        );
    }

    private function get_notification_cell(\stdClass $student, Notifications $ntfs) : string
    {
        $moreId = self::MORE.$student->id;
        $morePtrId = self::MORE_POINTER.$student->id;

        $attr = array(
            'class' => 'notibtn',
            'onclick' => 'open_close_table_row(`'.$moreId.'`,`'.$morePtrId.'`)',
            'title' => get_string('show_notifications', 'coursework')
        );

        if($ntfs->is_notifications_exist())
        {
            $text = '<i class="fa fa-exclamation-triangle"></i>';
        }
        else 
        {
            $text = '';
        }

        return \html_writer::tag('td', $text, $attr);
    }

    private function get_more_button(\stdClass $student) : string 
    {
        $moreId = self::MORE.$student->id;
        $morePtrId = self::MORE_POINTER.$student->id;

        $fun = 'open_close_table_row(`'.$moreId.'`,`'.$morePtrId.'`)';
        $attr = array(
            'class' => 'morebtn', 
            'onclick' => $fun,
            'title' => get_string('show_more_info', 'coursework')
        );
        $text = '<i class="fa fa-arrow-down" id="'.$morePtrId.'"></i>';
        return \html_writer::tag('td', $text, $attr);
    }

    private function get_work_cell(\stdClass $student) : string 
    {
        $attr = array(
            'href' => $this->get_go_to_work_url($student),
            'title' => get_string('go_to_student_work', 'coursework')
        );
        $text = get_string('work', 'coursework');
        $a = \html_writer::tag('a', $text, $attr);
        return \html_writer::tag('td', $a);
    }

    private function get_go_to_work_url(\stdClass $student)
    {
        $url = '/mod/coursework/view.php';
        $url.= '?'.m::ID.'='.$this->d->get_cm()->id;
        $url.= '&'.m::GUI_EVENT.'='.m::USER_WORK;
        $url.= '&'.m::STUDENT_ID.'='.$student->id;

        return $url;
    }

    private function get_student_cell(\stdClass $student) : string 
    {
        $text = cg::get_user_photo($student->id).' ';

        global $COURSE;
        $url = '/user/view.php?id='.$student->id;
        $url.= '&course='.$COURSE->id;
        $attr = array('href' => $url);
        $name = $student->lastname.' '.$student->firstname;
        $text.= \html_writer::tag('a', $name, $attr);

        return \html_writer::tag('td', $text);
    }

    private function get_state_cell(\stdClass $student) : string 
    {
        switch($student->status)
        {
            case enum::NOT_READY:
                $text = get_string('work_not_ready', 'coursework');
                break;
            case enum::READY:
                $text = get_string('work_ready', 'coursework');
                break;
            case enum::NEED_TO_FIX:
                $text = get_string('work_need_to_fix', 'coursework');
                break;
            case enum::SENT_TO_CHECK:
                $text = get_string('work_sent_to_check', 'coursework');
                break;
        }

        return \html_writer::tag('td', $text);
    }

    private function get_theme_cell(\stdClass $student) : string 
    {
        $text = $student->theme;
        return \html_writer::tag('td', $text);
    }

    private function get_grade_cell(\stdClass $student) : string 
    {
        $attr = array('class' => 'center');

        if(empty($student->grade))
        {
            $text = '';
        }
        else 
        {
            $text = $student->grade;
        }

        return \html_writer::tag('td', $text, $attr);
    }

    private function get_notification_row(\stdClass $student, Notifications $ntfs) : string 
    {
        $attr = array('class' => self::MORE.$student->id.' hidden');
        $row = \html_writer::start_tag('tr', $attr);
        $row.= $this->get_empty_cell($student);
        $row.= $this->get_empty_cell($student);
        $row.= $this->get_notifications_list_cell($student, $ntfs);
        $row.= \html_writer::end_tag('tr');

        return $row;
    }

    private function get_empty_cell(\stdClass $student) : string 
    {
        $attr = array('class' => 'no-borders');
        $text = '';
        return \html_writer::tag('td', $text, $attr);
    }

    private function get_notifications_list_cell(\stdClass $student, Notifications $ntfs) : string 
    {
        $text = '';
        $notifications = $ntfs->get_notifications();

        if(count($notifications))
        {
            $attr = array(
                'class' => 'red-bg',
                'colspan' => '5'
            );

            foreach ($notifications as $notification) 
            {
                $text.= \html_writer::tag('p', $notification);
            }
        }
        else 
        {
            $attr = array(
                'colspan' => '5'
            );
            $text = get_string('no_notifications', 'coursework');
        }
        
        return \html_writer::tag('td', $text, $attr);
    }



}