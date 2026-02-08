<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Feedback widget</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        body {
            background: #fff;
        }
    </style>
</head>
<body>

<div class="container py-3">
    <form id="ticket-form">
        <div class="mb-3">
            <input name="name" class="form-control" required placeholder="Имя">
        </div>

        <div class="mb-3">
            <input name="email" class="form-control" required placeholder="Email">
        </div>

        <div class="mb-3">
            <input name="subject" class="form-control" placeholder="Тема" required>
        </div>

        <div class="mb-3">
            <textarea name="message" class="form-control" placeholder="Текст" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Отправить
        </button>
    </form>

    <div id="result" class="mt-3"></div>
</div>

<script>
    const form = document.getElementById('ticket-form');
    const result = document.getElementById('result');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        result.innerHTML = '<div class="text-muted">Отправка...</div>';

        const formData = new FormData(form);

        try {
            const response = await fetch('/api/tickets', {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            form.reset();
            result.innerHTML = '<div class="alert alert-success">Заявка успешно отправлена</div>';
        } catch (error) {
            if (error?.errors) {
                const message = Object.values(error.errors)[0][0];
                result.innerHTML = `<div class="alert alert-danger">${message}</div>`;
            } else {
                result.innerHTML = '<div class="alert alert-danger">Ошибка отправки</div>';
            }
        }
    });
</script>

</body>
</html>
