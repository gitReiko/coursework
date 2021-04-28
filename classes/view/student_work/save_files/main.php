<?php 

namespace Coursework\View\StudentWork\SaveFiles;

require_once 'student_file_manager.php';
require_once 'teacher_file_manager.php';

use Coursework\Lib\Getters\CommonGetter as cg;
use Coursework\Lib\Getters\StudentsGetter as sg;
use Coursework\View\StudentWork\Locallib as locallib;

class Main 
{
    private $course;
    private $cm;
    private $studentId;

    private $work;

    function __construct(\stdClass $course, \stdClass $cm, int $studentId)
    {
        $this->course = $course;
        $this->cm = $cm;
        $this->studentId = $studentId;

        $this->work = sg::get_students_work($cm->instance, $studentId);
    }

    public function get_page() : string 
    {
        $page = cg::get_page_header($this->cm);

        if(locallib::is_user_student($this->work))
        {
            $page.= $this->get_student_files_manager();
        }
        else if(locallib::is_user_teacher($this->work))
        {
            $page.= $this->get_teacher_files_manager();
        }
        else 
        {
            $page.= 'Error. Only students or teachers can manage files.';
        }

        return $page;
    }

    private function get_student_files_manager() : string 
    {
        $context = \context_module::instance($this->cm->id);

        $fileoptions = array(
            'maxbytes' => 0,
            'maxfiles' => '3',
            'subdirs' => 0,
            'context' => $context
        );
        
        $data = new \stdClass();
        
        $data = file_prepare_standard_filemanager(
            $data, 'student', $fileoptions, 
            $context, 'mod_coursework', 
            'student', $this->work->student
        );
        
        $mform = new StudentFileManager(
            null,
            array
            (
                'fileoptions' => $fileoptions,
            )
        );
        
        $mform->set_data($data);

        $manager = '<h4>'.get_string('student_files', 'coursework').'</h4>';
        $manager.= $mform->render();
        return $manager;
    }

    private function get_teacher_files_manager() : string 
    {
        $context = \context_module::instance($this->cm->id);

        $fileoptions = array(
            'maxbytes' => 0,
            'maxfiles' => '3',
            'subdirs' => 0,
            'context' => $context
        );
        
        $data = new \stdClass();
        
        $data = file_prepare_standard_filemanager(
            $data, 'teacher', $fileoptions, 
            $context, 'mod_coursework', 
            'teacher'.$this->work->teacher, 
            $this->work->student
        );
        
        $mform = new TeacherFileManager(
            null,
            array
            (
                'fileoptions' => $fileoptions,
                'work' => $this->work,
            )
        );
        
        $mform->set_data($data);

        $manager = '<h4>'.get_string('teacher_files', 'coursework').'</h4>';
        $manager.= $mform->render();
        return $manager;
    }


}