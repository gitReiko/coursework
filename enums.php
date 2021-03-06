<?php

// Coursework configuration modules
const CONFIG_MODULE = 'config_module';
const LEADERS_SETTING = 'leaders_setting';
const STUDENTS_DISTRIBUTION = 'students_distribution';
const REMOVE_DISTRIBUTION = 'remove_distribution';
const LEADER_CHANGE = 'leader_change';
const THEMES_COLLECTIONS_MANAGEMENT = 'themes_collections_management';
const THEME_COLLECTIONS_USING = 'theme_collections_using';
const TASKS_TEMPLATES_MANAGEMENT = 'tasks_templates_management';
const TASKS_USING = 'tasks_using';
const CONFIG_MODULES = array(
                        LEADERS_SETTING, 
                        THEME_COLLECTIONS_USING,
                        TASKS_USING,
                        THEMES_COLLECTIONS_MANAGEMENT,
                        TASKS_TEMPLATES_MANAGEMENT, 
                        STUDENTS_DISTRIBUTION, 
                        REMOVE_DISTRIBUTION, 
                        LEADER_CHANGE);

const DB_EVENT = 'database_event';

// Database events types
const ADD = 'add';
const UPDATE = 'update';
const DEL = 'delete';
const SELECT = 'select';

// Type of database abstractions
const THEME = 'theme';
const NAME = 'name';
const COURSE = 'course';
const COURSES = 'courses';
const ID = 'id';
const GROUP = 'group';
const GROUPS = 'groups';
const PERSONAL = 'personal';
const OWN_THEME = 'own_theme';
const TEACHER = 'teacher';
const TEACHERS = 'teachers';
const COURSEWORK = 'coursework';
const ASSIGNMENT = 'assignment';
const QUOTA = 'quota';
const QUOTAS = 'quotas';
const STUDENT = 'student';
const STUDENTS = 'students';
const RECORD = 'record';
const GRADE = 'grade';
const COMMENT = 'comment';
const ROW = 'row';
const DESCRIPTION = 'description';
const COLLECTION = 'collection';
const TEMPLATE = 'template';
const TASK = 'task';
const SECTION = 'section';
const MESSAGE = 'message';
const USERFROM = 'userfrom';
const USERTO = 'userto';
const STATUS = 'status';

// Sections statuses
const READY = 'ready';
const NEED_TO_FIX = 'need_to_fix';
const NOT_READY = 'not_ready';
const SENT_TO_CHECK = 'sent_to_check';

// Forms
const STUDENT_FORM = 'student_form';
const TEACHER_FORM = 'teacher_form_';

// Group mode
const NO_GROUPS_ = '0';
const SEPARATE_GROUPS_ = '1';
const VISIBLE_GROUPS_ = '2';

const SEPARATOR = '+';
