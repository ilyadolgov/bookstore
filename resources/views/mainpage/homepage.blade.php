@extends('layouts.app')

@section('title')
Главная страница
@endsection

@section('content')
<style>
  .parent {
    display: flex;
  }

  .left {
    margin-left: 2%;
  }

  .content {
    margin-left: 3%;
    width: 80%;
  }

  .genre {
    text-align: center;
  }
</style>



<!-- Вывод жанров из базы данных GROUP BY -->
<div class="parent">
  <div class="left">
    <h3 class="genre">Жанры</h3>
    <a></a>
    @if (count($genre))
    <ul class="list-group list-group-flush">
      @foreach($genre as $g)
      <li class="list-group-item">
        <a href="{{route('searchgenre', ['genre' => $g->genre])}}">{{ $g->genre }}</a>
      </li>
      @endforeach
    </ul>
    @endif
  </div>


  <!-- Основная часть страницы -->
  <div class="content">
    <form class="d-flex" method="get" action="{{  route('search') }}">
      <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Search" name="searchname">
      <button type="submit" class="btn btn-primary btn-block">Поиск</button>
    </form>


    @if (count($books))
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Наименование</th>
          <th scope="col">Автор</th>
          <th scope="col">Жанр</th>
          <th scope="col">Цена</th>
          <th scope="col"></th>
        </tr>
      </thead>
      @foreach($books as $book)

      <tbody>
        <tr>
          <td>{{ $book->name }}</td>
          <td>{{ $book->author }}</td>
          <td>{{ $book->genre }}</td>
          <td>{{ $book->price }} р.</td>
          <td><button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop" onClick="reply_click(this.id)" id='{{ $book->id }}'>
              Подробнее
            </button></td>
          @guest
          <!-- Кнопка добавления в корзину зарегистрированным пользователям -->
          @else
          <!-- тут должна быть кнопка добавления в корзину -->
          @endguest

        </tr>
      </tbody>

      @endforeach
    </table>
    {{ $books->links() }}

    @else
    <p>Записей не найдено</p>

    @endif
  </div>
</div>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="staticBackdropLabel">Характеристики</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
  </div>
  <div class="offcanvas-body">
    <div>
      @if (count($books))
      @foreach($books as $book)
      @if ($book->id==1)
      Наименование: {{ $book->name }}<br>
      Автор:
      Жанр:
      Цена:
      Описание:
      @endif
      @endforeach
      @endif

    </div>
  </div>
</div>

@endsection