<?php
include('OpenAI.php');
$openAI = new OpenAI();
$openAI->connect('API_KEY');

// Generate text
$text = $openAI->generateText('Hola, ¿cómo estás hoy?', 'text-davinci-003');
echo $text[0];

// Answer Question
$answer = $openAI->answerQuestion('¿Cuál es el color del cielo?', 'davinci');
echo $answer;

?>