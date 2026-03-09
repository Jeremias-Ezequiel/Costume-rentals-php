<?php

class Logs
{
    private static $folderPath = __DIR__ . '/../logs';

    private static function log($message, $level = "INFO")
    {
        // Verify that the log folder exist, and if it does not exits then create it and add all the permissions
        if (!is_dir(self::$folderPath)) {
            mkdir(self::$folderPath, 0777, true);
        }
        // Create the name file with the date if it does not exists
        $fileName = 'log-' . date('Y-m-d') . '.txt';
        $filePath = self::$folderPath . '/' . $fileName;
        $date = date('Y-m-d H:i:s');

        // Put the message in the file 
        if (is_array($message) || is_object($message)) {
            $message = json_encode($message, JSON_PRETTY_PRINT);
        }

        $formatedMessage = "[$date] - [$level] : $message \n";

        file_put_contents($filePath, $formatedMessage, FILE_APPEND | LOCK_EX);
    }

    public static function error($message)
    {
        self::log($message, "ERROR");
    }

    public static function info($message)
    {
        self::log($message, "INFO");
    }

    public static function debug($message)
    {
        self::log($message, "DEBUG");
    }

    public static function critical($message)
    {
        self::log($message, "critical");
    }
}
