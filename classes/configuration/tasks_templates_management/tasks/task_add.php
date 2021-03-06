<?php

class TaskAdd extends TaskAction 
{

    function __construct($course, $cm)
    {
        parent::__construct($course, $cm);
    }

    protected function get_action_header() : string
    {
        return '<h3>'.get_string('add_task_header', 'coursework').'</h3>';
    }

    protected function get_name_input_value() : string
    {
        return '';
    }

    protected function get_description_text() : string
    {
        return '';
    }

    protected function get_action_button() : string
    {
        return '<p><input type="submit" value="'.get_string('add_task_template', 'coursework').'" ></p>';
    }

    protected function get_unique_form_hidden_inputs() : string
    {
        return '<input type="hidden" name="'.ConfigurationManager::DATABASE_EVENT.'" value="'.TasksManagement::ADD_TASK.'"/>';
    }

}


