<main class="container-fluid mt-4">
    <section class="book-reviews-section">
        <h1 class="text-center text-purple">Book Reviews</h1>
        <p class="text-center text-light">
            Welcome to the Book Reviews section. Here, we share insightful reviews of our favorite books. Explore a variety of genres and find your next great read!
        </p>

        <div class="row mt-4">
            <!-- Book Images -->
            <div class="col-lg-9 col-12">
                <div class="row">
                    <?php
                    // Displaying 10 images in 3 rows
                    for ($i = 1; $i <= 10; $i++) {
                        echo '<div class="col-md-4 col-6 mb-3">';
                        echo '<img src="https://picsum.photos/300/200?random=' . $i . '" alt="Book ' . $i . '" class="img-fluid rounded shadow-sm">';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <!-- Quote of the Week Section -->
            <div class="col-lg-3 col-12 mt-4 mt-lg-0">
                <div class="quote-of-the-week bg-dark p-3 rounded shadow-sm">
                    <h4 class="text-purple text-center">Quote of the Week</h4>
                    <p class="text-light text-center">
                        "A book is a dream that you hold in your hand." - Neil Gaiman
                    </p>
                </div>
            </div>
        </div>

        <!-- My Favourites Section -->
        <section class="my-favourites mt-4">
            <h3 class="text-center text-purple">My Favourites</h3>
            <p class="text-center text-light">
                Here are some of my all-time favourite books that have left a lasting impact.
            </p>
            <!-- Display Favourites -->
            <div class="row mt-4">
                <?php
                // Displaying a set of 4 "favourite" books
                for ($i = 1; $i <= 4; $i++) {
                    echo '<div class="col-md-3 col-6 mb-4">';
                    echo '<img src="https://picsum.photos/300/200?random=' . ($i + 10) . '" alt="Favourite Book ' . $i . '" class="img-fluid rounded shadow-sm">';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </section>
</main>
