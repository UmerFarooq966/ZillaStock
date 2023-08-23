<!-- build:js assets/vendor/js/core.js -->
<script src="/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/assets/vendor/libs/popper/popper.js"></script>
<script src="/assets/vendor/js/bootstrap.js"></script>
<script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="/assets/js/main.js"></script>

<!-- Page JS -->
<script src="/assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


<!-- Zoom Pan hover on rejection image js -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ex2 = document.getElementById("ex2");
        const img = ex2.querySelector("img");
        let isDragging = false;
        let currentX;
        let currentY;
        let initialX;
        let initialY;
        let xOffset = 0;
        let yOffset = 0;
        let scale = 1;

        ex2.style.display = "flex";
        ex2.style.justifyContent = "flex";
        ex2.style.alignItems = "center";
        ex2.style.overflow = "auto";
        ex2.style.position = "flex";

        img.style.position = "relative";
        img.style.width = "auto";
        img.style.height = "900px";
        img.style.transformOrigin = "top left";

        ex2.addEventListener("mousedown", function(e) {
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;

            isDragging = true;
        });
        ex2.addEventListener("mouseup", function() {
            isDragging = false;
        });
        ex2.addEventListener("mouseout", function() {
            isDragging = false;
        });
        ex2.addEventListener("mousemove", function(e) {
            if (isDragging) {
                e.preventDefault();
                currentX = e.clientX - initialX;
                currentY = e.clientY - initialY;

                xOffset = currentX;
                yOffset = currentY;

                setTranslate(currentX, currentY, scale, img);
            }
        });
        ex2.addEventListener("dblclick", function() {
            scale = scale === 1 ? 2 : 1;
            setTranslate(xOffset, yOffset, scale, img);
        });

        const setTranslate = (xPos, yPos, scale, el) => {
            el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0) scale(" + scale + ")";
        };
    });
</script>
