<?php

use coursework_lib as lib;

class SendSectionForCheckDatabaseHandler 
{
    private $course;
    private $cm;

    private $sectionStatus;

    function __construct(stdClass $course, stdClass $cm)
    {
        $this->course = $course;
        $this->cm = $cm;
        $this->sectionStatus = $this->get_section_status();
    }

    public function handle()
    {
        if(lib\is_section_status_exist($this->cm, 
                                    $this->sectionStatus->student, 
                                    $this->sectionStatus->section))
        {
            $this->update_section_status();
        }
        else 
        {
            $this->add_section_status();
        }

        $work = $this->get_student_coursework();
        $this->send_notification($work);
    }


    private function get_section_status() : stdClass 
    {
        $sectionStatus = new stdClass;
        $sectionStatus->coursework = $this->get_coursework();
        $sectionStatus->student = $this->get_student();
        $sectionStatus->section = $this->get_section();
        $sectionStatus->status = SENT_TO_CHECK;
        $sectionStatus->timemodified = time();
        return $sectionStatus;
    }

    private function get_coursework() : int 
    {
        if(empty($this->cm->instance)) throw new Exception('Missing coursework id.');
        return $this->cm->instance;
    }

    private function get_student() : int 
    {
        $student = optional_param(STUDENT, null, PARAM_INT);
        if(empty($student)) throw new Exception('Missing student id.');
        return $student;
    }

    private function get_section() : int 
    {
        $section= optional_param(SECTION, null, PARAM_INT);
        if(empty($section)) throw new Exception('Missing section id.');
        return $section;
    }

    private function add_section_status()
    {
        global $DB;
        return $DB->insert_record('coursework_sections_status', $this->sectionStatus);
    }

    private function get_section_status_id() : int  
    {
        global $DB;
        $where = array('coursework'=>$this->cm->instance, 
                        'student' => $this->sectionStatus->student,
                        'section' => $this->sectionStatus->section);
        return $DB->get_field('coursework_sections_status', 'id', $where);
    }

    private function update_section_status()
    {
        global $DB;
        $this->sectionStatus->id = $this->get_section_status_id();
        return $DB->update_record('coursework_sections_status', $this->sectionStatus);
    }

    private function get_student_coursework() : stdClass
    {
        global $DB, $USER;
        $where = array('coursework' => $this->cm->instance, 'student' => $USER->id);
        return $DB->get_record('coursework_students', $where);
    }

    private function send_notification(stdClass $work) : void 
    {
        global $USER;

        $cm = $this->cm;
        $course = $this->course;
        $messageName = 'sendsectionforcheck';
        $userFrom = $USER;
        $userTo = lib\get_user($work->teacher); 
        $headerMessage = get_string('section_send_for_cheack_header','coursework');
        $giveTask = true;
        $fullMessageHtml = $this->get_select_theme_html_message($giveTask);

        lib\send_notification($cm, $course, $messageName, $userFrom, $userTo, $headerMessage, $fullMessageHtml);
    }

    private function get_select_theme_html_message($giveTask = false) : string
    {
        $message = '<p>'.get_string('section_send_for_cheack_header','coursework', $params).'</p>';
        $notification = get_string('answer_not_require', 'coursework');

        return cw_get_html_message($this->cm, $this->course->id, $message, $notification);
    }


}
