<?php

// General strings
$string['pluginname'] = 'Курсовая работа';
$string['modulename'] = 'Курсовая работа';
$string['modulenameplural'] = 'Курсовые работы';
$string['name'] = 'Название';
$string['intro'] = 'Вступление';
$string['pluginadministration'] = 'Управление курсовой работой';

// Coursework configuration
$string['coursework_configuration'] = 'Настройка курсовой работы';
$string['participants_management'] = 'Управление участниками';
$string['theme'] = 'Тематика';
$string['themes_management'] = 'Управление тематикой';
$string['no_available_themes'] = 'Нет доступных тем';
$string['use_own_theme'] = 'Использовать собственную тему';

// Enrollment strings
$string['configurate_coursework'] = 'Настройка курсовой работы';
$string['select_groups'] = 'Выберите группы, студенты которых будут участвовать в данной курсовой работе';
$string['quota_left'] = 'Необходимо распределить квот: ';
$string['add_tutor'] = 'Добавить преподавателя';
$string['no_permission'] = 'У вас нету разрешения просматривать эту страницу';
$string['save_changes'] = 'Сохранить изменения';
$string['delete'] = 'Удалить';

// Themes management
$string['coursework_themes_management'] = 'Управление тематикой курсовых работ';
$string['add_new_theme'] = 'Добавить новую тему';
$string['edit'] = 'Редактировать';

// Students assignment
$string['students_assignment'] = 'Распределение студентов';
$string['students_assignment_header'] = 'Распределение студентов по элементам курсовой работы';
$string['group_assignment'] = 'Групповое распределение';
$string['no_assign'] = 'Не назначено';

// View strings
$string['fullname'] = 'ФИО';
$string['group'] = 'Группа';
$string['leader'] = 'Руководитель';
$string['course'] = 'Курс';
$string['grade'] = 'Пред. оценка';
$string['comment'] = 'Комментарий';
$string['make_choice'] = 'Сделать выбор';
$string['grade_student'] = 'Оценить студента';
$string['remove_selection'] = 'Отменить выбор';
$string['cant_be_undone'] = 'Сделанный выбор невозможно самостоятельно отменить';
$string['back_to_course'] = 'Вернуться к курсу';
$string['not_selected'] = 'Не выбран(а)';
$string['no_leaders'] = 'Нет доступных руководителей';

// Errors strings
$string['error_no_tutor_or_course'] = 'Ошибка: отсутствует id преподавателя и/или id курса.';
$string['error_no_student'] = 'Ошибка: отсутствует id студента.';
$string['error_no_group'] = 'Ошибка: отсутствует id группы.';
$string['error_no_tutor_course_quota'] = 'Ошибка: отсутствует id преподавателя и/или id курса и/или квота.';
$string['error_theme_already_used'] = 'Ошибка: Данная тема уже используется другим студентом.';
$string['error_tutor_quota_over'] = 'Ошибка: Квота на выбранную связку преподаватель + курс исчерана.';
$string['error_student_already_chosen_theme'] = 'Ошибка: Студент {$a} уже выбрал(а) тематику своей курсовой работы.';
$string['error_tutor_total_quota_over'] = 'Ошибка: Квота преподавателя {$a->tutor} исчерпана. Студенту {$a->student} не назначена тематика курсовой работы.';

// Messages strings
$string['messageprovider:tutorselected'] = 'Сообщение о выборе Вас качестве руководителя курсовой работы.';
$string['tutorselected:head'] = 'Студент выбрал Вас в качестве руководителя курсовой работы';
$string['messageprovider:studentgraded'] = 'Сообщение о выставлении предварительной оценки или комментария по курсовой работе.';
$string['studentgraded:head'] = 'Изменена предварительная оценка или комментарий к курсовой работе';
$string['messageprovider:selectionremoved'] = 'Сообщение о отмене Вашего выбора по курсовой работе.';
$string['selectionremoved:head'] = 'Выбор руководителя курсовой работы отменён';
$string['selectionremoved:body'] = 'Выбор, сделаный Вами ранее в курсовой работе, был удалён вместе со всем достигнутым прогрессом. Выберете себе нового руководителя и продолжите работу с ним.';

$string['user'] = 'Пользователь';
$string['at_time'] = ' в ';
$string['tutorselected'] = ' выбрал(а) Вас в качестве руководителя курсовой работы.';
$string['studentgraded'] = ' предварительно оценил(а) и/или прокомментировал(а) Вашу курсовую работу.';
$string['coursework_link1'] = 'Курсовая работа ';
$string['coursework_link2'] = 'доступна на сайте.';
$string['answer_not_require'] = '*Это сообщение отправлено автоматически и не требует ответа.';
$string['grade_isnt_final'] = '*Предварительная оценка не является окончательной.';
$string['selectionremoved1'] = ' отменил(а) Ваш выбор руководителя курсовой работы.';
$string['selectionremoved2'] = 'Весь полученный прогресс был удалён. Для продолжения работы выберите нового руководителя.';