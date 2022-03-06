<?php

namespace App\Http\Controllers;

use App\Services\Aws\AwsClientInterface;
use Illuminate\Http\Request;

class AwsController extends Controller
{
    /**
     * @param Request $request
     * @param AwsClientInterface $client
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request, AwsClientInterface $client)
    {
        $this->validate($request, ['cont' => 'required']);

        $cont = $request->get('cont');

        $fileName = 'tf.txt';
        $bucket = 'testapp';

        if (!$client->doesBucketExist($bucket)) {
            $client->createBucket($bucket);
        }

        $etag = $client->upload($bucket, $fileName, $cont);

        $url = $client->getUrl($bucket, $fileName);

        return [
            'etag' => $etag,
            'url' => $url,
        ];
    }
}
