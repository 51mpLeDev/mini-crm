@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="mb-4">
            <h1 class="h4 mb-1">Заявка №{{ $ticket->id }}</h1>
            <div class="text-muted">
                Создана: {{ $ticket->created_at->format('d.m.Y H:i') }}
            </div>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        Клиент
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <strong>Имя:</strong><br>
                            {{ $ticket->customer->name ?? '—' }}
                        </div>

                        <div class="mb-2">
                            <strong>Email:</strong><br>
                            {{ $ticket->customer->email ?? '—' }}
                        </div>

                        <div>
                            <strong>Телефон:</strong><br>
                            {{ $ticket->customer->phone ?? '—' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        Сообщение
                    </div>
                    <div class="card-body">
                        <p class="mb-0">
                            {{ $ticket->message }}
                        </p>
                    </div>
                </div>

                @if ($ticket->getMedia('attachments')->count())
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            Файлы
                        </div>
                        <div class="card-body">
                            <ul class="mb-0">
                                @foreach ($ticket->getMedia('attachments') as $media)
                                    <li>
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ $media->file_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header">
                        Статус заявки
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}">
                            @csrf
                            @method('PATCH')

                            @php
                                $statusLabels = [
                                    'new' => 'Новая',
                                    'in_progress' => 'В работе',
                                    'done' => 'Завершена',
                                ];
                            @endphp

                            <div class="mb-3">
                                <label class="form-label">Статус</label>
                                <select name="status" class="form-select">
                                    @foreach ($statusLabels as $value => $label)
                                        <option value="{{ $value }}" @selected($ticket->status === $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary">
                                    Назад
                                </a>

                                <button class="btn btn-primary">
                                    Сохранить
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
