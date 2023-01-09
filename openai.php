<?php
class OpenAI
{
    private $apiKey;
    private $apiBaseUrl = 'https://api.openai.com/';
    
    public function connect($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    
    public function generateText($prompt, $model, $numResponses = 1)
    {
        $url = $this->apiBaseUrl . 'v1/models/' . $model . '/completions';
        $data = [
            'prompt' => $prompt,
            'max_tokens' => 256, // or 2048?
            'top_p' => 1,
            'n' => $numResponses,
            'stop' => '.',
        ];
        $response = $this->makeRequest($url, $data);
        return $this->processGenerateTextResponse($response);
    }
    
    public function answerQuestion($question, $model)
    {
        $url = $this->apiBaseUrl . 'v1/models/' . $model . '/answer';
        $data = [
            'question' => $question,
        ];
        $response = $this->makeRequest($url, $data);
        return $this->processAnswerQuestionResponse($response);
    }
    
    private function makeRequest($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    private function processGenerateTextResponse($response)
    {
        $responseArray = json_decode($response, true);
        if (isset($responseArray['completions']) && is_array($responseArray['completions'])) {
            $completions = [];
            foreach ($responseArray['completions'] as $completion) {
                $completions[] = $completion['text'];
            }
            return $completions;
        }
        return 'Error: ' . $responseArray['error'];
    }
    
    private function processAnswerQuestionResponse($response)
    {
        $responseArray = json_decode($response, true);
        if (isset($responseArray['answer']) && is_string($responseArray['answer'])) {
            return $responseArray['answer'];
        }
        return 'Error: ' . $responseArray['error'];
    }
}
?>