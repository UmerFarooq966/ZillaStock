<!DOCTYPE html>
<html>
<head>
    <title>Image Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->

    <!-- gallery -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- Laravel JQuery UI Autocomplete Search -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 30px;
            color: white;
        }

        h1,h2 {
            padding-top: 10px;
            margin-bottom: 30px;
            color: white;

        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        #image-container {
            flex: 0 0 50%;
        }

        #image-preview {
            max-width: 100%;
            max-height: 500px;
            object-fit: cover;
            overflow: hidden;
        }


        .slider-container {
            flex: 0 0 45%;
            margin-left: 30px;
        }

        .slider {
            width: 50%;
            margin-bottom: 20px;
        }
        #drop-area {
            text-align: center;
        }

        .input-container {
            display: inline-block;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
        }



    </style>
</head>
@include('00.navbar')


<body style="background-color:rgba(58,58,58,0.73);">
<div class="align-items-md-start">
    <br>
    <div class="align-self-center" id="drop-area">
        <p>Drag and drop an image here, or click to select an image.</p>
        <div class="input-container">
            <input type="file" id="file-input">
        </div>
    </div>
    <h2>Ai Features</h2>
    @auth()
<button id="super-resolution-api-button" class="btn btn-primary api-button">Apply Super Resolution</button>
<button id="background-removal-api-button" class="btn btn-primary api-button">Apply Background Removal</button>
    @endauth
    @guest()
        <h2>Login to use AI Features</h2>
    @endguest
</div>
    <div class="container">

    <div id="image-container">
        @if(isset($imageUrl))
            <img id="image-preview" src="{{ $imageUrl }}" alt="Preview Image">
        @else
            <img id="image-preview" src="" alt="Preview Image">
        @endif
    </div>

    <div id="flash-message" class="flash-message"></div>
    <div id="loading-indicator" style="display: none;">
        Loading...
    </div>
    <div class="slider-container">
        <h1>Image Editor</h1>
        <div class="form-group">
            <label for="contrast-slider">Contrast:</label>
            <input type="range" class="form-range slider" id="contrast-slider" min="0" max="200" value="100">
            <span id="contrast-value"></span>
        </div>
<hr>
        <div class="form-group">
            <label for="hue-slider">Hue:</label>
            <input type="range" class="form-range slider" id="hue-slider" min="0" max="360" value="180">
            <span id="hue-value"></span>
        </div>
        <hr>
        <div class="form-group">
            <label for="brightness-slider">Brightness:</label>
            <input type="range" class="form-range slider" id="brightness-slider" min="0" max="200" value="100">
            <span id="brightness-value"></span>
        </div>
        <hr>
        <div class="form-group">
            <label for="saturation-slider">Saturation:</label>
            <input type="range" class="form-range slider" id="saturation-slider" min="0" max="200" value="100">
            <span id="saturation-value"></span>
        </div>
        <hr>
        <div class="form-group">
            <label for="invert-slider">Invert:</label>
            <input type="range" class="form-range slider" id="invert-slider" min="0" max="100" value="0">
            <span id="invert-value"></span>
        </div>
        <hr>
        <div class="form-group">
            <label for="sepia-slider">Sepia:</label>
            <input type="range" class="form-range slider" id="sepia-slider" min="0" max="100" value="0">
            <span id="sepia-value"></span>
        </div>
        <hr>
        <div class="form-group">
            <label for="blur-slider">Blur:</label>
            <input type="range" class="form-range slider" id="blur-slider" min="0" max="10" value="0">
            <span id="blur-value"></span>
        </div>
        <hr>
        <div class="form-group">
            <label for="crop-slider">Crop:</label>
            <input type="range" class="form-range slider" id="crop-slider" min="0" max="360" value="0">
            <span id="crop-value"></span>
        </div>
        <div class="form-group">
            <label for="side-crop-slider">Crop from Sides:</label>
            <input type="range" class="form-range slider" id="side-crop-slider" min="0" max="100" value="0">
            <span id="side-crop-value"></span>
        </div>
        <hr>
        <div class="form-group">
            <label for="rotate-slider">Rotate:</label>
            <input type="range" class="form-range slider" id="rotate-slider" min="0" max="360" value="0">
            <span id="rotate-value"></span>
        </div>
        <hr>

        <button id="download-button" class="btn btn-success">Download Edited Image</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        // Get the drop area and file input elements
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file-input');

        // Handle drag and drop events
        dropArea.addEventListener('dragover', handleDragOver);
        dropArea.addEventListener('drop', handleDrop);

        // Handle file selection from the file input
        fileInput.addEventListener('change', handleFileSelect);

        // Function to handle the dragover event
        function handleDragOver(event) {
            event.preventDefault();
            event.stopPropagation();
            event.dataTransfer.dropEffect = 'copy';
        }

        // Function to handle the drop event
        function handleDrop(event) {
            event.preventDefault();
            event.stopPropagation();

            const file = event.dataTransfer.files[0];
            processImage(file);
        }

        // Function to handle the file input change event
        function handleFileSelect(event) {
            const file = event.target.files[0];
            processImage(file);
        }

        // Function to process the uploaded image
        function processImage(file) {
            const reader = new FileReader();

            reader.onload = function (event) {
                const imageUrl = event.target.result;
                imagePreview.src = imageUrl;
            };

            reader.readAsDataURL(file);
        }

        // Get the image element
        const imagePreview = document.getElementById('image-preview');

        // Get the sliders
        const contrastSlider = document.getElementById('contrast-slider');
        const hueSlider = document.getElementById('hue-slider');
        const brightnessSlider = document.getElementById('brightness-slider');
        const saturationSlider = document.getElementById('saturation-slider');
        const invertSlider = document.getElementById('invert-slider');
        const sepiaSlider = document.getElementById('sepia-slider');
        const blurSlider = document.getElementById('blur-slider');
        const cropSlider = document.getElementById('crop-slider');
        const rotateSlider = document.getElementById('rotate-slider');
        const sideCropSlider = document.getElementById('side-crop-slider');

        // Get the value elements
        const contrastValue = document.getElementById('contrast-value');
        const hueValue = document.getElementById('hue-value');
        const brightnessValue = document.getElementById('brightness-value');
        const saturationValue = document.getElementById('saturation-value');
        const invertValue = document.getElementById('invert-value');
        const sepiaValue = document.getElementById('sepia-value');
        const blurValue = document.getElementById('blur-value');
        const cropValue = document.getElementById('crop-value');
        const rotateValue = document.getElementById('rotate-value');
        const sideCropValue = document.getElementById('side-crop-value');

        // Update the image based on slider values
        const updateImage = () => {
            const contrast = contrastSlider.value;
            const hue = hueSlider.value;
            const brightness = brightnessSlider.value;
            const saturation = saturationSlider.value;
            const invert = invertSlider.value;
            const sepia = sepiaSlider.value;
            const blur = blurSlider.value;
            const crop = cropSlider.value;
            const sideCrop = sideCropSlider.value;
            const rotate = rotateSlider.value;

            contrastValue.textContent = `Contrast: ${contrast}`;
            hueValue.textContent = `Hue: ${hue}`;
            brightnessValue.textContent = `Brightness: ${brightness}`;
            saturationValue.textContent = `Saturation: ${saturation}`;
            invertValue.textContent = `Invert: ${invert}`;
            sepiaValue.textContent = `Sepia: ${sepia}`;
            blurValue.textContent = `Blur: ${blur}`;
            cropValue.textContent = `Crop: ${crop}°`;
            sideCropValue.textContent = `Crop from Sides: ${sideCrop}%`;
            rotateValue.textContent = `Rotate: ${rotate}°`;

            const cropPercentage = crop / 100;
            const sideCropPercentage = sideCrop / 100;
            const cropTop = cropPercentage * 50;
            const cropBottom = 100 - cropPercentage * 50;
            const sideCropLeft = sideCropPercentage * 50;
            const sideCropRight = 100 - sideCropPercentage * 50;

            imagePreview.style.filter = `contrast(${contrast}%) hue-rotate(${hue}deg) brightness(${brightness}%) saturate(${saturation}%) invert(${invert}%) sepia(${sepia}%) blur(${blur}px)`;
            imagePreview.style.transform = `rotate(${rotate}deg)`;
            imagePreview.style.clipPath = `polygon(${sideCropLeft}% ${cropTop}%, ${sideCropRight}% ${cropTop}%, ${sideCropRight}% ${cropBottom}%, ${sideCropLeft}% ${cropBottom}%)`;
        };

        // Add event listeners to sliders
        contrastSlider.addEventListener('input', updateImage);
        hueSlider.addEventListener('input', updateImage);
        brightnessSlider.addEventListener('input', updateImage);
        saturationSlider.addEventListener('input', updateImage);
        invertSlider.addEventListener('input', updateImage);
        sepiaSlider.addEventListener('input', updateImage);
        blurSlider.addEventListener('input', updateImage);
        cropSlider.addEventListener('input', updateImage);
        sideCropSlider.addEventListener('input', updateImage);
        rotateSlider.addEventListener('input', updateImage);

        // Apply Super Resolution API
        const applySuperResolutionApi = () => {
            const loadingIndicator = document.getElementById('loading-indicator');
            loadingIndicator.style.display = 'block';
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = imagePreview.naturalWidth;
            canvas.height = imagePreview.naturalHeight;
            context.filter = imagePreview.style.filter;
            context.drawImage(imagePreview, 0, 0);
            canvas.toBlob((blob) => {
                const form = new FormData();
                form.append('image_file', blob);
                form.append('upscale', 2);

                fetch('https://clipdrop-api.co/super-resolution/v1', {
                    method: 'POST',
                    headers: {
                        'x-api-key': '3b5da720b0c9c9322bba5dabf3065d3dfaec2b931aa342617e62514e3011d7962a9249eb90b6ba62a3cd43bae8237cda',
                    },
                    body: form,
                })
                    .then((response) => {
                        if (response.ok) {
                            return response.blob();
                        } else if (response.status === 400) {
                            showFlashMessage('Request is malformed or incomplete or Image Res is too big.');
                            throw new Error('Bad Request');
                        } else {
                            throw new Error('Error occurred during API call.');
                        }
                    })
                    .then((blob) => {
                        // Download the edited image
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'edited_image.jpg'; // Set the desired file name
                        a.style.display = 'none';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                        URL.revokeObjectURL(url);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            });
        };

        // Add event listener to Super Resolution API button
        const superResolutionApiButton = document.getElementById('super-resolution-api-button');
        superResolutionApiButton.addEventListener('click', applySuperResolutionApi);

        // Apply Background Removal API
        // Apply Background Removal API
        const applyBackgroundRemovalApi = () => {
            const loadingIndicator = document.getElementById('loading-indicator');
            loadingIndicator.style.display = 'block';
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = imagePreview.naturalWidth;
            canvas.height = imagePreview.naturalHeight;
            context.filter = imagePreview.style.filter;
            context.drawImage(imagePreview, 0, 0);
            canvas.toBlob((blob) => {
                const form = new FormData();
                form.append('image_file', blob);

                fetch('https://clipdrop-api.co/remove-background/v1', {
                    method: 'POST',
                    headers: {
                        'x-api-key': '3b5da720b0c9c9322bba5dabf3065d3dfaec2b931aa342617e62514e3011d7962a9249eb90b6ba62a3cd43bae8237cda',
                    },
                    body: form,
                })
                    .then((response) => {
                        if (response.ok) {
                            return response.arrayBuffer();
                        } else if (response.status === 400) {
                            showFlashMessage('Request is malformed or incomplete or Image Res is too big.');
                            throw new Error('Bad Request');
                        } else {
                            throw new Error('Error occurred during API call.');
                        }
                    })
                    .then((buffer) => {
                        // buffer here is a binary representation of the returned image
                        // Handle the buffer as needed
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            });
        };

// Add event listener to Background Removal API button
        const backgroundRemovalApiButton = document.getElementById('background-removal-api-button');
        backgroundRemovalApiButton.addEventListener('click', applyBackgroundRemovalApi);


        // Download edited image
        const downloadButton = document.getElementById('download-button');
        downloadButton.addEventListener('click', () => {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = imagePreview.naturalWidth;
            canvas.height = imagePreview.naturalHeight;
            context.filter = imagePreview.style.filter;
            context.drawImage(imagePreview, 0, 0);
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/jpeg');
            link.download = 'edited_image.jpg';
            link.click();
        });
    });
</script>
</body>
</html>
