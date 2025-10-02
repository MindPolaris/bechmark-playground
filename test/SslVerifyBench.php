<?php

declare(strict_types=1);

namespace MindPolaris\Benchmark\Test;

use Exception;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

class SslVerifyBench
{
    /**
     * @Iterations(10)
     * @Revs(1000)
     */
    public function benchVerifyWithX509Certificate(): void
    {
        $cert = <<<CERT
-----BEGIN CERTIFICATE-----
MIICnTCCAYUCBgGZES/XCTANBgkqhkiG9w0BAQsFADASMRAwDgYDVQQDDAdQYXlz
ZXJhMB4XDTI1MDkwMzIwMDQzMVoXDTM1MDkwMzIwMDYxMVowEjEQMA4GA1UEAwwH
UGF5c2VyYTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAOKTQnLOjfA0
Oa2mTw63d8b+4f/NjKSUHnM+rM1AqCvzlucYihAgMHnmWfq1Jlq2BTvdz7431nXU
Rws+q7jAT84ZP3O/ZizCW59O4+RB01Vk2zkIpuChSGYhbfRSsY3xqhfI71F28DYM
v7cO4ieE4eu8HiM1+qK0L6wHEctVwrdDzIAo7/E9f6AShY7yGQlIXf6MbXxK924t
qFyidS131UrpyTfwd5u6e+i3RX/6w1KcEabVPPMxTwjpqr35Vi4Qy8K1tVcmpRbP
Yj1ANqvOIij9jC+oO/rVQhfDVjeAn0a9mYnTGot/vPTVgzQMrtvspX9WQ3yUB/Tm
cXmFitcC9OsCAwEAATANBgkqhkiG9w0BAQsFAAOCAQEAoFxBo3c9TsZ7Le/ZhNF3
/ADaDb78ngqPHmUdCUJd5a/3O8PmUoNyiw61k8LCRK0f/Y7ZBdiupcVzcsZiuQwP
8lLRBgU3EEs5DIAY0xHnxs+3DWuR2oI9wNhpAKLT+MwrMkr5MqL4iZt3SZiPDIZi
nwouonMgXOOJbbBpkox9uaX1S7CWKI0Z2/B2RJ1gggRJqnkvV3LfBBNYZkib/t/Q
MeG79cVI5OXJQETiTzXbVA76Xxe2vGOtHa+I4hEWQlUqpvGtiHnoYPBimLDKueb7
YD4UcgTfk6uW1QeU/jRfeZxL8iDv5VbeyjmVQ/Pgs1PhWBPq55ql6gN0EdbgukGA
Iw==
-----END CERTIFICATE-----
CERT;

        $result = openssl_verify('test', 'sig', $cert);

        if ($result === -1) {
            throw new Exception('Failed to verify signature');
        }
    }

    /**
     * @Iterations(10)
     * @Revs(1000)
     */
    public function benchVerifyWithPublicKey(): void
    {
        $publicKey = <<<CERT
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4pNCcs6N8DQ5raZPDrd3
xv7h/82MpJQecz6szUCoK/OW5xiKECAweeZZ+rUmWrYFO93PvjfWddRHCz6ruMBP
zhk/c79mLMJbn07j5EHTVWTbOQim4KFIZiFt9FKxjfGqF8jvUXbwNgy/tw7iJ4Th
67weIzX6orQvrAcRy1XCt0PMgCjv8T1/oBKFjvIZCUhd/oxtfEr3bi2oXKJ1LXfV
SunJN/B3m7p76LdFf/rDUpwRptU88zFPCOmqvflWLhDLwrW1VyalFs9iPUA2q84i
KP2ML6g7+tVCF8NWN4CfRr2ZidMai3+89NWDNAyu2+ylf1ZDfJQH9OZxeYWK1wL0
6wIDAQAB
-----END PUBLIC KEY-----
CERT;

        $result = openssl_verify('test', 'sig', $publicKey);

        if ($result === -1) {
            throw new Exception('Failed to verify signature');
        }
    }
}
