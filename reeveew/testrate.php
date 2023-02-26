<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Basic Bar Chart</title>

    <link href="../../assets/styles.css" rel="stylesheet" />

    <style>

        #chart {
            max-width: 650px;
            margin: 35px auto;
        }

    </style>

    <script>
        window.Promise ||
        document.write(
            '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
        )
        window.Promise ||
        document.write(
            '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
        )
        window.Promise ||
        document.write(
            '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
        )
    </script>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script>
        // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
        // Based on https://gist.github.com/blixt/f17b47c62508be59987b
        var _seed = 42;
        Math.random = function() {
            _seed = _seed * 16807 % 2147483647;
            return (_seed - 1) / 2147483646;
        };
    </script>


</head>

<body>
<div id="chart"></div>




</body>
</html>
