
# PHP OpenAI

Implements OpenAI in PHP in a simple way.
## Deployment

To deploy this project run

```bash
  git clone https://github.com/priv4cy/php-openai.git
```

You need to use OpenAI Key!

## Usage/Examples

```php
$openAI = new OpenAI();
$openAI->connect('API_KEY');

// Generate text
$text = $openAI->generateText('Hola, ¿cómo estás hoy?', 'text-davinci-003');
echo $text[0];

// Answer Question
$answer = $openAI->answerQuestion('¿Cuál es el color del cielo?', 'davinci');
echo $answer;
```


## License

[MIT](https://choosealicense.com/licenses/mit/)
