<html>
<head>
</head>
<body>

<h3>Заявка на арендную площадь с сайта emeraldtower.kz:</h3>
<table class="table">

    <tr>
        <td>Площадь: {{$request['area']}}</td>
    </tr>

    <tr>
        <td>Количество кабинетов: {{$request['cabinets-group']}}</td>
    </tr>

    <tr>
        <td>Компания: {{$request['company']}}</td>
    </tr>

    <tr>
        <td>ФИО: {{$request['name']}}</td>
    </tr>

    <tr>
        <td>Сообщение: {{$request['message']}}</td>
    </tr>
</table>
</body>
</html>