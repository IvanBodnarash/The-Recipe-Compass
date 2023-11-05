// Initializing Filestack with API key
const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');
const imageInput = document.getElementById('filestack-picker');

// Attaching an image upload event
imageInput.addEventListener('click', () => {
    // Image uploading via Filestack
    client.picker({
        accept: 'image/*',
        onUploadDone: (file) => {
            // Get URL of uploaded image
            const imageUrl = file.url;

            // Set URL as "image_url" field value
            document.getElementById('image-url').value = imageUrl;
            console.log('URL завантаженого зображення:', imageUrl);
        }
    }).open();
});