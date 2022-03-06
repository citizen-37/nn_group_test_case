<?php

namespace App\Services\Aws;

use Aws\S3\S3ClientInterface;

class Client implements AwsClientInterface
{
    /**
     * @var S3ClientInterface
     */
    private S3ClientInterface $s3Client;

    /**
     * @param S3ClientInterface $s3Client
     */
    public function __construct(S3ClientInterface $s3Client)
    {
        $this->s3Client = $s3Client;
    }

    /**
     * @param string $bucket
     * @return string
     */
    public function createBucket(string $bucket): string
    {
        $result = $this->s3Client->createBucket([
            'ACL' => 'public-read',
            'Bucket' => $bucket,
        ]);

        return $result->get('Location');
    }

    /**
     * @param string $bucket
     * @return bool
     */
    public function doesBucketExist(string $bucket): bool
    {
        return $this->s3Client->doesBucketExist($bucket);
    }

    /**
     * @param string $bucket
     * @param string $filename
     * @param string $data
     * @return string
     */
    public function upload(string $bucket, string $filename, string $data): string
    {
        $result = $this->s3Client->upload($bucket, $filename, $data);

        return $result->get('ETag');
    }

    /**
     * @param string $bucket
     * @param string $key
     * @return string
     */
    public function getUrl(string $bucket, string $key): string
    {
        return $this->s3Client->getObjectUrl($bucket, $key);
    }
}
