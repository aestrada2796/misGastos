<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;

abstract class Controller
{
    /**
     * @autor Adrian Estrada
     */
    public static function getUrl($path): string
    {
        if (empty($path)) {
            return '';
        }

        $config = config('filesystems.disks.minio');

        $client = new S3Client([
            'credentials' => [
                'key'    => $config['key'],
                'secret' => $config['secret'],
            ],
            'region'                  => $config['region'] ?? 'us-east-1',
            'version'                 => 'latest',
            'bucket'                  => $config['bucket'],
            'endpoint'                => $config['endpoint'],
            'use_path_style_endpoint' => $config['use_path_style_endpoint'] ?? true,
        ]);

        $command = $client->getCommand('GetObject', [
            'Bucket' => $config['bucket'],
            'Key'    => $path,
        ]);

        $request = $client->createPresignedRequest($command, '+5 minutes');
        $presignedUrl = (string) $request->getUri();

        // Reemplazar el endpoint interno con la URL pública
        // Parsear la URL presignada para extraer la ruta y los parámetros
        $parsedUrl = parse_url($presignedUrl);
        $path = $parsedUrl['path'] ?? '';
        $query = $parsedUrl['query'] ?? '';

        // Construir la nueva URL usando MINIO_PUBLIC_URL
        $publicUrl = rtrim($config['url'], '/') . $path;
        if ($query) {
            $publicUrl .= '?' . $query;
        }

        return str_replace('%2F', '/', $publicUrl);
    }
}
