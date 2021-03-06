<?php

namespace Coursework\View\StudentWork\Components\Task;

require_once 'interaction_cell.php';

use Coursework\Lib\Getters\CommonGetter as cg;

class Tbody
{
    private $cm;
    private $work;
    private $taskSections;

    function __construct($cm, $taskSections, $work)
    {
        $this->cm = $cm;
        $this->taskSections = $taskSections;
        $this->work = $work;
    }

    public function get() : string 
    {
        $body = \html_writer::start_tag('tbody');

        foreach($this->taskSections as $section)
        {
            $body.= \html_writer::start_tag('tr');

            $body.= $this->get_section_name_cell($section);
            $body.= $this->get_section_state_cell($section);
            $body.= $this->get_last_modify_date_cell($section);
            $body.= $this->get_interaction_cell($section);

            $body.= \html_writer::end_tag('tr');
        }

        $body.= \html_writer::end_tag('tbody');

        return $body;
    }

    private function get_section_name_cell(\stdClass $section) : string 
    {
        $text = $section->name;
        return \html_writer::tag('td', $text);
    }

    private function get_section_state_cell(\stdClass $section) : string 
    {
        $attr = array('class' => 'center');
        $text = cg::get_state_name($section->status);
        return \html_writer::tag('td', $text, $attr);
    }

    private function get_last_modify_date_cell(\stdClass $section) : string 
    {
        if($this->is_date_exists($section->statusmodified))
        {
            $text = date('H:i d-m-Y', $section->statusmodified);
        }
        else
        {
            $text = '';
        }

        $attr = array('class' => 'center');
        return \html_writer::tag('td', $text, $attr);
    }

    private function is_date_exists($date) : bool 
    {
        if(empty($date))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    private function get_interaction_cell(\stdClass $section) : string
    {
        $cell = new InteractionCell($this->cm, $this->work, $section);
        return $cell->get();
    }




}
