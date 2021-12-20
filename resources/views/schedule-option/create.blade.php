<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Options</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        select {
            color: #f5f6fa;
            background-color: #2f3640;
            font-weight: 600;
            padding: 20px;
            border: none;
            border-radius: 5px;
        }

        select:hover {
            background-color: #545b64;
            padding: 20px;
            border: none;
        }

        option {
            padding: 20px;
            font-size: 22px;
        }

        .section {
            margin-top: 40px;
            margin-left: 25px;
            padding: 10px;
            width: auto;
        }

        .selected {
            display: inline-block;
            margin-right: 20px;
            float: left;
        }

        .submit-selected-item {
            padding-top: 5px;
        }

        .btn {
            color: white;
            background-color: #1976D2;
            cursor: pointer;
            padding: 15px 25px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
        }
    </style>
</head>

<body>
<div class="section">
    <form action="/schedule-option" method="post">
        @csrf
        @if(session()->has('alert-danger'))
            <div class="alert alert-success">
                {{ session()->get('alert-danger') }}
            </div>
        @endif
        @if(session()->has('alert-success'))
            <div class="alert alert-success">
                {{ session()->get('alert-success') }}
            </div>
        @endif
        <div class="selected">
            <select id="select-item" name="interval_option">
                <option disabled selected value> --- Select Option ---</option>
                <option value="5">5</option>
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="45">45</option>
                <option value="60">60</option>
            </select>
        </div>
        <div class="submit-selected-item">
            <button class="btn" type="submit" id="submit">SUBMIT</button>
        </div>
    </form>

</div>
</body>

</html>
</html>
