
<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */
if (!is_null(@$data['errors'])): ?>
    <?php foreach ($data['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


        <form action="<?= $link->url("post.upload") ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= @$data['post']?->getId() ?>">
            <div class="mb-3">
                <label for="title" class="form-label text-purple">Review Title</label>
                <input type="text" class="form-control bg-dark text-light" id="title" name="title"  value="<?= isset($data['post']) ? htmlspecialchars($data['post']?->getNazov(), ENT_QUOTES, 'UTF-8') : '' ?>" placeholder="Enter the title of your review" required>
            </div>

            <div class="mb-3">
                <label for="typ_postu" class="form-label text-purple">Category</label>
                <?php $selectedType = @$data['post']?->getTypPostu(); ?>
                <select class="form-select bg-dark text-light" id="typ_postu" name="typ_postu" required>
                    <option value="1" <?= $selectedType == 1 ? 'selected' : '' ?>>Movie</option>
                    <option value="2" <?= $selectedType == 2 ? 'selected' : '' ?>>Book</option>
                    <option value="3" <?= $selectedType == 3 ? 'selected' : '' ?>>Series</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label text-purple">Review Content</label>
                <textarea class="form-control bg-dark text-light" id="text" name="text" rows="6" placeholder="Write your review here..." required><?= htmlspecialchars(@$data['post'] !=null ? @$data['post']?->getText() : "") ?></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label text-purple">Rating (1 to 5)</label>
                <input type="number" class="form-control bg-dark text-light" id="rating" name="rating" min="1" max="5" value="<?= @$data['post']?->getRating() ?>" placeholder="Enter a rating between 1 and 5" required>
                <small class="text-muted-white">Please enter a number between 1 and 5.</small>
            </div>

            <div class="mb-3">

                <label for="imageOption" class="form-label text-purple">Upload Image</label>
                <div>Pôvodný súbor: <?= @$data['post']?->getObrazok() ?></div>

                <!-- Rectangular Toggle Switch -->
                <div class="custom-toggle">

                    <label class="toggle-option" id="urlOption">

                        <input type="radio" name="imageOption" value="url" id="imageSwitchURL">
                        <span>URL</span>

                    </label>
                    <label class="toggle-option" id="fileOption">
                        <input type="radio" name="imageOption" value="file" id="imageSwitchFile">
                        <span>Upload from PC</span>
                    </label>
                </div>

                <!-- File Upload Field -->
                <div class="mb-3" id="fileUploadContainer">
                    <input type="file" class="form-control bg-dark text-light" id="fileInput" name="imageFile">
                </div>

                <!-- URL Input Field -->
                <div class="mb-3" id="urlInputContainer" >
                    <input type="url" class="form-control bg-dark text-light" id="urlInput" name="imageUrl" placeholder="Enter Image URL">
                </div>
            </div>


            <script>
                // Get the radio buttons and corresponding containers
                const IsURL = "<?= @$data['post']?->getIsURL()?>";

                const fileOption = document.getElementById('imageSwitchFile');
                const urlOption = document.getElementById('imageSwitchURL');
                const fileUploadContainer = document.getElementById('fileUploadContainer');
                const urlInputContainer = document.getElementById('urlInputContainer');
                const fileInput = document.getElementById('fileInput'); // File input field
                const urlInput = document.getElementById('urlInput');   // URL input field

                if(IsURL == 1){
                    urlOption.checked = true;
                    fileUploadContainer.style.display = 'none';
                    urlInputContainer.style.display = 'block';
                    urlInput.value = "<?= @$data['post']?->getObrazok()?>"
                }
                // Event listener to toggle between URL input and file upload
                fileOption.addEventListener('change', function() {
                    if (fileOption.checked) {
                        fileUploadContainer.style.display = 'block';
                        urlInputContainer.style.display = 'none';
                        urlInput.value = '';
                    }
                });

                urlOption.addEventListener('change', function() {
                    if (urlOption.checked) {
                        fileUploadContainer.style.display = 'none';
                        urlInputContainer.style.display = 'block';
                        fileInput.value = '';
                    }
                });

            </script>
            <div class="text-center">
                <button type="submit" class="btn custom-btn" >Submit Review</button>
            </div>

        </form>
