<?php 
    
// Function to ask a question and get user input 
function askQuestion($question) { 
    return readline($question . " "); 
} 
  
// Main program 
echo "Welcome to the Interactive Survey!\n"; 
echo "Please answer the following questions:\n"; 
  
// Ask the user some questions 
$name = askQuestion("1. What is your name?"); 
$age = askQuestion("2. How old are you?"); 
// $location = askQuestion("3. Where are you from?"); 
// $hobby = askQuestion("4. What is your favorite hobby?"); 
// $feedback = askQuestion("5. How do you like this survey?"); 
  
// Display the survey results 
echo "\nSurvey Results:\n"; 
echo "Name: {$name}\n"; 
echo "Age: {$age}\n"; 
echo "Location: {$location}\n"; 
echo "Favorite Hobby: {$hobby}\n"; 
echo "Feedback: {$feedback}\n"; 

echo "\n Thanks ". $name ."\n"; 

echo "\nThank you for interactive with PHP Code!\n"; 
?>

<?php
// Use the Console / Terminal for this exercise! 
$number = rand(0, 30);
$guess = null;
while ( $guess != $number ) {
	$guess = readline( 'Guess between 1 and 30: ');
	if ( $number == $guess ) {
		echo "Yes! You guessed correctly. \n\n";
	} else {
		echo "Alas. Your guess is incorrect. \n\n";
	}
}

die();