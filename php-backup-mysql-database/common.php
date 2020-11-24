<?php

//Database backup
function db_backup($host, $user, $pass, $name, $tables = '*') {
    //connect to database using database credentials
    $dbConn = mysqli_connect($host, $user, $pass, $name) or die('MySQL connect failed. ' . mysqli_connect_error());

    //get all of the tables
    if ($tables == '*') {
        $tables = array();
        //fetch tables from database
        $result = mysqli_query($dbConn, 'SHOW TABLES');
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
    } else {
        $tables = is_array($tables) ? $tables : explode(',', $tables);
    }

    $return = '';
    //cycle through tables
    foreach ($tables as $table) {
        //select data from table
        $result = mysqli_query($dbConn, 'SELECT * FROM ' . $table);
        $num_fields = mysqli_num_fields($result);
        
        //drop table
        $return.= 'DROP TABLE ' . $table . ';';
        $row2 = mysqli_fetch_row(mysqli_query($dbConn, 'SHOW CREATE TABLE ' . $table));
        $return.= "\n\n" . $row2[1] . ";\n\n";

        //insert into statements for each table
        for ($i = 0; $i < $num_fields; $i++) {
            while ($row = mysqli_fetch_row($result)) {
                $return.= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = preg_replace("#\n#", "\\n", $row[$j]);
                    if (isset($row[$j])) {
                        $return.= '"' . $row[$j] . '"';
                    } else {
                        $return.= '""';
                    }
                    if ($j < ($num_fields - 1)) {
                        $return.= ',';
                    }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }

    //create a backup file
    $file = SRV_ROOT . 'db-backup-' . time() . '-' . (md5(implode(',', $tables))) . '.sql';

    //write backup sql file to disk
    if ($handle = fopen($file, 'w+')) {
        if (fwrite($handle, $return)) {
            return TRUE;
        }
        fclose($handle);
    }
    return FALSE;
}
