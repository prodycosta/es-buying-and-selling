<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invia un Messaggio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invia un Messaggio</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('chat.store', ['receiver' => $receiver->id, 'annuncio' => $annuncio->id]) }}">
                        @csrf

                        <div class="form-group">
                            <label for="message">Messaggio</label>
                            <textarea id="message" class="form-control" name="message" required></textarea>
                        </div>

                        <input type="hidden" name="article_id" value="{{ $annuncio->id }}">

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Invia Messaggio</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
