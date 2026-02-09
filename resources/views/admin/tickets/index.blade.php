@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Заявки</h1>
            <span class="text-muted">Всего: {{ $tickets->total() }}</span>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">

                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                    <tr>
                        <th class="px-3">#</th>
                        <th>Клиент</th>
                        <th>Тема</th>
                        <th>Статус</th>
                        <th>Создано</th>
                        <th class="text-end px-3">Действие</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($tickets as $ticket)
                        <tr>
                            <td class="px-3">{{ $ticket->id }}</td>

                            <td>
                                <div class="fw-medium">
                                    {{ $ticket->customer->email ?? '—' }}
                                </div>
                                <small class="text-muted">
                                    {{ $ticket->customer->phone ?? '' }}
                                </small>
                            </td>

                            <td>
                                <a
                                    href="{{ route('admin.tickets.show', $ticket) }}"
                                    class="text-decoration-none fw-medium"
                                >
                                    {{ $ticket->subject }}
                                </a>
                            </td>

                            <td>
                                @php
                                    $statusClasses = [
                                        'new' => 'bg-secondary',
                                        'in_progress' => 'bg-warning text-dark',
                                        'done' => 'bg-success',
                                    ];

                                    $statusLabels = [
                                        'new' => 'Новая',
                                        'in_progress' => 'В работе',
                                        'done' => 'Завершена',
                                    ];
                                @endphp

                                <span class="badge {{ $statusClasses[$ticket->status] ?? 'bg-secondary' }}">
                                {{ $statusLabels[$ticket->status] ?? $ticket->status }}
                            </span>
                            </td>

                            <td class="text-muted">
                                {{ $ticket->created_at->format('d.m.Y H:i') }}
                            </td>

                            <td class="text-end px-3">
                                <a
                                    href="{{ route('admin.tickets.show', $ticket) }}"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    Открыть
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Заявки не найдены
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $tickets->links() }}
        </div>

    </div>
@endsection
