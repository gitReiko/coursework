<?php



defined('MOODLE_INTERNAL') || die();

$messageproviders = array(
    // Notify that the student select their theme
    'selecttheme' => array(
        'capability' => 'mod/coursework:selecttheme'
    ),

    'taskassignment' => array(
        'capability' => 'mod/coursework:taskassignment'
    ),

    // Notify that the leader grade their student
    'studentgraded' => array(
        'capability' => 'mod/coursework:gradestudent'
    ),

    // Notify that student selection was removed
    'selectionremoved' => array(
        'capability' => 'mod/coursework:removeselection'
    ),

    // Notify that student selection was removed
    'leader_changed' => array(
        'capability' => 'mod/coursework:is_student'
    ),
);






