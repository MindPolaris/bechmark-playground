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
