<div class="nav-container">
    <a class="logo-brand text-start" href="{{url('/')}}">SemanticNLP Classifier</a>
</div>

<!-- Secondary navigation (outside the main nav container) -->
<div class="secondary-nav">
    <a href="{{url('/classified-documents')}}" class="btn btn-secondary-nav me-1">Classified Documents</a>
    <a href="{{'/classify-document'}}" class="btn btn-secondary-nav me-1">Classify Document</a>
    <a href="{{'/performance-metric'}}" class="btn btn-secondary-nav">Performance Metric</a>
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
