<?php


class ApiClient
{
    private string $baseUrl;    
    private string $authHeader;
    
    public function __construct(string $baseUrl, string $username, string $password)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $credentials = base64_encode("$username:$password");
        $this->authHeader = "Authorization: Basic $credentials";
    }
    
    private function request(string $method, string $endpoint, ?array $data = null): array
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_HTTPHEADER => [$this->authHeader, 'Content-Type: application/json'],
        ]);

        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $body = ($response !== false) ? json_decode($response, true) : null; // Обработка случая с ошибкой cURL

        return [
            'status' => $code,
            'error' => ($error !== false) ? $error : null, // Обработка случая с ошибкой cURL
            'body' => $body,
        ];
    }
   
    public function get(string $endpoint): array
    {
        return $this->request('GET', $endpoint);
    }
  
    public function put(string $endpoint, array $data): array
    {
        return $this->request('PUT', $endpoint, $data);
    }

    public function post(string $endpoint, array $data): array
    {
        return $this->request('POST', $endpoint, $data);
    }

    public function delete(string $endpoint): array
    {
        return $this->request('DELETE', $endpoint);
    }
}
