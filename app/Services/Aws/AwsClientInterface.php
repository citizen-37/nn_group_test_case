<?php

namespace App\Services\Aws;

interface AwsClientInterface
{
    public function createBucket(string $bucket): string;

    public function doesBucketExist(string $bucket): bool;

    public function upload(string $bucket, string $filename, string $data): string;

    public function getUrl(string $bucket, string $key): string;
}
