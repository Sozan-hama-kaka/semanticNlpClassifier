<div class="nav-container">
    <h4 class="text-light text-start">SemanticNLP Classifier</h4>
</div>

<!-- Secondary navigation (outside the main nav container) -->
<div class="secondary-nav">
    <a href="#" class="btn btn-secondary-nav me-1">Classified Documents</a>
    <a href="#" class="btn btn-secondary-nav">Classify Document</a>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn-secondary-nav');

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Remove active class from all buttons
                buttons.forEach(btn => btn.classList.remove('active'));

                // Add active class to the clicked button
                this.classList.add('active');
            });

            // Prevent the button from losing active style on mouse release or blur
            button.addEventListener('blur', function () {
                this.classList.add('active'); // Ensure the active class persists
            });
        });
    });
</script>

