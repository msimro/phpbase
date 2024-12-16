<?php

header('Content-type: text/plain'); // without it \n . PHP_EOL etc do not work!

$uuid = bin2hex(random_bytes(16)); //https://www.reddit.com/r/PHP/comments/8n819d/uuids_are_obsolete/ & https://github.com/ramsey/uuid

echo uniqid('hola_', TRUE); ///hola_675c4ca86b7e93.06537517

?>

<?php
//readline($prompt): string|false
// Simple example prompting the user for their name 
$name = readline("Enter your name: "); 
  
// Check if the user provided a name 
if ($name !== "") { 
    echo "Hello, $name! Nice to meet you."; 
} else { 
    echo "You didn't enter your name."; 
} 


// Avanced!!!!
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
$location = askQuestion("3. Where are you from?"); 
$hobby = askQuestion("4. What is your favorite hobby?"); 
$feedback = askQuestion("5. How do you like this survey?"); 

// Display the survey results 
echo "\nSurvey Results:\n"; 
echo "Name: {$name}\n"; 
echo "Age: {$age}\n"; 
echo "Location: {$location}\n"; 
echo "Favorite Hobby: {$hobby}\n"; 
echo "Feedback: {$feedback}\n"; 

echo "\n Thank you for participating in the survey! \n"; 
?>
