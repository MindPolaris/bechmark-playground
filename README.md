# Benchmark Playground

The repository for different PHP aspects benchmarking

## Closure vs. Reflection API

Setting private properties via Closure is slightly faster than via Reflection API.  
The difference in performance should not be the key argument in the choice.  
```
./vendor/bin/phpbench run test/PrivatePropBench.php  --report aggregate --retry-threshold=2

+------------------+-----------------+-----+-------+-----+-----------+---------+--------+
| benchmark        | subject         | set | revs  | its | mem_peak  | mode    | rstdev |
+------------------+-----------------+-----+-------+-----+-----------+---------+--------+
| PrivatePropBench | benchClosure    |     | 10000 | 10  | 718.192kb | 1.117μs | ±1.28% |
| PrivatePropBench | benchReflection |     | 10000 | 10  | 718.192kb | 1.145μs | ±1.05% |
+------------------+-----------------+-----+-------+-----+-----------+---------+--------+
```

## openssl_verify X.509 vs. public key

Using `X.509` certificate is twice faster than public key directly

It is related to the `php_openssl_pkey_from_zval` function implementation.
When the public key is provided it is parsed twice. The first try is parsing `X.509` certificate
and after it is failed - parsing public key
```
./vendor/bin/phpbench run test/SslVerifyBench.php --report aggregate --retry-threshold=5

+----------------+--------------------------------+-----+------+-----+-----------+-----------+--------+
| benchmark      | subject                        | set | revs | its | mem_peak  | mode      | rstdev |
+----------------+--------------------------------+-----+------+-----+-----------+-----------+--------+
| SslVerifyBench | benchVerifyWithX509Certificate |     | 1000 | 10  | 719.904kb | 175.939μs | ±2.43% |
| SslVerifyBench | benchVerifyWithPublicKey       |     | 1000 | 10  | 719.904kb | 424.073μs | ±1.94% |
+----------------+--------------------------------+-----+------+-----+-----------+-----------+--------+
```
