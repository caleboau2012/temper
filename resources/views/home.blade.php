<html>
    <head>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1"
        />
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        />
        <link rel="stylesheet" href="style.css" />
    </head>
    <body class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <br />
                <form name="generate" class="form-inline" role="form">
                    <div class="form-group">
                        <label class="sr-only" for="start">Start:</label>
                        <input required type="date" class="form-control" name="start" id="start" placeholder="Start Date" value="2016-07-06">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="stop">Stop:</label>
                        <input required type="date" class="form-control" name="stop" id="stop" placeholder="Stop Date" value="2016-09-06">
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>
            </div>
        </div>
        <hr />

        <div class="row">
            <div id="chart"></div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script src="https://code.highcharts.com/highcharts.src.js"></script>

        <script src="js/index.js"></script>
    </body>
</html>
