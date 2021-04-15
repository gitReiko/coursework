<?php

namespace Coursework\View\StudentsWork\Components;

class Chat extends Base 
{
    private $work;

    function __construct(\stdClass $course, \stdClass $cm, int $studentId)
    {
        parent::__construct($course, $cm, $studentId);
    }

    protected function get_hiding_class_name() : string
    {
        return 'work_chat_content';
    }

    protected function get_header_text() : string
    {
        return get_string('chat', 'coursework');
    }

    protected function get_content() : string
    {
        $con = 'text';
        
        
        return $con;
    }




}