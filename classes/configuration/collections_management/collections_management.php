<?php

require_once 'collections_overview.php';
require_once 'collections_action.php';
require_once 'collections_add.php';

class CollectionsManagement extends ConfigurationManager
{
    // Types of events
    const OVERVIEW = 'overview';
    const ADD_COLLECTION = 'add_collection';
    const EDIT_COLLECTION = 'edit_collection';
    const ADD_THEME = 'add_theme';
    const EDIT_THEME = 'edit_theme';
    const DELETE_THEME = 'delete_theme';

    function __construct(stdClass $course, stdClass $cm)
    {
        parent::__construct($course, $cm);
    }

    protected function handle_database_event() : void
    {
        if($this->is_database_event_exist())
        {
            //$handler = new ChangeLeaderDBEventsHandler($this->course, $this->cm);
            //$handler->execute();
        }
    }

    protected function get_gui() : string 
    {
        $gui = '';
        $guiType = optional_param(self::GUI_TYPE, null, PARAM_TEXT);

        if($guiType === self::ADD_COLLECTION)
        {
            $gui.= $this->get_add_collection_gui();
        }
        else
        {
            $gui.= $this->get_overview_gui();
        }

        return $gui;
    }

    private function get_overview_gui() : string 
    {
        $overview = new CollectionsOverview($this->course, $this->cm);
        return $overview->get_gui();
    }

    private function get_add_collection_gui() : string 
    {
        $distributeStudents = new CollectionsAdd($this->course, $this->cm);
        return $distributeStudents->get_gui();
    }


}
