<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Jornal Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        /* Banner */
        .banner {
            position: relative;
            overflow: hidden;
            height: 400px;
            margin-bottom: 50px;
        }
        .banner img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .banner img.active {
            opacity: 1;
        }
        /* Cards */
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Banner -->
<div class="banner">
    <img src="https://source.unsplash.com/1200x400/?news,city" class="active" alt="Banner 1">
    <img src="https://source.unsplash.com/1200x400/?news,technology" alt="Banner 2">
    <img src="https://source.unsplash.com/1200x400/?news,sports" alt="Banner 3">
</div>

<!-- Cards Section -->
<div class="container">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100">
                <img src="https://source.unsplash.com/400x300/?news,politics" class="card-img-top" alt="Notícia 1">
                <div class="card-body">
                    <h5 class="card-title">Notícia 1</h5>
                    <p class="card-text">Resumo da notícia 1 para deixar o usuário interessado.</p>
                    <a href="#" class="btn btn-primary">Leia Mais</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <img src="https://source.unsplash.com/400x300/?news,science" class="card-img-top" alt="Notícia 2">
                <div class="card-body">
                    <h5 class="card-title">Notícia 2</h5>
                    <p class="card-text">Resumo da notícia 2 para deixar o usuário interessado.</p>
                    <a href="#" class="btn btn-primary">Leia Mais</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <img src="https://source.unsplash.com/400x300/?news,world" class="card-img-top" alt="Notícia 3">
                <div class="card-body">
                    <h5 class="card-title">Notícia 3</h5>
                    <p class="card-text">Resumo da notícia 3 para deixar o usuário interessado.</p>
                    <a href="#" class="btn btn-primary">Leia Mais</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS & dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Banner Fade + Slide Script -->
<script>
    const slides = document.querySelectorAll('.banner img');
    let current = 0;

    function nextSlide() {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }

    setInterval(nextSlide, 4000); // Muda a cada 4 segundos
</script>

</body>
</html>
