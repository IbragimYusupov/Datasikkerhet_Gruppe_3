<?php 

	function emptyInputSignup($navn, $etternavn, $e_post, $passord, $Bpassord, $studiekull, $studieretning){
	$result; 
	if (empty($navn) || empty($etternavn) || empty($e_post) || empty($passord) || empty($Bpassord) || empty($studiekull) || empty($studieretning)) { 
		
	$result = true; 
}
	else {
	$result = false;
	}
	return $result;
	}
	
	function emptyInputSignupForeleser($navn, $etternavn, $e_post, $passord, $Bpassord, $file, $emneListe){
	$result; 
	if (empty($navn) || empty($etternavn) || empty($e_post) || empty($passord) || empty($Bpassord) || empty($file) || empty($emneListe)) { 
		
	$result = true; 
}
	else {
	$result = false;
	}
	return $result;
	}
	
	function imgAllowed($file) {
			$fileName = $file["name"];
			$fileSize = $file["size"];
			$fileError = $file["error"];
			
			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
			
			$allowed = array('jpg', 'jpeg', 'png');
			
			if (in_array($fileActualExt, $allowed)){
				if ($fileError === 0) {
					if ($fileSize < 1000000){
						
						$result = false;
						return $result;
					} else {
						$result = true;
						return $result;
					}
				}
					else {
						$result = true;
						return $result;
					}
				} else {
					$result = true;
					return $result;
				}
			
		}
	
	
	function invalidepost($e_post) {
		$result; 
	if (!filter_var($e_post, FILTER_VALIDATE_EMAIL)){
	$result = true; 
}
	else {
	$result = false;
	}
	return $result;
	}
	
	
	
	function passordulike($passord, $Bpassord) {
		$result; 
	if ($passord !== $Bpassord){
	$result = true; 
}
	else {
	$result = false;
	}
	return $result;
	}
	
	function invalidUid($navn){
	$result; 
	if (!preg_match("/^[a-åA-Å]*$/", $navn)){
	$result = true; 
}
	else {
	$result = false;
	}
	return $result;
	}
	
	
	function eposttatt($conn, $e_post) {
		$sql = "SELECT * FROM student WHERE e_post = ? ;";
		$stmt = mysqli_stmt_init ($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../Reg2.php?error=stmtfailed");
			exit();
			
		}
		mysqli_stmt_bind_param($stmt, "s", $e_post);
		mysqli_stmt_execute($stmt);
		
		$resultData = mysqli_stmt_get_result($stmt);
		
		if($row = mysqli_fetch_assoc($resultData)){
			return $row; 
		}
		else{
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}
	
	function eposttattFor($conn, $e_post) {
		$sql = "SELECT * FROM foreleser WHERE e_post = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../Reg2for.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $e_post);
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
	
	
	function createUser($conn, $navn, $etternavn, $e_post, $passord, $studiekull, $studieretning) {
		$sql = "INSERT INTO student (navn, etternavn, e_post, passord, studiekull, studieretning_id) VALUES (?, ?, ?, ?, ?, ?);";
		$stmt = mysqli_stmt_init ($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../Reg2.php?error=stmtfailed");
			exit();
		}
		
		$hashedpassord = password_hash($passord, PASSWORD_BCRYPT);
		
		mysqli_stmt_bind_param($stmt, "ssssii", $navn, $etternavn, $e_post, $hashedpassord, $studiekull, $studieretning);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		header("location: ../login_student.html?error=none");
		exit();
		
		}
		
		function createForeleser($conn, $navn, $etternavn, $e_post, $passord) {
		$sql = "INSERT INTO foreleser (navn, etternavn, e_post, passord) VALUES (?, ?, ?, ?);";
		$stmt = mysqli_stmt_init ($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../Reg2.php?error=stmtfailed");
			exit();
		
		}		
		
		$hashedpassord = password_hash($passord, PASSWORD_BCRYPT);
		
		mysqli_stmt_bind_param($stmt, "ssss", $navn, $etternavn, $e_post, $hashedpassord);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		}
		
		function registrerEmner($conn, $foreleserid, $emneListe){
			$sql = "INSERT INTO foreleser_has_emne (foreleser_id, emne_id)
			VALUES (?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../Reg2for.php?error=stmtfailed");
				exit();
			}
			
		mysqli_stmt_bind_param($stmt, "ii", $foreleserid, $emneListe);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		}
		
		
		function registrerBilde ($conn, $file, $foreleserid){
			$sql = "INSERT INTO bilde(bilde_navn, file_destination, foreleser_id)
			VALUES (?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../Reg2for.php?error=stmtfailed");
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
			
			if (in_array($fileActualExt, $allowed)){
				if ($fileError === 0) {
					if ($fileSize < 1000000){
						$fileNameNew = "profile".$foreleserid.".".$fileActualExt;
						$fileDestination = '../uploads/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						mysqli_stmt_bind_param($stmt, "ssi", $fileName, $fileNameNew, $foreleserid);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);
						header("location: ../login_foreleser.html?error=none");
						exit();
					} else {
						header("location: ../Reg2for.php?error=fileTooBig");
						exit();
					}
				}
					else {
						echo 'Det oppstod en feil med opplastingen av ditt bilde!';
						header("location: ../Reg2for.php?error=fileErrorUpload");
						exit();
					}
				} else {
					header("location: ../Reg2for.php?error=fileWrongType");
					exit;
				}
				
			}

