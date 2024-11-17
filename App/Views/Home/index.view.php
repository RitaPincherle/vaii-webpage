<?php

/** @var \App\Core\LinkGenerator $link */
?>
<head>
    <link rel="stylesheet" href="public/css/home.css">
</head>
<!-- Main Content -->
<main class="container my-4">
    <div class="row">
        <!-- Image Carousel or Featured Content (Hero Section) -->
        <div class="col-12 mb-4">
            <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://picsum.photos/1200/600?image=0" class="d-block w-100" alt="Featured Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://picsum.photos/1200/600?image=10" class="d-block w-100" alt="Featured Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="https://picsum.photos/1200/600?image=20" class="d-block w-100" alt="Featured Image 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- Movie Grid (Responsive Layout) -->
        <div class="col-12">
            <div class="row">
                <!-- Movie Item 1 -->
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://picsum.photos/200/300?image=30" class="card-img-top" alt="Movie 1">
                        <div class="card-body">
                            <h5 class="card-title">Movie Title 1</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p class="text-muted">Rating: 7.5</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://picsum.photos/200/300?image=40" class="card-img-top" alt="Movie 2">
                        <div class="card-body">
                            <h5 class="card-title">Book Title 2</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p class="text-muted">Rating: 8.1</p>
                        </div>
                    </div>
                </div>

                <!-- Movie Item 3 -->
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://picsum.photos/200/300?image=50" class="card-img-top" alt="Movie 3">
                        <div class="card-body">
                            <h5 class="card-title">Series Title 3</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p class="text-muted">Rating: 6.3</p>
                        </div>
                    </div>
                </div>

                <!-- Movie Item 4 -->
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://picsum.photos/200/300?image=60" class="card-img-top" alt="Movie 4">
                        <div class="card-body">
                            <h5 class="card-title">Movie Title 4</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p class="text-muted">Rating: 9.0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar (on larger screens) -->
        <div class="col-lg-3 col-12 mt-4 mt-lg-0">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Trending Books</a>
                <a href="#" class="list-group-item list-group-item-action">Top Rated Movies</a>
                <a href="#" class="list-group-item list-group-item-action">New Book Releases</a>
                <a href="#" class="list-group-item list-group-item-action">Upcoming Series</a>
            </div>
        </div>
    </div>
</main>

<!-- Custom Styles for Mobile -->
<style>
    /* For mobile screens, reduce the size of the carousel image */
    @media (max-width: 767px) {
        .carousel-item img {
            height: 300px; /* Make carousel images smaller */
            object-fit: cover;
        }

        .card-title {
            font-size: 1rem;
        }

        .card-text {
            font-size: 0.9rem;
        }

        .card-body {
            padding: 1rem;
        }
    }
</style>
