<?php
session_start();
include_once "dbh.inc.php";

$tidspunkt = date("Y-m-d H:i:s");
$kommentar = $_POST["svar"];
$tilbakemeldingstudentID = $_SESSION['gtm'];


$sql = "INSERT INTO kommentar_gjest (tidspunkt, kommentar, tilbakemelding_student_id)
        VALUES (?,?,?);";

$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    die("Statement did not prepare");

}else{
    mysqli_stmt_bind_param($stmt, "isi", $tidspunkt, $kommentar, $tilbakemeldingstudentID);
    mysqli_stmt_execute($stmt);
    header("location: ../gjesteskrivekommentar.php?svar=sent");
}
