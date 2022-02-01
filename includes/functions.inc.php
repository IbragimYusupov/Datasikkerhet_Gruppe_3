<?php 
function emptyInputSignupForeleser($fname ,$lname ,$pwd ,$pwdRepeat ,$email, $file, $emneList) {
	$result;
	if (empty($fname) || empty($lname) || empty($pwd) || empty($pwdRepeat) || empty($email) || empty($file) || empty($emneList)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function emptyInputSignupStudent($fname ,$lname ,$pwd ,$pwdRepeat ,$email, $studiekull, $studieretning) {
	$result;
	if (empty($fname) || empty($lname) || empty($pwd) || empty($pwdRepeat) || empty($email) || empty($studiekull) || empty($studieretning)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function invalidUid($fullName) {
	$result;
	if (!preg_match("/^[a-åA-Å]*$/", $fullName)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}
	
function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}	
	
function pwdMatch($pwd, $pwdRepeat) {
	$result;
	if ($pwd !== $pwdRepeat) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function foreleserExists($conn, $email) {
	$sql = "SELECT * FROM foreleser WHERE e_post = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../ForeleserRegistrer.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}

function studentExists($conn, $email) {
	$sql = "SELECT * FROM student WHERE e_post = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../StudentRegistrer.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}

function createForeleser($conn, $fname, $lname, $pwd, $email) {
	$sql = "INSERT INTO foreleser (navn, etternavn, passord, e_post) 
			VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../ForeleserRegistrer.php?error=stmtfailed");
		exit();
	}
	
	$hasedPwd = password_hash($pwd, PASSWORD_BCRYPT);
	
	mysqli_stmt_bind_param($stmt, "ssss", $fname ,$lname ,$hasedPwd ,$email);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

function createStudent($conn, $fname, $lname, $pwd, $email, $studiekull, $studieretning) {
	$sql = "INSERT INTO student (navn, etternavn, passord, e_post, studiekull, studieretning_id) 
			VALUES (?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../StudentRegistrer.php?error=stmtfailed");
		exit();
	}
	
	$hasedPwd = password_hash($pwd, PASSWORD_BCRYPT);
	
	mysqli_stmt_bind_param($stmt, "ssssii", $fname ,$lname ,$hasedPwd ,$email, $studiekull, $studieretning);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ../StudentLogInn.php?error=none");
	exit();
}

function registrerEmner($conn, $foreleserId, $emneList) {
	$sql = "INSERT INTO foreleser_has_emne (foreleser_id, emne_id) 
			VALUES (?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../ForeleserRegistrer.php?error=stmtfailed");
		exit();
	}
	
	foreach($emneList as $selected) {
		$selectedEscape =mysqli_real_escape_string($conn, $selected);
		mysqli_stmt_bind_param($stmt, "ii", $foreleserId, $selectedEscape);
		mysqli_stmt_execute($stmt);
	}
	mysqli_stmt_close($stmt);
}

function registerBilde($conn, $file, $foreleserId) {
	$sql = "INSERT INTO bilde (bilde_navn, file_destination, foreleser_id) 
			VALUES (?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../ForeleserRegistrer.php?error=stmtfailed");
		exit();
	}
	$fileName = $file["name"];
	$fileTmpName = $file["tmp_name"];
	$fileSize = $file["size"];
	$fileError = $file["error"];
	$fileType = $file["type"];
	
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('jpg', 'jpeg', 'png');
	
	if (in_array($fileActualExt, $allowed)) {
				if ($fileError === 0) {
					if ($fileSice < 1000000) {
						$fileNameNew = "profile".$foreleserId.".".$fileActualExt;
						$fileDestination = '../uploads/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						mysqli_stmt_bind_param($stmt, "ssi", $fileName ,$fileNameNew ,$foreleserId);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);
						header("location: ../ForeleserLogInn.php?error=none");
						exit();
					} else {
						header("location: ../ForeleserRegistrer.php?error=fileTooBig");
						exit();
					}
				} else {
					echo 'There was an error uploading your file!';
					header("location: ../ForeleserRegistrer.php?error=fileErrorUpload");
					exit();
				}
			} else {
				header("location: ../ForeleserRegistrer.php?error=fileWorngType");
				exit();
			}
}

function emptyInputLogin($email, $pwd) {
	$result;
	if (empty($email) || empty($pwd)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function loginForeleser($conn, $email, $pwd) {
	$userExists = foreleserExists($conn, $email);
	
	if ($userExists === false) {
		header("location: ../ForeleserLogInn.php?error=userNotExist");
		exit();
	}
	
	$pwdHased = $userExists["passord"];
	$checkPwd = password_verify($pwd, $pwdHased);
	
	if ($checkPwd === false) {
		header("location: ../ForeleserLogInn.php?error=wrongPassword");
		exit();
	} else if ($checkPwd === true) {
		session_start();
		$_SESSION['user_id'] = $userExists["id"];
		$_SESSION['type'] = "f";
		header("location: ../ForeleserHjemmeside.php");
		exit();
	}
}

function loginStudent($conn, $email, $pwd) {
	$userExists = studentExists($conn, $email);
	
	if ($userExists === false) {
		header("location: ../ForeleserRegistrer.php?error=userNotExist");
		exit();
	}
	
	$pwdHased = $userExists["passord"];
	$checkPwd = password_verify($pwd, $pwdHased);
	
	if ($checkPwd === false) {
		header("location: ../StudentLogInn.php?error=wrongPassword");
		exit();
	} else if ($checkPwd === true) {
		session_start();
		$_SESSION['user_id'] = $userExists["id"];
		$_SESSION['type'] = "s";
		header("location: ../StudentHjemmeSide.php");
		exit();
	}
}

