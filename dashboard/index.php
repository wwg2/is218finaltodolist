<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
date_default_timezone_set('America/New_York');
session_start();

if(!isset($_SESSION['email'])) {
    header('Location: ../login');
}
include '../models/Database.php';
include '../models/User.php';
include '../models/Todo.php';
$action = filter_input(INPUT_POST, 'action');
$status = null;
$edit_id = null;
switch($action) {
    case 'add_todo':
        $status = add_todo();
        break;
    case 'set_edit_todo':
        $edit_id = set_edit_todo();
        break;
    case 'edit_todo':
        $status = edit_todo();
        break;
    case 'delete_todo':
        $status = delete_todo();
        break;
    case 'toggle_todo':
        $status = toggle_todo();
        break;
}

show_dashboard($status, $edit_id);
function add_todo() {
    $todo = new Todo();
    $todo->setUserId($_SESSION['id']);
    $todo->setTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
    $todo->setCompleted(0);
    $todo->setUserEmail($_SESSION['email']);
    $todo->setDueDate(filter_input(INPUT_POST, 'due-date', FILTER_SANITIZE_SPECIAL_CHARS));
    return $todo->create();
}

function delete_todo() {
    $id = filter_input(INPUT_POST, 'todo-id', FILTER_VALIDATE_INT);
    return Todo::deleteTodoById($id);
}

function toggle_todo() {
    $id = filter_input(INPUT_POST, 'todo-id', FILTER_VALIDATE_INT);
    return Todo::toggleCompletedById($id);
}

function set_edit_todo() {
    return filter_input(INPUT_POST, 'todo-id', FILTER_VALIDATE_INT);
}

function edit_todo() {
    $id = filter_input(INPUT_POST, 'todo-id', FILTER_VALIDATE_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $due_date = filter_input(INPUT_POST, 'due-date', FILTER_SANITIZE_SPECIAL_CHARS);
    return Todo::edit($id, $title, $due_date);
}

function show_dashboard($status = null, $edit_id = null) {
    $todos = Todo::getTodosByUserId($_SESSION['id']);
    include '../views/dashboard.php';
}
 ?>