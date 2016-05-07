<?php

//PDO
function testdb_connect() {
    $dbh;
    try {
        $dbh = new PDO("mysql:host=sqlc.findmyfare.com;dbname=fmfmain_v1db", "fmfmain_user2", "456@fmf");
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec("SET NAMES 'utf8'");
        $dbh->exec("SET time_zone = '+5:30'");
    } catch (PDOException $e) {
        print ("Could not connect to server, Please Call 011 7 247 365.\n");
        $date_time = date('Y-m-d H:i:s');
        error_log($date_time . " " . $e->getMessage());
        print ("getMessage(): " . $e->getMessage() . "\n");
        exit();
    }

    return ($dbh);
}

//connections for grids
function get_connection() {
    $dbh;
    try {
        $host = "sqlc.findmyfare.com";
        $user = "fmf_dbmain_sel";
        $pass = "9874@fmf";
        $databaseName = "fmfmain_v1db";
        $con = mysql_connect($host, $user, $pass);
        mysql_query("SET time_zone = '+5:30'");
        $dbh = mysql_select_db($databaseName, $con);
    } catch (PDOException $e) {
        print ("Could not get the connection, Please Call 011 7 247 365.\n");
        $date_time = date('Y-m-d H:i:s');
        error_log($date_time . " " . $e->getMessage());
        print ("getMessage(): " . $e->getMessage() . "\n");
        exit();
    }
    return ($dbh);
}

function get_connection_cms() {
    $dbh;
    try {
        $host = "cms.findmyfare.com";
        $user = "fmfsite2acc";
        $pass = 'f5Sf1g6xh@$fSn@z@DTMdtx0m5Z';
        $databaseName = "cms_fmf";
        $con = mysql_connect($host, $user, $pass);
        mysql_query("SET time_zone = '+5:30'");
        $dbh = mysql_select_db($databaseName, $con);
    } catch (PDOException $e) {
        print ("Could not get the connection, Please Call 011 7 247 365.\n");
        $date_time = date('Y-m-d H:i:s');
        error_log($date_time . " " . $e->getMessage());
        print ("getMessage(): " . $e->getMessage() . "\n");
        exit();
    }
    return ($dbh);
}

function get_connection_con() {
    $con;
    try {
        $host = "sqlc.findmyfare.com";
        $user = "fmf_dbmain_sel";
        $pass = "9874@fmf";
        $databaseName = "fmfmain_v1db";
        $con = mysqli_connect($host, $user, $pass, $databaseName);
    } catch (PDOException $e) {
        print ("Could not get the connection, Please Call 011 7 247 365.\n");
        $date_time = date('Y-m-d H:i:s');
        error_log($date_time . " " . $e->getMessage());
        print ("getMessage(): " . $e->getMessage() . "\n");
        exit();
    }
    return ($con);
}

//connection for payv2 mysql
function get_connection_v2() {
    $dbh;
    try {
        $host = "sql.pay.findmyfare.com";
        $user = "fmfpay2";
        $pass = "jByJ8KPM1hfYV1Cos%C9y1N99^^";
        $databaseName = "fmfpay_v1";
        $con = mysql_connect($host, $user, $pass);
        mysql_query("SET time_zone = '+5:30'");
        $dbh = mysql_select_db($databaseName, $con);
    } catch (PDOException $e) {
        print ("Could not get the connection, Please Call 011 7 247 365.\n");
        $date_time = date('Y-m-d H:i:s');
        error_log($date_time . " " . $e->getMessage());
        print ("getMessage(): " . $e->getMessage() . "\n");
        exit();
    }
    return ($dbh);
}

//connection for payv2 pdo
function get_connection_v2_pdo() {
    $dbh;
    try {
        $dbh = new PDO("mysql:host=sql.pay.findmyfare.com;dbname=fmfpay_v1", "fmfpay2", "jByJ8KPM1hfYV1Cos%C9y1N99^^");
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec("SET NAMES 'utf8'");
        $dbh->exec("SET time_zone = '+5:30'");
    } catch (PDOException $e) {
        print ("Could not connect to server, Please Call 011 7 247 365.\n");
        $date_time = date('Y-m-d H:i:s');
        error_log($date_time . " " . $e->getMessage());
        print ("getMessage(): " . $e->getMessage() . "\n");
        exit();
    }

    return ($dbh);
}

function DBCon_VTwo($usr) {
    $user1 = array("fmf_dbmain_sel", "9874@fmf");
    $user2 = array("fmf_dbmain_ins", "8745@fmf");
    $user3 = array("fmf_dbmain_upd", "6325@fmf");
    $user = '';

    if ($usr == 1) {
        $user = $user1;
    } else if ($usr == 2) {
        $user = $user2;
    } else if ($usr == 3) {
        $user = $user3;
    }

    $dbh;
    try {
        $dbh = new PDO("mysql:host=sqlc.findmyfare.com;dbname=fmfmain_v1db", "$user[0]", "$user[1]");
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec("SET NAMES 'utf8'");
        $dbh->exec("SET time_zone = '+5:30'");
    } catch (PDOException $e) {
        print ("Could not connect to server, Please Call 011 7 247 365.\n");
        $date_time = date('Y-m-d H:i:s');
        error_log($date_time . " " . $e->getMessage());
        print ("getMessage(): " . $e->getMessage() . "\n");
        exit();
    }

    return ($dbh);
}

?>