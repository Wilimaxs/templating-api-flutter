<?php
declare(strict_types=1);

const API_TEST_TOKEN = 'test-token-1234567890';

/** Send every API response using the same JSON envelope. */
function respond(int $httpCode, bool $status, string $message, mixed $data): never
{
    http_response_code($httpCode);
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit;
    }

    echo json_encode(
        ['status' => $status, 'message' => $message, 'data' => $data],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
    exit;
}

/** Reject HTTP methods the endpoint does not support. */
function requireMethod(string $method): void
{
    if ($_SERVER['REQUEST_METHOD'] !== $method) {
        header('Allow: ' . $method . ', OPTIONS');
        respond(405, false, 'Metode request tidak diizinkan.', null);
    }
}

/** Require the hardcoded demo token in an Authorization: Bearer header. */
function requireBearerToken(): void
{
    $authorization = $_SERVER['HTTP_AUTHORIZATION']
        ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION']
        ?? '';

    if ($authorization === '' && function_exists('getallheaders')) {
        foreach (getallheaders() as $name => $value) {
            if (strcasecmp($name, 'Authorization') === 0) {
                $authorization = (string) $value;
                break;
            }
        }
    }

    if (!preg_match('/^Bearer\s+(.+)$/i', trim($authorization), $matches)
        || !hash_equals(API_TEST_TOKEN, trim($matches[1]))) {
        header('WWW-Authenticate: Bearer');
        respond(401, false, 'Token tidak ada atau tidak valid.', null);
    }
}

/** Read a JSON request body, with form data as a convenient fallback. */
function requestData(): array
{
    $rawBody = file_get_contents('php://input');
    $json = json_decode($rawBody ?: '', true);

    if (is_array($json)) {
        return $json;
    }

    return $_POST;
}
