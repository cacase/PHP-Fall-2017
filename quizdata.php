<?php
	session_start();
	require_once("connect.php");
	require_once("quiz.php");
	
	$quiz = new Quiz();
	$chapters = $quiz->getChapters($conn);

	if (isset($_POST['chapter-form']))
	{
		$_SESSION['chapter'] = $_POST['chapter-select'];
		$questionsArr = $quiz->getQuestions($_SESSION['chapter'] , $conn);
		
		//Set instructor email in variable if checkbox was checked
		if(isset($_POST['check-email-instructor']))
		{
			$_SESSION['instructor-email'] = $_POST['instructor-email'];
		}
		else
		{
			$_SESSION['instructor-email'] = null;
		}
	}
	
	function checkLogin()
	{
		if (!isset($_SESSION['student-email']))
		{
			//Redirect user to login page if they aren't signed in
			$_SESSION['message'] = "You must be logged in to access that page.";
			header("Location: login.php");
			exit();
		}
		$_SESSION['message'] = "";
	}
?>