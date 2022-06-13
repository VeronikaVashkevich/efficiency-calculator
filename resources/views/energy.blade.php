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
            B
        </td>
        <td>
            {{$item->beta}}
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
            P<sub>e</sub>
        </td>
        <td>
            {{$item->Pe}}
        </td>
    </tr>
    <tr>
        <td>
            N<sub>0</sub>
        </td>
        <td>
            {{$item->N0}}
        </td>
    </tr>
</table>
</body>
</html>
