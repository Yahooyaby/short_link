@if(session('failure'))
    <div class="alert alert-success">
        {{session('failure')}}
    </div>
@endif
<x-app-layout>

<div class="py-12">
<div class="max-w-8xl mx-auto sm:px-12 lg:px-8">
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
<div class="p-9 text-gray-900 dark:text-gray-100">
    <style>
    table {
    border-collapse: collapse; /* Убираем двойные линии */
    width: 100%; /* Ширина таблицы */
    border-spacing: 0; /* Расстояние между ячейками */
    }
    td {
    border: 2px solid #333; /* Параметры границ */
    padding: 1px; /* Поля в ячейках */
    text-align: center; /* Выравнивание по центру */
    }
    </style>
    <body>
    {{Form::open(['route' => ['urls.store'], 'method' => 'POST'])}}
    {{ Form::label('name', 'Название ссылки') }}
    {{ Form::text('name') }}
    {{ Form::label('link', 'Ссылка') }}
    {{ Form::text('link') }}
    {{Form::submit('Создать') }}
    {{ Form::close() }}
    @can('viewAny',App\Models\Url::class)
    Фильтрация пользователей
    {{Form::open(['route' => ['urls.index',$users->pluck('id')],'method'=>'GET'])}}
    {{Form::select('users[]', $users->pluck('email', 'id'), null, ['multiple'=>'multiple','class' => 'form-control'])}}
    {{Form::submit("Filter")}}
    {{ Form::close() }}
        @endcan
    <table>
        <tr><td><b>Название ссылки</b></td>
            <td><b>Ссылка</b></td>
            <td><b>Сокращенная ссылка</b></td>
            <td><b>Удалить ссылку</b></td>
            <td><b>Количество переходов по ссылке</b></td>
            @can('viewAny',App\Models\Url::class)
            <td><b>Имя пользователя</b></td>
            @endcan
            </tr>
        @foreach($urls as $url)
        <tr><td>{{$url->name}}</td>
            <td>{{$url->link}}</td>
            <td><a href="{{route('urls.redirect_counter',['code'=>$url->short_link])}}">{{config('app.url')}}/{{$url->short_link}}</a></td>
            <td> {{Form::model($url,['route' => ['urls.destroy', $url->id], 'method' => 'DELETE'])}}
                {{Form::submit('Удалить ссылку') }}
                {{ Form::close() }}</td>
            <td>{{$url->count}}</td>
             @can('viewAny',$url)
                <td>{{$url->user->email }}</td>
            @endcan
        </tr>
        @endforeach
    </table>
    </body>
</div>
</div>
</div>
</div>
</x-app-layout>
