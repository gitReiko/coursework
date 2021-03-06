<?php

class CollectionsEdit extends CollectionsAction 
{
    private $collection;

    function __construct($course, $cm)
    {
        parent::__construct($course, $cm);

        $this->collection = $this->get_collection();
    }

    protected function get_action_header() : string
    {
        $header = '<h3>'.get_string('edit_collection_header', 'coursework');
        $header.= ' <b>'.$this->collection->name.'</b>';
        return $header;
    }

    protected function get_name_input_value() : string
    {
        return $this->collection->name;
    }

    protected function is_course_selected(int $courseId) : bool
    {
        if($courseId == $this->collection->course) return true;
        else return false;
    }

    protected function get_description_text() : string
    {
        if(empty($this->collection->description)) return '';
        else return $this->collection->description;
    }

    protected function get_action_button() : string
    {
        return '<p><input type="submit" value="'.get_string('save_changes', 'coursework').'" ></p>';
    }

    protected function get_unique_form_hidden_inputs() : string
    {
        $inputs = '<input type="hidden" name="'.ConfigurationManager::DATABASE_EVENT.'" value="'.CollectionsManagement::EDIT_COLLECTION.'"/>';
        $inputs.= '<input type="hidden" name="'.COLLECTION.ID.'" value="'.$this->collection->id.'"/>';
        return $inputs;
    }

    private function get_collection()
    {
        $collectionId = $this->get_collection_id();

        global $DB;
        $condition = array('id' => $collectionId);
        return $DB->get_record('coursework_theme_collections', $condition);
    }

    private function get_collection_id()
    {
        $collectionId = optional_param(COLLECTION.ID, null, PARAM_INT);
        if(empty($collectionId)) throw new Exception('Missing collection row id.');
        return $collectionId;
    }

}


