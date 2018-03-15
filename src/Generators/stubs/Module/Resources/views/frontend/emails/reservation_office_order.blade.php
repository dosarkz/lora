<html>
<head>
</head>
<body>

<h3>Заявка на бронирование офиса с сайта emeraldtower.kz:</h3>
<table class="table">

    <tr>
        <td>Номер офиса: {{$request['office_id']}}</td>
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