<?php

use coursework_lib as lib;

class WorkCheck extends ViewModule 
{
    private $taskSections;

    function __construct(stdClass $course, stdClass $cm, int $studentId, bool $displayBlock = false)
    {
        parent::__construct($course, $cm, $studentId, $displayBlock);

        $this->taskSections = $this->get_need_to_check_task_sections();
    }

    protected function get_module_name() : string
    {
        return 'workcheck';
    }

    protected function get_module_header() : string
    {
        return get_string('work_check', 'coursework');
    }

    protected function get_module_body() : string
    {
        $body = $this->get_need_to_check_buttons();
        return $body;
    }

    private function get_need_to_check_task_sections()
    {
        global $DB;
        $sql = 'SELECT cts.*, css.timemodified AS tasksubmissiondate 
                FROM {coursework_tasks_sections} AS cts 
                INNER JOIN {coursework_sections_status} AS css
                ON cts.id = css.section 
                WHERE css.coursework = ?
                AND css.student = ? 
                AND css.status = ? 
                ORDER BY listposition';
        $params = array($this->cm->instance, $this->studentId, SENT_TO_CHECK);
        return $DB->get_records_sql($sql, $params);
    }

    private function get_need_to_check_buttons() : string 
    {
        if($this->is_something_need_to_check())
        {
            $btns = '<hr>';
            foreach($this->taskSections as $section)
            {
                $btns.= $this->get_section_check_block($section);
            }
    
            if($this->is_student_work_sent_for_check())
            {
                $btns.= $this->get_grade_work_block();
            }
        }
        else 
        {
            $btns = '<p style="color: #696969;">'.get_string('nothing_to_check', 'coursework').'</p>';
        }

        
        return $btns;
    }

    private function get_section_check_block(stdClass $section) : string 
    {
        $block = "<p title='{$section->description}'><b>".$section->name.'</b> ';
        $block.= $this->get_accept_form_with_button($section);
        $block.= $this->get_rework_form_with_button($section);
        $block.= '</p><hr>';
        return $block;
    }

    private function get_accept_form_with_button(stdClass $section) : string 
    {
        $btn = '<form method="post">';
        $btn.= '<input type="hidden" name="'.ID.'" value="'.$this->cm->id.'"/>';
        $btn.= '<input type="hidden" name="'.DB_EVENT.'" value="'.ViewDatabaseHandler::SECTIONS_CHECK.'">';
        $btn.= '<input type="hidden" name="'.SECTION.'" value="'.$section->id.'">';
        $btn.= '<input type="hidden" name="'.STUDENT.'" value="'.$this->studentId.'">';
        $btn.= '<input type="hidden" name="'.STATUS.'" value="'.READY.'">';
        $btn.= '<button>'.get_string('accept_sections', 'coursework').'</button>';
        $btn.= '</form>';
        return $btn;
    }

    private function get_rework_form_with_button(stdClass $section) : string 
    {
        $btn = '<form method="post">';
        $btn.= '<input type="hidden" name="'.ID.'" value="'.$this->cm->id.'"/>';
        $btn.= '<input type="hidden" name="'.DB_EVENT.'" value="'.ViewDatabaseHandler::SECTIONS_CHECK.'">';
        $btn.= '<input type="hidden" name="'.SECTION.'" value="'.$section->id.'">';
        $btn.= '<input type="hidden" name="'.STUDENT.'" value="'.$this->studentId.'">';
        $btn.= '<input type="hidden" name="'.STATUS.'" value="'.NEED_TO_FIX.'">';
        $btn.= '<button>'.get_string('send_for_rework', 'coursework').'</button>';
        $btn.= '</form>';
        return $btn;
    }

    private function is_student_work_sent_for_check() : bool 
    {
        global $DB;
        $conditions = array('coursework'=>$this->cm->instance, 'student'=>$this->studentId, 'status'=>SENT_TO_CHECK);
        return $DB->record_exists('coursework_students', $conditions);
    }

    private function get_grade_work_block() : string 
    {
        $btn = '<p><b>'.get_string('grade_all_work', 'coursework').'</b></p>';
        $btn.= '<p>'.$this->get_rework_work_button().'</p>';
        $btn.= '<p>'.$this->get_grade_work_button().'</p>';
        $btn.= '<hr>';
        return $btn;
    }

    private function get_rework_work_button() : string 
    {
        $btn = '<button>'.get_string('send_for_rework', 'coursework').'</button>';

        return $btn;
    }

    private function get_grade_work_button() : string 
    {
        $btn = '<input type="number" min="0" max="60000" autocomplete="off" required>';
        $btn.= '<button>'.get_string('grade_work', 'coursework').'</button>';

        return $btn;
    }

    private function is_something_need_to_check() : bool 
    {
        if((count($this->taskSections) > 0) 
            || $this->is_student_work_sent_for_check())
        {
            return true;
        }
        else 
        {
            return false;
        }
    }



}

