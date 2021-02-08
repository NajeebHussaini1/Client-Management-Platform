<?php
/*
	Najeebulla Hussaini 
	WEBD3201
	September 23, 2020
*/
$title = "WEBD3201 Home Page";
include "./includes/header.php";
?>

<h1 class="cover-heading">WEBD3201 Home Page</h1>
<h2><?php echo $message; ?></h2>
<p class="lead">This is the home page for WEBD3201. Sign in to view your dashboard.</p>
<p class="lead">
    <a href="https://durhamcollege.ca/programs-and-courses/courses?subj_code_in=WEBD&crse_numb_in=3201&semester_in=SEM3" class="btn btn-lg btn-secondary">Learn More</a>
</p>

<?php
include "./includes/footer.php";
?>    