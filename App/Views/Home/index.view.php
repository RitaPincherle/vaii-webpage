<?php
use App\Models\Post;
/** @var \App\Core\LinkGenerator $link */
/** @var Post[] $data */



?>
<head>
    <link rel="stylesheet" href="public/css/home.css">
</head>
<!-- Main Content -->
<main class="container my-4">
    <div class="row">
        <div class="col-12 mb-4">
            <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo $data[0]->getObrazok()?>" class="d-block w-100 h-60" alt="">
                    </div>

                    <?php
                        for ($i = 1; $i < sizeof($data); $i++) {?>
                            <div class="carousel-item ">
                                <img src="<?php echo $data[$i]->getObrazok()?>" class="d-block w-100 h-60" alt="">
                            </div>
                        <?php }?>

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

                <?php for ($i = 0; $i < sizeof($data); $i++) {?>
                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="card shadow-sm">
                            <img src="<?php echo $data[$i]->getObrazok()?>" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data[$i]->getNazov()?></h5>
                                <p class="card-text"> <?php echo mb_substr($data[$i]->getText(), 0, 60) . (mb_strlen($data[$i]->getText()) > 60 ? '...' : '') ?></p>
                                <p class="text-muted">Rating: <?php echo $data[$i]->getRating()?></p>
                            </div>
                        </div>

                    </div>
                <?php if ($i > 10){
                    break;
                    }
                } ?>


        <!-- Sidebar (on larger screens) -->
        <div class="col-lg-3 col-12 mt-4 mt-lg-0">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Trending Books</a>
                <a href="#" class="list-group-item list-group-item-action">Top Rated Movies</a>
                <a href="#" class="list-group-item list-group-item-action">Trending Series</a>
                <a href="#" class="list-group-item list-group-item-action">New posts</a>
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
