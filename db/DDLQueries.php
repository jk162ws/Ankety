<?php
class DDLQueries {
    public static $TABLE_USERS = "pouzivatelia";
    public static $KEY_USER_LOGIN = "login";
    public static $KEY_USER_EMAIL = "email";
    public static $KEY_USER_PASSWORD = "password";
    public static $TABLE_POLLS = "ankety";
    public static $KEY_POLL_ID = "id";
    public static $KEY_FOREIGN_USER_LOGIN = "login";
    public static $KEY_POLL_NAME = "meno";
    public static $KEY_POLL_TYPE = "typ";
    public static $KEY_POLL_PASSWORD = "password";
    public static $TABLE_QUESTIONS = "otazky";
    public static $KEY_QUESTION_ID = "id";
    public static $KEY_FOREIGN_POLL_ID = "id_ankety";
    public static $KEY_QUESTION_TYPE = "typ";
    public static $KEY_QUESTION_TEXT = "text";
    public static $KEY_QUESTION_IMAGE = "obrazok";
    public static $TABLE_QUESTION_OPTIONS = "moznosti";
    public static $KEY_OPTION_ID = "id";
    public static $KEY_FOREIGN_QUESTION = "id_otazky";
    public static $KEY_OPTION_TEXT = "text";
    public static $TABLE_ANSWERS = "odpovede";
    public static $KEY_ANSWER_ID = "id";
    public static $KEY_FOREIGN_QUESTION_ID = "id_otazky";
    public static $KEY_ANSWER_TEXT = "text";
    public static $TABLE_ANSWERS_USERS = "pouz_odp";
    public static $KEY_FOREIGN_USERS = "id_pouzivatela";
    public static $KEY_FOREIGN_ANSWERS = "id_odpovede";
    public static $CREATE_USERS;
    public static $CREATE_POLLS;
    public static $CREATE_QUESTIONS;
    public static $CREATE_QUESTION_OPTIONS;
    public static $CREATE_ANSWERS;
    public static $CREATE_ANSWER_USER;
    public static function init() {
        DDLQueries::createUsers();
        DDLQueries::createPolls();
        DDLQueries::createQuestions();
        DDLQueries::createQuestionOptions();
        DDLQueries::createAnswers();
        DDLQueries::createAnswerUser();
    }
    private static function createUsers() {
        DDLQueries::$CREATE_USERS = "CREATE TABLE IF NOT EXISTS " . DDLQueries::$TABLE_USERS .
            "( " . DDLQueries::$KEY_USER_LOGIN . " varchar(30) primary key, " .
            DDLQueries::$KEY_USER_EMAIL . " varchar(40) not null, " .
            DDLQueries::$KEY_USER_PASSWORD . " varchar(80) not null " .
            ");";
    }
    private static function createPolls() {
        DDLQueries::$CREATE_POLLS = "CREATE TABLE IF NOT EXISTS " . DDLQueries::$TABLE_POLLS . 
            "( " . DDLQueries::$KEY_POLL_ID . " integer(8) primary key auto_increment, " . 
            DDLQueries::$KEY_FOREIGN_USER_LOGIN . " varchar(30) not null, " . 
            DDLQueries::$KEY_POLL_NAME . " varchar(100), " . 
            DDLQueries::$KEY_POLL_TYPE . " varchar(20) not null, " . 
            DDLQueries::$KEY_POLL_PASSWORD . " varchar(80), " .
            "FOREIGN KEY(" . DDLQueries::$KEY_FOREIGN_USER_LOGIN . ") REFERENCES " . DDLQueries::$TABLE_USERS . "(" . DDLQueries::$KEY_USER_LOGIN . ") ON DELETE CASCADE" .
            ");";
    }
    private static function createQuestions() {
        DDLQueries::$CREATE_QUESTIONS = "CREATE TABLE IF NOT EXISTS " . DDLQueries::$TABLE_QUESTIONS . 
                "( " . DDLQueries::$KEY_QUESTION_ID . " integer(8) primary key auto_increment, " .
                DDLQueries::$KEY_FOREIGN_POLL_ID . " integer(8) not null, " .
                DDLQueries::$KEY_QUESTION_TYPE . " varchar(20) not null, " .
                DDLQueries::$KEY_QUESTION_TEXT . " varchar(150) not null, " .
                DDLQueries::$KEY_QUESTION_IMAGE . " blob, " .
                "FOREIGN KEY(" . DDLQueries::$KEY_FOREIGN_POLL_ID . ") REFERENCES " . DDLQueries::$TABLE_POLLS . "(" . DDLQueries::$KEY_POLL_ID . ") ON DELETE CASCADE" .
                ");";
    }
    private static function createQuestionOptions() {
        DDLQueries::$CREATE_QUESTION_OPTIONS = "CREATE TABLE IF NOT EXISTS " . DDLQueries::$TABLE_QUESTION_OPTIONS .
                "( " . DDLQueries::$KEY_OPTION_ID . " integer(8) primary key auto_increment, " .
                DDLQueries::$KEY_FOREIGN_QUESTION . " integer(8) not null, " . 
                DDLQueries::$KEY_OPTION_TEXT . " varchar(150) not null, " .
                "FOREIGN KEY(" . DDLQueries::$KEY_FOREIGN_QUESTION . ") REFERENCES " . DDLQueries::$TABLE_QUESTIONS . "(" . DDLQueries::$KEY_QUESTION_ID . ") ON DELETE CASCADE" .
                ");";
    }
    private static function createAnswers() {
        DDLQueries::$CREATE_ANSWERS = "CREATE TABLE IF NOT EXISTS " . DDLQueries::$TABLE_ANSWERS .
                "( " . DDLQueries::$KEY_ANSWER_ID . " integer(8) primary key auto_increment, " .
                DDLQueries::$KEY_FOREIGN_QUESTION_ID . " integer(8) not null, " . 
                DDLQueries::$KEY_ANSWER_TEXT . " varchar(150), " .
                "FOREIGN KEY(" . DDLQueries::$KEY_FOREIGN_QUESTION_ID . ") REFERENCES " . DDLQueries::$TABLE_QUESTIONS . "(" . DDLQueries::$KEY_QUESTION_ID . ") ON DELETE CASCADE" .
                ");";
    }
    private static function createAnswerUser() {
        DDLQueries::$CREATE_ANSWER_USER = "CREATE TABLE IF NOT EXISTS " . DDLQueries::$TABLE_ANSWERS_USERS .
                "( " . DDLQueries::$KEY_FOREIGN_USERS . " varchar(30) not null, " .
                DDLQueries::$KEY_FOREIGN_ANSWERS . " integer(8) not null, " .
                "primary key (" . DDLQueries::$KEY_FOREIGN_USERS . ", " . DDLQueries::$KEY_FOREIGN_ANSWERS . "), " .
                "FOREIGN KEY(" . DDLQueries::$KEY_FOREIGN_USERS . ") REFERENCES " . DDLQueries::$TABLE_USERS . "(" . DDLQueries::$KEY_USER_LOGIN . ") ON DELETE CASCADE, " .
                "FOREIGN KEY(" . DDLQueries::$KEY_FOREIGN_ANSWERS . ") REFERENCES " . DDLQueries::$TABLE_ANSWERS . "(" . DDLQueries::$KEY_ANSWER_ID . ") ON DELETE CASCADE" .
                ");";
    }
}
