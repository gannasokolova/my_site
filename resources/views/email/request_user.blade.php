<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

<h2>Добрый день!</h2>


На сайте оставлена заявка на консультацию.<br><br>

Имя клиента: <b>{{$content['name']}}</b><br>
Контактный номер телефона: <b>{{$content['phone']}}</b><br>

@if(isset($content['price_id']))
    Тип консультации: {{App\Price::find($content['price_id'])->title}}
@endif

<!-- Footer -->
<tr>
    <td>
        <table align="center" width="570" cellpadding="0" cellspacing="0">
            <tr>
                <td >
                    <p >
                        &copy; {{ date('Y') }}
                        <a href="{{ url('/') }}" target="_blank">{{ config('app.name') }}</a>.
                        Все права защищены.
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>

</body>
</html>