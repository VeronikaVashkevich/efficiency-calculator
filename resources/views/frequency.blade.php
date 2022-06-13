<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        td {
            padding: 5px 15px;
        }
    </style>
</head>
<body>
<table class="table-bordered">
    <tr>
        <td>
            &gamma;
        </td>
        <td>
            {{$item->gamma}}
        </td>
    </tr>
    <tr>
        <td>
            R
        </td>
        <td>
            {{$item->R}}
        </td>
    </tr>
    <tr>
        <td>
            &#916;F
        </td>
        <td>
            {{$item->deltaF}}
        </td>
    </tr>
</table>
</body>
</html>
