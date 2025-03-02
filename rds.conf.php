<?php
require 'vendor/autoload.php';

use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;

// Configurar o cliente do AWS SDK
$client = new SecretsManagerClient([
    'region' => 'us-east-1',
    'version' => 'latest',
]);

$secretName = 'rds!db-6b91a18a-f0b5-4bf9-8842-ce675ab470f2';

try {
    $result = $client->getSecretValue([
        'SecretId' => $secretName,
    ]);

    if (isset($result['SecretString'])) {
        $secret = json_decode($result['SecretString'], true);
    } else {
        $secret = json_decode(base64_decode($result['SecretBinary']), true);
    }

    $RDS_URL = 'database-1.cnaiy6eoky6v.us-east-1.rds.amazonaws.com';
    $RDS_DB = 'php';
    $RDS_user = $secret['username'];
    $RDS_pwd = $secret['password'];
    $AFF_NUM = '0';

} catch (AwsException $e) {
    echo "Erro ao obter as credenciais do Secrets Manager: " . $e->getMessage();
    exit;
}
?>